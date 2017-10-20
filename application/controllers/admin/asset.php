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
class Asset extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('asset_model');
        $this->load->model('global_model');
        $this->load->library('pagination');
        $this->load->helper('ckeditor');
        $this->data['ckeditor'] = array(
            'id' => 'ck_editor',
            'path' => 'asset/js/ckeditor',
            'config' => array(
                'toolbar' => 'Full',
                'width' => '100%',
                'height' => '250px',
            ),
        );
    }


/*** Create Category ***/
    public function category($id = null)
    {
        $this->asset_model->_table_name = 'tbl_asset_category';
        $this->asset_model->_order_by = 'asset_category_id';
        $data['all_category'] = $this->asset_model->get();
        // edit operation of category
        if (!empty($id)) { // if category id exist
            $where = array('asset_category_id' => $id);
            $data['category_info'] = $this->asset_model->check_by($where, 'tbl_asset_category');

            if (empty($data['category_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/asset/category');
            }
        }

        //view page
        $data['title'] = 'Create Asset Category';
  
        $data['subview'] = $this->load->view('admin/asset/category', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }
    
   
/*** Create brand ***/
    public function brand($id = null)
    {
        $this->asset_model->_table_name = 'tbl_asset_brand';
        $this->asset_model->_order_by = 'asset_brand_id';
        $data['all_brand'] = $this->asset_model->get();
        // edit operation of brand
        if (!empty($id)) { // if brand id exist
            $where = array('asset_brand_id' => $id);
            $data['brand_info'] = $this->asset_model->check_by($where, 'tbl_asset_brand');

            if (empty($data['brand_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/asset/brand');
            }
        }

        //view page
        $data['title'] = 'Create Asset brand';
  
        $data['subview'] = $this->load->view('admin/asset/brand', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }

    /*** Save Category ***/
    public function save_category($id = null)
    {
        $this->asset_model->_table_name = 'tbl_asset_category';
        $this->asset_model->_primary_key = 'asset_category_id';

        $data['category_name'] = $this->input->post('category_name', true);

        // update category
        $where = array('category_name' => $data['category_name']);
        // duplicate check
        if (!empty($id)) {
            $asset_category_id = array('asset_category_id !=' => $id);
        } else {
            $asset_category_id = null;
        }

        $check_category = $this->asset_model->check_update('tbl_asset_category', $where, $asset_category_id);
        if (!empty($check_category)) { // if exist

            $type = 'error';
            $message = 'asset Category Information Already Exist';
        } else { // save and update query
            $this->asset_model->save($data, $id); //save and update
            // massage for employee
            $type = 'success';
            $message = 'asset Category Information Successfully Saved';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/asset/category');
    }

    
    /*** Save brand ***/
    public function save_brand($id = null)
    {
        $this->asset_model->_table_name = 'tbl_asset_brand';
        $this->asset_model->_primary_key = 'asset_brand_id';

        $data['brand_name'] = $this->input->post('brand_name', true);

        // update brand
        $where = array('brand_name' => $data['brand_name']);
        // duplicate check
        if (!empty($id)) {
            $menuid = array('menu_id !=' => $id);
        } else {
            $menu_id = null;
        }

        $check_brand = $this->asset_model->check_update('tbl_asset_brand', $where, $menu_id);
        if (!empty($check_brand)) { // if exist

            $type = 'error';
            $message = 'brand brand Information Already Exist';
        } else { // save and update query
            $this->asset_model->save($data, $id); //save and update
            // massage for employee
            $type = 'success';
            $message = 'Asset Brand Information Successfully Saved';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/asset/brand');
    }
    
    /*** Category Delete ***/
    public function delete_category($id)
    {
        $this->asset_model->_table_name = 'tbl_asset_category';
        $this->asset_model->_order_by = 'asset_category_id';
        $where = array('asset_category_id' => $id);
        $check_category = $this->asset_model->get_by($where, false);

        if (empty($check_category)) { // if exist
            $type = 'error';
            $message = 'Category Information does not exist :)';
        } else { // if empty
            $this->asset_model->_table_name = 'tbl_asset_category';
            $this->asset_model->_primary_key = 'asset_category_id';
            $this->asset_model->delete($id);

            $type = 'success';
            $message = 'Asset Category Information Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/asset/category');
    }
    
/*** Create brand 


    /*** brand Delete ***/
    public function delete_brand($id)
    {
        $this->asset_model->_table_name = 'tbl_asset_brand';
        $this->asset_model->_order_by = 'asset_brand_id';
        $where = array('asset_brand_id' => $id);
        $check_brand = $this->asset_model->get_by($where, false);

        if (empty($check_brand)) { // if exist
            $type = 'error';
            $message = 'Brand Information does not exist :)';
        } else { // if empty
            $this->asset_model->_table_name = 'tbl_asset_brand';
            $this->asset_model->_primary_key = 'asset_brand_id';
            $this->asset_model->delete($id);

            $type = 'success';
            $message = 'brand brand Information Successfully Deleted ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/asset/brand');
    }

    /*** Add New or Edit asset ***/
    public function add_asset($id=null)
    {
        //tab selection
        $tab = $this->uri->segment(5);
        if(!empty($tab)){
            if($tab == 'price')
            {
                $data['tab'] = $tab;
            }else{
                $data['tab'] = $tab;
            }
        }

        //************* Retrieve asset ****************//

        if($id) {
            $this->tbl_asset('asset_id');
            $data['asset_info'] = $this->global_model->get_by(array('asset_id' => $id), true);

            if (!empty($data['asset_info'])) {

             
	//I DONT KNOW FOR NOW


            } else {
                // redirect with msg asset not found
                $this->message->norecord_found('admin/asset/manage_asset');
            }
        }

        $data['code'] = rand(10000000, 99999);

        
        $data['category'] = $this->asset_model->get_all_category();
        // view page
        $data['vendor'] = $this->asset_model->get_all_vendors();
        
        //get brands
        $data['brand'] = $this->asset_model->get_all_brands();
        
        //view page
        $data['title'] = 'Add asset';

        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/asset/add_asset', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    /*** Add New or Update Attribute Group ***/
    public function save_asset($id = null)
    {
        if ($id) { // if id
            $asset_id = $this->input->post('asset_id', true);
           
        } else {
            $asset_id = null;
         
            //$asset_expire_id=null;
        }

        //*************** asset Information **************

        $asset_info = $this->asset_model->array_from_post(array(
            'asset_name',
        	'asset_serial_number',
            'asset_note',
            'status',
            'asset_category_id',
            'asset_brand',
            'asset_model',
        	'vendor',
            'asset_location',
            'asset_acquired_date',
       	    'asset_warranty_starts',
            'asset_warranty_ends',
            'asset_file_name',
            'asset_file_path',
            'asset_image_name',
        	'asset_image_path',
            'asset_purchase_price',
             ));
            
         $asset_info['status']='In stock';
         $asset_info['asset_assignee']='Not assigned';    

        $this->tbl_asset('asset_id');
        $asset_id = $this->global_model->save($asset_info, $id);

        if(empty($id)) {
            $this->set_barcode($asset_info['asset_serial_number'],$asset_id);
        }else{
            $this->update_barcode($asset_info['asset_serial_number'],$id);
        }
        //****************** asset  Image Upload ***********************//

        // save image Process
        if (!empty($_FILES['asset_image_name']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->asset_model->uploadImage('asset_image_name');
            $val == true || redirect('admin/asset/add_asset');

            $image_data['asset_image_name'] = $val['path'];
            $image_data['asset_image_path'] = $val['fullPath'];
            
            $image_data['asset_id'] = $asset_id;
            if (!empty($asset_id)) {
                $this->global_model->save($image_data, $asset_id); // save and update function
            } else {
                $this->global_model->save($image_data);
            }
        }
        
        
         // File Process
        if (!empty($_FILES['asset_file_name']['name'])) {
            $old_path = $this->input->post('file_old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->asset_model->uploadFile('asset_file_name');
            $val == true || redirect('admin/asset/add_asset');

            $file_data['asset_file_name'] = $val['path'];
            $file_data['asset_file_path'] = $val['fullPath'];
            
            $file_data['asset_id'] = $asset_id;
            if (!empty($asset_id)) {
                $this->global_model->save($file_data, $asset_id); // save and update function
            } else {
                $this->global_model->save($file_data);
            }
        }
       
        $type = 'success';
        $message = 'asset Information Saved Successfully!';
        set_message($type, $message);
        //var_dump($image_data['asset_image_path']);
        //var_dump($image_data['asset_image_name']);
        redirect('admin/asset/manage_asset');
    }

    /*** Barcode Generate ***/
    private function set_barcode($code, $id)
    {

        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');

        //generate barcode
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());

        imagejpeg($file, "img/barcode/{$code}.jpg");

        $data['barcode'] = "img/barcode/{$code}.jpg";
        $data['barcode_path'] = getcwd().'/'.$data['barcode'];

        $this->tbl_asset('asset_id');
        $this->global_model->save($data, $id);
    }

    private function update_barcode($code, $id)
    {
        $barcode  = $this->db->get_where('tbl_asset', array(
            'asset_id' => $id
        ))->row()->barcode_path;
        unlink($barcode);

        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');

        //generate barcode
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $code), array());

        imagejpeg($file, "img/barcode/{$code}.jpg");

        $data['barcode'] = "img/barcode/{$code}.jpg";
        $data['barcode_path'] = getcwd().'/'.$data['barcode'];

        $this->tbl_asset('asset_id');
        $this->global_model->save($data, $id);

    }

    /*** Manage asset ***/
    public function manage_asset()
    {

        $data['asset'] = $this->asset_model->get_all_asset_info();

//        var_dump($data['asset']);
//        exit;
        $data['title'] = 'Manage asset';
        $data['subview'] = $this->load->view('admin/asset/manage_asset', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    
    public function view_asset($id)
    {
        $data['asset'] = $this->asset_model->get_asset_information_by_id($id);
      
        $data['title'] = 'View asset';
        $data['asset_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/asset/_modal_view_asset', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }

    /*** Damage asset management ***/
    public function damage_asset()
    {
        $this->tbl_asset('asset_id');
        $data['damage_asset'] = $this->global_model->get();



        $data['title'] = 'Damage asset';
        $data['subview'] = $this->load->view('admin/asset/damage_asset', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Add Damage asset ***/
    public function add_damage_asset(){

        $this->tbl_asset('asset_id');
        $data['asset'] = $this->global_model->get();

        $data['title'] = 'Add Damage asset';
        $data['subview'] = $this->load->view('admin/asset/add_damage_asset', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Save Damage asset ***/
    public function save_damage_asset(){
        $data= $this->asset_model->array_from_post(array('asset_id','qty','note','decrease'));

        if(empty($data['asset_id'])){
            $this->message->custom_error_msg('admin/asset/add_damage_asset','Please select asset');
        }

        $data['date'] = date("j F, Y");

        $this->tbl_asset('asset_id');
        $asset_code = $this->global_model->get_by(array('asset_id'=>$data['asset_id']),true);

        $category = $this->asset_model->get_damage_asset($data['asset_id']);

        $data['asset_code'] = $asset_code->asset_code;
        $data['asset_name'] = $asset_code->asset_name;
        $data['category'] = $category->category_name . ' > '. $category->subcategory_name ;

        //asset inventory
        $this->tbl_inventory('inventory_id');
        $inventory = $this->global_model->get_by(array('asset_id'=>$data['asset_id']),true);

        if($data['qty'] > $inventory->asset_quantity )
        {
            $msg = 'Sorry! Your Damage asset Quantity is Greater than asset Quantity!';
            $this->message->custom_error_msg('admin/asset/damage_asset', $msg );

        }else
        {

            //save damage asset
            $this->tbl_damage_asset('damage_asset_id');
            $this->global_model->save($data);

            if($data['decrease']==1)
            {
                // update tbl_inventory
                $sdata['asset_quantity'] = $inventory->asset_quantity - $data['qty'];
                $this->tbl_inventory('inventory_id');
                $this->global_model->save($sdata, $inventory->inventory_id);
                // redirect success msg
                $this->message->save_success('admin/asset/damage_asset');

            }else
            {
                $this->message->save_success('admin/asset/damage_asset');
            }
        }
    }

    /*** asset action handel ***/
    public function asset_action()
    {
        					
    	$action = $this->input->post('action' , true);
        $asset_id = $this->input->post('asset_id' , true);

        if(!empty($asset_id)) {


            if ($action == 1) {
                //instock asset
                $this->instock_asset($asset_id);

            } elseif ($action == 2) {
                //mark in use asset
                $this->inuse_asset($asset_id);
            }  elseif ($action == 3) {
                //decommission asset
                $this->decommission_asset($asset_id);
            } elseif ($action == 4) {
                //mstolen_asset
                $this->mark_stolen_asset($asset_id);
            } elseif ($action == 5) {
                //mark damaged_asset
                $this->mark_damaged_asset($asset_id);
            }else {
                //delete asset
                $this->delete_asset($asset_id);
            }
        }else{
            $this->message->custom_error_msg('admin/asset/manage_asset', 'You did not select any asset');
        }
    }

    /*** asset activate ***/
    public function active_asset($asset_id)
    {
        foreach($asset_id as $v_asset_id){
            $id = $v_asset_id;
            $data['status'] = 1;
            $this->tbl_asset('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/asset/manage_asset', 'Your asset Active Successfully!');
    }
    
    //
   public function instock_asset($asset_id)
    {
        foreach($asset_id as $v_asset_id){
            $id = $v_asset_id;
            $data['status'] ='In stock';
            $this->tbl_asset('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/asset/manage_asset', 'Your asset Active Successfully!');
    }
    
 //
   public function inuse_asset($asset_id)
    {
        foreach($asset_id as $v_asset_id){
            $id = $v_asset_id;
            $data['status'] ='In use';
            $this->tbl_asset('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/asset/manage_asset', 'Action successfully!');
    }
 //
   public function decommission_asset($asset_id)
    {
        foreach($asset_id as $v_asset_id){
            $id = $v_asset_id;
            $data['status'] ='Decommissioned';
            $this->tbl_asset('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/asset/manage_asset', 'Action successfully!');
    }
 //
   public function mark_stolen_asset($asset_id)
    {
        foreach($asset_id as $v_asset_id){
            $id = $v_asset_id;
            $data['status'] ='Stolen';
            $this->tbl_asset('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/asset/manage_asset', 'Action successfully!');
    }
    
  public function mark_damaged_asset($asset_id)
    {
        foreach($asset_id as $v_asset_id){
            $id = $v_asset_id;
            $data['status'] ='Damaged';
            $this->tbl_asset('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/asset/manage_asset', 'Action successfully!');
    }
    
 public function asset_assign($id)
    {
        $data['asset'] = $this->asset_model->get_asset_information_by_id($id);
      
        $this->user_model->_table_name = 'tbl_user';
        $this->user_model->_order_by = 'user_id';
        $data['all_employee_info'] = $this->user_model->get();
        
        $data['title'] = 'View asset';
        $data['asset_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/asset/_modal_assign_asset', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }

  /*** asset deactivate ***/
    public function save_asset_assign()
    {
    	
            $id = $this->input->post('asset_id', true);
                        
            $data['asset_assigned_date'] = $this->input->post('asset_assigned_date', true);
            $data['asset_assigned_to']=$this->input->post('asset_assigned_to', true);
            $data['asset_assignee'] = $this->session->userdata('name');

            //mark status in use
            $data['status'] ='In use';
            
            $this->tbl_asset('asset_item');

            //update
            $this->global_model->save($data,$id );
                    
            $this->message->custom_success_msg('admin/asset/manage_asset', 'Asset assigned succesfully!');
    }
    /*** asset deactivate ***/
    public function deactive_asset($asset_id)
    {
        foreach($asset_id as $v_asset_id){
            $id = $v_asset_id;
            $data['status'] = 0;
            $this->tbl_asset('asset_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/asset/manage_asset', 'Your asset Deactivated Successfully!');
    }

    /*** Delete asset***/
    public function delete_asset($id){
        if(is_array($id))
        {
            foreach($id as $v_id)
            {
                $this->_delete($v_id);
            }
            $this->message->delete_success('admin/asset/manage_asset');

        }else
        {
            if (!empty($id)) {

                $this->tbl_asset('asset_id');
                $asset = $this->global_model->get_by(array('asset_id'=>$id),true);
                if(!empty($asset)){
                    $this->_delete($id);
                    $this->message->delete_success('admin/asset/manage_asset');
                }
                redirect('admin/asset/manage_asset');

            } else {
                redirect('admin/asset/manage_asset');
            }
        }
    }

    /*** Delete Function ***/
    public function _delete($id){

        //delete from tbl_asset
        $this->tbl_asset('asset_id');
        $this->global_model->delete($id);


    }

    /*** Add Damage asset ***/
    public function print_barcode(){

        $this->tbl_asset('asset_id');
        $data['asset'] = $this->global_model->get();

        $data['title'] = 'Add Damage Asset';
        $data['subview'] = $this->load->view('admin/asset/print_barcode', $data, true);
        $this->load->view('admin/_layout_full', $data);
    }

    public function add_to_print(){

        $asset_id = $this->input->post('asset_id', true);


        for($i=0; $i< sizeof($asset_id); $i++){
            $this->tbl_asset('asset_id');
            $asset = $this->global_model->get_by(array('asset_id'=>$asset_id[$i] ),true);


            $flag= true;
            if(!empty($_SESSION["barcode"])) {
                for ($j = 0; $j < sizeof($_SESSION["barcode"]); $j++) {
                    if ($asset->asset_id == $_SESSION["barcode"][$j]['asset_id']) {
                        $flag = false;
                    }

                }
            }
            if($flag){
                $_SESSION["barcode"][] =  array(
                    "asset_id"    =>$asset->asset_id,
                    "asset_name"  =>$asset->asset_name,
                    "barcode"     =>$asset->barcode,
                );
            }

        }

        redirect('admin/asset/print_barcode');
    }

    /*** Barcode Print Session Destroy ***/
    public function clear_print_tray(){
        unset($_SESSION['barcode']);
        redirect('admin/asset/print_barcode');
    }


    public function barcode_pdf(){
        // load DOMPDF to create PDF
        $this->load->helper('dompdf');

        $view_file = $this->load->view('admin/asset/barcode_pdf','', true);
        $file_name = pdf_create($view_file, 'Barcode');
        echo $file_name;
    }
 

    /*** Delete Damage asset ***/
    public function delete_damage_asset($id)
    {
        $this->tbl_damage_asset('damage_asset_id');
        $this->global_model->delete($id);
        $this->message->delete_success('admin/asset/damage_asset');

    }

    /*** Notification asset ***/
    public function notification_asset()
    {

        $data['asset'] = $this->asset_model->get_all_asset_info();

        $data['title'] = 'Manage Asset';
        $data['subview'] = $this->load->view('admin/asset/notification_asset', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
  /*** Notification asset ***/
    public function expirely_notification_asset()
    {

        $data['asset'] = $this->asset_model->get_all_asset_info();
		$data['alert_config']=$this->global_model->check_alerts_config(1);
        $data['title'] = 'Manage asset';
        $data['subview'] = $this->load->view('admin/asset/expire_notification_asset', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    public function check_asset_code(){
        $asset_code = $this->input->post('asset_code');
        $asset_id = $this->input->post('asset_id');
        if(!empty($asset_code)) {
            $result = $this->asset_model->check_asset_code($asset_code, $asset_id);
            if ($result) {
                echo 'This asset Code is Exist!';
            }
        }

    }
    
    /*** Add vendor ***/
    public function add_vendor($id = null)
    {
        $this->tbl_vendor('vendor_id');

        if ($id) {//condition check
            $result = $this->global_model->get_by(array('vendor_id' => $id), true);

            if ($result) {
                $data['vendor'] = $result;
            } else {
                //msg
                $type = 'error';
                $message = 'Sorry, No Record Found!';
                set_message($type, $message);
                redirect('admin/asset/manage_vendor');
            }
        }

        // view page
        $data['title'] = 'Add New Vendor';
        $data['editor'] = $this->data;
        $data['subview'] = $this->load->view('admin/asset/add_vendor', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }



    /*** Save vendor ***/
    public function save_vendor($id = null)
    {
        $this->tbl_vendor('vendor_id');
        $data = $this->global_model->array_from_post(array('company_name', 'vendor_name' , 'email', 'address', 'phone'));

        $this->global_model->save($data, $id);
        //msg
        $this->message->save_success('admin/asset/manage_vendor');

    }

    /*** Manage vendor ***/
    public function manage_vendor($id = null)
    {
        $this->tbl_vendor('vendor_id', 'desc');
        $data['vendor'] = $this->global_model->get();
            // view page
        $data['title'] = 'Add New Vendor';
        $data['subview'] = $this->load->view('admin/asset/manage_vendor', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Delete vendor ***/
    public function delete_vendor($id)
    {
        $this->tbl_vendor('vendor_id');
        $this->global_model->delete($id);
        $this->message->delete_success('admin/asset/manage_vendor');

    }
    
    /*** vendor History ***/
    public function vendor_history($id){
        if(empty($id)){
            $this->message->norecord_found('admin/asset/manage_vendor');
        }

        $this->tbl_vendor('vendor_id');
        $data['vendor'] = $this->global_model->get_by(array('vendor_id' => $id), true);

        if(empty($data['vendor'])){
            $this->message->norecord_found('admin/asset/manage_vendor');
        }

        $this->tbl_asset('asset_id');
        $data['asset'] = $this->global_model->get_by(array('vendor_id' => $id), false);

        $data['title'] = 'vendor History';
        $data['subview'] = $this->load->view('admin/asset/vendor_history', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }




}