<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Anggota extends CI_Controller
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

    public function autodebet()
    {
        // Mendapatkan rentang tanggal dari input POST
        $tanggal_range = $this->input->post('tanggal_range');
        $tanggal = explode(" - ", $tanggal_range);

        // Query untuk mendapatkan data dari tabel tb_pesanan dengan join tb_user
        $query = $this->db
			->select('
				MAX(tb_pesanan.id_pesanan) as id_pesanan, 
				tb_user.nomor_induk, 
				tb_user.nama_member, 
				SUM(tb_pesanan.grand_total) as total_autodebet
			')
			->from('tb_pesanan')
			->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')
			->where('tb_pesanan.metode_bayar', 'autodebet')
			->where('tb_pesanan.status_pembayaran', 'Menunggu Pembayaran')
			->where('tb_pesanan.tgl_pesanan >=', date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[0]))))
			->where('tb_pesanan.tgl_pesanan <=', date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[1]))))
			->group_by(['tb_user.nomor_induk', 'tb_user.nama_member'])
			->order_by('tb_user.nama_member', 'ASC')
			->get();

		$data = $query->result_array();


        // Load library PHPExcel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set rentang tanggal pada baris pertama
        $sheet->setCellValue('A1', 'Rentang Tanggal');
        $sheet->setCellValue('B1', $tanggal_range);

        // Set header pada baris ke-3
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'NIK');
        $sheet->setCellValue('C3', 'Nama');
        $sheet->setCellValue('D3', 'Total Autodebet');

        $boldStyleArray = [
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $sheet->getStyle('A3:D3')->applyFromArray($boldStyleArray);

        // Jika tidak ada data
        if (empty($data)) {
            $sheet->mergeCells('A4:D4'); // Gabungkan semua kolom pada baris ke-4
            $sheet->setCellValue('A4', 'Data tidak tersedia'); // Tampilkan teks di tengah area yang digabungkan
            $sheet->getStyle('A4')->getAlignment()->setHorizontal('center'); // Ratakan teks ke tengah secara horizontal
            $sheet->getStyle('A4')->getAlignment()->setVertical('center'); // Ratakan teks ke tengah secara vertikal
        } else {
            // Set data pada sheet
            $row = 4; // Dimulai dari baris ke-4
            $no = 1; // Nomor urut
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, $item['nomor_induk']);
                $sheet->setCellValue('C' . $row, $item['nama_member']);
                $sheet->setCellValue('D' . $row, $item['total_autodebet']);

                // Tambahkan border untuk setiap sel pada baris ini
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $sheet->getStyle('A' . $row . ':D' . $row)->applyFromArray($styleArray);

                foreach (range('A', 'D') as $column) {
                    $sheet->getColumnDimension($column)->setAutoSize(true);
                }
                $row++;
            }
        }
        // Set header untuk tipe konten dan nama file
        $tanggal_awal = date('Ymd', strtotime(str_replace('/', '-', $tanggal[0])));
        $tanggal_akhir = date('Ymd', strtotime(str_replace('/', '-', $tanggal[1])));
        $filename = 'autodebet_report_' . $tanggal_awal . '_' . $tanggal_akhir . '.xlsx';

        // Set header untuk tipe konten dan nama file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Simpan file Excel ke dalam output buffer
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }



    public function check()
    {
        $id = $this->input->post('id');

        $user = $this->M_Crud->show('tb_user', ['id_user' => $id])->row_array(); // Memanggil method show dari model M_Crud

        if ($user) {
            $response = [
                'status' => 'success',
                'data' => $user
            ];
        } else {
            $response = [
                'status' => 'error',
                'message' => 'User tidak ditemukan'
            ];
        }

        // Mengirimkan response dalam format JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function import_data()
    {
        $config['upload_path'] = FCPATH . 'public/template/upload/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 10240; // 10MB max size
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('excelFile')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            // Upload successful
            $uploadedData = $this->upload->data();
            $filePath = $uploadedData['full_path'];

            // Load PHPExcel library
            $spreadsheet = IOFactory::load($filePath);
            $worksheet = $spreadsheet->getActiveSheet();

            $data = array();
            $highestRow = ($worksheet->getHighestRow()) - 1;
            $highestColumn = $worksheet->getHighestColumn();

            $jumlahSukses = 0;
            $jumlahError = 0;

            for ($row = 6; $row <= $highestRow; ++$row) {
                $nomorInduk = $worksheet->getCell('G' . $row)->getValue();

                // Periksa apakah nomor induk sudah ada di database
                $query = $this->db->get_where('tb_user', array('nomor_induk' => $nomorInduk));
                if ($query->num_rows() > 0) {
                    // Jika nomor induk sudah ada, tambahkan jumlahError
                    $jumlahError++;
                    continue; // Lewati iterasi ini dan lanjutkan ke baris berikutnya
                }

                // Jika nomor induk belum ada, simpan data ke dalam database
                $rowData = array(
                    'nama_member' => $worksheet->getCell('B' . $row)->getValue(),
                    'jenis_kelamin' => $worksheet->getCell('C' . $row)->getValue(),
                    'tgl_lahir' => $worksheet->getCell('D' . $row)->getValue(),
                    'dept' => $worksheet->getCell('E' . $row)->getValue(),
                    'nomor_induk' => $nomorInduk,
                    'wa_member' => $worksheet->getCell('I' . $row)->getValue(),
                    'email_member' => $worksheet->getCell('K' . $row)->getValue(),
                    'level' => "User",
                    'status_registrasi' => "N",
                    'avatar' => "default.png"
                );

                $this->db->insert('tb_user', $rowData);
                $jumlahSukses++;

                $data[] = $rowData;
            }

            // Hapus file yang diunggah setelah selesai impor
            unlink($filePath);

            // Set flashdata untuk jumlahSukses dan jumlahError
            $this->session->set_flashdata('jumlahSukses', $jumlahSukses);
            $this->session->set_flashdata('jumlahError', $jumlahError);

            // Kembali ke halaman sebelumnya
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function index()
    {
        $this->load->view('level/admin/anggota_data');
    }

    public function json()
    {
        $nama_member = $this->input->post('nama_member');
        $wa_member = $this->input->post('wa_member');
        $nomor_induk = $this->input->post('nomor_induk');
        $status = $this->input->post('filter');
        $tahun = $this->input->post('tahun');
        $tanggal_range = $this->input->post('tanggal_range');

        $columns = 'id_user, nama_member, wa_member, nomor_induk, level, created_at, status_registrasi, avatar';
        $filter = array('nama_member', 'wa_member', 'nomor_induk');
        $joins = array();

        $where = "level = 'User'"; // Kondisi default

        if ($nama_member) {
            $where .= " AND nama_member LIKE '%" . $nama_member . "%'";
        }

        if ($wa_member) {
            $where .= " AND wa_member LIKE '%" . $wa_member . "%'";
        }

        if ($nomor_induk) {
            $where .= " AND nomor_induk LIKE '%" . $nomor_induk . "%'";
        }

        if ($status) {
            $where .= " AND status_registrasi LIKE '%" . $status . "%'";
        }

        $list = $this->Datatable_model->get_data('tb_user', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

        $data = array();
        $no = $_POST['start'];
        foreach ($list->result() as $anggota) {

            if (isset($tahun)) {
                $this->db->where("YEAR(tgl_pesanan)", $tahun);
            }

            $query = $this->db
                ->select_sum('grand_total')
                ->where('id_user', $anggota->id_user)
                ->get('tb_pesanan');

            $total_grand_total = ($query->num_rows() > 0) ? $query->row()->grand_total : 0;

            $query2 = $this->db
                ->select_sum('grand_total')
                ->where('id_user', $anggota->id_user)
                ->where('metode_bayar', 'autodebet')
                ->where('status_pembayaran', 'Menunggu Pembayaran')
                ->get('tb_pesanan');

            $total_grand_total2 = ($query2->num_rows() > 0) ? $query2->row()->grand_total : 0;

            $tanggal = explode(" - ", $tanggal_range);

            $query3 = $this->db
                ->select_sum('grand_total')
                ->where('id_user', $anggota->id_user)
                ->where('metode_bayar', 'autodebet')
                ->where('status_pembayaran', 'Menunggu Pembayaran')
                ->where('tgl_pesanan >=', date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[0])))) // Tanggal awal
                ->where('tgl_pesanan <=', date('Y-m-d', strtotime(str_replace('/', '-', $tanggal[1])))) // Tanggal akhir
                ->get('tb_pesanan');

            $total_grand_total3 = ($query3->num_rows() > 0) ? $query3->row()->grand_total : 0;

            $no++;
            $row = array(
                $no,
                $anggota->nama_member,
                $anggota->wa_member,
                $anggota->nomor_induk,
                "
                <img src=" . base_url('public/template/upload/user/' . $anggota->avatar) . " class=\"avatar avatar-md img-zoom\" draggable=\"false\" style=\"cursor: pointer\">
                ",
                $anggota->status_registrasi == "Y" ? "<span class=\"badge bg-success-lt\">Aktif</span>" : "<span class=\"badge bg-danger-lt\">Tidak</span>",
                "Rp. " . number_format($total_grand_total),
                '<span class="text-danger">' . "Rp. " . number_format($total_grand_total2) . "</span>",
                '<span class="text-danger">' . "Rp. " . number_format($total_grand_total3) . "</span>",
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
						<li><a href="javascript:void(0)" class="dropdown-item" onclick="lihatDetail(' . $anggota->id_user . ')">Lihat Detail</a></li>
                        <li><a href="javascript::void(0)" class="dropdown-item" onclick="ubahAnggota(' . $anggota->id_user . ')">Edit User</a></li>
                        <li><a href="javascript::void(0)" class="dropdown-item" onclick="resetPassword(' . $anggota->id_user . ')">Reset Password</a></li>
                        <li><a href="#" class="delete dropdown-item">Hapus User</a></li>
					</ul>
				</div>
				',
            );
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable_model->count_all('tb_user', $where),
            "recordsFiltered" => $this->Datatable_model->count_filtered('tb_user', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function reset_password($id)
    {
        $new_password = password_hash('123', PASSWORD_DEFAULT);

        // Simpan password baru ke dalam database menggunakan Query Builder
        $this->db->set('password', $new_password);
        $this->db->where('id_user', $id);
        $update_success = $this->db->update('tb_user');

        $response = array();
        if ($update_success) {
            $response['success'] = true;
            $response['message'] = 'Password berhasil direset dengan metode password_hash().';
        } else {
            $response['success'] = false;
            $response['message'] = 'Gagal mereset password.';
        }

        // Keluarkan response dalam format JSON
        echo json_encode($response);
    }


    public function simpan_data()
    {
        // Tangkap data dari formulir
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nama_member = $this->input->post('nama_member');
        $email_member = $this->input->post('email_member');
        $wa_member = $this->input->post('wa_member');
        $nomor_induk = $this->input->post('nomor_induk');
        $dept = $this->input->post('dept');
        $level = "User";
        $tgl_lahir = $this->input->post('tgl_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $avatar = "default.jpg";

        $data = array(
            'username' => $username,
            'password' => $password,
            'nama_member' => $nama_member,
            'email_member' => $email_member,
            'wa_member' => $wa_member,
            'nomor_induk' => $nomor_induk,
            'dept' => $dept,
            'level' => $level,
            'tgl_lahir' => $tgl_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'avatar' => $avatar,
        );

        $this->M_Crud->input_data($data, 'tb_user');

        $response = ['status' => 'success', 'message' => 'Data berhasil disimpan.'];
        echo json_encode($response);
    }

    public function update_data()
    {
        $id_user = $this->input->post('id_user');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $nama_member = $this->input->post('nama_member');
        $email_member = $this->input->post('email_member');
        $wa_member = $this->input->post('wa_member');
        $nomor_induk = $this->input->post('nomor_induk');
        $dept = $this->input->post('dept');
        $level = $this->input->post('level');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $status_registrasi = $this->input->post('status_registrasi');
        $status_akun = $this->input->post('status_akun');
        $avatar = $_FILES['avatar']['name'];

        $data = [
            'username' => $username,
            'nama_member' => $nama_member,
            'email_member' => $email_member,
            'wa_member' => $wa_member,
            'nomor_induk' => $nomor_induk,
            'dept' => $dept,
            'level' => $level,
            'tgl_lahir' => $tgl_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'status_registrasi' => $status_registrasi,
            'status_akun' => $status_akun,
        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if (!empty($avatar)) {
            $config['upload_path']   = './public/template/upload/user/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = 2048;
            $config['file_name']     = $avatar;
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('avatar')) {
                // Hapus foto sebelumnya jika namanya bukan default.png
                $user = $this->M_Crud->show('tb_user', ['id_user' => $id_user])->row();
                if ($user->avatar != 'default.png') {
                    unlink('./public/template/upload/user/' . $user->avatar);
                }
                $data['avatar'] = $avatar;
            }
        }

        $this->M_Crud->update_data(['id_user' => $id_user], $data, 'tb_user');
        echo json_encode(['success' => true]);
    }

    public function delete($id_user)
    {
        try {
            $result = $this->M_Crud->hapus_data(array('id_user' => $id_user), 'tb_user');
            echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
        } catch (Exception $e) {
            echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
        }
    }
}
