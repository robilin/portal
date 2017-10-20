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

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
     }

    public function index()
    {


        $data['title'] = 'Welcome to PayLess';
        $data['subview'] = $this->load->view('home', $data, true);
        $this->load->view('home', $data);

        //$this->session->sess_destroy();
        $home = $this->session->userdata('url');

        $this->login_model->loggedin() == false || redirect($home);

    }

}
