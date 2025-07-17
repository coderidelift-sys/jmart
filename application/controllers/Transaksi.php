<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
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
		$this->load->view('level/admin/wilayah_provinsi');
	}
}
