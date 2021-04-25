<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T02_kelompok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T02_kelompok_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 't02_kelompok?q=' . urlencode($q);
            $config['first_url'] = base_url() . 't02_kelompok?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 't02_kelompok';
            $config['first_url'] = base_url() . 't02_kelompok';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->T02_kelompok_model->total_rows($q);
        $t02_kelompok = $this->T02_kelompok_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            't02_kelompok_data' => $t02_kelompok,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('t02_kelompok/t02_kelompok_list', $data);
        $data['_view'] = 't02_kelompok/t02_kelompok_list';
        $data['_caption'] = 'DATA KELOMPOK <small>MATA PELAJARAN</small>';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function read($id)
    {
        $row = $this->T02_kelompok_model->get_by_id($id);
        if ($row) {
            $data = array(
				'idkelompok' => $row->idkelompok,
				'Kelompok' => $row->Kelompok,
			);
            $this->load->view('t02_kelompok/t02_kelompok_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t02_kelompok'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('t02_kelompok/create_action'),
			'idkelompok' => set_value('idkelompok'),
			'Kelompok' => set_value('Kelompok'),
		);
        // $this->load->view('t02_kelompok/t02_kelompok_form', $data);
        $data['_view'] = 't02_kelompok/t02_kelompok_form';
        $data['_caption'] = 'DATA KELOMPOK <small>MATA PELAJARAN</small>';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'Kelompok' => $this->input->post('Kelompok',TRUE),
			);
            $this->T02_kelompok_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t02_kelompok'));
        }
    }

    public function update($id)
    {
        $row = $this->T02_kelompok_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('t02_kelompok/update_action'),
				'idkelompok' => set_value('idkelompok', $row->idkelompok),
				'Kelompok' => set_value('Kelompok', $row->Kelompok),
			);
            // $this->load->view('t02_kelompok/t02_kelompok_form', $data);
            $data['_view'] = 't02_kelompok/t02_kelompok_form';
            $data['_caption'] = 'DATA KELOMPOK <small>MATA PELAJARAN</small>';
            $this->load->view('_00_dashboard/_00_dashboard_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t02_kelompok'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idkelompok', TRUE));
        } else {
            $data = array(
				'Kelompok' => $this->input->post('Kelompok',TRUE),
			);
            $this->T02_kelompok_model->update($this->input->post('idkelompok', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t02_kelompok'));
        }
    }

    public function delete($id)
    {
        $row = $this->T02_kelompok_model->get_by_id($id);

        if ($row) {
            $this->T02_kelompok_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t02_kelompok'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t02_kelompok'));
        }
    }

    public function _rules()
    {
		$this->form_validation->set_rules('Kelompok', 'kelompok', 'trim|required');
		$this->form_validation->set_rules('idkelompok', 'idkelompok', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t02_kelompok.xls";
        $judul = "t02_kelompok";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Kelompok");
		foreach ($this->T02_kelompok_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->Kelompok);
			$tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t02_kelompok.doc");
        $data = array(
            't02_kelompok_data' => $this->T02_kelompok_model->get_all(),
            'start' => 0
        );
        $this->load->view('t02_kelompok/t02_kelompok_doc',$data);
    }

}

/* End of file T02_kelompok.php */
/* Location: ./application/controllers/T02_kelompok.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-25 20:57:13 */
/* http://harviacode.com */
