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


    public function send_sms($phone=null, $message = null)
    {
        if(!empty($user_name)) {
            $result = $this->global_model->check_user_name($user_name, $user_id);
            if ($result) {
                echo 'This User Name is Existing!';
            }
        }
        
       
    
    
        $data['title'] = 'Send Bulk SMS';
		$this->data=0;
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/apis/send_sms', $data, true);
        $this->load->view('admin/_layout_main', $data);
}
}