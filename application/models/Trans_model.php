<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Trans_model extends CI_Model
{
    function getTransactions()
    {
        $this->db->select('transactions.*, user.fullname, address.name, address.phone, address.city, address.full_address, address.notes');
        $this->db->from('transactions');
        $this->db->join('user', 'transactions.user_id = user.user_id');
        $this->db->join('address', 'transactions.address_id = address.id');
        $this->db->order_by('date_created', 'desc');
        return $this->db->get()->result_array();
    }

    function getTransactionDetails($id)
    {
        return $this->db->get_where('transaction_details', ['transaction_id' => $id])->result_array();
    }

    function getTransById($id)
    {
        return $this->db->get_where('transactions', ['id' => $id])->row_array();
    }

    function getTransByUser($id)
    {
        $this->db->select('transactions.*, transaction_details.*, products.image, address.name, address.phone, address.city, address.full_address, address.notes');
        $this->db->from('transactions');
        $this->db->join('address', 'transactions.address_id = address.id');
        $this->db->join('transaction_details', 'transactions.id = transaction_details.transaction_id');
        $this->db->join('products', 'transaction_details.product_id = products.id');
        $this->db->where('transactions.user_id', $id);
        $this->db->order_by('transactions.date_created', 'desc');
        $this->db->group_by('transactions.id');
        return $this->db->get()->result_array();
    }

    function getTransByInvoice($invoice)
    {
        $trans = $this->db->get_where('transactions', ['invoice' => $invoice])->row_array();
        $trans_id = $trans['id'];

        $this->db->select('transactions.*, user.fullname, address.name, address.phone, address.city, address.full_address, address.notes');
        $this->db->from('transactions');
        $this->db->join('user', 'transactions.user_id = user.user_id');
        $this->db->join('address', 'transactions.address_id = address.id');
        $this->db->where('transactions.id', $trans_id);
        return $this->db->get()->row_array();
    }

    function updateStatus($id, $status)
    {
        $this->db->set('status', $status);
        $this->db->where('id', $id);
        return $this->db->update('transactions');
    }

    public function getTotalSales()
    {
        $this->db->select_sum('shopping_total');
        $query = $this->db->get('transactions');
        return $query->row()->shopping_total;
    }

    public function getTotalTransactions()
    {
        $this->db->from('transactions');
        return $this->db->count_all_results();
    }

    public function getMonthlySales($year)
    {
        $this->db->select('MONTH(FROM_UNIXTIME(date_created)) as month, SUM(shopping_total) as total_sales');
        $this->db->from('transactions');
        $this->db->where('YEAR(FROM_UNIXTIME(date_created))', $year);
        $this->db->group_by('MONTH(FROM_UNIXTIME(date_created))');
        $query = $this->db->get();

        $monthly_sales = array_fill(0, 12, 0); // Initialize array with 12 months
        foreach ($query->result() as $row) {
            $monthly_sales[$row->month - 1] = $row->total_sales;
        }
        return $monthly_sales;
    }

    public function getTransactionsByPeriod($period)
    {
        $this->db->select('t.*, u.fullname');
        $this->db->from('transactions t');
        $this->db->join('user u', 't.user_id = u.user_id');

        switch ($period) {
            case 'daily':
                $start_time = strtotime("today midnight");
                $end_time = strtotime("tomorrow midnight") - 1;
                break;
            case 'weekly':
                $start_time = strtotime("monday this week");
                $end_time = strtotime("sunday this week 23:59:59");
                break;
            case 'monthly':
                $start_time = strtotime("first day of this month midnight");
                $end_time = strtotime("last day of this month 23:59:59");
                break;
            case 'yearly':
                $start_time = strtotime("first day of January this year midnight");
                $end_time = strtotime("last day of December this year 23:59:59");
                break;
            default:
                // If no period or 'all-time' is selected, no need to filter by date
                $start_time = null;
                $end_time = null;
                break;
        }

        if ($start_time !== null && $end_time !== null) {
            $this->db->where('t.date_created >=', $start_time);
            $this->db->where('t.date_created <=', $end_time);
        }

        $this->db->order_by('date_created', 'desc');
        return $this->db->get()->result_array();
    }
}
