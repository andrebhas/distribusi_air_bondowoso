<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Analisis extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('Survey_model');
        $this->load->model('Survey_detail_model');
        $this->load->model('Analisis_model');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }

	public function index()
	{
		$survey = $this->Survey_model->get_all();
        $survey_proses = $this->Survey_model->get_by_status('proses');
        $survey_selesai = $this->Survey_model->get_by_status('selesai');
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Analisis', '/analisis');

        $data = array(
            'title'         => 'Analisis' ,
            'content'       => 'survey/survey_list', 
            'breadcrumbs'   => $this->breadcrumbs->show(),
            'user'          => $user ,
            'survey_proses' => $survey_proses ,
            'survey_selesai'=> $survey_selesai ,
            'survey_data'   => $survey,
            'mtd'           => 'analisis',
        );

        $this->load->view('layout/layout', $data);
	}

	public function hasil($id_survey)
	{
        $id_kecamatan = $this->Survey_model->get_by_id($id_survey)->id_kecamatan;
        $kecamatan = $this->Survey_model->get_nama_kec($id_kecamatan)->name;
        $user = $this->ion_auth->user()->row();

        $survey_detail = $this->Survey_detail_model->get_all();

        $nilai_min = $this->Analisis_model->get_nilai_min($id_survey);
        $nilai_max = $this->Analisis_model->get_nilai_max($id_survey);

        $normalisasi = $this->Analisis_model->normalisasi($id_survey,$kecamatan);

        $this->Analisis_model->prioritas($id_survey,$kecamatan);
        $hasil_analisis = $this->Analisis_model->get_prioritas($kecamatan);

        $survey = $this->Survey_model->get_by_id($id_survey);
        $survey_detail_by_id = $this->Survey_detail_model->get_by_id_survey($id_survey);
        $begin = new DateTime( $survey->tgl_drop );
        $interval = new DateInterval("P2D"); // 1 month
        $occurrences = count($survey_detail_by_id);
        $period = new DatePeriod($begin,$interval,$occurrences);
        foreach($period as $dt){
          $arr_date[] =  $dt->format("Y-m-d");
        }
        //print_r($arr_date);
        
        $this->breadcrumbs->push('Analisis', '/analisis');
        $this->breadcrumbs->push('Hasil Kecamatan '.$kecamatan, '/survey_detail');

        $data = array(
			'title'       => 'Hasil Analisis Kecamatan '.$kecamatan ,
			'content'     => 'analisis/analisis_list', 
			'breadcrumbs' => $this->breadcrumbs->show(),
			'user'        => $user ,

            'survey_detail_data' => $survey_detail_by_id ,
			'nilai_min'   => $nilai_min,
			'nilai_max'   => $nilai_max,

            'normalisasi'       => $normalisasi,
            'hasil_analisis'     => $hasil_analisis,
            
            'tgl_drop' => $arr_date ,
        );

        $this->load->view('layout/layout', $data);
	}

}

/* Please DO NOT modify this information : */
/* This file generated by Andre Bhaskoro (+62 82 333 817 317) At : 2016-09-30 16:32:13 */
/* http://bhas.web.id */