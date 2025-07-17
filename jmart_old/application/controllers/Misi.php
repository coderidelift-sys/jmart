<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Misi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->load->model('M_Crud');
		$this->load->library('session');
		$this->auth->cek_login();
	}

	public function validasi()
	{
		$id = $this->input->post('id');
		$cek = $this->M_Crud->all_data('tb_pesanan_tracking')->where('id_pesanan', $id)->get()->result_array();

		if (!empty($cek)) {
			if (count($cek) < 2) {
				$response = array(
					'success' => false,
					'msg' => "Barcode Ditemukan tetapi pesanan belum disiapkan!"
				);
			} else if (count($cek) == 2) {
				$user = $this->session->userdata('id_user');
				$data = [
					'id_pesanan' => $id,
					'status_tracking' => "Pesanan Dikirimkan",
					'updated_at' => date('Y-m-d H:i:s'),
					'updated_by' => $user
				];
				$this->M_Crud->input_data($data, 'tb_pesanan_tracking');
				$this->M_Crud->update_data(['id_pesanan' => $id], ['status_pesanan' => "Dikirim"], 'tb_pesanan');

				$response = array(
					'success' => true,
					'msg' => "Berhasil Scan Paket!"
				);
			} else if (count($cek) == 3) {
				$response = array(
					'success' => false,
					'msg' => "Paket telah di scan sebelumnya"
				);
			} else {
				$response = array(
					'success' => false,
					'msg' => "Paket telah selesai"
				);
			}
		} else {
			$response = array(
				'success' => false,
				'msg' => "Barcode tidak Ditemukan!!"
			);
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit;
	}

	public function list()
	{
		$user = $this->session->userdata('id_user');
		$data['list'] = $this->M_Crud->all_data('tb_pesanan')->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')->where('status_pesanan', 'Dikirim')->get()->result_array();
		$this->load->view('level/kurir/misi_list', $data);
	}

	public function pending()
	{
		$user = $this->session->userdata('id_user');
		$data['pending'] = $this->M_Crud->all_data('tb_pesanan')->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')->where('status_pesanan', 'Dikemas')->where('jenis_order', 'dianterin')->get()->result_array();
		$this->load->view('level/kurir/misi_pending', $data);
	}

	public function detail($id)
	{
		$data['pesanan'] = $this->M_Crud->show('tb_pesanan', ['id_pesanan' => $id])->row_array();
		$data['riwayat'] = $this->M_Crud->all_data('tb_pesanan_tracking')->where('id_pesanan', $id)->order_by('updated_at', 'DESC')->join('tb_user', 'tb_user.id_user = tb_pesanan_tracking.updated_by')->get()->result_array();
		$this->load->view('level/kurir/misi_detail', $data);
	}

	public function finishing()
	{
		$orderId = $this->input->post("order_id");
		$user = $this->session->userdata('id_user');

		$config['upload_path'] = FCPATH . 'public/template/upload/pesanan/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048;

		$this->load->library('upload', $config);

		// if ($this->upload->do_upload('userfile')) {
		// 	$response = array(
		// 		'status' => true,
		// 		'msg' => "Gambar berhasil diunggah dan pesanan diselesaikan."
		// 	);
		// } else {
		// 	// Gagal mengunggah gambar
		// 	$response = array(
		// 		'status' => false,
		// 		'msg' => "Gagal mengunggah gambar: " . $this->upload->display_errors()
		// 	);
		// }

		$response = array(
			'status' => true,
			'msg' => "Gambar berhasil diunggah dan pesanan diselesaikan."
		);

		$data = [
			'id_pesanan' => $orderId,
			'status_tracking' => "Pesanan Selesai",
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $user
		];

		$this->M_Crud->input_data($data, 'tb_pesanan_tracking');
		$this->M_Crud->update_data(['id_pesanan' => $orderId], [
			'status_pesanan' => "Selesai",
			'status_pembayaran' => 'Lunas',
			'tgl_diselesaikan' => date('Y-m-d H:i:s')
		], 'tb_pesanan');

		// Ubah respons menjadi JSON dan kirimkannya
		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function canceled()
	{
		$id_pesanan = $this->input->post('id');
		$result = $this->M_Crud->update_data(['id_pesanan' => $id_pesanan], ['status_pesanan' => "Dikemas"], 'tb_pesanan');

		if ($result) {
			$this->db->where('status_tracking', "Pesanan Dikirimkan")->where('id_pesanan', $id_pesanan)->delete('tb_pesanan_tracking');
			echo json_encode(array('status' => 'success', 'message' => 'Pesanan berhasil dibatalkan.'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan. Pesanan tidak dapat dibatalkan.'));
		}
	}
}
