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
class Loan extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('loan_model');
        $this->load->model('global_model');
        $this->load->library('pagination');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'loan/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '250px'
            )
        );
    }
    
    
    /*** Add New or Edit loan ***/
    public function add_loan($id = null)
    {
        
        if ($id) {
            $this->tbl_customer('customer_id');
            $data['customer_info'] = $this->global_model->get_by(array(
                'customer_id' => $id
            ), true);
        }
        
        //$data['loan_number'] = rand(10000000, 99999);
        
        $this->db->select_max('loan_id');
        $lastId              = $this->db->get('tbl_loan')->row()->loan_id;
        $data['loan_number'] = $customerNo = 10000000 + $lastId + 1;
        
        //view page
        $data['title'] = 'Add Loan';
        
        $data['editor']  = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/add_loan', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function edit_loan($id = null)
    {
        
        if ($id) {
            $this->tbl_loan('loan_id');
            $data['loan_info'] = $this->global_model->get_by(array(
                'loan_id' => $id
            ), true);
        }
        
        $customer = $this->db->get_where('tbl_loan',array('loan_id'=>$id))->result(); 
        
           foreach ($customer as $v_customer){
                $customer_id=$v_customer->customer_id;	
             }
                     
         //Get customer info
         $this->tbl_customer('customer_id');
            $data['customer_info'] = $this->global_model->get_by(array(
                'customer_id' => $customer_id
            ), true);
        
        $data['title'] = 'Edit Loan';
        $data['editor']  = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/add_loan', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
    /*** Add New or Update Loan ***/
    public function save_loan($id = null)
    {
        
        if ($id) { // if id
            $loan_id = $id;
            
        } else {
            $loan_id = null;
        }
        
        $customer_id = $this->input->post('customer_id', true);
        
        //*************** loan Information **************
        $loan_details_info = array(
            'loan_number' => $this->input->post('loan_number'),
            'loan_product'=> $this->input->post('loan_product'),
            'loan_disbursed_by'=> $this->input->post('loan_disbursed_by'),
            'principal_amount'=> $this->input->post('principal_amount'),
            'loan_release_date'=> $this->input->post('loan_release_date'),
            'loan_interest_method'=> $this->input->post('loan_interest_method'),
            'loan_interest_percent'=> $this->input->post('loan_interest_percent'),
            'loan_interest_period_scheme'=> $this->input->post('loan_interest_period_scheme'),
            'compound_interval'=> $this->input->post('compound_interval'),
            'loan_duration'=> $this->input->post('loan_duration'),
            'loan_duration_scheme'=> $this->input->post('loan_duration_scheme'),
            'loan_repayment_cycle'=> $this->input->post('loan_repayment_cycle'),
            'loan_file_name'=> $this->input->post('loan_file_name'),
            'loan_file_path'=> $this->input->post('loan_file_path'),
            'loan_image_name'=> $this->input->post('loan_image_name'),
            'loan_image_path'=> $this->input->post('loan_image_path'),
            'loan_status'=> $this->input->post('loan_status'),
        );
        
        $loan_details_info['loan_id']     = $loan_id;
        $loan_details_info['customer_id'] = $customer_id;
        
        $loan_details_info['loan_num_of_repayments']=$this->setNumofRep($loan_details_info['loan_duration'],$loan_details_info['loan_duration_scheme'],$loan_details_info['loan_repayment_cycle']);
 
        $this->tbl_loan_details('loan_details_id');
        if (!empty($loan_id)){
        $loan_details_id = $this->global_model->save($loan_details_info,$loan_id);
        }else{
        $loan_details_id = $this->global_model->save($loan_details_info);
        }
        
        //****************** loan  Image Upload ***********************//
        
        // save image Process
        if (!empty($_FILES['loan_image_name']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->loan_model->uploadImage('loan_image_name');
            $val == true || redirect('admin/loan/add_loan');
            
            $image_data['loan_image_name'] = $val['path'];
            $image_data['loan_image_path'] = $val['fullPath'];
            
            $image_data['loan_id'] = $loan_details_id;
            if (!empty($loan_details_id)) {
                $this->global_model->save($image_data, $loan_details_id); // save and update function
            } else {
                $this->global_model->save($image_data);
            }
        }
        
        
        // File Process
        if (!empty($_FILES['loan_file_name']['name'])) {
            $old_path = $this->input->post('file_old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->loan_model->uploadFile('loan_file_name');
            $val == true || redirect('admin/loan/add_loan');
            
            $file_data['loan_file_name'] = $val['path'];
            $file_data['loan_file_path'] = $val['fullPath'];
            
            $file_data['loan_details_id'] = $loan_details_id;
            if (!empty($loan_details_id)) {
                $this->global_model->save($file_data, $loan_details_id); // save and update function
            } else {
                $this->global_model->save($file_data);
            }
        }
        
        
        $date = date_create($loan_details_info['loan_release_date']);
        
        if ($loan_details_info['loan_duration_scheme'] == 'days') {
            $days = $loan_details_info['loan_duration'];
        } elseif ($loan_details_info['loan_duration_scheme'] == 'weeks') {
            $days = $loan_details_info['loan_duration'] * 7;
        } elseif ($loan_details_info['loan_duration_scheme'] == 'months') {
            $days = $loan_details_info['loan_duration'] * 30;
        } elseif ($loan_details_info['loan_duration_scheme'] == 'years') {
            $days = $loan_details_info['loan_duration'] * 365;
        }
        
        //add days to date
        $loan_maturity_date=date_add($date, date_interval_create_from_date_string("{$days} days"));
        
        $maturity_date = date_format($loan_maturity_date, "Y-m-d");
        
        $amount_due=$this->calculate_interest($loan_details_info['principal_amount'], $loan_details_info['loan_duration'], $loan_details_info['loan_interest_percent'], $loan_details_info['compound_interval'], $loan_details_info['loan_interest_method'],$loan_details_info['loan_interest_period_scheme'],$loan_details_info['loan_duration_scheme']);
        
        $loan_interest=$amount_due-$loan_details_info['principal_amount'];
        
        $loan_data['customer_id']                 = $loan_details_info['customer_id'];
        $loan_data['loan_number']                 = $loan_details_info['loan_number'];
        $loan_data['loan_release_date']           = $loan_details_info['loan_release_date'];
        $loan_data['maturity_date']               = $maturity_date;
        $loan_data['loan_repayment_cycle']        = $loan_details_info['loan_repayment_cycle'];
        $loan_data['principal_amount']            = $loan_details_info['principal_amount'];
        $loan_data['loan_interest_period_scheme'] = $loan_details_info['loan_interest_period_scheme'];
        $loan_data['loan_interest_percent']       = $loan_details_info['loan_interest_percent'];
        $loan_data['loan_fees']                   = 0;
        $loan_data['loan_penalty']                = 0;
        $loan_data['amount_due']                  = $amount_due;
        $loan_data['loan_interest']               = $loan_interest;
        $loan_data['balance_amount']              = $loan_data['amount_due'];
        $loan_data['loan_status']                 = $loan_details_info['loan_status'];
        $loan_data['loan_details_id']             = $loan_details_id;
        
        //save loan data
        $this->tbl_loan('loan_id');
        if(!empty($loan_id)){
        $loan_id = $this->global_model->save($loan_data,$loan_id);
        }else{
        $loan_id = $this->global_model->save($loan_data);
        }
        //update loan details with loan id
        $update_loan_id['loan_id']=$loan_id;
        $this->tbl_loan_details('loan_details_id');
        $this->global_model->save($update_loan_id,$loan_details_id);
        
        
        
        
        
        $type    = 'success';
        $message = 'Loan Information Saved Successfully!';
        set_message($type, $message);
        
        redirect('admin/customer/manage_borrowers');
    }
    
    
    /*** Manage loan ***/
    public function calculate_interest($principle_amount, $loan_period, $loan_interest_rate, $compound_interval, $interest_method,$loan_interest_period_scheme, $loan_duration_scheme)
    {
        
        
        $loan_period=$this->loan_duration($loan_interest_period_scheme, $loan_duration_scheme, $loan_period);
        
        /******Simple or flat Interest = Principal × Rate  ×  Time */
        //The popular formula for calculating annual compound interest is V = P(1+r/n)(nt)
        //V = the future value of the investment
        //P = the principal investment amount
        //r = the annual interest rate
        //n = the number of times that interest is compounded per year
        //t = the number of years the money is invested for

        
        if ($interest_method == 'compound_interest') {
            
            if ($compound_interval == 'daily') {
                
                $loan_interest_frequency = 365;
                
            } elseif ($compound_interval == 'weekly') {
                
                $loan_interest_frequency = 52;
                
            } elseif ($compound_interval == 'monthly') {
                
                $loan_interest_frequency = 12;
                
            } elseif ($compound_interval == 'quarterly') {
                
                $loan_interest_frequency = 4;
                
            } elseif ($compound_interval == 'half_yearly') {
                
                $loan_interest_frequency = 2;
                
            } elseif ($compound_interval == 'yearly') {
                $loan_interest_frequency = 1;
            }
            
            
            $exp      = $loan_interest_frequency * $loan_period;
            $base     = (1 + ($loan_interest_rate / (100 * $loan_interest_frequency)));
            $loan_due = $principle_amount * pow($base, $exp);
            
            return $loan_due;
        } elseif ($interest_method == 'flat_rate') {
            
            $loan_due = $principle_amount * (1 + (($loan_interest_rate / 100) * $loan_period));
            return $loan_due;
        }
        
    }
    
    function sandbox()
    {
        
        $result = $this->setNumofRep($loan_duration=2,$loan_duration_scheme='Years',$loan_repayment_cycle='Semi-Annual');
        echo $result;
        
    }
    
 function sandboxi()
    {
        
        $result = $this->loan_duration($loan_interest_period_scheme='Year', $loan_duration_scheme='days', $loan_duration='365');
        echo $result;
        
    }
    
    //convert period interval
    function loan_duration($loan_interest_period_scheme, $loan_duration_scheme, $loan_duration)
    {
         
        
        switch ($loan_interest_period_scheme) {
            case "Day": //Convert loan_duration to days based on $loan scheme duration choosen
                
                if ($loan_duration_scheme == 'days') {
                    $loan_duration *= 1;
                } elseif ($loan_duration_scheme == 'weeks') {
                    $loan_duration *= 7;
                } elseif ($loan_duration_scheme == 'months') {
                    $loan_duration *= 31;
                } elseif ($loan_duration_scheme == 'years') {
                    $loan_duration *= 365;
                }
                break;
            case "Week": //convert everything to weeks
                
                if ($loan_duration_scheme == 'days') {
                    $loan_duration*=0.142857;
                } elseif ($loan_duration_scheme == 'weeks') {
                    $loan_duration *= 1;
                } elseif ($loan_duration_scheme == 'months') {
                    $loan_duration *= 4.34524;
                } elseif ($loan_duration_scheme == 'years') {
                    $loan_duration *= 52;
                }
                break;
            case "Month": //convert everything to moths
                
                if ($loan_duration_scheme == 'days') {
                    $loan_duration *=0.032876643423;
                } elseif ($loan_duration_scheme == 'weeks') {
                    $loan_duration *=0.230137;
                } elseif ($loan_duration_scheme == 'months') {
                    $loan_duration *= 1;
                } elseif ($loan_duration_scheme == 'years') {
                    $loan_duration *=12;
                }
                break;
            case "Year": //convert everything to years
                
                if ($loan_duration_scheme == 'days') {
                    $loan_duration *= 0.00273973;
                } elseif ($loan_duration_scheme == 'weeks') {
                    $loan_duration *= 0.0191781;
                } elseif ($loan_duration_scheme == 'months') {
                    $loan_duration *= 0.08333350203845238;
                } elseif ($loan_duration_scheme == 'years') {
                    $loan_duration *= 1;
                }
                break;
            default:
                $loan_duration *= 1;
        }
        
       return $loan_duration;       
    }
    
    
    
    /*** Manage loan ***/
    public function manage_loan()
    {
        
        $data['loan'] = $this->loan_model->get_all_loan_info();
        
        //        var_dump($data['loan']);
        //        exit;
        $data['title']   = 'Manage loan';
        $data['subview'] = $this->load->view('admin/loan/manage_loan', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    

    
   public function view_loan($id)
    {
      $tab = $this->uri->segment(2);
        if(!empty($tab)){
            if($tab == 'repayments')
            {
                $data['tab'] = $tab;
            }else{
                $data['tab'] = $tab;
            }
        }
    	
    	
  if ($id) {
            $this->tbl_loan('loan_id');
            $data['loan_info'] = $this->global_model->get_by(array(
                'loan_id' => $id
            ), true);
        }
        
        $customer = $this->db->get_where('tbl_loan',array('loan_id'=>$id))->result(); 
        
           foreach ($customer as $v_customer){
                $customer_id=$v_customer->customer_id;	
             }
                     
         //Get customer info
         $this->tbl_customer('customer_id');
            $data['customer_info'] = $this->global_model->get_by(array(
                'customer_id' => $customer_id
            ), true);
        
        $data['title'] = 'View Loan';
        $data['editor']  = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/view_loan', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
  function add_repayment($id = null){
        
  	$this->tbl_loan('loan_id');
        if ($id) {
            $data['loan_info'] = $this->global_model->get_by(array('loan_id'=>$id), true);
            if(empty($data['loan_info'])){
                $type = 'error';
                $message = 'There is no Record Found!';
                set_message($type, $message);
                redirect('admin/loan/view_loan');
            }
        }

      
        $this->data=0;

        $data['modal_subview'] = $this->load->view('admin/loan/_modal_add_repayment', $data, FALSE);
        $this->load->view('admin/_layout_modal_small', $data);
    }
    
  
    
   public function save_repayment($id = null)
    {
        
        $data = $this->loan_model->array_from_post(array(
            'loan_number',
            'repayment_amount',
            'repayment_method',
            'collection_date',
        	'collected_by',
        	'comments',
        	'customer_id',
             ));
      
         $data['loan_loan_id']=$id;
    
         $this->tbl_loan_repayment('repayment_id');
         $repayment_id = $this->global_model->save($data);
        
        //update
         $this->tbl_loan('loan_id'); 
         $loan_info = $this->global_model->get_by(array('loan_id'=>$id), false);
         
         foreach ($loan_info as $v_loan_info) {
           $amount_due=$v_loan_info->amount_due;
           $balance_amount=$v_loan_info->balance_amount;
           $paid_amount=$v_loan_info->paid_amount;
         }
           
           
    
        //increment paid amount
         $update_data['paid_amount']=$paid_amount+$data['repayment_amount'];
            //reduce balance
         $update_data['balance_amount']=$balance_amount-$data['repayment_amount'];
           //update 
         $this->global_model->save($update_data,$id);
       
        
         $message = 'Customer information saved successfully!';
         set_message($type, $message);
         redirect('admin/loan/view_loan/'.$id);
    }
    
  public function view_all_loans()
    {
   
        $data['title']='View All Loans';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/view_all_loans', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
 function view_all_loan_repayments()
    {
    	
    	

        $data['title']='View All Loan repayments';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/view_all_loan_repayments', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
    
    /*** loan action handel ***/
    public function loan_action()
    {
        
        $action  = $this->input->post('action', true);
        $loan_id = $this->input->post('loan_id', true);
        
        if (!empty($loan_id)) {
            
            
            if ($action == 1) {
                //instock loan
                $this->instock_loan($loan_id);
                
            } elseif ($action == 2) {
                //mark in use loan
                $this->inuse_loan($loan_id);
            } elseif ($action == 3) {
                //decommission loan
                $this->decommission_loan($loan_id);
            } elseif ($action == 4) {
                //mstolen_loan
                $this->mark_stolen_loan($loan_id);
            } elseif ($action == 5) {
                //mark damaged_loan
                $this->mark_damaged_loan($loan_id);
            } else {
                //delete loan
                $this->delete_loan($loan_id);
            }
        } else {
            $this->message->custom_error_msg('admin/loan/manage_loan', 'You did not select any loan');
        }
    }
    
    
    
    /*** loan activate ***/
    public function active_loan($loan_id)
    {
        foreach ($loan_id as $v_loan_id) {
            $id             = $v_loan_id;
            $data['status'] = 1;
            $this->tbl_loan('loan_item');
            
            //update
            $this->global_model->save($data, $id);
        }
        $this->message->custom_success_msg('admin/loan/manage_loan', 'Your loan Active Successfully!');
    }
    
    
    
    
    
    public function loan_assign($id)
    {
        $data['loan'] = $this->loan_model->get_loan_information_by_id($id);
        
        $this->user_model->_table_name = 'tbl_user';
        $this->user_model->_order_by   = 'user_id';
        $data['all_employee_info']     = $this->user_model->get();
        
        $data['title']         = 'View loan';
        $data['loan_id']       = $id;
        $data['modal_subview'] = $this->load->view('admin/loan/_modal_assign_loan', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    
    /*** loan deactivate ***/
    public function save_loan_assign()
    {
        
        $id = $this->input->post('loan_id', true);
        
        $data['loan_assigned_date'] = $this->input->post('loan_assigned_date', true);
        $data['loan_assigned_to']   = $this->input->post('loan_assigned_to', true);
        $data['loan_assignee']      = $this->session->userdata('name');
        
        //mark status in use
        $data['status'] = 'In use';
        
        $this->tbl_loan('loan_item');
        
        //update
        $this->global_model->save($data, $id);
        
        $this->message->custom_success_msg('admin/loan/manage_loan', 'loan assigned succesfully!');
    }
    /*** loan deactivate ***/
    public function deactive_loan($loan_id)
    {
        foreach ($loan_id as $v_loan_id) {
            $id             = $v_loan_id;
            $data['status'] = 0;
            $this->tbl_loan('loan_item');
            
            //update
            $this->global_model->save($data, $id);
        }
        $this->message->custom_success_msg('admin/loan/manage_loan', 'Your loan Deactivated Successfully!');
    }
    
    /*** Delete loan***/
    public function delete_loan($id)
    {
        if (is_array($id)) {
            foreach ($id as $v_id) {
                $this->_delete($v_id);
            }
            $this->message->delete_success('admin/loan/manage_loan');
            
        } else {
            if (!empty($id)) {
                
                $this->tbl_loan('loan_id');
                $loan = $this->global_model->get_by(array(
                    'loan_id' => $id
                ), true);
                if (!empty($loan)) {
                    $this->_delete($id);
                    $this->message->delete_success('admin/loan/manage_loan');
                }
                redirect('admin/loan/manage_loan');
                
            } else {
                redirect('admin/loan/manage_loan');
            }
        }
    }
    
    /*** Delete Function ***/
    public function _delete($id)
    {
        
        //delete from tbl_loan
        $this->tbl_loan('loan_id');
        $this->global_model->delete($id);
        
        
    }
    
 /*** Delete repayment ***/
    public function delete_repayment($id=null){
    	
    	$repayment_info = $this->db->get_where('tbl_loan_repayment',array('repayment_id'=>$id))->result();
    	foreach ($repayment_info as $value) {
    		$loan_id=$value->loan_loan_id;
    		$repayment_amount=$value->repayment_amount;
    		$repayment_amount=$value->repayment_amount;
    	}
    	
               
        //update
         $this->tbl_loan('loan_id'); 
         $loan_info = $this->global_model->get_by(array('loan_id'=>$loan_id), false);
         
         foreach ($loan_info as $v_loan_info) {
           $amount_due=$v_loan_info->amount_due;
           $balance_amount=$v_loan_info->balance_amount;
           $paid_amount=$v_loan_info->paid_amount;
         }
                      
        //reduce paid amount
        $update_data['paid_amount']=$paid_amount-$repayment_amount;
            //increase balance
        $update_data['balance_amount']=$balance_amount+$repayment_amount;
           //update 
        $this->global_model->save($update_data,$loan_id);
        
        $this->tbl_loan_repayment('repayment_id');
        $this->global_model->delete($id);
        
        $this->message->delete_success('admin/loan/view_loan/'.$loan_id);
    }
    
    function add_comments($id=null){
 
    	
    	if(!empty($id)){
    		    		
    		$data['loan_id']=$id;
    	}
    	
    	$data['title']= 'Add Comment';
        $data['modal_subview'] = $this->load->view('admin/loan/_modal_add_comment', $data, FALSE);
        $this->load->view('admin/_layout_modal_small', $data);
    
    }
    
    function edit_comments($id=null){
 
    	
    	if(!empty($id)){
    		    		
    		$data['comment_id']=$id;
    		$this->tbl_loan_comments('comment_id');
    		$data['loan_comments']=$this->global_model->get_by(array('comment_id'=>$id), true);
    	}
    	
    	$data['title']= 'Edit Comment';
        $data['modal_subview'] = $this->load->view('admin/loan/_modal_add_comment', $data, FALSE);
        $this->load->view('admin/_layout_modal_small', $data);
    
    }
    
    function save_comments($id=null){

    	
    	$loan_comments=$this->loan_model->array_from_post(array('loan_id','comment','date_posted'));
    	$loan_comments['posted_by'] = $this->session->userdata('name');
    	
    	$this->tbl_loan_comments('comment_id'); //table name
    	if(!empty($id)){  
    		//get
    	$comment_info = $this->db->get_where('tbl_loan_comments',array('comment_id'=>$id))->result();
    	foreach ($comment_info as $value) {
    		$loanid=$value->loan_id;
    	    
    	}	
		    $loan_comments['loan_id']=$loanid;
		    $this->global_model->save($loan_comments,$id);
		    
		  $message = 'Comment updated successful!';
          set_message($type, $message);
          redirect('admin/loan/view_loan/'.$loanid);
    	}else {
    	   $this->global_model->save($loan_comments);
    	   
    	   $message = 'Comment successful!';
           set_message($type, $message);
           redirect('admin/loan/view_loan/'.$loan_comments['loan_id']);
    	  
    	}
   	
    }
    
/*** Delete repayment ***/
    public function delete_comment($id=null){
    	
    	$comment_info = $this->db->get_where('tbl_loan_comments',array('comment_id'=>$id))->result();
    	foreach ($comment_info as $value) {
    		$loan_id=$value->loan_id;
    	
    	}
    	
    	$this->tbl_loan_comments('comment_id');
        $this->global_model->delete($id);
        
        $this->message->delete_success('admin/loan/view_loan/'.$loan_id);
    }
    
    /*** Add New or Edit collateral ***/
    public function add_collateral($id=null)
    {
     
    	        
        if ($id) {
            $this->tbl_customer('customer_id');
            $data['customer_info'] = $this->global_model->get_by(array(
                'customer_id' => $id
            ), true);
        }
 
        $data['code'] = rand(10000000, 99999);

        
       // $data['category'] = $this->loan_model->get_all_category();
        // view page
       // $data['vendor'] = $this->loan_model->get_all_vendors();
        
        //get brands
       // $data['brand'] = $this->loan_model->get_all_brands();
        
        //view page
        $data['title'] = 'Add collateral';

        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/add_collateral', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    /*** Add New or Update  ***/
    public function save_collateral($id = null)
    {
        if ($id) { // if id
            $collateral_id = $this->input->post('collateral_id', true);
           
        } else {
            $collateral_id = null;
         
            //$collateral_expire_id=null;
        }

        //*************** collateral Information **************

        $collateral_info = $this->loan_model->array_from_post(array(
            'collateral_name',
        	'collateral_serial_number',
            'collateral_note',
            'status',
            'collateral_category_id',
            'collateral_brand',
            'loan_model',
        	'vendor',
            'collateral_location',
            'collateral_acquired_date',
       	    'collateral_warranty_starts',
            'collateral_warranty_ends',
            'collateral_file_name',
            'collateral_file_path',
            'collateral_image_name',
        	'collateral_image_path',
            'collateral_purchase_price',
             ));
            
         $collateral_info['status']='In stock';
         $collateral_info['collateral_assignee']='Not assigned';    

        $this->tbl_collateral('collateral_id');
        $collateral_id = $this->global_model->save($collateral_info, $id);

        if(empty($id)) {
            $this->set_barcode($collateral_info['collateral_serial_number'],$collateral_id);
        }else{
            $this->update_barcode($collateral_info['collateral_serial_number'],$id);
        }
        //****************** collateral  Image Upload ***********************//

        // save image Process
        if (!empty($_FILES['collateral_image_name']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->loan_model->uploadImage('collateral_image_name');
            $val == true || redirect('admin/loan/add_collateral');

            $image_data['collateral_image_name'] = $val['path'];
            $image_data['collateral_image_path'] = $val['fullPath'];
            
            $image_data['collateral_id'] = $collateral_id;
            if (!empty($collateral_id)) {
                $this->global_model->save($image_data, $collateral_id); // save and update function
            } else {
                $this->global_model->save($image_data);
            }
        }
        
        
         // File Process
        if (!empty($_FILES['collateral_file_name']['name'])) {
            $old_path = $this->input->post('file_old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->loan_model->uploadFile('collateral_file_name');
            $val == true || redirect('admin/loan/add_collateral');

            $file_data['collateral_file_name'] = $val['path'];
            $file_data['collateral_file_path'] = $val['fullPath'];
            
            $file_data['collateral_id'] = $collateral_id;
            if (!empty($collateral_id)) {
                $this->global_model->save($file_data, $collateral_id); // save and update function
            } else {
                $this->global_model->save($file_data);
            }
        }
       
        $type = 'success';
        $message = 'collateral Information Saved Successfully!';
        set_message($type, $message);
        //var_dump($image_data['collateral_image_path']);
        //var_dump($image_data['collateral_image_name']);
        redirect('admin/loan/manage_collateral');
    }
    
 /*** Manage collateral ***/
    public function manage_collateral()
    {

        $data['collateral'] = $this->loan_model->get_all_collateral_info();

        $data['title'] = 'Manage Collateral';
        $data['subview'] = $this->load->view('admin/loan/manage_collateral', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
 public function view_collateral($id)
    {
        $data['collateral'] = $this->loan_model->get_collateral_information_by_id($id);
      
        $data['title'] = 'View collateral';
        $data['collateral_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/loan/_modal_view_collateral', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
public function setNumofRep($loan_duration,$loan_duration_scheme,$loan_repayment_cycle) 
{

     
     if ($loan_duration_scheme != "")
     {
	     $totalRepayments = 0;
	     $yearly = 0;
	     $monthly = 0;
	     $weekly = 0;
	     $daily = 0;
	    
	     if ($loan_repayment_cycle == "Daily") 
	     {
	         $yearly = 360;
	         $monthly = 30;
	         $weekly = 7;
	         $daily = 1;
	     }  
	     if ($loan_repayment_cycle == "Weekly") 
	     {
	         $yearly = 52;
	         $monthly = 4;
	         $weekly = 1;
	     }  
	     if ($loan_repayment_cycle == "Biweekly") 
	     {
	         $yearly = 26;
	         $monthly = 2;
	         $biweekly = 1;
	     }  
	     if ($loan_repayment_cycle == "Monthly") 
	     {
	         $yearly = 12;
	         $monthly = 1;
	     }
	     if ($loan_repayment_cycle == "Bimonthly") 
	     {
	         $yearly = 6;
	         $monthly = 1/2;
	     }
	     if ($loan_repayment_cycle == "Quarterly") 
	     {
	         $yearly = 4;
	         $monthly = 1/3;
	     }
	     if ($loan_repayment_cycle == "Semi-Annual") 
	     {
	         $yearly = 2;
	         $monthly = 1/6;
	     }    
	     if ($loan_repayment_cycle == "Yearly") 
	     {
	         $yearly = 1;
	     } 
	     
	     if ($loan_duration_scheme == "days") 
	     {
	        $totalRepayments = $loan_duration *$daily;
	     }
	     if ($loan_duration_scheme == "weeks") 
	     {
	        $totalRepayments = $loan_duration *$weekly;
	     }
	     if ($loan_duration_scheme == "months") 
	     {
	        $totalRepayments = $loan_duration * $monthly;
	     }
	     if ($loan_duration_scheme == "years") 
	     {
	        $totalRepayments = $loan_duration * $yearly;
	     }
	     
	     if ($loan_repayment_cycle == "Lump-Sum"){ 
	     	$totalRepayments = 1;
	     }
	     	
	     if ($totalRepayments > 0){
	     
	     	return $totalRepayments;
	     }else{
	      return 1;
	     }
	        
	}
}

public function  due_loans() {

 		$data['title']='View Due Loans';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/due_loans', $data, true);
        $this->load->view('admin/_layout_main', $data);

}

public function  missed_repayments() {

 		$data['title']='View Due Loans';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/missed_repayments', $data, true);
        $this->load->view('admin/_layout_main', $data);

}

public function  past_maturity_loans() {

 		$data['title']='Past Maturity Loans';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/past_maturity_loans', $data, true);
        $this->load->view('admin/_layout_main', $data);

}
    
         
}

