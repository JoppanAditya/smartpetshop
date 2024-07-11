<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Settings_model', 'MSettings');
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Setup form validation rules
        $this->form_validation->set_rules('value', $this->input->post('value'), 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/main_header', $data);
            $this->load->view('main/settings/index');
            $this->load->view('templates/main_footer');
        } else {
            $field = $this->input->post('field');
            $value = $this->input->post('value');

            // Prepare data to update
            $updateData = [
                $field => $value,
            ];

            // Update profile data
            $result = $this->MSettings->updateProfile($data['user']['user_id'], $updateData);

            if ($result) {
                $this->session->set_flashdata('message', 'Your profile has been updated');
                $this->session->set_flashdata('status', 'success');
                redirect('settings');
            } else {
                $this->session->set_flashdata('message', 'Failed to update your profile');
                $this->session->set_flashdata('status', 'error');
                redirect('settings');
            }
        }
    }

    function updateImage()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $result = $this->MSettings->updateImage($data['user']);

        if ($result) {
            $this->session->set_flashdata('message', 'Your profile has been updated');
            $this->session->set_flashdata('status', 'success');
        } else {
            $this->session->set_flashdata('message', 'Failed to update your profile');
            $this->session->set_flashdata('status', 'error');
        }
        redirect('settings');
    }

    public function change_pass()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'My Profile';

        $this->form_validation->set_rules('current_password', 'Current password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New password', 'required|trim|min_length[5]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/main_header', $data);
            $this->load->view('main/settings/index');
            $this->load->view('templates/main_footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', 'The current password you entered is incorrect. Please try again');
                $this->session->set_flashdata('status', 'error');
                redirect('settings');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', 'The new password cannot be the same as current password');
                    redirect('settings');
                    $this->session->set_flashdata('status', 'error');
                } else {
                    $this->MSettings->changePassword($new_password, $data['user']['user_id']);

                    $this->session->set_flashdata('message', 'Your password has been updated');
                    $this->session->set_flashdata('status', 'success');
                    redirect('settings');
                }
            }
        }
    }

    public function address()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['address'] = $this->MSettings->getAdrresses($data['user']['user_id']);

        $this->load->view('templates/main_header', $data);
        $this->load->view('main/settings/address');
        $this->load->view('templates/main_footer');
    }

    public function getAddressDetail($id)
    {
        $detail = $this->MSettings->getAddressById($id);

        if ($detail) {
            header('Content-Type: application/json');
            echo json_encode($detail);
        } else {
            echo json_encode(['error' => 'Address not found']);
        }
    }


    public function saveAddress($id = null)
    {
        $data = [
            'user_id' => $this->input->post('user_id'),
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'label' => $this->input->post('label'),
            'city' => $this->input->post('city'),
            'full_address' => $this->input->post('full_address'),
            'notes' => $this->input->post('notes')
        ];

        if ($this->MSettings->getAdrresses($data['user_id'])) {
            $data['is_default'] = 0;
            $data['is_selected'] = 0;
        } else {
            $data['is_default'] = 1;
            $data['is_selected'] = 1;
        }

        $validationErrors = $this->_validateAddress($data);
        if (!empty($validationErrors)) {
            $response = ['error' => true, 'errors' => $validationErrors];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));

            return;
        }

        if ($id == null) {
            $result = $this->MSettings->addAddress($data);
        } else {
            $result = $this->MSettings->updateAddress($id, $data);
        }


        if ($result) {
            $message = $id == null ? 'New address added' : 'Address updated successfully';
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('status', 'success');

            $response = ['success' => true];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $this->session->set_flashdata('message', 'Failed to save address');
            $this->session->set_flashdata('status', 'error');

            $response = ['error' => false];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function updateSelect($id)
    {
        $user_id = $this->input->post('user_id');
        $this->MSettings->resetSelected($user_id);

        $result = $this->MSettings->setSelected($id, $user_id);

        if ($result) {
            $response = ['success' => true];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $response = ['error' => true];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function updatePrimarySelect($id)
    {
        $user_id = $this->input->post('user_id');
        $this->MSettings->resetSelected($user_id);
        $this->MSettings->setSelected($id, $user_id);

        $this->MSettings->resetPrimary($user_id);
        $result = $this->MSettings->setPrimary($id, $user_id);

        if ($result) {
            $response = ['success' => true];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        } else {
            $response = ['error' => true];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
        }
    }

    public function deleteAddress($id)
    {
        $this->MSettings->deleteAddress($id);
        $this->session->set_flashdata('message', 'Address deleted successfully');
        $this->session->set_flashdata('status', 'success');
        redirect('settings/address');
    }

    public function transaction()
    {
        $this->load->model('Trans_model', 'MTrans');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['transactions'] = $this->MTrans->getTransByUser($data['user']['user_id']);

        $this->load->view('templates/main_header', $data);
        $this->load->view('main/settings/transaction');
        $this->load->view('templates/main_footer');
    }

    private function _validateAddress($data)
    {
        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Name is required';
        }
        if (empty($data['phone']) || !is_numeric($data['phone'])) {
            $errors['phone'] = 'Phone number must be a number and required';
        }
        if (empty($data['label'])) {
            $errors['label'] = 'Label is required';
        }
        if (empty($data['city'])) {
            $errors['city'] = 'City is required';
        }
        if (empty($data['full_address'])) {
            $errors['address'] = 'Address is required';
        }
        return $errors;
    }
}
