<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'lembaga') {
            $this->session->set_flashdata('error', 'Anda harus login sebagai lembaga.');
            redirect('auth/login');
        }
        $this->load->model(['Campaign_model', 'Donation_model', 'User_model']);
        $this->load->library(['form_validation', 'upload']);
        $this->load->helper(['url', 'text']);
    }

    public function index() {
        $data['title'] = 'Dashboard Lembaga';
        $data['active_menu'] = 'dashboard';
        $lembaga_id = $this->session->userdata('user_id');
        
        $data['stats'] = $this->Campaign_model->get_campaign_stats_by_lembaga($lembaga_id);
        $data['recent_donations'] = array_slice($this->Donation_model->get_donations_for_lembaga($lembaga_id), 0, 5);
        $data['user_name'] = $this->session->userdata('name');

        $data['view_file'] = 'lembaga/dashboard_view';
        $this->load->view('templates/lembaga_layout', $data);
    }

    public function campaigns() {
        $data['title'] = 'Kelola Kampanye';
        $data['active_menu'] = 'kelola_posting';
        $data['campaigns'] = $this->Campaign_model->get_campaigns_by_lembaga($this->session->userdata('user_id'));
        $data['view_file'] = 'lembaga/campaign_manage_view';
        $this->load->view('templates/lembaga_layout', $data);
    }

    public function create_campaign() {
        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('category', 'Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Buat Kampanye Baru';
            $data['active_menu'] = 'kelola_posting';
            $data['view_file'] = 'lembaga/campaign_form_view';
            $this->load->view('templates/lembaga_layout', $data);
        } else {
            $config['upload_path']   = './uploads/campaigns/';
            if (!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;
            $this->upload->initialize($config);
            
            $image_name = 'default.jpg';
            if (!empty($_FILES['campaign_image']['name']) && $this->upload->do_upload('campaign_image')) {
                $image_name = $this->upload->data('file_name');
            }

            $campaign_data = [
                'lembaga_id'  => $this->session->userdata('user_id'),
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'category'    => $this->input->post('category'),
                'image_url'   => $image_name,
                'status'      => 'pending',
            ];

            $this->Campaign_model->insert_campaign($campaign_data);
            $this->session->set_flashdata('success', 'Kampanye berhasil dibuat dan sedang menunggu persetujuan admin.');
            redirect('lembaga/dashboard/campaigns');
        }
    }

    public function edit_campaign($id = null) {
        if (!$id) redirect('lembaga/dashboard/campaigns');
        $lembaga_id = $this->session->userdata('user_id');
        $campaign = $this->Campaign_model->get_campaign_by_id($id, $lembaga_id);
        if (!$campaign) redirect('lembaga/dashboard/campaigns');

        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Kampanye';
            $data['active_menu'] = 'kelola_posting';
            $data['campaign'] = $campaign;
            $data['view_file'] = 'lembaga/campaign_form_view';
            $this->load->view('templates/lembaga_layout', $data);
        } else {
            $update_data = [
                'title'       => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'category'    => $this->input->post('category'),
            ];
            if (!empty($_FILES['campaign_image']['name'])) {
                // ... (logika upload sama seperti create) ...
            }
            $this->Campaign_model->update_campaign($id, $lembaga_id, $update_data);
            $this->session->set_flashdata('success', 'Kampanye berhasil diperbarui!');
            redirect('lembaga/dashboard/campaigns');
        }
    }

    public function delete_campaign($id = null) {
        if (!$id) redirect('lembaga/dashboard/campaigns');
        $lembaga_id = $this->session->userdata('user_id');
        $campaign = $this->Campaign_model->get_campaign_by_id($id, $lembaga_id);
        if ($campaign) {
            if ($campaign->image_url != 'default.jpg' && file_exists('./uploads/campaigns/' . $campaign->image_url)) {
                unlink('./uploads/campaigns/' . $campaign->image_url);
            }
            $this->Campaign_model->delete_campaign($id, $lembaga_id);
            $this->session->set_flashdata('success', 'Kampanye berhasil dihapus!');
        }
        redirect('lembaga/dashboard/campaigns');
    }

    public function tracking() {
        $data['title'] = 'Lacak Barang Donasi';
        $data['active_menu'] = 'lacak';
        $data['donation_result'] = null;
        $donation_id = $this->input->post('donation_id');
        if ($donation_id) {
            $donation = $this->Donation_model->get_donation_for_tracking_by_lembaga($donation_id, $this->session->userdata('user_id'));
            if ($donation) $data['donation_result'] = $donation;
            else $this->session->set_flashdata('error', 'ID Donasi tidak ditemukan.');
        }
        $data['view_file'] = 'lembaga/tracking_view';
        $this->load->view('templates/lembaga_layout', $data);
    }
    
    public function notifikasi() {
        $data['title'] = 'Notifikasi';
        $data['active_menu'] = 'notifikasi';
        $data['view_file'] = 'lembaga/notifikasi_view';
        $this->load->view('templates/lembaga_layout', $data);
    }

    public function pengaturan() {
        $user_id = $this->session->userdata('user_id');
        
        $this->form_validation->set_rules('name', 'Nama Lembaga', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Pengaturan Akun';
            $data['active_menu'] = 'pengaturan';
            $data['user'] = $this->User_model->get_user_by_id($user_id);
            $data['view_file'] = 'lembaga/pengaturan_view';
            $this->load->view('templates/lembaga_layout', $data);
        } else {
            $this->session->set_flashdata('success', 'Profil lembaga berhasil diperbarui!');
            redirect('lembaga/dashboard/pengaturan');
        }
    }
}
