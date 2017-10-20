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
       //retrieve user type
        $user_type = $this->session->userdata('user_type');

        //total customer
        $data['total_customer'] = count( $this->db->get('tbl_customer')->result());
           //get total expenses
         $first_day_this_month = date('Y-m-01');
         $last_day_this_month  = date('Y-m-t');
         $total_expenses=$this->dashboard_model->get_total_expenses($first_day_this_month,$last_day_this_month);
        
         $data['total_expense']=$total_expenses->expenses;
         
         $data['total_loans'] = $this->dashboard_model->get_total_loans_released();
         
         $data['total_collection'] = $this->dashboard_model->get_total_loans_collection();
         
         $data['total_loans_open'] = $this->dashboard_model->get_total_loans_open('Open');
          
         $data['total_loans_full'] = $this->dashboard_model->get_total_loans_open('fully_paid');
      
		$data['total_loans_default'] = $this->dashboard_model->get_total_loans_open('default');
		
		$data['total_loans_default'] = $this->dashboard_model->get_total_loans_open('restructured');
        //total revenue
        $first_day_this_month = date('Y-m-01');
        $last_day_this_month  = date('Y-m-t');


    

        $first_day_this_year = date('Y-01-01');
        $last_day_this_year  = date('Y-12-31');

    


        $data['title'] = 'LMS- Dashboard'; // title
        $data['subview'] = $this->load->view('admin/dashboard', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }


    /*** Login ***/
    public function login()
    {
        $data['title'] = 'Login';
        $this->load->view('admin/login');
    }


}
