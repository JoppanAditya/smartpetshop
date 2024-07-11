<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->model('Login_model', 'Mlogin');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect($this->agent->referrer());
        }

        $data['title'] = 'Login | Smart Petshop Admin';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $errors = [];
        if (empty($username)) {
            $errors['username'] = 'Username is required';
        }
        if (empty($password)) {
            $errors['password'] = 'Password is required';
        }

        if (!empty($errors)) {
            echo  json_encode(['error' => true, 'errors' => $errors]);
            return;
        }

        $user = $this->Mlogin->check_db($username);

        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'level_id' => $user['level_id']
                    ];
                    $this->session->set_userdata($data);

                    $this->session->set_flashdata('message', 'Login successful');
                    $this->session->set_flashdata('status', 'success');

                    echo json_encode(['error' => false, 'level_id' => $user['level_id']]);
                } else {
                    $this->session->set_flashdata('message', 'Wrong password');
                    $this->session->set_flashdata('status', 'error');
                    return;
                }
            } else {
                $this->session->set_flashdata('message', 'User not activated');
                $this->session->set_flashdata('status', 'error');
                return;
            }
        } else {
            $this->session->set_flashdata('message', 'Username not registered');
            $this->session->set_flashdata('status', 'error');
            return;
        }
    }

    public function register()
    {
        if ($this->session->userdata('username')) {
            redirect($this->agent->referrer());
        }

        $this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'This username has already registered!'
        ]);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[5]|matches[password2]', [
            'matches' => 'Password don\'t match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Register | Smart Petshop Admin';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'fullname' => htmlspecialchars($this->input->post('fullname', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'phone' => $this->input->post('phone', true),
                'level_id' => 3,
                'is_active' => 1,
                'date_created' => time()
            ];

            if ($this->Mlogin->insert_user($data)) {
                $this->session->set_flashdata(
                    'message',
                    'Your account has been created. Please login'
                );
                $this->session->set_flashdata('status', 'success');
                redirect(base_url());
            } else {
                $this->session->set_flashdata(
                    'message',
                    'Failed to create account. Please try again'
                );
                $this->session->set_flashdata('status', 'error');
                redirect('auth/register');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('level_id');
        $this->session->set_flashdata(
            'message',
            'You have been logged out'
        );
        $this->session->set_flashdata('status', 'success');
        redirect(base_url());
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
