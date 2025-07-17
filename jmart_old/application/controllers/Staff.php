<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
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
        $this->load->view('level/admin/master_staff');
    }

    public function json()
    {
        $nama_staff_filter = $this->input->post('nama');
        $kontak_staff_filter = $this->input->post('kontak');

        $columns = 'id_kasir, nama_kasir, kontak_kasir, username, password';
        $filter = array('nama_kasir', 'kontak_kasir', 'username', 'password');
        $joins = array();

        $where = null;
        if ($nama_staff_filter || $kontak_staff_filter) {
            $where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

            if ($nama_staff_filter) {
                $where .= " AND nama_kasir LIKE '%" . $nama_staff_filter . "%'";
            }

            if ($kontak_staff_filter) {
                $where .= " AND kontak_kasir LIKE '%" . $kontak_staff_filter . "%'";
            }
        }

        $list = $this->Datatable_model->get_data('tb_kasir', $columns, $joins, $filter, $this->input->post('search')['value'], $where);

        $data = array();
        $no = $_POST['start'];
        foreach ($list->result() as $kasir) {
            $count = $this->M_Crud->count_rows('tb_pesanan', ['id_kasir' => $kasir->id_kasir]);
            $no++;
            $row = array(
                $no,
                $kasir->nama_kasir,
                $kasir->kontak_kasir,
                $kasir->username,
                '***',
                number_format($count),
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
						<li><a class="dropdown-item" href="javascript:void(0);" data-id="' . $kasir->id_kasir . '" data-nama="' . $kasir->nama_kasir . '"  data-kontak="' . $kasir->kontak_kasir . '" data-username="' . $kasir->username . '" onclick="ubahKasir(this);">&nbsp;Ubah Kasir</a></li>
						<li><a class="dropdown-item text-danger" data-id="' . $kasir->id_kasir . '" href="javascript:void(0);" onclick="deleteKasir(this);">&nbsp;Hapus Kasir</a></li>
					</ul>
				</div>
                '
            );
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable_model->count_all('tb_kasir'),
            "recordsFiltered" => $this->Datatable_model->count_filtered('tb_kasir', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function simpan()
    {
        try {
            // Ambil data dari POST request
            $nama = $this->input->post('nama_kasir');
            $kontak = $this->input->post('kontak_kasir');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Validasi data jika perlu (misal: pastikan username dan password tidak kosong)
            if (empty($username) || empty($password)) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Username dan Password harus diisi.'
                ));
                return;
            }

            // Cek apakah nama_kasir sudah ada
            $this->load->model('M_Crud');
            $existingNamaKasir = $this->M_Crud->get_where('tb_kasir', array('nama_kasir' => $nama));
            if ($existingNamaKasir) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Nama Kasir sudah digunakan.'
                ));
                return;
            }

            // Cek apakah username sudah ada
            $existingUsername = $this->M_Crud->get_where('tb_kasir', array('username' => $username));
            if ($existingUsername) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Username sudah digunakan.'
                ));
                return;
            }

            // Data yang akan disimpan
            $data = array(
                'nama_kasir' => $nama,
                'kontak_kasir' => $kontak,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),  // Enkripsi password sebelum disimpan
            );

            // Simpan data ke database
            $this->M_Crud->input_data($data, 'tb_kasir');

            echo json_encode(
                array(
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan.'
                )
            );
        } catch (Exception $e) {
            // Menangani error jika terjadi exception
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }



    public function ubah()
    {
        try {
            // Ambil data dari POST request
            $id = $this->input->post('id_kasir');
            $nama = $this->input->post('nama_kasir');
            $kontak = $this->input->post('kontak_kasir');
            $username = $this->input->post('username_kasir');
            $password = $this->input->post('password_kasir');

            // Validasi jika username atau nama kasir sudah ada, kecuali untuk dirinya sendiri
            $this->load->model('M_Crud');

            // Cek apakah nama_kasir sudah ada, kecuali untuk data yang sedang diubah
            $existingNamaKasir = $this->M_Crud->get_where('tb_kasir', array('nama_kasir' => $nama, 'id_kasir !=' => $id));
            if ($existingNamaKasir) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Nama Kasir sudah digunakan.'
                ));
                return;
            }

            // Cek apakah username sudah ada, kecuali untuk data yang sedang diubah
            $existingUsername = $this->M_Crud->get_where('tb_kasir', array('username' => $username, 'id_kasir !=' => $id));
            if ($existingUsername) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Username sudah digunakan.'
                ));
                return;
            }

            // Jika password kosong, gunakan password lama
            if (!empty($password)) {
                $password = password_hash($password, PASSWORD_DEFAULT);  // Enkripsi password baru jika ada
            } else {
                // Ambil password lama dari database
                $oldKasir = $this->M_Crud->get_where('tb_kasir', array('id_kasir' => $id));
                $password = $oldKasir->password;  // Gunakan password lama jika password baru kosong
            }

            // Data yang akan disimpan
            $data = array(
                'nama_kasir' => $nama,
                'kontak_kasir' => $kontak,
                'username' => $username,
                'password' => $password,  // Simpan password baru (atau password lama jika kosong)
            );

            // Update data ke database
            $this->M_Crud->update_data(['id_kasir' => $id], $data, 'tb_kasir');

            echo json_encode(
                array(
                    'status' => 'success',
                    'message' => 'Data berhasil diubah.'
                )
            );
        } catch (Exception $e) {
            // Menangani error jika terjadi exception
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }

    public function delete($id_kasir)
    {
        try {
            $count_barang = $this->M_Crud->count_rows('tb_pesanan', ['id_kasir' => $id_kasir]);

            if ($count_barang > 0) {
                // Jika masih ada barang yang menggunakan kategori ini, kategori tidak dapat dihapus
                echo json_encode(array('status' => 'error', 'message' => 'Kasir tidak dapat dihapus karena masih digunakan pada pesanan.'));
                return;
            }

            $this->M_Crud->hapus_data(array('id_kasir' => $id_kasir), 'tb_kasir');
            echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
}
