<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Survey extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Survey_model');
         $this->load->model('Survey_detail_model');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $survey = $this->Survey_model->get_all();
        $survey_proses = $this->Survey_model->get_by_status('proses');
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Survey', '/survey');

        $data = array(
            'title'         => 'Survey' ,
            'content'       => 'survey/survey_list', 
            'breadcrumbs'   => $this->breadcrumbs->show(),
            'user'          => $user ,
            'survey_proses' => $survey_proses ,
            'survey_data'   => $survey,
            'mtd'           => 'list',
            'analisis' => 0,
        );

        $this->load->view('layout/layout', $data);
    }

    public function read($id) 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Survey', '/survey');
        $this->breadcrumbs->push('detail', '/survey/read');
        $row = $this->Survey_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title'       => 'Survey' ,
                'content'     => 'survey/survey_read', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,
                
				'id_survey' => $row->id_survey,
				'id_provinsi' => $row->id_provinsi,
				'kab_kota' => $row->id_kab_kota,
				'kecamatan' => $row->id_kecamatan,
				'tahun' => $row->tahun,
				'status' => $row->status,
			);
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('survey'));
        }
    }

    public function create() 
    {
        if (!$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        
        $provinsi = $this->Survey_model->get_provinsi();
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Survey', '/survey');
        $this->breadcrumbs->push('tambah', '/survey/create');
        $data = array(
            'title'       => 'Survey' ,
            'content'     => 'survey/survey_form', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
            'provinsi'    => $provinsi ,

            'button' => 'Tambah',
            'action' => site_url('survey/create_action'),
		    'id_survey' => set_value('id_survey'),
		    'id_provinsi' => set_value('id_provinsi'),
		    'kab_kota' => set_value('kab_kota'),
		    'kecamatan' => set_value('kecamatan'),
		    'tahun' => set_value('tahun'),
		    'status' => set_value('status'),
		);
        $this->load->view('layout/layout', $data);
    }
    
    public function create_action() 
    {
        if (!$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'id_provinsi' => $this->input->post('id_provinsi',TRUE),
				'id_kab_kota' => $this->input->post('kab_kota',TRUE),
				'id_kecamatan' => $this->input->post('kecamatan',TRUE),
				'tahun' => $this->input->post('tahun',TRUE),
		    );

            $this->Survey_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('survey'));
        }
    }
    
    public function update($id) 
    {
        if (!$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }

        $provinsi = $this->Survey_model->get_provinsi();
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Survey', '/survey');
        $this->breadcrumbs->push('update', '/survey/update');
        
        $row = $this->Survey_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title'       => 'Survey' ,
                'content'     => 'survey/survey_form', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,
                'provinsi'    => $provinsi ,

                'button' => 'Update',
                'action' => site_url('survey/update_action'),
				'id_survey' => set_value('id_survey', $row->id_survey),
				'id_provinsi' => set_value('id_provinsi', $row->id_provinsi),
				'kab_kota' => set_value('kab_kota', $row->id_kab_kota),
				'kecamatan' => set_value('kecamatan', $row->id_kecamatan),
				'tahun' => set_value('tahun', $row->tahun),
		    );
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('survey'));
        }
    }
    
    public function update_action() 
    {
        if (!$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_survey', TRUE));
        } else {
            $data = array(
				'id_provinsi' => $this->input->post('id_provinsi',TRUE),
				'id_kab_kota' => $this->input->post('kab_kota',TRUE),
				'id_kecamatan' => $this->input->post('kecamatan',TRUE),
				'tahun' => $this->input->post('tahun',TRUE),
		    );

            $this->Survey_model->update($this->input->post('id_survey', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('survey'));
        }
    }

    public function update_status()
    {
            $data = array(
                'status' => $this->input->post('status',TRUE),
                'tgl_drop' => $this->input->post('tgl_drop',TRUE)
            );
            print_r($data);
            $this->Survey_model->update($this->input->post('id_survey', TRUE), $data);
            $this->session->set_flashdata('message', 'Update status survey berhasil');
            redirect(site_url('survey'));
    }
    
    public function delete($id) 
    {
        if (!$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }

        $row = $this->Survey_model->get_by_id($id);

        if ($row) {
            $this->Survey_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('survey'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('survey'));
        }
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('id_provinsi', 'id provinsi', 'trim|required');
		$this->form_validation->set_rules('kab_kota', 'kab kota', 'trim|required');
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required');
		$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');

		$this->form_validation->set_rules('id_survey', 'id_survey', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function get_kabupaten($id_prov)
    {
        $kab = $this->Survey_model->get_kab_by_id_prov($id_prov);
        header('Content-Type: application/json');
        echo json_encode($kab);
    }

    public function get_kecamatan($kab)
    {
        $kec = $this->Survey_model->get_kec_by_kab($kab);
        header('Content-Type: application/json');
        echo json_encode($kec);
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "survey.xls";
        $judul = "survey";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
		xlsWriteLabel($tablehead, $kolomhead++, "Id Provinsi");
		xlsWriteLabel($tablehead, $kolomhead++, "Kab Kota");
		xlsWriteLabel($tablehead, $kolomhead++, "Kecamatan");
		xlsWriteLabel($tablehead, $kolomhead++, "Tahun");
		xlsWriteLabel($tablehead, $kolomhead++, "Status");

		foreach ($this->Survey_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, $data->id_provinsi);
		    xlsWriteLabel($tablebody, $kolombody++, $data->kab_kota);
		    xlsWriteLabel($tablebody, $kolombody++, $data->kecamatan);
		    xlsWriteNumber($tablebody, $kolombody++, $data->tahun);
		    xlsWriteLabel($tablebody, $kolombody++, $data->status);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=survey.doc");

        $data = array(
            'survey_data' => $this->Survey_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('survey/survey_doc',$data);
    }

}

/* End of file Survey.php */
/* Location: ./application/controllers/Survey.php */
/* Please DO NOT modify this information : */
/* This file generated by Andre Bhaskoro (+62 82 333 817 317) At : 2016-09-29 10:59:24 */
/* http://bhas.web.id */