<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
    function Auth($username, $password)
    {
        $this->db->where("username", $username);
        $this->db->where("password", $password);
        $this->db->where("is_active", 1);
        return $this->db->get("user");
    }

    function check_db($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }

    function insert_user($data)
    {
        return $this->db->insert('user', $data);
    }
}
