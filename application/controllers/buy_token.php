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

class Buy_token extends CI_Controller
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

        $data['title'] = 'Buy Token';  // title page
        
        $data['subview'] = $this->load->view('buy_token', $data, true);
        $this->load->view('admin/_public_layout_main', $data);
    }



}