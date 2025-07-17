<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->load->library('session');
		$this->load->model('M_Crud');
		$this->load->model('M_Datatable');
		$this->auth->cek_login();
	}

	public function index()
	{
		$data['list'] = $this->M_Crud->all_data('tb_pesanan')
			->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left')
			->join('tb_user_alamat', 'tb_user_alamat.id_user = tb_user.id_user', 'left')
			->join('tb_desa', 'tb_desa.id_desa = tb_user_alamat.id_desa')
			->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_desa.id_kecamatan')
			->join('tb_kabupaten', 'tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten')
			->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi')
			->where('status_pesanan', 'Dikirim')
			->where('tb_user_alamat.set_default', 'Main')
			->get()
			->result_array();

		// Memuat tampilan setelah debugging
		$this->load->view('level/kurir/map', $data);
	}
}
