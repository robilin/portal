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

class Account extends Admin_Controller
{
  
public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('account_model');
        $this->load->model('global_model');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '150px',
            ),
        );
    }

    
    /*** Add Invoice ***/
  
  public function add_invoice(){

        
        $sysInvNo =1000;
        $this->db->select_max('customer_invoice_id');
        $lastId = $this->db->get('tbl_customer_invoice_details')->row()->customer_invoice_id;
        $data['invoice_no']= $sysInvNo + $lastId + 1;
        
          //Get categories for compain
      
        $data['title'] = 'Add Invoice';
        $data['subview'] = $this->load->view('admin/account/add_invoice', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }
   

        //************************ save invoice **********************//
	public function save_invoice($id=null){
		
        $attribute_description = $this->input->post('attribute_description', true);
        $attribute_quantity = $this->input->post('attribute_quantity', true);
        $attribute_price = $this->input->post('attribute_price', true);
		$invoice_title=$this->input->post('invoice_title', true);
		$invoice_no=$this->input->post('invoice_no', true);
        
		$customer_info=$this->input->post('customer', true);
		
		
		
		$customer_data = explode(",", $customer_info); //customer id, visit id
		
        $customer = $this->db->get_where('tbl_customer',array('customer_id'=>$customer_data[0]))->result();
        
//        var_dump($visit_data);
//        exit;
        
        foreach ($customer as $v_customer){
         $customer_name=$v_customer->customer_name;
       
         $phone=$v_customer->phone;
         $address=$v_customer->address;
         $customer_id=$v_customer->customer_id;
        }

        
        for($i = 0; $i < sizeof($attribute_description);$i++)
        {

        	
            if($attribute_description[$i] !=null && $attribute_quantity[$i] != null && $attribute_price[$i] != null)
            {
            	
            	$attribute['invoice_title'] = $invoice_title;
                $attribute['customer_id'] = $customer_id;
                $attribute['customer_name'] = $customer_name;
                
                $attribute['invoice_no'] = $invoice_no;
                $attribute['phone'] = $phone;
                $attribute['address'] = $address;
                $attribute['attribute_description'] = $attribute_description[$i];
                $attribute['attribute_quantity'] = $attribute_quantity[$i];
                $attribute['attribute_price'] = $attribute_price[$i];
                $customer_invoice_id = $attribute_id[$i];
                $attribute['invoice_creation_date']=date('Y-m-d H:i:s');
                $attribute['subtotal']=$attribute['attribute_quantity']*$attribute['attribute_price'];
                
                	
	  			 //save
                $this->tbl_customer_invoice_details('customer_invoice_id');
                $this->global_model->save($attribute,$customer_invoice_id);
                
                $type = 'success';
                $message = 'Information Successfully Saved';

            }

        }
        
           set_message($type, $message);
        redirect('admin/account/add_invoice');
	}
	

	
    /*** View Order Invoice ***/
    public function order_invoice($id=null)
    {

        if(empty($id)){
            //redirect manage invoice
            $this->message->norecord_found('admin/account/manage_invoice');
        }
        
       //order details
        $this->tbl_customer_invoice_details('customer_invoice_id');
        $data['invoice_info']= $this->global_model->get_by(array('invoice_no'=>$id), true);

        //get order id
        $this->tbl_customer_invoice_details('customer_invoice_id');
        $invoice_details= $this->global_model->get_by(array('invoice_no'=>$id), false);
        
		$sub_total=0;
        foreach ($invoice_details as $v_details) {     	
        	$sub_total+=$v_details->subtotal;
        }
        $data['total']=$sub_total;
        $data['invoice_details']=$invoice_details;
        
        
        if(empty($data['invoice_info'])){
            //redirect manage invoice
            $this->message->norecord_found('admin/account/manage_invoice');
        }


        $data['title'] = 'Order Invoice';
        $data['subview'] = $this->load->view('admin/account/order_invoice', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Manage Invoice ***/
    public function manage_invoice(){
        $data['invoice'] = $this->account_model->get_all_customer_invoice();
        
        $data['title'] = 'Manage Invoice';
        $data['subview'] = $this->load->view('admin/account/manage_invoice', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function delete_invoice($id = null){
        $id == true || $this->message->norecord_found('admin/account/manage_invoice');

        $this->db->delete('tbl_customer_invoice_details', array('invoice_no' => $id));

        $this->message->delete_success('admin/account/manage_invoice');

    }
    
    /*** product deactivate ***/
    public function confirm_invoice($invoice_no)
    {
       
            $status['status'] ='paid';
            $this->tbl_customer_invoice_details('status');
            $this->global_model->save($status,$invoice_no);
            
        $this->message->custom_success_msg('admin/account/manage_invoice', 'Your Product confirmed Successfully!');
    }
    
    /*** PDF Invoice Generate  ***/
    public function pdf_invoice($id=null)
    {

            if(empty($id)){
            //redirect manage invoice
            $this->message->norecord_found('admin/account/manage_invoice');
        }
        
       //order details
        $this->tbl_customer_invoice_details('customer_invoice_id');
        $data['invoice_info']= $this->global_model->get_by(array('invoice_no'=>$id), true);

        //get order id
        $this->tbl_customer_invoice_details('customer_invoice_id');
        $invoice_details= $this->global_model->get_by(array('invoice_no'=>$id), false);
        
		$sub_total=0;
        foreach ($invoice_details as $v_details) {     	
        	$sub_total+=$v_details->subtotal;
        }
        $data['total']=$sub_total;
        $data['invoice_details']=$invoice_details;
        
        
        if(empty($data['invoice_info'])){
            //redirect manage invoice
            $this->message->norecord_found('admin/account/manage_invoice');
        }

        $html = $this->load->view('admin/account/pdf_invoice', $data, true);
        $filename = 'INV-'.$id.'.pdf';
        $this->load->library('pdf');
        $pdf = $this->pdf->load();

        $pdf->WriteHTML($html);
        $pdf->Output($filename, 'D');

    }

    
    /*** Manage account ***/
    public function manage_account(){
            	
    	$this->tbl_account('account_id','desc');
        $data['account'] = $this->global_model->get();

        $data['title'] = 'Manage account';
        $data['subview'] = $this->load->view('admin/account/manage_account', $data, true);
        $this->load->view('admin/_layout_main', $data);
       
    }
    

    
    }