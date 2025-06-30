<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Campaign_model');
        $this->load->helper(['url', 'text']);
        $this->load->library('session'); 
    }

    public function detail($id = null) {
        if (!$id) {
            redirect('home'); 
        }

        $data['title'] = 'Detail Kampanye';
        $data['active_page'] = 'campaign';

        $campaign = $this->Campaign_model->get_campaign_with_author_by_id($id);
        
        if (empty($campaign)) {
            show_404(); 
        }
        $data['campaign'] = $campaign;

        $this->load->view('templates/header', $data);
        $this->load->view('public/campaign_detail_view', $data);
    }
}
