<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->load->model('M_Crud');
		$this->load->library('session');
		$this->auth->cek_login();
	}

	public function pusher()
	{
		$this->load->view('sample/pusher');
	}

	public function report()
	{
		$data['penjualan'] = $this->M_Crud->all_data('tb_pesanan')->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')->order_by('tgl_pesanan', 'DESC')->get()->result();
		$this->load->view('report/omset_penjualan', $data);
	}

	public function send_pusher_event()
	{
		$options = array(
			'cluster' => 'ap1',
			'useTLS' => true
		);

		// Inisialisasi objek Pusher
		$pusher = new Pusher\Pusher(
			'fe22024f3d888f7e4ae0',
			'f7967965f26b5b0760db',
			'1732080',
			$options
		);

		$id = 4171884;
		$data['user'] = $this->M_Crud->all_data('tb_pesanan')->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')->where(['id_pesanan' => $id])->get()->row_array();
		$data['pesanan'] = $this->M_Crud->all_data('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where(['id_pesanan' => $id])->get()->result_array();

		// Trigger event ke channel 'my-channel' dengan nama event 'my-event'
		$pusher->trigger('my-channel', 'my-event', $data);

		// Tambahkan log atau tanggapan sesuai kebutuhan

		echo "Pusher event terkirim!";
	}

	public function count_pending()
	{
		$pending = $this->M_Crud->all_data('tb_pesanan')->where('status_pesanan', 'Pending')->count_all_results();
		echo json_encode(['pendingOrders' => $pending]);
	}

	public function started()
	{
		$this->load->view('sample/started');
	}

	public function login()
	{
		$this->load->view('sample/login');
	}

	public function register()
	{
		$this->load->view('sample/register');
	}

	public function index()
	{
		if ($this->session->userdata('level') == "User") {
			$waktu_sekarang = date('H:i:s');

			if ($waktu_sekarang < '10:00:00') {
				$data['now'] = 'Selamat Pagi';
			} elseif ($waktu_sekarang < '15:00:00') {
				$data['now'] = 'Selamat Siang';
			} else {
				$data['now'] = 'Selamat Malam';
			}

			$data['barang'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->where('promo_brg', 'On')->get()->result_array();
			$data['kategori'] = $this->M_Crud->all_data('tb_kategori')->limit(5)->get()->result_array();
			$data['kategori1'] = $this->M_Crud->all_data('tb_kategori')->get()->result_array();
			$data['krisan'] = $this->db->select('tb_krisan.created_at, tb_krisan.id_user, kritik_saran, nama_member')->from('tb_krisan')->join('tb_user', 'tb_user.id_user = tb_krisan.id_user')->order_by('tb_krisan.created_at', 'desc')->limit(5)->get()->result_array();

			$user = $this->session->userdata('id_user');
			$data['count_keranjang'] = $this->M_Crud->all_data('tb_keranjang')->where('id_user', $user)->count_all_results();

			$keyword = $this->input->get('cari');

			if (!empty($keyword)) {
				$data2['barang_filter'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg', 'left')->like('nama_barang', $keyword)->get()->result_array();
				$this->load->view('level/user/index_pencarian', $data2);
			} else {
				$this->load->view('level/user/index', $data);
			}
		} else if ($this->session->userdata('level') == "Administrator" || $this->session->userdata('level') == "Kasir") {
			$data['total_transaksi'] = $this->M_Crud->all_data('tb_pesanan')->where('status_pesanan', 'Selesai')->where('DATE(tgl_pesanan)', date('Y-m-d'))->get()->num_rows();
			$data['ttl_harga'] = $this->db->select_sum('grand_total')->from('tb_pesanan')->where('status_pesanan', 'Selesai')->where('DATE(tgl_pesanan)', date('Y-m-d'))->get()->row()->grand_total;
			$data['total_harga_kemarin'] = $this->db->select_sum('grand_total')->from('tb_pesanan')->where('status_pesanan', 'Selesai')->where('DATE(tgl_pesanan)', date('Y-m-d', strtotime('-1 day')))->get()->row()->grand_total;
			$data['total_barang'] = $this->M_Crud->count('tb_barang');

			// CHART KE-1
			$currentMonth = date('m');
			$currentYear = date('Y');
			$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
			$dates = [];
			for ($day = 1; $day <= $daysInMonth; $day++) {
				// Format the date as 'd M'
				$formattedDate = date('d M', mktime(0, 0, 0, $currentMonth, $day, $currentYear));

				// Add the formatted date to the array
				$dates[] = $formattedDate;

				// Format the date for filtering in the database query as 'Y-m-d'
				$filterDate = date('Y-m-d', mktime(0, 0, 0, $currentMonth, $day, $currentYear));

				// Query to get the count and sum of grand_total for the specific date
				$this->db->select("COUNT(*) AS order_count, SUM(grand_total) AS total_amount");
				$this->db->from("tb_pesanan");
				$this->db->where("DATE(tgl_pesanan) =", $filterDate);
				$query = $this->db->get();

				// Fetch the result
				$result = $query->row();

				// Update the orderCounts and totalAmounts arrays
				$orderCounts[$day - 1] = $result ? $result->order_count : 0;
				$totalAmounts[$day - 1] = $result ? $result->total_amount : 0;
			}
			$data['dates'] = $dates;
			$data['orderCounts'] = $orderCounts;
			$data['totalAmounts'] = $totalAmounts;
			// END CHART KE-1


			// CHART KE-2
			$this->db->select('tb_barang.id_kategori_brg,tb_kategori.nama_kategori_brg, COUNT(tb_pesanan_detail.id_pesanan) as order_count');
			$this->db->from('tb_barang');
			$this->db->join('tb_pesanan_detail', 'tb_pesanan_detail.id_brg = tb_barang.id_brg');
			$this->db->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg');
			$this->db->group_by('tb_barang.id_kategori_brg');

			$query = $this->db->get();
			$data['orders_by_category'] = $query->result();
			// END CHART KE-2

			// CHART KE-3
			$this->db->select('tb_kasir.id_kasir, tb_kasir.nama_kasir, COUNT(tb_pesanan.id_pesanan) as total_penjualan');
			$this->db->from('tb_kasir');
			$this->db->join('tb_pesanan', 'tb_pesanan.id_kasir = tb_kasir.id_kasir', 'left');
			$this->db->group_by('tb_kasir.id_kasir');
			$query = $this->db->get();
			$data['order_by_cashier'] = $query->result_array();
			// END CHART KE-3

			// PRODUK TERLARIS
			$this->db->select('tb_pesanan_detail.id_brg, 
                    COUNT(tb_pesanan_detail.id_brg) as jumlah_penjualan, 
                    SUM(tb_pesanan_detail.jumlah_jual) as total_terjual, 
                    tb_barang.nama_barang, 
                    tb_barang.gambar_barang,
                    tb_barang.stock_brg,
                    tb_satuan.nama_satuan,
					tb_barang.barcode');
			$this->db->from('tb_pesanan_detail');
			$this->db->join('tb_barang', 'tb_pesanan_detail.id_brg = tb_barang.id_brg', 'left');
			$this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
			$this->db->group_by('tb_pesanan_detail.id_brg');
			$this->db->order_by('total_terjual', 'DESC');
			$this->db->limit(5);

			$pl = $this->db->get();
			$data['produk_terlaris'] = $pl->result_array();
			// END PRODUK TERLARIS


			// PRODUK TERLARIS BULAN INI
			$this->db->select('tb_pesanan_detail.id_brg, 
                    COUNT(tb_pesanan_detail.id_brg) as jumlah_penjualan, 
                    SUM(tb_pesanan_detail.jumlah_jual) as total_terjual, 
                    tb_pesanan.tgl_pesanan, 
                    tb_barang.nama_barang, 
                    tb_barang.stock_brg, 
                    tb_barang.gambar_barang, 
                    tb_satuan.nama_satuan,
                    tb_barang.barcode');
			$this->db->from('tb_pesanan_detail');
			$this->db->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan', 'left');
			$this->db->join('tb_barang', 'tb_pesanan_detail.id_brg = tb_barang.id_brg', 'left');
			$this->db->join('tb_satuan', 'tb_barang.id_satuan = tb_satuan.id_satuan', 'left');
			$this->db->where("DATE_FORMAT(tb_pesanan.tgl_pesanan, '%Y-%m') = '" . date('Y-m') . "'");
			$this->db->group_by('tb_pesanan_detail.id_brg, tb_pesanan.tgl_pesanan, tb_barang.nama_barang, tb_barang.gambar_barang, tb_satuan.nama_satuan, tb_barang.barcode');
			$this->db->order_by('total_terjual', 'DESC');
			$this->db->limit(5);

			$pl = $this->db->get();
			$data['produk_terlaris_b'] = $pl->result_array();
			// END PRODUK TERLARIS BULAN INI


			// CHART KE-4
			$this->db->select('jenis_order, COUNT(*) as jumlah');
			$this->db->from('tb_pesanan');
			$this->db->group_by('jenis_order');
			$query = $this->db->get();
			$data['jenis_order'] = $query->result();

			$jenisOrderChart = [
				'labels' => [],
				'series' => [],
			];

			foreach ($data['jenis_order'] as $row) {
				$label = str_replace(['_', '-'], ' ', $row->jenis_order);
				$jenisOrderChart['labels'][] = ucwords($label);
				$jenisOrderChart['series'][] = intval($row->jumlah);
			}

			$data['jenis_order_chart'] = $jenisOrderChart;
			// END CHART KE-4

			// CHART KE-5
			$this->db->select('status_pesanan, COUNT(*) as jumlah');
			$this->db->from('tb_pesanan');
			$this->db->group_by('status_pesanan');
			$query = $this->db->get();
			$data['status_pesanan'] = $query->result();

			$statusPesanan = [
				'labels' => [],
				'series' => [],
			];

			foreach ($data['status_pesanan'] as $row) {
				$statusPesanan['labels'][] = $row->status_pesanan;
				$statusPesanan['series'][] = intval($row->jumlah);
			}

			$data['status_pesanan_chart'] = $statusPesanan;
			// END CHART KE-5

			// CHART KE-6
			$this->db->select('metode_bayar, COUNT(*) as jumlah');
			$this->db->from('tb_pesanan');
			$this->db->group_by('metode_bayar');
			$query = $this->db->get();
			$data['metode_bayar'] = $query->result();

			$metodeBayar = [
				'labels' => [],
				'series' => [],
			];

			foreach ($data['metode_bayar'] as $row) {
				$metodeBayar['labels'][] = ucwords($row->metode_bayar);
				$metodeBayar['series'][] = intval($row->jumlah);
			}

			$data['metode_bayar_chart'] = $metodeBayar;
			// END CHART KE-6

			// CHART KE-7
			$this->db->select('status_pembayaran, COUNT(*) as jumlah');
			$this->db->from('tb_pesanan');
			$this->db->group_by('status_pembayaran');
			$query = $this->db->get();
			$data['status_pembayaran'] = $query->result();

			$statusBayar = [
				'labels' => [],
				'series' => [],
			];

			foreach ($data['status_pembayaran'] as $row) {
				$statusBayar['labels'][] = ucwords($row->status_pembayaran);
				$statusBayar['series'][] = intval($row->jumlah);
			}

			$data['status_pembayaran_chart'] = $statusBayar;
			// END CHART KE-7

			// 4 CHART AWAL
			$data['monthSekarang'] = date('F Y');
			$data['monthLalu'] = date('F Y', strtotime('-1 month'));

			$data['penjualan'] = $this->db->select('SUM(CASE WHEN MONTH(tgl_pesanan) = MONTH(CURDATE()) AND YEAR(tgl_pesanan) = YEAR(CURDATE()) THEN 1 ELSE 0 END) as total_bulan_ini, SUM(CASE WHEN MONTH(tgl_pesanan) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(tgl_pesanan) = YEAR(CURDATE() - INTERVAL 1 MONTH) THEN 1 ELSE 0 END) as total_bulan_lalu, COUNT(*) as total_semua')->from('tb_pesanan')->get()->row();

			$data['rp'] = $this->db->select('SUM(CASE WHEN MONTH(tgl_pesanan) = MONTH(CURDATE()) AND YEAR(tgl_pesanan) = YEAR(CURDATE()) THEN grand_total ELSE 0 END) as total_bulan_ini, SUM(CASE WHEN MONTH(tgl_pesanan) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(tgl_pesanan) = YEAR(CURDATE() - INTERVAL 1 MONTH) THEN grand_total ELSE 0 END) as total_bulan_lalu, SUM(grand_total) as total_semua')->from('tb_pesanan')->get()->row();

			$data['rp_lunas'] = $this->db->select('SUM(CASE WHEN MONTH(tgl_pesanan) = MONTH(CURDATE()) AND YEAR(tgl_pesanan) = YEAR(CURDATE()) THEN grand_total ELSE 0 END) as total_bulan_ini, SUM(CASE WHEN MONTH(tgl_pesanan) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(tgl_pesanan) = YEAR(CURDATE() - INTERVAL 1 MONTH) THEN grand_total ELSE 0 END) as total_bulan_lalu, SUM(grand_total) as total_semua')->from('tb_pesanan')->where('status_pembayaran', 'Lunas')->get()->row();

			$data['autodebit'] = $this->db->select('SUM(CASE WHEN MONTH(tgl_pesanan) = MONTH(CURDATE()) AND YEAR(tgl_pesanan) = YEAR(CURDATE()) THEN grand_total ELSE 0 END) as total_bulan_ini, SUM(CASE WHEN MONTH(tgl_pesanan) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(tgl_pesanan) = YEAR(CURDATE() - INTERVAL 1 MONTH) THEN grand_total ELSE 0 END) as total_bulan_lalu, SUM(grand_total) as total_semua')->from('tb_pesanan')->where('metode_bayar', 'autodebet')->where('status_pembayaran', 'Menunggu Pembayaran')->get()->row();


			// END

			$this->load->view('level/admin/index', $data);
		} else if ($this->session->userdata('level') == "Kurir") {
			$current_date = date('Y-m-d');
			for ($i = 0; $i < 7; $i++) { // Ubah batasan loop menjadi 7
				$last_7_dates[] = date('d/M', strtotime("-$i days", strtotime($current_date)));
			}
			$data['last_7_dates'] = json_encode(array_reverse($last_7_dates));

			$total_sum_per_date = array();
			$total_keseluruhan = 0;
			// Loop untuk menghitung total sum per tanggal dalam rentang 7 hari terakhir
			for ($i = 0; $i < 7; $i++) {
				// Menghitung tanggal berdasarkan hari dalam rentang 7 hari terakhir
				$date_to_check = date('Y-m-d', strtotime("-$i days", strtotime($current_date)));

				// Query untuk mengambil total sum per tanggal
				$this->db->select_sum('total_bayar');
				$this->db->from('tb_pesanan');
				$this->db->where('jenis_order', 'dianterin');
				$this->db->where('status_pesanan', 'selesai');
				$this->db->where('metode_bayar', 'cash');
				$this->db->where('tgl_pesanan', $date_to_check);
				$query = $this->db->get();

				// Mendapatkan hasil query
				$result = $query->row();
				$total_keseluruhan += $result->total_bayar;

				// Menyimpan total sum ke dalam array
				$total_sum_per_date[$date_to_check] = $result->total_bayar;
			}
			$data['json_total_sum_per_date'] = json_encode($total_sum_per_date);
			$data['total_7days'] = $total_keseluruhan;
			$data['pending'] = $this->db->select('COUNT(*) as total_data')->from('tb_pesanan')->where('status_pesanan', 'pending')->where('jenis_order', 'dianterin')->get()->row_array();
			$data['success'] = $this->db->select('COUNT(*) as total_data')->from('tb_pesanan')->where('status_pesanan', 'selesai')->where('jenis_order', 'dianterin')->get()->row_array();
			$data['misi'] = $this->db->select('COUNT(*) as total_data')->from('tb_pesanan')->where('status_pesanan', 'Dikirim')->where('jenis_order', 'dianterin')->get()->row_array();
			$data['setoran'] = $this->db->select('SUM(total_bayar) as total_pembayaran')->from('tb_pesanan')->where('metode_bayar', 'cash')->where('status_pesanan', 'selesai')->where('jenis_order', 'dianterin')->get()->row_array();

			// Mendapatkan hasil query
			$result = $query->row();
			$this->load->view('level/kurir/index', $data);
		} else {
			$this->load->view('level/kasir/index');
		}
	}

	public function load_more_data()
	{
		$page = $this->input->get('page');
		$keyword = $this->input->get('cari');

		$barang = $this->M_Crud->all_data('tb_barang')
			->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg', 'left')
			->like('nama_barang', $keyword)
			->limit(10, ($page - 1) * 10) // Sesuaikan dengan jumlah data yang akan dimuat per halaman
			->get()
			->result_array();

		$output = '<div class="row">';
		foreach ($barang as $key => $value) {
			$output .= '
        <div class="col-6 col-lg-6 col-md-6 col-sm-6 d-flex">
            <div class="card w-100 my-2 shadow-2-strong">
                <img src="' . base_url('public/template/upload/barang/' . $value['gambar_barang']) . '" class="card-img-top mt-3" style="height:120px;width:auto;object-fit:contain;">
                <div class="card-body d-flex flex-column">
                    <p class="card-text mb-0 fs-5 ellipsis" style="font-weight: 400;">' . $value['nama_barang'] . '</p>';

			if ($value['promo_brg'] == 'On') {
				$output .= '<h4 class="fw-bold mb-1 me-1">RP. ' . number_format($value['harga_promo']) . '</h4>
                    <div class="d-flex mb-0">
                        <p class="fs-5 mb-1"><span class="badge bg-danger text-white me-2">' . number_format(($value['harga_jual_barang'] - $value['harga_promo']) / $value['harga_jual_barang'] * 100, 2) . '%</span></p>
                        <p class="fs-5 text-muted mb-1"><del>Rp. ' . number_format($value['harga_jual_barang']) . '</del></p>
                    </div>';
			} else {
				$output .= '<h4 class="fw-bold mb-1 me-1">RP. ' . number_format($value['harga_jual_barang']) . '</h4>';
			}

			$query = $this->db->query("SELECT COUNT(*) as jumlah_jual FROM tb_pesanan_detail WHERE id_brg = ?", $value['id_brg']);
			$result = $query->row();
			$jumlah_jual = $result->jumlah_jual;

			$output .= '
                    <p class="mb-2 fs-5 text-dark" style="font-weight: 500;">
						' . number_format($jumlah_jual) . ' Terjual ' . $value['stock_brg'] . ' Stok Tersedia
					</p>

                    <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                        <a onclick="showAlert(\'' . $value['id_brg'] . '\')" href="javascript:void(0)" class="btn btn-primary shadow-0 me-1 add_keranjang">+ Keranjang</a>
                    </div>
                </div>
            </div>
        </div>';
		}

		$output .= '</div>';

		echo $output;
	}

	public function barang($id)
	{
		$user = $this->session->userdata('id_user');
		$data['barang'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->where('id_brg', $id)->get()->row_array();
		$data['keranjang'] = $this->M_Crud->all_data('tb_keranjang')->where('id_brg', $id)->where('id_user', $user)->get()->row_array();

		$this->load->view('level/user/index_single_product', $data);
	}

	public function kategori($id)
	{
		$cek = $this->M_Crud->show('tb_kategori', ['id_kategori_brg' => $id])->row_array();
		$data['barang'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->where('tb_barang.id_kategori_brg', $id)->get()->result_array();
		$data['id'] = $id;
		$data['header'] = $cek['nama_kategori_brg'];
		$this->load->view('level/user/index_kategori', $data);
	}

	public function load_kategori()
	{
		$id = $this->input->get('id');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;
		$limit = 10; // Jumlah barang per halaman

		// Menghitung offset berdasarkan halaman yang diminta
		$offset = ($page - 1) * $limit;

		// Memuat data barang dari model (sesuaikan dengan struktur tabel Anda)
		$barang = $this->M_Crud->all_data('tb_barang')
			->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')
			->where('tb_barang.id_kategori_brg', $id)
			->limit($limit)
			->offset($offset)
			->get()
			->result_array();

		// Memuat jumlah penjualan untuk setiap barang
		foreach ($barang as &$item) {
			$query = $this->db->query("SELECT COUNT(*) as jumlah_jual FROM tb_pesanan_detail WHERE id_brg = ?", $item['id_brg']);
			$result = $query->row();
			$item['jumlah_jual'] = $result->jumlah_jual;

			// Format harga barang menggunakan number_format
			$item['harga_jual_barang'] = number_format($item['harga_jual_barang'], 0, ',', '.');
			$item['harga_promo'] = number_format($item['harga_promo'], 0, ',', '.');
		}

		// Mengirim data dalam format JSON
		echo json_encode(['barang' => $barang]);
	}

	public function alamat()
	{
		$data['header'] = "Pilih Alamat";
		$this->load->view('layouts/user/header');
		$this->load->view('level/user/index_alamat', $data);
		$this->load->view('layouts/user/footer');
	}

	public function tambah_alamat()
	{
		$data['header'] = "Alamat Baru";
		$this->load->view('layouts/user/header');
		$this->load->view('level/user/index_alamat_tambah', $data);
		$this->load->view('layouts/user/footer');
	}

	public function saran()
	{
		$data['header'] = "Kritik dan Saran";
		$data['user'] = $this->M_Crud->show('tb_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$data['saran'] = $this->M_Crud->all_data('tb_krisan')->join('tb_user', 'tb_user.id_user = tb_krisan.id_user')->where('tb_krisan.id_user', $this->session->userdata('id_user'))->get()->result_array();
		$this->load->view('level/user/index_saran', $data);
	}

	public function plus_saran()
	{
		$data = array(
			'id_user' => $this->input->post('id_user'),
			'perihal' => $this->input->post('perihal'),
			'kritik_saran' => $this->input->post('kritik_saran'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->M_Crud->input_data($data, 'tb_krisan');

		$message = "Kritik dan Saran dari : " . $this->input->post('wa_member') . "\n";
		$message .= "Waktu : " .  date('Y-m-d H:i:s') . "\n";
		$message .= "Perihal : " . $this->input->post('perihal') . "\n\n";

		$message .= "Isi Kritik saran:\n";
		$message .= $this->input->post('kritik_saran');

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.fonnte.com/send",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => array(
				'target' => "6285277961769",
				'message' => $message,
				'url' => "https://asset-a.grid.id/crop/0x0:0x0/945x630/photo/2018/06/07/3026687346.png",
				'filename' => "filename",
			),
			CURLOPT_HTTPHEADER => array(
				'Authorization: #7VISHMuycE3qmEw8UMW'
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}

		$this->session->set_flashdata('success_message', 'Kritik dan Saran Berhasil Ditambahkan!');
		redirect('home/saran');
	}

	public function plus_saran2()
	{
		$data = array(
			'id_user' => $this->input->post('id_user'),
			'perihal' => $this->input->post('perihal'),
			'kritik_saran' => $this->input->post('kritik_saran'),
			'created_at' => date('Y-m-d H:i:s')
		);

		$this->M_Crud->input_data($data, 'tb_krisan');

		$message = "Kritik dan Saran dari : " . $this->input->post('wa_member') . "\n";
		$message .= "Waktu : " .  date('Y-m-d H:i:s') . "\n";
		$message .= "Perihal : " . $this->input->post('perihal') . "\n\n";

		$message .= "Isi Kritik saran:\n";
		$message .= $this->input->post('kritik_saran');

		$nomorTujuan = "628881456200"; // Ganti dengan nomor WhatsApp tujuan
		$pesanWhatsApp = urlencode("$message");
		echo "<script>
            window.open('https://wa.me/$nomorTujuan/?text=$pesanWhatsApp', '_blank');
            window.location.href = '" . base_url('home/saran') . "'; // Ganti dengan base_url Anda
          </script>";
		exit();
	}
}
