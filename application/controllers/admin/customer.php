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
        $this->load->model('payments_model');
        $this->load->library('pagination');
        //$this->load->library('Delete_user');
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
            $data['title'] = 'UPDATE TENANT ACCOUNT #';
        }else{
            $data['title'] = 'ADD TENANT ACCOUNT #';
        }
        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $data['code'] = $customerNo = 100000000 + $lastId + 1;
        
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
            
            $this->tbl_user('customer_id');
            $user_info= $this->global_model->get_by(array('customer_id' => $id), true);
            $user_id=$user_info->user_id;
                  
        } else {
   
            $registration_date= date("Y-m-d H:i:s");
            $user_id=null;
        }

       
           
        //*************** patient Information **************

        $customer_info = $this->customer_model->array_from_post(array(
            'customer_account',
            'first_name',
            'last_name',
            'birth_date',
        	'gender',
            'house_no',
            'village',
        	'district',
            'address',
            'phone',
        	'email',
        	'business_name',
        	'description',
            'borrowers_photo_name',
        	'borrowers_photo_path',
        	'borrowers_file_name',
        	'borrowers_file_path',
        	            
         ));
        
        
        $user_category_id = $this->session->userdata('user_category_id');
        
        if($user_category_id==1){
            $parent_id=0; //parent id 0 means is direct customer, customer not assigned to any landlord or partner
        }else{
            $parent_id=$this->session->userdata('employee_id');
        }
                     
        $customer_info['registration_date']=$registration_date;
        $customer_info['parent_id']=$parent_id;
        $customer_info['account_type']=1; //account types 1=tenant,2=landlord,3=partner
                       
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
                       
        
        //create login access
        $name=$customer_info['first_name'].' '.$customer_info['last_name'];
        $user_name= $this->input->post('username', true);
        $password= $this->input->post('password', true);
        $email= $customer_info['email'];
        $account_type=$customer_info['account_type'];
        $flag = 0;
        $user_category_id = 2;
 
        $login=$this->create_user_login($customer_id,$name,$user_name,$password,$email,$account_type,$user_category_id,$flag,$user_id,$parent_id);
        
        //update current_stock
        
        $this->update_current_stock($customer_id,$customer_info['customer_account']);
        
        //send alert
        $message='Ndugu,'.$name.' Umesajiliwa PayLess kikamilifu';
        
        $this->alert($customer_info['phone'],$message);
       
        $type = 'success';
        $message = 'Update Successfully!';
        set_message($type, $message);
        redirect('admin/customer/manage_tenants');
    }
    
    /*** Save login ***/
    public function create_user_login($customer_id=null,$name=null,$user_name=null,$password=null,$email=null,$account_type=null,$user_category_id=null,$flag=null,$user_id=null,$parent_id=null)
    {
 
        $user_info['name']=$name;
        $user_info['customer_id']=$customer_id;
        $user_info['user_name'] =$user_name;
        $user_info['password']=$this->encryption->hash($password);
        $user_info['email'] = $email;
        $user_info['account_type']=$account_type;
        $user_info['flag'] = 0;
        $user_info['user_category_id'] = 2;
        $user_info['parent_id'] = $parent_id;
        
        
        if(empty($user_id)){
            $this->tbl_user('user_id');
            $id = $this->user_model->save($user_info); //create new user
        }else{
            $this->tbl_user('user_id');
            $id = $this->user_model->save($user_info,$user_id); //update info
        }
        
        
        
        //update menu available for customers generally
        
        $menu_data['employee_login_id']=$id;
        
        $menu = $this->db->get('tbl_customer_menu')->result();
        
        foreach ($menu as $v_menu) {
            $menu_data['menu_id']=$v_menu->menu_id;
            
            $this->db->insert("tbl_user_role",$menu_data);
        }
        
        
        if (!empty($id)) {
            
            //update customer table
            $this->update_customer($customer_id, $id);
            
            $type = 'success';
            $message = 'User Login Information Update Successfully!';
            set_message($type, $message);
            return 1;
        } else {
            $type = 'success';
            $message = 'New User Create Successfully!';
            set_message($type, $message);
            return 2;
        }
    }
    
    public function update_current_stock($customer_id,$customer_account){
                
        $stock_info['customer_id']=$customer_id;
        $stock_info['last_updated']=date("Y-m-d H:i:s");
        $stock_info['current_stock']=0;
        $stock_info['customer_account']=$customer_account;
        $this->tbl_current_stock('stock_id');
        $customer_id = $this->global_model->save($stock_info);
        
        
    }

    
    /*** Add New or Update Borrower ***/
    public function save_customer_partial_info($id = null)
    {
    	
    	
        $first_name          = $this->input->post('first_name', true);
        $last_name = $this->input->post('last_name', true);
        $phone       = $this->input->post('phone', true);
    	$email= $this->input->post('email', true);
    	$password= $this->input->post('password', true);
           
        //*************** patient Information **************

                     
        $reg_info['first_name']=$first_name;
        $reg_info['last_name']=$last_name;
        $reg_info['email']=$email;
        $reg_info['phone']=$phone;
                                   
        $this->tbl_customer('customer_id');
        $customer_id = $this->global_model->save($reg_info, $id);

        $type = 'success';
        $message = 'Registered successfully, you can now login by clicking login';
        set_message($type, $message);
        redirect('customer_register');
 
 }
    
        
    
  /*** Manage Tenants, partners can manage tenants and landlords, ladlord can manage tenants their tenants only admin can manage everyone ***/
    public function manage_tenants($id=null)
    {
    	$user_id = $this->session->userdata('employee_id');
    	
    	$user_type = $this->session->userdata('user_type');
    	 
        $this->tbl_customer('customer_id');
        $this->db->where('account_type',1);
        if($user_type==0){
            $this->db->where('parent_id',$user_id);
        }
        $data['customer_info'] = $this->global_model->get();
               
        $data['title'] = 'Manage Tenants';
        $data['subview'] = $this->load->view('admin/customer/manage_tenants', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    /*** Manage Customer ***/
    public function manage_partners($id=null)
    {
        $user_id = $this->session->userdata('employee_id');
        
        $user_type = $this->session->userdata('user_type');
           
        $this->tbl_customer('customer_id');
        $this->db->where('account_type',3);
        if($user_type==0){
            $this->db->where('parent_id',$user_id);
        }
        $data['customer_info'] = $this->global_model->get();
        
        $data['title'] = 'Manage Partners';
        $data['subview'] = $this->load->view('admin/customer/manage_partners', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    /*** Manage Customer ***/
    public function manage_landlords($id=null)
    {
        $user_id = $this->session->userdata('employee_id');
        
        $user_type = $this->session->userdata('user_type');
        
        $this->tbl_customer('customer_id');
        $this->db->where('account_type',2);
        if($user_type==0){
        $this->db->where('parent_id',$user_id);
        }
        $data['customer_info'] = $this->global_model->get();
        
        $data['title'] = 'Manage Tenants';
        $data['subview'] = $this->load->view('admin/customer/manage_landlords', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    public function add_landlord($id=null)
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
            $data['title'] = 'UPDATE LANDLORD ACCOUNT #';
        }else{
            $data['title'] = 'ADD LANDLORD ACCOUNT #';
        }
        
        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $data['code'] = $customerNo = 100000000 + $lastId + 1;
        
        
  
        
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/customer/add_landlord', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    /*** Add New or Update Borrower ***/
    public function save_landlord($id = null)
    {
        
        
        if ($id) { // if id
            
            $this->tbl_customer('customer_id');
            $customer_info = $this->global_model->get_by(array('customer_id' => $id), true);
            $registration_date=$customer_info->registration_date;
            
            $this->tbl_user('customer_id');
            $user_info= $this->global_model->get_by(array('customer_id' => $id), true);
            $user_id=$user_info->user_id;
            
        } else {
            
            $registration_date= date("Y-m-d H:i:s");
            $user_id=null;
        }
        
        
        
        //*************** patient Information **************
        
        $customer_info = $this->customer_model->array_from_post(array(
            'customer_account',
            'first_name',
            'last_name',
            'birth_date',
            'gender',
            'house_no',
            'village',
            'district',
            'address',
            'phone',
            'email',
            'business_name',
            'description',
            'borrowers_photo_name',
            'borrowers_photo_path',
            'borrowers_file_name',
            'borrowers_file_path',
            
        ));
        
        
        $user_category_id = $this->session->userdata('user_category_id');
        
        if($user_category_id==1){
            $parent_id=0; //parent id 0 means is direct landlord, customer not assigned to any partner
        }else{
            $parent_id=$this->session->userdata('employee_id');
        }
        
        $customer_info['registration_date']=$registration_date;
        $customer_info['parent_id']=$parent_id;
        $customer_info['account_type']=2; //account types 1=tenant,2=landlord,3=partner
        
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
        
        
        //create login access
        $name=$customer_info['first_name'].' '.$customer_info['last_name'];
        $user_name= $this->input->post('username', true);
        $password= $this->input->post('password', true);
        $email= $customer_info['email'];
        $account_type=$customer_info['account_type'];
        $flag = 0;
        $user_category_id = 2;
        
        $login=$this->create_user_login($customer_id,$name,$user_name,$password,$email,$account_type,$user_category_id,$flag,$user_id,$parent_id);
        
        //update current_stock
        
        $this->update_current_stock($customer_id,$customer_info['customer_account']);
        
        //send alert
        $message='Ndugu,'.$name.' Umesajiliwa PayLess kikamilifu';
        
        $this->alert($customer_info['phone'],$message);
        
        $type = 'success';
        $message = 'Update Successfully!';
        set_message($type, $message);
        
        redirect('admin/customer/manage_landlords');
    }
    
    /*** Add New or Edit customer ***/
    public function add_partner($id=null)
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
            $data['title'] = 'UPDATE PARTNER ACCOUNT #';
        }else{
            $data['title'] = 'ADD PARTNER ACCOUNT #';
        }
        
        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $data['code'] = $customerNo = 100000000 + $lastId + 1;
        
        
       
        
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/customer/add_partner', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
    
    /*** Add New or Update Borrower ***/
    public function save_partner($id = null)
    {
        
        
        
        if ($id) { // if id
            
            $this->tbl_customer('customer_id');
            $customer_info = $this->global_model->get_by(array('customer_id' => $id), true);
            $registration_date=$customer_info->registration_date;
            
            $this->tbl_user('customer_id');
            $user_info= $this->global_model->get_by(array('customer_id' => $id), true);
            $user_id=$user_info->user_id;
            
        } else {
            
            $registration_date= date("Y-m-d H:i:s");
        }
        
        
        
        //*************** patient Information **************
        
        $customer_info = $this->customer_model->array_from_post(array(
            'customer_account',
            'first_name',
            'last_name',
            'birth_date',
            'gender',
            'house_no',
            'village',
            'district',
            'address',
            'phone',
            'email',
            'business_name',
            'description',
            'borrowers_photo_name',
            'borrowers_photo_path',
            'borrowers_file_name',
            'borrowers_file_path',
            
        ));
        
        
        $user_category_id = $this->session->userdata('user_category_id');
        
        if($user_category_id==1){
            $parent_id=0; //parent id 0 means is direct customer, customer not assigned to any landlord or partner
        }else{
            $parent_id=$this->session->userdata('employee_id');
        }
        
        $customer_info['registration_date']=$registration_date;
        $customer_info['parent_id']=$parent_id;
        $customer_info['account_type']=3; //account types 1=tenant,2=landlord,3=partner
        
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
        
        
        //create login access
        $name=$customer_info['first_name'].' '.$customer_info['last_name'];
        $user_name= $this->input->post('username', true);
        $password= $this->input->post('password', true);
        $email= $customer_info['email'];
        $account_type=$customer_info['account_type'];
        $flag = 0;
        $user_category_id = 2;
        
        $login=$this->create_user_login($customer_id,$name,$user_name,$password,$email,$account_type,$user_category_id,$flag,$user_id,$parent_id);
        
        //update current_stock
        
        $this->update_current_stock($customer_id,$customer_info['customer_account']);
        
        //send alert
        $message='Ndugu,'.$name.' Umesajiliwa PayLess kikamilifu';
        
        $this->alert($customer_info['phone'],$message);
        
        $type = 'success';
        $message = 'Update Successfully!';
        set_message($type, $message);
        redirect('admin/customer/manage_partners');
    }
    
   public function view_customer_profile($id)
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
        
        $user_type = $this->session->userdata('user_type');
        
        
        if($user_type==1){
            $data['show_approve_button']=1;
        }else{
            $data['show_approve_button']=0;
        }

        $data['title']='View My Profile';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/customer/view_customer_profile', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
  
    
   
    public function view_tenants($id)
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

        $data['title']='View Tenants';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/customer/view_tenants', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Delete Customer ***/
    public function delete_customer($id=null)
    {
        $this->customer_model->_table_name = 'tbl_customer';
        $this->customer_model->_primary_key = 'customer_id';
        
        $user_id=$this->customer_model->get_customers_by_id($id);
        
        $this->customer_model->delete($id);  // delete by id
        
        $CI =& get_instance();
        
        $CI->load->library('Delete_user');
        
        $CI->delete_user->delete_user($user_id->user_id);
       
        // massage for employee
        $type = 'error';
        $message = 'Customer Successfully Deleted from System';
        
               
        set_message($type, $message);
        redirect('admin/customer/manage_tenants');
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
    
        
    function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function update_customer($customer_id,$user_id) {
        
        $data['user_id']=(integer)$user_id;
        $this->db->where('customer_id', $customer_id);
        $this->db->update('tbl_customer', $data);
        
        return;
    }
    
    public function alert($phone=null,$message)
    {
                
        //load send sms library
        $this->load->library('public_sms');
        
        $from='INFO';
        $flag=2; //this will force to return semaphore here
        
       
        if(strlen($phone)>=9 AND strlen($message)>0 ){
        $send_sms=$this->public_sms->send_autoreply($phone, $message,$flag,$from);
        }
    }
    
    /*** asset activate ***/
    public function approve_account($customer_id=null)
    {
 
         $data['status'] ='approved';
         $this->tbl_customer('customer_id');
            
            //update
         $this->global_model->save($data,$customer_id);

        //retrieve account info for to get account taype
        
         $account_type= $this->db->get_where('tbl_customer', array('customer_id' =>$customer_id))->row();
        
         $account=$account_type->account_type;
        
        if($account==1){        
        $this->message->custom_success_msg('admin/customer/manage_tenants', 'Approved Successfully!');
        }elseif($account==2){
            $this->message->custom_success_msg('admin/customer/manage_landlords', 'Approved Successfully!');
        }elseif($account==3){
            $this->message->custom_success_msg('admin/customer/manage_partners', 'Approved Successfully!');
        }
    }
}
