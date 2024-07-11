<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_admin();
        $this->load->model('User_model', 'MUser');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'User';

        $data['users'] = $this->MUser->getUsers();
        $data['user_level'] = $this->MUser->getUserLevel();
        $data['isActive'] = [1, 0];

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getUserDetail($id)
    {
        $userDetail = $this->MUser->getUserById($id);
        echo json_encode($userDetail);
    }

    public function addUser()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $data = [
            'username' => htmlspecialchars($input['username']),
            'fullname' => htmlspecialchars($input['fullname']),
            'email' => htmlspecialchars($input['email']),
            'password' => password_hash($input['password'], PASSWORD_DEFAULT),
            'image' => 'default.jpg',
            'phone' => $input['phone'],
            'level_id' => $input['level_id'],
            'is_active' => 1,
            'date_created' => time()
        ];

        $validationErrors = $this->_validate($data, $input);
        if (!empty($validationErrors)) {
            echo json_encode(['error' => true, 'errors' => $validationErrors]);
            return;
        }

        $result = $this->MUser->addUser($data);

        if ($result) {
            $this->session->set_flashdata('message', 'New user added');
            $this->session->set_flashdata('status', 'success');
            echo json_encode(['success' => true]);
        } else {
            $this->session->set_flashdata('message', 'Failed to add user');
            $this->session->set_flashdata('status', 'error');
            echo json_encode(['error' => false]);
        }
    }

    public function updateUser()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $fullname = $input['fullname'];
        $email = $input['email'];
        $password = $input['password'];


        $errors = [];

        if (empty($fullname)) {
            $errors['fullname'] = 'Fullname is required';
        }
        if (empty($email)) {
            $errors['email'] = 'Email is required';
        }
        if (!empty($password) && strlen($password) < 5) {
            $errors['password'] = 'Password must be at least 5 characters long';
        }

        if (!empty($errors)) {
            echo json_encode(['error' => true, 'errors' => $errors]);
            return;
        }

        $result = $this->MUser->updateUser($input);

        if ($result) {
            $this->session->set_flashdata('message', 'User updated successfully');
            $this->session->set_flashdata('status', 'success');
            echo json_encode(['success' => true]);
        } else {
            $this->session->set_flashdata('message', 'Failed to update user');
            $this->session->set_flashdata('status', 'error');
            echo json_encode(['error' => false]);
        }
    }

    public function deleteUser($id)
    {
        $this->MUser->deleteUser($id);
        $this->session->set_flashdata('message', 'User deleted successfully');
        $this->session->set_flashdata('status', 'success');
        redirect('user');
    }

    public function level()
    {
        $this->load->model('Menu_model', 'Mmenu');

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'User Level';

        $data['level'] = $this->MUser->getUserLevel();
        $data['menu'] = $this->Mmenu->getMenu();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('user/user_level', $data);
        $this->load->view('templates/footer', $data);
    }

    public function getLevelDetail($id)
    {
        $levelDetail = $this->MUser->getLevelById($id);
        echo json_encode($levelDetail);
    }

    public function saveLevel()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $data = [
            'level_name' => htmlspecialchars($input['level_name'])
        ];

        if (empty($data['level_name'])) {
            echo json_encode(['error' => 'Level name is required']);
            return;
        }

        if (isset($input['level_id'])) {
            $data['level_id'] = $input['level_id'];
        }

        $result = $this->MUser->saveLevel($data);

        if ($result) {
            $message = isset($input['level_id']) ? 'Level updated successfully' : 'New level added';
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('status', 'success');
            echo json_encode(['success' => true]);
        } else {
            $this->session->set_flashdata('message', 'Failed to save level');
            $this->session->set_flashdata('status', 'error');
            echo json_encode(['error' => false]);
        }
    }

    public function deleteLevel($id)
    {
        $this->MUser->deleteLevel($id);
        $this->session->set_flashdata('message', 'Level deleted successfully');
        $this->session->set_flashdata('status', 'success');
        redirect('user/level');
    }

    private function _validate($data, $input)
    {
        $errors = [];

        if (empty($data['username'])) {
            $errors['username'] = 'Username is required';
        }
        if (empty($data['fullname'])) {
            $errors['fullname'] = 'Fullname is required';
        }
        if (empty($data['email'])) {
            $errors['email'] = 'Email is required';
        }
        if (empty($input['password'])) {
            $errors['password'] = 'Password is required';
        }
        if (strlen($input['password']) < 5) {
            $errors['password'] = 'Password must be at least 5 characters long';
        }
        if (empty($data['level_id'])) {
            $errors['level_id'] = 'Level is required';
        }

        return $errors;
    }

    public function checkAccess()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $level_id = $data['level_id'];
        $menu_id = $data['menu_id'];

        $this->load->helper('login');
        $access = check_access($level_id, $menu_id) ? true : false;

        echo json_encode(['access' => $access]);
    }

    public function updateAccess()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $level_id = $input['level_id'];
        $menu_id = $input['menu_id'];

        $data = [
            'level_id' => $level_id,
            'menu_id' => $menu_id,
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', 'Access changed');
        $this->session->set_flashdata('status', 'success');
    }
}
