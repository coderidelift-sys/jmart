<?php
class M_Jqgrid extends CI_Model
{
    public function getTotalRecords($table)
    {
        $this->db->select('COUNT(*) as count');
        $this->db->from($table);
        $query = $this->db->get();
        $row = $query->row();
        return $row->count;
    }

    public function getData($start, $limit, $sidx, $sord, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by($sidx, $sord);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDataPenjualan($start, $limit, $sidx, $sord, $table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('tb_user', 'tb_user.id_user = tb_pesanan.id_user');
        $this->db->order_by($sidx, $sord);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
}
