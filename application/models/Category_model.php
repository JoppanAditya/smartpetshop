<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    function getCategories()
    {
        return $this->db->get('product_category')->result_array();
    }

    function getCategoryById($id)
    {
        return $this->db->get_where('product_category', ['id' => $id])->row_array();
    }

    public function saveCategory($data)
    {
        if (isset($data['id']) && !empty($data['id'])) {
            // Update existing record
            $this->db->where('id', $data['id']);
            return $this->db->update('product_category', $data);
        } else {
            // Insert new record
            return $this->db->insert('product_category', $data);
        }
    }

    function deleteCategory($id)
    {
        return $this->db->delete('product_category', ['id' => $id]);
    }
}
