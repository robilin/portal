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

class Public_sms extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('global_model');
    }
 
    public function send_autoreply($phone=null, $message=null,$flag=null,$from=null)
    {
        $localization   = $this->db->get_where('tbl_localization', array('localization_id' => 1))->row();
          
        $from=$localization->sender_id;
       
        $to=trim(substr($phone,-12));
        $auth = base64_encode('tembotell1:tembo123');

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.infobip.com/sms/1/text/single",
            CURLOPT_SSL_VERIFYHOST=>0,
            CURLOPT_SSL_VERIFYPEER=>0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{ 
            \"from\":\"{$from}\", \"to\":\"{$to}\", \"text\":\"{$message}\" }",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Basic {$auth}",
                "content-type: application/json"
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $error= "error ".$err;
            $status="Message failed";
        } else {
            $error="success ".$response;
            $status="Message sent succesful";
        }
        
        $type='error';
        set_message($type, $status);
        
        //update sent items
        
        $data['msg_receiver']=$to;
        $data['message']=$message;
        $data['response_data']=$error;
  
        $this->global_model->_table_name = 'tbl_sms_sent'; // table name
        $this->global_model->_primary_key = 'id'; // $id
        $this->global_model->save($data);
        
        if($flag==1){
        redirect('admin/apis/send_sms/');
        }elseif($flag==2){
            return;
        }
        
    }
}
