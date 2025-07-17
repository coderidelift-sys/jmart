<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
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
		$this->load->view('level/kurir/chat_list');
	}

	public function history()
	{
		$this->load->view('level/kurir/chat_history');
	}
}
