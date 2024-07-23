<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getUserByEmail($email) {
        $query = $this->db->get_where('customer', array('email' => $email));
        return $query->row();
    }
}
?>
