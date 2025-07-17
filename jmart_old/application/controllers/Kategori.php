<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
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
		$this->load->view('level/admin/master_kategori');
	}

	public function json()
	{
		$nama_kategori_filter = $this->input->post('nama_kategori');

		$columns = 'id_kategori_brg, nama_kategori_brg, icon_kategori';
		$filter = array('nama_kategori_brg'); // Sesuaikan dengan nama kolom yang ingin Anda filter
		$joins = array();

		$where = null;
		if ($nama_kategori_filter) {
			$where = "nama_kategori_brg LIKE '%" . $nama_kategori_filter . "%'";
		}

		$list = $this->Datatable_model->get_data('tb_kategori', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

		$data = array();
		$no = $_POST['start'];
		foreach ($list->result() as $kategori) {
			$gambar = $kategori->icon_kategori == "" ? "<img style=\"height:40px\" src='" . base_url('public/template/upload/kategori/default_prev_ui.png') . "' alt='Gambar Kategori'>" : "<img style=\"height:40px\" src='" . base_url('public/template/upload/kategori/' . $kategori->icon_kategori) . "' alt='Gambar Kategori'>";
			$count = $this->db->where('id_kategori_brg', $kategori->id_kategori_brg)->count_all_results('tb_barang');
			$no++;
			$row = array(
				$no,
				$gambar,
				$kategori->nama_kategori_brg,
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
						<li><a class="dropdown-item" href="javascript:void(0);" data-id="' . $kategori->id_kategori_brg . '" data-nama="' . $kategori->nama_kategori_brg . '" data-icon="' . $kategori->icon_kategori . '" onclick="ubahKategori(this);">&nbsp;Ubah Kategori</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $kategori->id_kategori_brg . '" href="javascript:void(0);" onclick="deleteKategori(this);">&nbsp;Hapus Kategori</a></li>
					</ul>
				</div>
				'
			);
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Datatable_model->count_all('tb_kategori'),
			"recordsFiltered" => $this->Datatable_model->count_filtered('tb_kategori', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function simpan()
	{
	    try {
	        $nama_kategori = $this->input->post('nama_kategori');
	        $icon_kategori = ''; // Default value untuk icon_kategori

	        // Validasi nama kategori kosong
	        if (empty($nama_kategori)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Nama kategori wajib diisi.'));
	            return;
	        }

	        // Periksa apakah nama_kategori sudah ada di database
	        $existing_kategori = $this->M_Crud->get_where('tb_kategori', array('nama_kategori_brg' => $nama_kategori));
	        if ($existing_kategori) {
	            echo json_encode(array('status' => 'error', 'message' => 'Nama kategori sudah ada. Harap gunakan nama yang berbeda.'));
	            return;
	        }

	        // Periksa apakah kunci 'icon_kategori' ada dalam array $_FILES
	        if (isset($_FILES['icon_kategori']) && $_FILES['icon_kategori']['error'] === 0) {
	            $gambar_data = $_FILES['icon_kategori'];
	            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif']; // Ekstensi file yang diperbolehkan
	            $ext = strtolower(pathinfo($gambar_data['name'], PATHINFO_EXTENSION));

	            // Periksa apakah ekstensi file diperbolehkan
	            if (!in_array($ext, $allowed_extensions)) {
	                echo json_encode(array('status' => 'error', 'message' => 'Format file tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.'));
	                return;
	            }

	            // Periksa ukuran file maksimal (contoh: 2MB)
	            $max_file_size = 2 * 1024 * 1024; // 2MB
	            if ($gambar_data['size'] > $max_file_size) {
	                echo json_encode(array('status' => 'error', 'message' => 'Ukuran file terlalu besar. Maksimal 2MB.'));
	                return;
	            }

	            // Generate nama file unik dan tentukan path upload
	            $nama_file = uniqid() . '_' . time() . '.' . $ext;
	            $upload_path = FCPATH . 'public/template/upload/kategori/' . $nama_file;

	            // Periksa apakah folder upload ada, jika tidak buat folder tersebut
	            if (!is_dir(FCPATH . 'public/template/upload/kategori/')) {
	                mkdir(FCPATH . 'public/template/upload/kategori/', 0755, true);
	            }

	            // Pindahkan file yang diunggah ke folder tujuan
	            if (move_uploaded_file($gambar_data['tmp_name'], $upload_path)) {
	                $icon_kategori = $nama_file; // Set nama file ke database
	            } else {
	                echo json_encode(array('status' => 'error', 'message' => 'Gagal mengunggah gambar.'));
	                return;
	            }
	        }

	        // Data untuk disimpan ke database
	        $data = array(
	            'nama_kategori_brg' => trim($nama_kategori),
	            'icon_kategori' => $icon_kategori
	        );

	        // Simpan data ke database
	        $result = $this->M_Crud->input_data($data, 'tb_kategori');

	        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan.'));
	    } catch (Exception $e) {
	        // Tangani exception
	        echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()));
	    }
	}


	public function ubah()
	{
	    try {
	        $id = $this->input->post('id_kategori');
	        $nama = $this->input->post('nama_kategori');
	        $gambarLama = $this->input->post('gambar_lama');
	        $nama_file = $gambarLama;

	        // Validasi nama kategori kosong
	        if (empty($nama)) {
	            echo json_encode(array('status' => 'error', 'message' => 'Nama kategori wajib diisi.'));
	            return;
	        }

	        // Periksa apakah nama_kategori sudah ada di database dengan id berbeda
	        $existing_kategori = $this->M_Crud->get_where('tb_kategori', array(
	            'nama_kategori_brg' => $nama,
	            'id_kategori_brg !=' => $id // Pastikan tidak memeriksa terhadap id yang sama
	        ));

	        if ($existing_kategori) {
	            echo json_encode(array('status' => 'error', 'message' => 'Nama kategori sudah ada. Harap gunakan nama yang berbeda.'));
	            return;
	        }

	        // Periksa apakah ada file baru yang diunggah
	        if (isset($_FILES['icon_kategori']) && $_FILES['icon_kategori']['error'] === 0) {
	            $gambar_data = $_FILES['icon_kategori'];
	            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif']; // Ekstensi file yang diperbolehkan
	            $ext = strtolower(pathinfo($gambar_data['name'], PATHINFO_EXTENSION));

	            // Periksa apakah ekstensi file diperbolehkan
	            if (!in_array($ext, $allowed_extensions)) {
	                echo json_encode(array('status' => 'error', 'message' => 'Format file tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.'));
	                return;
	            }

	            // Periksa ukuran file maksimal (contoh: 2MB)
	            $max_file_size = 2 * 1024 * 1024; // 2MB
	            if ($gambar_data['size'] > $max_file_size) {
	                echo json_encode(array('status' => 'error', 'message' => 'Ukuran file terlalu besar. Maksimal 2MB.'));
	                return;
	            }

	            // Generate nama file unik dan tentukan path upload
	            $nama_file = uniqid() . '_' . time() . '.' . $ext;
	            $upload_path = FCPATH . 'public/template/upload/kategori/' . $nama_file;

	            // Periksa apakah folder upload ada, jika tidak buat folder tersebut
	            if (!is_dir(FCPATH . 'public/template/upload/kategori/')) {
	                mkdir(FCPATH . 'public/template/upload/kategori/', 0755, true);
	            }

	            // Pindahkan file yang diunggah ke folder tujuan
	            if (move_uploaded_file($gambar_data['tmp_name'], $upload_path)) {
	                // Jika file lama ada dan berbeda dari file baru, hapus file lama
	                if (!empty($gambarLama) && file_exists(FCPATH . 'public/template/upload/kategori/' . $gambarLama)) {
	                    unlink(FCPATH . 'public/template/upload/kategori/' . $gambarLama);
	                }
	            } else {
	                echo json_encode(array('status' => 'error', 'message' => 'Gagal mengunggah gambar.'));
	                return;
	            }
	        }

	        // Data untuk diupdate di database
	        $data = array(
	            'nama_kategori_brg' => trim($nama),
	            'icon_kategori' => $nama_file
	        );

	        // Update data di database
	        $result = $this->M_Crud->update_data(['id_kategori_brg' => $id], $data, 'tb_kategori');

	        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil diubah.'));
	    } catch (Exception $e) {
	        // Tangani exception
	        echo json_encode(array('status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()));
	    }
	}


	public function delete($id_kategori)
	{
		try {
			// Periksa apakah kategori masih digunakan oleh barang
			$count_barang = $this->M_Crud->count_rows('tb_barang', ['id_kategori_brg' => $id_kategori]);

			if ($count_barang > 0) {
				// Jika masih ada barang yang menggunakan kategori ini, kategori tidak dapat dihapus
				echo json_encode(array('status' => 'error', 'message' => 'Kategori tidak dapat dihapus karena masih digunakan oleh barang.'));
				return;
			}

			// Dapatkan nama file gambar berdasarkan ID yang akan dihapus
			$data_kategori = $this->M_Crud->show('tb_kategori', ['id_kategori_brg' => $id_kategori])->row_array();
			$nama_file = $data_kategori['icon_kategori'];

			// Hapus data dari database
			$result = $this->M_Crud->hapus_data(array('id_kategori_brg' => $id_kategori), 'tb_kategori');

			if (!empty($nama_file)) {
				$lokasi_folder = FCPATH . 'public/template/upload/kategori/'; // Tentukan 
				$path_to_file = $lokasi_folder . $nama_file;

				// Hapus file gambar
				if (file_exists($path_to_file)) {
					unlink($path_to_file);
				}
			}

			echo json_encode(array('status' => 'success', 'message' => 'Data dan gambar berhasil dihapus.'));
		} catch (Exception $e) {
			echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
		}
	}
}
