<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datatable_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_data($table, $columns, $joins = array(), $filter = array(), $searchValue = null, $where = null, $start = null, $length = null, $order = array())
    {
        $this->db->select($columns)->from($table);

        foreach ($joins as $join) {
            $this->db->join($join['table'], $join['condition'], $join['type']);
        }

        if (!empty($order)) {
            $this->db->order_by($order[0], $order[1]);
        }

        if ($where) {
            $this->db->where($where);
        }

        if (!empty($searchValue) && !empty($filter)) {
            $this->db->group_start();
            foreach ($filter as $columnName) {
                $this->db->or_like($columnName, $searchValue);
            }
            $this->db->group_end();
        }

        if ($start !== null && $length !== null) {
            $this->db->limit($length, $start);
        }

        return $this->db->get();
    }

    public function count_all($table, $where = null)
    {
        if ($where) {
            $this->db->where($where);
        }

        return $this->db->count_all($table);
    }

    public function count_filtered($table, $columns, $joins = array(), $filter = array(), $searchValue = null, $where = null, $order = array())
    {
        $this->db->from($table);

        foreach ($joins as $join) {
            $this->db->join($join['table'], $join['condition'], $join['type']);
        }

        if (!empty($order)) {
            $this->db->order_by($order[0], $order[1]);
        }

        if ($where) {
            $this->db->where($where);
        }

        if (!empty($searchValue) && !empty($filter)) {
            $this->db->group_start();
            foreach ($filter as $columnName) {
                $this->db->or_like($columnName, $searchValue);
            }
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }
}
