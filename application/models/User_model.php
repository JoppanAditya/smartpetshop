<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    function getUsers()
    {
        $query = "SELECT `user`.*, `user_level`.`level_name` FROM `user` JOIN `user_level` ON `user`.`level_id` = `user_level`.`level_id`";
        return $this->db->query($query)->result_array();
    }

    function getUserById($id)
    {
        $this->db->select('user.*, user_level.level_name');
        $this->db->from('user');
        $this->db->join('user_level', 'user.level_id = user_level.level_id');
        $this->db->where('user.user_id', $id);
        return $this->db->get()->row_array();
    }

    public function addUser($data)
    {
        return $this->db->insert('user', $data);
    }


    public function updateUser($input)
    {
        $user_id = $input['user_id'];
        $fullname = htmlspecialchars($input['fullname']);
        $email = htmlspecialchars($input['email']);
        $password = password_hash($input['password'], PASSWORD_DEFAULT);
        $phone = $input['phone'];
        $level_id = $input['level_id'];
        $is_active = $input['is_active'];

        // Update existing record
        $this->db->set('fullname', $fullname);
        $this->db->set('email', $email);
        $this->db->set('password', $password);
        $this->db->set('phone', $phone);
        $this->db->set('level_id', $level_id);
        $this->db->set('is_active', $is_active);
        $this->db->where('user_id', $user_id);
        return $this->db->update('user');
    }

    function deleteUser($id)
    {
        return $this->db->delete('user', ['user_id' => $id]);
    }

    function getUserLevel()
    {
        return $this->db->get('user_level')->result_array();
    }

    function getLevelById($id)
    {
        return $this->db->get_where('user_level', ['level_id' => $id])->row_array();
    }

    public function saveLevel($data)
    {
        if (isset($data['level_id']) && !empty($data['level_id'])) {
            // Update existing record
            $this->db->where('level_id', $data['level_id']);
            return $this->db->update('user_level', $data);
        } else {
            // Insert new record
            return $this->db->insert('user_level', $data);
        }
    }

    function deleteLevel($id)
    {
        return $this->db->delete('user_level', ['level_id' => $id]);
    }

    public function getTotalCustomers()
    {
        $this->db->from('user');
        $this->db->where('level_id', 3);
        return $this->db->count_all_results();
    }
}
