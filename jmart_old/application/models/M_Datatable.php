<?php
class M_Datatable extends CI_Model
{
    public function getData($limit, $start, $search, $table)
    {
        // Menginisialisasi objek query builder
        $this->db->select('*');
        $this->db->from($table); // Gantilah $table dengan nama tabel yang sesuai

        // Menerapkan pencarian (search)
        if (!empty($search)) {
            $this->db->like('id_pesanan', $search);
            $this->db->or_like('id_pesanan', $search);
            // Anda dapat menambahkan lebih banyak kolom yang ingin Anda cari di atas
        }

        // Menerapkan limit dan offset (start)
        $this->db->limit($limit, $start);

        // Melakukan query dan mengambil hasilnya
        $query = $this->db->get();

        return $query->result();
    }

    public function getTotalData($table)
    {
        // Menginisialisasi objek query builder
        $this->db->select('COUNT(*) as count');
        $this->db->from($table); // Gantilah $table dengan nama tabel yang sesuai

        // Melakukan query dan mengambil hasilnya
        $query = $this->db->get();
        $result = $query->row();

        return $result->count;
    }

    public function getFilteredData($search, $table)
    {
        // Menginisialisasi objek query builder
        $this->db->select('COUNT(*) as count');
        $this->db->from($table); // Gantilah $table dengan nama tabel yang sesuai

        // Menerapkan pencarian (search)
        if (!empty($search)) {
            $this->db->like('nama_kolom_1', $search);
            $this->db->or_like('nama_kolom_2', $search);
            // Anda dapat menambahkan lebih banyak kolom yang ingin Anda cari di atas
        }

        // Melakukan query dan mengambil hasilnya
        $query = $this->db->get();
        $result = $query->row();

        return $result->count;
    }

    // TABEL BARANG
    public function getDataBarang($limit, $start, $search, $table)
    {
        // Menginisialisasi objek query builder
        $this->db->select('*');
        $this->db->from($table); // Gantilah $table dengan nama tabel yang sesuai
        $this->db->join('tb_kategori', 'tb_kategori.id_kategori_brg = tb_barang.id_kategori_brg');
        // Menerapkan pencarian (search)
        if (!empty($search)) {
            $this->db->like('id_brg', $search);
            $this->db->or_like('id_brg', $search);
            // Anda dapat menambahkan lebih banyak kolom yang ingin Anda cari di atas
        }

        // Menerapkan limit dan offset (start)
        $this->db->limit($limit, $start);

        // Melakukan query dan mengambil hasilnya
        $query = $this->db->get();

        return $query->result();
    }

    public function getDataKabupaten($limit, $start, $search, $table)
    {
        // Menginisialisasi objek query builder
        $this->db->select('*');
        $this->db->from($table); // Gantilah $table dengan nama tabel yang sesuai
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi'); // Gantilah $table dengan nama tabel yang sesuai

        // Menerapkan pencarian (search)
        if (!empty($search)) {
            $this->db->like('nama_provinsi', $search);
            $this->db->or_like('nama_kabupaten', $search);
            // Anda dapat menambahkan lebih banyak kolom yang ingin Anda cari di atas
        }

        // Menerapkan limit dan offset (start)
        $this->db->limit($limit, $start);

        // Melakukan query dan mengambil hasilnya
        $query = $this->db->get();

        return $query->result();
    }

    public function getDataKecamatan($limit, $start, $search, $table)
    {
        // Menginisialisasi objek query builder
        $this->db->select('*');
        $this->db->from($table); // Gantilah $table dengan nama tabel yang sesuai
        $this->db->join('tb_kabupaten', 'tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten'); // Gantilah $table dengan nama tabel yang sesuai
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi'); // Gantilah $table dengan nama tabel yang sesuai

        // Menerapkan pencarian (search)
        if (!empty($search)) {
            $this->db->like('nama_provinsi', $search);
            $this->db->or_like('nama_kabupaten', $search);
            // Anda dapat menambahkan lebih banyak kolom yang ingin Anda cari di atas
        }

        // Menerapkan limit dan offset (start)
        $this->db->limit($limit, $start);

        // Melakukan query dan mengambil hasilnya
        $query = $this->db->get();

        return $query->result();
    }

    public function getDataDesa($limit, $start, $search, $table)
    {
        // Menginisialisasi objek query builder
        $this->db->select('*');
        $this->db->from($table); // Gantilah $table dengan nama tabel yang sesuai
        $this->db->join('tb_kecamatan', 'tb_kecamatan.id_kecamatan = tb_desa.id_kecamatan'); // Gantilah $table dengan nama tabel yang sesuai
        $this->db->join('tb_kabupaten', 'tb_kabupaten.id_kabupaten = tb_kecamatan.id_kabupaten'); // Gantilah $table dengan nama tabel yang sesuai
        $this->db->join('tb_provinsi', 'tb_provinsi.id_provinsi = tb_kabupaten.id_provinsi'); // Gantilah $table dengan nama tabel yang sesuai

        // Menerapkan pencarian (search)
        if (!empty($search)) {
            $this->db->like('nama_provinsi', $search);
            $this->db->or_like('nama_kabupaten', $search);
            // Anda dapat menambahkan lebih banyak kolom yang ingin Anda cari di atas
        }

        // Menerapkan limit dan offset (start)
        $this->db->limit($limit, $start);

        // Melakukan query dan mengambil hasilnya
        $query = $this->db->get();

        return $query->result();
    }

    public function getDataDetailBarang($limit, $start, $search, $table)
    {
        // Menginisialisasi objek query builder
        $id = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from($table); // Gantilah $table dengan nama tabel yang sesuai
        $this->db->join('tb_barang', 'tb_barang.id_brg = tb_keranjang.id_brg'); // Gantilah $table dengan nama tabel yang sesuai
        $this->db->where('id_user', $id);
        $this->db->order_by('id_keranjang', 'DESC');
        // Menerapkan pencarian (search)
        if (!empty($search)) {
            $this->db->like('nama_barang', $search);
            $this->db->or_like('barcode', $search);
            // Anda dapat menambahkan lebih banyak kolom yang ingin Anda cari di atas
        }

        // Menerapkan limit dan offset (start)
        $this->db->limit($limit, $start);

        // Melakukan query dan mengambil hasilnya
        $query = $this->db->get();

        return $query->result();
    }
}
