<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

date_default_timezone_set('Africa/Dar_es_Salaam');

/*
 *	@author : Venance Edson
 *  @support: support@xchangewallet.com
 *	date	: dec, 2016
 *	TemboPos
 *	http://www.xchangewallet.com
 *  version: 1.0
 */

class Dashboard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->load->model('global_model');


    }

    /*** Dashboard ***/

    public function index()
    {
        $data['year'] = date('Y');
        $user_type = $this->session->userdata('user_type');
        $account_type= $this->session->userdata('account_type');
        
        //total customer
        $data['total_customer'] = count( $this->db->get('tbl_customer')->result());
           //get total expenses
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month  = date('Y-m-t');
    
        $data['today_payment'] = $this->dashboard_model->get_today_payments();
         
         //weekly  Report
        $data['weekly_payments'] = $this->dashboard_model->get_weekly_payments();
         
         //Monthly Report
        $data['mothly_payments'] = $this->dashboard_model->get_monthly_payments();
         
         //Yearly Report
        $data['yearly_payments'] = $this->dashboard_model->get_yearly_payments();
                 
        $data['yearly_sales_report'] = $this->get_yearly_sales_report($data['year']);
        
        if($user_type==1){ //load admin dash
        $data['title'] = 'Admin-Dashboard'; // title
        $data['subview'] = $this->load->view('admin/dashboard', $data, true); // sub view
        }elseif($account_type==1){ //load tenant dash
             $data['title'] = 'Tenant Dashboard'; // title
             $data['subview'] = $this->load->view('admin/tenant_dashboard', $data, true); // sub view
        }elseif($account_type==2){ //load landlord dash
            $data['title'] = 'Landlord Dashboard'; // title
            $data['subview'] = $this->load->view('admin/landlord_dashboard', $data, true); // sub view
        }elseif($account_type==3){ //load partners dash
            $data['title'] = 'Landlord Dashboard'; // title
            $data['subview'] = $this->load->view('admin/partner_dashboard', $data, true); // sub view
        }else{ //load default dash..admin dash, may be changed in future to any other dash
            $data['title'] = 'User-Dashboard'; // title
            $data['subview'] = $this->load->view('admin/dashboard', $data, true);
        }
        
        $this->load->view('admin/_layout_main', $data); // main page
    }
    
      /*** Get Yearly Report ***/
    public function get_yearly_sales_report($year)
    {

        for ($i = 1; $i <= 12; $i++) {
            if ($i >= 1 && $i <= 9) {
                $start_date = $year.'-'.'0'.$i.'-'.'01';
                $end_date = $year.'-'.'0'.$i.'/'.'31';
            } else {
                $start_date = $year.'-'.$i.'-'.'01';
                $end_date = $year.'-'.$i.'-'.'31';
            }
            $get_all_report[$i] = $this->dashboard_model->get_all_report_by_date($start_date, $end_date);

        }

        return $get_all_report;
    }


    /*** Login ***/
    public function login()
    {
        $data['title'] = 'Login';
        $this->load->view('admin/login');
    }


}
