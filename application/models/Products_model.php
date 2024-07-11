<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products_model extends CI_Model
{
    function getProducts()
    {
        $this->db->select('products.*, product_category.name AS category_name');
        $this->db->from('products');
        $this->db->join('product_category', 'products.category_id = product_category.id');

        $result = $this->db->get()->result_array();
        return $result;
    }

    function getProductById($id)
    {
        $this->db->select('products.*, product_category.name AS category_name');
        $this->db->from('products');
        $this->db->join('product_category', 'products.category_id = product_category.id');
        $this->db->where('products.id', $id);

        $result = $this->db->get()->row_array();
        return $result;
    }

    public function saveProduct($data)
    {
        $check = $this->db->get_where('products', ['id' => $data['id']])->row_array();

        if (isset($data['product_id']) || !empty($data['product_id'])) {
            $this->db->set('id', $data['id']);
            $this->db->set('name', $data['name']);
            $this->db->set('tag', $data['tag']);
            $this->db->set('category_id', $data['category_id']);
            $this->db->set('description', $data['description']);
            $this->db->set('stock', $data['stock']);
            $this->db->set('buy_price', $data['buy_price']);
            $this->db->set('sell_price', $data['sell_price']);
            $this->db->set('image', $data['image']);
            $this->db->where('id', $data['product_id']);
            return $this->db->update('products');
        } else {
            if ($check) {
                return false;
            } else {
                return $this->db->insert('products', $data);
            }
        }
    }

    public function updateProductStock($productId, $newStock)
    {
        $this->db->set('stock', $newStock);
        $this->db->where('id', $productId);
        $this->db->update('products');
    }

    function deleteProduct($id)
    {
        return $this->db->delete('products', ['id' => $id]);
    }

    public function getTotalProducts()
    {
        $this->db->from('products');
        return $this->db->count_all_results();
    }
}
