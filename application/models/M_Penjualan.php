<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Penjualan extends CI_Model
{
    public function getData($limit, $start, $search, $query, $filter)
    {
        // Menerapkan pencarian (search)
        if (!empty($search)) {
            for ($i = 0; $i < count($filter); $i++) {
                if ($i === 0) {
                    $query->like($filter[$i], $search);
                } else {
                    $query->or_like($filter[$i], $search);
                }
            }
        }

        // Menerapkan limit dan offset (start)
        $query->limit($limit, $start);
        $query = $query->get();

        return $query->result();
    }

    public function getTotalData($query)
    {
        return $query->count_all_results();
    }

    public function getFilteredData($search, $query, $filter)
    {
        // Menerapkan pencarian (search)
        if (!empty($search)) {
            for ($j = 0; $j < count($filter); $j++) {
                if ($j === 0) {
                    $query->like($filter[$j], $search);
                } else {
                    $query->or_like($filter[$j], $search);
                }
            }
        }

        return $query->count_all_results();
    }
}
