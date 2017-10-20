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

class Delete_user extends MY_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
        $this->load->model('user_model');
    }
 
public function delete_user($id = null)
    {
        if (!empty($id)) {
          
                //delete procedure run
                // Check employee in db or not
                $this->user_model->_table_name = 'tbl_user'; //table name
                $this->user_model->_order_by = 'user_id';
                $result = $this->user_model->get_by(array('user_id' => $id), true);

                if (count($result)) {
                    //delete employee roll id
                    $this->db->where('employee_login_id', $id);
                    $this->db->delete('tbl_user_role');
                    //delete employee by id
                    $this->db->where('user_id =', $id);
                    $this->db->delete('tbl_user');
                    //redirect successful msg
                    $type = 'success';
                    $message = 'User Deleted Successfully!';
                    set_message($type, $message);
                    redirect('admin/customer/manage_tenants'); //redirect page
                } else {
                    //redirect error msg
                    $type = 'error';
                    $message = 'Sorry this employee not found!';
                    set_message($type, $message);
                    redirect('admin/customer/menage_tenants'); //redirect page
                }
            
        }
    }
}
