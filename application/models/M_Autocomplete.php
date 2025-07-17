<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Autocomplete extends CI_Model
{
    public function searchProducts($term)
    {
        $this->db->like('barcode', $term); // Query pencarian
        $this->db->or_like('nama_barang', $term); // Query pencarian
        $query = $this->db->get('tb_barang'); // Tabel produk

        return $query->result(); // Mengembalikan hasil pencarian dalam bentuk array
    }
}
