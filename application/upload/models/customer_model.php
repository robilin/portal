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

class Customer_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_customer_info($id = null) // this function is to get all customer info from tbl customer and tbl_customer_group
    {
        $this->db->select('tbl_customer.*', false);
        $this->db->select('tbl_customer_group.*', false);
        $this->db->from('tbl_customer');
        $this->db->join('tbl_customer_group', 'tbl_customer_group.customer_group_id  =  tbl_customer.customer_group_id ', 'left');
        if (!empty($id)) {
            //specific customer information needed
            $this->db->where('tbl_customer.customer_id', $id);
            $this->db->order_by('tbl_customer.customer_id', ' DESC');
            $query_result = $this->db->get();
            $result = $query_result->row();
        } else {
            //all customer information needed
            $this->db->order_by('tbl_customer.customer_id', ' DESC');
            $query_result = $this->db->get();
            $result = $query_result->result();
        }

        return $result;
    }
    
    
    public function get_admitted_customers($status)
    {
        $this->db->select('tbl_customer.*', false);
        $this->db->from('tbl_customer');
        $this->db->where('visit_status', $status);
 		$query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
 public function get_visited_customers($customer_id)
    {
        $this->db->select('tbl_customer_visit.*', false);
        $this->db->from('tbl_customer_visit');
        $this->db->where('customer_id', $customer_id);
 		$query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
 public function get_visited_customers_history($id)
    {
 
        

    }
    
 public function get_visited_customers_by_visit_id($visit_id)
    {
        $this->db->select('tbl_customer_visit.*', false);
        $this->db->from('tbl_customer_visit');
        $this->db->where('customer_visit_id', $visit_id);
 		$query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    

//    public function check_customer_phone($phone, $customer_id)
//    {
//        $this->db->select('tbl_customer.*', false);
//        $this->db->from('tbl_customer');
//        $this->db->where('customer_id !=', $customer_id);
//        $this->db->where('phone', $phone);
//        $query_result = $this->db->get();
//        $result = $query_result->row();
//        return $result;
//    }

    public function get_new_customer_detail()
    {
        // this function is to get all customer info blank
        $post = new stdClass();
        $post->customer_group_id = '';
        $post->customer_id = '';
        $post->customer_first_name = '';
        $post->customer_last_name = '';
        $post->company_name = '';
        $post->tax_vat_number = '';
        $post->customer_group_name = '';
        $post->address = '';
        $post->postcode = '';
        $post->city = '';
        $post->country = '';
        $post->phone = '';
        $post->mobile = '';
        $post->fax = '';
        $post->email = '';

        return $post;
    }
}
