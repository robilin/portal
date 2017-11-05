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
        $this->load->model('user_model');
        $this->load->model('customer_model');
        $this->load->model('global_model');
        $this->load->model('ward_model');
         $this->load->model('order_model');
        $this->load->library('pagination');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'customer/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '250px',
            ),
        );
    }
    
    /*** Add New or Edit customer ***/
    public function add_customer($id=null)
    {
        //tab selection
        $tab = $this->uri->segment(6);
        if(!empty($tab)){
            if($tab == 'contact')
            {
                $data['tab'] = $tab;
            }else{
                $data['tab'] = $tab;
            }
        }

        //************* Retrieve customer ****************//

        if($id) {
            $this->tbl_customer('customer_id');
            $data['customer_info'] = $this->global_model->get_by(array('customer_id' => $id), true);

            if (!empty($data['customer_info'])) {

             
			       //visit info
                $this->tbl_customer_visit('customer_visit_id');
                $data['customer_visit'] = $this->global_model->get_by(array('customer_id' => $id), true);


            } else {
                // redirect with msg customer not found
                $this->message->norecord_found('admin/customer/manage_borrowers');
            }
        }

        //$data['code'] = rand(10000000, 99999);
        
        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $data['code'] = $customerNo = 100000000 + $lastId + 1;
        
           
        $data['title'] = 'Add Borrower';

        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/customer/add_customer', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    /*** Add New or Update Borrower ***/
    public function save_customer($id = null)
    {
        if ($id) { // if id

            $this->tbl_customer('customer_id');
            $customer_info = $this->global_model->get_by(array('customer_id' => $id), true);
            $registration_date=$customer_info->registration_date;
                  
        } else {
         
            $customer_visit_id=null;
            $registration_mode='new';
            $registration_date= date("Y-m-d H:i:s");
        }

       
        //*************** patient Information **************

        $customer_info = $this->customer_model->array_from_post(array(
            'borrower_account',
            'first_name',
        	'second_name',
            'last_name',
            'birth_date',
        	'gender',
            'id_number',
            'house_no',
            'village',
        	'district',
            'address',
            'phone',
        	'email',
        	'business_name',
        	'working_status',
        	'description',
            'borrowers_photo_name',
        	'borrowers_photo_path',
        	'borrowers_file_name',
        	'borrowers_file_path',
            'title',
         ));
                     
        $customer_info['registration_date']=$registration_date;
                       
        $this->tbl_customer('customer_id');
        $customer_id = $this->global_model->save($customer_info, $id);
        
        
            //****************** customer & file Image Upload ***********************//

        // save image Process
        if (!empty($_FILES['borrowers_photo_name']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->customer_model->uploadImage('borrowers_photo_name');
            $val == true || redirect('admin/customer/add_customer');

            $image_data['borrowers_photo_name'] = $val['path'];
            $image_data['borrowers_photo_path'] = $val['fullPath'];
            
            $image_data['customer_id'] = $customer_id;
            if (!empty($customer_id)) {
                $this->global_model->save($image_data, $customer_id); // save and update function
            } else {
                $this->global_model->save($image_data); //save function
            }
        }
        
        
         // File Process
        if (!empty($_FILES['customer_file_name']['name'])) {
            $old_path = $this->input->post('file_old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->customer_model->uploadFile('borrowers_file_name');
            $val == true || redirect('admin/customer/add_customer');

            $file_data['borrowers_file_name'] = $val['path'];
            $file_data['borrowers_file_path'] = $val['fullPath'];
            
            $file_data['customer_id'] = $customer_id;
            if (!empty($customer_id)) {
                $this->global_model->save($file_data, $customer_id); // save and update function
            } else {
                $this->global_model->save($file_data); //save
            }
        }
       
        $type = 'success';
        $message = 'Borrower Information Saved Successfully!';
        set_message($type, $message);
        redirect('admin/customer/manage_borrowers');
    }
    
    

    
    public function update_customer_status($customer_id,$visiting_status)
    {
       if($customer_id){
            $info['visit_status'] =$visiting_status;
            
            $this->tbl_customer('customer_id');
            $this->global_model->save($info,$customer_id);
        }
        $this->message->custom_success_msg('admin/customer/manage_borrowers', "Patient successfully admitted");
    }
    
           /*** add borrowers group ***/
    public function add_borrowers_group($id=null)
    {
        if($id) {
            $this->tbl_loan_groups('loan_group_id');
            $data['group_info'] = $this->global_model->get_by(array('loan_group_id' => $id), true);
         }
           	
    	$data['title']='Add Borrowers Group';
        $data['subview'] = $this->load->view('admin/customer/add_borrowers_group', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
    /*** Add New or Update Borrower ***/
    public function save_borrowers_group($id = null)
    {
    	
    	
        $group_name          = $this->input->post('group_name', true);
        $group_borrower_ids       = $this->input->post('group_borrower_ids', true);
        $group_collector_name = $this->input->post('group_collector_name', true);
    	$group_description= $this->input->post('group_description', true);
    	$group_meeting_schedule= $this->input->post('group_meeting_schedule', true);
    	$group_leader_id= $this->input->post('group_leader_borrower_id', true);
    	    	
        if ($id) { // if id

            $this->tbl_loan_groups('loan_group_id');
            $group_info = $this->global_model->get_by(array('loan_group_id' => $id), true);        
        } 

   

                     
        $group_info['group_name']=$group_name;
        $group_info['group_collector_name']=$group_collector_name;
        $group_info['group_description']=$group_description;
        $group_info['group_meeting_schedule']=$group_meeting_schedule;
        $group_info['group_leader_borrower_id']=$group_leader_id;
        
       
    
       
                         
        $this->tbl_loan_groups('loan_group_id');
        $group_loan_id = $this->global_model->save($group_info, $id);
     
  		  for ($i = 0; $i < sizeof($group_borrower_ids); $i++) {
        	$this->tbl_customer('customer_id');
            $group_info = $this->global_model->get_by(array('customer_id' => $group_borrower_ids[$i]), false);
   
          
            
            $arr_str  = implode(",", $group_info->first_name);
            
        
            
            var_dump($arr_str);
            exit;
          
            $this->tbl_loan_groups('loan_group_id');
            $this->global_model->save($data, $group_loan_id);
        }
        
  
  
       
        $type = 'success';
        $message = 'Borrower Information Saved Successfully!';
        set_message($type, $message);
        redirect('admin/customer/manage_borrowers_groups');
 
 }
     
    public function manage_borrowers_groups($id=null)
    {
 		$this->tbl_loan_groups('loan_group_id');
        $data['customer_info'] = $this->global_model->get();
        
        $data['title'] = 'Manage Groups';
        $data['subview'] = $this->load->view('admin/customer/manage_borrowers_groups', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
        
    
        /*** Manage Customer ***/
    public function manage_borrowers($id=null)
    {
    	    	
        $this->tbl_customer('customer_id');
        $data['customer_info'] = $this->global_model->get();
        
        $data['title'] = 'Manage Borrowers';
        $data['subview'] = $this->load->view('admin/customer/manage_borrowers', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
        
    public function manage_my_customer()
    {
    	$doctor_name=$this->session->userdata('name');
    	
    	$this->tbl_customer_visit('customer_id'); 
    	$data['customer_info']=$this->db->get_where('tbl_customer_visit',array('doctor_id'=>$doctor_name))->result();
                
        $data['title'] = 'Manage My Patients';
        $data['subview'] = $this->load->view('admin/customer/manage_my_customer', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
           /*** Manage Customer addimitted***/
    public function manage_admission()
    { 
    		   
        $data['customer_info'] = $this->customer_model->get_admitted_customers('admitted');
        $data['title'] = 'Manage Admitted Patients';
        $data['subview'] = $this->load->view('admin/customer/manage_admission', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function view_group_details($id)
    {


        //************* Retrieve customer ****************//

        if($id) {
            $this->tbl_loan_groups('loan_group_id');
            $data['group_info'] = $this->global_model->get_by(array('loan_group_id' => $id), true);

            if (!empty($data['group_info'])) {

  
               $data['borrowers_info'] = $this->db->get_where('tbl_customer',array('loan_group_id' => $id))->result();
                
               //lab_requests
               $data['labolatory_info']= $this->db->get_where('tbl_lab_requests',array('customer_id' => $id))->result();
        	
             	
                //admission info
               $this->tbl_patient_admitted('admission_id');
               $data['admit_info'] = $this->global_model->get_by(array('customer_id' => $id), true);
             	
             	//history info
               $this->tbl_patient_history('customer_id');
               $this->db->where('customer_id',$id);
               $data['history_info'] = $this->global_model->get();
 				
             	//var_dump($data['history_info']);
             	//exit;
             	
            } else {
                // redirect with msg customer not found
                $this->message->norecord_found('admin/customer/manage_borrowers_groups');
            }
        }


           
        $data['title'] = 'View Group Details';

        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/customer/view_group_details', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
   
    public function view_loans_borrower($id)
    {
        //tab selection
        $tab = $this->uri->segment(6);
        if(!empty($tab)){
            if($tab == 'history')
            {
                $data['tab'] = $tab;
            }else{
                $data['tab'] = $tab;
            }
        }

        //************* Retrieve customer ****************//

        if($id) {
            $this->tbl_customer('customer_id');
            $data['customer_info'] = $this->global_model->get_by(array('customer_id' => $id), true);
        }

        $data['title']='View Loan Borrowers';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/customer/view_loans_borrower', $data, true);
        $this->load->view('admin/_layout_main', $data);
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
    


    /*** Delete Customer ***/
    public function delete_customer($id=null)
    {
        $this->customer_model->_table_name = 'tbl_customer';
        $this->customer_model->_primary_key = 'customer_id';
        $this->customer_model->delete($id);  // delete by id

        // massage for employee
        $type = 'error';
        $message = 'Patient Successfully Deleted from System';
        set_message($type, $message);
        redirect('admin/customer/manage_borrowers');
    }
       
 
    /*** Check Duplicate Customer  ***/
    public function check_customer_phone($phone=null, $customer_id = null)
    {
        $this->tbl_customer('customer_id');
        if(empty($customer_id))
        {
            $result = $this->global_model->get_by(array('customer_id'=>$phone), true);
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
