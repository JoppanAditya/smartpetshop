<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{

    function updateProfile($data)
    {
        $username = $this->input->post('username');
        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $upload_image = $_FILES['image'];

        if ($upload_image) {
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/profile/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $old_image = $data['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $this->db->set('fullname', $fullname);
        $this->db->set('email', $email);
        $this->db->where('username', $username);
        return $this->db->update('user');
    }

    function changePassword($new_password)
    {
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $this->db->set('password', $password_hash);
        $this->db->where('username', $this->session->userdata('username'));
        return $this->db->update('user');
    }
}
