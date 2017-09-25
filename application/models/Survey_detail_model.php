<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Survey_detail_model extends CI_Model
{

    public $table = 'survey_detail';
    public $id = 'id_survey_detail';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_id_survey($id_survey)
    {
        $this->db->where('id_survey', $id_survey);
        return $this->db->get($this->table)->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_survey_detail', $q);
    	$this->db->or_like('id_survey', $q);
    	$this->db->or_like('id_user', $q);
    	$this->db->or_like('nama_desa', $q);
    	$this->db->or_like('lokasi_kekeringan', $q);
    	$this->db->or_like('k1', $q);
    	$this->db->or_like('k2', $q);
    	$this->db->or_like('k3', $q);
    	$this->db->or_like('k4', $q);
    	$this->db->or_like('k5', $q);
    	$this->db->or_like('k6', $q);
    	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_survey_detail', $q);
	$this->db->or_like('id_survey', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('nama_desa', $q);
	$this->db->or_like('lokasi_kekeringan', $q);
	$this->db->or_like('k1', $q);
	$this->db->or_like('k2', $q);
	$this->db->or_like('k3', $q);
	$this->db->or_like('k4', $q);
	$this->db->or_like('k5', $q);
	$this->db->or_like('k6', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
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

/* End of file Survey_detail_model.php */
/* Location: ./application/models/Survey_detail_model.php */
/* Please DO NOT modify this information : */
/* This file generated by Andre Bhaskoro (+62 82 333 817 317) At : 2016-09-30 16:32:13 */
/* http://bhas.web.id */