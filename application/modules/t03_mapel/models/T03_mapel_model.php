<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T03_mapel_model extends CI_Model
{

    public $table = 't03_mapel';
    public $id = 'idmapel';
    public $order = 'ASC';
    public $join = 't02_kelompok';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->select($this->table.'.*');
        $this->db->select($this->join.'.Kelompok');
        $this->db->from($this->table);
        $this->db->join($this->join, $this->join . '.idkelompok = ' . $this->table . '.idkelompok', 'left');
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->select($this->table.'.*');
        $this->db->select($this->join.'.Kelompok');
        $this->db->from($this->table);
        $this->db->join($this->join, $this->join . '.idkelompok = ' . $this->table . '.idkelompok', 'left');
        return $this->db->get()->row();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like($this->join . '.Kelompok', $q);
		$this->db->or_like('MataPelajaran', $q);
		$this->db->or_like('SKM', $q);
        $this->db->select($this->table.'.*');
        $this->db->select($this->join.'.Kelompok');
        $this->db->from($this->table);
        $this->db->join($this->join, $this->join . '.idkelompok = ' . $this->table . '.idkelompok', 'left');
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like($this->join . '.Kelompok', $q);
		$this->db->or_like('MataPelajaran', $q);
		$this->db->or_like('SKM', $q);
		$this->db->limit($limit, $start);
        $this->db->select($this->table.'.*');
        $this->db->select($this->join.'.Kelompok');
        $this->db->from($this->table);
        $this->db->join($this->join, $this->join . '.idkelompok = ' . $this->table . '.idkelompok', 'left');
        return $this->db->get()->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file T03_mapel_model.php */
/* Location: ./application/models/T03_mapel_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-25 21:19:04 */
/* http://harviacode.com */