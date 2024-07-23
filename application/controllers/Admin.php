<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
        $this->load->helper('string');
        $this->load->model('Category_model');
        $this->load->model('Product_model');
        $this->load->model('Order_model');
        $this->load->model('Profit_model');

        $allowed_methods = array('index', 'logout');
        if (!$this->session->userdata('admin_id') && !in_array($this->router->fetch_method(), $allowed_methods)) {
            $this->session->set_flashdata('error', 'You must be logged in to access this page.');
            redirect('admin');
        }
    }

    public function index() {
        $error_message = $this->session->flashdata('error');
    
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
    
            $user_data = $this->db->get_where('admin', array('username' => $username))->row();
    
            if (!empty($user_data)) {
                $stored_password = $user_data->password;
    
                if (password_verify($password, $stored_password)) {
                    $this->session->set_userdata('admin_id', $user_data->id);
                } else {
                    $this->session->set_flashdata('error', 'Invalid username or password');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
            }
        }
    
        if ($this->session->userdata('admin_id')) {
            $user_id = $this->session->userdata('admin_id');
    
            $page_data['user_data'] = $this->db->get_where('admin', array('id' => $user_id))->row_array();
            $page_data['page_title'] = 'Main';
            $page_data['page'] = 'dashboard';
    
            $this->load->view('admin/index', $page_data);
        } else {
            $page_data['page_title'] = 'Login Admin';
            $page_data['error_message'] = $error_message;
            $this->load->view('admin/login', $page_data);
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect('admin');
    }

    public function category($action, $id = false) {
        $page_data = array();
        $page_data['page_title'] = 'Categories';
        
        switch ($action) {
            case 'view':
                $page_data['categories'] = $this->Category_model->get_all_categories();
                $page_data['action'] = 'view';
                break;

            case 'add':
                if ($this->input->post()) {
                    $this->load->helper('string');
                    $name = $this->input->post('name');
                    $slug = url_title($name, 'dash', TRUE);
                    $image = $_FILES['image']['name'];
                    
                    if ($image) {
                        $image_name = 'category' . random_string('numeric', 6) . '.' . pathinfo($image, PATHINFO_EXTENSION);
                        $config['upload_path'] = './uploads/category/';
                        $config['allowed_types'] = 'jpg|jpeg|png';
                        $config['file_name'] = $image_name;

                        $this->load->library('upload', $config);
                        
                        if ($this->upload->do_upload('image')) {
                            $data = [
                                'name' => $name,
                                'slug' => $slug,
                                'image' => $image_name
                            ];

                            if ($this->Category_model->add_category($data)) {
                                $page_data['message'] = "Category added successfully!";
                            } else {
                                $page_data['message'] = "Failed to add category.";
                            }
                        } else {
                            $page_data['message'] = $this->upload->display_errors();
                        }
                    } else {
                        $page_data['message'] = "Image is required.";
                    }
                }
                $page_data['action'] = 'add';
                break;

            case 'edit':
                if ($id) {
                    if ($this->input->post()) {
                        $name = $this->input->post('name');
                        $slug = url_title($name, 'dash', TRUE);
                        $image = $_FILES['image']['name'];

                        $data = [
                            'name' => $name,
                            'slug' => $slug
                        ];

                        if ($image) {
                            $image_name = 'category' . random_string('numeric', 6) . '.' . pathinfo($image, PATHINFO_EXTENSION);
                            $config['upload_path'] = './uploads/category/';
                            $config['allowed_types'] = 'jpg|jpeg|png';
                            $config['file_name'] = $image_name;

                            $this->load->library('upload', $config);
                            
                            if ($this->upload->do_upload('image')) {
                                $data['image'] = $image_name;
                            } else {
                                $page_data['message'] = $this->upload->display_errors();
                            }
                        }

                        if ($this->Category_model->update_category($id, $data)) {
                            redirect('admin/category');
                        } else {
                            $page_data['message'] = "Failed to update category.";
                        }
                    } else {
                        $page_data['category'] = $this->Category_model->get_category_by_id($id);
                    }
                }
                $page_data['action'] = 'edit';
                break;

            case 'delete':
                if ($id && $this->Category_model->delete_category($id)) {
                    redirect('admin/category');
                }
                break;

            default:
                redirect('admin/category');
                break;
        }
        
        $page_data['page'] = 'category/' . $action;
        $this->load->view('admin/index', $page_data);
    }   

    public function product($action, $id = false) {
        $page_data = array();
        $page_data['page'] = 'product/' . $action;
        $page_data['page_title'] = 'Product';
        
        switch ($action) {
            case 'view':
                $page_data['products'] = $this->Product_model->get_all_products();
                $page_data['action'] = 'view';
                break;

            case 'add':
                $page_data['categories'] = $this->Product_model->get_all_categories();
                $page_data['action'] = 'add';
                if ($this->input->post()) {
                    $this->load->helper('string');
                    $name = $this->input->post('name');
                    $category_id = $this->input->post('category_id');
                    $price = $this->input->post('price');
                    $description = $this->input->post('description');
                    $image = $_FILES['image']['name'];
                    
                    if ($image) {
                        $image_name = 'product' . random_string('numeric', 6) . '.' . pathinfo($image, PATHINFO_EXTENSION);
                        $config['upload_path'] = './uploads/product/';
                        $config['allowed_types'] = 'jpg|jpeg|png';
                        $config['file_name'] = $image_name;

                        $this->load->library('upload', $config);
                        
                        if ($this->upload->do_upload('image')) {
                            $data = [
                                'name' => $name,
                                'category_id' => $category_id,
                                'price' => $price,
                                'description' => $description,
                                'image' => $image_name
                            ];

                            $detail_data = [
                                'date_created' => date('Y-m-d H:i:s')
                            ];

                            if ($this->Product_model->add_product($data, $detail_data)) {
                                $page_data['message'] = "Product added successfully!";
                            } else {
                                $page_data['message'] = "Failed to add product.";
                            }
                        } else {
                            $page_data['message'] = $this->upload->display_errors();
                        }
                    } else {
                        $page_data['message'] = "Image is required.";
                    }
                }
                break;

            case 'edit':
                $page_data['action'] = 'edit';
                if ($id) {
                    $page_data['categories'] = $this->Product_model->get_all_categories();
                    if ($this->input->post()) {
                        $name = $this->input->post('name');
                        $category_id = $this->input->post('category_id');
                        $price = $this->input->post('price');
                        $description = $this->input->post('description');
                        $image = $_FILES['image']['name'];

                        $data = [
                            'name' => $name,
                            'category_id' => $category_id,
                            'price' => $price,
                            'description' => $description
                        ];

                        $detail_data = [
                            'date_created' => $this->input->post('date_created')
                        ];

                        if ($image) {
                            $image_name = 'product' . random_string('numeric', 6) . '.' . pathinfo($image, PATHINFO_EXTENSION);
                            $config['upload_path'] = './uploads/product/';
                            $config['allowed_types'] = 'jpg|jpeg|png';
                            $config['file_name'] = $image_name;

                            $this->load->library('upload', $config);
                            
                            if ($this->upload->do_upload('image')) {
                                $data['image'] = $image_name;
                            } else {
                                $page_data['message'] = $this->upload->display_errors();
                            }
                        }

                        if ($this->Product_model->update_product($id, $data, $detail_data)) {
                            redirect('admin/product');
                        } else {
                            $page_data['message'] = "Failed to update product.";
                        }
                    } else {
                        $page_data['product'] = $this->Product_model->get_product_by_id($id);
                    }
                }
                break;
        }

        $this->load->view('admin/index', $page_data);
    }

    public function delete_product($id) {
        if ($id) {
            if ($this->Product_model->delete_product($id)) {
                redirect('admin/product');
            } else {
                echo "Failed to delete product.";
            }
        } else {
            redirect('admin/product');
        }
    }

    public function order($action = 'view', $id = NULL) {
        $page_data = array();
        $page_data['page'] = 'order/' . $action;
        $page_data['page_title'] = 'Order';
    
        if ($action == 'view') {
            $page_data['orders'] = $this->Order_model->get_all_orders();
            $page_data['action'] = 'view';
        } elseif ($action == 'details' && $id) {
            $page_data['order'] = $this->Order_model->get_order_by_id($id);
            $page_data['order_items'] = $this->Order_model->get_order_items_by_order_id($id);
            $page_data['action'] = 'details';
        }
    
        $this->load->view('admin/index', $page_data);
    }
    
    public function customer() {
        $page_data = array();
        $page_data['page'] = 'customer/view';
        $page_data['action'] = 'view';
        $page_data['customers'] = $this->db->get('Customer')->result();
        $page_data['page_title'] = 'Customer';

        $this->load->view('admin/index', $page_data);
    }
    
    public function profit() {
        $date2 = date('Y-m-d', strtotime('+1 day'));
        $date1 = date('Y-m-d', strtotime('-3 months', strtotime($date2)));

        if ($this->input->post('submit')) {
            $date1 = $this->input->post('date1');
            $date2 = $this->input->post('date2');
        }

        $page_data['date1'] = $date1;
        $page_data['date2'] = $date2;
        $page_data['profits'] = $this->Profit_model->get_profit($date1, $date2);
        $page_data['page'] = 'profit/view';
        $page_data['action'] = 'view';
        $page_data['page_title'] = 'Profit';

        $this->load->view('admin/index', $page_data);
    }

    public function login() {
        $this->load->view('customer/login');
    }

    public function process() {
        $username = $this->input->post('username');
        $password = $this->input->post('pass');

        $user = $this->login_model->getUserByUsername($username);

        if ($user) {
            if (password_verify($password, $user->password)) {
                $this->session->set_userdata('user', $user->nama);
                $this->session->set_userdata('kd_cs', $user->kode_customer);
                redirect('index.php');
            } else {
                $data['error_message'] = 'Username/password salah';
                $this->load->view('user_login', $data);
            }
        } else {
            $data['error_message'] = 'Username/password salah';
            $this->load->view('user_login', $data);
        }
    }

    public function register() {
        $this->load->view('customer/register');
    }

    public function register_process() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('customer/register');
        } else {
            $data = [
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];

            if ($this->Register_model->check_email($data['email']) > 0) {
                $this->session->set_flashdata('message', 'EMAIL SUDAH DIGUNAKAN');
                redirect('customer/register');
            } else {
                if ($this->Register_model->register($data)) {
                    $this->session->set_flashdata('message', 'REGISTER BERHASIL');
                    redirect('customer/login');
                } else {
                    $this->session->set_flashdata('message', 'REGISTER GAGAL');
                    redirect('customer/register');
                }
            }
        }
    }
}
?>