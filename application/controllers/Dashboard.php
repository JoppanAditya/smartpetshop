<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_employee();
    }

    public function index($period = 'all-time')
    {
        $this->load->model('Trans_model', 'MTrans');
        $this->load->model('Products_model', 'MProducts');
        $this->load->model('User_model', 'MUser');

        $current_year = date('Y');

        $data = [
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
            'title' => 'Dashboard',
            'total_transaction' => $this->MTrans->getTotalTransactions(),
            'total_product' => $this->MProducts->getTotalProducts(),
            'total_sales' => $this->MTrans->getTotalSales(),
            'total_customer' => $this->MUser->getTotalCustomers(),
            'monthly_sales' => $this->MTrans->getMonthlySales($current_year),
            'transactions' => $this->MTrans->getTransactionsByPeriod($period),
            'selected_period' => $period

        ];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer', $data);
    }
}
