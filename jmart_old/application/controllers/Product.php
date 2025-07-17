<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Product extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->load->library('session');
		$this->load->model('M_Crud');
		$this->load->model('Datatable_model');
		$this->load->model('M_Penjualan');
		$this->auth->cek_login();
		$this->load->helper('custom');
	}

	public function export()
	{
		$stock_filter = $this->input->post('stock_filter');

		// Membuat objek Spreadsheet baru
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// Mengatur filter stock pada baris pertama
		$sheet->setCellValue('A1', 'Filter Stock: ');
		if (empty($stock_filter)) {
			$sheet->setCellValue('B1', 'Semua Stok');
		} elseif ($stock_filter === 'down') {
			$sheet->setCellValue('B1', 'Stok Kurang dari 10');
		} elseif ($stock_filter === 'up') {
			$sheet->setCellValue('B1', 'Stok Lebih dari atau Sama dengan 10');
		}

		// Mengatur header kolom pada baris ketiga
		$sheet->setCellValue('A2', 'No');
		$sheet->setCellValue('B2', 'Toko');
		$sheet->setCellValue('C2', 'Produk');
		$sheet->setCellValue('D2', 'Barcode');
		$sheet->setCellValue('E2', 'Kategori Produk');
		$sheet->setCellValue('F2', 'Pemasok');
		$sheet->setCellValue('G2', 'Harga Perolehan');
		$sheet->setCellValue('H2', 'Margin');
		$sheet->setCellValue('I2', 'Harga');
		$sheet->setCellValue('J2', 'Stok');
		$sheet->setCellValue('K2', 'Satuan');
		$sheet->setCellValue('L2', 'Gambar Barang');

		// Mengambil data dari database
		if (empty($stock_filter)) {
			$this->db->select('*, nama_kategori_brg, nama_supplier, nama_satuan');
			$this->db->from('tb_barang');
			$this->db->join('tb_kategori', 'tb_barang.id_kategori_brg = tb_kategori.id_kategori_brg', 'left');
			$this->db->join('tb_supplier', 'tb_barang.id_supplier = tb_supplier.id_supplier', 'left');
			$this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
			$data = $this->db->get()->result_array();
		} elseif ($stock_filter === 'down') {
			$this->db->select('*, nama_kategori_brg, nama_supplier, nama_satuan');
			$this->db->from('tb_barang');
			$this->db->join('tb_kategori', 'tb_barang.id_kategori_brg = tb_kategori.id_kategori_brg', 'left');
			$this->db->join('tb_supplier', 'tb_barang.id_supplier = tb_supplier.id_supplier', 'left');
			$this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
			$this->db->where('stock_brg <', 10);
			$data = $this->db->get()->result_array();
		} elseif ($stock_filter === 'up') {
			$this->db->select('*, nama_kategori_brg, nama_supplier, nama_satuan');
			$this->db->from('tb_barang');
			$this->db->join('tb_kategori', 'tb_barang.id_kategori_brg = tb_kategori.id_kategori_brg', 'left');
			$this->db->join('tb_supplier', 'tb_barang.id_supplier = tb_supplier.id_supplier', 'left');
			$this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
			$this->db->where('stock_brg >=', 10);
			$data = $this->db->get()->result_array();
		}

		// Mengisi data ke dalam spreadsheet
		$row = 3; // Mulai dari baris keempat
		$no = 1;
		foreach ($data as $d) {
			$sheet->setCellValue('A' . $row, $no++);
			$sheet->setCellValue('B' . $row, 'Semua Toko');
			$sheet->setCellValue('C' . $row, $d['nama_barang']);
			$sheet->setCellValue('D' . $row, $d['barcode']);
			$sheet->setCellValue('E' . $row, $d['nama_kategori_brg']);
			$sheet->setCellValue('F' . $row, $d['nama_supplier']);
			$sheet->setCellValue('G' . $row, $d['hpp_barang']);
			$sheet->setCellValue('H' . $row, $d['markup_barang']);
			$sheet->setCellValue('I' . $row, $d['harga_jual_barang']);
			$sheet->setCellValue('J' . $row, $d['stock_brg']);
			$sheet->setCellValue('K' . $row, $d['nama_satuan']);
			$sheet->setCellValue('L' . $row, $d['gambar_barang']);
			$row++;
		}

		$headerStyle = [
			'font' => [
				'bold' => true,
			],
			'alignment' => [
				'horizontal' => 'center',
				'vertical' => 'center',
			],
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
		$dataStyle = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
		$sheet->getStyle('A2:L2')->applyFromArray($headerStyle);
		$sheet->getStyle('A3:L' . ($row - 1))->applyFromArray($dataStyle);

		// Mengatur autosize untuk kolom
		for ($col = 'A'; $col !== 'M'; $col++) {
			$sheet->getColumnDimension($col)->setAutoSize(true);
		}

		// Mengatur judul file Excel
		$fileName = 'data_barang_' . date('Ymd') . '.xlsx';

		// Mengatur header untuk mengunduh file
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $fileName . '"');
		header('Cache-Control: max-age=0');

		// Mengunduh file Excel
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
	}

	public function stockintegrasi_json()
	{
		$id = $this->input->post('id');
		$tipe = $this->input->post('filter');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$columns = '*';
		$filter = array('jenis_transaksi', 'keterangan_riwayat_stock'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array();

		$where = "id_brg =" . $id;
		$order = ['tgl_riwayat_stock', 'DESC'];

		if ($tipe || $bulan || $tahun) {
			// Tambahkan spasi sebelum menambahkan kondisi tambahan ke $where
			$where .= " ";

			if ($tipe) {
				$where .= " AND jenis_transaksi = '" . $tipe . "'";
			}

			// Periksa apakah $bulan tidak kosong
			if ($bulan !== "00") {
				// Buat format bulan dengan dua digit (01-12)
				$bulan_format = str_pad($bulan, 2, '0', STR_PAD_LEFT);
				$where .= " AND MONTH(tgl_riwayat_stock) = '" . $bulan_format . "'";
			}

			if ($tahun) {
				$where .= " AND YEAR(tgl_riwayat_stock) = '" . $tahun . "'";
			}
		}

		$list = $this->Datatable_model->get_data('tb_riwayat_stock', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'), $order);
		// var_dump($this->db->last_query());

		$data = array();
		$no = $_POST['start'];

		foreach ($list->result() as $stock) {
			$no++;

			// Default tipe dan warna badge
			$jenis_transaksi_label = ucwords(str_replace('_', ' ', $stock->jenis_transaksi));
			$badge_colors = [
				'stock_awal' => 'primary text-white',
				'stock_masuk' => 'success text-white',
				'stock_keluar' => 'danger text-white',
				'stock_rusak' => 'warning text-white',
				'stock_opname' => 'info text-white',
			];

			// Default warna jika tidak dikenal
			$badge_color = isset($badge_colors[$stock->jenis_transaksi]) ? $badge_colors[$stock->jenis_transaksi] : 'secondary text-white';

			// Cek jika ini adalah riwayat perubahan HPP (jumlah = 0 dan jenis = stock_awal)
			if ($stock->jumlah_riwayat == 0 && $stock->jenis_transaksi == 'stock_awal') {
				$jenis_transaksi_label = 'Perubahan HPP';
				$badge_color = 'dark text-white'; // beda warna, misalnya abu-abu gelap
			}

			$row = array(
				$no,
				$stock->keterangan_riwayat_stock,
				date('d/M/Y H:i:s', strtotime($stock->tgl_riwayat_stock)),
				number_format($stock->jumlah_riwayat),
				'<span class="badge bg-' . $badge_color . '">' . $jenis_transaksi_label . '</span>',
				$stock->stock_sebelum,
				$stock->stock_sesudah,
				number_format($stock->harga_masuk, 0, ',', '.'),
			);

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_riwayat_stock', $where),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_riwayat_stock', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $order), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function export_stockintegrasi_excel()
	{
		$id = $this->input->get('id');
		$tipe = $this->input->get('filter');
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');

		// Ambil nama barang berdasarkan ID
		$this->load->model('Datatable_model'); // Load model jika belum
		$barang = $this->db->get_where('tb_barang', ['id_brg' => $id])->row();

		if (!$barang) {
			show_error('Barang tidak ditemukan.', 404);
		}

		$nama_barang = $barang->nama_barang;

		$columns = '*';
		$filter = array('jenis_transaksi', 'keterangan_riwayat_stock');
		$joins = array();
		$where = "id_brg = $id";
		$order = ['tgl_riwayat_stock', 'DESC'];

		if ($tipe || $bulan || $tahun) {
			$where .= " ";
			if ($tipe) {
				$where .= " AND jenis_transaksi = '" . $tipe . "'";
			}
			if ($bulan !== "00") {
				$bulan_format = str_pad($bulan, 2, '0', STR_PAD_LEFT);
				$where .= " AND MONTH(tgl_riwayat_stock) = '" . $bulan_format . "'";
			}
			if ($tahun) {
				$where .= " AND YEAR(tgl_riwayat_stock) = '" . $tahun . "'";
			}
		}

		$list = $this->Datatable_model->get_data('tb_riwayat_stock', $columns, $joins, $filter, '', $where, 0, 1000, $order);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// Set header columns
		$sheet->setCellValue('A1', 'No');
		$sheet->setCellValue('B1', 'Keterangan');
		$sheet->setCellValue('C1', 'Tanggal Riwayat');
		$sheet->setCellValue('D1', 'Jumlah');
		$sheet->setCellValue('E1', 'Jenis Transaksi');
		$sheet->setCellValue('F1', 'Stock Sebelum');
		$sheet->setCellValue('G1', 'Stock Sesudah');

		// Apply auto-size for columns
		foreach (range('A', 'G') as $col) {
			$sheet->getColumnDimension($col)->setAutoSize(true);
		}

		// Apply border to header cells
		$headerBorder = [
			'borders' => [
				'allBorders' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
					'color' => ['argb' => '000000'],
				],
			],
		];
		$sheet->getStyle('A1:G1')->applyFromArray($headerBorder);

		$no = 1;
		$row = 2;
		foreach ($list->result() as $stock) {
			// Fill in data
			$sheet->setCellValue('A' . $row, $no);
			$sheet->setCellValue('B' . $row, $stock->keterangan_riwayat_stock);
			$sheet->setCellValue('C' . $row, date('d/M/Y H:i:s', strtotime($stock->tgl_riwayat_stock)));
			$sheet->setCellValue('D' . $row, $stock->jumlah_riwayat);
			$sheet->setCellValue('E' . $row, ucwords(str_replace('_', ' ', $stock->jenis_transaksi)));
			$sheet->setCellValue('F' . $row, $stock->stock_sebelum);
			$sheet->setCellValue('G' . $row, $stock->stock_sesudah);

			// Apply border to data cells
			$dataBorder = [
				'borders' => [
					'allBorders' => [
						'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
						'color' => ['argb' => '000000'],
					],
				],
			];
			$sheet->getStyle('A' . $row . ':G' . $row)->applyFromArray($dataBorder);

			$no++;
			$row++;
		}

		// Gunakan nama barang dalam nama file
		$filename = 'Stock_Integrasi_' . str_replace(' ', '_', $nama_barang) . '_' . date('Ymd_His') . '.xlsx';

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . $filename . '"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}



	public function opname()
	{
		$this->load->view('level/admin/product_opname');
	}

	public function json_opname()
	{
		$nama = $this->input->post('nama');
		$tgl = $this->input->post('tgl');
		$status = $this->input->post('status');
		$offon = $this->input->post('offon');

		$columns = 'tb_opname.*';
		$filter = array('nama_opname', 'catatan_opname'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array();

		$where = null;
		if ($nama || $tgl || $status || $offon !== null && $offon !== '') {
			$where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

			if ($nama) {
				$where .= " AND tb_opname.nama_opname LIKE '%" . $nama . "%'";
			}

			if ($tgl) {
				$where .= " AND DATE(tgl_opname) = '" . $tgl . "'";
			}

			if ($status) {
				$where .= " AND tipe_opname = '" . $status . "'";
			}

			if ($offon !== null && $offon !== '') {
				$where .= " AND status_opname = '" . $offon . "'";
			}
		}

		$list = $this->Datatable_model->get_data('tb_opname', $columns, $joins, $filter, $this->input->post('search')['value'], $where, null, null, ['tgl_opname', 'DESC']);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $opname) {
			if ($opname->tipe_opname == "Spoil / Barang Rusak") {
				$check = $this->M_Crud->all_data('tb_opname_rusak')->where('id_opname', $opname->id_opname)->get()->num_rows();
			} else {
				$check = $this->M_Crud->all_data('tb_opname_fisik')->where('id_opname', $opname->id_opname)->get()->num_rows();
			}

			if ($opname->status_opname == "0") {
				$status = "";
			} else {
				$status = "disabled";
			}

			if ($opname->status_opname == "0") {
				$status_badge = '<span class="badge bg-success-lt">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(0, 255, 0, 1);transform: ;msFilter:;"><path d="M12 2C9.243 2 7 4.243 7 7v3H6c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zm6 10 .002 8H6v-8h12zm-9-2V7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9z"></path></svg>
                    Terbuka
                </span>';
			} else {
				$status_badge = '<span class="badge bg-danger-lt">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(255, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2C9.243 2 7 4.243 7 7v3H6c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-8c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5zm6 10 .002 8H6v-8h12zm-9-2V7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9z"></path></svg>
                    Terkunci
                </span>';
			}

			$no++;
			$row = array(
				$no,
				$opname->nama_opname . "<br><small>" . $opname->catatan_opname . "</small>",
				date('d/M/Y H:i:s', strtotime($opname->tgl_opname)),
				$opname->tipe_opname == "Spoil / Barang Rusak" ? "Spoil / Barang Rusak" : "Stock Opname",
				$check,
				$status_badge,
				'
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-secondary text-uppercase dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-dots-vertical" width="14" height="14" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
						<path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
						<path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
						<path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
					</svg>
					Aksi&nbsp;
					</button>
					<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item" href="' . base_url('product/opname/detail/' . $opname->id_opname) . '">&nbsp;Lihat Data</a></li>
                        <li><a class="dropdown-item ' . $status . '" href="' . base_url('product/opname/ubah/' . $opname->id_opname) . '">&nbsp;Ubah Data</a></li>
                        <li><a class="dropdown-item ' . $status . '" href="javascript:void(0);" onclick="confirmDelete(' . $opname->id_opname . ');">&nbsp;Hapus Data</a></li>
					</ul>
				</div>
				',
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_opname'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_opname', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function json_temp_fisik()
	{
		$columns = 'tb_opname_fisik.*, tb_barang.*,tb_kategori.nama_kategori_brg';
		$filter = array('nama_barang');
		$joins = array(
			array(
				'table' => 'tb_barang',
				'condition' => 'tb_barang.id_brg = tb_opname_fisik.id_brg',
				'type' => 'inner'
			),
			array(
				'table' => 'tb_kategori',
				'condition' => 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg',
				'type' => 'inner'
			),
		);
		$id_opname = $this->input->post('id_opname');
		if ($id_opname) {
			$where = "id_opname LIKE '%" . $id_opname . "%'";
		}

		$list = $this->Datatable_model->get_data('tb_opname_fisik', $columns, $joins, $filter, $this->input->post('search')['value'], $where, null, null, ['id_opname_fisik', 'DESC']);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $product) {
			$no++;
			$row = array(
				$product->id_opname_fisik,
				$product->nama_barang,
				$product->barcode,
				$product->nama_kategori_brg,
				$product->stock_brg,
				$product->stock_fisik,
				"
                <a href=\"javascript:void(0);\" onclick=\"hapusData($product->id_opname_fisik);\">
                    <i class=\"fa fa-times text-danger\"></i>
                </a>
                ",
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_opname_fisik'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_opname_fisik', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function json_temp_rusak()
	{
		$columns = 'tb_opname_rusak.*, tb_barang.*,tb_kategori.nama_kategori_brg';
		$filter = array('nama_barang');
		$joins = array(
			array(
				'table' => 'tb_barang',
				'condition' => 'tb_barang.id_brg = tb_opname_rusak.id_brg',
				'type' => 'inner'
			),
			array(
				'table' => 'tb_kategori',
				'condition' => 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg',
				'type' => 'inner'
			),
		);

		$id_opname = $this->input->post('id_opname');
		if ($id_opname) {
			$where = "id_opname LIKE '%" . $id_opname . "%'";
		}

		$list = $this->Datatable_model->get_data('tb_opname_rusak', $columns, $joins, $filter, $this->input->post('search')['value'], $where, null, null, ['id_opname_rusak', 'DESC']);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $product) {
			$no++;
			$row = array(
				$product->id_opname_rusak,
				$product->nama_barang,
				$product->barcode,
				$product->nama_kategori_brg,
				$product->stock_brg,
				$product->jumlah_rusak,
				"
                <a href=\"javascript:void(0);\" onclick=\"hapusData($product->id_opname_rusak);\">
                    <i class=\"fa fa-times text-danger\"></i>
                </a>
                ",
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_opname_rusak'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_opname_rusak', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function update_temp_fisik()
	{
		$id = $this->input->post('id_opname');
		$jumlah = $this->input->post('stock_fisik');
		$this->M_Crud->update_data(['id_opname_fisik' => $id], [
			'stock_fisik' => $jumlah
		], 'tb_opname_fisik');
		$response = array(
			'status' => 'success',
			'message' => 'Stock Fisik Berhasil Diperbarui'
		);
		echo json_encode($response);
	}

	public function update_temp_rusak()
	{
		$id = $this->input->post('id_opname');
		$jumlah = $this->input->post('stock_rusak');
		$this->M_Crud->update_data(['id_opname_rusak' => $id], [
			'jumlah_rusak' => $jumlah
		], 'tb_opname_rusak');
		$response = array(
			'status' => 'success',
			'message' => 'Stock Fisik Berhasil Diperbarui'
		);
		echo json_encode($response);
	}

	public function delete_temp_fisik($id)
	{
		$this->M_Crud->hapus_data(['id_opname_fisik' => $id], 'tb_opname_fisik');
		return true;
	}

	public function delete_temp_spoil($id)
	{
		$this->M_Crud->hapus_data(['id_opname_rusak' => $id], 'tb_opname_rusak');
		return true;
	}

	public function input_fisik()
	{
		$id_opname = $this->input->post('id_opname');
		$id = $this->input->post('id');
		try {
			$check = $this->M_Crud->all_data('tb_opname_fisik')->where('id_opname', $id_opname)->where('id_brg', $id)->count_all_results();
			$barang = $this->M_Crud->show('tb_barang', ['id_brg' => $id])->row_array();

			if ($check >= 1) {
				$response = array(
					'success' => false,
					'msg' => "Barang Sudah discan",
				);
			} else {
				$result = $this->M_Crud->input_data([
					'id_opname' => $id_opname,
					'id_brg' => $id,
					'harga_saat_ini' => $barang['harga_jual_barang'],
					'stock_aplikasi' => $barang['stock_brg'],
					'stock_fisik' => NULL
				], 'tb_opname_fisik');
				$response = array(
					'success' => true,
					'msg' => "Scan Berhasil",
				);
			}
		} catch (Exception $e) {
			$response = array(
				'success' => false,
				'msg' => "Gagal",
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function input_rusak()
	{
		$id_opname = $this->input->post('id_opname');
		$id = $this->input->post('id');
		try {
			$check = $this->M_Crud->all_data('tb_opname_rusak')->where('id_opname', $id_opname)->where('id_brg', $id)->count_all_results();
			$barang = $this->M_Crud->show('tb_barang', ['id_brg' => $id])->row_array();

			if ($check >= 1) {
				$response = array(
					'success' => false,
					'msg' => "Barang Sudah discan",
				);
			} else {
				$result = $this->M_Crud->input_data([
					'id_opname' => $id_opname,
					'id_brg' => $id,
					'harga_saat_ini' => $barang['harga_jual_barang'],
					'stock_aplikasi' => $barang['stock_brg'],
					'jumlah_rusak' => NULL,
					'stock_fisik' => NULL
				], 'tb_opname_rusak');
				$response = array(
					'success' => true,
					'msg' => "Scan Berhasil",
				);
			}
		} catch (Exception $e) {
			$response = array(
				'success' => false,
				'msg' => "Gagal",
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function tambah_opname()
	{
		$this->load->view('level/admin/product_opname_tambah');
	}

	public function simpan_opname()
	{
		$data = [
			'nama_opname' => $this->input->post('nama_opname'),
			'tgl_opname' => $this->input->post('tgl_opname'),
			'tipe_opname' => $this->input->post('tipe_opname'),
			'status_opname' => '0',
			'catatan_opname' => $this->input->post('catatan_opname'),
			'created_at' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('id_user')
		];

		$this->M_Crud->input_data($data, 'tb_opname');
		$last_insert_id = $this->db->insert_id();

		redirect('product/opname/detail/' . $last_insert_id);
	}

	public function delete_opname($id)
	{
		$check = $this->M_Crud->show('tb_opname', ['id_opname' => $id])->row_array();
		if ($check['status_opname'] == "0") {
			if ($check['tipe_opname'] == "Stock Opname") {
				$this->db->from('tb_opname_fisik')->where('id_opname', $id)->delete();
			} else {
				$this->db->from('tb_opname_rusak')->where('id_opname', $id)->delete();
			}
			$this->db->from('tb_opname')->where('id_opname', $id)->delete();
			$response = array(
				'success' => true,
				'msg' => "Stock Opname Berhasil Dihapus",
			);
		} else {
			$response = array(
				'success' => false,
				'msg' => "Status Opname Telah Ditutup",
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function detail_opname($id)
	{
		$check = $this->M_Crud->show('tb_opname', ['id_opname' => $id])->row_array();
		$data['id'] = $id;
		$data['detail'] = $check;

		if ($check['status_opname'] == "0") {
			$data['open'] = true;
		} else {
			$data['open'] = false;
		}

		if ($check['tipe_opname'] == "Stock Opname") {
			$data['produk'] = $this->M_Crud->all_data('tb_opname_fisik')->join('tb_barang', 'tb_barang.id_brg = tb_opname_fisik.id_brg')->where('id_opname', $id)->get()->result_array();
			$this->load->view('level/admin/product_opname_detail_fisik', $data);
		} else {
			$data['produk'] = $this->M_Crud->all_data('tb_opname_rusak')->join('tb_barang', 'tb_barang.id_brg = tb_opname_rusak.id_brg')->where('id_opname', $id)->get()->result_array();
			$this->load->view('level/admin/product_opname_detail_spoil', $data);
		}
	}

	public function ubah_opname($id)
	{
		$check = $this->M_Crud->show('tb_opname', ['id_opname' => $id])->row_array();
		$data['id'] = $id;
		$data['detail'] = $check;

		if ($check['tipe_opname'] == "Stock Opname") {
			$this->load->view('level/admin/product_opname_ubah_fisik', $data);
		} else {
			$this->load->view('level/admin/product_opname_ubah_spoil', $data);
		}
	}

	public function simpan_fisik($id)
	{
		$check = $this->M_Crud->show('tb_opname', ['id_opname' => $id])->row_array();

		if ($check) {
			// UPDATE STATUS
			$this->M_Crud->update_data(['id_opname' => $id], ['status_opname' => '1'], 'tb_opname');
		}

		$data = $this->M_Crud->all_data('tb_opname_fisik')->where('id_opname', $id)->get()->result_array();

		foreach ($data as $key => $value) {
			// Ambil data barang SEBELUM update
			$barang = $this->M_Crud->show('tb_barang', ['id_brg' => $value['id_brg']])->row_array();
		
			$stock_sebelum = $barang['stock_brg'];
			$stock_sesudah = $value['stock_fisik'];
			$jumlah_riwayat = $stock_sesudah - $stock_sebelum;
		
			// Update stok
			$this->M_Crud->update_data(
				['id_brg' => $value['id_brg']],
				['stock_brg' => $stock_sesudah],
				'tb_barang'
			);
		
			// Catat riwayat
			$riwayat = [
				'id_brg' => $value['id_brg'],
				'tgl_riwayat_stock' => date('Y-m-d H:i:s'),
				'jumlah_riwayat' => $jumlah_riwayat,
				'jenis_transaksi' => 'stock_opname',
				'stock_sebelum' => $stock_sebelum,
				'stock_sesudah' => $stock_sesudah,
				'keterangan_riwayat_stock' => "Perubahan Stock Melalui Fitur Opname Fisik",
				'harga_masuk' => $barang['hpp_barang']
			];
			$this->M_Crud->input_data($riwayat, "tb_riwayat_stock");

			update_hpp_fifo_all_barang($value['id_brg']);
		}		
	}

	public function simpan_spoil($id)
	{
		$check = $this->M_Crud->show('tb_opname', ['id_opname' => $id])->row_array();

		if ($check) {
			// UPDATE STATUS
			$this->M_Crud->update_data(['id_opname' => $id], ['status_opname' => '1'], 'tb_opname');
		}

		$data = $this->M_Crud->all_data('tb_opname_rusak')->where('id_opname', $id)->get()->result_array();

		foreach ($data as $value) {
			$barang = $this->M_Crud->show('tb_barang', ['id_brg' => $value['id_brg']])->row_array();

			$stock_sebelum = $barang['stock_brg'];
			$jumlah_rusak = $value['jumlah_rusak'];

			// Hindari stok minus
			$jumlah_rusak = min($jumlah_rusak, $stock_sebelum);
			$stock_sesudah = $stock_sebelum - $jumlah_rusak;

			// Update stok barang
			$this->M_Crud->update_data(
				['id_brg' => $value['id_brg']],
				['stock_brg' => $stock_sesudah],
				'tb_barang'
			);

			// Simpan riwayat stock
			$riwayat = [
				'id_brg' => $value['id_brg'],
				'tgl_riwayat_stock' => date('Y-m-d H:i:s'),
				'jumlah_riwayat' => $jumlah_rusak,
				'jenis_transaksi' => 'stock_rusak',
				'stock_sebelum' => $stock_sebelum,
				'stock_sesudah' => $stock_sesudah,
				'keterangan_riwayat_stock' => "Pengurangan Stock Rusak Melalui Fitur Opname Spoil",
				'harga_masuk' => $barang['hpp_barang']
			];
			$this->M_Crud->input_data($riwayat, "tb_riwayat_stock");
			update_hpp_fifo_all_barang($value['id_brg']);
		}
	}

	public function index()
	{
		$data['total_produk'] = $this->M_Crud->count('tb_barang');
		$data['total_promo'] = $this->M_Crud->all_data('tb_barang')->where('promo_brg', 'On')->count_all_results();
		$data['total_alert'] = $this->M_Crud->all_data('tb_barang')->where('stock_brg <=', 5)->count_all_results();
		$data['total_nogambar'] = $this->M_Crud->all_data('tb_barang')->where('gambar_barang', 'default.png')->count_all_results();
		$data['kategori'] = $this->M_Crud->tampil_data('tb_kategori')->result_array();
		$data['satuan'] = $this->M_Crud->tampil_data('tb_satuan')->result_array();
		$data['supplier'] = $this->M_Crud->tampil_data('tb_supplier')->result_array();

		$this->load->view('level/admin/product_data', $data);
	}

	public function simpan()
	{
		// Mengambil data yang dikirimkan melalui POST
		$nama_produk = $this->input->post('nama_produk');
		$select_kategori = $this->input->post('select_kategori');
		$barcode = $this->input->post('barcode');
		$stock_brg = $this->input->post('stock_brg');
		$select_satuan = $this->input->post('select_satuan');
		$alert_quantity = $this->input->post('alert_quantity');
		$select_supplier = $this->input->post('select_supplier');
		$description = $this->input->post('description');
		$fileUpload = $this->input->post('fileUpload');
		$hpp = $this->input->post('hpp_barang');
		$markup_barang = $this->input->post('markup_barang');
		$ppn_barang = $this->input->post('ppn_barang');
		$harga_jual_barang = $this->input->post('total_jual');

		try {
			// Inisialisasi nama gambar dengan nama gambar default
			$nama_gambar = "default.png";

			// Pemeriksaan apakah ada gambar yang diunggah
			if (!empty($_FILES['fileUpload']['name'])) {
				// Konfigurasi upload gambar
				$config['upload_path'] = 'public/template/upload/barang/'; // Ganti dengan direktori tujuan yang Anda inginkan
				$config['allowed_types'] = 'jpg|jpeg|png|gif'; // Tipe file yang diizinkan
				$config['max_size'] = 2048; // Ukuran maksimum (dalam KB)

				$this->load->library('upload', $config);

				// Lakukan upload gambar
				if ($this->upload->do_upload('fileUpload')) {
					// Jika berhasil diunggah, Anda dapat mengakses informasi gambar dengan:
					$upload_data = $this->upload->data();
					$nama_gambar = $upload_data['file_name'];
				}
			}

			// Simpan data ke database menggunakan model Anda
			$data = array(
				'nama_barang' => $nama_produk,
				'id_kategori_brg' => $select_kategori,
				'id_supplier' => $select_supplier,
				'id_satuan' => $select_satuan,
				'barcode' => $barcode,
				'stock_brg' => $stock_brg,
				'alert_quantity' => $alert_quantity,
				'description' => $description,
				'hpp_barang' => $hpp,
				'markup_barang' => $markup_barang,
				'harga_jual_barang' => $harga_jual_barang,
				'gambar_barang' => $nama_gambar,
			);

			$this->M_Crud->input_data($data, 'tb_barang');

			// Input riwayat stock
			$riwayat = [
				'id_brg' => $this->db->insert_id(),
				'tgl_riwayat_stock' => date('Y-m-d H:i:s'),
				'jumlah_riwayat' => $stock_brg,
				'jenis_transaksi' => 'stock_awal',
				'stock_sebelum' => 0,
				'stock_sesudah' => $stock_brg,
				'keterangan_riwayat_stock' => "Penambahan Stock Awal Produk Baru",
				'harga_masuk' => $hpp // Jika sudah ada kolom harga_masuk
			];
			$this->M_Crud->input_data($riwayat, "tb_riwayat_stock");

			$this->session->set_flashdata('success_message', 'Produk berhasil ditambahkan.');
			redirect('product/tambah');
		} catch (Exception $e) {
			// Tangani kesalahan jika terjadi
			$this->session->set_flashdata('error_message', 'Gagal menambahkan produk: ' . $e->getMessage());
			redirect('product/tambah');
		}
	}

	public function update()
	{
		// Mengambil data yang dikirimkan melalui POST
		$id = $this->input->post('id_brg');
		$nama_produk = $this->input->post('nama_produk');
		$select_kategori = $this->input->post('select_kategori');
		$barcode = $this->input->post('barcode');
		$stock_brg = $this->input->post('stock_brg');
		$select_satuan = $this->input->post('select_satuan');
		$alert_quantity = $this->input->post('alert_quantity');
		$select_supplier = $this->input->post('select_supplier');
		$description = $this->input->post('description');
		$fileUpload = $this->input->post('fileUpload');
		$hpp = $this->input->post('hpp_barang');
		$markup_barang = $this->input->post('markup_barang');
		$ppn_barang = $this->input->post('ppn_barang');
		$harga_jual_barang = $this->input->post('total_jual');

		try {
			// Inisialisasi nama gambar dengan nama gambar default
			$nama_gambar = "default.png";

			// Pemeriksaan apakah ada gambar yang diunggah
			if (!empty($_FILES['fileUpload']['name'])) {
				// Konfigurasi upload gambar
				$config['upload_path'] = 'public/template/upload/barang/';
				$config['allowed_types'] = 'jpg|jpeg|png|gif'; // Tipe file yang diizinkan
				$config['max_size'] = 2048; // Ukuran maksimum (dalam KB)

				$this->load->library('upload', $config);

				// Lakukan upload gambar
				if ($this->upload->do_upload('fileUpload')) {
					// Jika berhasil diunggah, Anda dapat mengakses informasi gambar dengan:
					$upload_data = $this->upload->data();
					$nama_gambar = $upload_data['file_name'];
				}
			}

			// Simpan data ke database menggunakan model Anda
			$data = array(
				'nama_barang' => $nama_produk,
				'id_kategori_brg' => $select_kategori,
				'id_supplier' => $select_supplier,
				'id_satuan' => $select_satuan,
				'barcode' => $barcode,
				// 'stock_brg' => $stock_brg,
				'alert_quantity' => $alert_quantity,
				'description' => $description,
				'hpp_barang' => $hpp,
				'markup_barang' => $markup_barang,
				'harga_jual_barang' => $harga_jual_barang,
				'gambar_barang' => $nama_gambar,
			);

			$barang = $this->M_Crud->show('tb_barang', ['id_brg' => $id])->row_array();
			$prev_hpp_barang = $barang['hpp_barang'];
			$stock_brg_sebelum = $barang['stock_brg'];

			// Update ke tb_barang
			$this->M_Crud->update_data(['id_brg' => $id], $data, 'tb_barang');

			// Jika HPP berubah, catat ke riwayat
			if ($prev_hpp_barang != $hpp) {
				$riwayat = [
					'id_brg' => $id,
					'tgl_riwayat_stock' => date('Y-m-d H:i:s'),
					'jumlah_riwayat' => 0, // Tidak ada penambahan/pengurangan stok
					'jenis_transaksi' => 'stock_awal', // Disarankan tambahkan enum ini
					'stock_sebelum' => $stock_brg_sebelum,
					'stock_sesudah' => $stock_brg_sebelum, // Karena stok tidak berubah
					'keterangan_riwayat_stock' => "Perubahan HPP Barang melalui edit produk dari Rp. " . number_format($prev_hpp_barang, 0, ',', '.') . " menjadi Rp. " . number_format($hpp, 0, ',', '.'),
					'harga_masuk' => $hpp // Jika sudah ada kolom harga_masuk
				];
				$this->M_Crud->input_data($riwayat, "tb_riwayat_stock");
			}

			$this->session->set_flashdata('success_message', 'Produk berhasil diubah.');
			redirect('product');
		} catch (Exception $e) {
			// Tangani kesalahan jika terjadi
			$this->session->set_flashdata('error_message', 'Gagal menambahkan produk: ' . $e->getMessage());
			redirect('product');
		}
	}

	public function edit($id)
	{
		$data['barang'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->join('tb_supplier', 'tb_supplier.id_supplier = tb_barang.id_supplier', 'left')->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')->where('tb_barang.id_brg', $id)->get()->row_array();
		$data['kategori'] = $this->M_Crud->tampil_data('tb_kategori')->result_array();
		$data['satuan'] = $this->M_Crud->tampil_data('tb_satuan')->result_array();
		$data['supplier'] = $this->M_Crud->tampil_data('tb_supplier')->result_array();
		$this->load->view('level/admin/product_edit', $data);
	}

	public function simpan_import()
	{
		$user = $this->session->userdata('id_user');
		$path = $this->input->post('path_absolute');

		$file = $_FILES['file_excel'];
		$file_size = $_FILES['file_excel']['size'];
		$file_size_kb = $file_size / 1024;

		$file_name = $file['name'];

		if (round($file_size_kb, 2) > 2048) {
			$this->session->set_flashdata('error_message', 'Ukuran file tidak boleh lebih dari 2 MB.');
			redirect(site_url("product/import"));
		}

		$ext = pathinfo($file_name, PATHINFO_EXTENSION);

		$file_path = $file['tmp_name'];

		if ($ext == "xls") {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else if ($ext == "xlsx") {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		} else if ($ext == "csv") {
			$render = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else {
			$this->session->set_flashdata('error_message', 'Format yang diizinkan adalah Xls, Xlsx, dan Csv saja!!');
			redirect(site_url("product/import"));
		}

		$spreadsheet = $render->load($file_path);
		$sheet = $spreadsheet->getActiveSheet()->toArray(null, false, false, false);

		$prevRow = []; // Baris sebelumnya (untuk mengisi sel kosong)
		$data_error = [];

		if (count($sheet) <= 1) {
			$this->session->set_flashdata('error_message', 'Data Kosong. Minimal satu data untuk melanjutkan proses!!');
			redirect(site_url("product/import"));
		} else {
			$jumlaherror = 0;
			$jumlahsukses = 0;

			foreach ($sheet as $x => $excel) {
				if ($x == 0) continue; // Skip header

				// Lengkapi sel kosong dari baris sebelumnya
				foreach ($excel as $colIndex => $val) {
					if (($val === null || $val === '') && isset($prevRow[$colIndex])) {
						$excel[$colIndex] = $prevRow[$colIndex];
					}
				}
				$prevRow = $excel;

				// Pastikan semua index ada (hindari undefined offset)
				for ($i = 0; $i <= 11; $i++) {
					if (!isset($excel[$i])) $excel[$i] = null;
				}

				$errorReason = [];

				// Validasi kolom penting
				if (empty($excel[2])) $errorReason[] = "Nama barang kosong";
				if (empty($excel[3])) $errorReason[] = "Barcode kosong";

				// Cek barang sudah ada
				$cek_barang = $this->M_Crud->all_data('tb_barang')->where('nama_barang', $excel[2])->where('barcode', $excel[3])->get()->row_array();
				if ($cek_barang) $errorReason[] = "Barang dengan nama dan barcode tersebut sudah ada";

				if (!empty($errorReason)) {
					$jumlaherror++;
					// Tambahkan alasan error di kolom terakhir
					$excel['error_reason'] = implode(", ", $errorReason);
					$data_error[] = $excel;
					continue;
				}

				// Cek kategori
				$cek_kategori = $this->M_Crud->all_data('tb_kategori')->where('nama_kategori_brg', $excel[4])->get()->row_array();
				if ($cek_kategori) {
					$kategori = $cek_kategori['id_kategori_brg'];
				} else {
					if ($excel[4] != NULL) {
						$this->M_Crud->input_data(['nama_kategori_brg' => $excel[4]], 'tb_kategori');
						$kategori = $this->db->insert_id();
					} else {
						$kategori = NULL;
					}
				}

				// Cek supplier
				$cek_supplier = $this->M_Crud->all_data('tb_supplier')->where('nama_supplier', $excel[5])->get()->row_array();
				if ($cek_supplier) {
					$supplier = $cek_supplier['id_supplier'];
				} else {
					if ($excel[5] != NULL) {
						$this->M_Crud->input_data(['nama_supplier' => $excel[5]], 'tb_supplier');
						$supplier = $this->db->insert_id();
					} else {
						$supplier = NULL;
					}
				}

				// Cek satuan
				$cek_satuan = $this->M_Crud->all_data('tb_satuan')->where('nama_satuan', $excel[10])->get()->row_array();
				if ($cek_satuan) {
					$satuan = $cek_satuan['id_satuan'];
				} else {
					if ($excel[10] != NULL) {
						$this->M_Crud->input_data(['nama_satuan' => $excel[10]], 'tb_satuan');
						$satuan = $this->db->insert_id();
					} else {
						$satuan = NULL;
					}
				}

				// Cek gambar
				$lokasi_gambar_asal = $excel[11];
				$path = ''; // Pastikan $path didefinisikan sesuai lokasi file
				if (!file_exists($path . $lokasi_gambar_asal)) {
					$gambar = 'default.png';
				} else {
					if ($lokasi_gambar_asal != "") {
						$ekstensi = pathinfo($lokasi_gambar_asal, PATHINFO_EXTENSION);
						$nama_acak = uniqid() . '.' . $ekstensi;
						$lokasi_gambar_tujuan = FCPATH . 'public/template/upload/barang/' . $nama_acak;

						if (file_exists($path . substr($lokasi_gambar_asal, 2))) {
							if (copy($lokasi_gambar_asal, $lokasi_gambar_tujuan)) {
								$gambar = $nama_acak;
							} else {
								$gambar = 'default.png';
							}
						} else {
							$gambar = 'default.png';
						}
					} else {
						$gambar = "default.png";
					}
				}

				// Simpan data barang
				$data = [
					"nama_barang" => $excel[2],
					"barcode" => $excel[3],
					"id_kategori_brg" => $kategori,
					"id_satuan" => $satuan,
					"id_supplier" => $supplier,
					"hpp_barang" => $excel[6],
					"markup_barang" => $excel[7],
					"harga_jual_barang" => $excel[8],
					"stock_brg" => (int) $excel[9],
					"gambar_barang" => $gambar
				];
				$this->M_Crud->input_data($data, "tb_barang");
				$id = $this->db->insert_id();
				$jumlahsukses++;

				// Input riwayat stock
				$riwayat = [
					'id_brg' => $id,
					'tgl_riwayat_stock' => date('Y-m-d H:i:s'),
					'jumlah_riwayat' => (int) $excel[9],
					'jenis_transaksi' => 'stock_awal',
					'stock_sebelum' => 0,
					'stock_sesudah' => (int) $excel[9],
					'harga_masuk' => $excel[6],
					'keterangan_riwayat_stock' => "Penambahan Melalui Fitur Import Barang"
				];
				$this->M_Crud->input_data($riwayat, "tb_riwayat_stock");
			}
			
			// update_hpp_fifo_all_barang();

			$this->session->set_flashdata('error_rows', $data_error);
			$this->session->set_flashdata('success_message', "$jumlaherror Data Tidak Bisa Disimpan <br> $jumlahsukses Data Berhasil Disimpan");
			redirect(site_url("product/import"));
		}
	}

	public function simpan_gambar()
	{
		$config['upload_path'] = FCPATH . 'public/template/upload/barang/';
		$config['allowed_types'] = 'jpg|jpeg';
		$config['max_size'] = '1024'; // 10MB, sesuaikan dengan kebutuhan
		$config['encrypt_name'] = false; // Nonaktifkan enkripsi nama file

		$this->load->library('upload', $config);

		// Tangani multiple uploads
		$files = $_FILES['imageInput'];

		// Tentukan variabel untuk menyimpan nama-nama file yang berhasil diupload
		$uploaded_files = array();

		// Loop melalui setiap file
		foreach ($files['name'] as $key => $name) {
			$directory = FCPATH . 'public/template/upload/barang/';
			if (file_exists($directory . $name)) {
				continue;
			}

			$_FILES['userfile']['name']     = $name;
			$_FILES['userfile']['type']     = $files['type'][$key];
			$_FILES['userfile']['tmp_name'] = $files['tmp_name'][$key];
			$_FILES['userfile']['error']    = $files['error'][$key];
			$_FILES['userfile']['size']     = $files['size'][$key];

			// Coba upload file
			if ($this->upload->do_upload('userfile')) {
				// Jika berhasil, tambahkan nama file ke dalam array
				$uploaded_files[] = $name; // Menggunakan nama asli file
			} else {
				// Jika gagal, tangkap pesan error (opsional)
				$error = $this->upload->display_errors();
				// Handle error sesuai kebutuhan
			}
		}

		redirect('product/import');
	}

	public function import()
	{
		$this->load->view('level/admin/product_import');
	}

	public function json()
	{
		$nama_barang_filter = $this->input->post('nama');
		$nama_kategori_filter = $this->input->post('kategori');
		$stock_filter = $this->input->post('stock');
		$supplier_filter = $this->input->post('supplier');

		$columns = 'id_brg, tb_barang.id_supplier, nama_barang, nama_supplier, barcode, tb_kategori.id_kategori_brg, nama_kategori_brg, nama_satuan, hpp_barang, markup_barang, harga_jual_barang, stock_brg, gambar_barang';
		$filter = array('nama_barang', 'barcode');
		$joins = array(
			array(
				'table' => 'tb_kategori',
				'condition' => 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg',
				'type' => 'left'
			),
			array(
				'table' => 'tb_satuan',
				'condition' => 'tb_satuan.id_satuan = tb_barang.id_satuan',
				'type' => 'left'
			),
			array(
				'table' => 'tb_supplier',
				'condition' => 'tb_supplier.id_supplier = tb_barang.id_supplier',
				'type' => 'left'
			)
		);

		$where = null;
		if ($nama_barang_filter || $nama_kategori_filter || $stock_filter || $supplier_filter) {
			$where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

			if ($nama_kategori_filter) {
				$where .= " AND tb_kategori.id_kategori_brg = '" . $nama_kategori_filter . "'";
			}

			if ($nama_barang_filter) {
				$where .= " AND (nama_barang LIKE '%" . $nama_barang_filter . "%' OR barcode LIKE '%" . $nama_barang_filter . "%')";
			}

			if ($stock_filter == "down") {
				$where .= " AND stock_brg < 10";
			}

			if ($stock_filter == "up") {
				$where .= " AND stock_brg >= 10 ";
			}

			if ($supplier_filter) {
				$where .= " AND tb_barang.id_supplier = '" . $supplier_filter . "'";
			}
		}

		$list = $this->Datatable_model->get_data('tb_barang', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $barang) {
			$kelas_css = ($barang->stock_brg < 10) ? 'text-danger fw-bold' : 'text-success fw-bold';
			$no++;
			$row = array(
				$no,
				"
                 <img style=\"height:40px !important;width:auto\" src=" . base_url('public/template/upload/barang/' . $barang->gambar_barang) . " style=\"cursor: pointer\">
                ",
				$barang->nama_barang . "<br><span class='text-muted text-nowrap'>Barcode: " . $barang->barcode . "</span>",
				$barang->nama_kategori_brg,
				$barang->nama_supplier,
				"Rp. " . number_format($barang->hpp_barang),
				"Rp. " . number_format($barang->harga_jual_barang),
				'<span class="' . $kelas_css . '">' . $barang->stock_brg . ' ' . $barang->nama_satuan . '</span>',
				'
                <div class="btn-group">
					<button type="button" class="btn btn-sm btn-secondary text-uppercase dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-dots-vertical" width="14" height="14" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
						<path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
						<path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
						<path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
					</svg>
					Aksi&nbsp;
					</button>
					<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item" href="' . base_url('product/detail/' . $barang->id_brg) . '" data-id="' . $barang->id_brg . '">&nbsp;Lihat Produk</a></li>
                        <li><a class="dropdown-item" href="' . base_url('product/edit/' . $barang->id_brg) . '" data-id="' . $barang->id_brg . '">&nbsp;Edit Produk</a></li>
                        <li><a class="dropdown-item" href="' . base_url('product/manajemen_stock/' . $barang->id_brg) . '">&nbsp;Stock Terintegrasi</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $barang->id_brg . '" href="javascript:void(0);" onclick="deleteProduk(this);">&nbsp;Hapus Produk</a></li>
					</ul>
				</div>
                '
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_barang'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_barang', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function detail($id)
	{
		$data['barang'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->join('tb_supplier', 'tb_supplier.id_supplier = tb_barang.id_supplier', 'left')->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')->where('tb_barang.id_brg', $id)->get()->row_array();
		$this->load->view('level/admin/product_detail', $data);
	}

	public function manajemen_stock($id)
	{
		$data['barang'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->join('tb_supplier', 'tb_supplier.id_supplier = tb_barang.id_supplier', 'left')->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')->where('tb_barang.id_brg', $id)->get()->row_array();
		$this->load->view('level/admin/product_stock_manajemen', $data);
	}

	public function tambah()
	{
		$data['kategori'] = $this->M_Crud->tampil_data('tb_kategori')->result_array();
		$data['satuan'] = $this->M_Crud->tampil_data('tb_satuan')->result_array();
		$data['supplier'] = $this->M_Crud->tampil_data('tb_supplier')->result_array();
		$this->load->view('level/admin/product_tambah', $data);
	}

	public function pemesanan()
	{
		$data['supplier'] = $this->M_Crud->all_data('tb_supplier')->order_by('nama_supplier', 'asc')->get()->result_array();
		$this->load->view('level/admin/product_pemesanan', $data);
	}

	public function tambah_pemesanan()
	{
		$data['supplier'] = $this->M_Crud->tampil_data('tb_supplier')->result_array();
		$this->load->view('level/admin/product_pemesanan_add', $data);
	}

	public function get_barang()
	{
		if (!empty($this->input->post("q"))) {
			$keyword = $this->input->post('q');
		} else {
			$keyword = "";
		}

		$data = $this->M_Crud->all_data('tb_barang')->like('nama_barang', $keyword)->or_like('barcode', $keyword)->get()->result_array();
		echo json_encode($data);
	}

	public function input_temp()
	{
		$id = $this->input->post('id');
		try {
			$check = $this->M_Crud->all_data('tb_pemesanan_temp')->where('id_brg', $id)->count_all_results();
			$barang = $this->M_Crud->show('tb_barang', ['id_brg' => $id])->row_array();

			if ($check >= 1) {
				$response = array(
					'success' => false,
					'msg' => "Barang Sudah discan",
				);
			} else {
				$result = $this->M_Crud->input_data([
					'id_brg' => $id,
					'harga_beli' => $barang['hpp_barang'],
					'jumlah' => 1,
					'id_user' => $this->session->userdata('id_user')
				], 'tb_pemesanan_temp');
				$response = array(
					'success' => true,
					'msg' => "Scan Berhasil",
				);
			}
		} catch (Exception $e) {
			$response = array(
				'success' => false,
				'msg' => "Gagal",
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function input_temp_ubah($id_pemesanan)
	{
		$id = $this->input->post('id');
		try {
			$check = $this->M_Crud->all_data('tb_pemesanan_detail')->where('id_brg', $id)->where('id_pemesanan', $id_pemesanan)->count_all_results();
			$barang = $this->M_Crud->show('tb_barang', ['id_brg' => $id])->row_array();

			if ($check >= 1) {
				$response = array(
					'success' => false,
					'msg' => "Barang Sudah discan",
				);
			} else {
				$result = $this->M_Crud->input_data([
					'id_pemesanan' => $id_pemesanan,
					'id_brg' => $id,
					'harga_pesan' => $barang['harga_jual_barang'],
					'jumlah_pesan' => 1,
				], 'tb_pemesanan_detail');
				$response = array(
					'success' => true,
					'msg' => "Scan Berhasil",
				);
			}
		} catch (Exception $e) {
			$response = array(
				'success' => false,
				'msg' => "Gagal",
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function json_temp()
	{
		$columns = 'tb_pemesanan_temp.id_brg, nama_barang, harga_beli, jumlah, id_pemesanan_temp, barcode, gambar_barang, stock_brg, harga_jual_barang';
		$filter = array('nama_barang');
		$joins = array(
			array(
				'table' => 'tb_barang',
				'condition' => 'tb_barang.id_brg = tb_pemesanan_temp.id_brg',
				'type' => 'inner'
			),
		);

		$where = null;

		$list = $this->Datatable_model->get_data('tb_pemesanan_temp', $columns, $joins, $filter, $this->input->post('search')['value'], $where, null, null, ['id_pemesanan_temp', 'DESC']);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $temp) {
			$gambar = $temp->gambar_barang == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png" ? "<img style='width: 100px;border-radius: 3px;height: auto;' src='" . $temp->gambar_barang . "'>" : "<img style='width: 70px;border-radius: 3px;height: auto;' src='" . base_url('public/template/upload/barang/' . $temp->gambar_barang) . "'>";
			$no++;
			$row = array(
				$temp->id_pemesanan_temp,
				$gambar,
				$temp->nama_barang . "<br><i>" . $temp->barcode . "</i>",
				$temp->stock_brg,
				$temp->harga_beli,
				$temp->jumlah,
				"Rp. " . number_format($temp->harga_beli * $temp->jumlah),
				"
                <a href=\"javascript:void(0);\" onclick=\"hapusData($temp->id_pemesanan_temp);\">
                    <i class=\"fa fa-times text-danger\"></i>
                </a>
                ",
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_pemesanan_temp'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_pemesanan_temp', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function json_temp_ubah($id)
	{
		$columns = '*';
		$filter = array('nama_barang');
		$joins = array(
			array(
				'table' => 'tb_barang',
				'condition' => 'tb_barang.id_brg = tb_pemesanan_detail.id_brg',
				'type' => 'inner'
			),
		);

		$where = "id_pemesanan = " . $id;

		$list = $this->Datatable_model->get_data('tb_pemesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where, null, null, ['id_pemesanan_detail', 'DESC']);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $temp) {
			$no++;
			$row = array(
				$temp->id_pemesanan_detail,
				"
                 <img style=\"height:40px !important;width:auto\" src=" . base_url('public/template/upload/barang/' . $temp->gambar_barang) . " style=\"cursor: pointer\">
                ",
				$temp->nama_barang . "<br><i>" . $temp->barcode . "</i>",
				$temp->stock_brg,
				$temp->harga_pesan,
				$temp->jumlah_pesan,
				"Rp. " . number_format($temp->harga_pesan * $temp->jumlah_pesan),
				"
                <a href=\"javascript:void(0);\" onclick=\"hapusData($temp->id_pemesanan_detail);\">
                    <i class=\"fa fa-times text-danger\"></i>
                </a>
                ",
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_pemesanan_detail'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_pemesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function json_pemesanan()
	{
		$nama_supplier_filter = $this->input->post('nama_supplier');
		$status_pemesanan_filter = $this->input->post('status_pemesanan');
		$status_pembayaran_filter = $this->input->post('status_pembayaran');

		$columns = 'id_pemesanan, tgl_pesan, status_pemesanan, status_pembayaran, tgl_diterima, created_by, tb_pemesanan.id_supplier, nama_supplier';
		$filter = array('status_pemesanan', 'nama_supplier'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array(
			array(
				'table' => 'tb_supplier',
				'condition' => 'tb_supplier.id_supplier = tb_pemesanan.id_supplier',
				'type' => 'inner'
			),
		);

		$where = null;


		if ($nama_supplier_filter || $status_pemesanan_filter || $status_pembayaran_filter) {
			$where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

			if ($nama_supplier_filter) {
				$where .= " AND tb_pemesanan.id_supplier LIKE '%" . $nama_supplier_filter . "%'";
			}

			if ($status_pemesanan_filter) {
				$where .= " AND status_pemesanan = '" . $status_pemesanan_filter . "'";
			}

			if ($status_pembayaran_filter) {
				$where .= " AND status_pembayaran = '" . $status_pembayaran_filter . "'";
			}
		}

		$list = $this->Datatable_model->get_data('tb_pemesanan', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'), ['tgl_diterima', 'desc']);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $pemesanan) {
			$cek_jumlah = $this->db->select('*')->from('tb_pemesanan_detail')->where('id_pemesanan', $pemesanan->id_pemesanan)->get()->num_rows();
			$no++;
			$row = array(
				$no,
				date('d-m-Y H:i', strtotime($pemesanan->tgl_diterima)),
				$pemesanan->tgl_diterima == NULL ? "<i>NULL</i>" : date('d-m-Y H:i', strtotime($pemesanan->tgl_diterima)),
				$pemesanan->nama_supplier,
				$cek_jumlah,
				$pemesanan->status_pemesanan == "Open" ? "<span class=\"badge bg-danger-lt me-1\">Belum</span>" : "<span class=\"badge bg-success-lt me-1\">Selesai</span>",
				$pemesanan->status_pembayaran == "Belum Lunas" ? "<span class=\"badge bg-danger-lt me-1\">Belum</span>" : "<span class=\"badge bg-success-lt me-1\">Lunas</span> ",
				'
               <div class="btn-group">
					<button type="button" class="btn btn-sm btn-secondary text-uppercase dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-dots-vertical" width="14" height="14" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
						<path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
						<path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
						<path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
					</svg>
					Aksi&nbsp;
					</button>
					<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item ' . ($pemesanan->status_pemesanan == "Received" ? "disabled-link" : "") . '" href="' . base_url('product/pemesanan/ubah/' . $pemesanan->id_pemesanan) . '" data-id="' . $pemesanan->id_pemesanan . '">&nbsp;Ubah Pemesanan</a></li>
                        <li><a class="dropdown-item" href="' . base_url('product/pemesanan/lihat/' . $pemesanan->id_pemesanan) . '" data-id="' . $pemesanan->id_pemesanan . '">&nbsp;Lihat Pemesanan</a></li>
                        <li><a class="dropdown-item" href="' . base_url('product/pemesanan/cetak/' . $pemesanan->id_pemesanan) . '" data-id="' . $pemesanan->id_pemesanan . '" onclick="lihatKategori(this);">&nbsp;Cetak Pemesanan</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0);" data-id="' . $pemesanan->id_pemesanan . '" data-status="' . $pemesanan->status_pemesanan . '" data-pembayaran="' . $pemesanan->status_pembayaran . '" onclick="ubahStatus(this);">&nbsp;Ubah Status</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $pemesanan->id_pemesanan . '" href="javascript:void(0);" onclick="deletePemesanan(this);">&nbsp;Hapus Pemesanan</a></li>
					</ul>
				</div>
               '
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_pemesanan'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_pemesanan', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function delete_pemesanan($id_pemesanan)
	{
		try {
			// Periksa apakah kategori masih digunakan oleh barang
			$status = $this->M_Crud->all_data('tb_pemesanan')->where('id_pemesanan', $id_pemesanan)->get()->row_array();

			if ($status['status_pemesanan'] == "Received") {
				// Jika masih ada barang yang menggunakan kategori ini, kategori tidak dapat dihapus
				echo json_encode(array('status' => 'error', 'message' => 'Pemesanan tidak dapat dihapus karena sudah selesai.'));
				return;
			} else {
				$this->db->where('id_pemesanan', $id_pemesanan)->delete('tb_pemesanan_detail');
				$this->M_Crud->hapus_data(array('id_pemesanan' => $id_pemesanan), 'tb_pemesanan');
				echo json_encode(array('status' => 'success', 'message' => 'Data pemesanan berhasil dibatalkan.'));
			}
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}

	public function ubah_pemesanan()
	{
		try {
			$id = $this->input->post('id_pemesanan');
			$pembayaran = $this->input->post('pembayaran');

			$data = array(
				'status_pembayaran' => $pembayaran,
			);

			$result = $this->M_Crud->update_data(['id_pemesanan' => $id], $data, 'tb_pemesanan');

			$detail = $this->M_Crud->all_data('tb_pemesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pemesanan_detail.id_brg')->where('id_pemesanan', $id)->get()->result_array();

			$this->load->helper('custom');
			foreach ($detail as $key => $value) {
				if ($pembayaran == "Lunas") {

					$id_brg = $value['id_brg'];
					$stok_tersisa = $value['stock_brg'];
					$markup = $value['markup_barang'];
					$ppn = $value['ppn_barang'];

					if ($stok_tersisa <= 0) continue;

					$harga_jual = calculate_harga_jual($value['harga_pesan'], $markup, $ppn);

					$this->db->where('id_brg', $id_brg);
					$this->db->update('tb_barang', [
						'hpp_barang' => $value['harga_pesan'],
						'harga_jual_barang' => $harga_jual,
					]);

				} else {
					break;
				}
			}

			echo json_encode(
				array(
					'status' => 'success',
					'message' => 'Data berhasil diubah.'
				)
			);
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}

	public function update_temp()
	{
		$id = $this->input->post('id');
		$jumlah = $this->input->post('jumlah');
		$this->M_Crud->update_data(['id_pemesanan_temp' => $id], [
			'jumlah' => $jumlah
		], 'tb_pemesanan_temp');
		$response = array(
			'status' => 'success',
			'message' => 'Jumlah Pembelian berhasil diperbarui'
		);
		echo json_encode($response);
	}


	public function update_temp_ubah()
	{
		$id = $this->input->post('id');
		$jumlah = $this->input->post('jumlah');
		$this->M_Crud->update_data(['id_pemesanan_detail' => $id], [
			'jumlah_pesan' => $jumlah
		], 'tb_pemesanan_detail');
		$response = array(
			'status' => 'success',
			'message' => 'Jumlah Pembelian berhasil diperbarui'
		);
		echo json_encode($response);
	}

	public function update_temp2()
	{
		$id = $this->input->post('id_pemesanan');
		$harga = $this->input->post('harga_beli');
		$this->M_Crud->update_data(['id_pemesanan_temp' => $id], [
			'harga_beli' => $harga
		], 'tb_pemesanan_temp');
		$response = array(
			'status' => 'success',
			'message' => 'Harga Pembelian berhasil diperbarui'
		);
		echo json_encode($response);
	}

	public function update_temp2_ubah()
	{
		$id = $this->input->post('id_pemesanan');
		$harga = $this->input->post('harga_beli');
		$this->M_Crud->update_data(['id_pemesanan_detail' => $id], [
			'harga_pesan' => $harga
		], 'tb_pemesanan_detail');
		$response = array(
			'status' => 'success',
			'message' => 'Harga Pembelian berhasil diperbarui'
		);
		echo json_encode($response);
	}

	public function delete_temp($id)
	{
		$this->M_Crud->hapus_data(['id_pemesanan_temp' => $id], 'tb_pemesanan_temp');
		return true;
	}

	public function delete_temp_ubah($id)
	{
		$this->M_Crud->hapus_data(['id_pemesanan_detail' => $id], 'tb_pemesanan_detail');
		return true;
	}

	public function delete_all_temp()
	{
		$this->db->truncate('tb_pemesanan_temp');
		return true;
	}

	public function delete_all_temp_ubah($id)
	{
		$this->db->where('id_pemesanan', $id);
		$this->db->delete('tb_pemesanan_detail');
		return true;
	}

	public function simpan_pemesanan()
	{
		// Menerima data dari permintaan Ajax
		$nama = $this->input->post('nama');
		$supplier = $this->input->post('supplier');
		$tgl_pesan = $this->input->post('tgl_pesan');
		$tgl_kirim = $this->input->post('tgl_kirim');
		$status = $this->input->post('status');
		$user = $this->session->userdata('id_user');

		// Simpan data ke database
		$data = array(
			'nama_pemesanan' => $nama,
			'id_supplier' => $supplier,
			'tgl_pesan' => $tgl_pesan,
			'tgl_kirim' => $tgl_kirim,
			'status_pemesanan' => 'Open',
			'status_pembayaran' => 'Belum Lunas',
			'tgl_diterima' => NULL,
			'created_by' => $user
		);

		$cek = $this->M_Crud->count('tb_pemesanan_temp');

		if ($cek < 1) {
			$response = array(
				'success' => false,
				'msg' => "Anda harus membeli minimal 1 product"
			);
		} else {
			try {
				$this->M_Crud->input_data($data, 'tb_pemesanan');
				$id_pemesanan = $this->db->insert_id();

				$temp = $this->M_Crud->all_data('tb_pemesanan_temp')->join('tb_barang', 'tb_barang.id_brg = tb_pemesanan_temp.id_brg')->get()->result_array();

				foreach ($temp as $key => $value) {
					$temp_data = [
						'id_pemesanan' => $id_pemesanan,
						'id_brg' => $value['id_brg'],
						'harga_pesan' => $value['harga_beli'],
						'jumlah_pesan' => $value['jumlah']
					];
					$this->M_Crud->input_data($temp_data, 'tb_pemesanan_detail');
					$this->M_Crud->hapus_data(['id_pemesanan_temp' => $value['id_pemesanan_temp']], 'tb_pemesanan_temp');
				}

				$response = array(
					'success' => true,
					'msg' => "Pemesanan Barang berhasil dilakukan"
				);
			} catch (Exception $e) {
				$response = array(
					'success' => false,
					'msg' => "Terjadi kesalahan: " . $e->getMessage()
				);
			}
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function update_pemesanan($id)
	{
		// Menerima data dari permintaan Ajax
		$nama = $this->input->post('nama');
		$supplier = $this->input->post('supplier');
		$tgl_pesan = $this->input->post('tgl_pesan');
		$tgl_kirim = $this->input->post('tgl_kirim');
		$tgl_terima = $this->input->post('tgl_terima');
		$status = $this->input->post('status');
		$pembayaran = $this->input->post('pembayaran');
		$user = $this->session->userdata('id_user');
		$kasir = $this->input->post('kasir');

		$previous_data = $this->db->select('*')
			->from('tb_pemesanan')
			->where('id_pemesanan', $id)
			->get()
			->row_array();

		// Simpan data ke database
		$data = array(
			'nama_pemesanan' => !empty($nama) ? $nama : $previous_data['nama_pemesanan'],
			'id_supplier' => !empty($supplier) ? $supplier : $previous_data['id_supplier'],
			'tgl_pesan' => !empty($tgl_pesan) ? $tgl_pesan : $previous_data['tgl_pesan'],
			'tgl_kirim' => !empty($tgl_kirim) ? $tgl_kirim : $previous_data['tgl_kirim'],
			'status_pemesanan' => !empty($status) ? $status : $previous_data['status_pemesanan'],
			'status_pembayaran' => !empty($pembayaran) ? $pembayaran : $previous_data['status_pembayaran'],
			'tgl_diterima' => !empty($tgl_terima) ? $tgl_terima : $previous_data['tgl_diterima'],
			'created_by' => $user,
			'received_by' => !empty($kasir) ? $kasir : $previous_data['received_by']
		);

		$this->M_Crud->update_data(['id_pemesanan' => $id], $data, 'tb_pemesanan');

		$detail = $this->M_Crud->all_data('tb_pemesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pemesanan_detail.id_brg')->where('id_pemesanan', $id)->get()->result_array();

		$this->load->helper('custom');
		foreach ($detail as $key => $value) {
			if ($status == "Received") {
				// INPUT RIWAYAT
				$riwayat = [
					'id_brg' => $value['id_brg'],
					'tgl_riwayat_stock' => date('Y-m-d H:i:s'),
					'jumlah_riwayat' => $value['jumlah_pesan'],
					'jenis_transaksi' => 'stock_masuk',
					'stock_sebelum' => $value['stock_brg'],
					'stock_sesudah' => $value['stock_brg'] + $value['jumlah_pesan'],
					'keterangan_riwayat_stock' => "Penambahan Stock Melalui Pemesanan",
					'harga_masuk' => $value['harga_pesan'],
				];
				$this->M_Crud->input_data($riwayat, "tb_riwayat_stock");
				update_hpp_fifo_all_barang($value['id_brg'], $value['harga_pesan']);

				$stock = $this->M_Crud->show('tb_barang', ['id_brg' => $value['id_brg']])->row_array();
				$this->M_Crud->update_data(['id_brg' => $value['id_brg']], ['stock_brg' => $stock['stock_brg'] + $value['jumlah_pesan']], 'tb_barang');
			} else {
				break;
			}
		}

		$response = array(
			'success' => true,
			'msg' => "Pemesanan Barang berhasil diupdate"
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function edit_pemesanan($id)
	{
		$data['id'] = $id;
		$data['pemesanan'] = $this->M_Crud->all_data('tb_pemesanan')->where('id_pemesanan', $id)->get()->row_array();
		$data['supplier'] = $this->M_Crud->all_data('tb_supplier')->get()->result_array();
		$data['kasir'] = $this->M_Crud->all_data('tb_kasir')->get()->result_array();
		$this->load->view('level/admin/product_pemesanan_ubah', $data);
	}

	public function lihat_pemesanan($id)
	{
		$data['produk'] = $this->M_Crud->all_data('tb_pemesanan_detail')->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan')->join('tb_barang', 'tb_barang.id_brg = tb_pemesanan_detail.id_brg')->where('tb_pemesanan_detail.id_pemesanan', $id)->get()->result_array();
		$data['pemesanan'] = $this->M_Crud->all_data('tb_pemesanan')->join('tb_supplier', 'tb_supplier.id_supplier = tb_pemesanan.id_supplier', 'left')->join('tb_kasir', 'tb_kasir.id_kasir = tb_pemesanan.received_by', 'left')->where('id_pemesanan', $id)->get()->row_array();
		$this->load->view('level/admin/product_pemesanan_lihat', $data);
	}

	public function cetak_pemesanan($id)
	{
		$data['produk'] = $this->M_Crud->all_data('tb_pemesanan_detail')->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan')->join('tb_barang', 'tb_barang.id_brg = tb_pemesanan_detail.id_brg')->where('tb_pemesanan_detail.id_pemesanan', $id)->get()->result_array();
		$data['pemesanan'] = $this->M_Crud->all_data('tb_pemesanan')->join('tb_supplier', 'tb_supplier.id_supplier = tb_pemesanan.id_supplier', 'left')->join('tb_kasir', 'tb_kasir.id_kasir = tb_pemesanan.received_by', 'left')->where('id_pemesanan', $id)->get()->row_array();
		$this->load->view('level/admin/product_pemesanan_cetak', $data);
	}

	public function hitungTotal()
	{
		$id = $this->session->userdata('id_user');

		// Query SQL untuk menghitung total harga
		$sql = "SELECT SUM(tb_pemesanan_temp.harga_beli * tb_pemesanan_temp.jumlah) as total_harga
            FROM tb_pemesanan_temp WHERE tb_pemesanan_temp.id_user = $id";

		// Eksekusi query
		$query = $this->db->query($sql);

		// Mendapatkan hasil query
		$result = $query->row();

		// Mendapatkan total
		$totalHarga = $result->total_harga;

		// Mengirimkan total ke tampilan
		echo json_encode(array(
			'total' => number_format($totalHarga),
		));
	}

	public function hitungTotalUbah($id_pemesanan)
	{
		$id = $this->session->userdata('id_user');

		// Query SQL untuk menghitung total harga
		$sql = "SELECT SUM(tb_pemesanan_detail.harga_pesan * tb_pemesanan_detail.jumlah_pesan) as total_harga
            FROM tb_pemesanan_detail WHERE tb_pemesanan_detail.id_pemesanan = $id_pemesanan";

		// Eksekusi query
		$query = $this->db->query($sql);

		// Mendapatkan hasil query
		$result = $query->row();

		// Mendapatkan total
		$totalHarga = $result->total_harga;

		// Mengirimkan total ke tampilan
		echo json_encode(array(
			'total' => number_format($totalHarga),
		));
	}

	public function grosir()
	{
		$data['grosir'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg', 'left')->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')->where('grosir_brg', 'On')->get()->result_array();
		$this->load->view('level/admin/product_grosir', $data);
	}

	public function grosir_temp()
	{
		$columns = 'tb_grosir_temp.id_brg, id_grosir_temp, nama_barang, barcode, gambar_barang, stock_brg';
		$filter = array('nama_barang');
		$joins = array(
			array(
				'table' => 'tb_barang',
				'condition' => 'tb_barang.id_brg = tb_grosir_temp.id_brg',
				'type' => 'inner'
			),
		);

		$where = null;

		$list = $this->Datatable_model->get_data('tb_grosir_temp', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $temp) {
			$gambar = $temp->gambar_barang == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png" ? "<img style='width: auto;border-radius: 3px;height: 45px;' src='" . $temp->gambar_barang . "'>" : "<img style='width: auto;border-radius: 3px;height: 45px;' src='" . base_url('public/template/upload/barang/' . $temp->gambar_barang) . "'>";
			$no++;
			$row = array(
				$temp->id_grosir_temp,
				$temp->nama_barang . "<br><i>" . $temp->barcode . "</i>",
				"
                <a href=\"javascript:void(0);\" onclick=\"hapusData($temp->id_grosir_temp );\">
                    <i class=\"fa fa-times text-danger\"></i>
                </a>
                ",
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_grosir_temp'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_grosir_temp', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function grosir_simpan()
	{
		$data_promosi = array(
			'id_brg' => $this->input->post('barang'),
		);

		$cek = $this->M_Crud->all_data('tb_grosir_temp')->where('id_brg', $this->input->post('barang'))->get()->row_array();

		if (!empty($cek)) {
			$response = array(
				'success' => false,
				'msg' => "Barang Telah ditambahkan!",
			);
		} else {
			$cek2 = $this->M_Crud->all_data('tb_barang')->where('id_brg', $this->input->post('barang'))->get()->row_array();

			if ($cek2['grosir_brg'] == "On") {
				// Berikan respons dalam format JSON
				$response = array(
					'success' => false,
					'msg' => "Barang dalam kondisi grosir!",
				);
			} else {
				$result = $this->M_Crud->input_data($data_promosi, 'tb_grosir_temp');
				// Berikan respons dalam format JSON
				$response = array(
					'success' => true,
					'msg' => "Barang Berhasil Ditambahkan",
				);
			}
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function grosir_count_tmp()
	{
		$count = $this->db->count_all_results('tb_grosir_temp');

		$result = $this->db
			->select('tb_grosir_temp.*, tb_barang.nama_barang, tb_barang.hpp_barang, tb_barang.harga_jual_barang')
			->from('tb_grosir_temp')
			->join('tb_barang', 'tb_barang.id_brg = tb_grosir_temp.id_brg', 'left')
			->get()
			->result_array();

		// Kembalikan response dalam format JSON
		header('Content-Type: application/json');
		echo json_encode(array('count' => $count, 'barang' => $result));
	}

	public function grosir_save()
	{
		// Ambil data yang dikirimkan melalui metode POST
		$idGrosir = $this->input->post('idGrosir');
		$hargaGrosir = $this->input->post('hargaGrosir');
		$rentangAwal = $this->input->post('rentangAwal');
		$rentangAkhir = $this->input->post('rentangAkhir');

		// Jumlah data yang akan disimpan
		$jumlahData = count($idGrosir);

		// Lakukan iterasi untuk menyimpan data multiple
		for ($i = 0; $i < $jumlahData; $i++) {
			// Ambil nilai untuk setiap elemen
			$id = $idGrosir[$i];
			$harga = $hargaGrosir[$i];
			$awal = $rentangAwal[$i];
			$akhir = $rentangAkhir[$i];

			// Perbarui data di tabel 'tb_barang' dengan harga promo dan rentang waktu
			$this->M_Crud->update_data(['id_brg' => $id], [
				'grosir_brg' => 'On',
				'harga_grosir' => $harga,
				'rentang_awal' => $awal,  // Menambahkan rentangAwal
				'rentang_akhir' => $akhir // Menambahkan rentangAkhir
			], 'tb_barang');

			// Hapus data terkait dari tabel 'tb_promo_temp'
			$this->M_Crud->hapus_data(['id_brg' => $id], 'tb_grosir_temp');
		}

		// Berikan respons (response) sesuai kebutuhan
		$response = array('status' => 'success', 'msg' => 'Data berhasil disimpan.');

		// Kembalikan respons dalam format JSON
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function grosir_update()
	{
		$idGrosir = $this->input->post('idGrosir'); // ID Barang
		$hargaGrosir = $this->input->post('hargaGrosir'); // Harga Grosir
		$rentangAwal = $this->input->post('rentangAwal'); // Rentang Awal Promo
		$rentangAkhir = $this->input->post('rentangAkhir'); // Rentang Akhir Promo

		// Jumlah data yang akan disimpan
		$jumlahData = count($idGrosir);

		// Lakukan iterasi untuk menyimpan data multiple
		for ($i = 0; $i < $jumlahData; $i++) {
			// Ambil nilai untuk setiap elemen
			$id = $idGrosir[$i];
			$harga = $hargaGrosir[$i];
			$awal = $rentangAwal[$i]; // Ambil nilai Rentang Awal Promo
			$akhir = $rentangAkhir[$i]; // Ambil nilai Rentang Akhir Promo

			// Update data barang dengan harga grosir dan rentang promo
			$this->M_Crud->update_data(
				['id_brg' => $id],
				[
					'grosir_brg' => 'On',
					'harga_grosir' => $harga,
					'rentang_awal' => $awal, // Menyimpan Rentang Awal Promo
					'rentang_akhir' => $akhir // Menyimpan Rentang Akhir Promo
				],
				'tb_barang'
			);

			// Hapus data dari tb_promo_temp setelah update
			$this->M_Crud->hapus_data(['id_brg' => $id], 'tb_grosir_temp');
		}

		// Berikan respons (response) sesuai kebutuhan
		$response = array('status' => 'success', 'msg' => 'Data berhasil disimpan.');

		// Kembalikan respons dalam format JSON
		header('Content-Type: application/json');
		echo json_encode($response);
	}


	public function grosir_delete_temp($id)
	{
		$this->M_Crud->hapus_data(['id_grosir_temp' => $id], 'tb_grosir_temp');
		return true;
	}

	public function grosir_delete_many()
	{
		$selectedItems = $this->input->post('selectedItems');
		$idArray = explode(',', $selectedItems);

		foreach ($idArray as $key => $value) {
			$this->M_Crud->update_data(['id_brg' => $value], ['grosir_brg' => 'Off', 'harga_grosir' => NULL, 'rentang_awal' => NULL, 'rentang_akhir' => NULL], 'tb_barang');
		}

		header('Content-Type: application/json');
		echo json_encode(array('success' => true, 'msg' => 'Promo Berhasil dihilangkan!'));
	}

	public function promosi()
	{
		$data['promosi'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg', 'left')->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')->where('promo_brg', 'On')->get()->result_array();
		$this->load->view('level/admin/product_promosi', $data);
	}

	public function promosi_simpan()
	{
		$data_promosi = array(
			'id_brg' => $this->input->post('barang'),
		);

		$cek = $this->M_Crud->all_data('tb_promo_temp')->where('id_brg', $this->input->post('barang'))->get()->row_array();

		if (!empty($cek)) {
			$response = array(
				'success' => false,
				'msg' => "Barang Telah ditambahkan!",
			);
		} else {
			$cek2 = $this->M_Crud->all_data('tb_barang')->where('id_brg', $this->input->post('barang'))->get()->row_array();

			if ($cek2['promo_brg'] == "On") {
				// Berikan respons dalam format JSON
				$response = array(
					'success' => false,
					'msg' => "Barang dalam kondisi promo!",
				);
			} else {
				$result = $this->M_Crud->input_data($data_promosi, 'tb_promo_temp');
				// Berikan respons dalam format JSON
				$response = array(
					'success' => true,
					'msg' => "Barang Berhasil Ditambahkan",
				);
			}
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function promosi_temp()
	{
		$columns = 'tb_promo_temp.id_brg, id_promo_temp, nama_barang, barcode, gambar_barang, stock_brg';
		$filter = array('nama_barang');
		$joins = array(
			array(
				'table' => 'tb_barang',
				'condition' => 'tb_barang.id_brg = tb_promo_temp.id_brg',
				'type' => 'inner'
			),
		);

		$where = null;

		$list = $this->Datatable_model->get_data('tb_promo_temp', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $temp) {
			$gambar = $temp->gambar_barang == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png" ? "<img style='width: auto;border-radius: 3px;height: 45px;' src='" . $temp->gambar_barang . "'>" : "<img style='width: auto;border-radius: 3px;height: 45px;' src='" . base_url('public/template/upload/barang/' . $temp->gambar_barang) . "'>";
			$no++;
			$row = array(
				$temp->id_promo_temp,
				$temp->nama_barang . "<br><i>" . $temp->barcode . "</i>",
				"
                <a href=\"javascript:void(0);\" onclick=\"hapusData($temp->id_promo_temp );\">
                    <i class=\"fa fa-times text-danger\"></i>
                </a>
                ",
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_promo_temp'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_promo_temp', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function promosi_delete_many()
	{
		$selectedItems = $this->input->post('selectedItems');
		$idArray = explode(',', $selectedItems);

		foreach ($idArray as $key => $value) {
			$this->M_Crud->update_data(['id_brg' => $value], ['promo_brg' => 'Off', 'harga_promo' => 0], 'tb_barang');
		}

		header('Content-Type: application/json');
		echo json_encode(array('success' => true, 'msg' => 'Promo Berhasil dihilangkan!'));
	}

	public function promosi_count_tmp()
	{
		$count = $this->db->count_all_results('tb_promo_temp');

		$result = $this->db
			->select('tb_promo_temp.*, tb_barang.nama_barang, tb_barang.hpp_barang, tb_barang.harga_jual_barang')
			->from('tb_promo_temp')
			->join('tb_barang', 'tb_barang.id_brg = tb_promo_temp.id_brg', 'left')
			->get()
			->result_array();

		// Kembalikan response dalam format JSON
		header('Content-Type: application/json');
		echo json_encode(array('count' => $count, 'barang' => $result));
	}

	public function promosi_save()
	{
		// Ambil data yang dikirimkan melalui metode POST
		$idPromo = $this->input->post('idPromo');
		$hargaPromo = $this->input->post('hargaPromo');
		$masaBerlaku = $this->input->post('masaBerlaku');

		// Jumlah data yang akan disimpan
		$jumlahData = count($idPromo);

		// Lakukan iterasi untuk menyimpan data multiple
		for ($i = 0; $i < $jumlahData; $i++) {
			// Ambil nilai untuk setiap elemen
			$id = $idPromo[$i];
			$harga = $hargaPromo[$i];
			$masa_berlaku = $masaBerlaku[$i];

			$this->M_Crud->update_data(['id_brg' => $id], [
				'promo_brg' => 'On',
				'harga_promo' => $harga,
				'masa_berlaku_promo' => $masa_berlaku // Gunakan nilai yang sesuai dengan indeks saat ini
			], 'tb_barang');
			$this->M_Crud->hapus_data(['id_brg' => $id], 'tb_promo_temp');
		}

		// Berikan respons (response) sesuai kebutuhan
		$response = array('status' => 'success', 'msg' => 'Data berhasil disimpan.');

		// Kembalikan respons dalam format JSON
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function promosi_update()
	{
		// Ambil data yang dikirimkan melalui metode POST
		$idPromo = $this->input->post('idPromo');
		$hargaPromo = $this->input->post('hargaPromo');
		$masaBerlaku = $this->input->post('masaBerlaku');

		// Jumlah data yang akan disimpan
		$jumlahData = count($idPromo);

		// Lakukan iterasi untuk menyimpan data multiple
		for ($i = 0; $i < $jumlahData; $i++) {
			// Ambil nilai untuk setiap elemen
			$id = $idPromo[$i];
			$harga = $hargaPromo[$i];
			$masa_berlaku = $masaBerlaku[$i]; // Ambil nilai yang sesuai dengan indeks saat ini

			$this->M_Crud->update_data(['id_brg' => $id], [
				'promo_brg' => 'On',
				'harga_promo' => $harga,
				'masa_berlaku_promo' => $masa_berlaku // Gunakan nilai yang sesuai dengan indeks saat ini
			], 'tb_barang');
			$this->M_Crud->hapus_data(['id_brg' => $id], 'tb_promo_temp');
		}

		// Berikan respons (response) sesuai kebutuhan
		$response = array('status' => 'success', 'msg' => 'Data berhasil disimpan.');

		// Kembalikan respons dalam format JSON
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function promosi_delete_temp($id)
	{
		$this->M_Crud->hapus_data(['id_promo_temp' => $id], 'tb_promo_temp');
		return true;
	}

	public function getDataBarangById()
	{
		$id_brg = $this->input->post('id_brg');

		// Pilih kolom yang ingin Anda ambil dari setiap tabel
		$this->db->select('tb_barang.*, tb_kategori.nama_kategori_brg, tb_satuan.nama_satuan');
		$this->db->from('tb_barang');

		// Lakukan JOIN dengan tabel_kategori berdasarkan id_kategori
		$this->db->join('tb_kategori', 'tb_barang.id_kategori_brg = tb_kategori.id_kategori_brg', 'left');

		// Lakukan JOIN dengan tabel_satuan berdasarkan id_satuan
		$this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');

		// Filter berdasarkan id_brg
		$this->db->where('tb_barang.id_brg', $id_brg);

		$dataBarang = $this->db->get()->row_array();

		// Kembalikan response dalam format JSON
		header('Content-Type: application/json');
		echo json_encode($dataBarang);
	}

	public function editBySelected()
	{
		// Terima data dari AJAX
		$selectedItems = $this->input->post('selectedItems');

		// Lakukan filter menggunakan where_in
		$this->db->where_in('id_brg', $selectedItems);
		$result = $this->db->get('tb_barang')->result_array();

		// Kirim data hasil filter ke AJAX
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	public function delete($id_barang)
	{
		try {
			// Periksa apakah kategori masih digunakan oleh barang
			$count_barang = $this->M_Crud->count_rows('tb_pesanan_detail', ['id_brg' => $id_barang]);

			if ($count_barang <= 0) {
				$this->M_Crud->all_data('tb_riwayat_stock')->where('id_brg', $id_barang)->delete();
			} else {
				// Jika masih ada barang yang menggunakan kategori ini, kategori tidak dapat dihapus
				echo json_encode(array('status' => 'error', 'message' => 'Barang tidak dapat dihapus karena masih digunakan oleh barang.'));
				return;
			}

			// Dapatkan nama file gambar berdasarkan ID yang akan dihapus
			$data_barang = $this->M_Crud->show('tb_barang', ['id_brg' => $id_barang])->row_array();
			$nama_file = $data_barang['gambar_barang'];

			// Hapus data dari database
			$result = $this->M_Crud->hapus_data(array('id_brg' => $id_barang), 'tb_barang');

			if (!empty($nama_file)) {
				$lokasi_folder = FCPATH . 'public/template/upload/barang/'; // Tentukan 
				$path_to_file = $lokasi_folder . $nama_file;

				// Hapus file gambar
				if (file_exists($path_to_file)) {
					unlink($path_to_file);
				}
			}

			echo json_encode(array('status' => 'success', 'message' => 'Data dan gambar berhasil dihapus.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}

	public function reset_web()
	{
		// Tables to truncate (clear all data and reset auto-increment)
		// These are tables that contain transactional or temporary data related to products, orders, etc.
		$tables_to_truncate = [
			'stock_list',
			'tb_barang',
			'tb_grosir_temp',
			'tb_keranjang',
			'tb_krisan',
			'tb_opname_fisik', // Detail tables first
			'tb_opname_rusak', // Detail tables first
			'tb_opname', // Master opname table
			'tb_pemesanan_detail', // Detail tables first
			'tb_pemesanan_temp', // Detail tables first
			'tb_pemesanan', // Master pemesanan table
			'tb_pesanan_detail', // Detail tables first
			'tb_pesanan_tracking', // Detail tables first
			'tb_pesanan', // Master pesanan table
			'tb_pesan', // Messages, usually transactional
			'tb_promo_temp',
			'tb_rating_detail', // Detail tables first
			'tb_rating_gambar', // Detail tables first
			'tb_rating', // Master rating table
			'tb_riwayat_stock',
		];

		// Tables that contain master data that you want to keep their existing entries
		// You specifically mentioned keeping these.
		$tables_to_keep_data = [
			'tb_provinsi',
			'tb_kabupaten',
			'tb_kecamatan',
			'tb_desa',
			'tb_kasir',
			'tb_kategori',
			'tb_satuan',
			'tb_supplier',
		];

		try {
			// Disable foreign key checks
			$this->db->query('SET FOREIGN_KEY_CHECKS = 0');

			// Loop through tables to truncate
			foreach ($tables_to_truncate as $table) {
				if ($this->db->table_exists($table)) {
					$this->db->truncate($table);
					echo "Table `{$table}` truncated successfully.<br>";
				} else {
					echo "Table `{$table}` does not exist. Skipping.<br>";
				}
			}
			// Re-enable foreign key checks
			$this->db->query('SET FOREIGN_KEY_CHECKS = 1');

			echo "Database refresh completed successfully, keeping data in master tables.<br>";

			// // jalankan fungsi mysql dari file root/database/data_new_kop_kosongan.sql
			// $sql_file = FCPATH . 'database\data_new_kop_kosongan.sql';
			// if (file_exists($sql_file)) {
			// 	$sql = file_get_contents($sql_file);
			// 	$this->db->query($sql);
			// 	echo "SQL file executed successfully.<br>";
			// } else {
			// 	echo "SQL file not found: {$sql_file}.<br>";
			// }
		} catch (Exception $e) {
			// Re-enable foreign key checks even if an error occurs
			$this->db->query('SET FOREIGN_KEY_CHECKS = 1');
			echo "An error occurred during database refresh: " . $e->getMessage() . "<br>";
			log_message('error', 'Database refresh error: ' . $e->getMessage());
		}
	}
}
