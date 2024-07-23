<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profit_model extends CI_Model {
    public function get_profit($date1, $date2) {
        $this->db->select('o.id as order_id, c.name as customer_name, p.name as product_name, oi.price, oi.quantity, o.total_price, o.created_at');
        $this->db->from('order o');
        $this->db->join('order_item oi', 'o.id = oi.order_id');
        $this->db->join('product p', 'oi.product_id = p.id');
        $this->db->join('customer c', 'o.customer_id = c.id');
        $this->db->where('o.created_at >=', $date1);
        $this->db->where('o.created_at <=', $date2);
        $query = $this->db->get();
        return $query->result();
    }
}
?>
