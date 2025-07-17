<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class Laporan extends CI_Controller
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

    // 20240622 10:23 AM
    public function inventory()
    {
        $this->load->view('report/inventori');
    }

    public function inventory_proses()
    {
        // Ambil bulan dan tahun dari input
        $bulan = $this->input->get('bulan', TRUE);
        $tahun = $this->input->get('tahun', TRUE);

        // Pastikan bulan dan tahun tidak kosong, jika kosong beri nilai default
        if (empty($bulan)) {
            $bulan = date('m'); // Bulan sekarang
        }
        if (empty($tahun)) {
            $tahun = date('Y'); // Tahun sekarang
        }

        // Konversi bulan dan tahun menjadi format field yang diinginkan
        $bulanTahun = strtolower(date('F_Y', mktime(0, 0, 0, $bulan, 1, $tahun)));

        // Buat nama kolom untuk stock_awal dan stock_akhir
        $stockAwalField = "stock_awal_$bulanTahun";
        $stockAkhirField = "stock_akhir_$bulanTahun";

        // Cek keberadaan kolom di dalam tabel
        $fields = $this->db->list_fields('stock_list');
        $stockAwalExists = in_array($stockAwalField, $fields);
        $stockAkhirExists = in_array($stockAkhirField, $fields);
        $check = false;

        // Query untuk mengambil data inventori
        $this->db->select("b.id_brg, b.nama_barang, b.barcode");

        // Hanya pilih kolom jika mereka ada
        if ($stockAwalExists) {
            $check = true;
            $this->db->select("s.$stockAwalField", FALSE);
        }
        if ($stockAkhirExists) {
            $check = true;
            $this->db->select("s.$stockAkhirField", FALSE);
        }

        $this->db->select("COALESCE((
        SELECT SUM(pd.jumlah_pesan)
        FROM tb_pemesanan_detail pd
        JOIN tb_pemesanan p ON pd.id_pemesanan = p.id_pemesanan
        WHERE pd.id_brg = b.id_brg
        AND p.status_pemesanan = 'received'
        AND MONTH(p.tgl_pesan) = $bulan
        AND YEAR(p.tgl_pesan) = $tahun
    ), 0) as pembelian_bulan_ini", FALSE);
        $this->db->select("COALESCE((
        SELECT SUM(pd.jumlah_jual)
        FROM tb_pesanan_detail pd
        JOIN tb_pesanan p ON pd.id_pesanan = p.id_pesanan
        WHERE pd.id_brg = b.id_brg
        AND p.status_pesanan = 'Selesai'
        AND MONTH(p.tgl_pesanan) = $bulan
        AND YEAR(p.tgl_pesanan) = $tahun
    ), 0) as penjualan_bulan_ini", FALSE);

        $this->db->from('stock_list s');
        $this->db->join('tb_barang b', 'b.id_brg = s.id_brg', 'left');
        // $this->db->LIMIT(100);

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $data = [
                'inventori' => [],
                'bulan' => $bulan,
                'tahun' => $tahun,
                'no_data' => true,
                'check' => $check,
                'message' => "Tidak ada data tersedia untuk bulan $bulan tahun $tahun"
            ];
        } else {
            $inventori = $query->result();
            foreach ($inventori as $item) {
                // Set nilai default '-' jika kolom tidak ada atau nilainya NULL
                if (!$stockAwalExists || !isset($item->$stockAwalField) || $item->$stockAwalField === NULL) {
                    $item->$stockAwalField = '-';
                }
                if (!$stockAkhirExists || !isset($item->$stockAkhirField) || $item->$stockAkhirField === NULL) {
                    $item->$stockAkhirField = '-';
                }

                // Hitung total_stok_setelah_pembelian
                $item->total_stok_setelah_pembelian = ($item->$stockAwalField !== '-' ? (int)$item->$stockAwalField : 0) + $item->pembelian_bulan_ini;
            }
            $data = [
                'inventori' => $inventori,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'no_data' => false,
                'check' => $check,
                'stockAwalField' => $stockAwalField,
                'stockAkhirField' => $stockAkhirField
            ];
        }

        // Load view atau ekspor ke Excel/PDF berdasarkan permintaan
        $exportFormat = $this->input->get('export', TRUE);
        if ($exportFormat == 'excel') {
            $this->export_to_excel($data);
        } elseif ($exportFormat == 'pdf') {
            $this->export_to_pdf($data);
        } else {
            // Jika format tidak dipilih atau tidak valid, bisa menampilkan pesan error
            show_error('Format ekspor tidak valid atau tidak dipilih.');
        }
    }

    private function export_to_excel($data)
    {
        // Load PHPSpreadsheet library
        require 'vendor/autoload.php';
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan header Bulan dan Tahun yang dipilih pengguna
        $sheet->setCellValue('A1', 'Bulan dan Tahun');
        $sheet->setCellValue('B1', $data['bulan'] . '-' . $data['tahun']);

        // Menambahkan header kolom sesuai urutan yang diminta
        $headers = ['No', 'Nama Barang', 'Barcode', 'Stock Awal', 'Pembelian Bulan Ini', 'Total Stock Setelah Pembelian', 'Penjualan Bulan Ini', 'Total Spoil', 'Stock Akhir'];
        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];

        foreach ($headers as $index => $header) {
            $sheet->setCellValue("{$columns[$index]}3", $header);
        }

        // Mengatur header menjadi bold
        $sheet->getStyle('A3:I3')->getFont()->setBold(true);

        // Check jika ada data inventori atau tidak
        if (!$data['check']) {
            $sheet->mergeCells('A4:I4');
            // Tampilkan pesan jika tidak ada data
            $sheet->setCellValue('A4', 'Tidak ada data tersedia untuk bulan ' . $data['bulan'] . ' tahun ' . $data['tahun']);

            // Mengatur border untuk pesan jika tidak ada data
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ];

            $sheet->getStyle('A3:H4')->applyFromArray($styleArray);
            $sheet->getStyle('A4:H4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

            foreach ($columns as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }
        } else {
            // Mengisi data jika ada inventori
            $row = 4;
            $no = 1;
            foreach ($data['inventori'] as $item) {
                $totalSpoil = $this->db->select_sum('jumlah_rusak', 'total_spoil')
                    ->from('tb_opname_rusak')
                    ->join('tb_opname', 'tb_opname.id_opname = tb_opname_rusak.id_opname', 'left')
                    ->where('id_brg', $item->id_brg)
                    ->where('status_opname', "1")
                    ->where('MONTH(tgl_opname)', $data['bulan']) // Filter berdasarkan bulan
                    ->where('YEAR(tgl_opname)', $data['tahun']) // Filter berdasarkan tahun
                    ->get()
                    ->row();
                $totalSpoil = $totalSpoil->total_spoil ?? 0;

                $sheet->setCellValue("A{$row}", $no);
                $sheet->setCellValue("B{$row}", $item->nama_barang);
                $sheet->setCellValueExplicit("C{$row}", $item->barcode, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValue("D{$row}", $item->{$data['stockAwalField']});
                $sheet->setCellValue("E{$row}", $item->pembelian_bulan_ini);
                $sheet->setCellValue("F{$row}", $item->total_stok_setelah_pembelian);
                $sheet->setCellValue("G{$row}", $item->penjualan_bulan_ini);
                $sheet->setCellValue("H{$row}", $totalSpoil);

                // Menghitung stock akhir jika belum ada atau -
                if ($item->{$data['stockAkhirField']} === '-' || $item->{$data['stockAkhirField']} === null) {
                    $stockAkhir = $item->total_stok_setelah_pembelian - $item->penjualan_bulan_ini - $totalSpoil;
                    $sheet->setCellValue("I{$row}", $stockAkhir);
                } else {
                    $sheet->setCellValue("I{$row}", $item->{$data['stockAkhirField']});
                }

                $row++;
                $no++;
            }

            // Mengatur autoSize untuk setiap kolom
            foreach ($columns as $column) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }

            // Menambahkan border untuk data
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ];

            $sheet->getStyle('A3:I' . ($row - 1))->applyFromArray($styleArray);
        }

        // Mengunduh file Excel
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'Laporan_Inventory_' . date('YmdHis') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }


    private function export_to_pdf($data)
    {
        // Load library MPDF dengan pengaturan landscape
        $mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

        // Ambil view
        $html = $this->load->view('report/inventori_view', $data, TRUE);

        // Menyimpan dan mengunduh file PDF
        $mpdf->WriteHTML($html);
        $filename = 'Laporan_Inventory_' . date('YmdHis') . '.pdf';
        $mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
    }

    public function data_barang()
    {
        // Ambil data dari database
        $searchTerm = $this->input->post('search');
        $limit = $this->input->post('limit') ?? 20; // Ambil limit dari request atau default 20

        $this->db->select('id_brg, nama_barang');
        $this->db->from('tb_barang');
        if (!empty($searchTerm)) {
            $this->db->like('nama_barang', $searchTerm);
        }
        $this->db->limit($limit);
        $query = $this->db->get();
        $data = $query->result_array();

        // Format data menjadi format JSON
        echo json_encode($data);
    }

    // REPORT 1 ------------------------------------------------------------------------
    public function pembelian_periode()
    {
        $data['supplier'] = $this->M_Crud->all_data('tb_supplier')->get()->result_array();
        $this->load->view('report/pembelian_periode', $data);
    }

    public function pembelian_periode_json()
    {
        $start = $this->input->post('start_date');
        $end = $this->input->post('end_date');
        $supplier = $this->input->post('supplier');

        $columns = '*';
        $filter = array('nama_supplier', 'kontak_supplier');
        $joins = array(
            array(
                'table' => 'tb_supplier',
                'condition' => 'tb_supplier.id_supplier = tb_pemesanan.id_supplier',
                'type' => 'inner'
            ),
        );

        $where = null;
        if ($start || $end || $supplier) {
            $where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

            if ($start) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_diterima) >= '" . $start . "'";
            }

            if ($end) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_diterima) <= '" . $end . "'";
            }

            if ($supplier) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND tb_pemesanan.id_supplier = '" . $supplier . "'";
            }
        }

        $searchInput = $this->input->post('search');
		$searchValue = isset($searchInput['value']) ? $searchInput['value'] : null;

		$list = $this->Datatable_model->get_data(
			'tb_pemesanan',
			$columns,
			$joins,
			$filter,
			$searchValue,
			$where,
			$this->input->post('start'),
			$this->input->post('length')
		);


        $data = array();
        $no = 0;
        $total_harga_semua = 0;
        $total_harga_semua_belum_lunas = 0;
        foreach ($list->result() as $pemesanan) {
            $jumlah = $this->db->from('tb_pemesanan_detail')->where('id_pemesanan', $pemesanan->id_pemesanan)->count_all_results();

            // Menghitung total harga untuk semua status pembayaran
            $query_semua = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                ->where('id_pemesanan', $pemesanan->id_pemesanan)
                ->get('tb_pemesanan_detail');
            $total_harga = $query_semua->row()->total_harga ?? 0;
            $total_harga_semua += $total_harga;

            // Menghitung total harga untuk status pembayaran "Belum Lunas"
            $query_belum_lunas = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                ->join("tb_pemesanan", 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan')
                ->where('tb_pemesanan_detail.id_pemesanan', $pemesanan->id_pemesanan)
                ->where('status_pembayaran', 'Belum Lunas')
                ->get('tb_pemesanan_detail');
            $total_harga_belum_lunas = $query_belum_lunas->row()->total_harga ?? 0;
            $total_harga_semua_belum_lunas += $total_harga_belum_lunas;

            $no++;
            $row = array(
                $no,
                date('d/M/Y', strtotime($pemesanan->tgl_pesan)),
                date('d/M/Y', strtotime($pemesanan->tgl_diterima)),
                $pemesanan->nama_supplier,
                $jumlah,
                "Rp. " . number_format($total_harga),
                $pemesanan->status_pembayaran == "Lunas" ? "Rp. " . number_format($total_harga) : "Rp. " . number_format(0),
            );
            $data[] = $row;
        }

        $output = array(
            "totalHargaSemua" => "Rp. " . number_format($total_harga_semua),
            "totalHargaSemuaBelumLunas" => "Rp. " .  number_format($total_harga_semua_belum_lunas),
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable_model->count_all('tb_pemesanan'),
            "recordsFiltered" => $this->Datatable_model->count_filtered('tb_pemesanan', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function pembelian_periode_pdf()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $supplier = $this->input->post('supplier');

        // Proses pembuatan laporan PDF
        $mpdf = new Mpdf();
        $mpdf->AddPage('L');

        // Masukkan data ke dalam array untuk dikirim ke view
        $data['start'] = $startDate;
        $data['end'] = $endDate;
        $data['supplier'] = $supplier;

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pemesanan');
        $this->db->join('tb_supplier', 'tb_supplier.id_supplier = tb_pemesanan.id_supplier');

        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_diterima BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_diterima >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_diterima <=", $endDate);
        }

        // Tambahkan filter berdasarkan supplier
        if (!empty($supplier)) {
            $this->db->where('tb_pemesanan.id_supplier', $supplier);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $data['pembelian'] = $this->db->get()->result_array();

        // Load view untuk konten PDF
        $html = $this->load->view('report/pdf_pembelian_periode', $data, true);

        // Set konten PDF
        $mpdf->WriteHTML($html);

        // Outputkan PDF ke browser
        $mpdf->Output('omset_pembelian.pdf', 'D');
    }

    public function pembelian_periode_excel()
    {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $supplier = $this->input->post('supplier');

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pemesanan');
        $this->db->join('tb_supplier', 'tb_supplier.id_supplier = tb_pemesanan.id_supplier');

        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($start) && !empty($end)) {
            $this->db->where("tgl_diterima >= '$start' AND tgl_diterima <= '$end'");
        } else if (!empty($start)) {
            $this->db->where("tgl_diterima >=", $start);
        } else if (!empty($end)) {
            $this->db->where("tgl_diterima <=", $end);
        }

        // Tambahkan filter berdasarkan supplier
        if (!empty($supplier)) {
            $this->db->where('tb_pemesanan.id_supplier', $supplier);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $pembelian = $this->db->get()->result_array();

        // Inisialisasi objek PHPExcel
        $spreadsheet = new Spreadsheet();

        // Set properties dokumen
        $spreadsheet->getProperties()->setCreator("Your Name")
            ->setLastModifiedBy("Your Name")
            ->setTitle("Periode Report")
            ->setSubject("Periode Report")
            ->setDescription("Periode Report")
            ->setKeywords("periode report")
            ->setCategory("Report");

        // Mulai menulis data ke dalam file Excel
        // Set nilai sel-sel pada header
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Periode:');
        $spreadsheet->getActiveSheet()->setCellValue('B1', !empty($start) ? date('d/F/Y', strtotime($start)) : '');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 's/d');
        $spreadsheet->getActiveSheet()->setCellValue('D1', !empty($end) ? date('d/F/Y', strtotime($end)) : '');
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'No');
        $spreadsheet->getActiveSheet()->setCellValue('B3', 'Tanggal Pesan');
        $spreadsheet->getActiveSheet()->setCellValue('C3', 'Tanggal Terima');
        $spreadsheet->getActiveSheet()->setCellValue('D3', 'Supplier');
        $spreadsheet->getActiveSheet()->setCellValue('E3', 'Jumlah');
        $spreadsheet->getActiveSheet()->setCellValue('F3', 'Total Harga');
        $spreadsheet->getActiveSheet()->setCellValue('G3', 'Dibayarkan');

        // Menerapkan border pada header
        $spreadsheet->getActiveSheet()->getStyle('A3:G3')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Menambahkan data dari array $pembelian
        $row = 4;
        $total_harga_semua = 0;
        $total_harga_semua_belum_lunas = 0;
        foreach ($pembelian as $key => $pembelian) {
            // Query untuk menghitung jumlah item pemesanan
            $jumlah = $this->db->from('tb_pemesanan_detail')->where('id_pemesanan', $pembelian['id_pemesanan'])->count_all_results();

            // Menghitung total harga untuk semua status pembayaran
            $query_semua = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                ->where('id_pemesanan', $pembelian['id_pemesanan'])
                ->get('tb_pemesanan_detail');
            $total_harga = $query_semua->row()->total_harga ?? 0;
            $total_harga_semua += $total_harga;

            // Menghitung total harga untuk status pembayaran "Belum Lunas"
            $query_belum_lunas = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                ->join("tb_pemesanan", 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan')
                ->where('tb_pemesanan_detail.id_pemesanan', $pembelian['id_pemesanan'])
                ->where('status_pembayaran', 'Belum Lunas')
                ->get('tb_pemesanan_detail');
            $total_harga_belum_lunas = $query_belum_lunas->row()->total_harga ?? 0;
            $total_harga_semua_belum_lunas += $total_harga_belum_lunas;

            // Set nilai sel-sel pada kolom A-G
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $key + 1);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, date('d/F/Y', strtotime($pembelian['tgl_pesan'])));
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, date('d/F/Y', strtotime($pembelian['tgl_diterima'])));
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $pembelian['nama_supplier']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $jumlah);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $total_harga);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $pembelian['status_pembayaran'] == "Lunas" ? $total_harga : 0);

            // Tambahkan border di sekitar sel-sel
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ];
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':G' . $row)->applyFromArray($styleArray);

            $row++;
        }

        // Menambahkan total pembelian dan total hutang di baris terakhir
        $spreadsheet->getActiveSheet()->setCellValue('A' . $row, 'Total Biaya Pembelian');
        $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $total_harga_semua);
        $spreadsheet->getActiveSheet()->setCellValue('A' . ($row + 1), 'Total Hutang');
        $spreadsheet->getActiveSheet()->setCellValue('F' . ($row + 1), $total_harga_semua_belum_lunas);
        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':G' . ($row + 1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Set lebar kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        // Sesuaikan dengan kolom yang lain

        // Set judul dan ekstensi file
        $filename = 'periode_report.xlsx';

        // Set header untuk tipe konten dan nama file
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Buat writer untuk XLSX dan simpan output ke standar output
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    // END REPORT 1 -----------------------------------------------------------------------

    // REPORT 2 ---------------------------------------------------------------------------
    public function pembelian_supplier()
    {
        $data['supplier'] = $this->M_Crud->all_data('tb_supplier')->get()->result_array();
        $this->load->view('report/pembelian_supplier', $data);
    }

    public function pembelian_supplier_json()
    {
        $start = $this->input->post('start_date');
        $end = $this->input->post('end_date');
        $supplier = $this->input->post('supplier');

        $columns = '*';
        $filter = array('nama_barang', 'barcode');
        $joins = array(
            array(
                'table' => 'tb_pemesanan',
                'condition' => 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan',
                'type' => 'inner'
            ),
            array(
                'table' => 'tb_barang',
                'condition' => 'tb_barang.id_brg = tb_pemesanan_detail.id_brg',
                'type' => 'inner'
            ),
        );

        $where = null;
        if ($start || $end || $supplier) {
            $where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

            if ($start) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_diterima) >= '" . $start . "'";
            }

            if ($end) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_diterima) <= '" . $end . "'";
            }

            if ($supplier) {
                $where .= " AND tb_pemesanan.id_supplier = '" . $supplier . "'";
            }
        }

        $list = $this->Datatable_model->get_data('tb_pemesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

        $data = array();
        $no = 0;
        $total_harga_semua = 0;
        $total_harga_semua_belum_lunas = 0;
        foreach ($list->result() as $barang) {
            // Menghitung total harga untuk semua status pembayaran
            $query_semua = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                ->where('tb_pemesanan_detail.id_brg', $barang->id_brg)
                ->get('tb_pemesanan_detail');
            $total_harga = $query_semua->row()->total_harga ?? 0;
            $total_harga_semua += $total_harga;

            // Menghitung total harga untuk status pembayaran "Belum Lunas"
            $query_belum_lunas = $this->db->select('SUM(harga_pesan * jumlah_pesan) as total_harga')
                ->join("tb_pemesanan", 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan')
                ->where('tb_pemesanan_detail.id_brg', $barang->id_brg)
                ->where('status_pembayaran', 'Belum Lunas')
                ->get('tb_pemesanan_detail');
            $total_harga_belum_lunas = $query_belum_lunas->row()->total_harga ?? 0;
            $total_harga_semua_belum_lunas += $total_harga_belum_lunas;

            $no++;
            $row = array(
                $no,
                $barang->id_pemesanan,
                date('d/M/Y', strtotime($barang->tgl_diterima)),
                $barang->nama_barang,
                $barang->barcode,
                $barang->jumlah_pesan,
                $barang->harga_pesan,
                $barang->jumlah_pesan * $barang->harga_pesan,
            );
            $data[] = $row;
        }

        $output = array(
            "totalHargaSemua" => "Rp. " . number_format($total_harga_semua),
            "totalHargaSemuaBelumLunas" => "Rp. " .  number_format($total_harga_semua_belum_lunas),
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable_model->count_all('tb_pemesanan_detail', $where),
            "recordsFiltered" => $this->Datatable_model->count_filtered('tb_pemesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function pembelian_supplier_pdf()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $supplier = $this->input->post('supplier');

        // Proses pembuatan laporan PDF
        $mpdf = new Mpdf();
        $mpdf->AddPage('L');

        // Masukkan data ke dalam array untuk dikirim ke view
        $data['start'] = $startDate;
        $data['end'] = $endDate;
        $data['supplier'] = $supplier;

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pemesanan_detail');
        $this->db->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pemesanan_detail.id_brg');

        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_diterima BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_diterima >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_diterima <=", $endDate);
        }

        // Tambahkan filter berdasarkan supplier
        if (!empty($supplier)) {
            $this->db->where('tb_pemesanan.id_supplier', $supplier);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $data['pembelian'] = $this->db->get()->result_array();

        // Load view untuk konten PDF
        $html = $this->load->view('report/pdf_pembelian_supplier', $data, true);

        // Set konten PDF
        $mpdf->WriteHTML($html);

        // Outputkan PDF ke browser
        $mpdf->Output('pembelian_by_supplier.pdf', 'D');
    }

    public function pembelian_supplier_excel()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $supplier = $this->input->post('supplier');

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pemesanan_detail');
        $this->db->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pemesanan_detail.id_brg');

        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_diterima BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_diterima >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_diterima <=", $endDate);
        }

        // Tambahkan filter berdasarkan supplier
        if (!empty($supplier)) {
            $this->db->where('tb_pemesanan.id_supplier', $supplier);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $pembelian = $this->db->get()->result_array();

        // Hitung total harga semua dan total hutang
        $total_harga_semua = 0;
        $total_harga_semua_belum_lunas = 0;
        foreach ($pembelian as $barang) {
            $total_harga_semua += $barang['jumlah_pesan'] * $barang['harga_pesan'];
            if ($barang['status_pembayaran'] == 'Belum Lunas') {
                $total_harga_semua_belum_lunas += $barang['jumlah_pesan'] * $barang['harga_pesan'];
            }
        }

        // Inisialisasi objek PhpSpreadsheet
        $spreadsheet = new Spreadsheet();

        // Set properties dokumen
        $spreadsheet->getProperties()->setCreator("Your Name")
            ->setLastModifiedBy("Your Name")
            ->setTitle("Pembelian by Supplier Report")
            ->setSubject("Pembelian by Supplier Report")
            ->setDescription("Pembelian by Supplier Report")
            ->setKeywords("pembelian by supplier report")
            ->setCategory("Report");

        // Mulai menulis data ke dalam file Excel
        // Set nilai sel-sel pada header
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Periode:');
        $spreadsheet->getActiveSheet()->setCellValue('B1', !empty($startDate) ? date('d/F/Y', strtotime($startDate)) : '');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 's/d');
        $spreadsheet->getActiveSheet()->setCellValue('D1', !empty($endDate) ? date('d/F/Y', strtotime($endDate)) : '');
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'No');
        $spreadsheet->getActiveSheet()->setCellValue('B3', 'ID Transaksi');
        $spreadsheet->getActiveSheet()->setCellValue('C3', 'Tanggal Terima');
        $spreadsheet->getActiveSheet()->setCellValue('D3', 'Nama Barang');
        $spreadsheet->getActiveSheet()->setCellValue('E3', 'Barcode');
        $spreadsheet->getActiveSheet()->setCellValue('F3', 'QTY');
        $spreadsheet->getActiveSheet()->setCellValue('G3', 'Harga');
        $spreadsheet->getActiveSheet()->setCellValue('H3', 'Sub Total');

        // Menerapkan border pada header
        $spreadsheet->getActiveSheet()->getStyle('A3:H3')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Menambahkan data dari array $pembelian
        $row = 4;
        foreach ($pembelian as $key => $barang) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $key + 1);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $barang['id_pemesanan']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, date('d/M/Y', strtotime($barang['tgl_diterima'])));
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $barang['nama_barang']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $barang['barcode']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $barang['jumlah_pesan']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $barang['harga_pesan']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $barang['jumlah_pesan'] * $barang['harga_pesan']);

            // Tambahkan border di sekitar sel-sel
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':H' . $row)->applyFromArray($styleArray);

            $row++;
        }

        // Menambahkan total pembelian dan total hutang di baris terakhir
        $spreadsheet->getActiveSheet()->setCellValue('A' . $row, 'Total Biaya Pembelian');
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $total_harga_semua);
        $spreadsheet->getActiveSheet()->setCellValue('A' . ($row + 1), 'Total Hutang');
        $spreadsheet->getActiveSheet()->setCellValue('H' . ($row + 1), $total_harga_semua_belum_lunas);
        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':H' . ($row + 1))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Set lebar kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        // Sesuaikan dengan kolom yang lain

        // Set judul dan ekstensi file
        $filename = 'pembelian_supplier_report.xlsx';

        // Set header untuk tipe konten dan nama file
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Buat writer untuk XLSX dan simpan output ke standar output
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    // END REPORT 2 ------------------------------------------------------------------------

    // REPORT 3 ------------------------------------------------------------------------
    public function pembelian_barang()
    {
        $data = [];
        $this->load->view('report/pembelian_barang', $data);
    }

    public function pembelian_barang_json()
    {
        $start = $this->input->post('start_date');
        $end = $this->input->post('end_date');
        $barang = $this->input->post('barang');

        $columns = '*';
        $filter = array('nama_supplier', 'kontak_supplier', 'nama_barang', 'barcode');
        $joins = array(
            array(
                'table' => 'tb_pemesanan',
                'condition' => 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan',
                'type' => 'inner'
            ),
            array(
                'table' => 'tb_supplier',
                'condition' => 'tb_supplier.id_supplier = tb_pemesanan.id_supplier',
                'type' => 'inner'
            ),
            array(
                'table' => 'tb_barang',
                'condition' => 'tb_barang.id_brg = tb_pemesanan_detail.id_brg',
                'type' => 'inner'
            ),
        );

        $where = null;
        if ($start || $end || $barang) {
            $where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

            if ($start) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_diterima) >= '" . $start . "'";
            }

            if ($end) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_diterima) <= '" . $end . "'";
            }

            if ($barang) {
                $where .= " AND tb_pemesanan_detail.id_brg = '" . $barang . "'";
            }
        }

        $list = $this->Datatable_model->get_data('tb_pemesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'), ['tb_pemesanan.tgl_diterima', 'DESC']);

		$total_harga_semua = 0;
		$total_harga_semua_belum_lunas = 0;
		$data = [];
		$no = 0;
		
		foreach ($list->result() as $barang) {
			$no++;
			$subtotal = $barang->jumlah_pesan * $barang->harga_pesan;
			$total_harga_semua += $subtotal;
		
			// Misal kamu punya status pembayaran di $barang->status_pembayaran
			if ($barang->status_pembayaran == 'belum lunas') {
				$total_harga_semua_belum_lunas += $subtotal;
			}
		
			$row = array(
				$no,
				$barang->id_pemesanan,
				date('d/M/Y', strtotime($barang->tgl_diterima)),
				$barang->nama_supplier,
				$barang->nama_barang,
				$barang->barcode,
				$barang->jumlah_pesan,
				$barang->harga_pesan,
				$subtotal
			);
			$data[] = $row;
		}		

        $output = array(
            "totalHargaSemua" => "Rp. " . number_format($total_harga_semua),
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable_model->count_all('tb_pemesanan_detail'),
            "recordsFiltered" => $this->Datatable_model->count_filtered('tb_pemesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function pembelian_barang_pdf()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $barang = $this->input->post('barang');

        // Proses pembuatan laporan PDF
        $mpdf = new Mpdf();
        $mpdf->AddPage('L');

        // Masukkan data ke dalam array untuk dikirim ke view
        $data['start'] = $startDate;
        $data['end'] = $endDate;
        $data['barang'] = $barang;

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pemesanan_detail');
        $this->db->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pemesanan_detail.id_brg');

        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_diterima BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_diterima >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_diterima <=", $endDate);
        }

        // Tambahkan filter berdasarkan supplier
        if (!empty($barang)) {
            $this->db->where('tb_pemesanan_detail.id_brg', $barang);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $data['pembelian'] = $this->db->get()->result_array();

        // Load view untuk konten PDF
        $html = $this->load->view('report/pdf_pembelian_supplier', $data, true);

        // Set konten PDF
        $mpdf->WriteHTML($html);

        // Outputkan PDF ke browser
        $mpdf->Output('pembelian_by_supplier.pdf', 'D');
    }

    public function pembelian_barang_excel()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $barang = $this->input->post('barang');

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pemesanan_detail');
        $this->db->join('tb_pemesanan', 'tb_pemesanan.id_pemesanan = tb_pemesanan_detail.id_pemesanan');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pemesanan_detail.id_brg');

        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_diterima BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_diterima >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_diterima <=", $endDate);
        }

        // Tambahkan filter berdasarkan barang
        if (!empty($barang)) {
            $this->db->where('tb_pemesanan_detail.id_brg', $barang);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $pembelian = $this->db->get()->result_array();

        // Inisialisasi objek Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Set properties dokumen
        $spreadsheet->getProperties()->setCreator("Your Name")
            ->setLastModifiedBy("Your Name")
            ->setTitle("Pembelian by Barang Report")
            ->setSubject("Pembelian by Barang Report")
            ->setDescription("Pembelian by Barang Report")
            ->setKeywords("pembelian by barang report")
            ->setCategory("Report");

        // Mulai menulis data ke dalam file Excel
        // Set nilai sel-sel pada header
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Periode:');
        $spreadsheet->getActiveSheet()->setCellValue('B1', !empty($startDate) ? date('d/F/Y', strtotime($startDate)) : '');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 's/d');
        $spreadsheet->getActiveSheet()->setCellValue('D1', !empty($endDate) ? date('d/F/Y', strtotime($endDate)) : '');

        // Set style untuk periode
        $styleArray = [
            'font' => [
                'bold' => true,
            ],
        ];

        $spreadsheet->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);

        // Set nilai sel-sel pada header data
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'No');
        $spreadsheet->getActiveSheet()->setCellValue('B2', 'ID Transaksi');
        $spreadsheet->getActiveSheet()->setCellValue('C2', 'Tanggal Terima');
        $spreadsheet->getActiveSheet()->setCellValue('D2', 'Nama Barang');
        $spreadsheet->getActiveSheet()->setCellValue('E2', 'Barcode');
        $spreadsheet->getActiveSheet()->setCellValue('F2', 'QTY');
        $spreadsheet->getActiveSheet()->setCellValue('G2', 'Harga');
        $spreadsheet->getActiveSheet()->setCellValue('H2', 'Sub Total');

        // Menerapkan border pada header
        $spreadsheet->getActiveSheet()->getStyle('A2:H2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Menambahkan data dari array $pembelian
        $row = 3;
        $totalHargaSemua = 0;
        foreach ($pembelian as $key => $barang) {
            $subTotal = $barang['jumlah_pesan'] * $barang['harga_pesan'];
            $totalHargaSemua += $subTotal;

            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $key + 1);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $barang['id_pemesanan']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, date('d/M/Y', strtotime($barang['tgl_diterima'])));
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $barang['nama_barang']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $barang['barcode']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $barang['jumlah_pesan']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $barang['harga_pesan']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $subTotal);

            // Menambahkan border di sekitar sel-sel
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':H' . $row)->applyFromArray($styleArray);

            $row++;
        }

        // Tulis total harga di bagian akhir tabel
        $spreadsheet->getActiveSheet()->setCellValue('G' . $row, 'Total Biaya Pembelian');
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $totalHargaSemua);

        // Tambahkan border di sekitar sel total harga
        $spreadsheet->getActiveSheet()->getStyle('G' . $row . ':H' . $row)->applyFromArray($styleArray);

        // Set lebar kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        // Sesuaikan dengan kolom yang lain

        // Set judul dan ekstensi file
        $filename = 'pembelian_barang_report.xlsx';

        // Set header untuk tipe konten dan nama file
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Buat writer untuk XLSX dan simpan output ke standar output
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    // END REPORT 3 ------------------------------------------------------------------------

    // REPORT 4 ------------------------------------------------------------------------
    public function penjualan_periode()
    {
        $data = [];
        $this->load->view('report/penjualan_periode', $data);
    }

    public function penjualan_periode_json()
    {
        $start = $this->input->post('start_date');
        $end = $this->input->post('end_date');
        $status = $this->input->post('status');

        $columns = '*';
        $filter = array('nama_member', 'id_pesanan', 'metode_bayar', 'status_pembayaran', 'nomor_induk');
        $joins = array(
            array(
                'table' => 'tb_user',
                'condition' => 'tb_user.id_user = tb_pesanan.id_user',
                'type' => 'left'
            ),
        );

        $where = null;
        if ($start || $end || $status) {
            $where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

            if ($start) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_pesanan) >= '" . $start . "'";
            }

            if ($end) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_pesanan) <= '" . $end . "'";
            }

            if ($status) {
                $where .= " AND status_pembayaran = '" . $status . "'";
            }
        }

        $list = $this->Datatable_model->get_data('tb_pesanan', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

        $data = array();
        $total_harga_semua = 0;
        $total_harga_semua_belum_lunas = 0;
        $no = $_POST['start'];
        foreach ($list->result() as $pesanan) {
            // Menghitung total harga untuk semua status pembayaran
            $query_semua = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')
                ->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan')
                ->where('tb_pesanan.id_pesanan', $pesanan->id_pesanan)
                ->get('tb_pesanan_detail');
            $total_harga = $query_semua->row()->total_harga ?? 0;
            $total_harga_semua += $total_harga;

            $query_semua = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')
                ->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan')
                ->where('tb_pesanan.id_pesanan', $pesanan->id_pesanan)
                ->where('tb_pesanan.status_pembayaran', 'Menunggu Pembayaran')
                ->get('tb_pesanan_detail');
            $total_harga2 = $query_semua->row()->total_harga ?? 0;
            $total_harga_semua_belum_lunas += $total_harga2;

            $no++;
            $row = array(
                $no,
                $pesanan->id_pesanan,
                date('d/M/Y H:i:s', strtotime($pesanan->tgl_pesanan)),
                $pesanan->nama_member ?? 'Walk In Customer',
                $pesanan->nomor_induk ?? '-',
                ucwords(str_replace('_', ' ', $pesanan->jenis_order)),
                ucwords(str_replace('_', ' ', $pesanan->metode_bayar)),
                $pesanan->ongkos_kirim,
                $pesanan->grand_total,
                $pesanan->status_pesanan,
                $pesanan->status_pembayaran,
            );
            $data[] = $row;
        }

        $output = array(
            "totalHargaSemua" => "Rp. " . number_format($total_harga_semua),
            "totalHargaSemuaBelumLunas" => "Rp. " .  number_format($total_harga_semua_belum_lunas),
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable_model->count_all('tb_pesanan'),
            "recordsFiltered" => $this->Datatable_model->count_filtered('tb_pesanan', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function penjualan_periode_pdf()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $status = $this->input->post('status');

        // Proses pembuatan laporan PDF
        $mpdf = new Mpdf();
        $mpdf->AddPage('L');

        // Masukkan data ke dalam array untuk dikirim ke view
        $data['start'] = $startDate;
        $data['end'] = $endDate;
        $data['status'] = $status;

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pesanan');
        $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_pesanan BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_pesanan >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_pesanan <=", $endDate);
        }

        // Tambahkan filter berdasarkan supplier
        if (!empty($tatus)) {
            $this->db->where('tb_pesanan.status_pembayaran', $status);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $data['pesanan'] = $this->db->get()->result_array();

        // Load view untuk konten PDF
        $html = $this->load->view('report/pdf_penjualan_periode', $data, true);

        // Set konten PDF
        $mpdf->WriteHTML($html);

        // Outputkan PDF ke browser
        $mpdf->Output('penjualan_by_periode.pdf', 'D');
    }

    public function penjualan_periode_excel()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $status = $this->input->post('status');

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pesanan');
        $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
        // Tambahkan filter berdasarkan tanggal pesanan
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_pesanan BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_pesanan >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_pesanan <=", $endDate);
        }

        // Tambahkan filter berdasarkan status pesanan
        if (!empty($status)) {
            $this->db->where('tb_pesanan.status_pembayaran', $status);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $pesanan = $this->db->get()->result_array();

        // Inisialisasi objek Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Mulai menulis data ke dalam file Excel
        // Set nilai sel-sel pada header
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Periode:');
        $spreadsheet->getActiveSheet()->setCellValue('B1', !empty($startDate) ? date('d/F/Y', strtotime($startDate)) : '');
        $spreadsheet->getActiveSheet()->setCellValue('C1', 's/d');
        $spreadsheet->getActiveSheet()->setCellValue('D1', !empty($endDate) ? date('d/F/Y', strtotime($endDate)) : '');
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'No');
        $spreadsheet->getActiveSheet()->setCellValue('B2', 'ID Transaksi');
        $spreadsheet->getActiveSheet()->setCellValue('C2', 'Tanggal');
        $spreadsheet->getActiveSheet()->setCellValue('D2', 'Customer');
        $spreadsheet->getActiveSheet()->setCellValue('E2', 'NIK');
        $spreadsheet->getActiveSheet()->setCellValue('F2', 'Jenis Order');
        $spreadsheet->getActiveSheet()->setCellValue('G2', 'Metode Bayar');
        $spreadsheet->getActiveSheet()->setCellValue('H2', 'Ongkos Kirim');
        $spreadsheet->getActiveSheet()->setCellValue('I2', 'Total Penjualan');
        $spreadsheet->getActiveSheet()->setCellValue('J2', 'Status Pesanan');
        $spreadsheet->getActiveSheet()->setCellValue('K2', 'Status Pembayaran');

        // Menerapkan border pada header
        $spreadsheet->getActiveSheet()->getStyle('A2:K2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Menambahkan data dari array $pesanan
        $row = 3;
        foreach ($pesanan as $key => $item) {
            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $key + 1);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $item['id_pesanan']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, date('d/M/Y H:i:s', strtotime($item['tgl_pesanan'])));
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $item['nama_member'] ?? 'Walk In Customer');
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $item['nomor_induk'] ?? '-');
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, ucwords(str_replace('_', ' ', $item['jenis_order'])));
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, ucwords(str_replace('_', ' ', $item['metode_bayar'])));
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $item['ongkos_kirim']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $item['grand_total']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $row, $item['status_pesanan']);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $row, $item['status_pembayaran']);

            // Menerapkan border pada sel
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':K' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $row++;
        }

        // Hitung total biaya pembelian
        $totalBiayaPembelian = array_sum(array_column($pesanan, 'grand_total'));

        // Tambahkan total biaya pembelian ke dalam tfoot
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, 'Total Biaya Pembelian');
        $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $totalBiayaPembelian);

        // Tambahkan border pada sel total biaya pembelian
        $spreadsheet->getActiveSheet()->getStyle('H' . $row . ':I' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Set judul dan ekstensi file
        $filename = 'penjualan_periode_report.xlsx';

        // Set header untuk tipe konten dan nama file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Buat writer untuk XLSX dan simpan output ke standar output
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
    // END REPORT 4 ------------------------------------------------------------------------

    // REPORT 5 ----------------------------------------------------------------------------
    public function penjualan_pelanggan()
    {
        $data['pelanggan'] = $this->M_Crud->all_data('tb_user')->where('level', 'User')->get()->result_array();
        $this->load->view('report/penjualan_pelanggan', $data);
    }

    public function penjualan_pelanggan_json()
    {
        $start = $this->input->post('start_date');
        $end = $this->input->post('end_date');
        $pelanggan = $this->input->post('pelanggan');

        $columns = '*';
        $filter = array('tb_pesanan.id_pesanan', 'nama_barang', 'barcode');
        $joins = array(

            array(
                'table' => 'tb_pesanan',
                'condition' => 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan',
                'type' => 'inner'
            ),
            array(
                'table' => 'tb_barang',
                'condition' => 'tb_barang.id_brg = tb_pesanan_detail.id_brg',
                'type' => 'inner'
            ),
        );

        $where = null;
        if ($start || $end || $pelanggan) {
            $where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

            if ($start) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_pesanan) >= '" . $start . "'";
            }

            if ($end) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_pesanan) <= '" . $end . "'";
            }

            if ($pelanggan) {
                $where .= " AND tb_pesanan.id_user = '" . $pelanggan . "'";
            }
        }

        $list = $this->Datatable_model->get_data('tb_pesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

        $data = array();
        $total_harga_semua = 0;
        $total_harga_semua_belum_lunas = 0;
        $no = $_POST['start'];
        foreach ($list->result() as $pesanan) {
            $query_semua = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')
                ->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan')
                ->where('tb_pesanan.id_pesanan', $pesanan->id_pesanan)
                ->get('tb_pesanan_detail');
            $total_harga = $query_semua->row()->total_harga ?? 0;
            $total_harga_semua += $total_harga;

            $query_semua = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')
                ->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan')
                ->where('tb_pesanan.id_pesanan', $pesanan->id_pesanan)
                ->where('tb_pesanan.status_pembayaran', 'Menunggu Pembayaran')
                ->get('tb_pesanan_detail');
            $total_harga2 = $query_semua->row()->total_harga ?? 0;
            $total_harga_semua_belum_lunas += $total_harga2;

            $no++;
            $row = array(
                $no,
                $pesanan->id_pesanan,
                date('d/M/Y', strtotime($pesanan->tgl_pesanan)),
                $pesanan->nama_barang,
                $pesanan->barcode,
                $pesanan->jumlah_jual,
                $pesanan->harga_saat_ini,
                $pesanan->jumlah_jual * $pesanan->harga_saat_ini,
            );
            $data[] = $row;
        }

        $output = array(
            "totalHargaSemua" => "Rp. " . number_format($total_harga_semua),
            "totalHargaSemuaBelumLunas" => "Rp. " .  number_format($total_harga_semua_belum_lunas),
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable_model->count_all('tb_pesanan_detail'),
            "recordsFiltered" => $this->Datatable_model->count_filtered('tb_pesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function penjualan_pelanggan_pdf()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $pelanggan = $this->input->post('pelanggan');

        // Proses pembuatan laporan PDF
        $mpdf = new Mpdf();
        $mpdf->AddPage('L');

        // Masukkan data ke dalam array untuk dikirim ke view
        $data['start'] = $startDate;
        $data['end'] = $endDate;
        $data['pelanggan'] = $pelanggan;

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pesanan_detail');
        $this->db->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan');
        $this->db->join('tb_kasir', 'tb_kasir.id_kasir = tb_pesanan.id_kasir', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg');
        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_pesanan BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_pesanan >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_pesanan <=", $endDate);
        }

        // Tambahkan filter berdasarkan supplier
        if (!empty($pelanggan)) {
			if ($pelanggan == '-') {
				$pelanggan = 0;
			}
            $this->db->where('tb_pesanan.id_user', $pelanggan);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $data['pesanan'] = $this->db->get()->result_array();

        // Load view untuk konten PDF
        $html = $this->load->view('report/pdf_penjualan_pelanggan', $data, true);

        // Set konten PDF
        $mpdf->WriteHTML($html);

        // Outputkan PDF ke browser
        $mpdf->Output('penjualan_by_pelanggan.pdf', 'D');
    }

    public function penjualan_pelanggan_excel()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $pelanggan = $this->input->post('pelanggan');

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pesanan_detail');
        $this->db->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan');
        $this->db->join('tb_kasir', 'tb_kasir.id_kasir = tb_pesanan.id_kasir', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg');
        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_pesanan BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_pesanan >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_pesanan <=", $endDate);
        }

        // Tambahkan filter berdasarkan pelanggan
        if (!empty($pelanggan)) {
			if ($pelanggan == '-') {
				$pelanggan = 0;
			}
            $this->db->where('tb_pesanan.id_user', $pelanggan);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $pesanan = $this->db->get()->result_array();

        // Inisialisasi objek Spreadsheet
        $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Set properties dokumen
        $spreadsheet->getProperties()->setCreator("Your Name")
            ->setLastModifiedBy("Your Name")
            ->setTitle("Penjualan by Pelanggan Report")
            ->setSubject("Penjualan by Pelanggan Report")
            ->setDescription("Penjualan by Pelanggan Report")
            ->setKeywords("penjualan by pelanggan report")
            ->setCategory("Report");

        // Mulai menulis data ke dalam file Excel
        // Set nilai sel-sel pada header
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Periode: ' . (!empty($startDate) ? date('d/F/Y', strtotime($startDate)) : '') . ' s/d ' . (!empty($endDate) ? date('d/F/Y', strtotime($endDate)) : ''));
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'No');
        $spreadsheet->getActiveSheet()->setCellValue('B2', 'ID Transaksi');
        $spreadsheet->getActiveSheet()->setCellValue('C2', 'Tanggal');
        $spreadsheet->getActiveSheet()->setCellValue('D2', 'Nama Barang');
        $spreadsheet->getActiveSheet()->setCellValue('E2', 'Barcode');
        $spreadsheet->getActiveSheet()->setCellValue('F2', 'QTY');
        $spreadsheet->getActiveSheet()->setCellValue('G2', 'Harga');
        $spreadsheet->getActiveSheet()->setCellValue('H2', 'Sub Total');

        // Menerapkan border pada header
        $spreadsheet->getActiveSheet()->getStyle('A2:H2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Menambahkan data dari array $pesanan
        $row = 3;
        $totalHargaSemua = 0;

        foreach ($pesanan as $key => $value) {
            $subTotal = $value['jumlah_jual'] * $value['harga_saat_ini'];
            $totalHargaSemua += $subTotal;

            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $key + 1);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $value['id_pesanan']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, date('d/M/Y', strtotime($value['tgl_pesanan'])));
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $value['nama_barang']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $value['barcode']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $value['jumlah_jual']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $value['harga_saat_ini']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $subTotal);

            // Menambahkan border di sekitar sel-sel
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':H' . $row)->applyFromArray($styleArray);

            $row++;
        }

        // Hitung total autodebit
        $totalAutodebit = 0;
        foreach ($pesanan as $value) {
            $query_semua = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')
                ->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan')
                ->where('tb_pesanan.id_pesanan', $value['id_pesanan'])
                ->where('tb_pesanan.status_pembayaran', 'Menunggu Pembayaran')
                ->get('tb_pesanan_detail');
            $total_harga2 = $query_semua->row()->total_harga ?? 0;
            $totalAutodebit += $total_harga2;
        }

        // Tulis total autodebit di bagian akhir tabel
        $row++;
        $spreadsheet->getActiveSheet()->setCellValue('A' . $row, 'Total Autodebit');
        $spreadsheet->getActiveSheet()->mergeCells('A' . $row . ':G' . $row);
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $totalAutodebit);

        // Tambahkan border di sekitar sel total autodebit
        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':H' . $row)->applyFromArray($styleArray);

        // Tulis total harga di bagian akhir tabel
        $row++;
        $spreadsheet->getActiveSheet()->setCellValue('A' . $row, 'Total Biaya Pembelian');
        $spreadsheet->getActiveSheet()->mergeCells('A' . $row . ':G' . $row);
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $totalHargaSemua);

        // Tambahkan border di sekitar sel total harga
        $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':H' . $row)->applyFromArray($styleArray);

        // Set lebar kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        // Sesuaikan dengan kolom yang lain

        // Set judul dan ekstensi file
        $filename = 'penjualan_pelanggan_report.xlsx';

        // Set header untuk tipe konten dan nama file
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Buat writer untuk XLSX dan simpan output ke standar output
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    // END REPORT 5

    // REPORT 6
    public function penjualan_barang()
    {
        $data = [];
        $this->load->view('report/penjualan_barang', $data);
    }

    public function penjualan_barang_json()
    {
        $start = $this->input->post('start_date');
        $end = $this->input->post('end_date');
        $barang = $this->input->post('barang');

        $columns = '*';
        $filter = array('tb_pesanan.id_pesanan', 'nama_member', 'nama_barang', 'barcode', 'nomor_induk');
        $joins = array(
            array(
                'table' => 'tb_pesanan',
                'condition' => 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan',
                'type' => 'inner'
            ),
            array(
                'table' => 'tb_barang',
                'condition' => 'tb_barang.id_brg = tb_pesanan_detail.id_brg',
                'type' => 'inner'
            ),
            array(
                'table' => 'tb_user',
                'condition' => 'tb_user.id_user = tb_pesanan.id_user',
                'type' => 'left'
            ),
        );

        $where = null;
        if ($start || $end || $barang) {
            $where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

            if ($start) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_pesanan) >= '" . $start . "'";
            }

            if ($end) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_pesanan) <= '" . $end . "'";
            }

            if ($barang) {
                $where .= " AND tb_pesanan_detail.id_brg = '" . $barang . "'";
            }
        }

        $list = $this->Datatable_model->get_data('tb_pesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

        $data = array();
        $total_harga_semua = 0;
        $total_harga_semua_belum_lunas = 0;
        $no = $_POST['start'];
        foreach ($list->result() as $barang) {
            $query_semua = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')
                ->where('id_brg', $barang->id_brg)
                ->get('tb_pesanan_detail');
            $total_harga = $query_semua->row()->total_harga ?? 0;
            $total_harga_semua += $total_harga;

            $no++;
            $row = array(
                $no,
                $barang->id_pesanan,
                date('d/M/Y', strtotime($barang->tgl_pesanan)),
                $barang->nama_member ?? 'Walk In Customer',
                $barang->nomor_induk ?? '-',
                $barang->nama_barang,
                $barang->barcode,
                $barang->jumlah_jual,
                $barang->hpp_barang,
                $barang->harga_saat_ini,
                $barang->jumlah_jual * $barang->harga_saat_ini,
            );
            $data[] = $row;
        }

        $output = array(
            "totalHargaSemua" => "Rp. " . number_format($total_harga_semua),
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable_model->count_all('tb_pesanan_detail'),
            "recordsFiltered" => $this->Datatable_model->count_filtered('tb_pesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function penjualan_barang_pdf()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $barang = $this->input->post('barang');

        // Proses pembuatan laporan PDF
        $mpdf = new Mpdf();
        $mpdf->AddPage('L');

        // Masukkan data ke dalam array untuk dikirim ke view
        $data['start'] = $startDate;
        $data['end'] = $endDate;
        $data['barang'] = $barang;

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pesanan_detail');
        $this->db->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan');
        $this->db->join('tb_kasir', 'tb_kasir.id_kasir = tb_pesanan.id_kasir', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg');
        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_pesanan BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_pesanan >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_pesanan <=", $endDate);
        }

        // Tambahkan filter berdasarkan supplier
        if (!empty($barang)) {
            $this->db->where('tb_pesanan_detail.id_brg', $barang);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $data['pesanan'] = $this->db->get()->result_array();

        // Load view untuk konten PDF
        $html = $this->load->view('report/pdf_penjualan_barang', $data, true);

        // Set konten PDF
        $mpdf->WriteHTML($html);

        // Outputkan PDF ke browser
        $mpdf->Output('penjualan_by_barang.pdf', 'D');
    }

    public function penjualan_barang_excel()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $barang = $this->input->post('barang');

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pesanan_detail');
        $this->db->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan');
        $this->db->join('tb_kasir', 'tb_kasir.id_kasir = tb_pesanan.id_kasir', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg');
        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_pesanan BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_pesanan >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_pesanan <=", $endDate);
        }

        // Tambahkan filter berdasarkan barang
        if (!empty($barang)) {
            $this->db->where('tb_pesanan_detail.id_brg', $barang);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $pesanan = $this->db->get()->result_array();

        // Inisialisasi variabel total harga semua
        $total_harga_semua = 0;

        // Inisialisasi objek Spreadsheet
        $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Set properties dokumen
        $spreadsheet->getProperties()->setCreator("Your Name")
            ->setLastModifiedBy("Your Name")
            ->setTitle("Penjualan by Barang Report")
            ->setSubject("Penjualan by Barang Report")
            ->setDescription("Penjualan by Barang Report")
            ->setKeywords("penjualan by barang report")
            ->setCategory("Report");

        // Mulai menulis data ke dalam file Excel
        // Set nilai sel-sel pada header
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Periode: ' . (!empty($startDate) ? date('d/F/Y', strtotime($startDate)) : '') . ' s/d ' . (!empty($endDate) ? date('d/F/Y', strtotime($endDate)) : ''));
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'No');
        $spreadsheet->getActiveSheet()->setCellValue('B2', 'ID Transaksi');
        $spreadsheet->getActiveSheet()->setCellValue('C2', 'Tanggal');
        $spreadsheet->getActiveSheet()->setCellValue('D2', 'Nama Barang');
        $spreadsheet->getActiveSheet()->setCellValue('E2', 'Barcode');
        $spreadsheet->getActiveSheet()->setCellValue('F2', 'QTY');
        $spreadsheet->getActiveSheet()->setCellValue('G2', 'HPP');
        $spreadsheet->getActiveSheet()->setCellValue('H2', 'Harga');
        $spreadsheet->getActiveSheet()->setCellValue('I2', 'Sub Total');

        // Menerapkan border pada header
        $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Menambahkan data dari array $pesanan
        $row = 3;
        foreach ($pesanan as $key => $value) {
            $subTotal = $value['jumlah_jual'] * $value['harga_saat_ini'];

            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $key + 1);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $value['id_pesanan']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, date('d/M/Y', strtotime($value['tgl_pesanan'])));
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $value['nama_barang']);
            $spreadsheet->getActiveSheet()->setCellValue('E' . $row, $value['barcode']);
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $value['jumlah_jual']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $value['hpp_barang']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $value['harga_saat_ini']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $subTotal);

            // Menambahkan border di sekitar sel-sel
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':I' . $row)->applyFromArray($styleArray);

            $total_harga_semua += $subTotal; // Menambahkan nilai sub total ke total harga semua

            $row++;
        }

        // Set lebar kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        // Sesuaikan dengan kolom yang lain

        // Tambahkan total penjualan ke dalam footer
        $spreadsheet->getActiveSheet()->setCellValue('H' . $row, 'Total Penjualan');
        $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $total_harga_semua);

        // Set judul dan ekstensi file
        $filename = 'penjualan_barang_report.xlsx';

        // Set header untuk tipe konten dan nama file
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Buat writer untuk XLSX dan simpan output ke standar output
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    // END REPORT 6

    // REPORT 7
    public function penjualan_kasir()
    {
        $data['kasir'] = $this->M_Crud->all_data('tb_kasir')->get()->result_array();
        $this->load->view('report/penjualan_kasir', $data);
    }

    public function penjualan_kasir_json()
    {
        $start = $this->input->post('start_date');
        $end = $this->input->post('end_date');
        $kasir = $this->input->post('kasir');
        $metode = $this->input->post('metode');

        $columns = '*';
        $filter = array('tb_pesanan.id_pesanan', 'nama_member', 'nama_barang', 'barcode', 'nomor_induk');
        $joins = array(
            array(
                'table' => 'tb_pesanan',
                'condition' => 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan',
                'type' => 'inner'
            ),
            array(
                'table' => 'tb_barang',
                'condition' => 'tb_barang.id_brg = tb_pesanan_detail.id_brg',
                'type' => 'inner'
            ),
            array(
                'table' => 'tb_user',
                'condition' => 'tb_user.id_user = tb_pesanan.id_user',
                'type' => 'left'
            ),
        );

        $where = null;
        if ($start || $end || $kasir || $metode) {
            $where = "1"; // Menginisialisasi dengan 1 sehingga operasi AND berfungsi

            if ($start) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_pesanan) >= '" . $start . "'";
            }

            if ($end) {
                // Menggunakan fungsi DATE() untuk memfilter hanya tanggal dan mengabaikan waktu
                $where .= " AND DATE(tgl_pesanan) <= '" . $end . "'";
            }

            if ($kasir) {
                $where .= " AND tb_pesanan.id_kasir = '" . $kasir . "'";
            }
            
            if ($metode) {
                $where .= " AND tb_pesanan.metode_bayar = '" . $metode . "'";
            }
        }

        $list = $this->Datatable_model->get_data('tb_pesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where, $this->input->post('start'), $this->input->post('length'));

        $data = array();
        $total_harga_semua = 0;
        $no = $_POST['start'];
        foreach ($list->result() as $barang) {
            // $query_semua = $this->db->select('SUM(harga_saat_ini * jumlah_jual) as total_harga')
            //     ->where('id_brg', $barang->id_brg)
            //     ->get('tb_pesanan_detail');
            // $total_harga = $query_semua->row()->total_harga ?? 0;
            // $total_harga_semua += $total_harga;
			$subtotal = $barang->harga_saat_ini * $barang->jumlah_jual;
			$total_harga_semua += $subtotal;

            $no++;
            $row = array(
                $no,
                $barang->id_pesanan,
                date('d/M/Y', strtotime($barang->tgl_pesanan)),
                $barang->nama_member ?? 'Walk In Customer',
				$barang->nomor_induk ?? '-',
                $barang->nama_barang,
                $barang->barcode,
                $barang->jumlah_jual,
                $barang->harga_saat_ini,
                $barang->jumlah_jual * $barang->harga_saat_ini,
                ucwords(str_replace('_', ' ', strtolower($barang->metode_bayar)))
            );
            $data[] = $row;
        }

		$output = array(
            "totalHargaSemua" => "Rp. " . number_format($total_harga_semua),
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable_model->count_all('tb_pesanan_detail'),
            "recordsFiltered" => $this->Datatable_model->count_filtered('tb_pesanan_detail', $columns, $joins, $filter, $this->input->post('search')['value'], $where), // Menggunakan filter
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function penjualan_kasir_pdf()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $kasir = $this->input->post('kasir');
        $metode = $this->input->post('metode');

        // Proses pembuatan laporan PDF
        $mpdf = new Mpdf();
        $mpdf->AddPage('L');

        // Masukkan data ke dalam array untuk dikirim ke view
        $data['start'] = $startDate;
        $data['end'] = $endDate;
        $data['kasir'] = $kasir;

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pesanan_detail');
        $this->db->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan');
        $this->db->join('tb_kasir', 'tb_kasir.id_kasir = tb_pesanan.id_kasir', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg');
        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_pesanan BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_pesanan >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_pesanan <=", $endDate);
        }

        // Tambahkan filter berdasarkan supplier
        if (!empty($kasir)) {
            $this->db->where('tb_pesanan.id_kasir', $kasir);
        }
        
        if (!empty($metode)) {
            $this->db->where('tb_pesanan.metode_bayar', $metode);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $data['pesanan'] = $this->db->get()->result_array();

        // Load view untuk konten PDF
        $html = $this->load->view('report/pdf_penjualan_kasir', $data, true);

        // Set konten PDF
        $mpdf->WriteHTML($html);

        // Outputkan PDF ke browser
        $mpdf->Output('penjualan_by_kasir.pdf', 'D');
    }

    public function penjualan_kasir_excel()
    {
        // Tangkap data yang dikirim melalui AJAX
        $startDate = $this->input->post('start');
        $endDate = $this->input->post('end');
        $kasir = $this->input->post('kasir');
        $metode = $this->input->post('metode');

        // Buat query berdasarkan filter yang diberikan
        $this->db->select('*');
        $this->db->from('tb_pesanan_detail');
        $this->db->join('tb_pesanan', 'tb_pesanan.id_pesanan = tb_pesanan_detail.id_pesanan');
        $this->db->join('tb_kasir', 'tb_kasir.id_kasir = tb_pesanan.id_kasir', 'left');
        $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user', 'left');
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_pesanan_detail.id_brg');
        // Tambahkan filter berdasarkan tanggal terima
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where("tgl_pesanan BETWEEN '$startDate' AND '$endDate'");
        } else if (!empty($startDate)) {
            $this->db->where("tgl_pesanan >=", $startDate);
        } else if (!empty($endDate)) {
            $this->db->where("tgl_pesanan <=", $endDate);
        }

        // Tambahkan filter berdasarkan kasir
        if (!empty($kasir)) {
            $this->db->where('tb_pesanan.id_kasir', $kasir);
        }
        
        if (!empty($metode)) {
            $this->db->where('tb_pesanan.metode_bayar', $metode);
        }

        // Jalankan query dan simpan hasilnya ke dalam array
        $pesanan = $this->db->get()->result_array();

        // Inisialisasi objek Spreadsheet
        $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();

        // Set properties dokumen
        $spreadsheet->getProperties()->setCreator("Your Name")
            ->setLastModifiedBy("Your Name")
            ->setTitle("Penjualan by Kasir Report")
            ->setSubject("Penjualan by Kasir Report")
            ->setDescription("Penjualan by Kasir Report")
            ->setKeywords("penjualan by kasir report")
            ->setCategory("Report");

        // Mulai menulis data ke dalam file Excel
        // Set nilai sel-sel pada header
        $spreadsheet->getActiveSheet()->setCellValue('A1', 'Periode: ' . (!empty($startDate) ? date('d/F/Y', strtotime($startDate)) : '') . ' s/d ' . (!empty($endDate) ? date('d/F/Y', strtotime($endDate)) : ''));
        $spreadsheet->getActiveSheet()->setCellValue('A2', 'No');
        $spreadsheet->getActiveSheet()->setCellValue('B2', 'ID Transaksi');
        $spreadsheet->getActiveSheet()->setCellValue('C2', 'Tanggal');
        $spreadsheet->getActiveSheet()->setCellValue('D2', 'Customer');
        $spreadsheet->getActiveSheet()->setCellValue('E2', 'NIK');
        $spreadsheet->getActiveSheet()->setCellValue('F2', 'Nama Barang');
        $spreadsheet->getActiveSheet()->setCellValue('G2', 'Barcode');
        $spreadsheet->getActiveSheet()->setCellValue('H2', 'QTY');
        $spreadsheet->getActiveSheet()->setCellValue('I2', 'Harga');
        $spreadsheet->getActiveSheet()->setCellValue('J2', 'Sub Total');
        $spreadsheet->getActiveSheet()->setCellValue('K2', 'Metode Bayar');

        // Menerapkan border pada header
        $spreadsheet->getActiveSheet()->getStyle('A2:K2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Menambahkan data dari array $pesanan
        $row = 3;
        $total_harga_semua = 0;
        foreach ($pesanan as $key => $value) {
            $subTotal = $value['jumlah_jual'] * $value['harga_saat_ini'];
            $total_harga_semua += $subTotal;

            $spreadsheet->getActiveSheet()->setCellValue('A' . $row, $key + 1);
            $spreadsheet->getActiveSheet()->setCellValue('B' . $row, $value['id_pesanan']);
            $spreadsheet->getActiveSheet()->setCellValue('C' . $row, date('d/M/Y', strtotime($value['tgl_pesanan'])));
            $spreadsheet->getActiveSheet()->setCellValue('D' . $row, $value['nama_member'] ?? 'Walk In Customer');
			$spreadsheet->getActiveSheet()->setCellValue('E' . $row, $value['nomor_induk'] ?? '-');
            $spreadsheet->getActiveSheet()->setCellValue('F' . $row, $value['nama_barang']);
            $spreadsheet->getActiveSheet()->setCellValue('G' . $row, $value['barcode']);
            $spreadsheet->getActiveSheet()->setCellValue('H' . $row, $value['jumlah_jual']);
            $spreadsheet->getActiveSheet()->setCellValue('I' . $row, $value['harga_saat_ini']);
            $spreadsheet->getActiveSheet()->setCellValue('J' . $row, $subTotal);
            $spreadsheet->getActiveSheet()->setCellValue('K' . $row, ucwords(str_replace('_', ' ', strtolower($value['metode_bayar']))));

            // Menambahkan border di sekitar sel-sel
            $styleArray = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ];
            $spreadsheet->getActiveSheet()->getStyle('A' . $row . ':K' . $row)->applyFromArray($styleArray);

            $row++;
        }

        // Set lebar kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);

        // Menambahkan total biaya penjualan
        $spreadsheet->getActiveSheet()->setCellValue('I' . $row, 'Total Biaya Penjualan');
        $spreadsheet->getActiveSheet()->getStyle('I' . $row)->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->setCellValue('J' . $row, 'Rp. ' . number_format($total_harga_semua));
        $spreadsheet->getActiveSheet()->getStyle('J' . $row)->getFont()->setBold(true);

        // Menambahkan border pada total biaya penjualan
        $spreadsheet->getActiveSheet()->getStyle('I' . $row . ':J' . $row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        // Mengatur output Excel
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="penjualan_by_kasir.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    // END REPORT 7

    public function index()
    {
        $data['kasir'] = $this->M_Crud->tampil_data('tb_kasir')->result_array();
        $this->load->view('level/admin/laporan', $data);
    }

    public function omset_penjualan()
    {
        $reportPeriod = $this->input->post('report_period');
        $kasir = $this->input->post('kasir');

        // Pisahkan rentang waktu menjadi dua bagian
        list($startDate, $endDate) = explode(' - ', $reportPeriod);

        // Ubah format rentang waktu sesuai dengan format MySQL DATETIME
        $startDate = date('Y-m-d H:i:s', strtotime($startDate . ' 00:00:00'));
        $endDate = date('Y-m-d H:i:s', strtotime($endDate . ' 23:59:59'));

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->AddPage('L');

        // Load your data from the model or wherever you have it
        $data['penjualan'] = $this->M_Crud->all_data('tb_pesanan')
            ->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')
            ->where('tgl_pesanan >=', $startDate)
            ->where('tgl_pesanan <=', $endDate)
            ->where('id_kasir', $kasir)
            ->order_by('tgl_pesanan', 'DESC')
            ->get()
            ->result();
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        // Load the HTML view into a variable
        $html = $this->load->view('report/omset_penjualan', $data, true);

        // Set the PDF content
        $mpdf->WriteHTML($html);

        // Output the PDF
        $mpdf->Output('omset_penjualan.pdf', 'D');
    }
}
