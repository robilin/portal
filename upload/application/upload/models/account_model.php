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

class Account_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;


    public function get_customer_details($customer_code)
    {
        $where = "customer_code = $customer_code OR phone = $customer_code ";

        $this->db->select('tbl_customer.*', false);
        $this->db->from('tbl_customer');
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_all_order()
    {
        $this->db->select('tbl_invoice.*, tbl_order.*', false);
        $this->db->from('tbl_order');
        $this->db->join('tbl_invoice', 'tbl_invoice.order_id  =  tbl_order.order_id ', 'left');
        $this->db->order_by('tbl_order.order_id', ' DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    public function get_all_invoice()
    {
        $this->db->select('tbl_invoice.*, tbl_order.*', false);
        $this->db->from('tbl_invoice');
        $this->db->join('tbl_order', 'tbl_order.order_id  =  tbl_invoice.order_id ', 'left');
        $this->db->order_by('invoice_id', 'DESC');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
   
    public function get_all_customer_invoice()
    {
        $this->db->select('tbl_customer_invoice_details.*',false);
        $this->db->select_sum('subtotal');
        $this->db->from('tbl_customer_invoice_details');
        $this->db->order_by('customer_invoice_id', 'DESC');
        $this->db->group_by('invoice_no');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
}
