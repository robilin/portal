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
class giftcard extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('giftcard_model');
        $this->load->model('global_model');
        $this->load->library('pagination');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'giftcard/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '250px',
            ),
        );
    }

           
    /*** Add New or Edit giftcard ***/
    public function add_giftcard($id=null)
    {
      
      if ($id) {
            $this->tbl_giftcards('giftcard_id');
            $data['giftcard'] = $this->global_model->get_by(array('giftcard_id'=>$id), true);
            if(empty($data['giftcard'])){
                $this->message->norecord_found('admin/giftcard/manage_giftcard');
            }
        }
        
        
       
        $data['title'] = 'Add Giftcard';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/giftcard/add_giftcard', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }


    /*** Add New or Update Attribute Group ***/
    public function save_giftcard($id = null)
    {
        if ($id) { // if id
            $giftcard_id = $this->input->post('giftcard_id', true);
           
        } else {
            $giftcard_id = null;
         
            //$giftcard_expire_id=null;
        }

        //*************** giftcard Information **************

        $giftcard_info = $this->giftcard_model->array_from_post(array(
        	'gift_card_no',
            'value',
        	'expire_date',
             ));
             
         //set balance equal to giftcard value    
         $giftcard_info['balance']=$giftcard_info['value']; 

         //created by
         $giftcard_info['created_by'] = $this->session->userdata('name');

          //created date
         $timestamp=time('now');
         $giftcard_info['created_date'] =date('Y-m-d',$timestamp);
           
         $this->tbl_giftcards('giftcard_id');
         $this->global_model->save($giftcard_info, $id);
       
       
         $type = 'success';
         $message = 'giftcard Information Saved Successfully!';
         set_message($type, $message);
        
        redirect('admin/giftcard/manage_giftcard');
    }

 
    /*** Manage giftcard ***/
    public function manage_giftcard()
    {

        $data['giftcard'] = $this->giftcard_model->get_all_giftcard_info();

        //var_dump($data['giftcard']);
        
        $data['title'] = 'Manage Giftcard';
        $data['subview'] = $this->load->view('admin/giftcard/manage_giftcard', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    
    public function view_giftcard($id)
    {
        $data['giftcard'] = $this->giftcard_model->get_giftcard_information_by_id($id);
      
        $data['title'] = 'View giftcard';
        $data['giftcard_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/giftcard/_modal_view_giftcard', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }

     /*** giftcard action handel ***/
    public function giftcard_action()
    {
        					
    	$action = $this->input->post('action' , true);
        $giftcard_id = $this->input->post('giftcard_id' , true);

        if(!empty($giftcard_id)) {


            if ($action == 1) {
                //instock giftcard
                $this->instock_giftcard($giftcard_id);

            } elseif ($action == 2) {
                //mark in use giftcard
                $this->inuse_giftcard($giftcard_id);
            }  elseif ($action == 3) {
                //decommission giftcard
                $this->decommission_giftcard($giftcard_id);
            } elseif ($action == 4) {
                //mstolen_giftcard
                $this->mark_stolen_giftcard($giftcard_id);
            } elseif ($action == 5) {
                //mark damaged_giftcard
                $this->mark_damaged_giftcard($giftcard_id);
            }else {
                //delete giftcard
                $this->delete_giftcard($giftcard_id);
            }
        }else{
            $this->message->custom_error_msg('admin/giftcard/manage_giftcard', 'You did not select any giftcard');
        }
    }

   
    /*** Delete giftcard***/
    public function delete_giftcard($id){
        if(is_array($id))
        {
            foreach($id as $v_id)
            {
                $this->_delete($v_id);
            }
            $this->message->delete_success('admin/giftcard/manage_giftcard');

        }else
        {
            if (!empty($id)) {

                $this->tbl_giftcards('giftcard_id');
                $giftcard = $this->global_model->get_by(array('giftcard_id'=>$id),true);
                if(!empty($giftcard)){
                    $this->_delete($id);
                    $this->message->delete_success('admin/giftcard/manage_giftcard');
                }
                redirect('admin/giftcard/manage_giftcard');

            } else {
                redirect('admin/giftcard/manage_giftcard');
            }
        }
    }

    /*** Delete Function ***/
    public function _delete($id){

        //delete from tbl_giftcard
        $this->tbl_giftcards('giftcard_id');
        $this->global_model->delete($id);


    }

    //check gift cards
    public function check_giftcard_code(){
        $giftcard_code = $this->input->post('giftcard_code');
        $giftcard_id = $this->input->post('giftcard_id');
        if(!empty($giftcard_code)) {
            $result = $this->giftcard_model->check_giftcard_code($giftcard_code, $giftcard_id);
            if ($result) {
                echo 'This giftcard Code is Exist!';
            }
        }

    }
    
  /*** Check Duplicate giftcard  ***/
    public function check_giftcard_no($gift_card_no=null, $giftcard_id = null)
    {
        $this->tbl_giftcards('giftcard_id');
        if(empty($giftcard_id))
        {
            $result = $this->global_model->get_by(array('gift_card_no'=>$gift_card_no), true);
        }else{
            
            $result = $this->global_model->get_by(array('gift_card_no'=>$gift_card_no, 'giftcard_id !=' => $giftcard_id ), true);
        }

        if($result)
        {
            echo 'This card number has been already used!';
        }

    }



   


}