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
        $level_staff_filter = $this->input->post('level');

        $columns = 'id_user, nama_member, wa_member, username, password, level';
        $filter = array('nama_member', 'wa_member', 'username', 'password', 'level');
        $joins = array();

        $where = "level != 'User'";
        if ($nama_staff_filter) {
            $where .= " AND nama_member LIKE '%" . $nama_staff_filter . "%'";
        }
        if ($kontak_staff_filter) {
            $where .= " AND wa_member LIKE '%" . $kontak_staff_filter . "%'";
        }
        if ($level_staff_filter) {
            $where .= " AND level = '" . $level_staff_filter . "'";
        }

        $list = $this->Datatable_model->get_data('tb_user', $columns, $joins, $filter, $this->input->post('search')['value'], $where);

        $data = array();
        $no = $_POST['start'];
        foreach ($list->result() as $user) {
            $total_penjualan = 0;
            if ($user->level == 'Kasir') {
                $total_penjualan = $this->M_Crud->count_rows('tb_pesanan', ['id_kasir' => $user->id_user]);
            }
            $no++;
            $row = array(
                $no,
                $user->nama_member,
                $user->wa_member,
                $user->username,
                '***',
                number_format($total_penjualan),
                $user->level,
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
                        <li><a class="dropdown-item" href="javascript:void(0);" data-id="' . $user->id_user . '" data-nama="' . $user->nama_member . '"  data-kontak="' . $user->wa_member . '" data-username="' . $user->username . '" data-level="' . $user->level . '" onclick="ubahKasir(this);">&nbsp;Ubah Staff</a></li>
                        <li><a class="dropdown-item text-danger" data-id="' . $user->id_user . '" href="javascript:void(0);" onclick="deleteKasir(this);">&nbsp;Hapus Staff</a></li>
                    </ul>
                </div>
                '
            );
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $list->num_rows(),
            "recordsFiltered" => $list->num_rows(),
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
            $level = $this->input->post('level');

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
            $existingNamaKasir = $this->M_Crud->get_where('tb_user', array('nama_member' => $nama));
            if ($existingNamaKasir) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Nama sudah digunakan.'
                ));
                return;
            }

            // Cek apakah username sudah ada
            $existingUsername = $this->M_Crud->get_where('tb_user', array('username' => $username));
            if ($existingUsername) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Username sudah digunakan.'
                ));
                return;
            }

            // Data yang akan disimpan ke tb_user
            $data_user = array(
                'nama_member' => $nama,
                'wa_member' => $kontak,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'level' => $level,
            );

            // Simpan data ke tb_user
            $this->M_Crud->input_data($data_user, 'tb_user');

            // Jika level Kasir, tambahkan juga ke tb_kasir
            if ($level == 'Kasir') {
                $data_kasir = array(
                    'nama_kasir' => $nama,
                    'kontak_kasir' => $kontak,
                    'username' => $username,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                );
                $this->M_Crud->input_data($data_kasir, 'tb_kasir');
            }

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
            $level = $this->input->post('level_kasir');

            $this->load->model('M_Crud');

            // Cek apakah nama_member sudah ada, kecuali untuk data yang sedang diubah
            $existingNama = $this->M_Crud->get_where('tb_user', array('nama_member' => $nama, 'id_user !=' => $id));
            if ($existingNama) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Nama sudah digunakan.'
                ));
                return;
            }

            // Cek apakah username sudah ada, kecuali untuk data yang sedang diubah
            $existingUsername = $this->M_Crud->get_where('tb_user', array('username' => $username, 'id_user !=' => $id));
            if ($existingUsername) {
                echo json_encode(array(
                    'status' => 'error',
                    'message' => 'Username sudah digunakan.'
                ));
                return;
            }

            // Ambil data user lama
            $oldUser = $this->M_Crud->get_where('tb_user', array('id_user' => $id));
            $old_level = $oldUser['level'];
            $old_username = $oldUser['username'];

            // Jika password kosong, gunakan password lama
            if (!empty($password)) {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $password_hash = $oldUser['password'];
            }

            // Data yang akan diupdate ke tb_user
            $data_user = array(
                'nama_member' => $nama,
                'wa_member' => $kontak,
                'username' => $username,
                'password' => $password_hash,
                'level' => $level,
            );

            $this->M_Crud->update_data(['id_user' => $id], $data_user, 'tb_user');

            // Sinkronisasi tb_kasir
            if ($old_level == 'Kasir' && $level != 'Kasir') {
                // Jika sebelumnya Kasir, sekarang bukan, hapus dari tb_kasir
                $this->M_Crud->hapus_data(['username' => $old_username], 'tb_kasir');
            } elseif ($old_level != 'Kasir' && $level == 'Kasir') {
                // Jika sebelumnya bukan Kasir, sekarang Kasir, tambahkan ke tb_kasir
                $data_kasir = array(
                    'nama_kasir' => $nama,
                    'kontak_kasir' => $kontak,
                    'username' => $username,
                    'password' => $password_hash,
                );
                $this->M_Crud->input_data($data_kasir, 'tb_kasir');
            } elseif ($level == 'Kasir') {
                // Jika tetap Kasir, update tb_kasir
                $data_kasir = array(
                    'nama_kasir' => $nama,
                    'kontak_kasir' => $kontak,
                    'username' => $username,
                    'password' => $password_hash,
                );
                $this->M_Crud->update_data(['username' => $old_username], $data_kasir, 'tb_kasir');
            }

            echo json_encode(
                array(
                    'status' => 'success',
                    'message' => 'Data berhasil diubah.'
                )
            );
        } catch (Exception $e) {
			var_dump($e);
			die;
            // Menangani error jika terjadi exception
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }

    public function delete($id_kasir)
    {
        try {
            $this->load->model('M_Crud');
            // Ambil data user berdasarkan id
            $user = $this->M_Crud->get_where('tb_user', ['id_user' => $id_kasir]);
            if ($user && $user->level == 'Kasir') {
                // Hapus juga dari tb_kasir berdasarkan username
                $this->M_Crud->hapus_data(['username' => $user->username], 'tb_kasir');
            }

            $count_barang = $this->M_Crud->count_rows('tb_pesanan', ['id_kasir' => $id_kasir]);

            if ($count_barang > 0) {
                // Jika masih ada barang yang menggunakan kategori ini, kategori tidak dapat dihapus
                echo json_encode(array('status' => 'error', 'message' => 'Kasir tidak dapat dihapus karena masih digunakan pada pesanan.'));
                return;
            }

            $this->M_Crud->hapus_data(array('id_user' => $id_kasir), 'tb_user');
            echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
}
