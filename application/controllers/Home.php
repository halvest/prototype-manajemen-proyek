<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Campaign_model');
        $this->load->helper(['url', 'text']);
    }

    public function index() {
        $data['title'] = 'Beranda | RelfConnect';
        $data['active_page'] = 'home';

        $data['campaigns'] = $this->Campaign_model->get_active_campaigns_with_author(9); 

        $this->load->view('templates/header', $data);
        $this->load->view('public/home_view', $data);
        $this->load->view('templates/footer');
    }
}
