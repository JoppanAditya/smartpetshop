<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    function getCarts($id)
    {
        $this->db->select('cart.*, products.id AS product_id, products.name AS product_name, products.sell_price AS product_price, products.image AS product_image');
        $this->db->from('cart');
        $this->db->where('user_id', $id);
        $this->db->join('products', 'cart.product_id = products.id');
        return $this->db->get()->result_array();
    }

    public function getTotalCart($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->from('cart');
        return $this->db->count_all_results();
    }

    function getProducts()
    {
        return $this->db->get('products', 12)->result_array();
    }

    public function addCart($data)
    {
        $this->db->where('product_id', $data['product_id']);
        $this->db->where('user_id', $data['user_id']);
        $query = $this->db->get('cart');

        if ($query->num_rows() > 0) {
            $existing_cart = $query->row();
            $new_quantity = $existing_cart->quantity + $data['quantity'];
            $this->db->where('id', $existing_cart->id);
            return $this->db->update('cart', ['quantity' => $new_quantity, 'notes' => $data['notes']]);
        } else {
            return $this->db->insert('cart', $data);
        }
    }

    public function updateCart($product_id, $user_id, $quantity, $notes = null)
    {
        $this->db->set('quantity', $quantity);
        if ($notes !== null) {
            $this->db->set('notes', $notes);
        }
        $this->db->where('product_id', $product_id);
        $this->db->where('user_id', $user_id);
        $this->db->update('cart');
    }

    public function deleteCart($user_id, $product_id = null)
    {
        if ($product_id !== null) {
            $this->db->where('product_id', $product_id);
        }
        $this->db->where('user_id', $user_id);
        $this->db->delete('cart');
    }

    public function addTransaction($data)
    {
        return $this->db->insert('transactions', $data);
    }

    public function addTransactionDetail($items, $transactionId)
    {
        foreach ($items as $item) {
            $data = array(
                'transaction_id' => $transactionId,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity']
            );
            $this->db->insert('transaction_details', $data);
        }
    }
}
