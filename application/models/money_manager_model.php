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

class Money_manager_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;


    public function get_all_category()
    { 
        $this->db->select('tbl_money_manager_category.*', false);
        $this->db->from('tbl_money_manager_category');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

    public function get_all_category_by_id($money_manager_category_id)
    {
 
        $this->db->select('tbl_money_manager_category.category_name', false);
        $this->db->from('tbl_money_manager_category');
        $this->db->where('tbl_money_manager_category.money_manager_category_id', $money_manager_category_id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
	public function get_all_category_by_type($where)
    {
        
        $this->db->select('tbl_money_manager_category.*', false);
        $this->db->from('tbl_money_manager_category');
        $this->db->where('tbl_money_manager_category.category_type', $where);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    public function get_all_accounts(){
    
        $this->db->select('tbl_money_manager_account.*', false);
        $this->db->from('tbl_money_manager_account');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}