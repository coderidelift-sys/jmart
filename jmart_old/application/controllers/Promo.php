<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Promo extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Crud');
	}

	public function index()
	{
		$data['barang'] = $this->M_Crud->all_data('tb_barang')->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg')->where('promo_brg', 'On')->limit(10)->get()->result_array();
		$this->load->view('level/user/menu_promo', $data);
	}
}
