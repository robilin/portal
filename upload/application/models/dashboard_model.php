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


    public function recently_added_product($store_id=null)
    {
        $this->db->select('tbl_product.*', false);
        $this->db->select('tbl_product_price.selling_price, tbl_product_image.filename', false);
        $this->db->from('tbl_product');
        if(!empty($store_id)) {
            $this->db->where('tbl_product.store_id',$store_id );
        }
        $this->db->join('tbl_product_price', 'tbl_product_price.product_id  =  tbl_product.product_id ', 'left');
        $this->db->join('tbl_product_image', 'tbl_product_image.product_id  =  tbl_product.product_id ', 'left');
        $this->db->order_by('product_id', 'DESC');
        $this->db->limit(4);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function recently_added_order($store_id=null)
    {
        $this->db->select('tbl_order.*', false);
        $this->db->from('tbl_order');
        if(!empty($store_id)) {
            $this->db->where('tbl_order.store_id',$store_id );
        }
        $this->db->order_by('order_id', 'DESC');
        $this->db->limit(6);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    /***  create view total revenue,cost,tax from tbl_order_details  ***/


    public function get_discount($store_id =null){
        $this->db->select_sum('discount_amount');
        if(!empty($store_id)) {
            $this->db->where('tbl_order.store_id',$store_id );
        }
        $this->db->where('tbl_order.order_status', 2);
        $query_result = $this->db->get('tbl_order');
        $result = $query_result->row();
        return $result;
    }
    public function get_sales_total($store_id = null){
        $this->db->select_sum('grand_total');
        if(!empty($store_id)) {
            $this->db->where('tbl_order.store_id',$store_id );
        }
        $this->db->where('tbl_order.order_status', 2);
        $query_result = $this->db->get('tbl_order');
        $result = $query_result->row();
        return $result;
    }
    /***  create view yearly report by start date to end date  ***/
    public function get_all_report_by_date($start_date, $end_date)
    {
        //Total loans disbused
        $this->db->select('tbl_loan.*', false);
        $this->db->select_sum('tbl_loan.principal_amount', false);
        $this->db->from('tbl_loan');
        $this->db->where('loan_release_date >=', $start_date);
        $this->db->where('loan_release_date <=', $end_date.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->result();


        //Total Repayments
        $this->db->select('tbl_loan_repayment.*', false);
        $this->db->select_sum('repayment_amount', false);
        $this->db->from('tbl_loan_repayment');
        $this->db->where('collection_date >=', $start_date);
        $this->db->where('collection_date <=', $end_date.' '.'23:59:59');
        $query_result = $this->db->get();
        
        $result[0]->repayments= $query_result->result();

        return $result;
    }

    public function get_today_loans()
    {
        $today = date("Y-m-d");
        $this->db->select('tbl_loans].*', false);
        $this->db->select_sum('tbl_order.grand_total', false);
        $this->db->from('tbl_loan');
        $this->db->where('loan_release_date >=', $today);
        $this->db->where('loan_release_date <=', $today.' '.'23:59:59');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_yearly_loans()
    {
        $year = date("Y");
        $this->db->select('tbl_loan.*', false);
        $this->db->select_sum('tbl_loan.principal_amount', false);
        $this->db->from('tbl_loan');
        $this->db->like('tbl_loan', $year);
        $query_result = $this->db->get();
        $result = $query_result->row();

        return $result;
    }

    public function get_weekly_sales()
    {
        $week_start_date = date('Y-m-d',strtotime("last Saturday"));
        $week_end_date = date('Y-m-d 23:59:59',strtotime("next Saturday"));

        $this->db->select('tbl_invoice.*', false);
        $this->db->select_sum('tbl_order.grand_total', false);
        $this->db->from('tbl_invoice');
        $this->db->where('invoice_date >=', $week_start_date);
        $this->db->where('invoice_date <=', $week_end_date);
        $this->db->join('tbl_order', 'tbl_order.order_id  =  tbl_invoice.order_id ', 'left');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;


    }

    public function get_invoiceOrder_by_date($start_date, $end_date)
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

    public function get_invoice_by_date($first_day_this_month, $last_day_this_month){
        $this->db->select('tbl_invoice.*', false);
        $this->db->from('tbl_invoice');
        $this->db->where('invoice_date >=', $first_day_this_month);
        $this->db->where('invoice_date <=', $last_day_this_month);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }

    public function get_revenue($order_id){
        $this->db->select('SUM(discount_amount) AS discount_amount, SUM(total_tax) AS total_tax , SUM(grand_total) AS grand_total ', false);
        $this->db->from('tbl_order');
        $this->db->where_in('order_id', $order_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }
    

    public function get_total_stock_value_after_sell(){
        $this->db->select('SUM(buying_price) AS stock_sales_value', false);
        $this->db->from('tbl_product_price');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_profit($order_id){
        $this->db->select('SUM(buying_price * product_quantity) AS buying_price', false);
        $this->db->from('tbl_order_details');
        $this->db->where_in('order_id', $order_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_all_stock(){
        $this->db->select('tbl_product.*', false);
        $this->db->select('tbl_product_price.*', false);
        $this->db->from('tbl_product');
        $this->db->join('tbl_product_price', 'tbl_product_price.product_id  =  tbl_product.product_id', 'left');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }
    
    

    public function get_product_inventory($product_id){
        $this->db->select('product_id, SUM(product_quantity) AS quantity', false);
        $this->db->from('tbl_inventory');
        $this->db->where('product_id', $product_id);
        $this->db->group_by(array("product_id"));
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function get_top_selling_product($order_id){
        $this->db->select('product_code, product_name, SUM(product_quantity) AS quantity, SUM(buying_price) AS buying_price,
                           SUM(selling_price) AS selling_price, SUM(product_tax) AS product_tax, SUM(sub_total) AS sub_total ', false);
        $this->db->from('tbl_order_details');
        $this->db->where_in('order_id', $order_id);
        $this->db->group_by(array("product_code"));
        $this->db->order_by("quantity", "desc");
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;


    }
    
    public function get_top_buying_customers(){
        $this->db->select('customer_id,customer_name,customer_phone,customer_email,count(order_id) AS purchases,sum(grand_total) AS value ', false);
        $this->db->from('tbl_order');
        $this->db->where('customer_id !=', 0);
        $this->db->where('order_status =', 2);
        $this->db->group_by(array("customer_id"));
        $this->db->order_by("purchases", "desc");
        $this->db->limit(5);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    
public function get_total_expenses($first_day_this_month,$last_day_this_month){
        $this->db->select('sum(amount) AS expenses', false);
        $this->db->from('tbl_expense');
        $this->db->where('date_time_created >=', $first_day_this_month);
        $this->db->where('date_time_created <=', $last_day_this_month);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
        
    }

public function get_total_loans_released(){
        $this->db->select('sum(principal_amount) AS total_loans ', false);
        $this->db->from('tbl_loan');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
        
    }

public function get_total_loans_collection(){
        $this->db->select('sum(repayment_amount) AS total_collection ', false);
        $this->db->from('tbl_loan_repayment');
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
        
    }
    
public function get_total_loans_open($status){
        $this->db->select('sum(principal_amount) AS total_loans', false);
        $this->db->from('tbl_loan');
        $this->db->where('loan_status',$status);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
        
    }
    
public function get_today_payments()
    {
        $today = date("Y-m-d");
        $this->db->select_sum('tbl_mobile_payments.amount', false);
        $this->db->from('tbl_mobile_payments');
        $this->db->where('timestamp >=', $today);
        $this->db->where('timestamp <=', $today.' '.'23:59:59');
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
        $this->db->where('timestamp >=', $week_start_date);
        $this->db->where('timestamp <=', $week_end_date.' '.'23:59:59');
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
        $this->db->where('timestamp >=', $first_day_this_month);
        $this->db->where('timestamp <=', $last_day_this_month.' '.'23:59:59');
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
        $this->db->where('timestamp >=', $first_day_this_year);
        $this->db->where('timestamp <=', $last_day_this_year.' '.'23:59:59');
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