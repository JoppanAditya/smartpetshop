<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_employee();
        $this->load->model('Trans_model', 'MTrans');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Transaction Lists';
        $data['transactions'] = $this->MTrans->getTransactions();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('trans/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detail($id)
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Transaction Detail';
        $data['trans_detail'] = $this->MTrans->getTransactionDetails($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('trans/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getTransById($id)
    {
        $detail = $this->MTrans->getTransById($id);
        echo json_encode($detail);
    }

    public function updateStatus($id)
    {
        $status = $this->input->post('status');
        $result = $this->MTrans->updateStatus($id, $status);
        if ($result) {
            $this->session->set_flashdata('message', 'Status updated succesfully');
            $this->session->set_flashdata('status', 'success');
            echo json_encode(['success' => true]);
        } else {
            $this->session->set_flashdata('message', 'Failed to update status');
            $this->session->set_flashdata('status', 'error');
            echo json_encode(['error' => true]);
        }
    }
}
