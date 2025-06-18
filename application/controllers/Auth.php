<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    /**
     * Login umum (Donatur & Lembaga)
     */
    public function login() {
        if ($this->session->userdata('user_id')) {
            $role = strtolower($this->session->userdata('role'));

            if ($role === 'donatur') {
                redirect('home');
            } elseif ($role === 'lembaga') {
                redirect('lembaga/dashboard');
            } else {
                redirect('home');
            }
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/login_view');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->login_user($email, $password);

            if ($user) {
                if ($user === 'not_verified') {
                    $this->session->set_flashdata('error', 'Akun Lembaga Anda sedang menunggu verifikasi oleh Admin.');
                    redirect('auth/login');
                }

                if ($user->role === 'admin') {
                    $this->session->set_flashdata('error', 'Silakan login melalui halaman khusus admin.');
                    redirect('auth/login');
                }

                $this->session->set_userdata([
                    'user_id'   => $user->user_id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'role'      => strtolower($user->role),
                    'logged_in' => TRUE
                ]);

                redirect($user->role === 'donatur' ? 'home' : 'lembaga/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Email atau Password salah.');
                redirect('auth/login');
            }
        }
    }

    /**
     * Login khusus admin
     */
    public function admin_login() {
        if ($this->session->userdata('user_id') && strtolower($this->session->userdata('role')) === 'admin') {
            redirect('admin/dashboard');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/admin_login_view');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->User_model->login_user($email, $password);

            if ($user && strtolower($user->role) === 'admin') {
                $this->session->set_userdata([
                    'user_id'   => $user->user_id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'role'      => 'admin',
                    'logged_in' => TRUE
                ]);
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('error', 'Akses ditolak. Login hanya untuk Admin.');
                redirect('auth/admin_login');
            }
        }
    }

    /**
     * Tampilkan form register gabungan donatur & lembaga
     */
    public function register_view() {
        $this->load->view('auth/register_view');
    }

    /**
     * Registrasi gabungan (donatur dan lembaga)
     */
    public function register() {
        $this->form_validation->set_rules('role', 'Peran', 'required|in_list[donatur,lembaga]');
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Ulangi Password', 'required|matches[password]');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auth/register_view');
        } else {
            $role = $this->input->post('role');
            $data = [
                'name'     => $this->input->post('name'),
                'email'    => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'role'     => $role
            ];

            if ($role === 'lembaga') {
                $data['verification_status'] = 'pending';
            }

            if ($this->User_model->register_user($data)) {
                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Terjadi kesalahan. Silakan coba lagi.');
                redirect('auth/register_view');
            }
        }
    }

    /**
     * Logout semua user
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('home');
    }
}
