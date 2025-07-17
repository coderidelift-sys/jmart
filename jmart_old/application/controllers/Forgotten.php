<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgotten extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->load->library('email');
		$this->load->helper('string');
		$this->load->helper('url');
	}

	public function index()
	{
		$data['title'] = "J-MART Forgot Password";
		$this->load->view('layouts/auth/header', $data);
		$this->load->view('vw_forgotten');
		$this->load->view('layouts/auth/footer');
	}

	public function reset()
	{
		$this->form_validation->set_rules('email_member', 'Email Member', 'trim|required|min_length[1]|max_length[100]');

		if ($this->form_validation->run() == true) {
			$reset_key = random_string('alnum', 50);
			$email = $this->input->post('email_member');
			$emailto = $email;

			$check = $this->db->select('*')->from('tb_user')->where('email_member', $email)->get()->result_array();
			if (count($check) >= 1) {
				$mail_config['smtp_host'] = 'smtp.gmail.com';
				$mail_config['smtp_port'] = '587';
				$mail_config['smtp_user'] = 'rifkilhokseumawe2484@gmail.com';
				$mail_config['_smtp_auth'] = TRUE;
				$mail_config['smtp_pass'] = 'bcjqwtxfihhmjvcd';
				$mail_config['smtp_crypto'] = 'tls';
				$mail_config['protocol'] = 'smtp';
				$mail_config['mailtype'] = 'html';
				$mail_config['send_multipart'] = FALSE;
				$mail_config['charset'] = 'iso-8859-1';
				$mail_config['wordwrap'] = TRUE;
				$this->email->initialize($mail_config);
				$this->email->set_newline("\r\n");

				$this->email->from('rifkilhokseumawe2484@gmail.com', 'JMART APP');
				$this->email->to($emailto);
				$this->email->subject('JMART RESET PASSWORD');
				// $message = "<p>Kami mendengar bahwa Anda kehilangan kata sandi JMART Anda. Mohon maaf tentang hal tersebut!</p>";
				// $message .= "<p>Tapi jangan khawatir! Anda dapat menggunakan tombol berikut untuk mengatur ulang kata sandi Anda:</p>";
				// $message .= "<a href='" . site_url('forgotten/change_password/' . $reset_key) . "'>Reset Password</a><br>";


				$data = array(
					'reset_key' => $reset_key,
				);

				$message = $this->load->view('sample/email_forgot', $data, TRUE);
				$this->email->message($message);

				if (!$this->email->send()) {
					$response = array(
						'status' => 'error',
						'message' => $this->email->print_debugger()
					);
				} else {
					$updatekey = $this->auth->update_key_forgotten($emailto, $reset_key);
					$response = array(
						'status' => 'success',
						'message' => 'Email Berhasil Dikirimkan. Silahkan Cek Kotak Masuk / Folder SPAM Anda!'
					);
				}
			} else {
				$response = array(
					'status' => 'error',
					'message' => 'Email Tidak Ditemukan!'
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

	public function change_password($id)
	{
		if (!empty($id)) {
			$check = $this->db->select('*')->from('tb_user')->where('access_key_forgotten', $id)->get()->row_array();
			$data['id'] = $check['access_key_forgotten'];
			if (!empty($check)) {
				$this->load->view('layouts/auth/header');
				$this->load->view('vw_confirmation', $data);
				$this->load->view('layouts/auth/footer');
			} else {
				$this->session->set_flashdata('error', 'Key Telah Berubah. Silahkan buat permintaan reset password yang baru.');
				redirect('forgotten');
			}
		} else {
			$this->session->set_flashdata('pesan', 'Key Telah Berubah. Silahkan buat permintaan reset password yang baru.');
			redirect('forgotten');
		}
	}

	public function konfirmasi_password()
	{
		$password = $this->input->post('password');
		$password_baru = $this->input->post('password_baru');
		$reset_key = $this->input->post('access_key_forgotten');

		if ($password != $password_baru) {
			$this->session->set_flashdata('error', 'Password tidak sama');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$data = array(
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'access_key_forgotten' => ''
			);
			$this->db->where('access_key_forgotten', $reset_key);
			$this->db->update('tb_user', $data);

			$this->session->set_flashdata('success_register', 'Password berhasil diubah!');
			redirect('/');
		}
	}
}
