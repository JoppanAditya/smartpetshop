<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    public function updateProfile($user_id, $updateData)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->update('user', $updateData);
    }


    public function updateImage($data)
    {
        $upload_image = $_FILES['image']['name'];

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
                return false;
            }
        }
        $this->db->where('user_id', $data['user_id']);
        return $this->db->update('user');
    }

    public function changePassword($new_password, $user_id)
    {
        $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $this->db->set('password', $password_hash);
        $this->db->where('user_id', $user_id);
        return $this->db->update('user');
    }

    public function getAdrresses($id)
    {
        $this->db->select('*');
        $this->db->from('address');
        $this->db->where('user_id', $id);
        $this->db->order_by('is_selected', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getAddressById($id)
    {
        $this->db->select('*');
        $this->db->from('address');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function addAddress($data)
    {
        return $this->db->insert('address', $data);
    }

    public function updateAddress($id, $data)
    {
        $this->db->set('user_id', $data['user_id']);
        $this->db->set('name', $data['name']);
        $this->db->set('phone', $data['phone']);
        $this->db->set('label', $data['label']);
        $this->db->set('city', $data['city']);
        $this->db->set('full_address', $data['full_address']);
        $this->db->set('notes', $data['notes']);
        $this->db->where('id', $id);
        return $this->db->update('address');
    }

    public function resetSelected($id)
    {
        $this->db->set('is_selected', 0);
        $this->db->where('user_id', $id);
        $this->db->update('address');
    }

    public function setSelected($id, $user_id)
    {
        $this->db->set('is_selected', 1);
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        return $this->db->update('address');
    }

    public function resetPrimary($id)
    {
        $this->db->set('is_default', 0);
        $this->db->where('user_id', $id);
        $this->db->update('address');
    }

    public function setPrimary($id, $user_id)
    {
        $this->db->set('is_default', 1);
        $this->db->where('id', $id);
        $this->db->where('user_id', $user_id);
        return $this->db->update('address');
    }

    public function deleteAddress($id)
    {
        return $this->db->delete('address', ['id' => $id]);
    }
}
