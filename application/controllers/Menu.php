<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_admin();
        $this->load->model('Menu_model', 'Mmenu');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Menu Management';

        $data['menu'] = $this->Mmenu->getMenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getMenuDetail($id)
    {
        $menuDetail = $this->Mmenu->getMenuById($id);
        echo json_encode($menuDetail);
    }

    public function saveMenu($id = null)
    {
        $data['menu'] = $this->input->post('menu');

        if (empty($data['menu'])) {
            echo json_encode(['error' => true, 'message' => 'Menu title is required']);
            return;
        }

        if (!empty($id)) {
            $data['menu_id'] = $id;
        }


        $result = $this->Mmenu->saveMenu($data);

        if ($result) {
            $message = empty($id) ? 'New menu added' : 'Menu updated successfuly';
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('status', 'success');


            echo json_encode(['success' => true]);
        } else {
            $this->session->set_flashdata('message', 'Failed to save menu');
            $this->session->set_flashdata('status', 'error');

            echo json_encode(['error' => false]);
        }
    }

    public function deleteMenu($id)
    {
        $this->Mmenu->deleteMenu($id);
        $this->session->set_flashdata('message', 'Menu deleted successfully');
        $this->session->set_flashdata('status', 'success');
        redirect('menu');
    }

    public function submenu()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Submenu Management';
        $data['isActive'] = [1 => 'Active', 0 => 'Not Active'];

        $data['submenu'] = $this->Mmenu->getSubmenu();
        $data['menu'] = $this->Mmenu->getMenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getSubmenuDetail($id)
    {
        $submenuDetail = $this->Mmenu->getSubmenuById($id);
        echo json_encode($submenuDetail);
    }

    public function saveSubmenu($id = null)
    {
        $data['title'] = $this->input->post('title');
        $data['menu_id'] = $this->input->post('menu_id');
        $data['url'] = $this->input->post('url');
        $data['icon'] = $this->input->post('icon');
        $data['is_active'] = $this->input->post('is_active');

        $validationErrors = $this->_validate($data);
        if (!empty($validationErrors)) {
            echo  json_encode(['error' => true, 'errors' => $validationErrors]);
            return;
        }

        if (!empty($id)) {
            $data['submenu_id'] = $id;
        }

        $result = $this->Mmenu->saveSubmenu($data);

        if ($result) {
            $message = !empty($id) ? 'Submenu updated successfully' : 'New submenu added';
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('status', 'success');
            echo json_encode(['success' => true]);
        } else {
            $this->session->set_flashdata('message', 'Failed to save submenu');
            $this->session->set_flashdata('status', 'success');
            echo json_encode(['error' => false]);
        }
    }

    public function deleteSubmenu($id)
    {
        $this->Mmenu->deleteSubmenu($id);
        $this->session->set_flashdata('message', 'Submenu deleted successfully');
        $this->session->set_flashdata('status', 'success');
        redirect('menu/submenu');
    }

    private function _validate($data)
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors['title'] = 'Sub Menu title is required';
        }
        if (empty($data['menu_id'])) {
            $errors['menu_id'] = 'Menu field is required';
        }
        if (empty($data['url'])) {
            $errors['url'] = 'URL field is required';
        }
        if (empty($data['icon'])) {
            $errors['icon'] = 'Icon field is required';
        }
        if (!isset($data['is_active']) || ($data['is_active'] !== "0" && empty($data['is_active']))) {
            $errors['is_active'] = 'Active field is required';
        }

        return $errors;
    }
}
