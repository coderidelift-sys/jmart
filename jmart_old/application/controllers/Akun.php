<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->load->model('M_Crud');
		$this->load->library('session');
		$this->load->helper('string');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->auth->cek_login();
	}

	public function profile()
	{
		$id = $this->session->userdata('id_user');
		$data['profile'] = $this->M_Crud->show('tb_user', ['id_user' => $id])->row_array();
		$this->load->view('level/admin/setting_profile', $data);
	}

	public function sandi()
	{
		$data = [];
		$this->load->view('level/admin/setting_sandi', $data);
	}

	public function index()
	{
		$id = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		$data['user'] = $this->M_Crud->show('tb_user', ['id_user' => $id])->row_array();

		if ($level == "User") {
			$data['alamat'] = $this->M_Crud->all_data('tb_user_alamat')->join('tb_desa', 'tb_desa.id_desa = tb_user_alamat.id_desa')->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_desa.id_kecamatan')->join('tb_kabupaten', 'tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten')->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi')->where('id_user', $id)->where('set_default', 'Main')->get()->row_array();
			$this->load->view('level/user/menu_akun', $data);
		} else {
			$this->load->view('level/kurir/akun', $data);
		}
	}

	public function edit()
	{
		$id = $this->session->userdata('id_user');
		$level = $this->session->userdata('level');
		$data['user'] = $this->M_Crud->show('tb_user', ['id_user' => $id])->row_array();

		if ($level == "User") {
			$this->load->view('level/user/menu_akun_editprofile', $data);
		} else {
			$this->load->view('level/kurir/akun_update', $data);
		}
	}

	public function get_kabupaten()
	{
		$id_prov = $this->input->post("prov_id");
		$this->db->select('*');
		$this->db->from('tb_kabupaten');
		$this->db->where('id_provinsi', $id_prov);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			echo json_encode($result);
		} else {
			echo json_encode(array()); // Jika tidak ada hasil, kirimkan JSON kosong
		}
	}

	public function get_kecamatan()
	{
		$kab_id = $this->input->post("kab_id");
		$this->db->select('*');
		$this->db->from('tb_kecamatan');
		$this->db->where('id_kabupaten', $kab_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			echo json_encode($result);
		} else {
			echo json_encode(array()); // Jika tidak ada hasil, kirimkan JSON kosong
		}
	}

	public function get_desa()
	{
		$kec_id = $this->input->post("kec_id"); // Menggunakan input->get() untuk mengambil data dari query string
		$this->db->select('*');
		$this->db->from('tb_desa');
		$this->db->where('id_kecamatan', $kec_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$result = $query->result();
			echo json_encode($result);
		} else {
			echo json_encode(array()); // Jika tidak ada hasil, kirimkan JSON kosong
		}
	}


	public function alamat()
	{
		$id = $this->session->userdata('id_user');
		$data['alamat'] = $this->M_Crud->all_data('tb_user_alamat')->join('tb_desa', 'tb_desa.id_desa = tb_user_alamat.id_desa')->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_desa.id_kecamatan')->join('tb_kabupaten', 'tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten')->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi')->where('id_user', $id)->get()->result_array();
		$data['main'] = $this->M_Crud->all_data('tb_user_alamat')->where('id_user', $id)->where('set_default', 'Main')->get()->row_array();
		$data['jumlah'] = count($data['alamat']);
		$data['provinsi'] = $this->M_Crud->tampil_data('tb_provinsi')->result_array();
		$this->load->view('level/user/menu_akun_editalamat', $data);
	}

	public function alamat_tambah()
	{
		$id = $this->session->userdata('id_user');

		$this->form_validation->set_rules('id_alamat_user', 'ID Alamat User', 'required');
		$this->form_validation->set_rules('id_user', 'ID User', 'required');
		$this->form_validation->set_rules('id_desa', 'ID Desa', 'required');
		$this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required');
		$this->form_validation->set_rules('kontak_penerima', 'Kontak Penerima', 'required');

		if ($this->form_validation->run() == FALSE) {
			$cekbox = $this->input->post('set_default');
			$cek = $this->M_Crud->all_data('tb_user_alamat')->where('id_user', $id)->where('set_default', 'Main')->get();
			$jumlah_data = $cek->num_rows();

			if ($jumlah_data > 0 && $cekbox == true) {
				// Data tersedia, maka ganti nilai 'set_default' menjadi 'Secondary'
				$this->M_Crud->all_data('tb_user_alamat')
					->where('id_user', $id)
					->where('set_default', 'Main')
					->set('set_default', 'Secondary')
					->update();
			}

			if ($jumlah_data <= 0) {
				$set_default = "main";
			} else {
				$set_default = $cekbox == true ? "main" : "secondary";
			}

			$data = array(
				'id_user' => $id,
				'koordinat' => $this->input->post('maps_coordinate'),
				'id_desa' => $this->input->post('select_desa'),
				'nama_penerima' => $this->input->post('nama_penerima'),
				'kontak_penerima' => $this->input->post('kontak_penerima'),
				'detail_lainnya' => $this->input->post('detail_lainnya'),
				'set_default' => $set_default,
			);
			$this->M_Crud->input_data($data, 'tb_user_alamat');

			// Redirect pengguna ke halaman sukses atau halaman lainnya
			redirect('akun/alamat');
		} else {
			$error_message = validation_errors(); // Pesan validasi jika ada
			$error_message .= "Terjadi kesalahan saat menyimpan data.";
			$this->session->set_flashdata('error_message', $error_message);
			redirect('akun/alamat');
		}
	}

	public function set_alamat_main()
	{
		$id = $this->input->post('id_alamat_user');
		$id_user = $this->session->userdata('id_user');

		$cek = $this->M_Crud->all_data('tb_user_alamat')->where('id_user', $id_user)->where('set_default', 'Main')->get();
		$jumlah_data = $cek->num_rows();

		if ($jumlah_data > 0) {
			$this->M_Crud->all_data('tb_user_alamat')->where('id_user', $id_user)->set('set_default', 'Secondary')->update();
		}

		$this->M_Crud->update_data(['id_alamat_user' => $id], ['set_default' => "Main"], 'tb_user_alamat');
	}

	public function update_alamat($id)
	{
		$id_user = $this->session->userdata('id_user');
		$cek = $this->M_Crud->show('tb_user_alamat', ['id_alamat_user' => $id])->row_array();
		$cekbox = $this->input->post('set_default');

		$this->form_validation->set_rules('nama_penerima', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('kontak_penerima', 'No. HP', 'required');
		$this->form_validation->set_rules('maps_coordinate_edit', 'MAPS', 'required');

		if ($this->form_validation->run() === FALSE) {
			// Validasi gagal, kembali ke halaman form
			$this->load->view('edit_alamat');
		} else {
			if ($cekbox == true) {
				if ($cek['set_default'] != "Main") {
					$main = $this->M_Crud->all_data('tb_user_alamat')->where('id_user', $id_user)->where('set_default', 'Main')->get()->row_array();
					$this->M_Crud->update_data(['id_alamat_user' => $main['id_alamat_user']], ['set_default' => 'Secondary'], 'tb_user_alamat');
					$this->M_Crud->update_data(['id_alamat_user' => $id], ['set_default' => 'Main'], 'tb_user_alamat');
				}
			}

			// Validasi berhasil, simpan data ke database
			$data = array(
				'nama_penerima' => $this->input->post('nama_penerima'),
				'kontak_penerima' => $this->input->post('kontak_penerima'),
				'detail_lainnya' => $this->input->post('detail_lainnya'),
				'koordinat' => $this->input->post('maps_coordinate_edit'),
			);

			$this->M_Crud->update_data(['id_alamat_user' => $id], $data, 'tb_user_alamat');
		}
		redirect('akun/alamat');
	}

	public function hapus_alamat($id)
	{
		$cek = $this->M_Crud->show('tb_user_alamat', ['id_alamat_user' => $id])->row_array();

		if ($cek['set_default'] == "Main") {
			// Mendapatkan daftar item selain "Main" dari database (misalnya, dari tabel 'alamat')
			$daftarItemLain = $this->db->select('id_alamat_user')->from('tb_user_alamat')->where('set_default !=', 'Main')->get()->result_array();

			// Jika ada item lain yang tersedia
			if (!empty($daftarItemLain)) {
				// Pilih item acak dari daftar item lain
				$itemAcak = $daftarItemLain[array_rand($daftarItemLain)];

				// Perbarui status "set_default" untuk item yang dipilih secara acak
				$this->db->set('set_default', 'Main')->where('id_alamat_user', $itemAcak['id_alamat_user'])->update('tb_user_alamat');
			}
		}

		$this->M_Crud->hapus_data(['id_alamat_user' => $id], 'tb_user_alamat');
		redirect('akun/alamat');
	}

	public function update()
	{
		$id = $this->session->userdata('id_user');
		$data = $this->M_Crud->show('tb_user', ['id_user' => $id])->row_array();

		if ($_POST['username'] !== $data['username']) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[1]|max_length[50]|is_unique[tb_user.username]');
		} else {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[1]|max_length[50]');
		}

		if ($_POST['nomor_induk'] !== $data['nomor_induk']) {
			$this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'trim|required|min_length[1]|max_length[20]|is_unique[tb_user.nomor_induk]');
		} else {
			$this->form_validation->set_rules('nomor_induk', 'Nomor Induk', 'trim|required|min_length[1]|max_length[20]');
		}

		if ($_POST['wa_member'] !== $data['wa_member']) {
			$this->form_validation->set_rules('wa_member', 'Nomor WA', 'trim|required|min_length[1]|max_length[20]|is_unique[tb_user.wa_member]');
		} else {
			$this->form_validation->set_rules('wa_member', 'Nomor WA', 'trim|required|min_length[1]|max_length[20]');
		}

		if ($_POST['email_member'] !== $data['email_member']) {
			$this->form_validation->set_rules('email_member', 'Email Member', 'trim|required|min_length[1]|max_length[120]|is_unique[tb_user.email_member]');
		} else {
			$this->form_validation->set_rules('email_member', 'Email Member', 'trim|required|min_length[1]|max_length[120]');
		}

		$this->form_validation->set_message('required', 'Kolom {field} harus diisi.');
		$this->form_validation->set_message('min_length', 'Kolom {field} harus memiliki panjang minimal {param} karakter.');
		$this->form_validation->set_message('max_length', 'Kolom {field} harus memiliki panjang maksimal {param} karakter.');

		if ($this->form_validation->run() == true) {
			$data = [
				'username' => $this->input->post('username'),
				'nomor_induk' => $this->input->post('nomor_induk'),
				'wa_member' => $this->input->post('wa_member'),
				'email_member' => $this->input->post('email_member'),
				'nama_member' => $this->input->post('nama_member'),
			];
			$this->M_Crud->update_data(['id_user' => $id], $data, 'tb_user');

			$response = array(
				'status' => 'success',
				'message' => 'Update Akun Berhasil. Terimakasih :)'
			);
			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
		} else {
			$response = array(
				'status' => 'error',
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

	public function ubah_foto()
	{
		$previous_avatar = $this->input->post('previous_avatar');
		$config['upload_path'] = 'public/template/upload/user/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['max_size'] = 2048; // Dalam kilobyte

		$this->upload->initialize($config);

		if ($this->upload->do_upload('avatar')) {
			$data = $this->upload->data();
			$file_name = $data['file_name'];

			// Simpan file ke database atau lakukan tindakan lain sesuai kebutuhan Anda
			$id_user = $this->session->userdata('id_user'); // Gantilah sesuai dengan cara Anda menyimpan id_user

			// Misalnya, simpan file ke database
			$this->db->where('id_user', $id_user);
			$this->db->update('tb_user', ['avatar' => $file_name]);

			// Hapus file avatar sebelumnya jika bukan 'default'
			if ($previous_avatar != 'default.jpg') {
				$previous_file_path = 'public/template/upload/user/' . $previous_avatar;
				unlink($previous_file_path);
			}
		}
	}

	public function ganti_password()
	{
		$id = $this->session->userdata('id_user');
		$this->form_validation->set_rules('password_baru', 'Password Baru', 'trim|required|min_length[1]|max_length[20]');
		$this->form_validation->set_rules('konfirmasi_password_baru', 'Konfirmasi Password Baru', 'trim|required|min_length[1]|max_length[20]');

		if ($this->form_validation->run() == true) {
			$password = $this->input->post('password_baru');
			$password_match = $this->input->post('konfirmasi_password_baru');

			if ($password == $password_match) {
				$response = array(
					'status' => 'success',
					'message' => 'Password Berhasil diubah'
				);
				$this->M_Crud->update_data(['id_user' => $id], ['password' => password_hash($password, PASSWORD_DEFAULT)], 'tb_user');
			} else {
				$response = array(
					'status' => 'error',
					'message' => 'Password Tidak Sama'
				);
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
		} else {
			$response = array(
				'status' => 'error',
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
}
