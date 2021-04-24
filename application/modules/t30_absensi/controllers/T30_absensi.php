<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T30_absensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T30_absensi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 't30_absensi?q=' . urlencode($q);
            $config['first_url'] = base_url() . 't30_absensi?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 't30_absensi';
            $config['first_url'] = base_url() . 't30_absensi';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->T30_absensi_model->total_rows($q);
        $t30_absensi = $this->T30_absensi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            't30_absensi_data' => $t30_absensi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('t30_absensi/t30_absensi_list', $data);
    }

    public function read($id)
    {
        $row = $this->T30_absensi_model->get_by_id($id);
        if ($row) {
            $data = array(
				'idabsensi' => $row->idabsensi,
				'idsiswa' => $row->idsiswa,
				'S' => $row->S,
				'I' => $row->I,
				'A' => $row->A,
			);
            $this->load->view('t30_absensi/t30_absensi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t30_absensi'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('t30_absensi/create_action'),
			'idabsensi' => set_value('idabsensi'),
			'idsiswa' => set_value('idsiswa'),
			'S' => set_value('S'),
			'I' => set_value('I'),
			'A' => set_value('A'),
		);
        $this->load->view('t30_absensi/t30_absensi_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'idsiswa' => $this->input->post('idsiswa',TRUE),
				'S' => $this->input->post('S',TRUE),
				'I' => $this->input->post('I',TRUE),
				'A' => $this->input->post('A',TRUE),
			);
            $this->T30_absensi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t30_absensi'));
        }
    }

    public function update($id)
    {
        $row = $this->T30_absensi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('t30_absensi/update_action'),
				'idabsensi' => set_value('idabsensi', $row->idabsensi),
				'idsiswa' => set_value('idsiswa', $row->idsiswa),
				'S' => set_value('S', $row->S),
				'I' => set_value('I', $row->I),
				'A' => set_value('A', $row->A),
			);
            $this->load->view('t30_absensi/t30_absensi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t30_absensi'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idabsensi', TRUE));
        } else {
            $data = array(
				'idsiswa' => $this->input->post('idsiswa',TRUE),
				'S' => $this->input->post('S',TRUE),
				'I' => $this->input->post('I',TRUE),
				'A' => $this->input->post('A',TRUE),
			);
            $this->T30_absensi_model->update($this->input->post('idabsensi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t30_absensi'));
        }
    }

    public function delete($id)
    {
        $row = $this->T30_absensi_model->get_by_id($id);

        if ($row) {
            $this->T30_absensi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t30_absensi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t30_absensi'));
        }
    }

    public function _rules()
    {
		$this->form_validation->set_rules('idsiswa', 'idsiswa', 'trim|required');
		$this->form_validation->set_rules('S', 's', 'trim|required');
		$this->form_validation->set_rules('I', 'i', 'trim|required');
		$this->form_validation->set_rules('A', 'a', 'trim|required');
		$this->form_validation->set_rules('idabsensi', 'idabsensi', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t30_absensi.xls";
        $judul = "t30_absensi";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Idsiswa");
		xlsWriteLabel($tablehead, $kolomhead++, "S");
		xlsWriteLabel($tablehead, $kolomhead++, "I");
		xlsWriteLabel($tablehead, $kolomhead++, "A");
		foreach ($this->T30_absensi_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteNumber($tablebody, $kolombody++, $data->idsiswa);
			xlsWriteNumber($tablebody, $kolombody++, $data->S);
			xlsWriteNumber($tablebody, $kolombody++, $data->I);
			xlsWriteNumber($tablebody, $kolombody++, $data->A);
			$tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t30_absensi.doc");
        $data = array(
            't30_absensi_data' => $this->T30_absensi_model->get_all(),
            'start' => 0
        );
        $this->load->view('t30_absensi/t30_absensi_doc',$data);
    }

}

/* End of file T30_absensi.php */
/* Location: ./application/controllers/T30_absensi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-24 23:08:52 */
/* http://harviacode.com */