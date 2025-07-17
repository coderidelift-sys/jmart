<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Desa extends CI_Controller
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
		$this->load->view('level/admin/wilayah_desa', $data);
	}

	public function json()
	{
		$nama_provinsi_filter = $this->input->post('nama_provinsi');
		$nama_kabupaten_filter = $this->input->post('nama_kabupaten');
		$nama_kecamatan_filter = $this->input->post('nama_kecamatan');
		$nama_desa_filter = $this->input->post('nama_desa');

		$columns = 'tb_kabupaten.id_kabupaten, tb_desa.id_desa, tb_desa.id_kecamatan, nama_provinsi, nama_kabupaten, nama_kecamatan, nama_desa, ongkos_kirim';
		$filter = array('nama_provinsi', 'nama_kabupaten', 'nama_kecamatan', 'nama_desa'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array(
			array(
				'table' => 'tb_kecamatan',
				'condition' => 'tb_kecamatan.id_kecamatan = tb_desa.id_kecamatan',
				'type' => 'inner'
			),
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

		if ($nama_desa_filter) {
			$where = "nama_desa LIKE '%" . $nama_desa_filter . "%'";
		}

		$list = $this->Datatable_model->get_data('tb_desa', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $start, $length);

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $desa) {
			$no++;
			$row = array(
				$no,
				$desa->nama_provinsi,
				$desa->nama_kabupaten,
				$desa->nama_kecamatan,
				$desa->nama_desa,
				"Rp. " . number_format($desa->ongkos_kirim),
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
						<li><a class="dropdown-item" href="javascript:void(0);" data-provinsi="' . $desa->nama_provinsi . '" data-kabupaten="' . $desa->nama_kabupaten . '" data-kecamatan="' . $desa->nama_kecamatan . '" data-id="' . $desa->id_desa . '" data-nama="' . $desa->nama_desa . '" data-ongkos="' . $desa->ongkos_kirim . '" onclick="ubahDesa(this);">&nbsp;Ubah Desa</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $desa->id_desa . '" href="javascript:void(0);" onclick="deleteDesa(this);">&nbsp;Hapus Desa</a></li>
					</ul>
				</div>
				'
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_desa'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_desa', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function simpan()
	{
	    try {
	        // Mengambil data yang dikirimkan melalui Ajax
	        $idKecamatan = $this->input->post('select_kecamatan');
	        $namaDesa = $this->input->post('nama_desa');
	        $ongkosKirim = $this->input->post('ongkos_kirim');

	        // Validasi data jika diperlukan
	        if (empty($idKecamatan) || empty($namaDesa) || empty($ongkosKirim)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
	            return;
	        }

	        // Capitalize nama desa
	        $namaDesa = ucwords(strtolower(trim($namaDesa)));

	        // Validasi ongkos kirim harus angka
	        if (!is_numeric($ongkosKirim)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Ongkos kirim harus berupa angka.'));
	            return;
	        }

	        // Cek apakah nama desa sudah ada di kecamatan yang sama
	        $existing_desa = $this->M_Crud->get_where('tb_desa', array(
	            'nama_desa' => $namaDesa
	        ));

	        if ($existing_desa) {
	            echo json_encode(array('status' => 'error', 'message' => 'Desa sudah ada di kecamatan ini.'));
	            return;
	        }

	        // Data yang akan disimpan
	        $data = array(
	            'id_kecamatan' => $idKecamatan,
	            'nama_desa' => $namaDesa,
	            'ongkos_kirim' => $ongkosKirim
	        );

	        // Menyimpan data desa
	        $this->M_Crud->input_data($data, 'tb_desa');

	        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan.'));
	    } catch (Exception $e) {
	        echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses penyimpanan data.'));
	    }
	}


	public function ubah()
	{
	    try {
	        // Mengambil data yang dikirimkan melalui Ajax
	        $idDesa = $this->input->post('id_desa');
	        $namaDesa = $this->input->post('nama_desa');
	        $ongkosKirim = $this->input->post('ongkos');

	        // Validasi data jika diperlukan
	        if (empty($idDesa) || empty($namaDesa) || !is_numeric($ongkosKirim)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap atau ongkos kirim tidak valid.'));
	            return;
	        }

	        // Capitalize nama desa
	        $namaDesa = ucwords(strtolower(trim($namaDesa)));

	        // Cek apakah nama desa sudah ada, kecuali diri sendiri
	        $existing_desa = $this->M_Crud->get_where('tb_desa', array(
	            'nama_desa' => $namaDesa,
	            'id_desa !=' => $idDesa
	        ));

	        if ($existing_desa) {
	            echo json_encode(array('status' => 'error', 'message' => 'Nama desa sudah ada.'));
	            return;
	        }

	        // Data yang akan diperbarui
	        $data = array(
	            'nama_desa' => $namaDesa,
	            'ongkos_kirim' => $ongkosKirim
	        );

	        // Mengupdate data desa
	        $this->M_Crud->update_data(['id_desa' => $idDesa], $data, 'tb_desa');

	        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil diubah.'));
	    } catch (Exception $e) {
	        echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses perubahan data.'));
	    }
	}


	public function delete($id_desa)
	{
		try {
			$result = $this->M_Crud->hapus_data(array('id_desa' => $id_desa), 'tb_desa');
			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}
}
