<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Survey_detail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Survey_detail_model');
        $this->load->model('Survey_model');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {

        $survey_detail = $this->Survey_detail_model->get_all();
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Survey_detail', '/survey_detail');

        $data = array(
            'title'       => 'Survey_detail' ,
            'content'     => 'survey_detail/survey_detail_list', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
            
            'survey_detail_data' => $survey_detail
        );

        $this->load->view('layout/layout', $data);
    }

    public function read($id) 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Survey_detail', '/survey_detail');
        $this->breadcrumbs->push('detail', '/survey_detail/read');
        $row = $this->Survey_detail_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title'       => 'Survey_detail' ,
                'content'     => 'survey_detail/survey_detail_read', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,
                
				'id_survey_detail' => $row->id_survey_detail,
				'id_survey' => $row->id_survey,
				'id_user' => $row->id_user,
				'nama_desa' => $row->nama_desa,
				'lokasi_kekeringan' => $row->lokasi_kekeringan,
				'k1' => $row->k1,
				'k2' => $row->k2,
				'k3' => $row->k3,
				'k4' => $row->k4,
				'k5' => $row->k5,
				'k6' => $row->k6,
			);
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('survey_detail'));
        }
    }

    public function create($id_survey='') 
    {
        $survey    = $this->Survey_model->get_by_id($id_survey);
        $user      = $this->ion_auth->user()->row();
        $kab_kota  =  $this->Survey_model->get_nama_kab($survey->id_kab_kota)->name;
        $kecamatan = $this->Survey_model->get_nama_kec($survey->id_kecamatan)->name;
        $desa = $this->Survey_model->get_desa_by_kec_id_survey($survey->id_kecamatan,$id_survey);

        if ($this->ion_auth->is_admin()) {
            $this->breadcrumbs->push('Survey_detail', '/survey_detail');
            $this->breadcrumbs->push('tambah', '/survey_detail/create');
        } else {
            $this->breadcrumbs->push('Survey', '/survey');
            $this->breadcrumbs->push($kab_kota.' , '.$kecamatan, '/survey_detail/create/'.$id_survey);
            $this->breadcrumbs->push('Form Data Survey', '/survey_detail/create');
        }
        
        $data = array(
            'title'       => 'Survey_detail' ,
            'content'     => 'survey_detail/survey_detail_form', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
            'survey'      => $survey ,
            'desa'        => $desa ,

            'button' => 'Tambah',
            'action' => site_url('survey_detail/create_action/'.$id_survey),
		    'id_survey_detail' => set_value('id_survey_detail'),
		    'id_survey' => $id_survey,
		    'nama_desa' => set_value('nama_desa'),
		    'lokasi_kekeringan' => set_value('lokasi_kekeringan'),
		    'k1' => set_value('k1'),
		    'k2' => set_value('k2'),
		    'k3' => set_value('k3'),
		    'k4' => set_value('k4'),
		    'k5' => set_value('k5'),
		    'k6' => set_value('k6'),
		);
        $this->load->view('layout/layout', $data);
    }
    
    public function create_action($id_survey='') 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create($id_survey);
        } else {
            $user = $this->ion_auth->user()->row();
            $data = array(
				'id_survey' => $this->input->post('id_survey',TRUE),
				'id_user' => $user->id,
				'nama_desa' => $this->input->post('nama_desa',TRUE),
				'lokasi_kekeringan' => $this->input->post('rt',TRUE)." ".$this->input->post('rw',TRUE),
				'k1' => $this->input->post('k1',TRUE),
				'k2' => $this->input->post('k2',TRUE),
				'k3' => $this->input->post('k3',TRUE),
				'k4' => $this->input->post('k4',TRUE),
				'k5' => $this->input->post('k5',TRUE),
				'k6' => $this->input->post('k6',TRUE),
		    );

            $this->Survey_detail_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('survey'));
        }
    }
    
    public function update($id) 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Survey_detail', '/survey_detail');
        $this->breadcrumbs->push('update', '/survey_detail/update');
        
        $row = $this->Survey_detail_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title'       => 'Survey_detail' ,
                'content'     => 'survey_detail/survey_detail_form', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,

                'button' => 'Update',
                'action' => site_url('survey_detail/update_action'),
				'id_survey_detail' => set_value('id_survey_detail', $row->id_survey_detail),
				'id_survey' => set_value('id_survey', $row->id_survey),
				'id_user' => set_value('id_user', $row->id_user),
				'nama_desa' => set_value('nama_desa', $row->nama_desa),
				'lokasi_kekeringan' => set_value('lokasi_kekeringan', $row->lokasi_kekeringan),
				'k1' => set_value('k1', $row->k1),
				'k2' => set_value('k2', $row->k2),
				'k3' => set_value('k3', $row->k3),
				'k4' => set_value('k4', $row->k4),
				'k5' => set_value('k5', $row->k5),
				'k6' => set_value('k6', $row->k6),
		    );
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('survey_detail'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_survey_detail', TRUE));
        } else {
            $data = array(
				'id_survey' => $this->input->post('id_survey',TRUE),
				'id_user' => $this->input->post('id_user',TRUE),
				'nama_desa' => $this->input->post('nama_desa',TRUE),
				'lokasi_kekeringan' => $this->input->post('lokasi_kekeringan',TRUE),
				'k1' => $this->input->post('k1',TRUE),
				'k2' => $this->input->post('k2',TRUE),
				'k3' => $this->input->post('k3',TRUE),
				'k4' => $this->input->post('k4',TRUE),
				'k5' => $this->input->post('k5',TRUE),
				'k6' => $this->input->post('k6',TRUE),
		    );

            $this->Survey_detail_model->update($this->input->post('id_survey_detail', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('survey_detail'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Survey_detail_model->get_by_id($id);

        if ($row) {
            $this->Survey_detail_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('survey_detail'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('survey_detail'));
        }
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('id_survey', 'id survey', 'trim|required');
		$this->form_validation->set_rules('nama_desa', 'nama desa', 'trim|required');
		//$this->form_validation->set_rules('lokasi_kekeringan', 'lokasi kekeringan', 'trim|required');
		$this->form_validation->set_rules('k1', 'k1', 'trim|required');
		$this->form_validation->set_rules('k2', 'k2', 'trim|required');
		$this->form_validation->set_rules('k3', 'k3', 'trim|required');
		$this->form_validation->set_rules('k4', 'k4', 'trim|required');
		$this->form_validation->set_rules('k5', 'k5', 'trim|required');
		$this->form_validation->set_rules('k6', 'k6', 'trim|required');

		$this->form_validation->set_rules('id_survey_detail', 'id_survey_detail', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "survey_detail.xls";
        $judul = "survey_detail";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Id Survey");
		xlsWriteLabel($tablehead, $kolomhead++, "Id User");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Desa");
		xlsWriteLabel($tablehead, $kolomhead++, "Lokasi Kekeringan");
		xlsWriteLabel($tablehead, $kolomhead++, "K1");
		xlsWriteLabel($tablehead, $kolomhead++, "K2");
		xlsWriteLabel($tablehead, $kolomhead++, "K3");
		xlsWriteLabel($tablehead, $kolomhead++, "K4");
		xlsWriteLabel($tablehead, $kolomhead++, "K5");
		xlsWriteLabel($tablehead, $kolomhead++, "K6");

		foreach ($this->Survey_detail_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteNumber($tablebody, $kolombody++, $data->id_survey);
		    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
		    xlsWriteNumber($tablebody, $kolombody++, $data->nama_desa);
		    xlsWriteNumber($tablebody, $kolombody++, $data->lokasi_kekeringan);
		    xlsWriteNumber($tablebody, $kolombody++, $data->k1);
		    xlsWriteNumber($tablebody, $kolombody++, $data->k2);
		    xlsWriteNumber($tablebody, $kolombody++, $data->k3);
		    xlsWriteNumber($tablebody, $kolombody++, $data->k4);
		    xlsWriteNumber($tablebody, $kolombody++, $data->k5);
		    xlsWriteNumber($tablebody, $kolombody++, $data->k6);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=survey_detail.doc");

        $data = array(
            'survey_detail_data' => $this->Survey_detail_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('survey_detail/survey_detail_doc',$data);
    }

}

/* End of file Survey_detail.php */
/* Location: ./application/controllers/Survey_detail.php */
/* Please DO NOT modify this information : */
/* This file generated by Andre Bhaskoro (+62 82 333 817 317) At : 2016-09-30 16:32:13 */
/* http://bhas.web.id */