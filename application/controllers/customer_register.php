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

class Customer_Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('global_model');
        $this->load->model('user_model');
         $this->load->model('customer_model');
        $this->load->helper('form');
    }

    public function index(){

        $data['title'] = 'Customer Register';  // title page

        $data['subview'] = $this->load->view('customer_register', $data, true);
        $this->load->view('customer_register', $data);
    }
    
     public function buy_token($meter=null)
    {
         if($meter){
           $data['meter_number']=$meter;
         }
    
        $data['title'] = 'Buy Token';
		
        $data['subview'] = $this->load->view('admin/apis/buy_token', $data, true);
        
} 

    public function register(){
        
 	
        $first_name          = $this->input->post('first_name', true);
        $last_name = $this->input->post('last_name', true);
        $phone       = $this->input->post('phone', true);
        $user_name    = $this->input->post('user_name', true);
    	$email= $this->input->post('email', true);
    	$account_type= $this->input->post('account_type', true);
    	$password= $this->input->post('password', true);
    	$gender= $this->input->post('gender', true);
    	$birthday_month= $this->input->post('birthday_month', true);
    	$birthday_day= $this->input->post('birthday_day', true);
    	$birthday_year= $this->input->post('birthday_year', true);
    	$parent_reference= $this->input->post('parent_id', true);
    	
    	
    	
    	
    	//check parent reference
    	if(!empty($parent_reference)){
    	$parent= $this->db->get_where('tbl_customer',array('customer_account'=>$parent_reference))->row();
    	}
    	
    
    	if(!empty($parent->user_id)){
    	    if($parent->account_type==2 || $parent->account_type==3){
    	    $parent_id=$parent->user_id;
    	    }else{
    	        $parent_id=0;
    	    }
    	}else{
    	    $parent_id=0;
    	}
            	
            //*************** patient Information **************
             
        $reg_info['first_name']=$first_name;
        $reg_info['last_name']=$last_name;
        //$reg_info['user_name']=$user_name;
        $reg_info['email']=$email;
        $reg_info['parent_id']=$parent_id;
        $reg_info['phone']=$phone;
        $reg_info['registration_date']= date("Y-m-d H:i:s");
        $reg_info['birth_date']=$birthday_year.'-'.$birthday_month.'-'.$birthday_day;
        $reg_info['account_type']=$account_type;
        $reg_info['gender']=$gender;
        
            
        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $reg_info['customer_account'] = $customerNo = 100000000 + $lastId + 1;

        
        $this->customer_model->_table_name = 'tbl_customer'; // table name
        $this->customer_model->_primary_key = 'customer_id'; // $id
        $customer_id = $this->customer_model->save($reg_info);
        
        //create login access
        $name=$first_name.' '.$last_name;
        
        $flag = 0;
        $user_category_id = 2;
        $user_id=null;
        
        $login=$this->create_user_login($customer_id,$name,$user_name,$password,$email,$account_type,$user_category_id,$flag,$user_id,$parent_id);
        
        //update current_stock
        
        $this->update_current_stock($customer_id,$reg_info['customer_account']);
        
        //send alert
        $message='Ndugu,'.$name.' Umesajiliwa PayLess kikamilifu';
        
        $this->alert($reg_info['phone'],$message);
          
        if($login===1 || $login===2){
        $this->session->set_flashdata('error', 'Registration succesful,Click sign in to login');
        redirect('customer_register', 'refresh');
        }else {
       $this->session->set_flashdata('error', 'Registration failed try again later');
        }

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
        $user_info['approved'] = 0;
        
        
        if(empty($user_id)){
            $this->db->insert("tbl_user",$user_info);
            $id= $insert_id = $this->db->insert_id();
        }else{
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
        
        $customer_id = $this->db->insert('tbl_current_stock',$stock_info);
        
        
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

}