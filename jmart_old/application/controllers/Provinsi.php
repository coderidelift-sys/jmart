<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provinsi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('auth');
		$this->load->library('session');
		$this->load->model('M_Crud');
		$this->load->model('Datatable_model');
		$this->auth->cek_login();
	}

	public function index()
	{
		$this->load->view('level/admin/wilayah_provinsi');
	}

	public function json()
	{
		$nama_provinsi_filter = $this->input->post('nama_provinsi');

		$columns = 'id_provinsi, nama_provinsi';
		$filter = array('nama_provinsi'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array();
		$start = $this->input->post('start') ?? 0;
		$length = $this->input->post('length') ?? 10;

		$where = null;
		if ($nama_provinsi_filter) {
			$where = "nama_provinsi LIKE '%" . $nama_provinsi_filter . "%'";
		}

		$list = $this->Datatable_model->get_data('tb_provinsi', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $start, $length);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $provinsi) {
			$no++;
			$row = array(
				$no,
				$provinsi->nama_provinsi,
				'
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-secondary text-uppercase dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
					<svg xmlns="http://www.w3.org/2000/svg" class="icon-tabler icon-tabler-dots-vertical" width="14" height="14" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
						<path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
						<path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
						<path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
					</svg>
					Aksi&nbsp;
					</button>
					<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item" href="javascript:void(0);" data-id="' . $provinsi->id_provinsi . '" data-nama="' . $provinsi->nama_provinsi . '" onclick="ubahProvinsi(this);">&nbsp;Ubah Provinsi</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $provinsi->id_provinsi . '" href="javascript:void(0);" onclick="deleteProvinsi(this);">&nbsp;Hapus Provinsi</a></li>
					</ul>
				</div>
				',
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_provinsi'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_provinsi', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function simpan()
	{
	    try {
	        $nama_provinsi = $this->input->post('nama_provinsi');

	        // Fungsi untuk capitalize huruf pertama setiap kata
	        $nama_provinsi = ucwords(strtolower(trim($nama_provinsi)));

	        // Cek apakah nama_provinsi sudah ada di database
	        $existing_provinsi = $this->M_Crud->get_where('tb_provinsi', array('nama_provinsi' => $nama_provinsi));

	        if ($existing_provinsi) {
	            echo json_encode(array(
	                'status' => 'error',
	                'message' => 'Nama provinsi sudah ada. Silakan masukkan nama yang lain.'
	            ));
	            return;
	        }

	        // Data untuk disimpan
	        $data = array(
	            'nama_provinsi' => $nama_provinsi
	        );

	        // Input data ke database
	        $result = $this->M_Crud->input_data($data, 'tb_provinsi');

	        echo json_encode(array(
	            'status' => 'success',
	            'message' => 'Data berhasil disimpan.'
	        ));
	    } catch (Exception $e) {
	        echo json_encode(array(
	            'status' => 'error',
	            'message' => $e->getMessage()
	        ));
	    }
	}


	public function ubah()
	{
	    try {
	        // Mengambil data yang dikirimkan melalui Ajax
	        $idProvinsi = $this->input->post('id_provinsi');
	        $namaProvinsi = $this->input->post('nama_provinsi');

	        // Validasi data jika diperlukan
	        if (empty($idProvinsi) || empty($namaProvinsi)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
	            return;
	        }

	        // Capitalize nama provinsi
	        $namaProvinsi = ucwords(strtolower(trim($namaProvinsi)));

	        // Cek apakah nama provinsi sudah ada, kecuali diri sendiri
	        $existing_provinsi = $this->M_Crud->get_where('tb_provinsi', array(
	            'nama_provinsi' => $namaProvinsi,
	            'id_provinsi !=' => $idProvinsi
	        ));

	        if ($existing_provinsi) {
	            echo json_encode(array('status' => 'error', 'message' => 'Nama provinsi sudah ada.'));
	            return;
	        }

	        // Data yang akan diperbarui
	        $data = array(
	            'nama_provinsi' => $namaProvinsi
	        );

	        // Mengupdate data provinsi
	        $this->M_Crud->update_data(['id_provinsi' => $idProvinsi], $data, 'tb_provinsi');

	        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil diubah.'));
	    } catch (Exception $e) {
	        echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses perubahan data.'));
	    }
	}


	public function delete($id_provinsi)
	{
		try {
			$this->M_Crud->hapus_data(array('id_provinsi' => $id_provinsi), 'tb_provinsi');
			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}
}
