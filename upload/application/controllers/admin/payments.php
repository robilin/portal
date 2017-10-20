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
class Payments extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('payments_model');
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
    public function add_payments($id = null)
    {
        
        if ($id) {
            $this->tbl_meter('customer_id');
            $data['meter_info'] = $this->global_model->get_by(array(
                'meter_number' => $id
            ), true);
        }else {
        	 $data['new_meter']=true;
        }
        
        //$data['loan_number'] = rand(10000000, 99999);
        
        $this->db->select_max('id');
        $lastId              = $this->db->get('tbl_mobile_payments')->row()->id;
        $data['payment_number'] =10000000 + $lastId + 1;
        
        //view page
        $data['title'] = 'Add Payment';
        
        $data['editor']  = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/payments/add_payments', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function edit_payments($id = null)
    {
        
        if ($id) {
            $this->tbl_payments('loan_id');
            $data['loan_info'] = $this->global_model->get_by(array(
                'loan_id' => $id
            ), true);
        }
        
        $customer = $this->db->get_where('tbl_payments',array('loan_id'=>$id))->result(); 
        
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
        $data['subview'] = $this->load->view('admin/loan/add_payments', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
    /*** Add New or Update Loan ***/
    public function save_payments($id = null)
    {
     
        //*************** loan Information **************
        $payment_details_info = array(
            'referenceNo' => $this->input->post('meter_number'),
            'apiUsername'=> $this->input->post('payment_method'),
            'transID'=> $this->input->post('reference'),
            'amount'=> $this->input->post('amount'),

        );
        
        $payment_details_info['recdate']=date('Y-m-d');
        $payment_details_info['msisdn']=$this->input->post('mobile_number');
      
        //save loan data
        $this->tbl_mobile_payments('id');           
        $this->global_model->save($payment_details_info);
 
        
        //create sms
        $text_sms='Dear customer your payment has been registered';
            
            //send sms
        $this->sms_alert($loan_id,$text_sms);
        
                
        $type    = 'success';
        $message = 'Payment added!';
        set_message($type, $message);
        
        redirect('admin/payments/add_payments');
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
    public function manage_payments()
    {
     
        $data['title']   = 'Manage Payments';
        $data['subview'] = $this->load->view('admin/payments/manage_payments', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    

    
   public function view_payments($id)
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
            $this->tbl_payments('loan_id');
            $data['loan_info'] = $this->global_model->get_by(array(
                'loan_id' => $id
            ), true);
        }
        
        $customer = $this->db->get_where('tbl_payments',array('loan_id'=>$id))->result(); 
        
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
        $data['subview'] = $this->load->view('admin/loan/view_payments', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function view_pending_payments($id)
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
            $this->tbl_payments('loan_id');
            $data['loan_info'] = $this->global_model->get_by(array(
                'loan_id' => $id
            ), true);
        }
        
        $customer = $this->db->get_where('tbl_payments',array('loan_id'=>$id))->result(); 
        
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
        $data['subview'] = $this->load->view('admin/loan/view_pending_payments', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
  function add_payment($id = null){
        
  	$this->tbl_meter('meter_id');
        if ($id) {
            $data['meter'] = $this->global_model->get_by(array('meter_number'=>$id), true);
            if(empty($data['meter'])){
                $type = 'error';
                $message = 'There is no Record Found!';
                set_message($type, $message);
                redirect('admin/payments/manage_payments');
            }
        }

      
        $this->data=0;

        $data['modal_subview'] = $this->load->view('admin/payments/_modal_add_payment', $data, FALSE);
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
      
         $data['loan_id']=$id;
    
         $this->tbl_payments_repayment('repayment_id');
         $repayment_id = $this->global_model->save($data);
        
        //update
         $this->tbl_payments('loan_id'); 
         $loan_info = $this->global_model->get_by(array('loan_id'=>$id), false);
         
         foreach ($loan_info as $v_payments_info) {
           $amount_due=$v_payments_info->amount_due;
           $balance_amount=$v_payments_info->balance_amount;
           $paid_amount=$v_payments_info->paid_amount;
         }
           
           
    
        //increment paid amount
         $update_data['paid_amount']=$paid_amount+$data['repayment_amount'];
            //reduce balance
         $update_data['balance_amount']=$balance_amount-$data['repayment_amount'];
           //update 
         $this->global_model->save($update_data,$id);
       
         //update loan schdule
         $this->update_chedule($id,$data['customer_id'],$data['repayment_amount'],$data['collection_date']);
                
         $message = 'Customer Information Saved Successfully!';
         set_message($type, $message);
         redirect('admin/loan/view_payments/'.$id);
    }
    
  public function update_chedule($loan_id=null,$customer_id=null,$repayment_amount=null,$collection_date=null){
   
  	$schedule=$this->db->get_where('tbl_payments_schedule',array('loan_id'=>$loan_id))->result();
   
  	foreach ($schedule as $v_schedule) {
  		$repayment_date=$v_schedule->repayment_date;
  		$amount_due=$v_schedule->amount_due;
        $balance_amount=$v_schedule->principal_balance_owed;
        $paid_amount=$v_schedule->paid_amount;
  	}
  	
  	//
  	$data=array(
  	'paid_amount'=>$paid_amount+$repayment_amount,
  	'principal_balance_owed'=>$balance_amount-$repayment_amount,
  	);
  	
  	if(strtotime($collection_date)>=strtotime($repayment_date)){
  		
    $this->db->where('repayment_date<=', $collection_date);
    $this->db->where('customer_id', $customer_id);
    $this->db->update('tbl_payments_schedule', $data); 
    
  	}elseif(strtotime($collection_date)>=strtotime($repayment_date)){
  	$this->db->where('customer_id', $customer_id);
  	$this->db->where('repayment_date', $collection_date);
    $this->db->update('tbl_payments_schedule', $data);
    
  	}else{
  		
  	$this->db->where('customer_id', $customer_id);
  	$this->db->where('loan_id', $loan_id);
    $this->db->update('tbl_payments_schedule', $data);
    
  	}
   
  	
  	
  
  }
    
  public function view_all_paymentss()
    {
   
        $data['title']='View All Loans';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/view_all_paymentss', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
  public function loan_requests()
    {
   
        $data['title']='View Loan Requests';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/pending_requests', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
 /*** loan Reconfirmation  ***/
    public function loan_confirmation($id=null)
    {
        
    	if (!empty($id)) {
    		$loan_id=$id;
    		
    		//get customer phone number
    		
    		$data['approval']=1;
    		   //confirm loan
            $this->db->where('loan_id', $loan_id);
            $this->db->update('tbl_payments', $data);
            
            //create sms
            $text_sms='Ndugu mteja ombi lako la mkopo limekubaliwa / Dear customer your loan request has been approved';
            
            //send sms
            $this->sms_alert($loan_id,$text_sms);
                       
            $this->message->custom_success_msg('admin/loan/view_pending_payments/'.$id, 'Approved');

    	}
    	else
    	{
    		$loan_id=null;
    		redirect('admin/loan/loan_requests');
    	}

    }
    
    /*** loan Reconfirmation  ***/
    public function loan_cancellation($id=null)
    {
        	if (!empty($id)) {
    		$loan_id=$id;
    		
    		
    		
    		$data['approval']=2;
    		   //confirm loan
            $this->db->where('loan_id', $loan_id);
            $this->db->update('tbl_payments', $data);  
            $this->message->custom_success_msg('admin/loan/view_pending_payments/'.$id, 'Rejected');
            
    	}
    	else
    	{
    		$loan_id=null;
    		redirect('admin/loan/loan_requests');
    	}

    }
    
    
 function view_all_payments_repayments()
    {
    	
        $data['title']='View All Loan Repayments';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/view_all_payments_repayments', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
    
    /*** loan action handel ***/
 function loan_action()
    {
        
        $action  = $this->input->post('action', true);
        $loan_id = $this->input->post('loan_id', true);
        
        if (!empty($loan_id)) {
            
            
            if ($action == 1) {
                //instock loan
                $this->instock_payments($loan_id);
                
            } elseif ($action == 2) {
                //mark in use loan
                $this->inuse_payments($loan_id);
            } elseif ($action == 3) {
                //decommission loan
                $this->decommission_payments($loan_id);
            } elseif ($action == 4) {
                //mstolen_payments
                $this->mark_stolen_payments($loan_id);
            } elseif ($action == 5) {
                //mark damaged_payments
                $this->mark_damaged_payments($loan_id);
            } else {
                //delete loan
                $this->delete_payments($loan_id);
            }
        } else {
            $this->message->custom_error_msg('admin/loan/manage_payments', 'You did not select any loan');
        }
    }
    
    
    
    /*** loan activate ***/
    public function active_payments($loan_id)
    {
        foreach ($loan_id as $v_payments_id) {
            $id             = $v_payments_id;
            $data['status'] = 1;
            $this->tbl_payments('loan_item');
            
            //update
            $this->global_model->save($data, $id);
        }
        $this->message->custom_success_msg('admin/loan/manage_payments', 'Your loan Active Successfully!');
    }
    
   public function loan_schedule($loan_id=null){
   
       $loan_info = $this->db->get_where('tbl_payments',array('loan_id'=>$loan_id))->result();
       $loan_details = $this->db->get_where('tbl_payments_details',array('loan_id'=>$loan_id))->result();
      
       //check if schedule exists and delete it
       $check_payments_id= $this->loan_model->get_payments_schedule_information_by_id($loan_id);
       
         if(!empty($check_payments_id)){  
            $this->db->delete('tbl_payments_schedule', array('loan_id' => $loan_id));  
         }
  
       foreach ($loan_details as $v_details) {
       $repayments= $v_details->loan_num_of_repayments;
       }
       
   foreach ($loan_info as $v_payments) {
       $principal_amount=$v_payments->principal_amount;
       $customer_id=$v_payments->customer_id;
       }
       
      if(!empty($repayments)){
          $i=1;
          $release_date=date_create($v_payments->loan_release_date);
		  $maturity_date=date_create($v_payments->maturity_date);
		  $diff=date_diff($release_date,$maturity_date);
          $loan_total_days=$diff->format("%a");
          
          while($i<=$repayments ){
          	$repayment_date=$v_payments->loan_release_date;
          	//get time interval in days
            $date_interval=round(($loan_total_days)/$repayments);
                                                         
                                    //add $date_interval to date
            $loan_next_date=date_add($release_date, date_interval_create_from_date_string("{$date_interval} days"));
    								//next repayment date
        	$next_maturity_date = date_format($loan_next_date, "Y-m-d");
        	
        	$schedule['loan_id']=$v_payments->loan_id;
        	$schedule['customer_id']=$v_details->customer_id;
        	$schedule['loan_details_id']=$v_details->loan_details_id;
        	$schedule['repayment_date']=$next_maturity_date;
        	$schedule['repayment_number']=$i;
        	$schedule['principal_amount']=$principal_amount/$repayments;  
        	$schedule['loan_interest']=$v_payments->loan_interest/$repayments;
        	$schedule['loan_fees']=$v_payments->loan_fees/$repayments;
        	$schedule['loan_penalty']=$v_payments->loan_penalty/$repayments;
        	$schedule['description']='Repayment';
        	$schedule['amount_due']=$v_payments->amount_due/$repayments;
        	$schedule['total_due']=$v_payments->amount_due/($repayments*$i);
        	$schedule['paid_amount']=$v_payments->paid_amount;
        	$schedule['pending_due']=($v_payments->amount_due/$repayments)*$i-$v_payments->paid_amount;
        	$schedule['principal_balance_owed']=$v_payments->principal_amount-(($v_payments->principal_amount/$repayments)*$i);
        	
                   
         	$this->tbl_payments_schedule('schedule_id');
         	$schedule_id = $this->global_model->save($schedule);
            	
         $i++; 
          }
         }
      }
    
     
    public function loan_assign($id)
    {
        $data['loan'] = $this->loan_model->get_payments_information_by_id($id);
        
        $this->user_model->_table_name = 'tbl_user';
        $this->user_model->_payments_by   = 'user_id';
        $data['all_employee_info']     = $this->user_model->get();
        
        $data['title']         = 'View loan';
        $data['loan_id']       = $id;
        $data['modal_subview'] = $this->load->view('admin/loan/_modal_assign_payments', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    
    /*** loan deactivate ***/
    public function save_payments_assign()
    {
        
        $id = $this->input->post('loan_id', true);
        
        $data['loan_assigned_date'] = $this->input->post('loan_assigned_date', true);
        $data['loan_assigned_to']   = $this->input->post('loan_assigned_to', true);
        $data['loan_assignee']      = $this->session->userdata('name');
        
        //mark status in use
        $data['status'] = 'In use';
        
        $this->tbl_payments('loan_item');
        
        //update
        $this->global_model->save($data, $id);
        
        $this->message->custom_success_msg('admin/loan/manage_payments', 'loan assigned succesfully!');
    }
    /*** loan deactivate ***/
    public function deactive_payments($loan_id)
    {
        foreach ($loan_id as $v_payments_id) {
            $id             = $v_payments_id;
            $data['status'] = 0;
            $this->tbl_payments('loan_item');
            
            //update
            $this->global_model->save($data, $id);
        }
        $this->message->custom_success_msg('admin/loan/manage_payments', 'Your loan Deactivated Successfully!');
    }
    
    /*** Delete loan***/
    public function delete_payments($id)
    {
        if (is_array($id)) {
            foreach ($id as $v_id) {
                $this->_delete($v_id);
            }
            $this->message->delete_success('admin/loan/manage_payments');
            
        } else {
            if (!empty($id)) {
                
                $this->tbl_payments('loan_id');
                $loan = $this->global_model->get_by(array(
                    'loan_id' => $id
                ), true);
                if (!empty($loan)) {
                    $this->_delete($id);
                    $this->message->delete_success('admin/loan/manage_payments');
                }
                redirect('admin/loan/manage_payments');
                
            } else {
                redirect('admin/loan/manage_payments');
            }
        }
    }
    
    /*** Delete Function ***/
    public function _delete($id)
    {
        
        //delete from tbl_payments
        $this->tbl_payments('loan_id');
        $this->global_model->delete($id);
        
        
    }
    
 /*** Delete repayment ***/
    public function delete_repayment($id=null){
    	
    	$repayment_info = $this->db->get_where('tbl_payments_repayment',array('repayment_id'=>$id))->result();
    	foreach ($repayment_info as $value) {
    		$loan_id=$value->loan_id;
    		$repayment_amount=$value->repayment_amount;
    		$repayment_amount=$value->repayment_amount;
    	}
    	
               
        //update
         $this->tbl_payments('loan_id'); 
         $loan_info = $this->global_model->get_by(array('loan_id'=>$loan_id), false);
         
         foreach ($loan_info as $v_payments_info) {
           $amount_due=$v_payments_info->amount_due;
           $balance_amount=$v_payments_info->balance_amount;
           $paid_amount=$v_payments_info->paid_amount;
         }
                      
        //reduce paid amount
        $update_data['paid_amount']=$paid_amount-$repayment_amount;
            //increase balance
        $update_data['balance_amount']=$balance_amount+$repayment_amount;
           //update 
        $this->global_model->save($update_data,$loan_id);
        
        $this->tbl_payments_repayment('repayment_id');
        $this->global_model->delete($id);
        
        $this->message->delete_success('admin/loan/view_payments/'.$loan_id);
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
    		$this->tbl_payments_comments('comment_id');
    		$data['loan_comments']=$this->global_model->get_by(array('comment_id'=>$id), true);
    	}
    	
    	$data['title']= 'Edit Comment';
        $data['modal_subview'] = $this->load->view('admin/loan/_modal_add_comment', $data, FALSE);
        $this->load->view('admin/_layout_modal_small', $data);
    
    }
    
    function save_comments($id=null){

    	
    	$loan_comments=$this->loan_model->array_from_post(array('loan_id','comment','date_posted'));
    	$loan_comments['posted_by'] = $this->session->userdata('name');
    	
    	$this->tbl_payments_comments('comment_id'); //table name
    	if(!empty($id)){  
    		//get
    	$comment_info = $this->db->get_where('tbl_payments_comments',array('comment_id'=>$id))->result();
    	foreach ($comment_info as $value) {
    		$loanid=$value->loan_id;
    	    
    	}	
		    $loan_comments['loan_id']=$loanid;
		    $this->global_model->save($loan_comments,$id);
		    
		  $message = 'Comment updated successful!';
          set_message($type, $message);
          redirect('admin/loan/view_payments/'.$loanid);
    	}else {
    	   $this->global_model->save($loan_comments);
    	   
    	   $message = 'Comment successful!';
           set_message($type, $message);
           redirect('admin/loan/view_payments/'.$loan_comments['loan_id']);
    	  
    	}
   	
    }
    
/*** Delete repayment ***/
    public function delete_comment($id=null){
    	
    	$comment_info = $this->db->get_where('tbl_payments_comments',array('comment_id'=>$id))->result();
    	foreach ($comment_info as $value) {
    		$loan_id=$value->loan_id;
    	
    	}
    	
    	$this->tbl_payments_comments('comment_id');
        $this->global_model->delete($id);
        
        $this->message->delete_success('admin/loan/view_payments/'.$loan_id);
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

public function  due_paymentss() {

 		$data['title']='View Due Loans | Open loans that have due repayments based on the Loan Schedule dates.';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/due_paymentss', $data, true);
        $this->load->view('admin/_layout_main', $data);

}

public function  missed_repayments() {

 		$data['title']='View Due Loans';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/missed_repayments', $data, true);
        $this->load->view('admin/_layout_main', $data);

}

public function  past_maturity_paymentss() {

 		$data['title']='Past Maturity Loans';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/past_maturity_paymentss', $data, true);
        $this->load->view('admin/_layout_main', $data);

}

public function  one_month_late_paymentss($days) {
	
	       //date calculations
                                    
                                  	$release_date=date_create($v_payments->loan_release_date);
								  	$maturity_date=date_create($v_payments->maturity_date);
								  	$diff=date_diff($release_date,$maturity_date);
                                  	$loan_total_days=$diff->format("%a");
                                  	$date_interval=round(($loan_total_days)/$repayments);
                                  	
                                    $loan_next_date=date_add($release_date, date_interval_create_from_date_string("{$date_interval} days"));
    								//next repayment date
        							$next_maturity_date = date_format($loan_next_date, "Y-m-d");
	
	    $data['loan_info'] = $this->db->get('tbl_payments')->result();

 		$data['title']='one month late loans';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/one_month_late_paymentss', $data, true);
        $this->load->view('admin/_layout_main', $data);

}

public function  three_month_late_paymentss() {

 		$data['title']='Three month late loans';
        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/loan/three_month_late_paymentss', $data, true);
        $this->load->view('admin/_layout_main', $data);

}

/*** PDF Invoice Generate  ***/
    public function pdf_receipt($id=null)
    {

            if(empty($id)){
            //redirect manage invoice
            $this->message->norecord_found('admin/loan/manage_payments');
        }

          //repayment details
        $this->tbl_payments_repayment('repayment_id');
        $repayment= $this->global_model->get_by(array('repayment_id'=>$id), false);
        
        foreach($repayment as $v_repayment) {
        	$loan_id=$v_repayment->loan_id;
        	$customer_id=$v_repayment->customer_id;
        	$data['loan_number']=$v_repayment->loan_number;
        	$data['repayment_amount']=$v_repayment->repayment_amount;
        	$data['collection_date']=$v_repayment->collection_date;
        	$data['collected_by']=$v_repayment->collected_by;
        	$data['repayment_method']=$v_repayment->repayment_method;
        	
        }
        
        //get loan
        $this->tbl_payments('loan_id');
        $loan_info= $this->global_model->get_by(array('loan_id'=>$loan_id), false);
     
        foreach($loan_info as $v_payments_info) {
        	$data['loan_status']=$v_payments_info->loan_status;
        	$data['loan_release_date']=$v_payments_info->loan_release_date;
        	$data['maturity_date']=$v_payments_info->maturity_date;
        	$data['loan_repayment_cycle']=$v_payments_info->loan_repayment_cycle;
        	$data['principal_amount']=$v_payments_info->principal_amount;
        	$data['loan_interest_percent']=$v_payments_info->loan_interest_percent;
        	$data['loan_interest']=$v_payments_info->loan_interest;
        	$data['loan_fees']=$v_payments_info->loan_fees;
        	$data['loan_penalty']=$v_payments_info->loan_penalty;
        	$data['loan_interest_period_scheme']=$v_payments_info->loan_interest_period_scheme;
        	$data['amount_due']=$v_payments_info->amount_due;
        	$data['paid_amount']=$v_payments_info->paid_amount;
        	$data['balance_amount']=$v_payments_info->balance_amount;
        }
        
        //customer details
      	$this->tbl_customer('customer_id');
        $customer_info= $this->global_model->get_by(array('customer_id'=>$customer_id), false);
        
     foreach($customer_info as $v_customer_info) {
        	$data['first_name']=$v_customer_info->first_name;
        	$data['second_name']=$v_customer_info->second_name;
        	$data['last_name']=$v_customer_info->last_name;
        	$data['address']=$v_customer_info->address;
        	$data['phone']=$v_customer_info->phone;
        }
        
        
        $data['title'] = 'Repayment Receipt';

        $html = $this->load->view('admin/loan/pdf_receipt', $data, true);
        $filename = 'INV-'.$id.'.pdf';
        $this->load->library('pdf');
        $pdf = $this->pdf->load();

        $pdf->WriteHTML($html);
        $pdf->Output($filename, 'D');

    }
    
        /*** View loan  ***/
    public function view_receipt($id=null){
        if(empty($id)){
            //redirect manage invoice
            $this->message->norecord_found('admin/loan/manage_payments');
        }

          //repayment details
        $this->tbl_payments_repayment('repayment_id');
        $repayment= $this->global_model->get_by(array('repayment_id'=>$id), false);
        
        foreach($repayment as $v_repayment) {
        	$loan_id=$v_repayment->loan_id;
        	$customer_id=$v_repayment->customer_id;
        	$data['loan_number']=$v_repayment->loan_number;
        	$data['repayment_amount']=$v_repayment->repayment_amount;
        	$data['collection_date']=$v_repayment->collection_date;
        	$data['collected_by']=$v_repayment->collected_by;
        	$data['repayment_method']=$v_repayment->repayment_method;
        }
        
        //get loan
        $this->tbl_payments('loan_id');
        $loan_info= $this->global_model->get_by(array('loan_id'=>$loan_id), false);
     
        foreach($loan_info as $v_payments_info) {
        	$data['loan_status']=$v_payments_info->loan_status;
        	$data['loan_release_date']=$v_payments_info->loan_release_date;
        	$data['maturity_date']=$v_payments_info->maturity_date;
        	$data['loan_repayment_cycle']=$v_payments_info->loan_repayment_cycle;
        	$data['principal_amount']=$v_payments_info->principal_amount;
        	$data['loan_interest_percent']=$v_payments_info->loan_interest_percent;
        	$data['loan_interest']=$v_payments_info->loan_interest;
        	$data['loan_fees']=$v_payments_info->loan_fees;
        	$data['loan_penalty']=$v_payments_info->loan_penalty;
        	$data['loan_interest_period_scheme']=$v_payments_info->loan_interest_period_scheme;
        	$data['amount_due']=$v_payments_info->amount_due;
        	$data['paid_amount']=$v_payments_info->paid_amount;
        	$data['balance_amount']=$v_payments_info->balance_amount;
        }
        
        //customer details
      	$this->tbl_customer('customer_id');
        $customer_info= $this->global_model->get_by(array('customer_id'=>$customer_id), false);
        
     foreach($customer_info as $v_customer_info) {
        	$data['first_name']=$v_customer_info->first_name;
        	$data['second_name']=$v_customer_info->second_name;
        	$data['last_name']=$v_customer_info->last_name;
        	$data['address']=$v_customer_info->address;
        	$data['phone']=$v_customer_info->phone;
        }

      
        $data['title'] = 'View Receipt';
        $data['subview'] = $this->load->view('admin/loan/view_receipt', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    function sms_alert($phone=null,$text_sms=null){
    
            
            //load send sms library
            $this->load->library('sms');
           
            //send sms
            $send_sms=$this->sms->sendSms($phone, $text_sms);
    
    
    }
   
         
}

