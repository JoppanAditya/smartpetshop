<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Shop_model', 'MShop');
        $this->load->library('pagination');
        $this->load->model('Cart_model', 'MCart');
    }

    private function _initializeCartData($user_id)
    {
        if ($user_id) {
            $carts = $this->MCart->getCarts($user_id);
            $total_cart = $this->MCart->getTotalCart($user_id);
            $this->session->set_userdata('carts', $carts);
            $this->session->set_userdata('total_cart', $total_cart);
        }
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['category'] = $this->MShop->getCategories();

        if ($data['user'] && isset($data['user']['user_id'])) {
            $this->_initializeCartData($data['user']['user_id']);
        }

        $data['keyword'] = $this->input->get('q') ?: '';
        $category = $this->input->get('sc') ?: '';
        $min_price = $this->input->get('minP') ?: '';
        $max_price = $this->input->get('maxP') ?: '';
        $rating = $this->input->get('r') ?: '';
        $sort_by = $this->input->get('sb') ?: '';

        $config['total_rows'] = $this->MShop->countFilteredProducts($data['keyword'], $category, $min_price, $max_price, $rating);
        $config['per_page'] = 20;
        $config['last_link'] = round($config['total_rows'] / 20);

        $this->pagination->initialize($config);

        $page = $this->input->get('page') ?: 1;

        $data['start'] = ($page - 1) * $config['per_page'];
        $data['products'] = $this->MShop->getProducts($config['per_page'], $data['start'], $data['keyword'], $category, $min_price, $max_price, $rating, $sort_by);
        $data['total_rows'] = $config['total_rows'];
        $data['selected_category'] = $category;
        $data['min_price'] = $min_price;
        $data['max_price'] = $max_price;
        $data['rating'] = $rating;
        $data['sort_by'] = $sort_by;

        $this->load->view('templates/main_header', $data);
        $this->load->view('main/shop', $data);
        $this->load->view('templates/main_footer');
    }

    public function product($id)
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['product'] = $this->MShop->getProductById($id);
        $data['similarProducts'] = $this->MShop->getProducts(12, 1, $data['product']['category_name']);

        if ($data['user'] && isset($data['user']['user_id'])) {
            $this->_initializeCartData($data['user']['user_id']);
        }

        $this->load->view('templates/main_header', $data);
        $this->load->view('main/product', $data);
        $this->load->view('templates/main_footer');
    }

    public function addCart()
    {
        $this->load->model('Cart_model', 'MCart');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|integer|greater_than[0]|less_than_equal_to[20]');
        $this->form_validation->set_rules('notes', 'Notes');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', validation_errors());
            $this->session->set_flashdata('status', 'erreor');
            redirect('shop/product/' . $this->input->post('product_id'));
        } else {
            $data = [
                'product_id' => $this->input->post('product_id'),
                'user_id' => $this->input->post('user_id'),
                'quantity' => $this->input->post('quantity'),
                'notes' => $this->input->post('notes')
            ];

            $result = $this->MCart->addCart($data);

            if ($result) {
                $this->session->set_flashdata('message', 'Product added to cart successfully');
                $this->session->set_flashdata('status', 'success');
            } else {
                $this->session->set_flashdata('message', ' Failed to add product to cart');
                $this->session->set_flashdata('status', 'error');
            }

            redirect('shop/product/' . $this->input->post('product_id'));
        }
    }
}
