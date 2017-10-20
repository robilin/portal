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

public function sandbox()
    {	
    	$data['title'] = 'steps';	
        $data['subview'] = $this->load->view('admin/apis/sandbox', $data, true);
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
    
        $data['title'] = 'Activate Voucher';
		
        $data['subview'] = $this->load->view('admin/apis/activate_voucher', $data, true);
        $this->load->view('admin/_layout_main', $data);
}

public function process_sms()
    {

    $message= $this->input->post('message', true);
    $phone = $this->input->post('phone', true);	
//    
//    var_dump($phone);
//    exit;
    
    $user = "robilin";
    $password = "kiganamo303";
    $api_id = "3503230";
    $baseurl ="http://api.clickatell.com";
    
    for ($i = 0; $i < sizeof($phone); $i++) {
            if ($phone[$i] != null) {
    
    $text = urlencode($message);
    
    $to ='+255'.substr($phone[$i],-9);
       
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
    
   }
  }

 redirect('admin/apis/send_sms');   
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
}
 
