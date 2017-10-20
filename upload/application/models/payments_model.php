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

class Payments_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    
    
    
 public function get_all_category()
    { 
        $this->db->select('tbl_loan_category.*', false);
        $this->db->from('tbl_loan_category');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    
 public function get_all_brands()
    { 
        $this->db->select('tbl_loan_brand.*', false);
        $this->db->from('tbl_loan_brand');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }  
    
    public function get_all_vendors()
    { 
        $this->db->select('tbl_vendor.*', false);
        $this->db->from('tbl_vendor');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }  
    
    
    public function get_all_category_by_id($category_id)
    {
        $this->db->select('tbl_loan_category.*', false);
        $this->db->from('tbl_loan_category');
        $this->db->where('tbl_loan_category.category_id', $category_id);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    

    // * me
    public function get_all_loan_info()
    {
        $this->db->select('tbl_loan.*', false);
        $this->db->from('tbl_loan');
        $this->db->order_by('tbl_loan.loan_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    public function get_loan_information_by_id($id)
    {
        $this->db->select('tbl_loan.*', false);
        $this->db->from('tbl_loan');
        $this->db->order_by('tbl_loan.loan_id', ' DESC');
        
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    
  public function get_loan_schedule_information_by_id($id)
    {
        $this->db->select('tbl_loan_schedule.*', false);
        $this->db->from('tbl_loan_schedule');
        $this->db->order_by('tbl_loan_schedule.loan_id', ' DESC');
        $this->db->where('tbl_loan_schedule.loan_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_damage_loan($id)
    {
        $this->db->select('tbl_loan.*', false);
        $this->db->from('tbl_loan');
        $this->db->where('tbl_loan.loan_id', $id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }


    public function check_loan_code($loan_number, $loan_id)
    {
        $this->db->select('tbl_loan.*', false);
        $this->db->from('tbl_loan');
        if ($loan_id) {
            $this->db->where('loan_id !=', $loan_id);
        }
        $this->db->where('loan_number', $loan_number);
        $query_result = $this->db->get();
        $result = $query_result->row();

        return $result;
    }
    
 public function get_all_collateral_info()
    {
        $this->db->select('tbl_collateral.*', false);
        $this->db->from('tbl_collateral');
        $this->db->order_by('tbl_collateral.collateral_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    public function get_today_payment()
    {
        $today = date("Y-m-d");
        $this->db->select('tbl_mobile_payments.*', false);
        $this->db->select_sum('tbl_mobile_payments.amount', false);
        $this->db->where('timestamp >=', $today);
        $this->db->where('timestamp <=', $today.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    

    
 public function get_customer_mobile_by_loan_id($loan_id)
    {
        $this->db->select('tbl_loan.*', false);
        $this->db->from('tbl_loan');
    	$this->db->where('loan_id', $loan_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
           
        $customer_id=$result->customer_id;
        
        if($customer_id){
         $this->db->select('tbl_customer.*', false);
         $this->db->from('tbl_customer');
         $this->db->where('customer_id', $customer_id);
         $query_result = $this->db->get();
         $result = $query_result->row();
        }
         
        return $result->phone;
        

    }

}
