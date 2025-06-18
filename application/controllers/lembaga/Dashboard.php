<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki hak akses.');
            redirect('auth/login');
        }

        $this->load->model(['User_model', 'Campaign_model']);
    }

    // ======================= DASHBOARD =======================

    public function index() {
        $data['title'] = 'Admin Dashboard';
        $data['active_menu'] = 'dashboard';

        // Statistik dashboard
        $view_data['total_users'] = $this->User_model->count_all_users();
        $view_data['total_campaigns'] = $this->Campaign_model->count_all_campaigns();
        $view_data['pending_campaigns'] = $this->Campaign_model->count_all_campaigns('pending');

        // Daftar kampanye pending
        $all_campaigns = $this->Campaign_model->get_all_campaigns();
        $view_data['pending_campaign_list'] = array_filter($all_campaigns, function($c) {
            return $c->status === 'pending';
        });

        $data['view_file'] = 'admin/dashboard_view';
        $data['view_data'] = $view_data;

        $this->load->view('templates/admin_layout', $data);
    }

    // ======================= KAMPANYE =======================

    public function campaigns() {
        $data['title'] = 'Kelola Kampanye';
        $data['active_menu'] = 'campaigns';

        $view_data['campaigns'] = $this->Campaign_model->get_all_campaigns();

        $data['view_file'] = 'admin/campaign_manage_view';
        $data['view_data'] = $view_data;
        $this->load->view('templates/admin_layout', $data);
    }

    public function approve($id) {
        $this->Campaign_model->update_campaign_status($id, 'active');
        $this->session->set_flashdata('success', 'Kampanye disetujui.');
        redirect('admin/dashboard');
    }

    public function reject($id) {
        $this->Campaign_model->update_campaign_status($id, 'rejected');
        $this->session->set_flashdata('success', 'Kampanye ditolak.');
        redirect('admin/dashboard');
    }

    public function delete($id) {
        $this->Campaign_model->delete_campaign_admin($id);
        $this->session->set_flashdata('success', 'Kampanye berhasil dihapus.');
        redirect('admin/dashboard');
    }

    public function edit($id) {
        $data['title'] = 'Edit Kampanye';
        $data['active_menu'] = 'dashboard';

        $campaign = $this->Campaign_model->get_campaign_by_id_admin($id);
        if (!$campaign) {
            $this->session->set_flashdata('error', 'Kampanye tidak ditemukan.');
            redirect('admin/dashboard');
        }

        if ($_POST) {
            $update_data = [
                'title' => $this->input->post('title'),
                'description' => $this->input->post('description'),
                'status' => $this->input->post('status'),
            ];

            $this->Campaign_model->update_campaign($id, $campaign->lembaga_id, $update_data);
            $this->session->set_flashdata('success', 'Kampanye berhasil diperbarui.');
            redirect('admin/dashboard');
        }

        $data['campaign'] = $campaign;
        $this->load->view('admin/campaign_edit_view', $data);
    }

    // ======================= PENGGUNA =======================

    public function users() {
        $data['title'] = 'Manajemen Pengguna';
        $data['active_menu'] = 'users';

        $view_data['users'] = $this->User_model->get_all_users();

        $data['view_file'] = 'admin/users_manage_view';
        $data['view_data'] = $view_data;

        $this->load->view('templates/admin_layout', $data);
    }

    public function verify_user($user_id) {
        if (!$user_id || !$this->User_model->get_user_by_id($user_id)) {
            $this->session->set_flashdata('error', 'Pengguna tidak valid.');
            redirect('admin/users');
        }

        $this->User_model->update_user_verification($user_id, 'verified');
        $this->session->set_flashdata('success', 'Akun lembaga berhasil diverifikasi.');
        redirect('admin/users');
    }
}
