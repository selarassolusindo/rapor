<?php
defined('BASEPATH') or exit('No direct script access allowed');

class _00_dashboard extends CI_Controller {

    public function index()
    {
        $data['_view'] = '_00_dashboard_list';
        $data['_caption'] = 'DASHBOARD';
        $this->load->view('_00_dashboard/_00_dashboard_view', $data);
    }
}
