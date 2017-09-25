<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kriteria extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kriteria_model');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $kriteria = $this->Kriteria_model->get_all();
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Kriteria', '/kriteria');

        $data = array(
            'title'       => 'Kriteria' ,
            'content'     => 'kriteria/kriteria_list', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
            
            'kriteria_data' => $kriteria
        );

        $this->load->view('layout/layout', $data);
    }

    public function read($id) 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Kriteria', '/kriteria');
        $this->breadcrumbs->push('detail', '/kriteria/read');
        $row = $this->Kriteria_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title'       => 'Kriteria' ,
                'content'     => 'kriteria/kriteria_read', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,
                
				'id_kriteria' => $row->id_kriteria,
				'nama_kriteria' => $row->nama_kriteria,
				'bobot_kriteria' => $row->bobot_kriteria,
				'bobot_kriteria_persen' => $row->bobot_kriteria_persen,
			);
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kriteria'));
        }
    }

    public function create() 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Kriteria', '/kriteria');
        $this->breadcrumbs->push('tambah', '/kriteria/create');
        $data = array(
            'title'       => 'Kriteria' ,
            'content'     => 'kriteria/kriteria_form', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,

            'button' => 'Tambah',
            'action' => site_url('kriteria/create_action'),
		    'id_kriteria' => set_value('id_kriteria'),
		    'nama_kriteria' => set_value('nama_kriteria'),
		    'bobot_kriteria' => set_value('bobot_kriteria'),
		    'bobot_kriteria_persen' => set_value('bobot_kriteria_persen'),
		);
        $this->load->view('layout/layout', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'nama_kriteria' => $this->input->post('nama_kriteria',TRUE),
				'bobot_kriteria' => $this->input->post('bobot_kriteria',TRUE),
				'bobot_kriteria_persen' => $this->input->post('bobot_kriteria_persen',TRUE),
		    );

            $this->Kriteria_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kriteria'));
        }
    }
    
    public function update($id) 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Kriteria', '/kriteria');
        $this->breadcrumbs->push('update', '/kriteria/update');
        
        $row = $this->Kriteria_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title'       => 'Kriteria' ,
                'content'     => 'kriteria/kriteria_form', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,

                'button' => 'Update',
                'action' => site_url('kriteria/update_action'),
				'id_kriteria' => set_value('id_kriteria', $row->id_kriteria),
				'nama_kriteria' => set_value('nama_kriteria', $row->nama_kriteria),
				'bobot_kriteria' => set_value('bobot_kriteria', $row->bobot_kriteria),
				'bobot_kriteria_persen' => set_value('bobot_kriteria_persen', $row->bobot_kriteria_persen),
		    );
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kriteria'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kriteria', TRUE));
        } else {
            $data = array(
				'nama_kriteria' => $this->input->post('nama_kriteria',TRUE),
				'bobot_kriteria' => $this->input->post('bobot_kriteria',TRUE),
				'bobot_kriteria_persen' => $this->input->post('bobot_kriteria_persen',TRUE),
		    );

            $this->Kriteria_model->update($this->input->post('id_kriteria', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kriteria'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kriteria_model->get_by_id($id);

        if ($row) {
            $this->Kriteria_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kriteria'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kriteria'));
        }
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('nama_kriteria', 'nama kriteria', 'trim|required');
		$this->form_validation->set_rules('bobot_kriteria', 'bobot kriteria', 'trim|required|numeric');
		$this->form_validation->set_rules('bobot_kriteria_persen', 'bobot kriteria persen', 'trim|required');

		$this->form_validation->set_rules('id_kriteria', 'id_kriteria', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kriteria.xls";
        $judul = "kriteria";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Kriteria");
		xlsWriteLabel($tablehead, $kolomhead++, "Bobot Kriteria");
		xlsWriteLabel($tablehead, $kolomhead++, "Bobot Kriteria Persen");

		foreach ($this->Kriteria_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteLabel($tablebody, $kolombody++, $data->nama_kriteria);
		    xlsWriteNumber($tablebody, $kolombody++, $data->bobot_kriteria);
		    xlsWriteNumber($tablebody, $kolombody++, $data->bobot_kriteria_persen);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=kriteria.doc");

        $data = array(
            'kriteria_data' => $this->Kriteria_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('kriteria/kriteria_doc',$data);
    }

}

/* End of file Kriteria.php */
/* Location: ./application/controllers/Kriteria.php */
/* Please DO NOT modify this information : */
/* This file generated by Andre Bhaskoro (+62 82 333 817 317) At : 2016-09-30 04:15:35 */
/* http://bhas.web.id */