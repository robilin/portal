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
class Meter extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
        $this->load->model('meter_model');
        $this->load->model('user_model');
        $this->load->model('global_model');
        $this->load->library('pagination');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'meter/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '250px'
            )
        );
    }
  
    

    /*** meter action handel ***/
    public function meter_action()
    {
        
        $action  = $this->input->post('action', true);
        $meter_id = $this->input->post('meter_id', true);
        
        if (!empty($meter_id)) {
            
            
            if ($action == 1) {
                //with customer meter
                $this->meter_with_customer($meter_id);
                
            } elseif ($action == 2) {
                //mark in use meter
                $this->confiscated_meter($meter_id);
            } elseif ($action == 3) {
                //decommission meter
                $this->meter_with_branch($meter_id);
            } elseif ($action == 4) {
                //mstolen_meter
                $this->mark_stolen_meter($meter_id);
            } elseif ($action == 5) {
                //mark damaged_meter
                $this->mark_damaged_meter($meter_id);
            } else {
                //delete meter
                $this->delete_meter($meter_id);
            }
        } else {
            $this->message->custom_error_msg('admin/meter/manage_meter', 'You did not select any meter');
        }
    }
    
   public function mark_stolen_meter($meter_id)
    {
        foreach($meter_id as $v_meter_id){
            $id = $v_meter_id;
            $data['status'] ='Stolen';
            $this->tbl_meter('meter_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/meter/manage_meter', 'Action successfully!');
    }
    
  public function mark_damaged_meter($meter_id)
    {
        foreach($meter_id as $v_meter_id){
            $id = $v_meter_id;
            $data['status'] ='Damaged';
            $this->tbl_meter('meter_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/meter/manage_meter', 'Action successfully!');
    }
    
 public function confiscated_meter($meter_id)
    {
        foreach($meter_id as $v_meter_id){
            $id = $v_meter_id;
            $data['status'] ='Confiscated';
            $this->tbl_meter('meter_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/meter/manage_meter', 'Action successfully!');
    }
    
  public function meter_with_customer($meter_id)
    {
        foreach($meter_id as $v_meter_id){
            $id = $v_meter_id;
            $data['status'] ='With Customer';
            $this->tbl_meter('meter_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/meter/manage_meter', 'Successfully!');
    }
    
    
    /*** meter activate ***/
    public function active_meter($meter_id)
    {
        foreach ($meter_id as $v_meter_id) {
            $id             = $v_meter_id;
            $data['status'] = 1;
            $this->tbl_meter('meter_item');
            
            //update
            $this->global_model->save($data, $id);
        }
        $this->message->custom_success_msg('admin/meter/manage_meter', 'Your meter Active Successfully!');
    }
    
   public function meter_with_branch($meter_id)
    {
        foreach($meter_id as $v_meter_id){
            $id = $v_meter_id;
            $data['status'] ='With Branch';
            $this->tbl_meter('meter_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/meter/manage_meter', 'Action successfully!');
    }
    
    
    
    public function meter_assign($id)
    {
        $data['meter_info'] = $this->meter_model->get_meter_information_by_id($id);
        
        $this->user_model->_table_name = 'tbl_user';
        $this->user_model->_order_by   = 'user_id';
        
        $data['all_employee_info']     = $this->user_model->get_users();
        
        $data['title']         = 'View meter';
        $data['meter_id']       = $id;
        $data['modal_subview'] = $this->load->view('admin/meter/_modal_assign_meter', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
   public function meter_link($id)
    {
        $data['meter_info'] = $this->meter_model->get_meter_information_by_id($id);
        
        $user_type=$this->session->userdata('user_type');
                
        if($user_type==1){ //if user is admin show everything
        $data['all_customer_info']     = $this->customer_model->get_customers_by_account_type(1); //1=tenant account type
        }elseif($user_type==2 OR $user_type==3){   
        $parent=$this->session->userdata('employee_id');
        $data['all_customer_info'] = $this->customer_model->get_customers_by_account_parent($parent,1); //1=user type has to be tenant always
        }
        
        $data['title']         = 'Link Meter Tenant';
        $data['meter_id']       = $id;
        $data['modal_subview'] = $this->load->view('admin/meter/_modal_link_meter', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    public function install_meter($customer_id)
    {
              
        $data['meter'] = $this->meter_model->get_all_meter_info();
        
        $user_type=$this->session->userdata('user_type');
        
        if($user_type==1){ //if user is admin show everything
            $data['all_customer_info']     = $this->customer_model->get_customers_by_account_type(1); //1=tenant account type
        }elseif($user_type==2 OR $user_type==3){
            $parent=$this->session->userdata('employee_id');
            $data['all_customer_info'] = $this->customer_model->get_customers_by_account_parent($parent,1); //1=user type has to be tenant always
        }
        
        $data['title']         = 'Install meter';
        $data['customer_id']=$customer_id;
        $data['subview'] = $this->load->view('admin/meter/install_customer_meter', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function save_install_meter($customer_id=null)
    {
        

        $meter_id= $this->input->post('meter_id', true);
        $data['install_date']  = $this->input->post('install_date', true);
        $data['customer_id']  = $customer_id;
        $data['status']  = 1; //installed
        
        $this->tbl_meter('meter_id');
        $this->global_model->save($data,$meter_id);
        
        $this->message->custom_success_msg('admin/meter/manage_meter', 'Meter linked to customer succesfully!');
    }
    
   public function save_meter_link($id)
    {
    	
        $account_id = $this->input->post('meter_id', true);
        
        $data['meter_assigned_date'] = $this->input->post('meter_assigned_date', true);
        $data['customer_id']   = $this->input->post('customer_id', true);
        //$data['meter_assignee']      = $this->session->userdata('name');
        
               
        $this->tbl_meter('meter_item');
        
        //update
        $this->global_model->save($data, $id);
        
        $this->message->custom_success_msg('admin/meter/manage_meter', 'Meter linked to customer succesfully!');
    }
    
    
    /*** meter deactivate ***/
    public function save_meter_assign($id=null)
    {
        
        $id = $this->input->post('meter_id', true);
        
        $data['meter_assigned_date'] = $this->input->post('meter_assigned_date', true);
        $data['meter_assignee']   = $this->input->post('meter_assignee', true);
        //$data['meter_assignee']      = $this->session->userdata('name');
        
               
        $this->tbl_meter('meter_item');
        
        //update
        $this->global_model->save($data, $id);
        
        $this->message->custom_success_msg('admin/meter/manage_meter', 'meter assigned succesfully!');
    }
    /*** meter deactivate ***/
    public function deactive_meter($meter_id)
    {
        foreach ($meter_id as $v_meter_id) {
            $id             = $v_meter_id;
            $data['status'] = 0;
            $this->tbl_meter('meter_item');
            
            //update
            $this->global_model->save($data, $id);
        }
        $this->message->custom_success_msg('admin/meter/manage_meter', 'Your meter Deactivated Successfully!');
    }
    
    /*** Delete meter***/
    public function delete_meter($id)
    {
        if (is_array($id)) {
            foreach ($id as $v_id) {
                $this->_delete($v_id);
            }
            $this->message->delete_success('admin/meter/manage_meter');
            
        } else {
            if (!empty($id)) {
                
                $this->tbl_meter('meter_id');
                $meter = $this->global_model->get_by(array(
                    'meter_id' => $id
                ), true);
                if (!empty($meter)) {
                    $this->_delete($id);
                    $this->message->delete_success('admin/meter/manage_meter');
                }
                redirect('admin/meter/manage_meter');
                
            } else {
                redirect('admin/meter/manage_meter');
            }
        }
    }
    
    /*** Delete Function ***/
    public function _delete($id)
    {
        
        //delete from tbl_meter
        $this->tbl_meter('meter_id');
        $this->global_model->delete($id);
        
        
    }
    
     
    /*** Add New or Edit meter ***/
    public function add_meter($id=null)
    {
     
    	        
        if ($id) {
            $this->tbl_meter('meter_id');
            $data['meter_info'] = $this->global_model->get_by(array(
                'meter_id' => $id
            ), true);
           
        }
        
        //view page
        $data['title'] = 'Add meter';

        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/meter/add_meter', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
   public function edit_meter($id=null)
    {
     
    	        
        if ($id) {
            $this->tbl_meter('meter_id');
            $data['meter_info'] = $this->global_model->get_by(array(
                'meter_id' => $id
            ), true);
       
        }
  
        $data['code'] = rand(10000000, 99999);
        
     //view page
        $data['title'] = 'Edit meter';

        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/meter/add_meter', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    /*** Add New or Update  ***/
    public function save_meter($id = null)
    {
        if ($id) { // if id
            $meter_id = $this->input->post('meter_id', true);
            $status=$this->input->post('status', true);
        } else {
            $meter_id = null;
         
            $status=0;
        }

        //*************** meter Information **************

        $meter_info = $this->meter_model->array_from_post(array(
            'meter_number',
        	'meter_serial_number',
            'meter_note',
            'meter_type',
            'meter_model',
        	'meter_vendor',
        	'meter_brand',
            'meter_location',
            'meter_acquired_date',
       	    'meter_warranty_starts',
            'meter_warranty_ends',
            'meter_file_name',
            'meter_file_path',
            'meter_image_name',
        	'meter_image_path',
            'meter_purchase_price',
             ));
            
        $meter_info['meter_assignee']='Not assigned';    

        $this->tbl_meter('meter_id');
        $meter_id = $this->global_model->save($meter_info, $id);

        if(empty($id)) {
            $this->set_barcode($meter_info['meter_serial_number'],$meter_id);
        }else{
            $this->update_barcode($meter_info['meter_serial_number'],$id);
        }
        //****************** meter  Image Upload ***********************//

        // save image Process
        if (!empty($_FILES['meter_image_name']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->meter_model->uploadImage('meter_image_name');
            $val == true || redirect('admin/meter/add_meter');

            $image_data['meter_image_name'] = $val['path'];
            $image_data['meter_image_path'] = $val['fullPath'];
            
            $image_data['meter_id'] = $meter_id;
            if (!empty($meter_id)) {
                $this->global_model->save($image_data, $meter_id); // save and update function
            } else {
                $this->global_model->save($image_data);
            }
        }
        
        
         // File Process
        if (!empty($_FILES['meter_file_name']['name'])) {
            $old_path = $this->input->post('file_old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->meter_model->uploadFile('meter_file_name');
            $val == true || redirect('admin/meter/add_meter');

            $file_data['meter_file_name'] = $val['path'];
            $file_data['meter_file_path'] = $val['fullPath'];
            
            $file_data['meter_id'] = $meter_id;
            if (!empty($meter_id)) {
                $this->global_model->save($file_data, $meter_id); // save and update function
            } else {
                $this->global_model->save($file_data);
            }
        }
       
        $type = 'success';
        $message = 'Information Saved Successfully!';
        set_message($type, $message);
        
        redirect('admin/meter/add_meter');
    }
    
 /*** Manage meter ***/
    public function manage_meter()
    {

        $data['meter'] = $this->meter_model->get_all_meter_info();

        $data['title'] = 'Manage meter';
        $data['subview'] = $this->load->view('admin/meter/manage_meter', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
 public function view_meter($id)
    {
        $data['meter'] = $this->meter_model->get_meter_information_by_id($id);
      
        $data['title'] = 'View meter';
        $data['meter_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/meter/_modal_view_meter', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
/*** Create meter type ***/
    public function meter_type($id = null)
    {
        $this->meter_model->_table_name = 'tbl_meter_type';
        $this->meter_model->_order_by = 'type_id';
        $data['all_meter'] = $this->meter_model->get();
        // edit operation of meter_type
        if (!empty($id)) { // if meter_type id exist
            $where = array('type_id' => $id);
            $data['meter_type_info'] = $this->meter_model->check_by($where, 'tbl_meter_type');

            if (empty($data['meter_type_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/meter/meter_type');
            }
        }

        //view page
        $data['title'] = 'Create Meter Type';
  
        $data['subview'] = $this->load->view('admin/meter/meter_type', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }
    
    public function save_meter_type($id = null)
    {
        $this->meter_model->_table_name = 'tbl_meter_type';
        $this->meter_model->_primary_key = 'type_id';
        
        $data['meter_type']              = $this->input->post('meter_type', true);
        
        // update meter
        $where                                = array(
            'meter_type' => $data['meter_type']
        );
        // duplicate check
        if (!empty($id)) {
            $type_id = array(
                'type_id !=' => $id
            );
        } else {
            $type_id = null;
        }
       
        
        $check_meter = $this->meter_model->check_update('tbl_meter_type', $where, $type_id);
        if (!empty($check_meter)) { // if exist
            $type    = 'error';
            $message = 'Information Already Exist';
        } else { // save and update query
            $this->meter_model->save($data, $id); //save and update
            // massage for employee
            $type    = 'success';
            $message = 'Information Successfully Saved';
        }
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/meter/meter_type');
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

        $this->tbl_meter('meter_id');
        $this->global_model->save($data, $id);
    }

    private function update_barcode($code, $id)
    {
        $barcode  = $this->db->get_where('tbl_meter', array(
            'meter_id' => $id
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

        $this->tbl_meter('meter_id');
        $this->global_model->save($data, $id);

    }
/*** meter Delete ***/
    public function delete_meter_type($id)
    {
        $this->meter_model->_table_name = 'tbl_meter_type';
        $this->meter_model->_order_by = 'type_id';
        $where = array('type_id' => $id);
        $check_meter = $this->meter_model->get_by($where, false);

        if (empty($check_meter)) { // if exist
            $type = 'error';
            $message = 'Information does not exist :)';
        } else { // if empty
            $this->meter_model->_table_name = 'tbl_meter_type';
            $this->meter_model->_primary_key = 'type_id';
            $this->meter_model->delete($id);

            $type = 'success';
            $message = 'Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/meter/meter_type');
    }

         
}

