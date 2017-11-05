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

class Meter_Model extends MY_Model
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
    
 public function get_all_meter_info()
    {
        $this->db->select('tbl_meter.*', false);
        $this->db->from('tbl_meter');
        $this->db->order_by('tbl_meter.meter_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
 public function get_meter_information_by_id($id)
    {
        $this->db->select('tbl_meter.*', false);
        $this->db->from('tbl_meter');
        $this->db->order_by('tbl_meter.meter_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }


}
