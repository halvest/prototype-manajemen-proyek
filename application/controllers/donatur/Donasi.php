<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'donatur') {
            $this->session->set_flashdata('error', 'Anda harus login sebagai donatur untuk berdonasi.');
            redirect('auth/login');
        }
        $this->load->model(['Campaign_model', 'Donation_model']);
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url');
    }

    public function submit($campaign_id = null) {
        if (!$campaign_id) {
            show_404();
        }
        
        $this->form_validation->set_rules('item_name', 'Nama Barang', 'required|trim');
        $this->form_validation->set_rules('item_condition', 'Kondisi Barang', 'required|trim');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error_validation', validation_errors());
            redirect('campaigns/detail/' . $campaign_id);
        } else {
            $config['upload_path']   = './uploads/donations/';
            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, TRUE);
            }
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->upload->initialize($config);
            
            $image_name = NULL;
            if (!empty($_FILES['item_image']['name'])) {
                if ($this->upload->do_upload('item_image')) {
                    $upload_data = $this->upload->data();
                    $image_name = $upload_data['file_name'];
                } else {
                    $this->session->set_flashdata('error_upload', $this->upload->display_errors());
                    redirect('campaigns/detail/' . $campaign_id);
                    return;
                }
            }

            $donation_data = [
                'campaign_id'      => $campaign_id,
                'donatur_id'       => $this->session->userdata('user_id'),
                'item_name'        => $this->input->post('item_name'),
                'quantity'         => $this->input->post('quantity', TRUE) ?: 1,
                'item_condition'   => $this->input->post('item_condition'),
                'item_image_url'   => $image_name,
                'current_status'   => 'Pending'
            ];

            if ($this->Donation_model->insert_donation($donation_data)) {
                $this->session->set_flashdata('success', 'Terima kasih! Donasi Anda telah berhasil dicatat.');
                redirect('donatur/riwayat');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan donasi Anda.');
                redirect('campaigns/detail/' . $campaign_id);
            }
        }
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
}
