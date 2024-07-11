<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Trans_model', 'MTrans');
    }

    public function index()
    {
        $invoiceId = $this->input->get('id');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['transaction'] = $this->MTrans->getTransByInvoice($invoiceId);
        $data['items'] = $this->MTrans->getTransactionDetails($data['transaction']['id']);

        $this->load->view('main/invoice', $data);
    }
}
