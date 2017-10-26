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
    
    public function get_all_vendors()
    { 
        $this->db->select('tbl_vendor.*', false);
        $this->db->from('tbl_vendor');
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }  
    
      
    public function get_today_payment()
    {
        $today = date("Y-m-d");
        $this->db->select('tbl_mobile_payments.*', false);
        $this->db->select_sum('tbl_mobile_payments.amount', false);
        $this->db->where('recdate >=', $today);
        $this->db->where('recdate <=', $today.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    
  public function get_payment_details_by_id($customer_id=null) 
  {
      
    $this->db->select('tbl_mobile_payments.*', false);
    $this->db->from('tbl_mobile_payments');
    $this->db->where('tbl_meter.customer_id',$customer_id);
    $this->db->join('tbl_meter', 'tbl_meter.meter_number=  tbl_mobile_payments.referenceNo', 'right');
    $query_result = $this->db->get();
    $result = $query_result->result();
    return $result;
  }

}
