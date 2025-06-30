<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Donation_model extends CI_Model {

    public function insert_donation($data) {
        return $this->db->insert('donations', $data);
    }

    public function get_donations_by_donator($donator_id) {
        $this->db->select('donations.*, campaigns.title as campaign_title');
        $this->db->from('donations');
        $this->db->join('campaigns', 'donations.campaign_id = campaigns.campaign_id', 'left');
        $this->db->where('donations.donatur_id', $donator_id);
        $this->db->order_by('donations.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_donations_for_lembaga($lembaga_id) {
        $this->db->select('donations.*, campaigns.title as campaign_title, users.name as donator_name, donations.item_image_url');
        $this->db->from('donations');
        $this->db->join('campaigns', 'donations.campaign_id = campaigns.campaign_id');
        $this->db->join('users', 'donations.donatur_id = users.user_id', 'left');
        $this->db->where('campaigns.lembaga_id', $lembaga_id);
        $this->db->order_by('donations.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function update_donation_status($donation_id, $status) {
        $this->db->where('donation_id', $donation_id);
        return $this->db->update('donations', ['current_status' => $status]);
    }
    
    public function get_donation_details_for_lembaga($donation_id, $lembaga_id) {
        $this->db->select('donations.*, campaigns.title as campaign_title, users.name as donator_name, users.email as donator_email');
        $this->db->from('donations');
        $this->db->join('campaigns', 'donations.campaign_id = campaigns.campaign_id', 'left');
        $this->db->join('users', 'donations.donatur_id = users.user_id', 'left');
        $this->db->where('donations.donation_id', $donation_id);
        $this->db->where('campaigns.lembaga_id', $lembaga_id);
        return $this->db->get()->row();
    }

    public function get_donation_for_tracking($donation_id, $donator_id) {
        $this->db->select('donations.*, campaigns.title as campaign_title');
        $this->db->from('donations');
        $this->db->join('campaigns', 'donations.campaign_id = campaigns.campaign_id', 'left');
        $this->db->where('donations.donation_id', $donation_id);
        $this->db->where('donations.donatur_id', $donator_id);
        return $this->db->get()->row();
    }
    public function get_donation_for_tracking_by_lembaga($donation_id, $lembaga_id) {
        $this->db->select('donations.*, campaigns.title as campaign_title, users.name as donator_name');
        $this->db->from('donations');
        $this->db->join('campaigns', 'donations.campaign_id = campaigns.campaign_id');
        $this->db->join('users', 'donations.donatur_id = users.user_id', 'left');
        $this->db->where('donations.donation_id', $donation_id);
        $this->db->where('campaigns.lembaga_id', $lembaga_id); 
        return $this->db->get()->row();
    }
}
