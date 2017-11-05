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

class Customer extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('global_model');

    }

  function quick_customer_add_during_order($id = null){
        $this->tbl_customer('customer_id');

        if ($id) {
            $data['customer'] = $this->global_model->get_by(array('customer_id'=>$id), true);
            if(empty($data['customer'])){
                $type = 'error';
                $message = 'There is no Record Found!';
                set_message($type, $message);
                redirect('admin/customer/manage_customer');
            }
        }



        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $data['code'] = $customerNo = 100 + $lastId + 1;

        $this->data=0;

        $data['modal_subview'] = $this->load->view('admin/customer/_modal_add_customer', $data, FALSE);
        $this->load->view('admin/_layout_modal_small', $data);
    }


    /*** Add Customer ***/
    public function add_customer($id = null)
    {
        $this->tbl_customer('customer_id');

        if ($id) {
            $data['customer'] = $this->global_model->get_by(array('customer_id'=>$id), true);
            if(empty($data['customer'])){
                $type = 'error';
                $message = 'There is no Record Found!';
                set_message($type, $message);
                redirect('admin/customer/manage_customer');
            }
        }



        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $data['code'] = $customerNo = 100 + $lastId + 1;

        $this->data=0;
        
        $data['title'] = 'Add Customer';  // title page
        $data['editor'] = $this->data;
        $data['subview'] = $this->load->view('admin/customer/add_customer', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Save Customer ***/
    public function save_customer($id = null)
    {
        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $prefix = $customerNo = 100 + $lastId;

        $data = $this->customer_model->array_from_post(array(
            'customer_name',
            'email',
            'phone',
            'address',
            'discount'
             ));
        $data['address'] = nl2br($this->input->post('address'));

        $this->tbl_customer('customer_id');
        $customer_id = $this->global_model->save($data, $id);

        if(empty($id)) {
            $customer_code['customer_code'] = $prefix + $customer_id;
            $this->global_model->save($customer_code, $customer_id);
        }

        $type = 'success';
        $message = 'Customer Information Saved Successfully!';
        set_message($type, $message);
        redirect('admin/customer/manage_customer');
    }

    public function save_customer_modal($id = null)
    {
        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $prefix = $customerNo = 100 + $lastId;

        $data = $this->customer_model->array_from_post(array(
            'customer_name',
            'email',
            'phone',
            'address',
            'discount'
             ));
        $data['address'] = nl2br($this->input->post('address'));

        $this->tbl_customer('customer_id');
        $customer_id = $this->global_model->save($data, $id);

        if(empty($id)) {
            $customer_code['customer_code'] = $prefix + $customer_id;
            $this->global_model->save($customer_code, $customer_id);
        }

        $type = 'success';
        $message = 'Customer Information Saved Successfully!';
        set_message($type, $message);
        return $type;
        //redirect('admin/order/new_order');
    }
    /*** Manage Customer ***/
    public function manage_customer()
    {

        $this->tbl_customer('customer_id');
        $data['customer'] = $this->global_model->get();
        $data['title'] = 'Manage Customer';
        $data['subview'] = $this->load->view('admin/customer/manage_customer', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Delete Customer ***/
    public function delete_customer($id=null)
    {
        $this->customer_model->_table_name = 'tbl_customer';
        $this->customer_model->_primary_key = 'customer_id';
        $this->customer_model->delete($id);  // delete by id

        // massage for employee
        $type = 'error';
        $message = 'Customer Successfully Deleted from System';
        set_message($type, $message);
        redirect('admin/customer/manage_customer');
    }

    /*** Check Duplicate Customer  ***/
    public function check_customer_phone($phone=null, $customer_id = null)
    {
        $this->tbl_customer('customer_id');
        if(empty($customer_id))
        {
            $result = $this->global_model->get_by(array('phone'=>$phone), true);
        }else{
            //$result = $this->customer_model->check_customer_phone($phone, $customer_id);
            $result = $this->global_model->get_by(array('phone'=>$phone, 'customer_id !=' => $customer_id ), true);
        }

        if($result)
        {
            echo 'This phone number already exist!';
        }

    }
}
