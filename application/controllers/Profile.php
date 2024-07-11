<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_employee();
        $this->load->model('Profile_model', 'MProfile');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'My Profile';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'My Profile';

        $this->form_validation->set_rules('fullname', 'Full name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('profile/edit', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $result = $this->MProfile->updateProfile($data['user']);

            if ($result) {
                $this->session->set_flashdata('message', 'Your profile has been updated');
                $this->session->set_flashdata('status', 'success');
                redirect('profile');
            } else {
                $this->session->set_flashdata('message', 'Failed to update your profile');
                $this->session->set_flashdata('status', 'error');
                redirect('profile/edit');
            }
        }
    }

    public function change_pass()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'My Profile';

        $this->form_validation->set_rules('current_password', 'Current password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New password', 'required|trim|min_length[5]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('profile/change_pass', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', 'The current password you entered is incorrect. Please try again');
                $this->session->set_flashdata('status', 'error');
                redirect('profile/change_pass');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', 'The new password cannot be the same as current password');
                    $this->session->set_flashdata('status', 'error');
                    redirect('profile/change_pass');
                } else {
                    $this->MProfile->changePassword($new_password);

                    $this->session->set_flashdata('message', 'Your password has been updated');
                    $this->session->set_flashdata('status', 'success');
                    redirect('profile');
                }
            }
        }
    }
}
