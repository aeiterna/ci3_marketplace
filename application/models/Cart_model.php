<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends CI_Model {

    public function add_to_cart($customer_id, $product_id, $qty) {
        $cart_id = $this->get_or_create_cart($customer_id);
    
        $this->db->where('cart_id', $cart_id);
        $this->db->where('product_id', $product_id);
        $cart_item = $this->db->get('Cart_Item')->row_array();
    
        if ($cart_item) {
            $this->db->set('quantity', 'quantity + ' . (int)$qty, FALSE);
            $this->db->where('id', $cart_item['id']);
            $this->db->update('Cart_Item');
        } else {
            $data = [
                'cart_id' => $cart_id,
                'product_id' => $product_id,
                'quantity' => $qty
            ];
            $this->db->insert('Cart_Item', $data);
        }
    }
    

    public function get_cart_items($customer_id) {
        $cart_id = $this->get_or_create_cart($customer_id);

        $this->db->select('Cart_Item.*, Product.name, Product.price, Product.image');
        $this->db->from('Cart_Item');
        $this->db->join('Product', 'Product.id = Cart_Item.product_id');
        $this->db->where('cart_id', $cart_id);
        return $this->db->get()->result_array();
    }

    public function update_cart_item($customer_id, $product_id, $qty) {
        $cart_id = $this->get_or_create_cart($customer_id);
    
        $this->db->where('cart_id', $cart_id);
        $this->db->where('product_id', $product_id);
    
        if ($qty > 0) {
            $this->db->set('quantity', $qty);
            $this->db->update('Cart_Item');
        } else {
            $this->db->delete('Cart_Item');
        }
    }
    
    
    public function calculate_total($customer_id) {
        $cart_items = $this->get_cart_items($customer_id);
        $total = 0;
        foreach ($cart_items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function clear_cart($customer_id) {
        $cart_id = $this->get_or_create_cart($customer_id);
        $this->db->where('cart_id', $cart_id);
        $this->db->delete('Cart_Item');
    }

    private function get_or_create_cart($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $cart = $this->db->get('Cart')->row_array();

        if ($cart) {
            return $cart['id'];
        } else {
            $data = ['customer_id' => $customer_id];
            $this->db->insert('Cart', $data);
            return $this->db->insert_id();
        }
    }

    public function remove_from_cart($customer_id, $product_id) {
        $cart_id = $this->get_or_create_cart($customer_id);
    
        $this->db->where('cart_id', $cart_id);
        $this->db->where('product_id', $product_id);
        $this->db->delete('Cart_Item');
    }
    
}
?>
