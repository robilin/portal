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

class money_manager extends Admin_Controller
{
  
public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('money_manager_model');
        $this->load->model('global_model');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '150px',
            ),
        );
    }

    /*** New money_manager***/
    public function add_money_manager($id=null){

        if ($id) {
            $this->tbl_money_manager('money_manager_id');
            $data['money_manager'] = $this->global_model->get_by(array('money_manager_id'=>$id), true);
            if(empty($data['money_manager'])){
                $this->message->norecord_found('admin/money_manager/manage_money_manager');
            }
        }
        
        
        $this->user_model->_table_name = 'tbl_user';
        $this->user_model->_order_by = 'user_id';
        $data['all_employee_info'] = $this->user_model->get();
        
        //Get categories for compain
        $data['category'] = $this->money_manager_model->get_all_category();
        $data['title'] = 'Add money_manager';
        $data['subview'] = $this->load->view('admin/money_manager/add_money_manager', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }
    /*** Save money_manager ***/
    public function save_money_manager($id=null)
    {
           $data = $this->global_model->array_from_post(array(
            'money_manager_category_id',
            'employee',
            'amount',
            'description'
        )); 
    	 
        
     // File Process
        if (!empty($_FILES['money_manager_file']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->money_manager_model->uploadFile('money_manager_file');
            $val == true || redirect('admin/money_manager/add_money_manager');

            $data['filename'] = $val['path'];
            $data['file_path'] = $val['fullPath'];

        }
        //Created by
        $data['created_by'] = $this->session->userdata('name');
        
        $this->tbl_money_manager('money_manager_id');
        $this->global_model->save($data, $id);
        
        $this->message->save_success('admin/money_manager/manage_money_manager');
    }
    /*** Manage money_manager ***/
    public function manage_money_manager(){
            	
    	$this->tbl_money_manager('money_manager_id','desc');
        $data['money_manager'] = $this->global_model->get();

        $data['title'] = 'Manage money_manager';
        $data['subview'] = $this->load->view('admin/money_manager/manage_money_manager', $data, true);
        $this->load->view('admin/_layout_main', $data);
       
    }
    
/*** Delete money_manager ***/
    public function delete_money_manager($id=null)
    {
        if(!empty($id)){
            $this->tbl_money_manager('money_manager_id');
            $this->global_model->delete($id);
            $this->message->delete_success('admin/money_manager/manage_money_manager');
        }else{
            $this->message->custom_error_msg('admin/money_manager/manage_money_manager', 'Sorry there is no record found');
        }
    }
    
  /*** View money_manager ***/
    public function view_money_manager($id)
    {
        $this->tbl_money_manager('money_manager_id');
        $data['money_manager'] = $this->global_model->get_by(array('money_manager_id'=>$id), true);

        $data['title'] = 'View money_manager';
        $data['money_manager_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/money_manager/_modal_view_money_manager', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
     
    }
 
    /*** Create Category ***/
    public function category($id=null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_category';
        $this->money_manager_model->_order_by = 'money_manager_category_id';
        
       $data['all_category'] = $this->money_manager_model->get();
       
        
        // edit operation of category
        if (!empty($id)) {  // if category id exist
        	
        	if($id!='income' && $id!='budget'){
        	
            $where = array('money_manager_category_id' => $id);
            
            
            $data['category_info'] = $this->money_manager_model->check_by($where, 'tbl_money_manager_category');

            if (empty($data['category_info'])) { // empty alert
                // massage
                
                $this->message->norecord_found('admin/money_manager/category');
            }
        
        }
        }

        //fetch clicked part of the link
       $data['type']=$this->uri->segment(4);

      


       //view page
        $data['title'] = 'Create Category';
  
        $data['subview'] = $this->load->view('admin/money_manager/category', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }

    /*** Save Category ***/
    public function save_category($id = null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_category';
        $this->money_manager_model->_primary_key = 'money_manager_category_id';

        $data['category_name'] = $this->input->post('category_name', true);
        $data['category_type'] = $this->input->post('category_type', true);
        
        if(trim(strtolower($data['category_type']))=='income'){
        	$data['category_type']='Income';
        }elseif(trim(strtolower($data['category_type']))=='budget'){
        	$data['category_type']='Budget';
        }
        
      //var_dump($data);
       // exit;
        // update category
        $where = array('category_name' => $data['category_name']);
        //$where2 = array('category_type' => $data['category_type']);
        // duplicate check
        if (!empty($id)) {
            $money_manager_category_id = array('money_manager_category_id !=' => $id);
        } else {
            $money_manager_category_id = null;
        }

        $check_category = $this->money_manager_model->check_update('tbl_money_manager_category', $where, $money_manager_category_id);
        //$check_category2 = $this->money_manager_model->check_update('tbl_money_manager_category', $where2, $money_manager_category_id);
          
        if (!empty($check_category)) { //check if exists

            $type = 'error';
            $message = 'Money Manager Category Information Already Exist';
        } else { // save and update query
        	            
            $this->money_manager_model->save($data, $id); //save and update
            // massage for employee
            $type = 'success';
            $message = 'Category Information Successfully Saved';
        }

         
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/category');
    }

    /*** Category Delete ***/
    public function delete_category($id)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_category';
        $this->money_manager_model->_order_by = 'money_manager_category_id';
        $where = array('money_manager_category_id' => $id);
        $check_category = $this->money_manager_model->get_by($where, false);

        if (empty($check_category)) { // if exist
            $type = 'error';
            $message = 'Category Information does not exist :)';
        } else { // if empty
            $this->money_manager_model->_table_name = 'tbl_money_manager_category';
            $this->money_manager_model->_primary_key = 'money_manager_category_id';
            $this->money_manager_model->delete($id);

            $type = 'success';
            $message = 'Category Information Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/category');
    }
    
 /*** Create account ***/
    public function account($id = null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_account';
        $this->money_manager_model->_order_by = 'money_manager_account_id';
        $data['all_account'] = $this->money_manager_model->get();
        // edit operation of account
        if (!empty($id)) { // if account id exist
            $where = array('money_manager_account_id' => $id);
            $data['account_info'] = $this->money_manager_model->check_by($where, 'tbl_money_manager_account');

            if (empty($data['account_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/money_manager/account');
            }
        }

        //view page
        $data['title'] = 'Create money_manager account';
  
        $data['subview'] = $this->load->view('admin/money_manager/account', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }

    /*** Save account ***/
    public function save_account($id = null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_account';
        $this->money_manager_model->_primary_key = 'money_manager_account_id';

        $data['account_name'] = $this->input->post('account_name', true);

        // update account
        $where = array('account_name' => $data['account_name']);
        // duplicate check
        if (!empty($id)) {
            $money_manager_account_id = array('money_manager_account_id !=' => $id);
        } else {
            $money_manager_account_id = null;
        }

        $check_account = $this->money_manager_model->check_update('tbl_money_manager_account', $where, $money_manager_account_id);
        if (!empty($check_account)) { // if exist

            $type = 'error';
            $message = 'money_manager account Information Already Exist';
        } else { // save and update query
            $this->money_manager_model->save($data, $id); //save and update
            // massage for employee
            $type = 'success';
            $message = 'money_manager account Information Successfully Saved';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/account');
    }

    /*** account Delete ***/
    public function delete_account($id)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_account';
        $this->money_manager_model->_order_by = 'money_manager_account_id';
        $where = array('money_manager_account_id' => $id);
        $check_account = $this->money_manager_model->get_by($where, false);

        if (empty($check_account)) { // if exist
            $type = 'error';
            $message = 'Account Information does not exist :)';
        } else { // if empty
            $this->money_manager_model->_table_name = 'tbl_money_manager_account';
            $this->money_manager_model->_primary_key = 'money_manager_account_id';
            $this->money_manager_model->delete($id);

            $type = 'success';
            $message = 'money_manager account Information Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/account');
    }
    
 /*** Create budget ***/
    public function budget($id = null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_budget';
        $this->money_manager_model->_order_by = 'money_manager_budget_id';
        $data['all_budget'] = $this->money_manager_model->get();
        
       $data['category'] = $this->money_manager_model->get_all_category_by_type('Budget');
 
//       var_dump($data['category']);
//       exit;
        // edit operation of budget
        if (!empty($id)) { // if budget id exist
            $where = array('money_manager_budget_id' => $id);
            $data['budget_info'] = $this->money_manager_model->check_by($where, 'tbl_money_manager_budget');

            if (empty($data['budget_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/money_manager/budget');
            }
        }
 
        //view page
        $data['title'] = 'Create Budget';
  
        $data['subview'] = $this->load->view('admin/money_manager/budget', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }

    /*** Save budget ***/
    public function save_budget($id = null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_budget';
        $this->money_manager_model->_primary_key = 'money_manager_budget_id';

        $data['budget_name'] = $this->input->post('budget_name', true);
        $data['budget_amount'] = $this->input->post('budget_amount', true);
        $data['budget_date'] = $this->input->post('budget_date', true);
        
        // update budget
        $where = array('budget_name' => $data['budget_name']);
        // duplicate check
        if (!empty($id)) {
            $money_manager_budget_id = array('money_manager_budget_id !=' => $id);
        } else {
            $money_manager_budget_id = null;
        }

        $check_budget = $this->money_manager_model->check_update('tbl_money_manager_budget', $where, $money_manager_budget_id);
        if (!empty($check_budget)) { // if exist

            $type = 'error';
            $message = 'money_manager budget Information Already Exist';
        } else { // save and update query
            $this->money_manager_model->save($data, $id); //save and update
            // massage for employee
            $type = 'success';
            $message = 'money_manager budget Information Successfully Saved';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/budget');
    }

    /*** budget Delete ***/
    public function delete_budget($id)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_budget';
        $this->money_manager_model->_order_by = 'money_manager_budget_id';
        $where = array('money_manager_budget_id' => $id);
        $check_budget = $this->money_manager_model->get_by($where, false);

        if (empty($check_budget)) { // if exist
            $type = 'error';
            $message = 'budget Information does not exist :)';
        } else { // if empty
            $this->money_manager_model->_table_name = 'tbl_money_manager_budget';
            $this->money_manager_model->_primary_key = 'money_manager_budget_id';
            $this->money_manager_model->delete($id);

            $type = 'success';
            $message = 'money_manager budget Information Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/budget');
    }
    
/*** Create income ***/
    public function income($id = null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_income';
        $this->money_manager_model->_order_by = 'money_manager_income_id';
        $data['all_income'] = $this->money_manager_model->get();
        
       $data['category'] = $this->money_manager_model->get_all_category_by_type('Income');
       $data['account'] = $this->money_manager_model->get_all_accounts();
      
           // edit operation of income
        if (!empty($id)) { // if income id exist
            $where = array('money_manager_income_id' => $id);
            $data['income_info'] = $this->money_manager_model->check_by($where, 'tbl_money_manager_income');

            if (empty($data['income_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/money_manager/income');
            }
        }
 
        //view page
        $data['title'] = 'Create  Income';
  
        $data['subview'] = $this->load->view('admin/money_manager/income', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }

    /*** Save income ***/
    public function save_income($id = null)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_income';
        $this->money_manager_model->_primary_key = 'money_manager_income_id';

        $data['income_name'] = $this->input->post('income_name', true);
        $data['income_amount'] = $this->input->post('income_amount', true);
        $data['income_date'] = $this->input->post('income_date', true);
        $data['income_category'] = $this->input->post('income_category', true);
        $data['income_note'] = $this->input->post('income_note', true);
        
        
        // update income
        $where = array('income_name' => $data['income_name']);
        // duplicate check
        if (!empty($id)) {
            $money_manager_income_id = array('money_manager_income_id !=' => $id);
        } else {
            $money_manager_income_id = null;
        }

        $check_income = $this->money_manager_model->check_update('tbl_money_manager_income', $where, $money_manager_income_id);
        if (!empty($check_income)) { // if exist

            $type = 'error';
            $message = 'Income Information Already Exist';
        } else { // save and update query
            $this->money_manager_model->save($data, $id); //save and update
            // massage for employee
            $type = 'success';
            $message = 'Income Information Successfully Saved';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/income');
    }

    /*** income Delete ***/
    public function delete_income($id)
    {
        $this->money_manager_model->_table_name = 'tbl_money_manager_income';
        $this->money_manager_model->_order_by = 'money_manager_income_id';
        $where = array('money_manager_income_id' => $id);
        $check_income = $this->money_manager_model->get_by($where, false);

        if (empty($check_income)) { // if exist
            $type = 'error';
            $message = 'Income Information does not exist :)';
        } else { // if empty
            $this->money_manager_model->_table_name = 'tbl_money_manager_income';
            $this->money_manager_model->_primary_key = 'money_manager_income_id';
            $this->money_manager_model->delete($id);

            $type = 'success';
            $message = 'money_manager income Information Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/money_manager/income');
    }
    
    }