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

class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');

        $this->global_model->_table_name = 'tbl_menu'; //table name
            $this->global_model->_order_by = 'menu_id';
            //get all navigation data
            $all_menu = $this->global_model->get();
        $_SESSION['user_roll'] = $all_menu;

            //get employee id from session
            $user_id = $this->session->userdata('employee_id');

        $this->global_model->_table_name = 'tbl_user_role'; //table name
            $this->global_model->_order_by = 'user_role_id';
            // get employee navigation by employee id
            $user_menu = $this->global_model->get_by(array('employee_login_id' => $user_id), false);

        $user_type = $this->session->userdata('user_type');

        if ($user_type != 1) {
            $restricted_link = array();
            foreach ($all_menu as $data1) {
                $duplicate = false;
                foreach ($user_menu as $data2) {
                    if ($data1->menu_id === $data2->menu_id) {
                        $duplicate = true;
                    }
                }

                if ($duplicate === false) {
                    $restricted_link[] = $data1->link;
                }
            }
            $exception_uris = $restricted_link;
        } else {
            $exception_uris = array();
        }

        //localization
        $this->global_model->_table_name = 'tbl_localization'; //table name
        $this->global_model->_order_by = 'localization_id';
        //get all navigation data
        $localization = $this->global_model->get_by(array('localization_id' => 1), true);
        $_SESSION['localization'] = $localization;

        // Login check

        if (in_array(uri_string(), $exception_uris) == true) {
            redirect('admin/dashboard');
        }


        //echo $uriSegment = $this->uri->uri_string();
        $uri1 = $this->uri->segment(1);
        $uri2 = $this->uri->segment(2);
        $uri3 = $this->uri->segment(3);
        if ($uri3) {
            $uri3 = '/'.$uri3;
        }
		
        $uriSegment = $uri1.'/'.$uri2.$uri3;
        $menu_uri['menu_active_id'] = $this->login_model->select_menu_by_uri($uriSegment);
        $menu_uri['menu_active_id'] == false || $this->session->set_userdata($menu_uri);


        $this->global_model->_table_name = 'tbl_business_profile';
        $this->global_model->_order_by = 'business_profile_id';

        $info['business_info'] = $this->global_model->get_by(array("business_profile_id"=> 1), true);
        $this->session->set_userdata($info);
        

        
        $this->global_model->_table_name = 'tbl_alerts_config';
        $this->global_model->_order_by = 'alert_id';
        $alert_config = $this->global_model->get_by(array("alert_type"=> 1), false);
                
    }  
         
        

    //======================================================================
    // ALL TABLE DECLARATION
    //======================================================================

    /* product category and sub table start */


    public function tbl_asset_brand($order_by){
        $this->global_model->_table_name = 'tbl_asset_brand';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'asset_brand_id';
    }
    
   public function tbl_loan_comments($order_by){
        $this->global_model->_table_name = 'tbl_loan_comments';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'comment_id';
    }
    
 public function tbl_asset_modal($order_by){
        $this->global_model->_table_name = 'tbl_asset_modal';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'asset_modal_id';
    }
    
    
 public function tbl_customer_invoice_details($order_by){
        $this->global_model->_table_name = 'tbl_customer_invoice_details';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'customer_invoice_id';
    }
    
 public function tbl_invoice_set($order_by){
        $this->global_model->_table_name = 'tbl_invoice_set';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'invoice_set_id';
    }
    
 public function tbl_subcategory($order_by){
        $this->global_model->_table_name = 'tbl_subcategory';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'subcategory_id';
    }

 public function tbl_loan_details($order_by){
        $this->global_model->_table_name = 'tbl_loan_details';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'loan_details_id';
    }
    /* product tax table */



    public function  tbl_alerts_config($order_by){
        $this->global_model->_table_name = 'tbl_alerts_config';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'alert_id';
    }
    

    public function  tbl_loan($order_by){
        $this->global_model->_table_name = 'tbl_loan';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'loan_id';
    }
    

    
  public function tbl_loan_repayment($order_by){
        $this->global_model->_table_name = 'tbl_loan_repayment';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'repayment_id';
    }
    


    public function tbl_vendor($order_by, $order=null){
        $this->global_model->_table_name = 'tbl_vendor';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'vendor_id';
    }
    
 
 	public function tbl_collateral($order_by){
        $this->global_model->_table_name = 'tbl_collateral';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'collateral_id';
    }
    
    public function tbl_asset($order_by){
        $this->global_model->_table_name = 'tbl_asset';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'asset_id';
    }


    /* customer table */

    public function tbl_customer($order_by){
        $this->global_model->_table_name = 'tbl_customer';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'customer_id';
    }
    
   public function tbl_loan_groups($order_by){
        $this->global_model->_table_name = 'tbl_loan_groups';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_primary_key = 'loan_group_id';
    }

    public function tbl_campaign($order_by, $order=null){
        $this->global_model->_table_name = 'tbl_campaign';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'campaign_id';
    }
        
    
    
    public function tbl_campaign_result($order_by, $order=null){
        $this->global_model->_table_name = 'tbl_campaign_result';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'campaign_result_id';
    }

   public function tbl_expense($order_by, $order=null){
        $this->global_model->_table_name = 'tbl_expense';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'expense_id';
    }
    
   public function tbl_expense_category($order_by, $order=null){
        $this->global_model->_table_name = 'tbl_expense_category';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'expense_category_id';
    }
    
 public function tbl_money_manager_category($order_by, $order=null){
        $this->global_model->_table_name = 'tbl_money_manager_category';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'money_manager_category_id';
    }


}
