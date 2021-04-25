<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T03_mapel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T03_mapel_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 't03_mapel?q=' . urlencode($q);
            $config['first_url'] = base_url() . 't03_mapel?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 't03_mapel';
            $config['first_url'] = base_url() . 't03_mapel';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->T03_mapel_model->total_rows($q);
        $t03_mapel = $this->T03_mapel_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            't03_mapel_data' => $t03_mapel,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('t03_mapel/t03_mapel_list', $data);
        $data['_view'] = 't03_mapel/t03_mapel_list';
        $data['_caption'] = 'DATA MATA PELAJARAN';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function read($id)
    {
        $row = $this->T03_mapel_model->get_by_id($id);
        if ($row) {
            $data = array(
				'idmapel' => $row->idmapel,
				'idkelompok' => $row->idkelompok,
				'MataPelajaran' => $row->MataPelajaran,
				'SKM' => $row->SKM,
			);
            $this->load->view('t03_mapel/t03_mapel_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t03_mapel'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('t03_mapel/create_action'),
			'idmapel' => set_value('idmapel'),
			'idkelompok' => set_value('idkelompok'),
			'MataPelajaran' => set_value('MataPelajaran'),
			'SKM' => set_value('SKM'),
		);
        // $this->load->view('t03_mapel/t03_mapel_form', $data);
        $data['_view'] = 't03_mapel/t03_mapel_form';
        $data['_caption'] = 'DATA MATA PELAJARAN';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'idkelompok' => $this->input->post('idkelompok',TRUE),
				'MataPelajaran' => $this->input->post('MataPelajaran',TRUE),
				'SKM' => $this->input->post('SKM',TRUE),
			);
            $this->T03_mapel_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t03_mapel'));
        }
    }

    public function update($id)
    {
        $row = $this->T03_mapel_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('t03_mapel/update_action'),
				'idmapel' => set_value('idmapel', $row->idmapel),
				'idkelompok' => set_value('idkelompok', $row->idkelompok),
				'MataPelajaran' => set_value('MataPelajaran', $row->MataPelajaran),
				'SKM' => set_value('SKM', $row->SKM),
			);
            // $this->load->view('t03_mapel/t03_mapel_form', $data);
            $data['_view'] = 't03_mapel/t03_mapel_form';
            $data['_caption'] = 'DATA MATA PELAJARAN';
            $this->load->view('_00_dashboard/_00_dashboard_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t03_mapel'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idmapel', TRUE));
        } else {
            $data = array(
				'idkelompok' => $this->input->post('idkelompok',TRUE),
				'MataPelajaran' => $this->input->post('MataPelajaran',TRUE),
				'SKM' => $this->input->post('SKM',TRUE),
			);
            $this->T03_mapel_model->update($this->input->post('idmapel', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t03_mapel'));
        }
    }

    public function delete($id)
    {
        $row = $this->T03_mapel_model->get_by_id($id);

        if ($row) {
            $this->T03_mapel_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t03_mapel'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t03_mapel'));
        }
    }

    public function _rules()
    {
		$this->form_validation->set_rules('idkelompok', 'idkelompok', 'trim|required');
		$this->form_validation->set_rules('MataPelajaran', 'matapelajaran', 'trim|required');
		$this->form_validation->set_rules('SKM', 'skm', 'trim|required');
		$this->form_validation->set_rules('idmapel', 'idmapel', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t03_mapel.xls";
        $judul = "t03_mapel";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Idkelompok");
		xlsWriteLabel($tablehead, $kolomhead++, "MataPelajaran");
		xlsWriteLabel($tablehead, $kolomhead++, "SKM");
		foreach ($this->T03_mapel_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteNumber($tablebody, $kolombody++, $data->idkelompok);
			xlsWriteLabel($tablebody, $kolombody++, $data->MataPelajaran);
			xlsWriteLabel($tablebody, $kolombody++, $data->SKM);
			$tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t03_mapel.doc");
        $data = array(
            't03_mapel_data' => $this->T03_mapel_model->get_all(),
            'start' => 0
        );
        $this->load->view('t03_mapel/t03_mapel_doc',$data);
    }

}

/* End of file T03_mapel.php */
/* Location: ./application/controllers/T03_mapel.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-25 21:19:04 */
/* http://harviacode.com */
