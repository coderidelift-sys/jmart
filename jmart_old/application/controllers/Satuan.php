<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Satuan extends CI_Controller
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
		$this->load->view('level/admin/master_satuan');
	}

	public function json()
	{
		$nama_satuan_filter = $this->input->post('nama_satuan');

		$columns = 'id_satuan, nama_satuan';
		$filter = array('nama_satuan'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array();
		$start = $this->input->post('start') ?? 0;
		$length = $this->input->post('length') ?? 10;

		$where = null;
		if ($nama_satuan_filter) {
			$where = "nama_satuan LIKE '%" . $nama_satuan_filter . "%'";
		}

		$list = $this->Datatable_model->get_data('tb_satuan', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $start, $length);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $satuan) {
			$count = $this->db->where('id_satuan', $satuan->id_satuan)->count_all_results('tb_barang');
			$no++;
			$row = array(
				$no,
				$satuan->nama_satuan,
				$count . " Barang",
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
						<li><a class="dropdown-item" href="javascript:void(0);" data-id="' . $satuan->id_satuan . '" data-nama="' . $satuan->nama_satuan . '" onclick="ubahSatuan(this);">&nbsp;Ubah Satuan</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $satuan->id_satuan . '" href="javascript:void(0);" onclick="deleteSatuan(this);">&nbsp;Hapus Satuan</a></li>
					</ul>
				</div>
				'
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_satuan'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_satuan', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function simpan()
	{
		try {
			$namaSatuan = $this->input->post('nama_satuan');

			// Validasi jika nama satuan kosong
			if (empty($namaSatuan)) {
				echo json_encode(array('status' => 'error', 'message' => 'Nama satuan tidak boleh kosong.'));
				return;
			}

			// Capitalize nama satuan
			$namaSatuan = ucwords(strtolower(trim($namaSatuan)));

			// Cek apakah nama satuan sudah ada
			$existingSatuan = $this->M_Crud->get_where('tb_satuan', array('nama_satuan' => $namaSatuan));

			if ($existingSatuan) {
				echo json_encode(array('status' => 'error', 'message' => 'Nama satuan sudah ada.'));
				return;
			}

			// Data yang akan disimpan
			$data = array(
				'nama_satuan' => $namaSatuan
			);

			// Simpan data ke tabel tb_satuan
			$this->M_Crud->input_data($data, 'tb_satuan');

			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses penyimpanan data.'));
		}
	}


	public function ubah()
	{
		try {
			$id = $this->input->post('id_satuan');
			$nama = $this->input->post('nama_satuan');

			// Validasi jika nama satuan kosong
			if (empty($nama)) {
				echo json_encode(array('status' => 'error', 'message' => 'Nama satuan tidak boleh kosong.'));
				return;
			}

			// Capitalize nama satuan
			$nama = ucwords(strtolower(trim($nama)));

			// Cek apakah nama satuan sudah ada, kecuali satuan yang sedang diubah
			$existing_satuan = $this->M_Crud->get_where('tb_satuan', array(
				'nama_satuan' => $nama,
				'id_satuan !=' => $id
			));

			if ($existing_satuan) {
				echo json_encode(array('status' => 'error', 'message' => 'Nama satuan sudah ada.'));
				return;
			}

			// Data yang akan diubah
			$data = array(
				'nama_satuan' => $nama
			);

			// Update data ke tabel tb_satuan
			$this->M_Crud->update_data(['id_satuan' => $id], $data, 'tb_satuan');

			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil diubah.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses perubahan data.'));
		}
	}



	public function delete($id_satuan)
	{
		try {
			$count_barang = $this->M_Crud->count_rows('tb_barang', ['id_satuan' => $id_satuan]);

			if ($count_barang > 0) {
				// Jika masih ada barang yang menggunakan kategori ini, kategori tidak dapat dihapus
				echo json_encode(array('status' => 'error', 'message' => 'Satuan tidak dapat dihapus karena masih digunakan oleh barang.'));
				return;
			}

			$this->M_Crud->hapus_data(array('id_satuan' => $id_satuan), 'tb_satuan');
			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}
}
