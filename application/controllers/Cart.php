<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Cart_model', 'MCart');
    }

    public function index()
    {
        $this->load->model('Shop_model', 'MShop');

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['carts'] = $this->MCart->getCarts($data['user']['user_id']);
        $this->session->set_userdata('carts', $data['carts']);
        $this->session->set_userdata('total_cart', $this->MCart->getTotalCart($data['user']['user_id']));

        $randNumber = rand(1, 118);
        $data['products'] = $this->MShop->getProducts(12, $randNumber);

        $this->load->view('templates/main_header', $data);
        $this->load->view('main/cart');
        $this->load->view('templates/main_footer');
    }

    public function updateCart()
    {
        $product_id = $this->input->post('product_id');
        $user_id = $this->input->post('user_id');
        $quantity = $this->input->post('quantity');
        $notes = $this->input->post('notes');

        $this->MCart->updateCart($product_id, $user_id, $quantity, $notes);

        return;
    }

    public function deleteCart()
    {
        $product_id = $this->input->post('product_id');
        $user_id = $this->input->post('user_id');

        $this->MCart->deleteCart($user_id, $product_id);

        echo json_encode(['status' => 'success']);
        $this->session->set_flashdata('message', 'Product deleted successfully');
        $this->session->set_flashdata('status', 'success');
    }

    public function address()
    {
        if ($this->session->userdata('total_cart') > 0) {
            $this->load->model('Settings_model', 'MSettings');
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $data['carts'] = $this->MCart->getCarts($data['user']['user_id']);
            $data['products'] = $this->MCart->getProducts();
            $data['address'] = $this->MSettings->getAdrresses($data['user']['user_id']);

            $this->session->set_userdata('carts', $data['carts']);
            $this->session->set_userdata('total_cart', $this->MCart->getTotalCart($data['user']['user_id']));

            $this->load->view('main/cart_address', $data);
        } else {
            redirect('cart');
        }
    }

    public function payment()
    {
        if ($this->session->userdata('total_cart') > 0) {
            $data = [
                'delivery_fee' => $this->input->post('deliveryFee'),
                'service_fee' => $this->input->post('serviceFee'),
                'shopping_total' => $this->input->post('shoppingTotal'),
                'user_id' => $this->input->post('user_id'),
                'address_id' => $this->input->post('address_id'),
                'payment_method' => $this->input->post('paymentMethod'),
                'status' => 1,
                'date_created' => time()
            ];

            $date = date("Ymd");
            $randomNumber = rand(1, 9999);
            $data['id'] = $date . $randomNumber;
            $data['invoice'] = 'INV/' . $date . '/' . $randomNumber;

            $items = $this->input->post('items');

            $this->MCart->addTransactionDetail($items, $data['id']);
            $result = $this->MCart->addTransaction($data);

            if ($result) {
                foreach ($items as $item) {
                    $this->_updateStock($item['id'], $item['quantity']);
                }
                $this->MCart->deleteCart($data['user_id']);

                $this->session->set_flashdata('message', 'Transaction processed succesfully');
                $this->session->set_flashdata('status', 'success');

                $response = ['status' => 'success'];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            } else {
                $this->session->set_flashdata('message', 'Failed to proccess transaction');
                $this->session->set_flashdata('status', 'error');

                $response = ['status' => 'error'];
                $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
            }
        } else {
            redirect('cart');
        }
    }

    private function _updateStock($productId, $quantity)
    {
        $this->load->model('Products_model', 'MProduct');

        $product = $this->MProduct->getProductById($productId);

        $newStock = $product['stock'] - $quantity;

        $this->MProduct->updateProductStock($productId, $newStock);
    }
}
