<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kabupaten extends CI_Controller
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
		$data['provinsi'] = $this->M_Crud->tampil_data('tb_provinsi')->result_array();
		$this->load->view('level/admin/wilayah_kabupaten', $data);
	}

	public function json()
	{
		$nama_provinsi_filter = $this->input->post('nama_provinsi');
		$nama_kabupaten_filter = $this->input->post('nama_kabupaten');

		$columns = 'tb_kabupaten.id_provinsi, id_kabupaten, nama_provinsi, nama_kabupaten';
		$filter = array('nama_provinsi', 'nama_kabupaten'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array(
			array(
				'table' => 'tb_provinsi',
				'condition' => 'tb_kabupaten.id_provinsi = tb_provinsi.id_provinsi',
				'type' => 'inner'
			)
		);
		$start = $this->input->post('start') ?? 0;
		$length = $this->input->post('length') ?? 10;

		$where = null;
		if ($nama_provinsi_filter) {
			$where = "nama_provinsi LIKE '%" . $nama_provinsi_filter . "%'";
		}

		if ($nama_kabupaten_filter) {
			$where = "nama_kabupaten LIKE '%" . $nama_kabupaten_filter . "%'";
		}

		$list = $this->Datatable_model->get_data('tb_kabupaten', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $start, $length);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $kabupaten) {
			$no++;
			$row = array(
				$no,
				$kabupaten->nama_provinsi,
				$kabupaten->nama_kabupaten,
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
						<li><a class="dropdown-item" href="javascript:void(0);" data-provinsi="' . $kabupaten->nama_provinsi . '"data-id="' . $kabupaten->id_kabupaten . '" data-id="' . $kabupaten->id_kabupaten . '" data-nama="' . $kabupaten->nama_kabupaten . '" onclick="ubahKabupaten(this);">&nbsp;Ubah Kabupaten</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $kabupaten->id_kabupaten . '" href="javascript:void(0);" onclick="deleteKabupaten(this);">&nbsp;Hapus Kabupaten</a></li>
					</ul>
				</div>
				'
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_kabupaten'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_kabupaten', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}


	public function simpan()
	{
	    try {
	        // Mengambil data yang dikirimkan melalui Ajax
	        $selectProvinsi = $this->input->post('select_provinsi');
	        $namaKabupaten = $this->input->post('nama_kabupaten');

	        // Validasi data jika diperlukan
	        if (empty($selectProvinsi) || empty($namaKabupaten)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
	            return;
	        }

	        // Capitalize nama kabupaten
	        $namaKabupaten = ucwords(strtolower(trim($namaKabupaten)));

	        // Cek apakah nama kabupaten sudah ada di provinsi yang sama
	        $existing_kabupaten = $this->M_Crud->get_where('tb_kabupaten', array(
	            'nama_kabupaten' => $namaKabupaten
	        ));

	        if ($existing_kabupaten) {
	            echo json_encode(array('status' => 'error', 'message' => 'Kabupaten sudah ada.'));
	            return;
	        }

	        // Data yang akan disimpan
	        $data = array(
	            'id_provinsi' => $selectProvinsi,
	            'nama_kabupaten' => $namaKabupaten
	        );

	        // Menyimpan data kabupaten
	        $this->M_Crud->input_data($data, 'tb_kabupaten');

	        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan.'));
	    } catch (Exception $e) {
	        echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses penyimpanan data.'));
	    }
	}

	public function ubah()
	{
	    try {
	        // Mengambil data yang dikirimkan melalui Ajax
	        $idKabupaten = $this->input->post('id_kabupaten');
	        $namaKabupaten = $this->input->post('nama_kabupaten');

	        // Validasi data jika diperlukan
	        if (empty($idKabupaten) || empty($namaKabupaten)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
	            return;
	        }

	        // Capitalize nama kabupaten
	        $namaKabupaten = ucwords(strtolower(trim($namaKabupaten)));

	        // Cek apakah nama kabupaten sudah ada, kecuali diri sendiri
	        $existing_kabupaten = $this->M_Crud->get_where('tb_kabupaten', array(
	            'nama_kabupaten' => $namaKabupaten,
	            'id_kabupaten !=' => $idKabupaten
	        ));

	        if ($existing_kabupaten) {
	            echo json_encode(array('status' => 'error', 'message' => 'Nama kabupaten sudah ada.'));
	            return;
	        }

	        // Data yang akan diperbarui
	        $data = array(
	            'nama_kabupaten' => $namaKabupaten
	        );

	        // Mengupdate data kabupaten
	        $this->M_Crud->update_data(['id_kabupaten' => $idKabupaten], $data, 'tb_kabupaten');

	        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil diubah.'));
	    } catch (Exception $e) {
	        echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses perubahan data.'));
	    }
	}


	public function delete($id_kabupaten)
	{
		try {
			$result = $this->M_Crud->hapus_data(array('id_kabupaten' => $id_kabupaten), 'tb_kabupaten');
			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}
}
