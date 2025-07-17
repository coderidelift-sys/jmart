<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once(FCPATH . 'vendor/autoload.php');

use Duitku\Pop;
use Mpdf\Mpdf;

class Pesanan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->load->model('M_Crud');
		$this->load->model('M_Pagination');
		$this->auth->cek_login();
	}

	public function rating()
	{
		if ($this->input->is_ajax_request()) {
			$ratings = $this->input->post('ratings');
			$review = $this->input->post('review');

			$this->M_Crud->input_data(
				[
					'id_pesanan' => $this->input->post('id_pesanan'),
					'id_user' => $this->session->userdata('id_user'),
					'tgl_rating' => date('Y-m-d H:i:s'),
					'komentar' => $review
				],
				'tb_rating'
			);

			$last_id = $this->db->insert_id();

			foreach ($ratings as $ratingData) {
				$id_brg = $ratingData['id_brg'];
				$rating = $ratingData['rating'];

				// Proses data rating untuk setiap elemen
				// Contoh: Simpan data ke dalam database
				$data_to_insert = array(
					'id_rating' => $last_id,
					'id_brg' => $id_brg,
					'rating' => $rating
				);

				$this->M_Crud->input_data($data_to_insert, 'tb_rating_detail');
			}

			echo json_encode(array('message' => 'Data rating berhasil disimpan.'));
		} else {
			show_404();
		}
	}

	public function user()
	{
		$current_date = date('Y-m-d');
		$total_sum_per_date = array();
		for ($i = 0; $i < 7; $i++) {
			// Menghitung tanggal berdasarkan hari dalam rentang 7 hari terakhir
			$date_to_check = date('Y-m-d', strtotime("-$i days", strtotime($current_date)));

			// Query untuk mengambil total sum per tanggal
			$this->db->select('*');
			$this->db->from('tb_pesanan');
			$this->db->where('jenis_order', 'dianterin');
			$this->db->where('status_pesanan', 'selesai');
			$this->db->where('tgl_pesanan', $date_to_check);
			$query = $this->db->get();

			// Mendapatkan hasil query
			$result = $query->num_rows();

			// Menyimpan total sum ke dalam array
			$total_sum_per_date[$date_to_check] = $result;
		}
		$data['json_total_sum_per_date'] = json_encode($total_sum_per_date);
		$data['pending'] = $this->db->select('*')->from('tb_pesanan')->where('jenis_order', 'dianterin')->where('status_pesanan', 'pending')->get()->num_rows();
		$data['dikemas'] = $this->db->select('*')->from('tb_pesanan')->where('jenis_order', 'dianterin')->where('status_pesanan', 'dikemas')->get()->num_rows();
		$data['misi'] = $this->db->select('*')->from('tb_pesanan')->where('jenis_order', 'dianterin')->where('status_pesanan', 'dikirimkan')->get()->num_rows();
		$data['selesai'] = $this->db->select('*')->from('tb_pesanan')->where('jenis_order', 'dianterin')->where('status_pesanan', 'selesai')->get()->num_rows();
		$data["pesanan"] = $this->M_Crud->all_data(['tb_pesanan'])->join('tb_user', 'tb_pesanan.id_user = tb_user.id_user')->where('status_pesanan', 'selesai')->where('jenis_order', 'dianterin')->get()->result();
		$this->load->view('level/kurir/pesanan', $data);
	}

	function getIndonesianMonth($monthNumber)
	{
		$bulan = [
			1 => 'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		];
		return $bulan[(int)$monthNumber];
	}

	public function index()
	{
		$id = $this->session->userdata('id_user');
		$data['count_pending'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('status_pesanan', 'Pending')->get()->num_rows();
		$data['count_dikemas'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('status_pesanan', 'Dikemas')->get()->num_rows();
		$data['count_dikirim'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('status_pesanan', 'Dikirim')->get()->num_rows();
		$data['count_selesai'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('status_pesanan', 'Selesai')->get()->num_rows();
		$data['count_autodebit'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('metode_bayar', 'autodebet')->get()->num_rows();
		$data['count_bulan_ini'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('MONTH(tgl_pesanan)', date('m'))->get()->num_rows();

		$data['rupiah_bulan_ini'] = $this->db->select_sum('grand_total', 'total_grand_total')->from('tb_pesanan')->where('MONTH(tgl_pesanan)', date('m'))->where('id_user', $id)->get()->row();
		$data['rupiah_semua'] = $this->db->select_sum('grand_total', 'total_grand_total')->from('tb_pesanan')->where('id_user', $id)->get()->row();

		$data['pesanan'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->get()->result_array();
		$autodebit = $this->db
			->select_sum('grand_total', 'total_grand_total')
			->from('tb_pesanan')
			->where('metode_bayar', 'autodebet')
			->where('status_pembayaran', 'Menunggu Pembayaran')
			->where('id_user', $id)
			->get();
		// $autodebit_bulan_ini = $this->db
		// 	->select_sum('grand_total', 'total_grand_total')
		// 	->from('tb_pesanan')
		// 	->where('metode_bayar', 'autodebet')
		// 	->where('status_pembayaran', 'Menunggu Pembayaran')
		// 	->where('id_user', $id)
		// 	->where('tgl_pesanan >=', date('Y-m-16', strtotime('last month')))
		// 	->where('tgl_pesanan <=', date('Y-m-15'))
		// 	->get();

		// $data['autodebit_bulan_ini'] = ($autodebit_bulan_ini->num_rows() > 0) ? $autodebit_bulan_ini->row()->total_grand_total : 0;
		$data['autodebit'] = $autodebit->row()->total_grand_total ?? 0;

		// Ambil offset dari query parameter (?offset=...); default 0
		$offset = (int) ($this->input->get('offset') ?? 0);

		// Hari ini
		$today = new DateTime();
		$current_day = (int) $today->format('d');

		// Hitung tanggal awal periode sekarang
		$base_start = new DateTime('16 ' . $today->format('F Y'));
		if ($current_day < 16) {
			$base_start->modify('-1 month');
		}

		// Geser berdasarkan offset (0 = bulan ini, -1 = sebelumnya, +1 = berikutnya)
		$start_date = clone $base_start;
		$start_date->modify("{$offset} month");
		$end_date = clone $start_date;
		$end_date->modify('+1 month')->modify('-1 day');

		// Batas maksimal offset = periode berjalan
		$max_offset = 0;
		$is_last_period = ($offset >= $max_offset);

		// Simpan ke view
		$data['start_date'] = $start_date->format('Y-m-d');
		$data['end_date'] = $end_date->format('Y-m-d');
		$data['offset'] = $offset;
		$data['is_last_period'] = $is_last_period;

		// Query autodebit
		$autodebit = $this->db
			->select_sum('grand_total', 'total_grand_total')
			->from('tb_pesanan')
			->where('metode_bayar', 'autodebet')
			->where('status_pembayaran', 'Menunggu Pembayaran')
			->where('id_user', $id)
			->where('tgl_pesanan >=', $data['start_date'])
			->where('tgl_pesanan <=', $data['end_date'])
			->get();

		$data['autodebit_bulan_ini'] = $autodebit->row()->total_grand_total ?? 0;

		// Nama bulan & tahun untuk tampilan
		$nama_bulan = $this->getIndonesianMonth($start_date->format('n')); // 1-12
		$tahun = $start_date->format('Y');

		$data['bulan_tahun'] = $nama_bulan . ' ' . $tahun;


		if ($this->input->get('tahun') == null) {
			$tahun = date('Y');
		} else {
			$tahun = $this->input->get('tahun');
		}

		$query = $this->db->query("SELECT MONTH(tgl_pesanan) as bulan, SUM(grand_total) as total_penjualan FROM tb_pesanan WHERE id_user = ? AND YEAR(tgl_pesanan) = ? GROUP BY MONTH(tgl_pesanan)", array($this->session->userdata('id_user'), $tahun));
		$result = $query->result();

		// Inisialisasi array untuk menyimpan data penjualan per bulan
		$data['penjualan'] = array_fill(0, 12, 0);

		// Memasukkan hasil query ke dalam array penjualan
		foreach ($result as $row) {
			$data['penjualan'][$row->bulan - 1] = $row->total_penjualan;
		}

		$this->load->view('level/user/menu_pesanan', $data);
	}

	public function pending()
	{
		$id = $this->session->userdata('id_user');
		$data['pending'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('status_pesanan', 'Pending')->order_by('tgl_pesanan', 'DESC')->get()->result_array();
		$this->load->view('level/user/menu_pesanan_pending', $data);
	}

	public function dikemas()
	{
		$id = $this->session->userdata('id_user');
		$data['dikemas'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('status_pesanan', 'Dikemas')->order_by('tgl_pesanan', 'DESC')->get()->result_array();
		$this->load->view('level/user/menu_pesanan_dikemas', $data);
	}

	public function dikirim()
	{
		$id = $this->session->userdata('id_user');
		$data['dikirim'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('status_pesanan', 'Dikirim')->order_by('tgl_pesanan', 'DESC')->get()->result_array();
		$this->load->view('level/user/menu_pesanan_dikirim', $data);
	}

	public function selesai()
	{
		$id = $this->session->userdata('id_user');
		$data['selesai'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('status_pesanan', 'Selesai')->order_by('tgl_pesanan', 'DESC')->get()->result_array();
		$this->load->view('level/user/menu_pesanan_selesai', $data);
	}

	public function cancelled()
	{
		$this->load->view('level/user/menu_pesanan_cancelled');
	}

	public function all()
	{
		$data['pesanan'] = $this->M_Crud->all_data('tb_pesanan')->join('tb_user', 'tb_pesanan.id_user = tb_user.id_user')->get()->result_array();
		$this->load->view('level/admin/pesanan_all', $data);
	}

	public function detail($id)
	{
		$id_user = $this->session->userdata('id_user');
		$data['pesanan'] = $this->M_Crud->all_data('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('id_pesanan', $id)->get()->result_array();
		$data['id'] = $id;
		$data['alamat'] = $this->M_Crud->all_data('tb_user_alamat')->join('tb_desa', 'tb_desa.id_desa = tb_user_alamat.id_desa')->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_desa.id_kecamatan')->join('tb_kabupaten', 'tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten')->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi')->where('id_user', $id_user)->where('set_default', 'Main')->get()->row_array();
		$data['lacak'] = $this->M_Crud->all_data('tb_pesanan_tracking')->join('tb_pesanan', 'tb_pesanan_tracking.id_pesanan = tb_pesanan.id_pesanan')->where('tb_pesanan_tracking.id_pesanan', $id)->join('tb_user', 'tb_user.id_user = tb_pesanan_tracking.updated_by')->order_by('tb_pesanan_tracking.updated_at', 'DESC')->get()->result_array();
		$data['detail'] = $this->M_Crud->show('tb_pesanan', ['id_pesanan' => $id])->row_array();
		$this->load->view('level/user/menu_pesanan_detail', $data);
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

			// Hitung total belanja bulan ini untuk id_user
			$this->db->select_sum('grand_total', 'total_bulan_ini');
			$this->db->from('tb_pesanan');
			$this->db->where('id_user', $id_user); // Menggunakan id_user yang ditemukan
			$this->db->where('MONTH(tgl_pesanan)', date('m')); // Bulan sekarang
			$this->db->where('YEAR(tgl_pesanan)', date('Y'));  // Tahun sekarang
			$total_belanja_query = $this->db->get();
			$total_belanja_result = $total_belanja_query->row_array();

			return $total_belanja_result['total_bulan_ini'] ?? 0;
		} else {
			return 0; // Jika id_user tidak ditemukan
		}
	}

	public function cetak($id)
	{
		// Ambil detail pesanan + relasi
		$this->db->select('tb_pesanan.*, tb_kasir.nama_kasir, tb_user.nama_member');
		$this->db->from('tb_pesanan');
		$this->db->join('tb_kasir', 'tb_kasir.id_kasir = tb_pesanan.id_kasir', 'left');
		$this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
		$this->db->where('tb_pesanan.id_pesanan', $id);
		$detail = $this->db->get()->row_array();

		// Ambil item pesanan
		$this->db->select('tb_pesanan_detail.*, tb_barang.nama_barang, tb_barang.harga_jual_barang as harga_saat_ini, tb_barang.harga_promo, tb_barang.promo_brg');
		$this->db->from('tb_pesanan_detail');
		$this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg', 'left');
		$this->db->where('tb_pesanan_detail.id_pesanan', $id);
		$pesanan = $this->db->get()->result_array();

		// Total bulan ini
		$autodebit_bulan_ini = $this->get_total_bulan_ini($id);

		// Kirim data ke view
		$data = [
			'detail' => $detail,
			'pesanan' => $pesanan,
			'autodebit_bulan_ini' => $autodebit_bulan_ini
		];

		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => [80, 200], // tetap tetapkan awal
			'margin_top' => 10,
			'margin_bottom' => 10,
			'margin_left' => 10,
			'margin_right' => 10,
			'tempDir' => __DIR__ . '/tmp', // untuk jaga-jaga
		]);

		$mpdf->useFixedNormalLineHeight = false;
		$mpdf->keep_table_proportions = true;

		// Trik: paksa mPDF menyesuaikan tinggi
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetAutoPageBreak(true, 0);

		// Generate konten HTML
		$html = $this->load->view('level/user/invoice_transaksi', $data, true);
		$mpdf->WriteHTML($html);

		// Output PDF
		$mpdf->Output('invoice_pesanan_' . $id . '.pdf', 'D');
	}

	public function tracking($id)
	{
		$data['pesanan'] = $this->M_Crud->all_data('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where('id_pesanan', $id)->get()->result_array();
		$data['lacak'] = $this->M_Crud->all_data('tb_pesanan_tracking')->join('tb_pesanan', 'tb_pesanan_tracking.id_pesanan = tb_pesanan.id_pesanan')->where('tb_pesanan_tracking.id_pesanan', $id)->join('tb_user', 'tb_user.id_user = tb_pesanan_tracking.updated_by')->order_by('tb_pesanan_tracking.updated_at', 'DESC')->get()->result_array();
		$data['id'] = $id;
		$this->load->view('level/user/menu_pesanan_stepper', $data);
	}

	public function create()
	{
		$id = $this->session->userdata('id_user');
		$id_pesanan = rand(10000, 10000000);
		$nama = $this->M_Crud->show('tb_user', ['id_user' => $id])->row_array();

		$total = $this->input->post('total');
		$ongkos = $this->input->post('ongkos');
		$keterangan = $this->input->post('keterangan');

		// Remove non-numeric characters
		$totalNumeric = preg_replace("/[^0-9]/", "", $total);
		$totalNumeric2 = preg_replace("/[^0-9]/", "", $ongkos);

		// Convert the result to an integer
		$grand = (int)$totalNumeric;
		$ongkir = (int)$totalNumeric2;

		$data_pesanan = array(
			'id_pesanan' => $id_pesanan,
			'id_user' => $id,
			'tgl_pesanan' => date('Y-m-d H:i:s'),
			'atas_nama' => $nama['nama_member'],
			'keterangan_pesanan' => $keterangan,
			'tipe_order' => 'ONLINE',
			'jenis_order' => $this->input->post('jenis'),
			'status_pembayaran' => "Menunggu Pembayaran",
			'metode_bayar' => $this->input->post('metode'),
			'status_pesanan' => "Pending",
			'diskon' => 0,
			'grand_total' => $grand,
			'ongkos_kirim' => $ongkir,
			'total_bayar' => 0,
			'kembalian' => 0,
			'created_by' => $id,
			'updated_by' => NULL
		);

		try {
			$simpan = $this->M_Crud->input_data($data_pesanan, 'tb_pesanan');
			$keranjangData = $this->input->post('keranjang');

			foreach ($keranjangData as $item) {
				// Logika harga grosir
				if ($item['grosir_brg'] == "On" && $item['jumlah'] >= $item['rentang_awal'] && $item['jumlah'] <= $item['rentang_akhir']) {
					$harga = $item['harga_grosir'];
				} else {
					// Logika harga promo atau harga jual biasa
					$harga = $item['promo_brg'] == "On" ? $item['harga_promo'] : $item['harga_jual_barang'];
				}

				$hasSerial = $item['barcode'];

				// Data untuk dimasukkan ke tabel tb_pesanan_detail
				$data_pesanan_detail = array(
					'id_pesanan' => $id_pesanan,
					'id_brg' => $item['id_brg'],
					'harga_saat_ini' => $harga,
					'jumlah_jual' => $item['jumlah'],
					'status_verified' => (empty($hasSerial) || $hasSerial == "NO DATA") ? "1" : "0"
				);

				// Input data ke tabel tb_pesanan_detail
				$this->M_Crud->input_data($data_pesanan_detail, 'tb_pesanan_detail');

				// Hapus data dari tabel tb_keranjang
				$this->M_Crud->hapus_data(['id_keranjang' => $item['id_keranjang']], 'tb_keranjang');
			}

			$this->db->insert('tb_pesanan_tracking', [
				'id_pesanan' => $id_pesanan,
				'status_tracking' => 'Pesanan Dibuat',
				'updated_at' => date('Y-m-d H:i:s'),
				'updated_by' => $id
			]);

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

			$data['user'] = $this->M_Crud->all_data('tb_pesanan')->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')->where(['id_pesanan' => $id_pesanan])->get()->row_array();
			$data['pesanan'] = $this->M_Crud->all_data('tb_pesanan_detail')->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg')->where(['id_pesanan' => $id_pesanan])->get()->result_array();

			$pusher->trigger('my-channel', 'my-event-dev-3', $data);

			$response = array(
				'success' => true,
				'msg' => "Pesanan Berhasil Dibuat. Silahkan melakukan pembayaran!!",
			);
		} catch (Exception $e) {
			$response = array(
				'success' => false,
				'msg' => "Pesanan Gagal Dibuat. Mohon Periksa Kembali Inputan Anda!!",
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function create_invoice()
	{
		$id_pesanan = $this->M_Crud->buat_id_pesanan(4);
		$id_user = $this->input->post('user');
		$total = intval($this->input->post('total_harga'));

		$cek = $this->M_Crud->show('tb_user', ['id_user' => $id_user])->row_array();
		$keranjangData = $this->input->post('keranjang');

		$email              = $cek['email_member']; // your customer email
		$phoneNumber        = $cek['wa_member']; // your customer phone number (optional)
		$productDetails     = "Transfer Pembayaran";
		$merchantOrderId    = $id_pesanan; // from merchant, unique   
		$additionalParam    = ''; // optional
		$merchantUserInfo   = ''; // optional
		$customerVaName     = 'John Doe'; // display name on bank confirmation display
		$callbackUrl        = 'http://YOUR_SERVER/callback'; // url for callback
		$returnUrl          = 'http://YOUR_SERVER/return'; // url for redirect
		$expiryPeriod       = 60; // set the expired time in minutes

		// Customer Detail
		$firstName          = $cek['nama_member'];
		$lastName           = "";

		// Address
		$alamat             = "Jl. Kembangan Raya";
		$city               = "Jakarta";
		$postalCode         = "11530";
		$countryCode        = "ID";

		$address = array(
			'firstName'     => $firstName,
			'lastName'      => $lastName,
			'address'       => $alamat,
			'city'          => $city,
			'postalCode'    => $postalCode,
			'phone'         => $phoneNumber,
			'countryCode'   => $countryCode
		);

		$customerDetail = array(
			'firstName'         => $firstName,
			'lastName'          => $lastName,
			'email'             => $email,
			'phoneNumber'       => $phoneNumber,
			'billingAddress'    => $address,
			'shippingAddress'   => $address
		);

		$itemDetails = array();
		$total = 0;
		foreach ($keranjangData as $key => $value) {
			$total = $total + (intval($value['harga_promo']) * intval($value['jumlah']));
			$item1 = array(
				'name'      => $value['nama_barang'],
				'price'     => intval($value['harga_promo']) * intval($value['jumlah']),
				'quantity'  => intval($value['jumlah']),
			);

			// Menambahkan array $item1 ke dalam array $itemDetails
			$itemDetails[] = $item1;
		}

		$paymentAmount = $total; // Amount

		$params = array(
			'paymentAmount'     => $paymentAmount,
			'merchantOrderId'   => strval($merchantOrderId),
			'productDetails'    => $productDetails,
			'additionalParam'   => $additionalParam,
			'merchantUserInfo'  => $merchantUserInfo,
			'customerVaName'    => $customerVaName,
			'email'             => $email,
			'phoneNumber'       => $phoneNumber,
			'itemDetails'       => $itemDetails,
			'customerDetail'    => $customerDetail,
			'callbackUrl'       => $callbackUrl,
			'returnUrl'         => $returnUrl,
			'expiryPeriod'      => $expiryPeriod
		);

		$duitkuConfig = new \Duitku\Config("eb492c03ee2c0f7cb1d1fb3cb16ce92b", "DS16193");
		$duitkuConfig->setSandboxMode(true);
		$duitkuConfig->setSanitizedMode(false);
		$duitkuConfig->setDuitkuLogs(false);

		try {
			// createInvoice Request
			$responseDuitkuPop = \Duitku\Pop::createInvoice($params, $duitkuConfig);
			$nama = $this->M_Crud->show('tb_user', ['id_user' => $this->session->userdata('id_user')])->row_array();

			$data_pesanan = array(
				'id_pesanan' => $id_pesanan,
				'id_user' => $this->session->userdata('id_user'),
				'tgl_pesanan' => date('Y-m-d H:i:s'),
				'atas_nama' => $nama['nama_member'],
				'jenis_order' => $this->input->post('jenis'),
				'status_pembayaran' => "menunggu pembayaran",
				'metode_bayar' => $this->input->post('metode'),
				'status_pesanan' => "Pending",
				'diskon' => 0,
				'grand_total' => 10000,
				'total_bayar' => 10000,
				'kembalian' => 0,
				'created_by' => $this->session->userdata('id_user'),
				'updated_by' => NULL
			);

			$simpan = $this->M_Crud->input_data($data_pesanan, 'tb_pesanan');

			foreach ($keranjangData as $item) {
				$data_pesanan_detail = array(
					'id_pesanan' => $id_pesanan,
					'id_brg' => $item['id_brg'],
					'harga_saat_ini' => $item['harga_promo'],
					'jumlah_jual' => $item['jumlah']
				);
				$this->M_Crud->input_data($data_pesanan_detail, 'tb_pesanan_detail');
				$this->M_Crud->hapus_data(['id_keranjang' => $item['id_keranjang']], 'tb_keranjang');
			}

			header('Content-Type: application/json');
			echo $responseDuitkuPop;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
}
