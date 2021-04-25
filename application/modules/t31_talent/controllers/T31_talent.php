<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T31_talent extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T31_talent_model');
        $this->load->library('form_validation');

        $this->load->model('t01_talent/T01_talent_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 't31_talent?q=' . urlencode($q);
            $config['first_url'] = base_url() . 't31_talent?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 't31_talent';
            $config['first_url'] = base_url() . 't31_talent';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->T31_talent_model->total_rows($q);
        $t31_talent = $this->T31_talent_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            't31_talent_data' => $t31_talent,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('t31_talent/t31_talent_list', $data);
        $data['_view'] = 't31_talent/t31_talent_list';
        $data['_caption'] = 'Data Talent\'s Day';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function read($id)
    {
        $row = $this->T31_talent_model->get_by_id($id);
        if ($row) {
            $data = array(
				'idtalenttr' => $row->idtalenttr,
				'idsiswa' => $row->idsiswa,
				'TalentNilai' => $row->TalentNilai,
			);
            $this->load->view('t31_talent/t31_talent_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t31_talent'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('t31_talent/create_action'),
			'idtalenttr' => set_value('idtalenttr'),
			'idsiswa' => set_value('idsiswa'),
			'TalentNilai' => set_value('TalentNilai'),
		);
        // $this->load->view('t31_talent/t31_talent_form', $data);
        $data['_view'] = 't31_talent/t31_talent_form';
        $data['_caption'] = 'Data Talent\'s Day';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'idsiswa' => $this->input->post('idsiswa',TRUE),
				'TalentNilai' => $this->input->post('TalentNilai',TRUE),
			);
            $this->T31_talent_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t31_talent'));
        }
    }

    public function update($id)
    {
        $row = $this->T31_talent_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('t31_talent/update_action'),
				'idtalenttr' => set_value('idtalenttr', $row->idtalenttr),
				'idsiswa' => set_value('idsiswa', $row->idsiswa),
				'TalentNilai' => set_value('TalentNilai', $row->TalentNilai),
			);
            // $this->load->view('t31_talent/t31_talent_form', $data);
            $data['_view'] = 't31_talent/t31_talent_form';
            $data['_caption'] = 'Data Talent\'s Day';
            $this->load->view('_00_dashboard/_00_dashboard_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t31_talent'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idtalenttr', TRUE));
        } else {
            $data = array(
				'idsiswa' => $this->input->post('idsiswa',TRUE),
				'TalentNilai' => $this->input->post('TalentNilai',TRUE),
			);
            $this->T31_talent_model->update($this->input->post('idtalenttr', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t31_talent'));
        }
    }

    public function delete($id)
    {
        $row = $this->T31_talent_model->get_by_id($id);

        if ($row) {
            $this->T31_talent_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t31_talent'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t31_talent'));
        }
    }

    public function _rules()
    {
		$this->form_validation->set_rules('idsiswa', 'idsiswa', 'trim|required');
		$this->form_validation->set_rules('TalentNilai', 'talentnilai', 'trim|required');
		$this->form_validation->set_rules('idtalenttr', 'idtalenttr', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t31_talent.xls";
        $judul = "t31_talent";
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
		xlsWriteLabel($tablehead, $kolomhead++, "TalentNilai");
		foreach ($this->T31_talent_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteNumber($tablebody, $kolombody++, $data->idsiswa);
			xlsWriteLabel($tablebody, $kolombody++, $data->TalentNilai);
			$tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t31_talent.doc");
        $data = array(
            't31_talent_data' => $this->T31_talent_model->get_all(),
            'start' => 0
        );
        $this->load->view('t31_talent/t31_talent_doc',$data);
    }

    public function sinkronisasi()
    {
        /**
         * ambil data setup talent
         */
        $dataSetupTalent = $this->T01_talent_model->get_all();

        /**
         * ambil data talent's day
         */
        $dataTalentDay = $this->T31_talent_model->get_all();

        /**
         * looping semua data talent's day untuk disempurnakan data talent-nilai nya
         */
        foreach($dataTalentDay as $data) {

            if ($data->TalentNilai == "") { // jika data talent-nilai masih kosong
                /**
                 * looping data setup talent
                 */
                foreach ($dataSetupTalent as $dataSetupTalentObj) {
                    $dataTalentNilai[] = [
                        'Talent' => $dataSetupTalentObj->Talent,
                        'Nilai' => '',
                    ];
                }

                /**
                 * update data di tabel talent's day
                 */
                $dataUpdate = [
                    'TalentNilai' => serialize($dataTalentNilai),
                ];
                $this->T31_talent_model->update($data->idtalenttr, $dataUpdate);
            } else { // jika data talent-nilai sudah terisi

            }

        }
    }

}

/* End of file T31_talent.php */
/* Location: ./application/controllers/T31_talent.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-25 02:47:28 */
/* http://harviacode.com */
