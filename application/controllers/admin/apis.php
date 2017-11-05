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

class Apis extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
    }

 public function send_sms($phone=null)
    {
         if($phone){
           $data['phone']=$phone;
         }
    
        $data['title'] = 'Send SMS';
		
        $data['subview'] = $this->load->view('admin/apis/send_sms', $data, true);
        $this->load->view('admin/_layout_main', $data);
} 


 public function purchase_token($meter=null)
    {
         if($meter){
           $data['meter_number']=$meter;
         }
    
        $data['title'] = 'Buy Token';
		
        $data['subview'] = $this->load->view('admin/apis/purchase_token', $data, true);
        $this->load->view('admin/_layout_main', $data);
} 

 public function activate_voucher($voucher_no=null)
    {
         if($voucher_no){
           $data['voucher_number']=$voucher_no;
         }
    
        $data['title'] = 'Activate Payless Voucher';
		
        $data['subview'] = $this->load->view('admin/apis/activate_voucher', $data, true);
        $this->load->view('admin/_layout_main', $data);
}

 public function save_activation_voucher()
    {
            $meter_number= $this->input->post('meter_number', true);
    		$voucher_number = $this->input->post('voucher_number', true);

    		
    		//toDo call activation APIs here
    
		    $type = 'success';
            $message="voucher #: ". $voucher_number.' '.'Activated Succesful, Meter #'.$meter_number;
            set_message($type, $message);
            
           redirect('admin/apis/activate_voucher');
}

public function process_sms()
    {

        $message= $this->input->post('message', true);
        $phone = $this->input->post('phone', true);
        
        //load send sms library
        $this->load->library('public_sms');
        
        $from='INFO';
        $flag=1;
        $send_sms=$this->public_sms->send_autoreply($phone[0], $message,$flag,$from);
}

public function customer_sms($phone=null,$message=null)
    {
    
    $user = "robilin";
    $password = "kiganamo303";
    $api_id = "3503230";
    $baseurl ="http://api.clickatell.com";
    
    $text = urlencode($message);
    
    $to ='+255'.substr($phone,-9);
       
    // auth call
    $url = "$baseurl/http/auth?user=$user&password=$password&api_id=$api_id";  

    // do auth call
    $ret = file($url);
    
       // explode our response. return string is on first line of the data returned
    $sess = explode(":",$ret[0]);
    if ($sess[0] == "OK") {
 
        $sess_id = trim($sess[1]); // remove any whitespace
        $url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$text";
 
        
        // do sendmsg call
        $ret = file($url);
        $send = explode(":",$ret[0]);
 
        if ($send[0] == "ID") {
        	$type = 'success';
            $message="successnmessage ID: ". $send[1];
            set_message($type, $message);
        } else {
        	$type = 'error';
            $message= "send message failed";
            set_message($type, $message);
        }
    } else {
    	$type = 'error';
        $message= "Authentication failure: ". $ret[0];
        set_message($type, $message);
    }
    
 redirect('admin/apis/send_sms');   

  }
  
public function token_sms($transaction_id=null)
    {
    
    $sms_details=$this->db->get_where('tbl_mobile_payments',array('transID'=>$transaction_id))->result();

    foreach ($sms_details as $v_details) {
    	$phone=$v_details->msisdn;
    	$token=$v_details->token;
    }
    
    $sms_details= $this->db->get_where('tbl_mobile_payments', array('transID' =>$transaction_id))->row();
    
    $token=$sms_details->token;
    $phone=$sms_details->msisdn;
    
    //load send sms library
    $this->load->library('public_sms');
    
    $from='INFO';
    $flag=2; //this will force to return semaphore here
    
    
    if(strlen($phone)>=9 AND strlen($token)>0 ){
        $send_sms=$this->public_sms->send_autoreply($phone, $token,$flag,$from);
    }
    
 redirect('admin/payments/manage_payments');   

  }
  
  public function inbox($id=null)
  {
      if($id){
          $data['id']=$id;
      }
      
      $data['title'] = 'Inbox';
      
      $data['subview'] = $this->load->view('admin/apis/inbox', $data, true);
      $this->load->view('admin/_layout_main', $data);
  }
  
  public function voting_history($id=null)
  {
      if($id){
          $data['id']=$id;
      }
      
      $data['title'] = 'Inbox';
      
      $data['subview'] = $this->load->view('admin/apis/voting_history', $data, true);
      $this->load->view('admin/_layout_main', $data);
  }
  
  /*** Delete Expense ***/
  public function delete_msg($id=null)
  {
      if(!empty($id)){
          $this->tbl_smpp_hits('id');
          $this->global_model->delete($id);
          $this->message->delete_success('admin/apis/inbox');
      }else{
          $this->message->custom_error_msg('admin/apis/inbox', 'Sorry there is no record found');
      }
  }
  
  public function delete_msg_sent($id=null)
  {
      if(!empty($id)){
          $this->tbl_smpp_hits('id');
          $this->global_model->delete($id);
          $this->message->delete_success('admin/apis/sent_items');
      }else{
          $this->message->custom_error_msg('admin/apis/sent_items', 'Sorry there is no record found');
      }
  }
  
  public function sent_items($id=null)
  {
      if($id){
          $data['id']=$id;
      }
      
      
      
      $data['title'] = 'Sent items';
      
      $data['subview'] = $this->load->view('admin/apis/sent_items', $data, true);
      $this->load->view('admin/_layout_main', $data);
  }
  
  
  public function view_customer_profile_sent_items($id=null)
  {
      $data['title']='Sent Messages';
      $data['type']=2; //messages sent
      $data['msisdn']=$id;
      $data['subview'] = $this->load->view('admin/apis/view_customer_profile', $data, true);
      $this->load->view('admin/_layout_main', $data);
  }
  
  public function view_customer_profile_received_items($id=null)
  {
      $data['title']='Received messages';
      $data['type']=1; //message received
      $data['msisdn']=$id;
      $data['subview'] = $this->load->view('admin/apis/view_customer_profile', $data, true);
      $this->load->view('admin/_layout_main', $data);
  }
  

  
  public function alert()
  {
      $message= $this->input->post('message', true);
      $phone = $this->input->post('phone', true);
      
      //load send sms library
      $this->load->library('public_sms');
      
      $from='INFO';
      $flag=1;
      $send_sms=$this->public_sms->send_autoreply($phone[0], $message,$flag,$from);   
  }
  
  
}
 

