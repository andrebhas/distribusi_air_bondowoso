<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subsubkriteria extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Subsubkriteria_model');
        $this->load->model('Subkriteria_model');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $subsubkriteria = $this->Subsubkriteria_model->get_all();
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Subsubkriteria', '/subsubkriteria');

        $data = array(
            'title'       => 'Subsubkriteria' ,
            'content'     => 'subsubkriteria/subsubkriteria_list', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
            'subkriteria' => '',
            'subsubkriteria_data' => $subsubkriteria
        );

        $this->load->view('layout/layout', $data);
    }

    public function detail($id_subkriteria='')
    {
        $subkriteria = $this->Subkriteria_model->get_by_id($id_subkriteria);
        $subsubkriteria = $this->Subsubkriteria_model->get_by_id_sub($id_subkriteria);
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Subkriteria', '/subkriteria');
        $this->breadcrumbs->push($subkriteria->nama_subkriteria, '/subkriteria/detail/'.$id_subkriteria);

        $data = array(
            'title'       => 'Subsubkriteria' ,
            'content'     => 'subsubkriteria/subsubkriteria_list', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
            'subkriteria' => $subkriteria ,
            'subsubkriteria_data' => $subsubkriteria
        );

        $this->load->view('layout/layout', $data);
    }

    public function read($id) 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Subsubkriteria', '/subsubkriteria');
        $this->breadcrumbs->push('detail', '/subsubkriteria/read');
        $row = $this->Subsubkriteria_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title'       => 'Subsubkriteria' ,
                'content'     => 'subsubkriteria/subsubkriteria_read', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,
                
				'id_subsubkriteria' => $row->id_subsubkriteria,
				'id_subkriteria' => $row->id_subkriteria,
				'deskripsi' => $row->deskripsi,
				'nilai' => $row->nilai,
			);
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subsubkriteria'));
        }
    }

    public function create($id_subkriteria='') 
    {
        $subkriteria = $this->Subkriteria_model->get_by_id($id_subkriteria);
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Subsubkriteria', '/subsubkriteria');
        $this->breadcrumbs->push($subkriteria->nama_subkriteria, '/subkriteria/detail/'.$id_subkriteria);
        $this->breadcrumbs->push('tambah', '/subsubkriteria/create');
        $data = array(
            'title'       => 'Subsubkriteria' ,
            'content'     => 'subsubkriteria/subsubkriteria_form', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
            'subkriteria' => $subkriteria ,
            'button' => 'Tambah',
            'action' => site_url('subsubkriteria/create_action/'.$id_subkriteria),
		    'id_subsubkriteria' => set_value('id_subsubkriteria'),
		    'id_subkriteria' => set_value('id_subkriteria'),
		    'deskripsi' => set_value('deskripsi'),
		    'nilai' => set_value('nilai'),
		);
        $this->load->view('layout/layout', $data);
    }
    
    public function create_action($id_subkriteria='') 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create($id_subkriteria);
        } else {
            $data = array(
				'id_subkriteria' => $this->input->post('id_subkriteria',TRUE),
				'deskripsi' => $this->input->post('deskripsi',TRUE),
				'nilai' => $this->input->post('nilai',TRUE),
		    );

            $this->Subsubkriteria_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(base_url('subsubkriteria/detail/'.$id_subkriteria));
        }
    }
    
    public function update($id) 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Subsubkriteria', '/subsubkriteria');
        $this->breadcrumbs->push('update', '/subsubkriteria/update');
        
        $row = $this->Subsubkriteria_model->get_by_id($id);
        if ($row) {
            $subkriteria = $this->Subkriteria_model->get_by_id($row->id_subkriteria);
            $data = array(
                'title'       => 'Subsubkriteria' ,
                'content'     => 'subsubkriteria/subsubkriteria_form', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,
                'subkriteria' => $subkriteria ,
                'button' => 'Update',
                'action' => site_url('subsubkriteria/update_action'),
				'id_subsubkriteria' => set_value('id_subsubkriteria', $row->id_subsubkriteria),
				'id_subkriteria' => set_value('id_subkriteria', $row->id_subkriteria),
				'deskripsi' => set_value('deskripsi', $row->deskripsi),
				'nilai' => set_value('nilai', $row->nilai),
		    );
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(base_url('subsubkriteria'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_subsubkriteria', TRUE));
        } else {
            $data = array(
				'id_subkriteria' => $this->input->post('id_subkriteria',TRUE),
				'deskripsi' => $this->input->post('deskripsi',TRUE),
				'nilai' => $this->input->post('nilai',TRUE),
		    );

            $this->Subsubkriteria_model->update($this->input->post('id_subsubkriteria', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('subsubkriteria/detail/'.$this->input->post('id_subkriteria',TRUE)));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Subsubkriteria_model->get_by_id($id);

        if ($row) {
            $this->Subsubkriteria_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('subsubkriteria'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subsubkriteria'));
        }
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('id_subkriteria', 'id subkriteria', 'trim|required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
		$this->form_validation->set_rules('nilai', 'nilai', 'trim|required');

		$this->form_validation->set_rules('id_subsubkriteria', 'id_subsubkriteria', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "subsubkriteria.xls";
        $judul = "subsubkriteria";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Id Subkriteria");
		xlsWriteLabel($tablehead, $kolomhead++, "Deskripsi");
		xlsWriteLabel($tablehead, $kolomhead++, "Nilai");

		foreach ($this->Subsubkriteria_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteNumber($tablebody, $kolombody++, $data->id_subkriteria);
		    xlsWriteLabel($tablebody, $kolombody++, $data->deskripsi);
		    xlsWriteNumber($tablebody, $kolombody++, $data->nilai);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=subsubkriteria.doc");

        $data = array(
            'subsubkriteria_data' => $this->Subsubkriteria_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('subsubkriteria/subsubkriteria_doc',$data);
    }

}

/* End of file Subsubkriteria.php */
/* Location: ./application/controllers/Subsubkriteria.php */
/* Please DO NOT modify this information : */
/* This file generated by Andre Bhaskoro (+62 82 333 817 317) At : 2016-09-30 13:41:25 */
/* http://bhas.web.id */