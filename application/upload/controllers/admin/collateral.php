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
class Collateral extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('collateral_model');
        $this->load->model('collateral_model');
        $this->load->model('global_model');
        $this->load->library('pagination');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'collateral/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '250px'
            )
        );
    }
  
    

    /*** collateral action handel ***/
    public function collateral_action()
    {
        
        $action  = $this->input->post('action', true);
        $collateral_id = $this->input->post('collateral_id', true);
        
        if (!empty($collateral_id)) {
            
            
            if ($action == 1) {
                //with customer collateral
                $this->collateral_with_customer($collateral_id);
                
            } elseif ($action == 2) {
                //mark in use collateral
                $this->confiscated_collateral($collateral_id);
            } elseif ($action == 3) {
                //decommission collateral
                $this->collateral_with_branch($collateral_id);
            } elseif ($action == 4) {
                //mstolen_collateral
                $this->mark_stolen_collateral($collateral_id);
            } elseif ($action == 5) {
                //mark damaged_collateral
                $this->mark_damaged_collateral($collateral_id);
            } else {
                //delete collateral
                $this->delete_collateral($collateral_id);
            }
        } else {
            $this->message->custom_error_msg('admin/collateral/manage_collateral', 'You did not select any collateral');
        }
    }
    
   public function mark_stolen_collateral($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='Stolen';
            $this->tbl_collateral('collateral_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Action successfully!');
    }
    
  public function mark_damaged_collateral($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='Damaged';
            $this->tbl_collateral('collateral_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Action successfully!');
    }
    
 public function confiscated_collateral($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='Confiscated';
            $this->tbl_collateral('collateral_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Action successfully!');
    }
    
  public function collateral_with_customer($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='With Customer';
            $this->tbl_collateral('collateral_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Successfully!');
    }
    
    
    /*** collateral activate ***/
    public function active_collateral($collateral_id)
    {
        foreach ($collateral_id as $v_collateral_id) {
            $id             = $v_collateral_id;
            $data['status'] = 1;
            $this->tbl_collateral('collateral_item');
            
            //update
            $this->global_model->save($data, $id);
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Your collateral Active Successfully!');
    }
    
   public function collateral_with_branch($collateral_id)
    {
        foreach($collateral_id as $v_collateral_id){
            $id = $v_collateral_id;
            $data['status'] ='With Branch';
            $this->tbl_collateral('collateral_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Action successfully!');
    }
    
    
    
    public function collateral_assign($id)
    {
        $data['collateral_info'] = $this->collateral_model->get_collateral_information_by_id($id);
        
        $this->user_model->_table_name = 'tbl_user';
        $this->user_model->_order_by   = 'user_id';
        $data['all_employee_info']     = $this->user_model->get();
        
        $data['title']         = 'View collateral';
        $data['collateral_id']       = $id;
        $data['modal_subview'] = $this->load->view('admin/collateral/_modal_assign_collateral', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    
    /*** collateral deactivate ***/
    public function save_collateral_assign($id=null)
    {
        
        $id = $this->input->post('collateral_id', true);
        
        $data['collateral_assigned_date'] = $this->input->post('collateral_assigned_date', true);
        $data['collateral_assignee']   = $this->input->post('collateral_assignee', true);
        //$data['collateral_assignee']      = $this->session->userdata('name');
        
               
        $this->tbl_collateral('collateral_item');
        
        //update
        $this->global_model->save($data, $id);
        
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'collateral assigned succesfully!');
    }
    /*** collateral deactivate ***/
    public function deactive_collateral($collateral_id)
    {
        foreach ($collateral_id as $v_collateral_id) {
            $id             = $v_collateral_id;
            $data['status'] = 0;
            $this->tbl_collateral('collateral_item');
            
            //update
            $this->global_model->save($data, $id);
        }
        $this->message->custom_success_msg('admin/collateral/manage_collateral', 'Your collateral Deactivated Successfully!');
    }
    
    /*** Delete collateral***/
    public function delete_collateral($id)
    {
        if (is_array($id)) {
            foreach ($id as $v_id) {
                $this->_delete($v_id);
            }
            $this->message->delete_success('admin/collateral/manage_collateral');
            
        } else {
            if (!empty($id)) {
                
                $this->tbl_collateral('collateral_id');
                $collateral = $this->global_model->get_by(array(
                    'collateral_id' => $id
                ), true);
                if (!empty($collateral)) {
                    $this->_delete($id);
                    $this->message->delete_success('admin/collateral/manage_collateral');
                }
                redirect('admin/collateral/manage_collateral');
                
            } else {
                redirect('admin/collateral/manage_collateral');
            }
        }
    }
    
    /*** Delete Function ***/
    public function _delete($id)
    {
        
        //delete from tbl_collateral
        $this->tbl_collateral('collateral_id');
        $this->global_model->delete($id);
        
        
    }
    
     
    /*** Add New or Edit collateral ***/
    public function add_collateral($id=null)
    {
     
    	        
        if ($id) {
            $this->tbl_loan('loan_id');
            $data['loan_info'] = $this->global_model->get_by(array(
                'loan_id' => $id
            ), true);
           
        }
                 
       // $data['category'] = $this->collateral_model->get_all_category();
        // view page
       // $data['vendor'] = $this->collateral_model->get_all_vendors();
        
        //get collateral_types
       // $data['collateral_type'] = $this->collateral_model->get_all_collateral_types();
        
        //view page
        $data['title'] = 'Add collateral';

        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/collateral/add_collateral', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
   public function edit_collateral($id=null)
    {
     
    	        
        if ($id) {
            $this->tbl_collateral('collateral_id');
            $data['collateral_info'] = $this->global_model->get_by(array(
                'collateral_id' => $id
            ), true);
        }
 
        $data['code'] = rand(10000000, 99999);
        
     -   //view page
        $data['title'] = 'Edit Collateral';

        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/collateral/add_collateral', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    /*** Add New or Update  ***/
    public function save_collateral($id = null)
    {
        if ($id) { // if id
            $collateral_id = $this->input->post('collateral_id', true);
           
        } else {
            $collateral_id = null;
         
            //$collateral_expire_id=null;
        }

        //*************** collateral Information **************

        $collateral_info = $this->collateral_model->array_from_post(array(
            'collateral_name',
        	'customer_id',
       		'loan_id',
        	'collateral_serial_number',
            'collateral_note',
            'status',
            'collateral_type',
            'collateral_model',
        	'collateral_vendor',
            'collateral_location',
            'collateral_acquired_date',
       	    'collateral_warranty_starts',
            'collateral_warranty_ends',
            'collateral_file_name',
            'collateral_file_path',
            'collateral_image_name',
        	'collateral_image_path',
            'collateral_purchase_price',
             ));
            
         $collateral_info['status']='With Customer';
         $collateral_info['collateral_assignee']='Not assigned';    

        $this->tbl_collateral('collateral_id');
        $collateral_id = $this->global_model->save($collateral_info, $id);

        if(empty($id)) {
            $this->set_barcode($collateral_info['collateral_serial_number'],$collateral_id);
        }else{
            $this->update_barcode($collateral_info['collateral_serial_number'],$id);
        }
        //****************** collateral  Image Upload ***********************//

        // save image Process
        if (!empty($_FILES['collateral_image_name']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->collateral_model->uploadImage('collateral_image_name');
            $val == true || redirect('admin/collateral/add_collateral');

            $image_data['collateral_image_name'] = $val['path'];
            $image_data['collateral_image_path'] = $val['fullPath'];
            
            $image_data['collateral_id'] = $collateral_id;
            if (!empty($collateral_id)) {
                $this->global_model->save($image_data, $collateral_id); // save and update function
            } else {
                $this->global_model->save($image_data);
            }
        }
        
        
         // File Process
        if (!empty($_FILES['collateral_file_name']['name'])) {
            $old_path = $this->input->post('file_old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->collateral_model->uploadFile('collateral_file_name');
            $val == true || redirect('admin/collateral/add_collateral');

            $file_data['collateral_file_name'] = $val['path'];
            $file_data['collateral_file_path'] = $val['fullPath'];
            
            $file_data['collateral_id'] = $collateral_id;
            if (!empty($collateral_id)) {
                $this->global_model->save($file_data, $collateral_id); // save and update function
            } else {
                $this->global_model->save($file_data);
            }
        }
       
        $type = 'success';
        $message = 'Information Saved Successfully!';
        set_message($type, $message);
        //var_dump($image_data['collateral_image_path']);
        //var_dump($image_data['collateral_image_name']);
        redirect('admin/loan/view_loan/'.$collateral_info['loan_id']);
    }
    
 /*** Manage collateral ***/
    public function manage_collateral()
    {

        $data['collateral'] = $this->collateral_model->get_all_collateral_info();

        $data['title'] = 'Manage Collateral';
        $data['subview'] = $this->load->view('admin/collateral/manage_collateral', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
 public function view_collateral($id)
    {
        $data['collateral'] = $this->collateral_model->get_collateral_information_by_id($id);
      
        $data['title'] = 'View collateral';
        $data['collateral_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/collateral/_modal_view_collateral', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
/*** Create collateral type ***/
    public function collateral_type($id = null)
    {
        $this->collateral_model->_table_name = 'tbl_collateral_type';
        $this->collateral_model->_order_by = 'type_id';
        $data['all_collateral'] = $this->collateral_model->get();
        // edit operation of collateral_type
        if (!empty($id)) { // if collateral_type id exist
            $where = array('type_id' => $id);
            $data['collateral_type_info'] = $this->collateral_model->check_by($where, 'tbl_collateral_type');

            if (empty($data['collateral_type_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/collateral/collateral_type');
            }
        }

        //view page
        $data['title'] = 'Create Collateral Type';
  
        $data['subview'] = $this->load->view('admin/collateral/collateral_type', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }
    
    public function save_collateral_type($id = null)
    {
        $this->collateral_model->_table_name = 'tbl_collateral_type';
        $this->collateral_model->_primary_key = 'type_id';
        
        $data['collateral_type']              = $this->input->post('collateral_type', true);
        
        // update collateral
        $where                                = array(
            'collateral_type' => $data['collateral_type']
        );
        // duplicate check
        if (!empty($id)) {
            $type_id = array(
                'type_id !=' => $id
            );
        } else {
            $type_id = null;
        }
       
        
        $check_collateral = $this->collateral_model->check_update('tbl_collateral_type', $where, $type_id);
        if (!empty($check_collateral)) { // if exist
            $type    = 'error';
            $message = 'Information Already Exist';
        } else { // save and update query
            $this->collateral_model->save($data, $id); //save and update
            // massage for employee
            $type    = 'success';
            $message = 'Information Successfully Saved';
        }
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/collateral/collateral_type');
    }
        
    /*** Barcode Generate ***/
    private function set_barcode($code, $id)
    {

        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');

        //generate barcode
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());

        imagejpeg($file, "img/barcode/{$code}.jpg");

        $data['barcode'] = "img/barcode/{$code}.jpg";
        $data['barcode_path'] = getcwd().'/'.$data['barcode'];

        $this->tbl_collateral('collateral_id');
        $this->global_model->save($data, $id);
    }

    private function update_barcode($code, $id)
    {
        $barcode  = $this->db->get_where('tbl_collateral', array(
            'collateral_id' => $id
        ))->row()->barcode_path;
        unlink($barcode);

        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');

        //generate barcode
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());

        imagejpeg($file, "img/barcode/{$code}.jpg");

        $data['barcode'] = "img/barcode/{$code}.jpg";
        $data['barcode_path'] = getcwd().'/'.$data['barcode'];

        $this->tbl_collateral('collateral_id');
        $this->global_model->save($data, $id);

    }
/*** collateral Delete ***/
    public function delete_collateral_type($id)
    {
        $this->collateral_model->_table_name = 'tbl_collateral_type';
        $this->collateral_model->_order_by = 'id';
        $where = array('id' => $id);
        $check_collateral = $this->collateral_model->get_by($where, false);

        if (empty($check_collateral)) { // if exist
            $type = 'error';
            $message = 'Information does not exist :)';
        } else { // if empty
            $this->collateral_model->_table_name = 'tbl_collateral_type';
            $this->collateral_model->_primary_key = 'id';
            $this->collateral_model->delete($id);

            $type = 'success';
            $message = 'Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/collateral/collateral_type');
    }

         
}

