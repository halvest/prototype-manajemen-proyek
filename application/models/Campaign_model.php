<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_model extends CI_Model {

    /**
     * Mengambil kampanye yang aktif untuk ditampilkan di halaman utama.
     */
    public function get_active_campaigns($limit = 6) {
        $this->db->select('campaigns.*, users.name as lembaga_name');
        $this->db->from('campaigns');
        $this->db->join('users', 'users.user_id = campaigns.lembaga_id');
        $this->db->where('campaigns.status', 'active');
        $this->db->order_by('campaigns.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    /**
     * Mengambil statistik ringkas untuk dashboard lembaga.
     */
    public function get_campaign_stats_by_lembaga($lembaga_id) {
        $stats = [];
        
        // Hitung jumlah postingan
        $this->db->where('lembaga_id', $lembaga_id);
        $stats['total_posts'] = $this->db->count_all_results('campaigns');
        
        // Hitung total donasi diterima
        $this->db->select('COUNT(donation_id) as total_donations');
        $this->db->from('donations');
        $this->db->join('campaigns', 'campaigns.campaign_id = donations.campaign_id');
        $this->db->where('campaigns.lembaga_id', $lembaga_id);
        $this->db->where('donations.current_status', 'received');
        $result = $this->db->get()->row();
        $stats['donations_received'] = $result ? $result->total_donations : 0;
        
        // Jangkauan Postingan (contoh data statis)
        $stats['post_reach'] = '5K';

        return $stats;
    }

    // --- METHOD BARU UNTUK CRUD ---

    /**
     * CREATE: Menyimpan data kampanye baru ke database.
     */
    public function insert_campaign($data) {
        return $this->db->insert('campaigns', $data);
    }

    /**
     * READ: Mengambil SEMUA kampanye milik satu lembaga untuk halaman manajemen.
     */
    public function get_campaigns_by_lembaga($lembaga_id) {
        $this->db->where('lembaga_id', $lembaga_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('campaigns')->result();
    }

    /**
     * READ: Mengambil satu data kampanye spesifik berdasarkan ID.
     * Penting: Menyertakan $lembaga_id untuk keamanan.
     */
    public function get_campaign_by_id($id, $lembaga_id) {
        $this->db->where('campaign_id', $id);
        $this->db->where('lembaga_id', $lembaga_id); // Memastikan lembaga hanya bisa akses miliknya
        return $this->db->get('campaigns')->row();
    }

    /**
     * UPDATE: Memperbarui data kampanye di database.
     * Penting: Menyertakan $lembaga_id untuk keamanan.
     */
    public function update_campaign($id, $lembaga_id, $data) {
        $this->db->where('campaign_id', $id);
        $this->db->where('lembaga_id', $lembaga_id); // Memastikan lembaga hanya bisa update miliknya
        return $this->db->update('campaigns', $data);
    }

    /**
     * DELETE: Menghapus data kampanye dari database.
     * Penting: Menyertakan $lembaga_id untuk keamanan.
     */
    public function delete_campaign($id, $lembaga_id) {
        $this->db->where('campaign_id', $id);
        $this->db->where('lembaga_id', $lembaga_id); // Memastikan lembaga hanya bisa hapus miliknya
        return $this->db->delete('campaigns');
    }


        public function get_all_campaigns() {
        $this->db->select('campaigns.*, users.name as lembaga_name');
        $this->db->from('campaigns');
        $this->db->join('users', 'users.user_id = campaigns.lembaga_id');
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result();
    }
    
    public function count_all_campaigns($status = null) {
        if ($status) {
            $this->db->where('status', $status);
        }
        return $this->db->count_all_results('campaigns');
    }

    public function update_campaign_status($id, $status) {
        $this->db->where('campaign_id', $id);
        return $this->db->update('campaigns', ['status' => $status]);
    }
    
    public function get_campaign_by_id_admin($id) {
        return $this->db->get_where('campaigns', ['campaign_id' => $id])->row();
    }

    public function delete_campaign_admin($id) {
        return $this->db->delete('campaigns', ['campaign_id' => $id]);
    }
}