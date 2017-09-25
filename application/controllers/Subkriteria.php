<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Subkriteria extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Subkriteria_model');
        $this->load->model('Kriteria_model');
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        $subkriteria = $this->Subkriteria_model->get_all();
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Subkriteria', '/subkriteria');

        $data = array(
            'title'       => 'Subkriteria' ,
            'content'     => 'subkriteria/subkriteria_list', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
             'kriteria'    => '' ,
            'subkriteria_data' => $subkriteria
        );

        $this->load->view('layout/layout', $data);
    }

    public function detail($id_kriteria)
    {
        $kriteria = $this->Kriteria_model->get_by_id($id_kriteria);
        $subkriteria = $this->Subkriteria_model->get_by_id_kriteria($id_kriteria);
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Kriteria', '/kriteria');
        $this->breadcrumbs->push($kriteria->nama_kriteria, '/subkriteria');
        $data = array(
            'title'       => 'Subkriteria' ,
            'content'     => 'subkriteria/subkriteria_list', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
            'kriteria'    => $kriteria ,

            'subkriteria_data' => $subkriteria
        );

        $this->load->view('layout/layout', $data);
    }

    public function read($id) 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Subkriteria', '/subkriteria');
        $this->breadcrumbs->push('detail', '/subkriteria/read');
        $row = $this->Subkriteria_model->get_by_id($id);
        if ($row) {
            $kriteria = $this->Kriteria_model->get_by_id($row->id_kriteria);
            $data = array(
                'title'       => 'Subkriteria' ,
                'content'     => 'subkriteria/subkriteria_read', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,
                'kriteria'    => $kriteria ,
                
				'id_subkriteria' => $row->id_subkriteria,
				'id_kriteria' => $row->id_kriteria,
				'nama_subkriteria' => $row->nama_subkriteria,
				'bobot_subkriteria_persen' => $row->bobot_subkriteria_persen,
				'bobot_subkriteria' => $row->bobot_subkriteria,
				'w' => $row->w,
			);
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subkriteria'));
        }
    }

    public function create($id_kriteria='') 
    {
        $kriteria = $this->Kriteria_model->get_by_id($id_kriteria);
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Kriteria', '/kriteria');
        $this->breadcrumbs->push($kriteria->nama_kriteria, '/subkriteria/detail/'.$kriteria->id_kriteria);
        $this->breadcrumbs->push('tambah', '/subkriteria/create');
        $data = array(
            'title'       => 'Subkriteria' ,
            'content'     => 'subkriteria/subkriteria_form', 
            'breadcrumbs' => $this->breadcrumbs->show(),
            'user'        => $user ,
            'kriteria'    => $kriteria ,

            'button' => 'Tambah',
            'action' => site_url('subkriteria/create_action/'.$id_kriteria),
		    'id_subkriteria' => set_value('id_subkriteria'),
		    'id_kriteria' => $kriteria->id_kriteria,
		    'nama_subkriteria' => set_value('nama_subkriteria'),
		    'bobot_subkriteria_persen' => set_value('bobot_subkriteria_persen'),
		    'bobot_subkriteria' => set_value('bobot_subkriteria'),
		    'w' => set_value('w'),
		);
        $this->load->view('layout/layout', $data);
    }
    
    public function create_action($id_kriteria='') 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create($id_kriteria);
        } else {
            $data = array(
				'id_kriteria' => $this->input->post('id_kriteria',TRUE),
				'nama_subkriteria' => $this->input->post('nama_subkriteria',TRUE),
				'bobot_subkriteria_persen' => $this->input->post('bobot_subkriteria_persen',TRUE),
				'bobot_subkriteria' => $this->input->post('bobot_subkriteria',TRUE),
				'w' => $this->input->post('w',TRUE),
		    );

            $this->Subkriteria_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('subkriteria/detail/'.$id_kriteria));
        }
    }
    
    public function update($id) 
    {
        $user = $this->ion_auth->user()->row();
        $this->breadcrumbs->push('Subkriteria', '/subkriteria');
        $this->breadcrumbs->push('update', '/subkriteria/update');
        
        $row = $this->Subkriteria_model->get_by_id($id);
        if ($row) {
            $kriteria = $this->Kriteria_model->get_by_id($row->id_kriteria);
            $data = array(
                'title'       => 'Subkriteria' ,
                'content'     => 'subkriteria/subkriteria_form', 
                'breadcrumbs' => $this->breadcrumbs->show(),
                'user'        => $user ,
                'kriteria'    => $kriteria ,

                'button' => 'Update',
                'action' => site_url('subkriteria/update_action'),
				'id_subkriteria' => set_value('id_subkriteria', $row->id_subkriteria),
				'id_kriteria' => set_value('id_kriteria', $row->id_kriteria),
				'nama_subkriteria' => set_value('nama_subkriteria', $row->nama_subkriteria),
				'bobot_subkriteria_persen' => set_value('bobot_subkriteria_persen', $row->bobot_subkriteria_persen),
				'bobot_subkriteria' => set_value('bobot_subkriteria', $row->bobot_subkriteria),
				'w' => set_value('w', $row->w),
		    );
            $this->load->view('layout/layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subkriteria/detail/'.$row->id_kriteria));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_subkriteria', TRUE));
        } else {
            $data = array(
				'id_kriteria' => $this->input->post('id_kriteria',TRUE),
				'nama_subkriteria' => $this->input->post('nama_subkriteria',TRUE),
				'bobot_subkriteria_persen' => $this->input->post('bobot_subkriteria_persen',TRUE),
				'bobot_subkriteria' => $this->input->post('bobot_subkriteria',TRUE),
				'w' => $this->input->post('w',TRUE),
		    );

            $this->Subkriteria_model->update($this->input->post('id_subkriteria', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('subkriteria/detail/'.$this->input->post('id_kriteria',TRUE)));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Subkriteria_model->get_by_id($id);

        if ($row) {
            $this->Subkriteria_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('subkriteria'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('subkriteria/detail/'.$row->id_kriteria));
        }
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('id_kriteria', 'id kriteria', 'trim|required');
		$this->form_validation->set_rules('nama_subkriteria', 'nama subkriteria', 'trim|required');
		$this->form_validation->set_rules('bobot_subkriteria_persen', 'bobot subkriteria persen', 'trim|required');
		$this->form_validation->set_rules('bobot_subkriteria', 'bobot subkriteria', 'trim|required|numeric');
		$this->form_validation->set_rules('w', 'w', 'trim|required|numeric');

		$this->form_validation->set_rules('id_subkriteria', 'id_subkriteria', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "subkriteria.xls";
        $judul = "subkriteria";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Id Kriteria");
		xlsWriteLabel($tablehead, $kolomhead++, "Nama Subkriteria");
		xlsWriteLabel($tablehead, $kolomhead++, "Bobot Subkriteria Persen");
		xlsWriteLabel($tablehead, $kolomhead++, "Bobot Subkriteria");
		xlsWriteLabel($tablehead, $kolomhead++, "W");

		foreach ($this->Subkriteria_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
		    xlsWriteNumber($tablebody, $kolombody++, $data->id_kriteria);
		    xlsWriteLabel($tablebody, $kolombody++, $data->nama_subkriteria);
		    xlsWriteNumber($tablebody, $kolombody++, $data->bobot_subkriteria_persen);
		    xlsWriteNumber($tablebody, $kolombody++, $data->bobot_subkriteria);
		    xlsWriteNumber($tablebody, $kolombody++, $data->w);

		    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=subkriteria.doc");

        $data = array(
            'subkriteria_data' => $this->Subkriteria_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('subkriteria/subkriteria_doc',$data);
    }

}

/* End of file Subkriteria.php */
/* Location: ./application/controllers/Subkriteria.php */
/* Please DO NOT modify this information : */
/* This file generated by Andre Bhaskoro (+62 82 333 817 317) At : 2016-09-30 10:53:48 */
/* http://bhas.web.id */