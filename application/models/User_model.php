<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function register_user($data) {
        $data['password'] = md5($data['password']);
        return $this->db->insert('users', $data);
    }

    public function login_user($email, $password) {
        $this->db->where('email', $email);
        $user = $this->db->get('users')->row();

        if ($user && $user->password === md5($password)) {
            if ($user->role == 'lembaga' && $user->verification_status != 'verified') {
                return 'not_verified';
            }
            return $user;
        }

        return false;
    }

    public function get_user_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
    
    public function get_user_by_id($user_id) {
        return $this->db->get_where('users', ['user_id' => $user_id])->row();
    }

    public function get_all_users() {
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('users')->result();
    }

    public function get_all_lembaga_users() {
        $this->db->where('role', 'lembaga');
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('users')->result();
    }

    public function count_all_users() {
        return $this->db->count_all('users');
    }

    public function update_user_verification($user_id, $status) {
        $this->db->where('user_id', $user_id);
        return $this->db->update('users', ['verification_status' => $status]);
    }
}
