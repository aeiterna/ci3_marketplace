<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Product_model');
        $this->load->model('Category_model');
        $this->load->model('Customer_model');
        $this->load->model('Order_model');
        $this->load->model('Cart_model');
        $this->load->library('form_validation');
        $this->load->model('Register_model');
        $this->load->model('Login_model');
        $this->load->library('email');
        $this->load->helper(array('url', 'form'));
    }

    public function index() {
        $data['categories'] = $this->Category_model->get_all_categories();
        $data['recent_products'] = $this->Product_model->get_recent_products(4);
        $data['best_sellers'] = $this->Product_model->get_best_sellers(4);
        $data['most_viewed'] = $this->Product_model->get_most_viewed(4);
        $this->load->view('customer/index', $data);
    }
    
    public function product($category_id = null) {
        if ($category_id === null) {
            $this->db->where('status', 'active');
            $products = $this->db->get('product')->result();
        } else {
            $this->db->where('category_id', $category_id);
            $this->db->where('status', 'active');
            $products = $this->db->get('product')->result();
        }
    
        $this->load->view('customer/product', ['products' => $products, 'category_id' => $category_id]);
    }
    
    public function product_detail($id) {
        $data['product'] = $this->Product_model->get_product_by_id($id);
        $this->Product_model->increment_views($id);
        $this->load->view('customer/product_detail', $data);
    }

    public function add_to_cart() {
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('redirect_to', current_url());
            redirect('customer/login');
        }
    
        $product_id = $this->input->post('product_id');
        $qty = $this->input->post('qty');
        $customer_id = $this->session->userdata('customer_id');
        $this->Cart_model->add_to_cart($customer_id, $product_id, $qty);
        redirect('customer/cart');
    }

    public function cart() {
        if (!$this->session->userdata('logged_in')) {
            redirect('customer/login');
        }
    
        $customer_id = $this->session->userdata('customer_id');
        $data['cart_items'] = $this->Cart_model->get_cart_items($customer_id);
        $this->load->view('customer/cart', $data);
    }
    
    public function update_cart() {
        if (!$this->session->userdata('logged_in')) {
            redirect('customer/login');
        }
    
        $product_id = $this->input->post('product_id');
        $qty = $this->input->post('qty');
        $customer_id = $this->session->userdata('customer_id');
        $this->Cart_model->update_cart_item($customer_id, $product_id, $qty);
        $total = $this->Cart_model->calculate_total($customer_id);
    
        echo json_encode(['updated_total' => number_format($total, 0, ',', '.')]);
    }    
    
    public function remove_from_cart() {
        if (!$this->session->userdata('logged_in')) {
            redirect('customer/login');
        }
    
        $product_id = $this->input->post('product_id');
        $customer_id = $this->session->userdata('customer_id');
        $this->Cart_model->remove_from_cart($customer_id, $product_id);
        redirect('customer/cart');
    }
    
    public function checkout() {
        if (!$this->session->userdata('logged_in')) {
            redirect('customer/login');
        }
    
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('city', 'City', 'required');
        $this->form_validation->set_rules('post_code', 'Post Code', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $customer_id = $this->session->userdata('customer_id');
            $data['customer'] = $this->Customer_model->get_customer_by_id($customer_id);
            $this->load->view('customer/checkout', $data);
        } else {
            $customer_id = $this->session->userdata('customer_id');
            $total_price = $this->Cart_model->calculate_total($customer_id);
            $province = $this->input->post('province');
            $city = $this->input->post('city');
            $address = $this->input->post('address');
            $post_code = $this->input->post('post_code');
    
            $order_id = $this->Order_model->create_order($customer_id, $total_price, $province, $city, $address, $post_code);
            if ($order_id) {
                $cart_items = $this->Cart_model->get_cart_items($customer_id);
                $this->Order_model->create_order_items($order_id, $cart_items);
    
                $this->Cart_model->clear_cart($customer_id);
    
                $order_items = $this->Order_model->get_order_items_by_order_id($order_id);
                $order_details = "I wanted to order products below:\n";
                foreach ($order_items as $item) {
                    $order_details .= "- {$item->product_name} x{$item->quantity}\n";
                }
                $order_details .= "Total: Rp. {$total_price}\n";
                $order_details .= "Name: {$this->input->post('name')}\n";
                $order_details .= "Email: {$this->input->post('email')}\n";
                $order_details .= "Address: {$address}, {$city}, {$province}, {$post_code}\n";
    
                $whatsapp_url = "https://wa.me/628xxxxxxxxxx?text=" . urlencode($order_details);
                redirect($whatsapp_url);
            } else {
                $this->session->set_flashdata('error_message', 'Failed to create order. Please try again.');
                redirect('customer/checkout');
            }
        }
    }

    public function order_confirmation() {
        $this->load->view('customer/order_confirmation');
    }

    public function login() {
        if ($this->session->userdata('logged_in')) {
            redirect('customer');
        } else {
            $this->load->view('customer/login');
        }
    }
    
    public function process() {
        if ($this->session->userdata('logged_in')) {
            redirect('customer');
        }
    
        if (isset($_POST['login'])) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->Login_model->getUserByEmail($email);
    
            if ($user && password_verify($password, $user->password)) {
                if ($user->is_verified == 1) {
                    $this->session->set_userdata('customer_id', $user->id);
                    $this->session->set_userdata('name', $user->name);
                    $this->session->set_userdata('email', $user->email);

                    $this->session->set_userdata('logged_in', true);
                    $redirect_to = $this->session->flashdata('redirect_to') ?? 'customer';
                    redirect($redirect_to);
                } else {
                    $data['error_message'] = 'Your account is not verified. Please register again to verify your email.';
                    $this->load->view('customer/login', $data);
                }
            } else {
                $data['error_message'] = 'Invalid email/password';
                $this->load->view('customer/login', $data);
            }
        } else {
            $this->load->view('customer/login');
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
            $otp_code = random_int(100000, 999999);
            $otp_expiration = date('Y-m-d H:i:s', strtotime('+5 minutes'));
    
            $data = [
                'name' => $this->input->post('name'),
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'otp_code' => $otp_code,
                'otp_expiration' => $otp_expiration,
                'is_verified' => 0
            ];
    
            if ($this->Register_model->register($data)) {
                $this->session->set_userdata('email', $this->input->post('email'));
                $this->_send_otp_email($this->input->post('email'), $otp_code);
    
                redirect('customer/verify_otp');
            } else {
                $this->session->set_flashdata('message', 'Registration failed');
                redirect('customer/register');
            }
        }
    }
    
    public function resend_otp() {
        $email = $this->session->userdata('email');
        if ($email) {
            $otp_code = random_int(100000, 999999);
            $otp_expiration = date('Y-m-d H:i:s', strtotime('+5 minutes'));
    
            $data = [
                'otp_code' => $otp_code,
                'otp_expiration' => $otp_expiration
            ];
    
            $this->db->where('email', $email);
            $this->db->update('customer', $data);
    
            $this->_send_otp_email($email, $otp_code);
    
            $this->session->set_flashdata('message', 'OTP code resent to your email.');
            redirect('customer/verify_otp');
        } else {
            $this->session->set_flashdata('message', 'Email not found in session.');
            redirect('customer/register');
        }
    }
    
    private function _send_otp_email($email, $otp_code) {
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_port' => 587,
            'smtp_user' => 'name@gmail.com',
            'smtp_pass' => 'app password',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'smtp_crypto' => 'tls',
        );
    
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from('name@gmail.com', 'Email Verification');
        $this->email->to($email);
        $this->email->subject('OTP Code Verification');
        $this->email->message('Your OTP code is: ' . $otp_code);
        $this->email->send();
    }
    
    public function verify_otp() {
        $this->form_validation->set_rules('otp_code', 'OTP Code', 'required|numeric|exact_length[6]');
    
        if ($this->form_validation->run() == FALSE) {
            $data['email'] = $this->session->userdata('email');
            $this->load->view('customer/verify_otp', $data);
        } else {
            $otp_code = $this->input->post('otp_code');
            $email = $this->session->userdata('email');
    
            if ($this->Register_model->verify_otp($email, $otp_code)) {
                $this->session->set_flashdata('message', 'Account successfully verified');
                redirect('customer/login');
            } else {
                $this->session->set_flashdata('message', 'Invalid or expired OTP code');
                $data['email'] = $this->session->userdata('email');
                $this->load->view('customer/verify_otp', $data);
            }
        }
    }    

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('logged_in');
        redirect('customer/login');
    }
}
?>