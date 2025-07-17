<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pagination extends CI_Model
{
    public function hitung_data($table)
    {
        return $this->db->count_all($table);
    }

    public function ambil_data($limit, $start, $table)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user')->where('status_pesanan', 'selesai')->where('jenis_order', 'dianterin')->order_by('tgl_pesanan', 'desc')->get($table);
        return $query->result();
    }
}
