<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('auth');
        $this->load->library('session');
        $this->load->model('M_Crud');
        $this->load->model('M_Datatable');
        $this->load->model('M_Autocomplete');
        $this->auth->cek_login();
    }

    public function cek_keranjang()
    {
        $id_user = $this->session->userdata('id_user');

        $this->db->where('id_user', $id_user);
        $jumlah_barang = $this->db->count_all_results('tb_keranjang');
        echo json_encode(array('jumlah_barang' => $jumlah_barang));
    }

    public function getAnggota()
    {
        $page = $this->input->get('page'); // Ambil nomor halaman dari query string
        $searchTerm = $this->input->get('q'); // Ambil kata kunci pencarian

        // Tentukan jumlah data per halaman
        $perPage = 10;

        // Hitung offset berdasarkan halaman
        $offset = ($page - 1) * $perPage;

        // Mulai membangun query pencarian
        $this->db->select('id_user, nomor_induk, nama_member');
        $this->db->from('tb_user');
        $this->db->where('level', 'User');

        // Jika ada kata kunci pencarian, tambahkan kondisi pencarian
        if (!empty($searchTerm)) {
            $this->db->group_start();
            $this->db->like('nama_member', $searchTerm);
            $this->db->or_like('nomor_induk', $searchTerm);
            $this->db->group_end();
        }

        // Batasi jumlah data yang diambil
        $this->db->limit($perPage, $offset);

        // Eksekusi query
        $query = $this->db->get();
        $anggota = $query->result_array();

        // Kirim data sebagai response JSON
        header('Content-Type: application/json');
        echo json_encode($anggota);
    }

    public function get_bukti_transaksi()
    {
        $id = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tb_keranjang');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_keranjang.id_brg');
        $this->db->where('tb_keranjang.id_user', $id);
        $query = $this->db->get();

        // Mengonversi hasil query menjadi array
        $result = $query->result_array();

        // Mengembalikan data dalam bentuk JSON
        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function load_barang()
    {
        $output = '';
        $keyword = $this->input->post('query');
        $page = $this->input->post('page') ? $this->input->post('page') : 1;
        $limit = 6;
        $limit_start = ($page - 1) * $limit;

        if ($keyword) {
            $total_records = $this->M_Crud->all_data('tb_barang')
                ->like('nama_barang', $keyword)
                ->or_like('barcode', $keyword)
                ->count_all_results();
            $barang = $this->M_Crud->all_data('tb_barang')
                ->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')
                ->like('nama_barang', $keyword)
                ->or_like('barcode', $keyword)
                ->limit($limit, $limit_start)
                ->order_by('id_brg', 'ASC')
                ->get()
                ->result_array();
        } else {
            $total_records = $this->M_Crud->all_data('tb_barang')->count_all_results();
            $barang = $this->M_Crud->all_data('tb_barang')
                ->join('tb_satuan', 'tb_satuan.id_satuan = tb_barang.id_satuan', 'left')
                ->limit($limit, $limit_start)
                ->get()
                ->result_array();
        }

        $output = '<div class="row">';
        foreach ($barang as $key => $value) {
            $gambar = $value['gambar_barang'] == "https://dodolan.jogjakota.go.id/assets/media/default/default-product.png" ? "<img style='\border-radius: 3px;' src='" . $value['gambar_barang'] . "'>" : "<img style='\border-radius: 3px;' src='" . base_url('public/template/upload/barang/' . $value['gambar_barang']) . "'>";
            $output .= '
                <div class="col-6 col-md-4 d-flex" onclick="simpanData(\'' . $value['id_brg'] . '\')">
                    <div class="card w-100 mb-2" style="border: 1px solid #ccc; border-radius: 8px; padding: 10px; overflow: hidden; border-radius:0px !important; cursor:pointer">
                        <div class="justify-content-end text-end">
                            ' . $gambar . '
                        </div>
                        <div class="label">' . $value['stock_brg'] . '</div>
                        <div class="nama-barang" style="margin-top: 5px; font-size:13px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">' . $value['nama_barang'] . '</div>
                        <div class="harga-barang">Rp. ' . number_format($value['harga_jual_barang']) . '</div>
                    </div>
                </div>
            ';
        }
        if (count($barang) < 1) {
            echo "<p>" . "Barang Tidak Ditemukan" . "</p>";
        }

        $output .= '</div>';
        $jumlah_page = ceil($total_records / $limit);
        $jumlah_number = 1;
        $start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1;
        $end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page;

        $output .= '<nav class="mb-1"><ul class="pagination justify-content-end">';

        if ($page == 1) {
            $output .= '<li class="page-item disabled"><a class="page-link" href="javascript::void">First</a></li>';
            $output .= '<li class="page-item disabled"><a class="page-link" href="javascript::void"><span aria-hidden="true">&laquo;</span></a></li>';
        }

        for ($i = $start_number; $i <= $end_number; $i++) {
            $link_active = ($page == $i) ? ' active' : '';
            $output .= '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="javascript::void">' . $i . '</a></li>';
        }

        if ($page == $jumlah_page) {
            $output .= '<li class="page-item disabled"><a class="page-link" href="javascript::void"><span aria-hidden="true">&raquo;</span></a></li>';
            $output .= '<li class="page-item disabled"><a class="page-link" href="javascript::void">Last</a></li>';
        } else {
            $link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
            $output .= '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="javascript::void"><span aria-hidden="true">&raquo;</span></a></li>';
            $output .= '<li class="page-item halaman" id="' . $jumlah_page . '"><a class="page-link" href="javascript::void">Last</a></li>';
        }

        $output .= '</ul></nav>';

        echo $output;
    }

    public function hitungTotal()
	{
		$id = $this->session->userdata('id_user');

		// SQL: hitung subtotal, total harga akhir, dan total diskon dari promo
		$sql = "
		SELECT 
			SUM(tb_barang.harga_jual_barang * tb_keranjang.jumlah) AS subtotal,
			SUM(
				CASE 
					WHEN tb_barang.grosir_brg = 'On' AND tb_keranjang.jumlah BETWEEN tb_barang.rentang_awal AND tb_barang.rentang_akhir 
						THEN tb_barang.harga_grosir * tb_keranjang.jumlah
					WHEN tb_barang.promo_brg = 'On' 
						THEN tb_barang.harga_promo * tb_keranjang.jumlah
					ELSE tb_barang.harga_jual_barang * tb_keranjang.jumlah
				END
			) AS total_harga,
			SUM(
				CASE
					WHEN tb_barang.promo_brg = 'On' 
						THEN (tb_barang.harga_jual_barang - tb_barang.harga_promo) * tb_keranjang.jumlah
					ELSE 0
				END
			) AS total_diskon
		FROM tb_keranjang
		JOIN tb_barang ON tb_barang.id_brg = tb_keranjang.id_brg 
		WHERE tb_keranjang.id_user = ?
		";

		// Eksekusi query
		$query = $this->db->query($sql, array($id));
		$result = $query->row();

		$subtotal = $result->subtotal;
		$totalHarga = $result->total_harga;
		$diskon = $result->total_diskon;

		// Total item
		$total_item = $this->db->select('COUNT(*) as total_item')
			->from('tb_keranjang')
			->where('id_user', $id)
			->get()
			->row()
			->total_item;

		// Output JSON
		echo json_encode(array(
			'total' => number_format($totalHarga),
			'item' => $total_item,
			'subtotal' => number_format($subtotal),
			'diskon' => number_format($diskon)
		));
	}

    public function simpanData()
    {
        $this->load->helper('pesanan');
        $id = $this->session->userdata('id_user');
        $id_pesanan = generate_nomor_pesanan();
        $id_user = $this->input->post('id');
        $id_kasir = $this->input->post('kasir');
        $tgl = $this->input->post('tgl_pesanan') ?? date('Y-m-d\TH:i:s');
        $jenis = $this->input->post('jenis_order');
        $status_pembayaran = $this->input->post('status_pembayaran');
        $status_pesanan = $this->input->post('status_pesanan');
        $metode = $this->input->post('metode');
        $grand_total = $this->input->post('grand_total');
        $total_bayar = $this->input->post('total_bayar');
        $kembalian = $this->input->post('kembalian');
        $note = $this->input->post('note');

        $data = array(
            'id_pesanan' => $id_pesanan,
            'id_user' => $id_user,
            'id_kasir' => $id_kasir,
            'tgl_pesanan' => $tgl,
            'keterangan_pesanan' => $note,
            'tipe_order' => 'OFFLINE',
            'jenis_order' => $jenis,
            'status_pembayaran' => $status_pembayaran,
            'metode_bayar' => $metode,
            'status_pesanan' => $status_pesanan,
            'diskon' => 0,
            'grand_total' => $grand_total,
            'total_bayar' => $total_bayar,
            'kembalian' => $kembalian,
        );
        $this->db->insert('tb_pesanan', $data);
        $this->db->insert('tb_pesanan_tracking', [
            'id_pesanan' => $id_pesanan,
            'status_tracking' => 'Pesanan Selesai',
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $id
        ]);

        $keranjang = $this->M_Crud->all_data('tb_keranjang')->join('tb_barang', 'tb_barang.id_brg = tb_keranjang.id_brg')->where('id_user', $id)->get()->result_array();

        foreach ($keranjang as $item) {
            // Default harga adalah harga jual barang
            $harga = $item['harga_jual_barang'];

            // Cek apakah grosir_brg aktif
            if ($item['grosir_brg'] === 'On') {
                // Ambil rentang jumlah grosir
                $rentang_awal = $item['rentang_awal'];
                $rentang_akhir = $item['rentang_akhir'];

                // Cek apakah jumlah berada di dalam rentang grosir
                if ($item['jumlah'] >= $rentang_awal && $item['jumlah'] <= $rentang_akhir) {
                    $harga = $item['harga_grosir'];
                }
            }

            // Masukkan data pesanan detail
            $data_pesanan_detail = array(
                'id_pesanan' => $id_pesanan,
                'id_brg' => $item['id_brg'],
                'harga_saat_ini' => $harga, // Gunakan harga sesuai logika di atas
                'jumlah_jual' => $item['jumlah']
            );
            $this->M_Crud->input_data($data_pesanan_detail, 'tb_pesanan_detail');
            $this->M_Crud->hapus_data(['id_keranjang' => $item['id_keranjang']], 'tb_keranjang');

            // INPUT RIWAYAT
            $riwayat = [
                'id_brg' => $item['id_brg'],
                'tgl_riwayat_stock' => date('Y-m-d H:i:s'),
                'jumlah_riwayat' => $item['jumlah'],
                'jenis_transaksi' => 'stock_keluar',
                'stock_sebelum' => $item['stock_brg'],
                'stock_sesudah' => $item['stock_brg'] - $item['jumlah'],
                'keterangan_riwayat_stock' => "Pengurangan Melalui Fitur Kasir"
            ];
            $this->M_Crud->input_data($riwayat, "tb_riwayat_stock");

            // KURANGI STOCK
            $stock = $this->M_Crud->show('tb_barang', ['id_brg' => $item['id_brg']])->row_array();
            $this->M_Crud->update_data(['id_brg' => $item['id_brg']], ['stock_brg' => $stock['stock_brg'] - $item['jumlah']], 'tb_barang');
        }

        echo json_encode(array('pesan' => 'Data berhasil disimpan', 'last_insert_id' => $id_pesanan));
    }

    public function index()
    {
        $this->load->helper('pesanan');
        $data['transaction_number'] = generate_nomor_pesanan();

        // Get the session level and check if it's 'Kasir'
        $session_level = $this->session->userdata('level');

        // Default query to fetch all kasir data
        $kasir_query = $this->M_Crud->all_data('tb_kasir');

        if ($session_level == 'Kasir') {
            // If the user is 'Kasir', filter by id_kasir
            $id_kasir = $this->session->userdata('id_user');
            $kasir_query = $kasir_query->where('id_kasir', $id_kasir); // Add WHERE condition
        }

        // Execute the query to fetch kasir data
        $data['kasir'] = $kasir_query->get()->result_array();

        // Fetch all barang data as usual (no filtering needed here)
        $data['barang'] = $this->M_Crud->all_data('tb_barang')->get()->result_array();

        // Load the view with the data
        $this->load->view('level/admin/cashier', $data);
    }


    public function getNamaKasirById($id_kasir)
    {
        $query = $this->db->get_where('tb_kasir', array('id_kasir' => $id_kasir));
        echo $query->row()->nama_kasir;
    }

    public function searchProduct()
    {
        $searchTerm = $this->input->get('term'); // Ambil data yang diketik oleh pengguna

        $results = $this->M_Autocomplete->searchProducts($searchTerm); // Panggil model untuk mencari data
        echo json_encode($results);
    }

    public function keranjang()
    {
        $id = $this->input->post('id');
        $user = $this->session->userdata('id_user');
        $stok = $this->M_Crud->show('tb_barang', ['id_brg' => $id])->row_array();

        // Memeriksa apakah stok cukup untuk menambahkan ke keranjang
        if ($stok['stock_brg'] >= 1) {
            $cek = $this->M_Crud->all_data('tb_keranjang')->where('id_brg', $id)->where('id_user', $user)->get()->row_array();

            if (!empty($cek)) {
                if (($cek['jumlah'] + 1) > $stok['stock_brg']) {
                    $response = array('status' => 'error', 'message' => 'Stok tidak mencukupi');
                } else {
                    $result = $this->M_Crud->update_data(['id_keranjang' => $cek['id_keranjang']], ['jumlah' => $cek['jumlah'] + 1], 'tb_keranjang');

                    $response = array('status' => 'success', 'message' => 'Barang Berhasil Diupdate');
                }
            } else {
                $result = $this->M_Crud->input_data([
                    'id_brg' => $id,
                    'jumlah' => 1,
                    'id_user' => $this->session->userdata('id_user')
                ], 'tb_keranjang');

                $response = array('status' => 'success', 'message' => 'Barang Berhasil Ditambahkan');
            }
        } else {
            // Stok tidak mencukupi, kirim notifikasi ke sisi klien
            $response = array('status' => 'error', 'message' => 'Stok tidak mencukupi');
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function keranjang2()
    {
        $id = $this->input->post('barang');
        $user = $this->session->userdata('id_user');

        // 1. Cari exact match dulu
        $ditemukan = $this->M_Crud->all_data('tb_barang')->where('barcode', $id)->get()->row_array();

        // 2. Jika tidak ketemu, coba hapus leading zero dan cari lagi
        if (!$ditemukan) {
            $id_nozero = ltrim($id, '0');
            $ditemukan = $this->M_Crud->all_data('tb_barang')->where('barcode', $id_nozero)->get()->row_array();
        }

        // 3. Jika masih tidak ketemu, coba pad leading zero sesuai panjang barcode di database
        if (!$ditemukan) {
            $max_length = $this->db->select('MAX(LENGTH(barcode)) as max_len')->get('tb_barang')->row()->max_len;
            $barcode_padded = str_pad($id_nozero, $max_length, '0', STR_PAD_LEFT);
            $ditemukan = $this->M_Crud->all_data('tb_barang')->where('barcode', $barcode_padded)->get()->row_array();
        }

        // 4. Jika masih tidak ketemu, baru pakai like
        if (!$ditemukan) {
            $ditemukan = $this->M_Crud->all_data('tb_barang')
                ->like('barcode', $id)
                ->or_like('nama_barang', $id)
                ->get()->row_array();
        }

        if ($ditemukan) {
            // Cek stok
            if ($ditemukan['stock_brg'] >= 1) {
                $cek = $this->M_Crud->all_data('tb_keranjang')->where('id_brg', $ditemukan['id_brg'])->where('id_user', $user)->get()->row_array();

                if (!empty($cek)) {
                    if (($cek['jumlah'] + 1) > $ditemukan['stock_brg']) {
                        $response = array('status' => 'error', 'message' => 'Stok tidak mencukupi');
                    } else {
                        $result = $this->M_Crud->update_data(['id_keranjang' => $cek['id_keranjang']], ['jumlah' => $cek['jumlah'] + 1], 'tb_keranjang');
                        $response = array('status' => 'success', 'message' => 'Barang Berhasil Diupdate');
                    }
                } else {
                    $result = $this->M_Crud->input_data([
                        'id_brg' => $ditemukan['id_brg'],
                        'jumlah' => 1,
                        'id_user' => $user
                    ], 'tb_keranjang');
                    $response = array('status' => 'success', 'message' => 'Barang Berhasil Ditambahkan');
                }
            } else {
                $response = array('status' => 'error', 'message' => 'Stok tidak mencukupi');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Barang tidak ditemukan');
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function hapus_keranjang()
    {
        $id = $this->session->userdata('id_user');
        $this->M_Crud->all_data('tb_keranjang')->where('id_user', $id)->delete();

        // Setelah penghapusan selesai, berikan respons
        $response = array('status' => 'success', 'message' => 'Data telah dihapus.');
        echo json_encode($response);
    }

    public function json()
    {
        $draw = $this->input->post('draw');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $search = $this->input->post('search')['value'];

        $data = $this->M_Datatable->getDataDetailBarang($length, $start, $search, 'tb_keranjang');
        $total_records = $this->M_Datatable->getTotalData('tb_keranjang');
        $total_filtered = $this->M_Datatable->getFilteredData($search, 'tb_keranjang');

        $nomor_urut = $start + 1;
        $new_data = array();

        foreach ($data as $row) {
            // Ambil detail barang dari tb_barang
            $barang = $this->db->get_where('tb_barang', ['id_brg' => $row->id_brg])->row();

            if ($barang) {
                // Logika untuk menentukan harga
                if ($barang->grosir_brg == "On") {
                    // Cek apakah jumlah berada dalam rentang grosir
                    if ($row->jumlah >= $barang->rentang_awal && $row->jumlah <= $barang->rentang_akhir) {
                        $harga = $barang->harga_grosir;
                    } else {
                        $harga = $barang->harga_jual_barang;
                    }
                } else {
                    // Jika bukan grosir, gunakan harga promo atau harga jual
                    $harga = ($row->promo_brg == "On") ? $row->harga_promo : $barang->harga_jual_barang;
                }
            } else {
                // Jika barang tidak ditemukan, gunakan default harga
                $harga = 0;
            }

            $row->product = '
            <div class="row">
                <div class="col-auto">
                    <span class="avatar rounded" style="cursor: pointer; background-color:#FFBF00; border:1px solid #FFBF00; color:white" id="modal_update" data-id="' . $row->id_keranjang . '">' . $row->jumlah . '</span>
                </div>
                <div class="col">
                    <div class="font-weight-medium"><b>' . $row->nama_barang . '</b></div>
                    <div class="text-secondary">Rp. ' . number_format($harga) . ' | Rp. ' . number_format($harga * $row->jumlah) . '</div>
                </div>
            </div>
        ';
            $row->action = '
            <a href="javascript:void(0);" onclick="hapusItem(' . $row->id_keranjang . ');">
                <i class="fa fa-times"></i>
            </a>
        ';
            $new_data[] = $row;
            $nomor_urut++;
        }

        $data = $new_data;

        $response = [
            'draw' => $draw,
            'recordsTotal' => $total_records,
            'recordsFiltered' => $total_filtered,
            'data' => $data,
        ];

        echo json_encode($response);
    }

    public function hapus_list($id_keranjang)
    {
        $this->M_Crud->hapus_data(['id_keranjang' => $id_keranjang], 'tb_keranjang');

        // Kirim respons ke permintaan AJAX
        $response = array('success' => true);
        echo json_encode($response);
    }

    public function update_list($id_keranjang)
    {
        $jumlah = $this->input->post('jumlah');
        $krjg = $this->M_Crud->show('tb_keranjang', ['id_keranjang' => $id_keranjang])->row_array();
        $brg = $this->M_Crud->show('tb_barang', ['id_brg' => $krjg['id_brg']])->row_array();

        // Memeriksa apakah stok mencukupi
        if ($jumlah <= $brg['stock_brg']) {
            // Jika stok mencukupi, lakukan pembaruan
            $this->M_Crud->update_data(['id_keranjang' => $id_keranjang], ['jumlah' => $jumlah], 'tb_keranjang');

            // Kirim respons ke permintaan AJAX
            $response = array('status' => 'success', 'message' => 'Update Berhasil');
        } else {
            // Jika stok tidak mencukupi, kirim pesan kesalahan ke sisi klien
            $response = array('status' => 'error', 'message' => 'Stok tidak mencukupi');
        }

        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }


    public function getData()
    {
        $id = $this->input->post('id');
        $data = $this->M_Crud->all_data('tb_keranjang')->join('tb_barang', 'tb_barang.id_brg = tb_keranjang.id_brg')->where('id_keranjang', $id)->get()->row_array();

        // Mengubah data menjadi format JSON
        $json_data = json_encode($data);

        // Mengatur header respons sebagai JSON
        $this->output
            ->set_content_type('application/json')
            ->set_output($json_data);
    }

    public function hapus_semua() {}
}
