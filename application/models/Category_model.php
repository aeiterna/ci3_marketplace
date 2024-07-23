<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_all_categories() {
        return $this->db->get('category')->result();
    }

    public function get_category_by_id($id) {
        return $this->db->get_where('category', ['id' => $id])->row();
    }

    public function add_category($data) {
        $this->db->insert('category', $data);
        return $this->db->insert_id();
    }

    public function update_category($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('category', $data);
        return ($this->db->affected_rows() > 0);
    }

    public function delete_category($id) {
        $this->db->where('id', $id);
        $this->db->delete('category');
        return ($this->db->affected_rows() > 0);
    }
}
?>
