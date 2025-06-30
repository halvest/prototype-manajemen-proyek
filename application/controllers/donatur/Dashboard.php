<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'donatur') {
            $this->session->set_flashdata('error', 'Anda harus login sebagai donatur.');
            redirect('auth/login');
        }
        $this->load->model(['Donation_model', 'User_model']);
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        $data['title'] = 'Dashboard Donatur';
        $data['active_menu'] = 'dashboard';
        $donator_id = $this->session->userdata('user_id');
        $data['user_name'] = $this->session->userdata('name');

        $all_donations = $this->Donation_model->get_donations_by_donator($donator_id);
        $data['stats']['total_donasi'] = count($all_donations);
        $terkirim = 0;
        foreach ($all_donations as $d) { if ($d->current_status === 'Terkirim' || $d->current_status === 'Received') $terkirim++; }
        $data['stats']['donasi_terkirim'] = $terkirim;
        $data['stats']['poin'] = $terkirim * 30;
        
        $data['riwayat_donasi'] = array_slice($all_donations, 0, 3);
        $data['view_file'] = 'donatur/dashboard_view';
        $this->load->view('templates/donatur_layout', $data);
    }

    public function riwayat() {
        $data['title'] = 'Riwayat Donasi Saya';
        $data['active_menu'] = 'riwayat';
        $data['donations'] = $this->Donation_model->get_donations_by_donator($this->session->userdata('user_id'));
        $data['view_file'] = 'donatur/riwayat_view';
        $this->load->view('templates/donatur_layout', $data);
    }

    public function lacak() {
        $data['title'] = 'Lacak Donasi Anda';
        $data['active_menu'] = 'lacak';
        $data['donation_result'] = null; 

        $donation_id = $this->input->post('donation_id');
        if ($donation_id) {
            $donator_id = $this->session->userdata('user_id');
            $donation = $this->Donation_model->get_donation_for_tracking($donation_id, $donator_id);
            
            if ($donation) {
                $data['donation_result'] = $donation;
            } else {
                $this->session->set_flashdata('error', 'ID Donasi tidak ditemukan atau bukan milik Anda.');
            }
        }

        $data['view_file'] = 'donatur/tracking_view';
        $this->load->view('templates/donatur_layout', $data);
    }

    public function notifikasi() {
        $data['title'] = 'Notifikasi';
        $data['active_menu'] = 'notifikasi';
        $data['view_file'] = 'donatur/notifikasi_view';
        $this->load->view('templates/donatur_layout', $data);
    }

    public function pengaturan() {
        $user_id = $this->session->userdata('user_id');
        
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Pengaturan Akun';
            $data['active_menu'] = 'pengaturan';
            $data['user'] = $this->User_model->get_user_by_id($user_id);
            $data['view_file'] = 'donatur/pengaturan_view';
            $this->load->view('templates/donatur_layout', $data);
        } else {
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
            redirect('donatur/pengaturan');
        }
    }
}
