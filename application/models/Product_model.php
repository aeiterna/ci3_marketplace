<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    public function delete_product($id) {
        $this->db->set('status', 'inactive');
        $this->db->where('id', $id);
        $this->db->update('product');
    
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function get_all_products() {
        $this->db->select('Product.*, Category.name as category_name');
        $this->db->join('Category', 'Product.category_id = Category.id');
        $this->db->where('Product.status', 'active');
        return $this->db->get('Product')->result();
    }
    
    public function get_product_by_id($id) {
        $this->db->select('Product.*, Product_detail.date_created, Product_detail.sales');
        $this->db->join('Product_detail', 'Product.id = Product_detail.product_id');
        return $this->db->get_where('Product', ['Product.id' => $id])->row();
    }
 
    public function add_product($data, $detail_data) {
        $this->db->insert('Product', $data);
        $product_id = $this->db->insert_id();
        $detail_data['product_id'] = $product_id;
        $this->db->insert('Product_detail', $detail_data);
        return $product_id;
    }

    public function update_product($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('Product', $data);
    
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_categories() {
        return $this->db->get('Category')->result();
    }

    public function get_recent_products($limit = 4) {
        $this->db->select('Product.*, Product_Detail.date_created');
        $this->db->from('Product');
        $this->db->join('Product_Detail', 'Product.id = Product_Detail.product_id');
        $this->db->where('Product.status', 'active');
        $this->db->order_by('Product_Detail.date_created', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    public function get_best_sellers($limit = 4) {
        $this->db->select('Product.*, Product_Detail.sales');
        $this->db->from('Product');
        $this->db->join('Product_Detail', 'Product.id = Product_Detail.product_id');
        $this->db->where('Product.status', 'active');
        $this->db->order_by('Product_Detail.sales', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
    
    public function increment_views($id) {
        $this->db->set('views', 'views + 1', FALSE);
        $this->db->where('product_id', $id);
        $this->db->update('Product_Detail');
    }
    
    public function get_most_viewed($limit = 4) {
        $this->db->select('Product.*, Product_Detail.views');
        $this->db->from('Product');
        $this->db->join('Product_Detail', 'Product.id = Product_Detail.product_id');
        $this->db->where('Product.status', 'active');
        $this->db->order_by('Product_Detail.views', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
}
?>
