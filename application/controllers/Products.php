<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_employee();
        $this->load->library('upload');
        $this->load->model('Products_model', 'MProducts');
        $this->load->model('Category_model', 'MCategory');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Product Management';

        $data['products'] = $this->MProducts->getProducts();
        $data['category'] = $this->MCategory->getCategories();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('products/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getProductDetail($id)
    {
        $detail = $this->MProducts->getProductById($id);
        echo json_encode($detail);
    }

    public function saveProduct($id = null)
    {
        $originalProduct = $this->MProducts->getProductById($id);

        $data['id'] = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $data['tag'] = $this->input->post('tag');
        $data['category_id'] = $this->input->post('category_id');
        $data['description'] = $this->input->post('description');
        $data['stock'] = $this->input->post('stock');
        $data['buy_price'] = $this->input->post('buy_price');
        $data['sell_price'] = $this->input->post('sell_price');

        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './assets/img/product/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 2048;

            $random_number = rand(1, 9999);
            $file_name = $random_number . '-' . $_FILES['image']['name'];
            $config['file_name'] = $file_name;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                $response = [
                    'error' => true,
                    'errors' => ['image' => $this->upload->display_errors()]
                ];
                echo json_encode($response);
                return;
            } else {
                $upload_data = $this->upload->data();
                $data['image'] = $upload_data['file_name'];
            }
        } else {
            if (isset($originalProduct) || !empty($originalProduct)) {
                $data['image'] = $originalProduct['image'];
            } else {
                $data['image'] = 'default.jpeg';
            }
        }

        $validationErrors = $this->_validateProduct($data);
        if (!empty($validationErrors)) {
            echo  json_encode(['error' => true, 'errors' => $validationErrors]);
            return;
        }

        if (!empty($id)) {
            $data['product_id'] = $id;
        }

        $result = $this->MProducts->saveProduct($data);

        if ($result) {
            $message = empty($id) ? 'New product added' : 'Product updated successfully';
            $this->session->set_flashdata('status', 'success');
            $this->session->set_flashdata('message', $message);

            echo json_encode(['success' => true]);
        } else {
            $message = empty($id) ? 'Failed to add product. ID already exists' : 'Failed to update product';
            $this->session->set_flashdata('status', 'error');
            $this->session->set_flashdata('message', $message);

            echo json_encode(['error' => false]);
        }
    }

    public function deleteProduct($id)
    {
        $this->MProducts->deleteProduct($id);
        $this->session->set_flashdata('message', 'Product deleted successfully');
        $this->session->set_flashdata('status', 'success');
        redirect('products');
    }

    public function category()
    {
        $this->load->model('Category_model', 'MCategory');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Category Management';

        $data['category'] = $this->MCategory->getCategories();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('products/category', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getCategoryDetail($id)
    {
        $detail = $this->MCategory->getCategoryById($id);
        echo json_encode($detail);
    }

    public function saveCategory($id = null)
    {
        $data = [
            'name' => $this->input->post('name')
        ];

        $validationErrors = $this->_validateCategory($data);
        if (!empty($validationErrors)) {
            echo  json_encode(['error' => true, 'errors' => $validationErrors]);
            return;
        }

        if (isset($id)) {
            $data['id'] = $id;
        }

        $result = $this->MCategory->saveCategory($data);

        if ($result) {
            $message = isset($id) ? 'Category updated successfully' : 'New category added';
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('status', 'success');
            echo json_encode(['success' => true]);
        } else {
            $this->session->set_flashdata('message', 'Failed to save category');
            $this->session->set_flashdata('status', 'error');
            echo json_encode(['error' => false]);
        }
    }

    public function deleteCategory($id)
    {
        $this->MCategory->deleteCategory($id);
        $this->session->set_flashdata('message', 'Category deleted successfully');
        $this->session->set_flashdata('status', 'success');
        redirect('products/category');
    }

    private function _validateProduct($data)
    {
        $errors = [];

        if (empty($data['id'])) {
            $errors['id'] = 'Product ID is required';
        }
        if (empty($data['name'])) {
            $errors['name'] = 'Product name is required';
        }
        if (empty($data['tag'])) {
            $errors['tag'] = 'Tag is required';
        }
        if (empty($data['category_id'])) {
            $errors['category_id'] = 'Category is required';
        }
        if (empty($data['stock']) || !is_numeric($data['stock'])) {
            $errors['stock'] = 'Stock must be a number and is required';
        }
        if (empty($data['buy_price']) || !is_numeric($data['buy_price'])) {
            $errors['buy_price'] = 'Buy price must be a number and is required';
        }
        if (empty($data['sell_price']) || !is_numeric($data['sell_price'])) {
            $errors['sell_price'] = 'Sell price must be a number and is required';
        }

        return $errors;
    }

    private function _validateCategory($data)
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = 'Category name is required';
        }
        return $errors;
    }
}
