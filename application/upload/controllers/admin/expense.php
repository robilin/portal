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

class Expense extends Admin_Controller
{
  
public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('expense_model');
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

    /*** New Expense***/
    public function add_expense($id=null){

        if ($id) {
            $this->tbl_expense('expense_id');
            $data['expense'] = $this->global_model->get_by(array('expense_id'=>$id), true);
            if(empty($data['expense'])){
                $this->message->norecord_found('admin/expense/manage_expense');
            }
        }
        
        
        $this->user_model->_table_name = 'tbl_user';
        $this->user_model->_order_by = 'user_id';
        $data['all_employee_info'] = $this->user_model->get();
        
        //Get categories for compain
        $data['category'] = $this->expense_model->get_all_category();
        $data['title'] = 'Add Expense';
        $data['subview'] = $this->load->view('admin/expense/add_expense', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }
    /*** Save expense ***/
    public function save_expense($id=null)
    {
           $data = $this->global_model->array_from_post(array(
            'expense_category_id',
            'employee',
            'amount',
            'description'
        )); 
    	 
        
     // File Process
        if (!empty($_FILES['expense_file']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->expense_model->uploadFile('expense_file');
            $val == true || redirect('admin/expense/add_expense');

            $data['filename'] = $val['path'];
            $data['file_path'] = $val['fullPath'];

        }
        //Created by
        $data['created_by'] = $this->session->userdata('name');
        
        $this->tbl_expense('expense_id');
        $this->global_model->save($data, $id);
        
        $this->message->save_success('admin/expense/manage_expense');
    }
    /*** Manage Expense ***/
    public function manage_expense(){
            	
    	$this->tbl_expense('expense_id','desc');
        $data['expense'] = $this->global_model->get();

        $data['title'] = 'Manage Expense';
        $data['subview'] = $this->load->view('admin/expense/manage_expense', $data, true);
        $this->load->view('admin/_layout_main', $data);
       
    }
    
/*** Delete Expense ***/
    public function delete_expense($id=null)
    {
        if(!empty($id)){
            $this->tbl_expense('expense_id');
            $this->global_model->delete($id);
            $this->message->delete_success('admin/expense/manage_expense');
        }else{
            $this->message->custom_error_msg('admin/expense/manage_expense', 'Sorry there is no record found');
        }
    }
    
  /*** View Expense ***/
    public function view_expense($id)
    {
        $this->tbl_expense('expense_id');
        $data['expense'] = $this->global_model->get_by(array('expense_id'=>$id), true);

        $data['title'] = 'View Expense';
        $data['expense_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/expense/_modal_view_expense', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
     
    }
 
    /*** Create Category ***/
    public function category($id = null)
    {
        $this->expense_model->_table_name = 'tbl_expense_category';
        $this->expense_model->_order_by = 'expense_category_id';
        $data['all_category'] = $this->expense_model->get();
        // edit operation of category
        if (!empty($id)) { // if category id exist
            $where = array('expense_category_id' => $id);
            $data['category_info'] = $this->expense_model->check_by($where, 'tbl_expense_category');

            if (empty($data['category_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/expense/category');
            }
        }

        //view page
        $data['title'] = 'Create Expense Category';
  
        $data['subview'] = $this->load->view('admin/expense/category', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }

    /*** Save Category ***/
    public function save_category($id = null)
    {
        $this->expense_model->_table_name = 'tbl_expense_category';
        $this->expense_model->_primary_key = 'expense_category_id';

        $data['category_name'] = $this->input->post('category_name', true);

        // update category
        $where = array('category_name' => $data['category_name']);
        // duplicate check
        if (!empty($id)) {
            $expense_category_id = array('expense_category_id !=' => $id);
        } else {
            $expense_category_id = null;
        }

        $check_category = $this->expense_model->check_update('tbl_expense_category', $where, $expense_category_id);
        if (!empty($check_category)) { // if exist

            $type = 'error';
            $message = 'Expense Category Information Already Exist';
        } else { // save and update query
            $this->expense_model->save($data, $id); //save and update
            // massage for employee
            $type = 'success';
            $message = 'Expense Category Information Successfully Saved';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/expense/category');
    }

    /*** Category Delete ***/
    public function delete_category($id)
    {
        $this->expense_model->_table_name = 'tbl_expense_category';
        $this->expense_model->_order_by = 'expense_category_id';
        $where = array('expense_category_id' => $id);
        $check_category = $this->expense_model->get_by($where, false);

        if (empty($check_category)) { // if exist
            $type = 'error';
            $message = 'Category Information does not exist :)';
        } else { // if empty
            $this->expense_model->_table_name = 'tbl_expense_category';
            $this->expense_model->_primary_key = 'expense_category_id';
            $this->expense_model->delete($id);

            $type = 'success';
            $message = 'Expense Category Information Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/expense/category');
    }
    
    }