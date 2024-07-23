<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function register($data) {
        $this->db->where('email', $data['email']);
        $this->db->where('is_verified', 0);
        $query = $this->db->get('customer');
    
        if ($query->num_rows() > 0) {
            $this->db->where('email', $data['email']);
            $this->db->delete('customer');
        }
    
        return $this->db->insert('customer', $data);
    }

    public function check_email($email) {
        $this->db->where('email', $email);
        return $this->db->get('customer')->num_rows();
    }

    public function verify_otp($email, $otp_code) {
        $this->db->where('email', $email);
        $this->db->where('otp_code', $otp_code);
        $this->db->where('otp_expiration >=', date('Y-m-d H:i:s'));
        $query = $this->db->get('customer');

        if ($query->num_rows() == 1) {
            $this->db->where('email', $email);
            $this->db->update('customer', array('is_verified' => 1));

            return $this->db->affected_rows() > 0;
        } else {
            return false;
        }
    }
}
