<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model', 'MCart');
    }

    private function _initializeCartData($user_id)
    {
        $carts = $this->MCart->getCarts($user_id);
        $total_cart = $this->MCart->getTotalCart($user_id);
        $this->session->set_userdata('carts', $carts);
        $this->session->set_userdata('total_cart', $total_cart);
    }

    public function index()
    {
        $this->load->model('Shop_model', 'MShop');

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $randNumber = rand(1, 127);
        $data['product'] = $this->MShop->getProducts(3, $randNumber);

        if ($data['user'] && isset($data['user']['user_id'])) {
            $this->_initializeCartData($data['user']['user_id']);
        }

        $this->load->view('templates/main_header', $data);
        $this->load->view('main/home');
        $this->load->view('templates/main_footer');
    }

    public function contact()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        if ($data['user'] && isset($data['user']['user_id'])) {
            $this->_initializeCartData($data['user']['user_id']);
        }

        $this->load->view('templates/main_header', $data);
        $this->load->view('main/contact');
        $this->load->view('templates/main_footer');
    }
}
