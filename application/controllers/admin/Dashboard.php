<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki hak akses.');
            redirect('auth/login');
        }

        $this->load->model(['User_model', 'Campaign_model']);
    }

    public function index() {
        $data = [
            'title' => 'Admin Dashboard',
            'active_menu' => 'dashboard',
        ];

        $view_data['total_users']       = $this->User_model->count_all_users();
        $view_data['total_campaigns']   = $this->Campaign_model->count_all_campaigns();
        $view_data['pending_campaigns'] = $this->Campaign_model->count_all_campaigns('pending');

        $all_campaigns = $this->Campaign_model->get_all_campaigns();
        $view_data['pending_campaign_list'] = array_filter($all_campaigns, function($c) {
            return isset($c->status) && $c->status === 'pending';
        });

        $data['view_file'] = 'dashboard_view';
        $data['view_data'] = $view_data;
        $this->load->view('templates/admin_layout', $data);
    }

    public function campaigns() {
        $data = [
            'title' => 'Kelola Kampanye',
            'active_menu' => 'campaigns',
        ];

        $view_data['campaigns'] = $this->Campaign_model->get_all_campaigns();

        $data['view_file'] = 'campaign_manage_view';
        $data['view_data'] = $view_data;
        $this->load->view('templates/admin_layout', $data);
    }

    public function approve($id) {
        if ($this->Campaign_model->update_campaign_status($id, 'active')) {
            $this->session->set_flashdata('success', 'Kampanye disetujui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyetujui kampanye.');
        }
        redirect('admin/dashboard/campaigns');
    }

    public function reject($id) {
        if ($this->Campaign_model->update_campaign_status($id, 'rejected')) {
            $this->session->set_flashdata('success', 'Kampanye ditolak.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menolak kampanye.');
        }
        redirect('admin/dashboard/campaigns');
    }

    public function delete($id) {
        if ($this->Campaign_model->delete_campaign_admin($id)) {
            $this->session->set_flashdata('success', 'Kampanye berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kampanye.');
        }
        redirect('admin/dashboard/campaigns');
    }

    public function edit($id) {
        $data = [
            'title' => 'Edit Kampanye',
            'active_menu' => 'campaigns',
        ];

        $campaign = $this->Campaign_model->get_campaign_by_id_admin($id);
        if (!$campaign) {
            $this->session->set_flashdata('error', 'Kampanye tidak ditemukan.');
            redirect('admin/dashboard/campaigns');
        }

        if ($this->input->post()) {
            $update_data = [
                'title'       => $this->input->post('title', true),
                'description' => $this->input->post('description', true),
                'status'      => $this->input->post('status', true),
            ];

            $this->Campaign_model->update_campaign($id, $campaign->lembaga_id, $update_data);
            $this->session->set_flashdata('success', 'Kampanye diperbarui.');
            redirect('admin/dashboard/campaigns');
        }

        $data['campaign'] = $campaign;
        $this->load->view('admin/campaign_edit_view', $data);
    }

    public function users() {
        $data = [
            'title' => 'Manajemen Pengguna',
            'active_menu' => 'users',
        ];

        $view_data['users'] = $this->User_model->get_all_lembaga_users();


        $data['view_file'] = 'users_manage_view';
        $data['view_data'] = $view_data;
        $this->load->view('templates/admin_layout', $data);
    }

    public function verify($user_id) {
        $this->User_model->update_user_verification($user_id, 'verified');
        $this->session->set_flashdata('success', 'Akun lembaga berhasil diverifikasi.');
        redirect('admin/dashboard/users');
    }
}
