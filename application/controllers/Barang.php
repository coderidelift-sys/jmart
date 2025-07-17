<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('level/admin/master_barang');
	}

	public function barang_masuk()
	{
		$this->load->view('level/admin/barang_masuk');
	}

	public function barang_masuk_add()
	{
		$this->load->view('level/admin/barang_masuk_add');
	}
}
