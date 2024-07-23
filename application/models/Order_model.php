<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
    public function get_all_orders() {
        $this->db->select('Order.*, Customer.name as customer_name');
        $this->db->join('Customer', 'Order.customer_id = Customer.id');
        $this->db->order_by('Order.created_at', 'DESC');
        return $this->db->get('Order')->result();
    }

    public function get_order_by_id($id) {
        $this->db->select('Order.*, Customer.name as customer_name');
        $this->db->join('Customer', 'Order.customer_id = Customer.id');
        return $this->db->get_where('Order', ['Order.id' => $id])->row();
    }

    public function get_order_items_by_order_id($order_id) {
        $this->db->select('Order_Item.*, Product.name as product_name');
        $this->db->join('Product', 'Order_Item.product_id = Product.id');
        $this->db->where('Order_Item.order_id', $order_id);
        return $this->db->get('Order_Item')->result();
    }
    
    public function create_order($customer_id, $total_price, $province, $city, $address, $post_code) {
        $data = [
            'customer_id' => $customer_id,
            'total_price' => $total_price,
            'province' => $province,
            'city' => $city,
            'address' => $address,
            'post_code' => $post_code
        ];
    
        $this->db->insert('Order', $data);
        return $this->db->insert_id();
    }
    
    public function create_order_items($order_id, $cart_items) {
        foreach ($cart_items as $item) {
            $data = [
                'order_id' => $order_id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ];
            $this->db->insert('Order_Item', $data);
        }
    }
}
?>
