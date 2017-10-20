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
        $username    = $this->input->post('user_name', true);
    	$email= $this->input->post('email', true);
    	$account_type= $this->input->post('account_type', true);
    	$password= $this->input->post('password', true);
           
        //*************** patient Information **************

                     
        $reg_info['first_name']=$first_name;
        $reg_info['last_name']=$last_name;
        //$reg_info['user_name']=$username;
        $reg_info['email']=$email;
        $reg_info['phone']=$phone;
        $reg_info['registration_date']= date("Y-m-d H:i:s");
        
        $this->db->select_max('customer_id');
        $lastId = $this->db->get('tbl_customer')->row()->customer_id;
        $reg_info['customer_account'] = $customerNo = 100000000 + $lastId + 1;

        
        $this->customer_model->_table_name = 'tbl_customer'; // table name
        $this->customer_model->_primary_key = 'customer_id'; // $id
        $customer_id = $this->customer_model->save($reg_info);
        
        //create login access
        $name=$first_name.' '.$last_name;
        $login=$this->create_user_login($customer_id,$password,$username,$email,$name,$account_type);
        
        if($login===1 || $login===2){
        $this->session->set_flashdata('error', 'Registration succesful,Click sign in to login');
        redirect('customer_register', 'refresh');
        }else {
       $this->session->set_flashdata('error', 'Registration failed try again later');
        }

    }
    
    /*** Save login ***/
    public function create_user_login($customer_id,$password=null,$user_name=null,$email=null,$name=null,$account_type=null)
    {
        
        $data['password'] = $this->encryption->hash($password);
        $data['user_name'] = $user_name;
        $data['email'] = $email;
   		$data['name'] = $name;
		$data['flag'] = 0; //normal user, avoid creating super user , ie flag 1
		$data['user_category_id'] = 2;
		$data['account_type']=$account_type;
       
		$this->user_model->_table_name = 'tbl_user'; // table name
        $this->user_model->_primary_key = 'user_id'; // $id
        $id = $this->user_model->save($data);
   
        
   
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