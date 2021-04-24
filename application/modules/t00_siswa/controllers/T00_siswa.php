<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T00_siswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T00_siswa_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 't00_siswa?q=' . urlencode($q);
            $config['first_url'] = base_url() . 't00_siswa?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 't00_siswa';
            $config['first_url'] = base_url() . 't00_siswa';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->T00_siswa_model->total_rows($q);
        $t00_siswa = $this->T00_siswa_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            't00_siswa_data' => $t00_siswa,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('t00_siswa/t00_siswa_list', $data);
        $data['_view'] = 't00_siswa/t00_siswa_list';
        $data['_caption'] = 'DATA SISWA';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function read($id)
    {
        $row = $this->T00_siswa_model->get_by_id($id);
        if ($row) {
            $data = array(
				'idsiswa' => $row->idsiswa,
				'Nama' => $row->Nama,
			);
            $this->load->view('t00_siswa/t00_siswa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t00_siswa'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('t00_siswa/create_action'),
			'idsiswa' => set_value('idsiswa'),
			'Nama' => set_value('Nama'),
		);
        // $this->load->view('t00_siswa/t00_siswa_form', $data);
        $data['_view'] = 't00_siswa/t00_siswa_form';
        $data['_caption'] = 'DATA SISWA';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'Nama' => $this->input->post('Nama',TRUE),
			);
            $this->T00_siswa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t00_siswa'));
        }
    }

    public function update($id)
    {
        $row = $this->T00_siswa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('t00_siswa/update_action'),
				'idsiswa' => set_value('idsiswa', $row->idsiswa),
				'Nama' => set_value('Nama', $row->Nama),
			);
            // $this->load->view('t00_siswa/t00_siswa_form', $data);
            $data['_view'] = 't00_siswa/t00_siswa_form';
            $data['_caption'] = 'DATA SISWA';
            $this->load->view('_00_dashboard/_00_dashboard_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t00_siswa'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idsiswa', TRUE));
        } else {
            $data = array(
				'Nama' => $this->input->post('Nama',TRUE),
			);
            $this->T00_siswa_model->update($this->input->post('idsiswa', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t00_siswa'));
        }
    }

    public function delete($id)
    {
        $row = $this->T00_siswa_model->get_by_id($id);

        if ($row) {
            $this->T00_siswa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t00_siswa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t00_siswa'));
        }
    }

    public function _rules()
    {
		$this->form_validation->set_rules('Nama', 'nama', 'trim|required');
		$this->form_validation->set_rules('idsiswa', 'idsiswa', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t00_siswa.xls";
        $judul = "t00_siswa";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Nama");
		foreach ($this->T00_siswa_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteLabel($tablebody, $kolombody++, $data->Nama);
			$tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t00_siswa.doc");
        $data = array(
            't00_siswa_data' => $this->T00_siswa_model->get_all(),
            'start' => 0
        );
        $this->load->view('t00_siswa/t00_siswa_doc',$data);
    }

}

/* End of file T00_siswa.php */
/* Location: ./application/controllers/T00_siswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-24 23:08:39 */
/* http://harviacode.com */
