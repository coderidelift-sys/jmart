<?php
class Auth extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function register($username, $password, $nomor_induk, $nomor_wa, $email_member)
	{
		$data_user = array(
			'username' => $username,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'nomor_induk' => $nomor_induk,
			'wa_member' => $nomor_wa,
			'email_member' => $email_member,
			'status_registrasi' => 'N',
			'status_akun' => 'N',
			'avatar' => 'default.jpg',
			'level' => 'User',
			'created_at' => date('Y-m-d H:i:s')
		);
		$this->db->insert('tb_user', $data_user);
	}

	function login_user($username, $password)
	{
		$query = $this->db->select('*')->from('tb_user')->where('username', $username)->or_where('wa_member', $username)->get();

		if ($query->num_rows() > 0) {
			$data_user = $query->row();

			if (password_verify($password, $data_user->password)) {
				if ($data_user->status_registrasi == "N") {
					return "Account not activated";
				} else {
					$this->session->set_userdata('id_user', $data_user->id_user);
					$this->session->set_userdata('username', $username);
					$this->session->set_userdata('nama', $data_user->nama_member);
					$this->session->set_userdata('level', $data_user->level);
					$this->session->set_userdata('is_login', TRUE);
					return "Login successful";
				}
			} else {
				return "Invalid password";
			}
		} else {
			return "User not found";
		}
	}

	function login_kasir($username, $password)
	{
		$query = $this->db->select('*')->from('tb_kasir')->where('username', $username)->get();

		if ($query->num_rows() > 0) {
			$data_user = $query->row();

			if (password_verify($password, $data_user->password)) {
				$this->session->set_userdata('id_user', $data_user->id_kasir);
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('nama', $data_user->nama_kasir);
				$this->session->set_userdata('level', "Kasir");
				$this->session->set_userdata('is_login', TRUE);
				return "Login successful";
			} else {
				return "Invalid password";
			}
		} else {
			return "User not found";
		}
	}


	function cek_login()
	{
		if (empty($this->session->userdata('is_login'))) {
			redirect('login');
		}
	}

	function update_key($email, $access_key, $verifikasi)
	{
		// CEK DATABASE
		$cek = $this->db->select('*')->from('tb_user')->where('email_member', $email)->get()->row_array();
		// DATA INPUTAN
		$data = [
			'access_key_registration' => $access_key,
			'verification_code_registration' => $verifikasi
		];
		return $this->db->where('id_user', $cek['id_user'])->update('tb_user', $data);
	}

	function update_key2($id, $access_key, $verifikasi)
	{
		// CEK DATABASE
		$cek = $this->db->select('*')->from('tb_user')->where('id_user', $id)->get()->row_array();
		// DATA INPUTAN
		$data = [
			'access_key_registration' => $access_key,
			'verification_code_registration' => $verifikasi
		];
		return $this->db->where('id_user', $id)->update('tb_user', $data);
	}

	function update_key_forgotten($email, $access_key)
	{
		// CEK DATABASE
		$cek = $this->db->select('*')->from('tb_user')->where('email_member', $email)->get()->row_array();
		// DATA INPUTAN
		$data = [
			'access_key_forgotten' => $access_key
		];
		return $this->db->where('id_user', $cek['id_user'])->update('tb_user', $data);
	}
}
