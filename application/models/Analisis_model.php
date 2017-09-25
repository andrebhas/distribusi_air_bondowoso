<?php 
 defined('BASEPATH') OR exit('No direct script access allowed');
 
 class Analisis_model extends CI_Model {
 

    function __construct()
    {
        parent::__construct();
    }

    function get_nilai_max($id_survey)
    {
        $sql = "SELECT MAX(k1) as s1, MAX(k2) as s2, MAX(k3) as s3, MAX(k4) as s4 , MAX(k5) as s5, MAX(k6) as s6 FROM `survey_detail` WHERE `survey_detail`.`id_survey` =  ".$id_survey;
        $query = $this->db->query($sql);
        return $query->row();
    }

    function get_nilai_min($id_survey)
    {
        $sql = "SELECT MIN(k1) as s1, MIN(k2) as s2, MIN(k3) as s3, MIN(k4) as s4 , MIN(k5) as s5, MIN(k6) as s6 FROM `survey_detail` WHERE `survey_detail`.`id_survey` =  ".$id_survey;
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function normalisasi($id_survey,$kecamatan)
    {
    	$sql1 = "SELECT MAX(k1) as m1, MAX(k2) as m2, MAX(k3) as m3, MAX(k4) as m4 , MAX(k5) as m5, MAX(k6) as m6 FROM `survey_detail` WHERE `survey_detail`.`id_survey` =  ".$id_survey;
    	$max = $this->db->query($sql1)->row();
    	$max_s1 = $max->m1; 
    	$max_s2 = $max->m2;
    	$max_s3 = $max->m3;
    	$max_s4 = $max->m5;
    	$max_s5 = $max->m5;  
    	$max_s6 = $max->m6;

    	$sql2 = "
			CREATE OR REPLACE VIEW normalisasi_".$kecamatan." AS SELECT 
			svd.nama_desa as nama_desa, svd.lokasi_kekeringan as lokasi_kekeringan,
			svd.k1 / ".$max_s1." AS s1,
			svd.k2 / ".$max_s2." AS s2,
			svd.k3 / ".$max_s3." AS s3,
			svd.k4 / ".$max_s4." AS s4,
			svd.k5 / ".$max_s5." AS s5,
			svd.k6 / ".$max_s6." AS s6

			FROM survey sv
			JOIN survey_detail svd
			on sv.id_survey = svd.id_survey
			WHERE sv.id_survey = ".$id_survey." 
			ORDER BY svd.id_survey_detail DESC "
		;
		$this->db->query($sql2);

		$sql3 = "SELECT * FROM normalisasi_".$kecamatan;
		$query = $this->db->query($sql3);
    	return $query->result();
    }

    public function prioritas($id_survey,$kecamatan)
    {

    	$w_s1 = $this->db->query('select sk.w as w from subkriteria sk where sk.id_subkriteria = 1')->row()->w;
    	$w_s2 = $this->db->query('select sk.w as w from subkriteria sk where sk.id_subkriteria = 2')->row()->w;
    	$w_s3 = $this->db->query('select sk.w as w from subkriteria sk where sk.id_subkriteria = 3')->row()->w;
    	$w_s4 = $this->db->query('select sk.w as w from subkriteria sk where sk.id_subkriteria = 4')->row()->w;
    	$w_s5 = $this->db->query('select sk.w as w from subkriteria sk where sk.id_subkriteria = 5')->row()->w;
    	$w_s6 = $this->db->query('select sk.w as w from subkriteria sk where sk.id_subkriteria = 6')->row()->w;

    	$create_view_saw = "CREATE OR REPLACE VIEW saw_kecamatan_".$kecamatan." AS
				SELECT nm.nama_desa as nama_desa, nm.lokasi_kekeringan as lokasi_kekeringan, 
				s1 * $w_s1 as s1 ,
				s2 * $w_s2 as s2 ,
				s3 * $w_s3 as s3 ,
				s4 * $w_s4 as s4 ,
				s5 * $w_s5 as s5 ,
				s6 * $w_s6 as s6 
				FROM normalisasi_".$kecamatan." AS nm";

		$this->db->query($create_view_saw);
    }

    public function get_prioritas($kecamatan)
    {
    	$sql = "
    		SELECT nama_desa, lokasi_kekeringan, s1, s2, s3, s4, s5, s6, (s1+s2+s3+s4+s5+s6) as total
    		FROM saw_kecamatan_".$kecamatan." ORDER BY total DESC";
    	; 

    	$query = $this->db->query($sql);
    	return $query->result();
    }

 	
 
 }
 
/* End of file Survey_detail_model.php */
/* Location: ./application/models/Analisis_model.php */
/* Please DO NOT modify this information : */
/* This file generated by Andre Bhaskoro (+62 82 333 817 317) At : 2016-09-30 16:32:13 */
/* http://bhas.web.id */