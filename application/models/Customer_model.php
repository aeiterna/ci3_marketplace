<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function register($name, $email, $password, $phone) {
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'phone' => $phone
        ];
        $this->db->insert('customer', $data);
    }

    public function login($email, $password) {
        $this->db->where('email', $email);
        $customer = $this->db->get('customer')->row_array();
    
        if ($customer && password_verify($password, $customer['password'])) {
            return $customer;
        } else {
            return false;
        }
    }
    
    public function get_customer_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('customer')->row_array();
    }

}
?>
