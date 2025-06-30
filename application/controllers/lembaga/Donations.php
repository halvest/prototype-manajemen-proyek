<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donations extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'lembaga') {
            $this->session->set_flashdata('error', 'Anda harus login sebagai lembaga.');
            redirect('auth/login');
        }
        $this->load->model('Donation_model');
        $this->load->helper('url');
    }


    public function index() {
        $data['title'] = 'Kelola Donasi Masuk';
        $data['active_menu'] = 'kelola_donasi'; 
        $lembaga_id = $this->session->userdata('user_id');

        $data['donations'] = $this->Donation_model->get_donations_for_lembaga($lembaga_id);

        $data['view_file'] = 'lembaga/donation_manage_view';
        $this->load->view('templates/lembaga_layout', $data);
    }

    public function view($donation_id = null) {
        if (!$donation_id) redirect('lembaga/donations');
        
        $data['title'] = 'Detail Donasi';
        $data['active_menu'] = 'kelola_donasi';
        $lembaga_id = $this->session->userdata('user_id');
        
        $donation = $this->Donation_model->get_donation_details_for_lembaga($donation_id, $lembaga_id);
        
        if(!$donation) {
            $this->session->set_flashdata('error', 'Donasi tidak ditemukan atau Anda tidak memiliki hak akses.');
            redirect('lembaga/donations');
        }
        
        $data['donation'] = $donation;
        $data['view_file'] = 'lembaga/donation_detail_view';
        $this->load->view('templates/lembaga_layout', $data);
    }

    public function update_status($donation_id = null) {
        if (!$donation_id) redirect('lembaga/donations');

        $status = $this->input->post('status');
        if ($status) {
            if ($this->Donation_model->update_donation_status($donation_id, $status)) {
                $this->session->set_flashdata('success', 'Status donasi berhasil diperbarui.');
            } else {
                $this->session->set_flashdata('error', 'Gagal memperbarui status donasi.');
            }
        }
        redirect('lembaga/donations');
    }
}
