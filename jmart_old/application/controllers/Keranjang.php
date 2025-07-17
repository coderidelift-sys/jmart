<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->load->model('M_Crud');
		$this->load->library('session');
		$this->auth->cek_login();
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		$data['keranjang'] = $this->M_Crud->all_data('tb_keranjang')->join('tb_barang', 'tb_barang.id_brg = tb_keranjang.id_brg')->join('tb_kategori', 'tb_barang.id_kategori_brg = tb_kategori.id_kategori_brg', 'left')->where('id_user', $id_user)->get()->result_array();
		$this->load->view('level/user/menu_keranjang', $data);
	}

   public function add()
{
    $id = $this->input->post('idProduk');
    $user = $this->session->userdata('id_user');

    $cek = $this->M_Crud->all_data('tb_keranjang')->where('id_brg', $id)->where('id_user', $user)->get()->row();

    if (!empty($cek)) {
        $data = array(
            'jumlah' => $cek->jumlah + 1,
        );
        $this->M_Crud->update_data(['id_keranjang' => $cek->id_keranjang], $data, 'tb_keranjang');

        $response = array(
            'success' => true,
            'msg' => "Jumlah Barang Berhasil diupdate ke Keranjang"
        );
    } else {
        $data = array(
            'id_brg' => $id,
            'jumlah' => 1,
            'id_user' => $user
        );

        $this->M_Crud->input_data($data, 'tb_keranjang');
        $response = array(
            'success' => true,
            'msg' => "Barang Berhasil Ditambahkan ke Keranjang"
        );
    }

    $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
    exit;
}




	public function update()
	{
		$id = $this->input->post('id_brg');
		$jlh = $this->input->post('quantity');
		$user = $this->session->userdata('id_user');

		if ($this->input->method() == 'post') {
			$cek = $this->M_Crud->all_data('tb_keranjang')->where('id_brg', $id)->where('id_user', $user)->get()->row();

			if (!empty($cek)) {
				$data = array(
					'jumlah' => $jlh,
				);
				$this->M_Crud->update_data(['id_keranjang' => $cek->id_keranjang], $data, 'tb_keranjang');

				$response = array(
					'success' => true,
					'msg' => "Barang Berhasil diupdate ke Keranjang"
				);
			} else {
				$data = array(
					'id_brg' => $id,
					'jumlah' => $jlh,
					'id_user' => $user
				);

				$this->M_Crud->input_data($data, 'tb_keranjang');
				$response = array(
					'success' => true,
					'msg' => "Barang Berhasil Ditambahkan ke Keranjang"
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

	public function update_jumlah()
	{
		// Pastikan request yang diterima adalah dengan metode POST dan menggunakan Ajax
		if ($this->input->method() == 'post') {
			$id = $this->input->post('id_keranjang');

			$data = array(
				'jumlah' => $this->input->post('qty_barang')
			);
			$this->M_Crud->update_data(['id_keranjang' => $id], $data, 'tb_keranjang');

			$response = array(
				'success' => true,
				'msg' => "Jumlah Pemesanan Berhasil Dieedit"
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
		} else {
			$response = array(
				'success' => false,
				'msg' => "Jumlah Pemesanan Gagal Dieedit"
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
		}
	}

    	public function hapus()
    	{
    		$id = $this->input->post('id');
    
    		if ($this->input->method() == 'post') {
    			$this->M_Crud->hapus_data(['id_keranjang' => $id], 'tb_keranjang');
    
    			$response = array(
    				'success' => true,
    				'msg' => "Berhasil menghapus"
    			);
    		}
    
    		$this->output
    			->set_status_header(200)
    			->set_content_type('application/json', 'utf-8')
    			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
    			->_display();
    		exit;
    	}

	public function proses()
	{
		$id = $this->session->userdata('id_user');
		$data['user'] = $id;
		$data['email'] = $this->db->select('email_member')->from('tb_user')->where('id_user', $id)->get()->row_array();
		$selectedProductsParam = $this->input->get('selectedProducts');
		$selectedProductsArray = explode(',', $selectedProductsParam);
		// var_dump($selectedProductsArray);die();
		$data['keranjang'] = $this->M_Crud->all_data('tb_keranjang')->join('tb_barang', 'tb_barang.id_brg = tb_keranjang.id_brg')->join('tb_kategori', 'tb_barang.id_kategori_brg = tb_kategori.id_kategori_brg')->where_in('id_keranjang', $selectedProductsArray)->get()->result_array();
		$data['total'] = $this->db
			->select_sum('(CASE 
        WHEN tb_barang.grosir_brg = "On" AND tb_keranjang.jumlah BETWEEN tb_barang.rentang_awal AND tb_barang.rentang_akhir THEN tb_barang.harga_grosir
        WHEN tb_barang.promo_brg = "On" THEN tb_barang.harga_promo
        ELSE tb_barang.harga_jual_barang END * tb_keranjang.jumlah)', 'total_harga')
			->from('tb_keranjang')
			->join('tb_barang', 'tb_barang.id_brg = tb_keranjang.id_brg')
			->where_in('id_keranjang', $selectedProductsArray)
			->get()
			->row_array();


		$data['alamat'] = $this->M_Crud->all_data('tb_user_alamat')->join('tb_desa', 'tb_desa.id_desa = tb_user_alamat.id_desa')->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_desa.id_kecamatan')->join('tb_kabupaten', 'tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten')->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi')->where('id_user', $id)->where('set_default', 'Main')->get()->row_array();
		$nama = $this->M_Crud->show('tb_user', ['id_user' => $id])->row_array();

		if (empty($data['alamat'])) {
			// Jika alamat tidak ditemukan, tampilkan pesan kesalahan
			$this->session->set_flashdata('error', 'Anda harus menambahkan alamat pada menu profil terlebih dahulu sebelum melanjutkan');
			redirect('keranjang');
		} else if (empty($nama['nama_member'])) {
			// Jika alamat tidak ditemukan, tampilkan pesan kesalahan
			$this->session->set_flashdata('error2', 'Anda harus melengkapkan biodata pada menu profil terlebih dahulu sebelum melanjutkan');
			redirect('keranjang');
		} else {
			$this->load->view('level/user/menu_keranjang_proses', $data);
		}
	}

	public function ambilOngkosKirim()
	{
		$id = $this->session->userdata('id_user');
		$data = $this->M_Crud->all_data('tb_user_alamat')->join('tb_desa', 'tb_desa.id_desa = tb_user_alamat.id_desa')->where('set_default', 'Main')->where('id_user', $id)->get()->row_array();

		if ($data !== false) {
			$data = array(
				'success' => true,
				'data' => array(
					'ongkos_kirim' => number_format($data['ongkos_kirim'])
				)
			);
		} else {
			$data = array(
				'success' => false,
				'message' => 'Gagal mengambil data dari database.',
				'data' => array(
					'ongkos_kirim' => 0
				)
			);
		}
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function count_keranjang()
	{
		$id_user = $this->session->userdata('id_user');

		// Hitung jumlah baris (bukan total jumlah item), dengan jumlah >= 1
		$this->db->from('tb_keranjang');
		$this->db->where('id_user', $id_user);
		$this->db->where('jumlah >=', 1);
		$keranjang_count = $this->db->count_all_results();

		$response = array(
			'success' => true,
			'count' => $keranjang_count
		);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function hapus_semua()
	{
		$id_user = $this->session->userdata('id_user');

		if ($this->input->method() == 'post') {
			$this->M_Crud->hapus_data(['id_user' => $id_user], 'tb_keranjang');

			$response = array(
				'success' => true,
				'msg' => "Berhasil menghapus semua keranjang"
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

}
