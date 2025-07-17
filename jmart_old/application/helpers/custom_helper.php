<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('generate_transaction_number')) {
	function generate_transaction_number()
	{
		$CI = &get_instance();

		// Mendapatkan tahun saat ini
		$year = date('y');

		// Mendapatkan bulan saat ini
		$month = date('m');

		// Mendapatkan nomor transaksi terakhir dari database
		$last_transaction_number = $CI->db->select('id_pesanan')->order_by('id_pesanan', 'DESC')->limit(1)->get('tb_pesanan')->row('id_pesanan');

		// Jika tidak ada nomor transaksi sebelumnya, mulai dari 0001
		if (!$last_transaction_number) {
			$last_transaction_number = "0000";
		}

		// Ambil angka dari nomor transaksi terakhir
		$last_number = intval(substr($last_transaction_number, 7, 4));

		// Jika bulan dan tahun saat ini berbeda dengan bulan dan tahun nomor terakhir, reset nomor transaksi menjadi 0001
		if (substr($last_transaction_number, 3, 2) != $month || substr($last_transaction_number, 1, 2) != $year) {
			$last_number = 0;
		}

		// Tambahkan 1 ke nomor transaksi terakhir
		$new_number = str_pad($last_number + 1, 4, '0', STR_PAD_LEFT);

		// Format nomor transaksi sesuai dengan kebutuhan (misalnya INV-<tahun><bulan>-<nomor>)
		$transaction_number = "INV-$month$year-$new_number";

		return $transaction_number;
	}
}

if (!function_exists('calculate_fifo_hpp')) {
	/**
	 * Hitung HPP FIFO dan detail batch untuk pengeluaran stok.
	 * @param int $id_brg
	 * @param int $jumlah_keluar
	 * @return array ['total_hpp' => int, 'detail_batch' => array]
	 */
	function calculate_fifo_hpp($id_brg, $jumlah_keluar)
	{
		$CI = &get_instance();
		$CI->load->database();
		$total_hpp = 0;
		$detail_batch = array();
		$sisa_keluar = $jumlah_keluar;

		// Ambil batch stock_masuk & stock_awal urut ASC (FIFO)
		$CI->db->select('id_riwayat_stock, jumlah_riwayat, harga_masuk, tgl_riwayat_stock')
			->from('tb_riwayat_stock')
			->where('id_brg', $id_brg)
			->where_in('jenis_transaksi', ['stock_masuk', 'stock_awal'])
			->where('jumlah_riwayat >', 0)
			->order_by('tgl_riwayat_stock', 'ASC');
		$batches = $CI->db->get()->result_array();

		// Hitung total stock keluar dari batch ini
		foreach ($batches as $batch) {
			// Hitung sisa batch yang masih tersedia
			$CI->db->select_sum('jumlah_riwayat', 'keluar')
				->from('tb_riwayat_stock')
				->where('id_brg', $id_brg)
				->where('tgl_riwayat_stock >', $batch['tgl_riwayat_stock'])
				->where_in('jenis_transaksi', ['stock_keluar', 'stock_rusak', 'stock_opname']);
			$keluar = $CI->db->get()->row('keluar');
			$keluar = $keluar ? (int)$keluar : 0;

			$sisa_batch = $batch['jumlah_riwayat'] - $keluar;
			if ($sisa_batch <= 0) continue;

			$pakai = min($sisa_keluar, $sisa_batch);
			$total_hpp += $pakai * (int)$batch['harga_masuk'];
			$detail_batch[] = [
				'id_riwayat_stock' => $batch['id_riwayat_stock'],
				'jumlah' => $pakai,
				'harga_masuk' => (int)$batch['harga_masuk']
			];
			$sisa_keluar -= $pakai;
			if ($sisa_keluar <= 0) break;
		}
		return [
			'total_hpp' => $total_hpp,
			'detail_batch' => $detail_batch
		];
	}
}

if (!function_exists('roundToNearest')) {
	/**
	 * Fungsi untuk membulatkan angka ke kelipatan terdekat.
	 * @param float $number Angka yang akan dibulatkan.
	 * @param int $multiple Kelipatan yang diinginkan (default 500).
	 * @return int Angka yang sudah dibulatkan.
	 */
	function roundToNearest($number, $multiple = 500)
	{
		return round($number / $multiple) * $multiple;
	}
}

if (!function_exists('update_hpp_fifo_all_barang')) {
	function update_hpp_fifo_all_barang($id = null, $newHpp = null)
	{
		$CI = &get_instance();

		$barangs = $CI->db->get('tb_barang')->result();

		if ($id !== null) {
			// Jika ada ID tertentu, ambil hanya barang tersebut
			$barangs = $CI->db->get_where('tb_barang', ['id_brg' => $id])->result();
		}

		if (empty($barangs)) {
			return; // Tidak ada barang untuk diproses
		}

		if (!$newHpp) {
			foreach ($barangs as $barang) {
				$id_brg = $barang->id_brg;
				$stok_tersisa = $barang->stock_brg;
				$markup = $barang->markup_barang;
				$ppn = $barang->ppn_barang;
	
				if ($stok_tersisa <= 0) continue;
	
				// Ambil semua riwayat masuk (FIFO)
				$riwayat = $CI->db->query("
					SELECT 
						harga_masuk,
						stock_sesudah - stock_sebelum AS jumlah_masuk
					FROM tb_riwayat_stock
					WHERE id_brg = ? 
						AND jenis_transaksi IN ('stock_awal', 'stock_masuk')
						AND jumlah_riwayat > 0
					ORDER BY tgl_riwayat_stock DESC
				", array($id_brg))->result();
	
				$sisa_stok = $stok_tersisa;
				$total_harga = 0;
	
				foreach ($riwayat as $r) {
					$qty = $r->jumlah_masuk;
	
					if ($qty <= 0) continue;
	
					if ($sisa_stok >= $qty) {
						$total_harga += $qty * $r->harga_masuk;
						$sisa_stok -= $qty;
					} else {
						$total_harga += $sisa_stok * $r->harga_masuk;
						$sisa_stok = 0;
						break;
					}
				}
	
				// Cegah bagi nol
				// if ($stok_tersisa > 0) {
				// 	$hpp_fifo = round($total_harga / $stok_tersisa);
				// } else {
				// }
				
				$hpp_fifo = $barang->hpp_barang;
				// Update ke tb_barang
				$harga_jual = calculate_harga_jual($hpp_fifo, $markup, $ppn);
	
				$CI->db->where('id_brg', $id_brg)->update('tb_barang', [
					'hpp_barang' => $hpp_fifo,
					'harga_jual_barang' => $harga_jual,
				]);
			}
		}else{
			// Jika ada HPP baru, update semua barang dengan HPP tersebut
			foreach ($barangs as $barang) {
				$id_brg = $barang->id_brg;
				$stok_tersisa = $barang->stock_brg;
				$markup = $barang->markup_barang;
				$ppn = $barang->ppn_barang;

				if ($stok_tersisa <= 0) continue;

				$harga_jual = calculate_harga_jual($newHpp, $markup, $ppn);

				$CI->db->where('id_brg', $id_brg)->update('tb_barang', [
					'hpp_barang' => $newHpp,
					'harga_jual_barang' => $harga_jual,
				]);
			}
		}
	}
}

if (!function_exists('calculate_harga_jual')) {
	function calculate_harga_jual($hpp, $markup, $ppn)
	{
		if ($hpp <= 0) return 0; // Hindari error divide by zero

		// Hitung harga jual dasar (belum dibulatkan)
		$harga = $hpp * (1 + $markup / 100);

		// Tambah PPN jika perlu
		if ($ppn === "Y") {
			$harga *= 1.10; // Tambahkan 10%
		}

		// Tentukan pembulatan berdasarkan harga akhir
		if ($harga < 100) {
			$pembulatan = 10;
		} elseif ($harga < 1000) {
			$pembulatan = 50;
		} elseif ($harga < 10000) {
			$pembulatan = 100;
		} else {
			$pembulatan = 500;
		}

		return roundToNearest($harga, $pembulatan);
	}
}


if (!function_exists('get_hpp_fifo')) {
    function get_hpp_fifo($id_brg)
    {
        static $hpp_cache = [];

        // Gunakan cache jika sudah ada
        if (isset($hpp_cache[$id_brg])) {
            return $hpp_cache[$id_brg];
        }

        $CI =& get_instance();

        // Ambil stok saat ini dari tb_barang
        $barang = $CI->db->get_where('tb_barang', ['id_brg' => $id_brg])->row();
        if (!$barang || $barang->stock_brg <= 0) {
            $hpp_cache[$id_brg] = 0;
            return 0;
        }

        $stok_tersisa = $barang->stock_brg;

        // Ambil semua riwayat masuk yang valid
        $riwayat = $CI->db->query("
            SELECT 
                harga_masuk,
                stock_sesudah - stock_sebelum AS jumlah_masuk
            FROM tb_riwayat_stock
            WHERE id_brg = ? 
                AND jenis_transaksi IN ('stock_awal', 'stock_masuk')
                AND jumlah_riwayat > 0
            ORDER BY tgl_riwayat_stock DESC
        ", array($id_brg))->result();

        $total_harga = 0;
        $sisa_stok = $stok_tersisa;

        foreach ($riwayat as $r) {
            $qty = $r->jumlah_masuk;

            if ($qty <= 0) continue;

            if ($sisa_stok >= $qty) {
                $total_harga += $qty * $r->harga_masuk;
                $sisa_stok -= $qty;
            } else {
                $total_harga += $sisa_stok * $r->harga_masuk;
                break;
            }
        }

        $hpp = ($stok_tersisa > 0) ? round($total_harga / $stok_tersisa) : 0;

        // Simpan ke cache lokal
        $hpp_cache[$id_brg] = $hpp;
        return $hpp;
    }
}
