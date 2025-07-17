<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
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
		$data['title'] = "J-MART Register";
		$this->load->view('layouts/auth/header', $data);
		$this->load->view('vw_register');
		$this->load->view('layouts/auth/footer');
	}

	public function validate_gmail($email)
	{
		if (preg_match('/@gmail\.com$/', $email)) {
			return true;  // Valid Gmail address
		} else {
			$this->form_validation->set_message('validate_gmail', 'The {field} must be a valid Gmail address.');
			return false; // Invalid Gmail address
		}
	}

	public function proses()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'trim|required|min_length[1]|max_length[20]');
		$this->form_validation->set_rules('wa_member', 'Nomor WA', 'trim|required|min_length[1]|max_length[20]');

		$this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
		$this->form_validation->set_message('min_length', 'Kolom {field} harus memiliki panjang minimal {param} karakter.');
		$this->form_validation->set_message('max_length', 'Kolom {field} harus memiliki panjang maksimal {param} karakter.');

		if ($this->form_validation->run() == true) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$nomor_induk = $this->input->post('nomor_induk');
			$wa_member = $this->input->post('wa_member');
			$email_member = $this->input->post('email_member');
			$cek = $this->db->select('id_user,nomor_induk,wa_member,email_member,status_registrasi')->from('tb_user')->where('nomor_induk', $nomor_induk)->where('wa_member', $wa_member)->get()->row_array();

			if (!empty($cek)) {
				if ($cek['status_registrasi'] == "Y") {
					$response = array(
						'status' => 'info',
						'message' => 'Akun Anda telah diaktifkan. Silahkan Login!'
					);
					$this->output
						->set_status_header(200)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						->_display();
					exit;
				} else {
					// UPDATE username dan Password
					$data = array(
						'username' => $username,
						'password' => password_hash($password, PASSWORD_DEFAULT),
					);

					$this->db->where('id_user', $cek['id_user']);
					$this->db->update('tb_user', $data);


					// VERIFIKASI EMAIL
					$access_key = random_string('alnum', 50);
					$verifikasi = random_string('numeric', 6);
					$email = $cek['email_member'];
					$emailto = $email;

					$this->auth->update_key($email, $access_key, $verifikasi);

					if ($email != "") {
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

						$this->email->from('rifkilhokseumawe2484@gmail.com', 'J-MART APP');
						$this->email->to($emailto);
						$this->email->subject('JMART-VERIFIKASI');
						$message = "Kode Verifikasi Anda adalah: " . $verifikasi;
						$message .= "<p>Silahkan Verifikasi Akun Anda pada Link dibawah ini:</p>";
						$message .= "<a href='" . site_url('verifikasi/' . $access_key) . "'>" . base_url('verifikasi/' . $access_key) . "</a><br>";
						$this->email->message($message);
						$this->email->send();
					}

					$response = array(
						'status' => 'success',
						'message' => 'Pendaftaran Berhasil. Silahkan cek email anda untuk proses verifikasi'
					);
					$this->output
						->set_status_header(200)
						->set_content_type('application/json', 'utf-8')
						->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
						->_display();
					exit;
				}
			} else {
				$response = array(
					'status' => 'error',
					'message' => 'Data Akun Tidak Ditemukan, Silahkan Hubungi Administrator!'
				);

				$this->output
					->set_status_header(200)
					->set_content_type('application/json', 'utf-8')
					->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
					->_display();
				exit;
			}
		} else {
			$response = array(
				'status' => 'failed',
				'message' => validation_errors()
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
		}
	}

	public function proses2()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[1]|max_length[100]|is_unique[tb_user.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[1]|max_length[255]');
		$this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'trim|required|min_length[1]|max_length[20]|is_unique[tb_user.nomor_induk]');
		$this->form_validation->set_rules('wa_member', 'Nomor WA', 'trim|required|min_length[1]|max_length[20]|is_unique[tb_user.wa_member]');
		$this->form_validation->set_rules(
			'email_member',
			'Email',
			'trim|required|min_length[1]|max_length[100]|valid_email|callback_validate_gmail|is_unique[tb_user.email_member]'
		);

		$this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
		$this->form_validation->set_message('min_length', 'Kolom {field} harus memiliki panjang minimal {param} karakter.');
		$this->form_validation->set_message('max_length', 'Kolom {field} harus memiliki panjang maksimal {param} karakter.');
		$this->form_validation->set_message('is_unique', 'Kolom {field} sudah terdaftar, silahkan tambahkan data lain.');

		if ($this->form_validation->run() == true) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$nomor_induk = $this->input->post('nomor_induk');
			$wa_member = $this->input->post('wa_member');
			$email_member = $this->input->post('email_member');
			$emailto = $email_member;

			$this->auth->register($username, $password, $nomor_induk, $wa_member, $email_member);
			$last_id = $this->db->insert_id();

			$access_key = random_string('alnum', 50);
			$verifikasi = random_string('numeric', 6);

			$this->auth->update_key2($last_id, $access_key, $verifikasi);
			$waktu_sekarang = time();
			$waktu_5_menit_lagi = $waktu_sekarang + 300;

			if ($email_member != "") {
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

				$this->email->from('rifkilhokseumawe2484@gmail.com', 'J-MART APP');
				$this->email->to($emailto);
				$this->email->subject('JMART-VERIFIKASI');

				$data = array(
					'username' => $username,
					'email' => $email_member,
					'nomor_induk' => $nomor_induk,
					'access_key' => $access_key,
					'verifikasi' => $verifikasi
				);

				$message = $this->load->view('sample/email_signup', $data, TRUE);
				$this->email->message($message);
				$this->email->send();
			}

			// $message = "Kode Verifikasi J-MART Anda adalah: " . $verifikasi;
			// $message .= "\nValid Until : " . date('d-m-Y H:i:s', $waktu_5_menit_lagi);
			// $message .= "\n\nAtau anda dapat mengakses melalui link berikut:";
			// $message .= "\n" . base_url('verifikasi/' . $access_key);

			// $curl = curl_init();
			// curl_setopt_array($curl, array(
			// 	CURLOPT_URL => "https://api.fonnte.com/send",
			// 	CURLOPT_RETURNTRANSFER => true,
			// 	CURLOPT_ENCODING => "",
			// 	CURLOPT_MAXREDIRS => 10,
			// 	CURLOPT_FOLLOWLOCATION => true,
			// 	CURLOPT_TIMEOUT => 30,
			// 	CURLOPT_SSL_VERIFYHOST => 0,
			// 	CURLOPT_SSL_VERIFYPEER => 0,
			// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			// 	CURLOPT_CUSTOMREQUEST => "POST",
			// 	CURLOPT_POSTFIELDS => array(
			// 		'target' => $wa_member,
			// 		'message' => $message,
			// 		'url' => "https://asset-a.grid.id/crop/0x0:0x0/945x630/photo/2018/06/07/3026687346.png",
			// 		'filename' => "filename",
			// 	),
			// 	CURLOPT_HTTPHEADER => array(
			// 		'Authorization: #7VISHMuycE3qmEw8UMW'
			// 	),
			// ));

			// curl_exec($curl);

			$response = array(
				'access_key' => $access_key,
				'status' => 'success',
				'message' => 'Pendaftaran Berhasil. Silahkan cek email anda untuk verifikasi akun!'
			);
			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
		} else {
			$response = array(
				'status' => 'failed',
				'message' => validation_errors()
			);

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
		}
	}

	public function verifikasi($id)
	{
		$cek = $this->db->select('access_key_registration')->from('tb_user')->where('access_key_registration', $id)->get()->row_array();

		if (!empty($cek)) {
			$data['title'] = "J-MART Verifikasi";
			$data['id'] = $id;
			$this->load->view('layouts/auth/header', $data);
			$this->load->view('vw_verifikasi');
			$this->load->view('layouts/auth/footer');
		} else {
			$this->session->set_flashdata('error', "Kunci Akses Gagal, Silahkan Registrasi Ulang!");
			redirect('');
		}
	}

	public function kode()
	{
		$kode = $this->input->post('kode_verifikasi');
		$access_key = $this->input->post('access_key');
		$cek = $this->db->select('id_user, access_key_registration, verification_code_registration, email_member')->from('tb_user')->where('access_key_registration', $access_key)->get()->row_array();

		if (!empty($cek)) {
			$kode_verifikasi = $cek['verification_code_registration'];

			if ($kode == $kode_verifikasi) {
				$data = [
					'access_key_registration' => "",
					'verification_code_registration' => "",
					'status_registrasi' => "Y",
					'status_akun' => "Y"
				];
				$this->db->where('id_user', $cek['id_user'])->update('tb_user', $data);
				$this->session->set_flashdata('success_register', "Akun Anda Berhasil di Aktifkan");
				redirect('');
			} else {
				$this->session->set_flashdata('error', "Kode Verifikasi Salah");
				redirect('verifikasi/' . $access_key);
			}
		} else {
			$this->session->set_flashdata('error', "Kunci Akses Gagal, Silahkan Registrasi Ulang!");
			redirect('');
		}
	}
}
