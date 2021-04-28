<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class T04_wsheet extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('T04_wsheet_model');
        $this->load->library('form_validation');
        $this->load->model('t03_mapel/T03_mapel_model');
        $this->load->model('t00_siswa/T00_siswa_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 't04_wsheet?q=' . urlencode($q);
            $config['first_url'] = base_url() . 't04_wsheet?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 't04_wsheet';
            $config['first_url'] = base_url() . 't04_wsheet';
        }

        $config['per_page'] = 1000;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->T04_wsheet_model->total_rows($q);
        $t04_wsheet = $this->T04_wsheet_model->get_limit_data($config['per_page'], $start, $q);
        $dataLastLevel = $this->T04_wsheet_model->getDataLastLevel(); //echo pre($akunLastLevel); die();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            't04_wsheet_data' => $t04_wsheet,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'dataLastLevel' => $dataLastLevel,
        );
        // $this->load->view('t04_wsheet/t04_wsheet_list', $data);
        $data['_view'] = 't04_wsheet/t04_wsheet_list';
        $data['_caption'] = 'DATA WORKSHEET';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function read($id)
    {
        $row = $this->T04_wsheet_model->get_by_id($id);
        if ($row) {
            $data = array(
				'idwsheet' => $row->idwsheet,
				'idmapel' => $row->idmapel,
				'NoUrut' => $row->NoUrut,
				'Kdasar' => $row->Kdasar,
				'induk' => $row->induk,
			);
            $this->load->view('t04_wsheet/t04_wsheet_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t04_wsheet'));
        }
    }

    public function create()
    {
        $dataMapel = $this->T03_mapel_model->get_all();
        $data = array(
            'button' => 'Simpan',
            'action' => site_url('t04_wsheet/create_action'),
			'idwsheet' => set_value('idwsheet'),
			'idmapel' => set_value('idmapel'),
			'NoUrut' => set_value('NoUrut'),
			'Kdasar' => set_value('Kdasar'),
			'induk' => set_value('induk'),
            'dataMapel' => $dataMapel,
		);
        // $this->load->view('t04_wsheet/t04_wsheet_form', $data);
        $data['_view'] = 't04_wsheet/t04_wsheet_form';
        $data['_caption'] = 'DATA WORKSHEET';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
				'idmapel' => $this->input->post('idmapel',TRUE),
				'NoUrut' => $this->input->post('NoUrut',TRUE),
				'Kdasar' => $this->input->post('Kdasar',TRUE),
				'induk' => $this->input->post('induk',TRUE),
                'urut' =>
                    substr('00' . trim($this->input->post('idmapel',TRUE)), -2)
                    . substr('00' . trim($this->input->post('NoUrut',TRUE)), -2)
                    . '00',
			);
            $this->T04_wsheet_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t04_wsheet'));
        }
    }

    public function update($id)
    {
        $row = $this->T04_wsheet_model->get_by_id($id);

        if ($row) {
            $dataMapel = $this->T03_mapel_model->get_all();
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('t04_wsheet/update_action'),
				'idwsheet' => set_value('idwsheet', $row->idwsheet),
				'idmapel' => set_value('idmapel', $row->idmapel),
				'NoUrut' => set_value('NoUrut', $row->NoUrut),
				'Kdasar' => set_value('Kdasar', $row->Kdasar),
				'induk' => set_value('induk', $row->induk),
                'dataMapel' => $dataMapel,
			);
            // $this->load->view('t04_wsheet/t04_wsheet_form', $data);
            $data['_view'] = 't04_wsheet/t04_wsheet_form';
            $data['_caption'] = 'DATA WORKSHEET';
            $this->load->view('_00_dashboard/_00_dashboard_view', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t04_wsheet'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idwsheet', TRUE));
        } else {
            $data = array(
				'idmapel' => $this->input->post('idmapel',TRUE),
				'NoUrut' => $this->input->post('NoUrut',TRUE),
				'Kdasar' => $this->input->post('Kdasar',TRUE),
				'induk' => $this->input->post('induk',TRUE),
                'urut' =>
                    substr('00' . trim($this->input->post('idmapel',TRUE)), -2)
                    . substr('00' . trim($this->input->post('NoUrut',TRUE)), -2)
                    . '00',
			);
            $this->T04_wsheet_model->update($this->input->post('idwsheet', TRUE), $data);

            /**
             * simpan kode urut baru
             */
            $urutBaru =
                substr('00' . trim($this->input->post('idmapel',TRUE)), -2)
                . substr('00' . trim($this->input->post('NoUrut',TRUE)), -2);

            /**
             * ambil data sub berdasarkan head
             */
            $dataSub = $this->T04_wsheet_model->getData($this->input->post('idwsheet', TRUE));

            /**
             * update sub-sub dengan kode urut baru, jika ada data
             */
            if ($dataSub) {
                foreach($dataSub as $d) {
                    $data = array(
                        'urut' => $urutBaru . substr($d->urut, -2),
                    );
                    $this->T04_wsheet_model->update($d->idwsheet, $data);
                }
            }

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t04_wsheet'));
        }
    }

    public function delete($id)
    {
        $row = $this->T04_wsheet_model->get_by_id($id);

        if ($row) {
            $this->T04_wsheet_model->delete($id);

            /**
             * ambil data sub berdasarkan head
             */
            $dataSub = $this->T04_wsheet_model->getData($id);

            /**
             * update sub-sub dengan kode urut baru, jika ada data
             */
            if ($dataSub) {
                foreach($dataSub as $d) {
                    $this->T04_wsheet_model->delete($d->idwsheet);
                }
            }

            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t04_wsheet'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t04_wsheet'));
        }
    }

    public function _rules()
    {
		$this->form_validation->set_rules('idmapel', 'idmapel', 'trim|required');
		$this->form_validation->set_rules('NoUrut', 'nourut', 'trim|required');
		$this->form_validation->set_rules('Kdasar', 'kdasar', 'trim|required');
		$this->form_validation->set_rules('induk', 'induk', 'trim|required');
		$this->form_validation->set_rules('idwsheet', 'idwsheet', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t04_wsheet.xls";
        $judul = "t04_wsheet";
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
		xlsWriteLabel($tablehead, $kolomhead++, "Idmapel");
		xlsWriteLabel($tablehead, $kolomhead++, "NoUrut");
		xlsWriteLabel($tablehead, $kolomhead++, "Kdasar");
		xlsWriteLabel($tablehead, $kolomhead++, "Induk");
		foreach ($this->T04_wsheet_model->get_all() as $data) {
            $kolombody = 0;
            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
			xlsWriteNumber($tablebody, $kolombody++, $data->idmapel);
			xlsWriteNumber($tablebody, $kolombody++, $data->NoUrut);
			xlsWriteLabel($tablebody, $kolombody++, $data->Kdasar);
			xlsWriteNumber($tablebody, $kolombody++, $data->induk);
			$tablebody++;
            $nourut++;
        }
        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t04_wsheet.doc");
        $data = array(
            't04_wsheet_data' => $this->T04_wsheet_model->get_all(),
            'start' => 0
        );
        $this->load->view('t04_wsheet/t04_wsheet_doc',$data);
    }

    public function createSub($id)
    {
        $row = $this->T04_wsheet_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Simpan',
                'action' => site_url('t04_wsheet/createSub_action'),
				'idwsheet' => set_value('idwsheet'),
				'idmapel' => set_value('idmapel', $row->idmapel),
				'NoUrutRO' => set_value('NoUrutRO', $row->NoUrut),
				'KdasarRO' => set_value('KdasarRO', $row->Kdasar),
				'induk' => set_value('induk', $row->idwsheet),
                'NoUrut' => set_value('NoUrut'),
    			'Kdasar' => set_value('Kdasar'),
                'MataPelajaran' => $row->MataPelajaran,
			);
            // $this->load->view('t04_wsheet/t04_wsheet_form', $data);
            $data['_view'] = 't04_wsheet/t04_wsheet_form_sub';
            $data['_caption'] = 'DATA WORKSHEET';
            $this->load->view('_00_dashboard/_00_dashboard_view', $data);
        }
    }

    public function createSub_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->createSub($this->input->post('induk',TRUE));
        } else {
            $data = array(
				'idmapel' => $this->input->post('idmapel',TRUE),
				'NoUrut' => $this->input->post('NoUrut',TRUE),
				'Kdasar' => $this->input->post('Kdasar',TRUE),
				'induk' => $this->input->post('induk',TRUE),
                'urut' =>
                    substr('00' . trim($this->input->post('idmapel',TRUE)), -2)
                    . substr('00' . trim($this->input->post('NoUrutRO',TRUE)), -2)
                    . substr('00' . trim($this->input->post('NoUrut',TRUE)), -2),
			);
            $this->T04_wsheet_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('t04_wsheet'));
        }
    }

    public function updateSub($id)
    {
        $row = $this->T04_wsheet_model->get_by_id($id);

        if ($row) {

            /**
             * ambil data head
             */
            $dataHead = $this->T04_wsheet_model->get_by_id($row->induk);

            $data = array(
                'button' => 'Simpan',
                'action' => site_url('t04_wsheet/updateSub_action'),
				'idwsheet' => set_value('idwsheet', $row->idwsheet),
				'idmapel' => set_value('idmapel', $row->idmapel),
				'NoUrutRO' => set_value('NoUrutRO', $dataHead->NoUrut),
				'KdasarRO' => set_value('KdasarRO', $dataHead->Kdasar),
				'induk' => set_value('induk', $row->induk),
                'NoUrut' => set_value('NoUrut', $row->NoUrut),
    			'Kdasar' => set_value('Kdasar', $row->Kdasar),
                'MataPelajaran' => $row->MataPelajaran,
                'SiswaNilai' => $row->SiswaNilai,
			);
            // $this->load->view('t04_wsheet/t04_wsheet_form', $data);
            $data['_view'] = 't04_wsheet/t04_wsheet_form_sub';
            $data['_caption'] = 'DATA WORKSHEET';
            $this->load->view('_00_dashboard/_00_dashboard_view', $data);
        }
    }

    public function updateSub_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->updateSub($this->input->post('idwsheet', TRUE));
        } else {
            $data = array(
				'NoUrut' => $this->input->post('NoUrut',TRUE),
				'Kdasar' => $this->input->post('Kdasar',TRUE),
                'urut' =>
                    substr('00' . trim($this->input->post('idmapel',TRUE)), -2)
                    . substr('00' . trim($this->input->post('NoUrutRO',TRUE)), -2)
                    . substr('00' . trim($this->input->post('NoUrut',TRUE)), -2),
			);
            $this->T04_wsheet_model->update($this->input->post('idwsheet', TRUE), $data);

            /**
             * baca data dari form
             */
            $data = $this->input->post();

            /**
             * ambil data talent dan nilai
             */
            foreach($data['siswa'] as $key => $value) {
                $SiswaNilai[] = [
                    'Siswa' => $value,
                    'Nilai' => $data['nilai'][$key],
                ];
            }

            $data = array(
				// 'idsiswa' => $this->input->post('idsiswa',TRUE),
				'SiswaNilai' => serialize($SiswaNilai),
			);
            $this->T04_wsheet_model->update($this->input->post('idwsheet', TRUE), $data);

            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('t04_wsheet'));
        }
    }

    public function deleteSub($id)
    {
        $row = $this->T04_wsheet_model->get_by_id($id);

        if ($row) {
            $this->T04_wsheet_model->delete($id);

            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('t04_wsheet'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('t04_wsheet'));
        }
    }

    public function sinkronisasi() {
        /**
         * ambil data siswa
         */
        $siswa = $this->T00_siswa_model->get_all(); //echo pre($siswa);

        /**
         * ambil data worksheet
         */
        $wsheet = $this->T04_wsheet_model->get_all();

        /**
         * looping data worksheet
         */
        foreach($wsheet as $dw) {

            /**
             * array dikosongi
             */
            $SiswaNilai = array();
            $SiswaNilaiBaru = array();

            if ($dw->SiswaNilai == "") { // jika data talent-nilai masih kosong

                /**
                 * looping data siswa
                 */
                foreach ($siswa as $ds) {
                    $SiswaNilai[] = [
                        'Siswa' => $ds->Panggilan,
                        'Nilai' => '',
                    ];
                }

                /**
                 * update data di tabel worksheet
                 */
                $dataSiswaNilai = [
                    'SiswaNilai' => serialize($SiswaNilai),
                ];
                $this->T04_wsheet_model->update($dw->idwsheet, $dataSiswaNilai);

            } else {

                /**
                 * ambil data siswa-nilai, ditempatkan di array
                 */
                $dataSiswaNilai = unserialize($dw->SiswaNilai); //echo pre($dataSiswaNilai);

                /**
                 * looping data siswa
                 */
                foreach ($siswa as $ds) {
                    /**
                     * ambil nama siswa
                     */
                    $panggilan = $ds->Panggilan; //echo $nama;

                    /**
                     * data nama siswa dicari di array data siswa-nilai
                     */
                    $key = array_search($panggilan, array_column($dataSiswaNilai, 'Siswa'), true);

                    /**
                     * jika data nama siswa ditemukan pada siswa-nilai, maka nilai akan disimpan
                     * jika data nama siswa tidak ditemukan pada siswa-nilai, maka nilai dikosongi
                     */
                    $nilai = (FALSE !== $key) ? $dataSiswaNilai[$key]['Nilai'] : "";

                    /**
                     * buat siswa-nilai baru berdasarkan ::
                     * data nama siswa dari tabel siswa
                     * nilai talent diambil dari data siswa-nilai jika ada
                     */
                    $SiswaNilaiBaru[] = [
                        'Siswa' => $ds->Panggilan,
                        'Nilai' => $nilai,
                    ];
                }

                /**
                 * update data di tabel worksheet
                 */
                $data = [
                    'SiswaNilai' => serialize($SiswaNilaiBaru),
                ];
                $this->T04_wsheet_model->update($dw->idwsheet, $data);

            }
        }

        $this->session->set_flashdata('message', 'Sinkronisasi Data Selesai');
        redirect(site_url('t04_wsheet'));
    }

}

/* End of file T04_wsheet.php */
/* Location: ./application/controllers/T04_wsheet.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-04-26 14:21:17 */
/* http://harviacode.com */
