<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('generate_nomor_pesanan')) {
	/**
	 * Generate nomor pesanan otomatis berdasarkan tanggal, bulan, tahun, dan nomor urut.
	 * Akan mengecek keunikan ID sebelum mengembalikan hasil.
	 *
	 * @return string Nomor pesanan yang dihasilkan.
	 */
	function generate_nomor_pesanan()
	{
		$CI = &get_instance();
		$CI->load->database();

		$tanggal = date('d');
		$bulan = date('m');
		$tahun = date('Y');
		$tahun_nilai = date('y');

		// Dapatkan jumlah transaksi sebagai base nomor urut awal
		$CI->db->select('COUNT(id_pesanan) as jumlah_transaksi');
		$CI->db->where('DAY(tgl_pesanan)', $tanggal);
		$CI->db->where('MONTH(tgl_pesanan)', $bulan);
		$CI->db->where('YEAR(tgl_pesanan)', $tahun);
		$result = $CI->db->get('tb_pesanan')->row_array();

		$urut = isset($result['jumlah_transaksi']) ? (int) $result['jumlah_transaksi'] + 1 : 1;

		// Loop hingga ID unik ditemukan
		do {
			$nomor_urut = str_pad($urut, 4, '0', STR_PAD_LEFT);
			$nomor_pesanan = $tanggal . $bulan . $tahun_nilai . $nomor_urut;

			// Cek apakah id_pesanan ini sudah ada
			$CI->db->where('id_pesanan', $nomor_pesanan);
			$exists = $CI->db->get('tb_pesanan')->num_rows() > 0;

			$urut++; // increment jika ID sudah ada
		} while ($exists);

		return $nomor_pesanan;
	}
}
