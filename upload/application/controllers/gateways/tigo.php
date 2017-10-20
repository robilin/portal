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
        $this->load->helper('form');
    }

    public function index(){

        $data['title'] = 'Customer Register';  // title page

        $data['subview'] = $this->load->view('customer_register', $data, true);
        $this->load->view('customer_register', $data);
    }

    public function register(){
        
 	
        $first_name          = $this->input->post('first_name', true);
        $last_name = $this->input->post('last_name', true);
        $phone       = $this->input->post('phone', true);
        $username    = $this->input->post('user_name', true);
    	$email= $this->input->post('email', true);
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
                           
        $customer_id = $this->db->insert('tbl_customer', $reg_info);
        
        //create login access
        $name=$first_name.' '.$last_name;
        $login=$this->create_user_login($customer_id,$password,$username,$email,$name);
        
        if($login===1 || $login===2){
        $this->session->set_flashdata('error', 'Registration succesful,Click sign in to login');
        redirect('customer_register', 'refresh');
        }else {
       $this->session->set_flashdata('error', 'Registration failed try again later');
        }

    }
    
    /*** Save login ***/
    public function create_user_login($customer_id,$password=null,$user_name=null,$email=null,$name=null)
    {
        
        $data['password'] = $this->encryption->hash($password);
        $data['user_name'] = $user_name;
        $data['email'] = $email;
   		$data['name'] = $name;
		$data['flag'] = 0;
		$data['user_category_id'] = 2;
       
        $this->db->insert('tbl_user',$data);
        $user_id=$this->db->insert_id();
     
        //update customer info
        $this->update_customer($customer_id,$user_id);

//        $this->user_model->_table_name = 'tbl_user_role'; // table name
//        $this->user_model->_primary_key = 'user_role_id'; // $id
        
        
        $menu = $this->db->get('tbl_customer_menu')->result();
        
       
        
//        if (!empty($menu)) {
//            foreach ($menu as $v_menu) {
//                foreach ($v_menu as $value) {
                    $mdata['menu_id'] = 1;
                    $mdata['employee_login_id'] = $user_id;
                    $this->db->insert('tbl_user_role', $mdata); 
//                }
//            }
//        }

          
       
        if (!empty($user_id)) {
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
  	
  	    $data['user_id']=$user_id;
  	    
  	    $this->db->where('customer_id', $customer_id);
        $this->db->update('tbl_customer', $data); 
    }

}