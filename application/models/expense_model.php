

<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 *	@author : Venance Edson
 *  @support: support@xchangewallet.com
 *	date	: dec, 2016
 *	TemboPos
 *	http://www.xchangewallet.com
 *  version: 1.0
 */

class Expense_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;


    public function get_all_category()
    { 
        $this->db->select('tbl_expense_category.*', false);
        $this->db->from('tbl_expense_category');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

    public function get_all_category_by_id($expense_category_id)
    {
 
        $this->db->select('tbl_category.category_name', false);
        $this->db->from('tbl_expense_category');
        $this->db->where('tbl_expense_category.expense_category_id', $expense_category_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}