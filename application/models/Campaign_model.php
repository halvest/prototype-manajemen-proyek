<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_model extends CI_Model {
    public function get_active_campaigns_with_author($limit = null) {
        $this->db->select('campaigns.*, users.name as lembaga_name');
        $this->db->from('campaigns');
        $this->db->join('users', 'users.user_id = campaigns.lembaga_id', 'left');
        $this->db->where('campaigns.status', 'active');
        $this->db->order_by('campaigns.created_at', 'DESC');
        if ($limit) {
            $this->db->limit($limit);
        }
        return $this->db->get()->result();
    }

    public function get_campaign_with_author_by_id($id) {
        $this->db->select('campaigns.*, users.name as lembaga_name');
        $this->db->from('campaigns');
        $this->db->join('users', 'users.user_id = campaigns.lembaga_id', 'left');
        $this->db->where('campaigns.campaign_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert_campaign($data) {
        return $this->db->insert('campaigns', $data);
    }

    public function get_campaigns_by_lembaga($lembaga_id) {
        $this->db->select('campaigns.*, (SELECT COUNT(*) FROM donations WHERE donations.campaign_id = campaigns.campaign_id) as donation_count');
        $this->db->from('campaigns');
        $this->db->where('lembaga_id', $lembaga_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_campaign_by_id($id, $lembaga_id) {
        $this->db->where('campaign_id', $id);
        $this->db->where('lembaga_id', $lembaga_id); 
        return $this->db->get('campaigns')->row();
    }

    public function update_campaign($id, $lembaga_id, $data) {
        $this->db->where('campaign_id', $id);
        $this->db->where('lembaga_id', $lembaga_id); 
        return $this->db->update('campaigns', $data);
    }

    public function delete_campaign($id, $lembaga_id) {
        $this->db->where('campaign_id', $id);
        $this->db->where('lembaga_id', $lembaga_id); 
        return $this->db->delete('campaigns');
    }

    public function get_campaign_stats_by_lembaga($lembaga_id) {
        $stats = [];
        $this->db->where('lembaga_id', $lembaga_id);
        $stats['total_posts'] = $this->db->count_all_results('campaigns');
        
        $this->db->select('COUNT(donation_id) as total_donations');
        $this->db->from('donations');
        $this->db->join('campaigns', 'campaigns.campaign_id = donations.campaign_id');
        $this->db->where('campaigns.lembaga_id', $lembaga_id);
        $this->db->where('donations.current_status', 'Received');
        $result = $this->db->get()->row();
        $stats['donations_received'] = $result ? $result->total_donations : 0;
        
        $stats['post_reach'] = '5K'; // Data statis

        return $stats;
    }
    
    public function get_all_campaigns() {
        $this->db->select('campaigns.*, users.name as lembaga_name');
        $this->db->from('campaigns');
        $this->db->join('users', 'users.user_id = campaigns.lembaga_id', 'left');
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
