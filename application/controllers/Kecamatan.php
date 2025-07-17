<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan extends CI_Controller
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
		$this->load->view('level/admin/wilayah_kecamatan', $data);
	}

	public function json()
	{
		$nama_provinsi_filter = $this->input->post('nama_provinsi');
		$nama_kabupaten_filter = $this->input->post('nama_kabupaten');
		$nama_kecamatan_filter = $this->input->post('nama_kecamatan');

		$columns = 'tb_kabupaten.id_kabupaten, id_kecamatan, nama_provinsi, nama_kabupaten, nama_kecamatan';
		$filter = array('nama_provinsi', 'nama_kabupaten', 'nama_kecamatan'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array(
			array(
				'table' => 'tb_kabupaten',
				'condition' => 'tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten',
				'type' => 'inner'
			),
			array(
				'table' => 'tb_provinsi',
				'condition' => 'tb_kabupaten.id_provinsi = tb_provinsi.id_provinsi',
				'type' => 'inner'
			),
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

		if ($nama_kecamatan_filter) {
			$where = "nama_kecamatan LIKE '%" . $nama_kecamatan_filter . "%'";
		}

		$list = $this->Datatable_model->get_data('tb_kecamatan', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $start, $length);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $kecamatan) {
			$no++;
			$row = array(
				$no,
				$kecamatan->nama_provinsi,
				$kecamatan->nama_kabupaten,
				$kecamatan->nama_kecamatan,
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
						<li><a class="dropdown-item" href="javascript:void(0);" data-provinsi="' . $kecamatan->nama_provinsi . '" data-kabupaten="' . $kecamatan->nama_kabupaten . '" data-id="' . $kecamatan->id_kecamatan . '" data-nama="' . $kecamatan->nama_kecamatan . '" onclick="ubahKecamatan(this);">&nbsp;Ubah Kecamatan</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $kecamatan->id_kecamatan . '" href="javascript:void(0);" onclick="deleteKecamatan(this);">&nbsp;Hapus Kecamatan</a></li>
					</ul>
				</div>
				'
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_kecamatan'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_kecamatan', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function simpan()
	{
		try {
			// Mengambil data yang dikirimkan melalui Ajax
			$idKabupaten = $this->input->post('select_kabupaten');
			$namaKecamatan = $this->input->post('nama_kecamatan');

			// Validasi data jika diperlukan
			if (empty($idKabupaten) || empty($namaKecamatan)) {
				echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
				return;
			}

			// Capitalize nama kecamatan
			$namaKecamatan = ucwords(strtolower(trim($namaKecamatan)));

			// Cek apakah nama kecamatan sudah ada di kabupaten yang sama
			$existing_kecamatan = $this->M_Crud->get_where('tb_kecamatan', array(
				'nama_kecamatan' => $namaKecamatan
			));

			if ($existing_kecamatan) {
				echo json_encode(array('status' => 'error', 'message' => 'Kecamatan sudah ada di kabupaten ini.'));
				return;
			}

			// Data yang akan disimpan
			$data = array(
				'id_kabupaten' => $idKabupaten,
				'nama_kecamatan' => $namaKecamatan
			);

			// Menyimpan data kecamatan
			$this->M_Crud->input_data($data, 'tb_kecamatan');

			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses penyimpanan data.'));
		}
	}


	public function ubah()
	{
		try {
			// Mengambil data yang dikirimkan melalui Ajax
			$idKecamatan = $this->input->post('id_kecamatan');
			$namaKecamatan = $this->input->post('nama_kecamatan');

			// Validasi data jika diperlukan
			if (empty($idKecamatan) || empty($namaKecamatan)) {
				echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
				return;
			}

			// Capitalize nama kecamatan
			$namaKecamatan = ucwords(strtolower(trim($namaKecamatan)));

			// Cek apakah nama kecamatan sudah ada, kecuali diri sendiri
			$existing_kecamatan = $this->M_Crud->get_where('tb_kecamatan', array(
				'nama_kecamatan' => $namaKecamatan,
				'id_kecamatan !=' => $idKecamatan
			));

			if ($existing_kecamatan) {
				echo json_encode(array('status' => 'error', 'message' => 'Nama kecamatan sudah ada.'));
				return;
			}

			// Data yang akan diperbarui
			$data = array(
				'nama_kecamatan' => $namaKecamatan
			);

			// Mengupdate data kecamatan
			$this->M_Crud->update_data(['id_kecamatan' => $idKecamatan], $data, 'tb_kecamatan');

			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil diubah.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses perubahan data.'));
		}
	}


	public function delete($id_kecamatan)
	{
		try {
			$result = $this->M_Crud->hapus_data(array('id_kecamatan' => $id_kecamatan), 'tb_kecamatan');
			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}
}
