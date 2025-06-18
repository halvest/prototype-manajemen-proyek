<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Middleware untuk cek login & role
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'lembaga') {
            $this->session->set_flashdata('error', 'Anda harus login sebagai lembaga.');
            redirect('auth/login');
        }
        $this->load->model('Campaign_model');
        $this->load->library('form_validation');
        $this->load->library('upload'); // <-- MEMUAT LIBRARY UPLOAD
        $this->load->helper('url');
    }

    /**
     * READ: Menampilkan daftar semua kampanye milik lembaga.
     */
    public function index() {
        $lembaga_id = $this->session->userdata('user_id');
        
        $data['title'] = 'Kelola Kampanye Donasi';
        $data['active_menu'] = 'kelola_posting';
        $data['campaigns'] = $this->Campaign_model->get_campaigns_by_lembaga($lembaga_id);
        $data['view_file'] = 'lembaga/campaign_manage_view';
        
        $this->load->view('templates/lembaga_layout', $data);
    }

    /**
     * CREATE: Menampilkan form dan memprosesnya.
     */
    public function create() {
        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('category', 'Kategori', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Buat Postingan Kampanye';
            $data['active_menu'] = 'posting';
            $data['view_file'] = 'lembaga/campaign_form_view';
            $this->load->view('templates/lembaga_layout', $data);
        } else {
            // Konfigurasi Upload Gambar
            $config['upload_path']   = './uploads/campaigns/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2048; // 2MB
            $config['encrypt_name']  = TRUE;

            $this->upload->initialize($config);
            
            $image_name = 'default.jpg'; // Gambar default jika tidak ada yg diupload
            if (!empty($_FILES['campaign_image']['name'])) {
                if ($this->upload->do_upload('campaign_image')) {
                    $upload_data = $this->upload->data();
                    $image_name = $upload_data['file_name'];
                } else {
                    // Jika upload gagal, tampilkan error dan kembali ke form
                    $data['error'] = $this->upload->display_errors();
                    $data['title'] = 'Buat Postingan Kampanye';
                    $data['active_menu'] = 'posting';
                    $data['view_file'] = 'lembaga/campaign_form_view';
                    $this->load->view('templates/lembaga_layout', $data);
                    return; // Hentikan eksekusi
                }
            }

            // Data untuk disimpan ke database
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
            redirect('lembaga/campaign');
        }
    }

    /**
     * UPDATE: Menampilkan form edit dan memprosesnya.
     */
    public function edit($id = null) {
        if (!$id) redirect('lembaga/campaign');

        $lembaga_id = $this->session->userdata('user_id');
        $campaign = $this->Campaign_model->get_campaign_by_id($id, $lembaga_id);

        if (!$campaign) {
            $this->session->set_flashdata('error', 'Kampanye tidak ditemukan atau Anda tidak memiliki hak akses.');
            redirect('lembaga/campaign');
        }

        $this->form_validation->set_rules('title', 'Judul', 'required|trim');
        $this->form_validation->set_rules('description', 'Deskripsi', 'required|trim');
        $this->form_validation->set_rules('category', 'Kategori', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Kampanye Donasi';
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

            // Cek jika ada gambar baru yang diupload untuk menggantikan yang lama
            if (!empty($_FILES['campaign_image']['name'])) {
                $config['upload_path']   = './uploads/campaigns/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = 2048;
                $config['encrypt_name']  = TRUE;
                $this->upload->initialize($config);

                if ($this->upload->do_upload('campaign_image')) {
                    // Hapus gambar lama jika bukan gambar default
                    if ($campaign->image_url != 'default.jpg') {
                        @unlink('./uploads/campaigns/' . $campaign->image_url);
                    }
                    $upload_data = $this->upload->data();
                    $update_data['image_url'] = $upload_data['file_name'];
                } else {
                    $data['error'] = $this->upload->display_errors();
                    $data['title'] = 'Edit Kampanye Donasi';
                    $data['active_menu'] = 'kelola_posting';
                    $data['campaign'] = $campaign;
                    $data['view_file'] = 'lembaga/campaign_form_view';
                    $this->load->view('templates/lembaga_layout', $data);
                    return;
                }
            }

            $this->Campaign_model->update_campaign($id, $lembaga_id, $update_data);
            $this->session->set_flashdata('success', 'Kampanye berhasil diperbarui!');
            redirect('lembaga/campaign');
        }
    }

    /**
     * DELETE: Menghapus kampanye beserta filenya.
     */
    public function delete($id = null) {
        if (!$id) redirect('lembaga/campaign');
        
        $lembaga_id = $this->session->userdata('user_id');
        $campaign = $this->Campaign_model->get_campaign_by_id($id, $lembaga_id);

        if ($campaign) {
            // Hapus gambar jika bukan gambar default
            if ($campaign->image_url != 'default.jpg') {
                @unlink('./uploads/campaigns/' . $campaign->image_url);
            }
            $this->Campaign_model->delete_campaign($id, $lembaga_id);
            $this->session->set_flashdata('success', 'Kampanye berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kampanye.');
        }
        
        redirect('lembaga/campaign');
    }
}