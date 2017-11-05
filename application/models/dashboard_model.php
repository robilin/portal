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

class Dashboard_Model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;
   
    /***  create view yearly report by start date to end date  ***/
    public function get_all_report_by_date($start_date, $end_date)
    {
        //Revenue
        
        $this->db->select('tbl_mobile_payments.*', false);
        $this->db->select_sum('tbl_mobile_payments.amount', false);
        $this->db->from('tbl_mobile_payments');
        $this->db->where('recdate >=', $start_date);
        $this->db->where('recdate <=', $end_date.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->result();
        
        return $result;
    }
    

public function get_today_payments()
    {
        $today = date("Y-m-d");
        $this->db->select_sum('tbl_mobile_payments.amount', false);
        $this->db->from('tbl_mobile_payments');
        $this->db->where('recdate >=', $today);
        $this->db->where('recdate <=', $today.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    
    public function get_weekly_payments()
    {
        $week_start_date = date('Y-m-d',strtotime("last Saturday"));
        $week_end_date = date('Y-m-d 23:59:59',strtotime("next Saturday"));
        
        $this->db->select_sum('tbl_mobile_payments.amount', false);
        $this->db->from('tbl_mobile_payments');
        $this->db->where('recdate >=', $week_start_date);
        $this->db->where('recdate <=', $week_end_date.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
        
        
    }
    
    public function get_monthly_payments()
    {
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month  = date('Y-m-t');
        $this->db->select_sum('tbl_mobile_payments.amount', false);
        $this->db->from('tbl_mobile_payments');
        $this->db->where('recdate >=', $first_day_this_month);
        $this->db->where('recdate <=', $last_day_this_month.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    
    public function get_yearly_payments()
    {
        $first_day_this_year = date('Y-01-01');
        $last_day_this_year  = date('Y-m-t');
        $this->db->select_sum('tbl_mobile_payments.amount', false);
        $this->db->from('tbl_mobile_payments');
        $this->db->where('recdate >=', $first_day_this_year);
        $this->db->where('recdate <=', $last_day_this_year.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    
    public function get_yearly_payments_by_date($start_date, $end_date)
    {
        $first_day_this_year = date('Y-01-01');
        $last_day_this_year  = date('Y-m-t');
        $this->db->select_sum('tbl_mobile_payments.amount', false);
        $this->db->from('tbl_mobile_payments');
        $this->db->where('timestamp >=', $first_day_this_year);
        $this->db->where('timestamp <=', $last_day_this_year.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

}