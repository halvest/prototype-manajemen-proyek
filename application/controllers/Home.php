<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Campaign_model');
        $data['campaigns'] = $this->Campaign_model->get_active_campaigns(9); // Ambil 9 untuk contoh
        $data['active_page'] = 'campaign'; // Menandai menu 'Campaign' sebagai aktif
    }

    public function index() {
        $data['active_campaigns'] = $this->Campaign_model->get_active_campaigns();
        $data['active_page'] = 'home';
        $this->load->view('templates/header');
        $this->load->view('public/home_view', $data);
        $this->load->view('public/about_view');
        $this->load->view('public/campaign_view', $data); 
        $this->load->view('public/testimoni_view');
        $this->load->view('templates/footer');
    }
}