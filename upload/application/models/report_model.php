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

class Report_Model extends MY_Model
{
    //put your code here
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function get_invoice_by_date($start_date, $end_date)
    {
        $this->db->select('tbl_invoice.*', false);
        $this->db->select('tbl_order.*', false);
        $this->db->from('tbl_invoice');
        $this->db->join('tbl_order', 'tbl_order.order_id  =  tbl_invoice.order_id', 'left');
        if ($start_date == $end_date) {
            $this->db->like('tbl_invoice.invoice_date', $start_date);
        } else {
            $this->db->where('tbl_invoice.invoice_date >=', $start_date);
            $this->db->where('tbl_invoice.invoice_date <=', $end_date.' '.'23:59:59');
        }
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }

    public function get_monthly_late_loan($days_late)
    {
    	//convert days to second days*24hrs*60mins*60secs
    	$seconds=$days_late*24*60*60;
    	
    	$loan_info= $this->db->get('tbl_loan')->result();
    	
    	$counter =1;
    	
    	if (!empty($loan_info)): foreach ($loan_info as $v_loan) :
    	
        $loan_details = $this->db->get_where('tbl_loan_details',array('loan_id'=>$v_loan->loan_id))->result();
                     foreach ($loan_details as $v_details) {
                              $repayments=$v_details->loan_num_of_repayments;
                         }
                                    
                        $release_date=date_create($v_loan->loan_release_date);
						$maturity_date=date_create($v_loan->maturity_date);
						$diff=date_diff($release_date,$maturity_date);
                        $loan_total_days=$diff->format("%a");
                        $date_interval=round(($loan_total_days)/$repayments);
                                  	
                        $loan_next_date=date_add($release_date, date_interval_create_from_date_string("{$date_interval} days"));
    								//next repayment date
        				$next_maturity_date = date_format($loan_next_date, "Y-m-d");
    	
    	  $counter++;
         endforeach;
    	endif; 
    	
        $this->db->select('tbl_loan.*', false);
        $this->db->from('tbl_loan');
        if ($start_date == $end_date) {
            $this->db->like('datetime', $start_date);
        } else {
            $this->db->where('datetime >=', $start_date);
            $this->db->where('datetime <=', $end_date.' '.'23:59:59');
        }
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    
 public function get_due_loans_by_date($start_date, $end_date)
    {
        $this->db->select('tbl_loan_repayment.*', false);
        $this->db->from('tbl_loan_repayment');
        if ($start_date == $end_date) {
            $this->db->like('collection_date', $start_date);
        } else {
            $this->db->where('collection_date >=', $start_date);
            $this->db->where('collection_date <=', $end_date.' '.'23:59:59');
        }
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }


}
