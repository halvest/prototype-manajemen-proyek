<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'lembaga') {
            redirect('auth/login');
        }
    }

    public function index() {
        $data['title'] = 'Lacak Pengiriman Barang';
        $data['active_menu'] = 'lacak';
        $data['view_file'] = 'lembaga/tracking_view'; // View untuk Lacak Barang
        $this->load->view('templates/lembaga_layout', $data);
    }
}