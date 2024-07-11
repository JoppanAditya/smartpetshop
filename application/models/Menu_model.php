<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    function getMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    function getMenuById($id)
    {
        return $this->db->get_where('user_menu', ['menu_id' => $id])->row_array();
    }

    function saveMenu($data)
    {
        if (isset($data['menu_id']) && !empty($data['menu_id'])) {
            $this->db->where('menu_id', $data['menu_id']);
            return $this->db->update('user_menu', $data);
        } else {
            return $this->db->insert('user_menu', $data);
        }
    }

    function deleteMenu($id)
    {
        return $this->db->delete('user_menu', ['menu_id' => $id]);
    }

    function getSubmenu()
    {
        $query = "SELECT `user_submenu`.*, `user_menu`.`menu` FROM `user_submenu` JOIN `user_menu` ON `user_submenu`.`menu_id` = `user_menu`.`menu_id`";
        return $this->db->query($query)->result_array();
    }

    function getSubmenuById($id)
    {
        $this->db->select('user_submenu.*, user_menu.menu');
        $this->db->from('user_submenu');
        $this->db->join('user_menu', 'user_submenu.menu_id = user_menu.menu_id');
        $this->db->where('user_submenu.submenu_id', $id);
        return $this->db->get()->row_array();
    }

    public function saveSubmenu($data)
    {
        if (isset($data['submenu_id']) && !empty($data['submenu_id'])) {
            $this->db->where('submenu_id', $data['submenu_id']);
            return $this->db->update('user_submenu', $data);
        } else {
            return $this->db->insert('user_submenu', $data);
        }
    }

    function deleteSubmenu($id)
    {
        return $this->db->delete('user_submenu', ['submenu_id' => $id]);
    }
}
