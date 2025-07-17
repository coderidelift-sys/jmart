<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autodebit extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
        $this->load->model('M_Crud');
        $this->load->model('M_Pagination');
        $this->auth->cek_login();
    }

    public function index()
    {
        $id = $this->session->userdata('id_user');
        $data['autodebit'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('metode_bayar', 'autodebet')->where('status_pembayaran', 'Menunggu Pembayaran')->order_by('tgl_pesanan', 'DESC')->get()->result_array();
        $this->load->view('level/user/menu_pesanan_autodebit', $data);
    }

    public function lunas()
    {
        $id = $this->session->userdata('id_user');
        $data['autodebit'] = $this->M_Crud->all_data('tb_pesanan')->where('id_user', $id)->where('metode_bayar', 'autodebet')->where('status_pembayaran', 'Lunas')->order_by('tgl_pesanan', 'DESC')->get()->result_array();
        $this->load->view('level/user/menu_pesanan_autodebit_lunas', $data);
    }
}
