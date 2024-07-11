<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Shop_model extends CI_Model
{
    function getProducts($limit, $start, $keyword = '', $category = '', $min_price = '', $max_price = '', $rating = '', $sort_by = '')
    {
        $this->db->select('p.*, c.name as cName');
        $this->db->from('products p');
        $this->db->join('product_category c', 'p.category_id = c.id');

        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('p.name', $keyword);
            $this->db->or_like('p.tag', $keyword);
            $this->db->or_like('p.description', $keyword);
            $this->db->or_like('c.name', $keyword);
            $this->db->group_end();
        }

        if (!empty($category)) {
            $this->db->where('category_id', $category);
        }

        if (!empty($min_price)) {
            $this->db->where('sell_price >=', $min_price);
        }

        if (!empty($max_price)) {
            $this->db->where('sell_price <=', $max_price);
        }

        if (!empty($rating)) {
            $this->db->where('rating >=', $rating);
        }

        switch ($sort_by) {
            case 'rating':
                $this->db->order_by('rating', 'DESC');
                break;
            case 'highest_price':
                $this->db->order_by('sell_price', 'DESC');
                break;
            case 'lowest_price':
                $this->db->order_by('sell_price', 'ASC');
                break;
            default:
                $this->db->order_by('p.id', 'ASC');
                break;
        }

        $this->db->limit($limit, $start);

        return $this->db->get()->result_array();
    }

    // Model MShop
    public function countFilteredProducts($keyword = '', $category = '', $min_price = '', $max_price = '', $rating = '')
    {
        if (!empty($keyword)) {
            $this->db->like('name', $keyword);
            $this->db->or_like('tag', $keyword);
            $this->db->or_like('description', $keyword);
        }

        if (!empty($category)) {
            $this->db->where('category_id', $category);
        }

        if (!empty($min_price)) {
            $this->db->where('sell_price >=', $min_price);
        }

        if (!empty($max_price)) {
            $this->db->where('sell_price <=', $max_price);
        }

        if (!empty($rating)) {
            $this->db->where('rating >=', $rating);
        }

        return $this->db->count_all_results('products');
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

    function getCategories()
    {
        return $this->db->get('product_category')->result_array();
    }

    function countProducts()
    {
        return $this->db->get('products')->num_rows();
    }
}
