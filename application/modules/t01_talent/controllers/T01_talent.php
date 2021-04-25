<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T01_talent extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T01_talent_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 't01_talent?q=' . urlencode($q);
            $config['first_url'] = base_url() . 't01_talent?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 't01_talent';
            $config['first_url'] = base_url() . 't01_talent';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->T01_talent_model->total_rows($q);
        $t01_talent = $this->T01_talent_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            't01_talent_data' => $t01_talent,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('t01_talent/t01_talent_list', $data);
        $data['_view'] = 't01_talent/t01_talent_list';
        $data['_caption'] = 'Data Talent';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function read($id)
    {
        $row = $this->T01_talent_model->get_by_id($id);
        if ($row) {
            $data = array(
				'idtalent' => $row->idtalent,
				'Talent' => $row->Talent,
			);
            $this->load->view('t01_talent/t01_talent_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t01_talent'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('t01_talent/create_action'),
			'idtalent' => set_value('idtalent'),
			'Talent' => set_value('Talent'),
		);
        // $this->load->view('t01_talent/t01_talent_form', $data);
        $data['_view'] = 't01_talent/t01_talent_form';
        $data['_caption'] = 'Data Talent';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'Talent' => $this->input->post('Talent',TRUE),
			);
            $this->T01_talent_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t01_talent'));
        }
    }

    public function update($id)
    {
        $row = $this->T01_talent_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('t01_talent/update_action'),
				'idtalent' => set_value('idtalent', $row->idtalent),
				'Talent' => set_value('Talent', $row->Talent),
			);
            // $this->load->view('t01_talent/t01_talent_form', $data);
            $data['_view'] = 't01_talent/t01_talent_form';
            $data['_caption'] = 'Data Talent';
            $this->load->view('_00_dashboard/_00_dashboard_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t01_talent'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idtalent', TRUE));
        } else {
            $data = array(
				'Talent' => $this->input->post('Talent',TRUE),
			);
            $this->T01_talent_model->update($this->input->post('idtalent', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t01_talent'));
        }
    }

    public function delete($id)
    {
        $row = $this->T01_talent_model->get_by_id($id);

        if ($row) {
            $this->T01_talent_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t01_talent'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t01_talent'));
        }
    }

    public function _rules()
    {
		$this->form_validation->set_rules('Talent', 'talent', 'trim|required');
		$this->form_validation->set_rules('idtalent', 'idtalent', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t01_talent.xls";
        $judul = "t01_talent";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Talent");
		foreach ($this->T01_talent_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->Talent);
			$tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t01_talent.doc");
        $data = array(
            't01_talent_data' => $this->T01_talent_model->get_all(),
            'start' => 0
        );
        $this->load->view('t01_talent/t01_talent_doc',$data);
    }

}

/* End of file T01_talent.php */
/* Location: ./application/controllers/T01_talent.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-25 02:00:22 */
/* http://harviacode.com */
