<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
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
		$this->load->view('level/admin/master_supplier');
	}

	public function json()
	{
		$nama_supplier_filter = $this->input->post('nama');
		$pic_supplier_filter = $this->input->post('pic');
		$kontak_supplier_filter = $this->input->post('kontak');

		$columns = 'id_supplier, nama_supplier, pic, kontak_supplier, norek_supplier';
		$filter = array('nama_supplier', 'pic', 'kontak_supplier', 'norek_supplier'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array();

		$where = null;
		if ($nama_supplier_filter || $pic_supplier_filter || $kontak_supplier_filter) {
			$where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

			if ($nama_supplier_filter) {
				$where .= " AND nama_supplier LIKE '%" . $nama_supplier_filter . "%'";
			}

			if ($pic_supplier_filter) {
				$where .= " AND pic LIKE '%" . $pic_supplier_filter . "%'";
			}

			if ($kontak_supplier_filter) {
				$where .= " AND kontak_supplier LIKE '%" . $kontak_supplier_filter . "%'";
			}
		}

		$list = $this->Datatable_model->get_data('tb_supplier', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $supplier) {
			$no++;
			$row = array(
				$no,
				$supplier->nama_supplier,
				$supplier->pic,
				$supplier->kontak_supplier,
				$supplier->norek_supplier,
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
						<li><a class="dropdown-item" href="javascript:void(0);" data-id="' . $supplier->id_supplier . '" data-nama="' . $supplier->nama_supplier . '" data-pic="' . $supplier->pic . '" data-kontak="' . $supplier->kontak_supplier . '" data-rek="' . $supplier->norek_supplier . '" onclick="ubahSupplier(this);">&nbsp;Ubah Supplier</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $supplier->id_supplier . '" href="javascript:void(0);" onclick="deleteSupplier(this);">&nbsp;Hapus Supplier</a></li>
					</ul>
				</div>
				'
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_supplier'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_supplier', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function simpan()
	{
	    try {
	        $nama = $this->input->post('nama_supplier');
	        $pic = $this->input->post('pic_supplier');
	        $kontak = $this->input->post('kontak_supplier');
	        $norek = $this->input->post('rek');

	        // Validasi jika data kosong
	        if (empty($nama) || empty($pic) || empty($kontak) || empty($norek)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Semua data wajib diisi.'));
	            return;
	        }

	        // Capitalize nama supplier dan pic
	        $nama = ucwords(strtolower(trim($nama)));
	        $pic = ucwords(strtolower(trim($pic)));

	        // Cek apakah nama supplier sudah ada
	        $existing_supplier = $this->M_Crud->get_where('tb_supplier', array('nama_supplier' => $nama));

	        if ($existing_supplier) {
	            echo json_encode(array('status' => 'error', 'message' => 'Nama supplier sudah ada.'));
	            return;
	        }

	        // Data yang akan disimpan
	        $data = array(
	            'nama_supplier' => $nama,
	            'pic' => $pic,
	            'kontak_supplier' => $kontak,
	            'norek_supplier' => $norek,
	        );

	        // Simpan data ke tabel tb_supplier
	        $this->M_Crud->input_data($data, 'tb_supplier');

	        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan.'));
	    } catch (Exception $e) {
	        echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses penyimpanan data.'));
	    }
	}


	public function ubah()
	{
	    try {
	        $id = $this->input->post('id_supplier');
	        $nama = $this->input->post('nama_supplier');
	        $pic = $this->input->post('pic_supplier');
	        $kontak = $this->input->post('kontak_supplier');
	        $norek = $this->input->post('norek_supplier');

	        // Validasi jika data kosong
	        if (empty($id) || empty($nama) || empty($pic) || empty($kontak) || empty($norek)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Semua data wajib diisi.'));
	            return;
	        }

	        // Capitalize nama supplier dan pic
	        $nama = ucwords(strtolower(trim($nama)));
	        $pic = ucwords(strtolower(trim($pic)));

	        // Cek apakah nama supplier sudah ada kecuali untuk ID supplier yang sedang diubah
	        $existing_supplier = $this->M_Crud->get_where('tb_supplier', array(
	            'nama_supplier' => $nama,
	            'id_supplier !=' => $id
	        ));

	        if ($existing_supplier) {
	            echo json_encode(array('status' => 'error', 'message' => 'Nama supplier sudah ada.'));
	            return;
	        }

	        // Data yang akan diupdate
	        $data = array(
	            'nama_supplier' => $nama,
	            'pic' => $pic,
	            'kontak_supplier' => $kontak,
	            'norek_supplier' => $norek,
	        );

	        // Update data ke tabel tb_supplier
	        $this->M_Crud->update_data(['id_supplier' => $id], $data, 'tb_supplier');

	        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil diubah.'));
	    } catch (Exception $e) {
	        echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan dalam proses perubahan data.'));
	    }
	}


	public function delete($id_supplier)
	{
		try {
			$count_barang = $this->M_Crud->count_rows('tb_pemesanan', ['id_supplier' => $id_supplier]);

			if ($count_barang > 0) {
				// Jika masih ada barang yang menggunakan kategori ini, kategori tidak dapat dihapus
				echo json_encode(array('status' => 'error', 'message' => 'Supplier tidak dapat dihapus karena masih digunakan oleh barang.'));
				return;
			}

			$this->M_Crud->hapus_data(array('id_supplier' => $id_supplier), 'tb_supplier');
			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}
}
