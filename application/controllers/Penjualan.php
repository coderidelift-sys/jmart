<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
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
	}

	public function index()
	{
		$data['total'] = $this->M_Crud->all_data('tb_pesanan')->get()->num_rows();
		$data['pending'] = $this->M_Crud->all_data('tb_pesanan')->where('status_pesanan', 'Pending')->get()->num_rows();
		$data['dikemas'] = $this->M_Crud->all_data('tb_pesanan')->where('status_pesanan', 'Dikemas')->get()->num_rows();
		$data['dikirim'] = $this->M_Crud->all_data('tb_pesanan')->where('status_pesanan', 'Dikirim')->get()->num_rows();
		// $this->load->view('level/admin/penjualan_backup', $data);
		$this->load->view('level/admin/penjualan', $data);
	}

	/**
	 * JSON endpoint untuk DataTables dengan filter range tanggal
	 * Mendukung filter berdasarkan range tanggal, status, metode pembayaran, dll
	 */
	public function json()
	{
		$anggota = $this->input->post('anggota');
		$id = $this->input->post('id');
		$tgl_start = $this->input->post('tgl_start'); // Tanggal mulai filter
		$tgl_end = $this->input->post('tgl_end'); // Tanggal akhir filter
		$status = $this->input->post('status');
		$metode = $this->input->post('metode');
		$pembayaran = $this->input->post('pembayaran');
		$jenis = $this->input->post('jenis');

		$columns = '*';
		$filter = array('nama_member', 'id_pesanan', 'status_pesanan', 'status_pembayaran', 'nomor_induk');
		$joins = array(
			array(
				'table' => 'tb_user',
				'condition' => 'tb_user.id_user = tb_pesanan.id_user',
				'type' => 'left'
			),
			array(
				'table' => 'tb_kasir',
				'condition' => 'tb_kasir.id_kasir = tb_pesanan.id_kasir',
				'type' => 'left'
			),
		);

		$where = null;
		$order = ['tgl_pesanan', 'DESC'];
		if (!empty($anggota) || !empty($id) || !empty($tgl_start) || !empty($tgl_end) || !empty($status) || !empty($pembayaran) || !empty($metode) || !empty($jenis)) {
			$where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

			if (!empty($anggota)) {
				$where .= " AND tb_pesanan.id_user = '" . $anggota . "'";
			}

			if (!empty($id)) {
				$where .= " AND id_pesanan LIKE '%" . $id . "%'";
			}

					// Filter range tanggal - mendukung filter berdasarkan rentang tanggal
		if (!empty($tgl_start) && !empty($tgl_end)) {
			// Validasi format tanggal (YYYY-MM-DD)
			if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl_start) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl_end)) {
				$start_date = date('Y-m-d', strtotime($tgl_start));
				$end_date = date('Y-m-d', strtotime($tgl_end));
				
				// Validasi logika: tanggal start tidak boleh lebih besar dari end
				if ($start_date <= $end_date) {
					$where .= " AND DATE(tgl_pesanan) BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
				} else {
					// Fallback: jika tanggal start lebih besar, gunakan tanggal start saja
					$where .= " AND DATE(tgl_pesanan) = '" . $start_date . "'";
				}
			}
		} elseif (!empty($tgl_start)) {
			// Filter hanya tanggal mulai (dari tanggal tertentu ke atas)
			if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl_start)) {
				$where .= " AND DATE(tgl_pesanan) >= '" . date('Y-m-d', strtotime($tgl_start)) . "'";
			}
		} elseif (!empty($tgl_end)) {
			// Filter hanya tanggal akhir (sampai tanggal tertentu)
			if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $tgl_end)) {
				$where .= " AND DATE(tgl_pesanan) <= '" . date('Y-m-d', strtotime($tgl_end)) . "'";
			}
		}

			if (!empty($status)) {
				$where .= " AND status_pesanan = '" . $status . "'";
			}

			if (!empty($metode)) {
				$where .= " AND metode_bayar = '" . $metode . "'";
			}

			if (!empty($pembayaran)) {
				$where .= " AND status_pembayaran = '" . $pembayaran . "'";
			}

			if (!empty($jenis)) {
				$where .= " AND jenis_order = '" . $jenis . "'";
			}
		}

		$list = $this->Datatable_model->get_data('tb_pesanan', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'), $order);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $pesanan) {
			if ($pesanan->status_pesanan == "Pending") {
				$status = "<span class='badge text-white bg-danger-lt'>Pesanan Pending</span>";
			} else if ($pesanan->status_pesanan == "Dikemas") {
				$status = "<span class='badge text-white bg-warning-lt'>Pesanan Dikemas</span>";
			} else if ($pesanan->status_pesanan == "Dikirim") {
				$status = "<span class='badge text-white bg-primary-lt'>Pesanan Dikirim</span>";
			} else if($pesanan->status_pesanan == "Dibatalkan") {
				$status = "<span class='badge text-white bg-danger-lt'>Pesanan Dibatalkan</span>";
			} else {
				$status = "<span class='badge text-white bg-success-lt'>Pesanan Selesai</span>";
			}

			if ($pesanan->status_pembayaran == "Menunggu Pembayaran") {
				$pembayaran = "<span class='badge text-white bg-danger-lt'>Menunggu</span>";
			} else {
				$pembayaran = "<span class='badge text-white bg-success-lt'>Lunas</span>";
			}

			if ($pesanan->metode_bayar == "cash") {
				$metode = "<span class='badge text-white bg-success'>Cash</span>";
			} else if ($pesanan->metode_bayar == "transfer") {
				$metode = "<span class='badge text-white bg-warning'>Transafer</span>";
			} else {
				$metode = "<span class='badge text-white bg-danger'>Autodebit</span>";
			}

			if ($pesanan->jenis_order == "ambil_sendiri") {
				$jenis = "<span class='badge text-white bg-info'>Ambil Sendiri</span>";
			} else if ($pesanan->jenis_order == "dianterin") {
				$jenis = "<span class='badge text-white bg-info'>Dianterin</span>";
			} else {
				$jenis = "<span class='badge text-white bg-info'>Dianterin ke PT</span>";
			}
			$name = ($pesanan->nama_member === "" || $pesanan->nama_member === NULL) ? "Walk In Customer" :  $pesanan->nama_member;
			$nomor_induk = ($pesanan->nomor_induk === "" || $pesanan->nomor_induk === NULL) ? "-" :  $pesanan->nomor_induk;
			$avatarFolder = 'public/template/upload/user/';
			$defaultAvatar = 'default.png';
			$avatarFile = $pesanan->avatar ?: $defaultAvatar;
			$avatarPath = FCPATH . $avatarFolder . $avatarFile;

			$finalAvatar = file_exists($avatarPath)
				? base_url($avatarFolder . $avatarFile)
				: base_url($avatarFolder . $defaultAvatar);

			$avatarImg = "
				<img src=\"{$finalAvatar}\" 
					class=\"avatar avatar-md img-zoom\" 
					draggable=\"false\" 
					style=\"cursor: pointer\">
			";

			$no++;
			$row = array(
				$no,
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
						<li><a onclick="modalUbah(\'' . $pesanan->id_pesanan . '\')" href="javascript:void(0)" class="dropdown-item">Ubah Transaksi</a></li>
						<li><a onclick="BuktiTransaksi(\'' . $pesanan->id_pesanan . '\')" href="javascript:void(0)" class="dropdown-item">Bukti Transaksi</a></li>
						<li><a onclick="CetakInvoice(\'' . $pesanan->id_pesanan . '\')" href="javascript:void(0)" class="delete dropdown-item">Cetak Invoice</a></li>
						<li><a onclick="myQRCode(\'' . $pesanan->id_pesanan . '\')" href="javascript:void(0)" class="delete dropdown-item">Cetak QR Code</a></li>
						<li><a onclick="batalkanTransaksi(\'' . $pesanan->id_pesanan . '\')" href="javascript:void(0)" class="delete dropdown-item">Batalkan Transaksi</a></li>
					</ul>
				</div>
				',
				$avatarImg,
				$name,
				$nomor_induk,
				$pesanan->id_pesanan,
				date('d/m/Y H:i:s', strtotime($pesanan->tgl_pesanan)),
				$status . "<br><i class='text-info fw-bold'>" . ucwords($pesanan->metode_bayar) . "</i>",
				$pembayaran,
				"Rp. " . number_format($pesanan->grand_total),
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_pesanan', $joins, $where),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_pesanan', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $order), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function ajax_get_detail($id)
	{
		$draw = $this->input->post('draw');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search')['value'];

		$filter = ['nama_member'];
		$query = $this->db->select('*')->from('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('tb_pesanan_detail.id_pesanan', $id);
		$data = $this->M_Penjualan->getData($length, $start, $search, $query, $filter);

		$query1 = $this->db->select('*')->from('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('tb_pesanan_detail.id_pesanan', $id);
		$total_records = $this->M_Penjualan->getTotalData($query1);

		$query2 = $this->db->select('*')->from('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('tb_pesanan_detail.id_pesanan', $id);
		$total_filtered = $this->M_Penjualan->getFilteredData($search, $query2, $filter);

		$nomor_urut = $start + 1;
		$new_data = array();
		foreach ($data as $row) {
			$gambar = $row->gambar_barang == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png" ? "<img class=\"center\" style='\border-radius: 3px;height:70px' src='" . $row->gambar_barang . "'>" : "<img class=\"center\" style='\border-radius: 3px;height:70px' src='" . base_url('public/template/upload/barang/' . $row->gambar_barang) . "'>";
			// Tambahkan nomor urut ke setiap baris data
			$row->numbering = $nomor_urut;
			$row->gambar_barang = $gambar;
			$row->harga_saat_ini = ($row->harga_saat_ini);
			$row->sub_total_harga = "Rp. " .  number_format($row->harga_saat_ini * $row->jumlah_jual);
			$new_data[] = $row;
			$nomor_urut++;
		}

		$data = $new_data;

		$response = [
			'draw' => $draw,
			'recordsTotal' => $total_records,
			'recordsFiltered' => $total_filtered,
			'data' => $data,
		];

		echo json_encode($response);
	}

	public function detail($id)
	{
		$data['id'] = $id;
		$data['pesanan'] = $this->M_Crud->all_data('tb_pesanan')->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')->where('id_pesanan', $id)->get()->row_array();
		$data['barang'] = $this->M_Crud->all_data('tb_pesanan_detail')->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->where('tb_pesanan_detail.id_pesanan', $id)->get()->result_array();
		$data['tracking'] = $this->M_Crud->all_data('tb_pesanan_tracking')->join('tb_user', 'tb_user.id_user = tb_pesanan_tracking.updated_by')->where('id_pesanan', $id)->order_by('tb_pesanan_tracking.updated_at', 'DESC')->get()->result_array();

		$data['disiapkan'] = "";
		$data['dikirimkan'] = "";
		foreach ($data['tracking'] as $value) {
			if ($value['status_tracking'] == "Pesanan Disiapkan") {
				$data['disiapkan'] = "enabled";
			}

			if ($value['status_tracking'] == "Pesanan Dikirimkan") {
				$data['dikirimkan'] = "enabled";
			}
		}

		$this->load->view('level/admin/penjualan_detail', $data);
	}

	public function validasi_pesanan()
	{
		$id = $this->input->post('id');
		$serial = $this->input->post('scan_barcode');
		$cek = $this->M_Crud->all_data('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('id_pesanan', $id)->get()->result_array();

		$idPesananDetail = null;
		foreach ($cek as $data) {
			if ($data['barcode'] === $serial) {
				$idPesananDetail = $data['id_pesanan_detail'];
				break;
			}
		}

		if ($idPesananDetail !== null) {
			$this->M_Crud->update_data(['id_pesanan_detail' => $idPesananDetail], ['status_verified' => "1"], 'tb_pesanan_detail');
			$response = array(
				'success' => true,
				'msg' => "Pesanan Berhasil Divalidasi",
			);
		} else {
			$response = array(
				'success' => false,
				'msg' => "Serial tidak ditemukan",
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function status($id)
	{
		$cek = $this->M_Crud->all_data('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('id_pesanan', $id)->get()->result_array();

		$isStatusVerified = true;
		$totalHarga = 0;
		foreach ($cek as $data) {
			$hargaSaatIni = $data['harga_saat_ini'];
			$jumlahJual = $data['jumlah_jual'];

			// Menghitung harga total untuk setiap baris
			$hargaTotal = $hargaSaatIni * $jumlahJual;

			// Menambahkan harga total ke total keseluruhan
			$totalHarga += $hargaTotal;
		}

		foreach ($cek as $data) {
			if ($data['status_verified'] == "0") {
				$isStatusVerified = false;
				break;
			}
		}

		$response = array(
			'status' => $isStatusVerified,
			'total' => number_format($totalHarga)
		);

		echo json_encode($response);
	}

	public function faktur($invoice)
	{
		$this->load->library('pdf');
		$paper_size = 'A6'; // ukuran kertas
		$orientation = 'landscape'; //tipe format kertas potrait atau landscape
		$this->pdf->set_paper($paper_size, $orientation);
		$this->pdf->filename = "kwitansi-transaksi-$invoice.pdf";
		// nama file pdf yang di hasilkan
		$this->pdf->load_view('level/admin/penjualan_faktur');
	}

	// public function batalkan_siapkan($id)
	// {
	// 	$cek = $this->M_Crud->all_data('tb_pesanan_tracking')->where('status_tracking', 'Pesanan Disiapkan')->where('id_pesanan', $id)->delete();
	// 	redirect('penjualan/detail/' . $id);
	// }

	public function get_anggota()
	{
		if (!empty($this->input->post("q"))) {
			$keyword = $this->input->post('q');
		} else {
			$keyword = "";
		}

		$data = $this->M_Crud->all_data('tb_user')->where('level', 'User')->like('nama_member', $keyword)->or_like('nomor_induk', $keyword)->or_like('id_user', $keyword)->get()->result_array();
		echo json_encode($data);
	}

	public function get_anggota2()
	{
		if (!empty($this->input->post("q"))) {
			$keyword = $this->input->post('q');
		} else {
			$keyword = "";
		}

		$data = $this->M_Crud->all_data('tb_user')->where('level', 'User')->where('id_user', $keyword)->get()->row_array();
		echo json_encode($data);
	}

	public function get_bukti_transaksi($id)
	{
		// Select semua kolom dari tabel tb_pesanan_detail
		$this->db->select('*');
		$this->db->from('tb_pesanan_detail');
		$this->db->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan');
		$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg', 'left');
		$this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
		$this->db->join('tb_user_alamat', 'tb_user_alamat.id_alamat_user = tb_pesanan.id_alamat_user', 'left');
		$this->db->join('tb_kasir', 'tb_kasir.id_kasir = tb_pesanan.id_kasir', 'left');
		$this->db->join('tb_desa', 'tb_desa.id_desa = tb_user_alamat.id_desa', 'left');
		$this->db->where('tb_pesanan_detail.id_pesanan', $id);

		// Jalankan query
		$query = $this->db->get();

		// Mengonversi hasil query menjadi array
		$result = $query->result_array();

		// Tambahkan total_rows ke dalam $result
		$result[0]['total_rows'] = $query->num_rows();

		// Panggil fungsi untuk mendapatkan total belanja bulan ini dan kirimkan id_pesanan
		$result[0]['total_bulan_ini'] = $this->get_total_bulan_ini($id);

		// Mengembalikan data dalam bentuk JSON
		header('Content-Type: application/json');
		echo json_encode($result);
	}

	private function get_total_bulan_ini($id_pesanan)
	{
		// Ambil id_user berdasarkan id_pesanan
		$this->db->select('id_user');
		$this->db->from('tb_pesanan');
		$this->db->where('id_pesanan', $id_pesanan);
		$id_user_query = $this->db->get();
		$id_user_result = $id_user_query->row_array();

		if ($id_user_result) {
			$id_user = $id_user_result['id_user'];

			$start_date = date('Y-m-16'); // tanggal 16 bulan ini
			$end_date = date('Y-m-15', strtotime('+1 month')); // tanggal 15 bulan depan

			$this->db->select_sum('grand_total', 'total_bulan_ini');
			$this->db->from('tb_pesanan');
			$this->db->where('id_user', $id_user);
			$this->db->where('tgl_pesanan >=', $start_date);
			$this->db->where('tgl_pesanan <=', $end_date);

			$total_belanja_result = $this->db->get()->row_array();

			return $total_belanja_result['total_bulan_ini'] ?? 0;
		} else {
			return 0; // Jika id_user tidak ditemukan
		}
	}


	public function siapkan($id)
	{
		// Ambil pesanan + data user via JOIN
		$pesanan = $this->M_Crud
			->all_data('tb_pesanan')
			->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')
			->where('id_pesanan', $id)
			->get()
			->row_array();
		// Validasi: Pesanan tidak ditemukan

		if (!$pesanan) {
			$this->session->set_flashdata('error', 'Pesanan tidak ditemukan.');
			return redirect('penjualan', 'refresh');
		}

		// Validasi: Sudah dibatalkan
		if (strtolower($pesanan['status_pesanan']) === 'dibatalkan') {
			$this->session->set_flashdata('error', 'Pesanan telah dibatalkan sebelumnya.');
			return redirect('penjualan', 'refresh');
		}

		$data['id'] = $id;
		$data['pesanan'] = $this->M_Crud->all_data('tb_pesanan')->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')->where('id_pesanan', $id)->get()->row_array();
		$data['user'] = $this->M_Crud->all_data('tb_user')->where('id_user', $data['pesanan']['id_user'])->get()->row_array();

		$this->load->view('level/admin/penjualan_siapkan', $data);
	}

	public function disiapkan($id)
	{
		$user = $this->session->userdata('id_user');
		$check = $this->M_Crud->show('tb_pesanan', ['id_pesanan' => $id])->row_array();

		if ($check['status_pesanan'] == "Pending") {
			$data = [
				'id_pesanan' => $id,
				'status_tracking' => "Pesanan Disiapkan",
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $user
			];

			$this->M_Crud->input_data($data, 'tb_pesanan_tracking');
			$this->M_Crud->update_data(['id_pesanan' => $id], ['status_pesanan' => 'Dikemas'], 'tb_pesanan');

			$response = array(
				'status' => 'success',
				'message' => 'Pesanan berhasil dikemas.'
			);
		} else if ($check['status_pesanan'] == "Dikemas") {
			$response = array(
				'status' => 'error',
				'message' => 'Pesanan telah dikemas.. Action tambahan tidak diperlukan!'
			);
		} else if ($check['status_pesanan'] == "Dikirim") {
			$response = array(
				'status' => 'error',
				'message' => 'Pesanan sedang dikirim.. Action tambahan tidak diperlukan!'
			);
		} else {
			$response = array(
				'status' => 'error',
				'message' => 'Pesanan telah selesai.. Anda Tidak perlu menyiapkan pesanan!'
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function proses_ubah()
	{
		$id = $this->input->post('id_pesanan_ubah');
		$pesanan = $this->input->post('status');
		$pembayaran = $this->input->post('pembayaran');

		if ($pesanan == "Pending" or $pesanan == "Dikemas") {
			$this->M_Crud->update_data(
				['id_pesanan' => $id],
				['status_pesanan' => $pesanan, 'status_pembayaran' => $pembayaran],
				'tb_pesanan'
			);
		} else if ($pesanan == "Dikirim") {
			$user = $this->session->userdata('id_user');

			// UPDATE TB PESANAN
			$this->M_Crud->update_data(
				['id_pesanan' => $id],
				['status_pesanan' => $pesanan, 'status_pembayaran' => $pembayaran],
				'tb_pesanan'
			);

			// UPDATE TRACKING
			$data = [
				'id_pesanan' => $id,
				'status_tracking' => "Pesanan Dikirimkan",
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $user
			];
			$this->M_Crud->input_data($data, 'tb_pesanan_tracking');
		} else {
			$check = $this->M_Crud->all_data('tb_pesanan')->where('id_pesanan', $id)->get()->row_array();

			if ($check['jenis_order'] == 'ambil_sendiri' or $check['jenis_order'] == "dianterin_pt") {
				$cek_ketersediaan = $this->M_Crud->all_data('tb_pesanan_tracking')->where('id_pesanan', $id)->where('status_tracking', 'Pesanan Selesai')->get()->num_rows();

				if ($cek_ketersediaan <= 0) {
					$user = $this->session->userdata('id_user');

					$this->M_Crud->update_data(
						['id_pesanan' => $id],
						['status_pesanan' => $pesanan, 'status_pembayaran' => $pembayaran],
						'tb_pesanan'
					);

					$data = [
						'id_pesanan' => $id,
						'status_tracking' => "Pesanan Selesai",
						'updated_at' => date('Y-m-d H:i:s'),
						'updated_by' => $user
					];
					$this->M_Crud->input_data($data, 'tb_pesanan_tracking');
				} else {
					$this->M_Crud->update_data(
						['id_pesanan' => $id],
						['status_pesanan' => $pesanan, 'status_pembayaran' => $pembayaran],
						'tb_pesanan'
					);
				}
			} else {
				$this->M_Crud->update_data(
					['id_pesanan' => $id],
					['status_pesanan' => $pesanan, 'status_pembayaran' => $pembayaran],
					'tb_pesanan'
				);
			}
		}

		// Assuming the processing is successful, you can send a JSON response
		$response = array('status' => 'success', 'message' => 'Pesanan berhasil diubah');
		echo json_encode($response);
	}

	public function batalkan_transaksi($id_transaksi)
	{
		// Ambil data pesanan
		$pesanan = $this->M_Crud->show('tb_pesanan', ['id_pesanan' => $id_transaksi])->row_array();

		// Validasi: Transaksi tidak ditemukan
		if (!$pesanan) {
			return $this->output
				->set_status_header(404)
				->set_content_type('application/json')
				->set_output(json_encode([
					'success' => false,
					'msg' => "Transaksi tidak ditemukan.",
				]));
		}

		// Validasi: Sudah dibatalkan sebelumnya
		if (strtolower($pesanan['status_pesanan']) === 'dibatalkan') {
			return $this->output
				->set_status_header(400)
				->set_content_type('application/json')
				->set_output(json_encode([
					'success' => false,
					'msg' => "Transaksi sudah dibatalkan sebelumnya.",
				]));
		}

		// Update status pesanan
		$this->M_Crud->update_data(
			['id_pesanan' => $id_transaksi],
			[
				'status_pesanan' => 'Dibatalkan',
				'keterangan_pesanan' => 'Pesanan Dibatalkan.',
			],
			'tb_pesanan'
		);

		// Ambil detail barang dalam transaksi
		$barang_detail = $this->M_Crud
			->all_data('tb_pesanan_detail')
			->where('id_pesanan', $id_transaksi)
			->get()
			->result_array();

		// Ambil semua ID barang
		$id_barang = array_column($barang_detail, 'id_brg');

		// Ambil stok barang secara batch
		$stok_barang = $this->db
			->where_in('id_brg', $id_barang)
			->get('tb_barang')
			->result_array();

		// Mapping stok
		$stok_map = [];
		foreach ($stok_barang as $s) {
			$stok_map[$s['id_brg']] = $s;
		}

		foreach ($barang_detail as $item) {
			$id_brg = $item['id_brg'];
			$jumlah_restock = $item['jumlah_jual'];

			$stok_lama = isset($stok_map[$id_brg]['stock_brg']) ? (int)$stok_map[$id_brg]['stock_brg'] : 0;
			$stok_baru = $stok_lama + $jumlah_restock;

			// Update stok
			$this->M_Crud->update_data(
				['id_brg' => $id_brg],
				['stock_brg' => $stok_baru],
				'tb_barang'
			);

			// Catat riwayat stok
			$riwayat = [
				'id_brg' => $id_brg,
				'tgl_riwayat_stock' => date('Y-m-d H:i:s'),
				'jumlah_riwayat' => $jumlah_restock,
				'jenis_transaksi' => 'stock_masuk',
				'stock_sebelum' => $stok_lama,
				'stock_sesudah' => $stok_baru,
				'keterangan_riwayat_stock' => 'Pesanan Dibatalkan. Stok dikembalikan ke gudang.',
			];
			$this->M_Crud->input_data($riwayat, 'tb_riwayat_stock');
		}

		// Sukses
		return $this->output
			->set_status_header(200)
			->set_content_type('application/json')
			->set_output(json_encode([
				'success' => true,
				'msg' => "Transaksi berhasil dibatalkan.",
			]));
	}
}
