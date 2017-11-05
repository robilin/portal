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
class Product extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
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
        $this->product_model->_table_name = 'tbl_category';
        $this->product_model->_order_by = 'category_id';
        $data['all_category'] = $this->product_model->get();
        // edit operation of category
        if (!empty($id)) { // if category id exist
            $where = array('category_id' => $id);
            $data['category_info'] = $this->product_model->check_by($where, 'tbl_category');

            if (empty($data['category_info'])) { // empty alert
                // massage
                $this->message->norecord_found('admin/product/category');
            }
        }

        //view page
        $data['title'] = 'Create Category';
        $data['subview'] = $this->load->view('admin/product/category', $data, true); // sub view
        $this->load->view('admin/_layout_main', $data); // main page
    }
    
       
        /*** Add BMR ***/
    public function add_bill_of_material($id=null)
    {
 
    	
    	$data['product_info'] = $this->product_model->get_product_information_by_id($id);
           	
    	
        $data['title'] = 'Add Bill of Material';

        $data['subview'] = $this->load->view('admin/product/add_bill_of_material', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
public function get_bill_of_material($name=null)
    {

    $product= $this->input->post('product_name', true);
    	
   $result=$this->product_model->search($name);
   
   if(count($result)>0){
   		foreach ($result as $v_result) {
   			$array_result[]=$v_result->product_name;
   			echo json_encode($array_result);
   		}
   }
    
 }  
 
 public function view_product_bom($id=null)
    {

    	 
    	$data['title'] = 'Bill Of Materials';
    	$data['product_id']=$id;
        $data['subview'] = $this->load->view('admin/product/view_product_bom', $data, true);
        $this->load->view('admin/_layout_main', $data);
    
    }  
 
 /*** product lab results action***/
 
    public function bom_action($product_id = null)
    {
    	
    	
    	
        $product_id        = $this->input->post('action', true);
        $product_bom_id    = $this->input->post('product_id', true);
        $bom_quantity       = $this->input->post('bom_quantity', true);
        $bom_unit_measure = $this->input->post('bom_unit_measure', true);
        $production_amount = $this->input->post('production_amount', true);
        
        
        $this->product_model->_table_name = 'tbl_bom';
        $this->product_model->_order_by = 'bom_id';
        $where = array('product_id' => $product_id);
        $check_prod = $this->product_model->get_by($where, false);
    
      
      
        if (!empty($check_prod)) { // if exist
           $this->db->delete('tbl_bom', array('product_id' => $product_id)); 
        }
        

   
        for ($i = 0; $i < sizeof($product_bom_id); $i++) {
            if ($product_bom_id[$i] != null && $bom_quantity[$i] != null && $bom_unit_measure[$i] != null) {
                $data['product_bom_id']    = $product_bom_id[$i];
                $data['bom_quantity']      = $bom_quantity[$i];
                $data['bom_unit_measure']      = $bom_unit_measure[$i];
                $data['product_id']         = $product_id;
                $data['production_amount']         = $production_amount;
                $data['date_created'] = date("Y/m/d H:i:s", strtotime('now'));
               
                $this->tbl_bom('bom_id');
                
                 $result  = $this->global_model->save($data);
               
                $type    = 'success';
                $message = 'Information Successfully Saved';
            }
        }

        if (!empty($product_id)) {
            $type    = 'success';
            $message = 'Information Successfully Saved';
            $this->message->custom_success_msg('admin/product/add_bill_of_material/'.$product_id, $message);
        } else {
            $this->message->custom_error_msg('admin/product/add_bill_of_material', 'You did not select any item');
        }
    }
    
    public function delete_bom($id=null){
    	
    	$product_id=$this->db->get_where('tbl_bom',array('bom_id'=>$id));
    	
    	foreach ($product_id as $value) {
    		$product_id=$value->product_id;
    	}
    
    	if($id){
    		
    		$this->db->delete('tbl_bom', array('bom_id' => $id)); 
    		           
            $this->message->custom_success_msg('admin/product/add_product/'.$product_id,'Deleted');
    	
    	}else{
    	$this->message->custom_error_msg('admin/product/add_product/'.$product_id, 'Delete failed');
    	}
    
    
    
    }
    
    public function add_manufacturing_order($id=null){
    	
    	
    }
    
     
        /*** Add BMR ***/
    public function save_bill_of_material($id=null)
    {
    	
//    	 $data = array(
//                    'bom_name' => $this->input->post('bom_name'),
//                    'bom_quantity'=>$this->input->post('bom_quantity'),
//    	 			'prod_unit_measure'=>$this->input->post('prod_unit_measure')
//                        );
	        
   	
  //************************ Product  Attribute Start **********************//
		$prod_id = $this->input->post('product_id', true);
        $prod_name = $this->input->post('bom_name', true);
        $prod_quantity = $this->input->post('bom_quantity', true);
        $prod_unit_measure = $this->input->post('bom_unit_measure', true);

		
		
        for($i = 0; $i < sizeof($prod_name);$i++)
        {
            if($prod_name[$i] !=null && $prod_quantity[$i] != null )
            {   
                $meterial['bom_name'] =$prod_name[$i];
                $meterial['bom_quantity'] = $prod_quantity[$i];
                $meterial['bom_unit_measure'] = $prod_unit_measure[$i];
                                            
                //save 
                $this->tbl_bom('bom_id');
                $this->global_model->save($meterial);

            }

        }

        //************************ Product  Attribute End ********************//
       
//        $type = 'success';
//        $message = 'Product Information Saved Successfully!';
//        set_message($type, $message);
        $data=array('success'=>$message);
        echo json_encode($data);
        
    }
    
       /*** Manage Product ***/
    public function manage_bill_of_material()
    {

        $data['product'] = $this->product_model->get_all_product_info();

        $data['title'] = 'Manage Product';
        $data['subview'] = $this->load->view('admin/product/manage_bill_of_material', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    

    /*** Save Category ***/
    public function save_category($id = null)
    {
        $this->product_model->_table_name = 'tbl_category';
        $this->product_model->_primary_key = 'category_id';

        $data['category_name'] = $this->input->post('category_name', true);

        // update category
        $where = array('category_name' => $data['category_name']);
        // duplicate check
        if (!empty($id)) {
            $category_id = array('category_id !=' => $id);
        } else {
            $category_id = null;
        }

        $check_category = $this->product_model->check_update('tbl_category', $where, $category_id);
        if (!empty($check_category)) { // if exist

            $type = 'error';
            $message = 'Product Category Information Already Exist';
        } else { // save and update query
            $this->product_model->save($data, $id); //save and update
            // massage for employee
            $type = 'success';
            $message = 'Product Category Information Successfully Saved';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/product/category');
    }

    /*** Category Delete ***/
    public function delete_category($id)
    {
        $this->product_model->_table_name = 'tbl_subcategory';
        $this->product_model->_order_by = 'subcategory_id';
        $where = array('category_id' => $id);
        $check_category = $this->product_model->get_by($where, false);

        if (!empty($check_category)) { // if exist
            $type = 'error';
            $message = 'Category Information Already Used';
        } else { // if empty
            $this->product_model->_table_name = 'tbl_category';
            $this->product_model->_primary_key = 'category_id';
            $this->product_model->delete($id);

            $type = 'success';
            $message = 'Product Category Information Successfully Delete ';
        }

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/product/category');
    }
    
 /*** Show cart ***/
    function sandbox(){
        
    	$data['title'] = 'test';
        $data['subview'] = $this->load->view('admin/product/sandobox1', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Create Sub Category ***/
    public function subcategory($id = null)
    {
        $this->product_model->_table_name = 'tbl_category';
        $this->product_model->_order_by = 'category_id';
        $data['all_category'] = $this->product_model->get();

        if (!empty($id)) { // if exist
            $where = array('subcategory_id' => $id);
            $data['sub_category_info'] = $this->product_model->check_by($where, 'tbl_subcategory');

            if (empty($data['sub_category_info'])) { // if empty
                $this->message->norecord_found('admin/product/category');
            }
        }
        // get all_sub_category to view
        $data['all_sub_category'] = $this->product_model->get_all_sub_category();
        // view page

        $data['title'] = 'Product Sub Category';
        $data['subview'] = $this->load->view('admin/product/subcategory', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Create and Update Customer group ***/
    public function save_subcategory($id = null)
    {
        $this->product_model->_table_name = 'tbl_subcategory';
        $this->product_model->_primary_key = 'subcategory_id';
        // input form data
        $data['subcategory_name'] = $this->input->post('subcategory_name', true);
        $data['category_id'] = $this->input->post('category_id', true);

        // update sub category
        $where = array('subcategory_name' => $data['subcategory_name'], 'category_id' => $data['category_id']);
        // duplicate value check
        if (!empty($id)) { // if id exist
            $subcategory_id = array('subcategory_id !=' => $id);
        } else { // if id is not exist
            $subcategory_id = null;
        }
        // input data already exist or not
        $check_category = $this->product_model->check_update('tbl_subcategory', $where, $subcategory_id);

        if (!empty($check_category)) { // if exist
            $type = 'error';
            $message = 'Subcategory Information Already Exist';
        } else {
            $this->product_model->save($data, $id);

            $type = 'success';
            $message = 'Subcategory Information Saved Successfully!';
        }
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/product/subcategory');
    }

    /*** Delete Sub Category ***/
    public function delete_subcategory($id)
    {
        $this->product_model->_table_name = 'tbl_product';
        $this->product_model->_order_by = 'subcategory_id';
        $where = array('subcategory_id' => $id);
        $check_sub_category = $this->product_model->get_by($where, false);

        if (!empty($check_sub_category)) { // if exist
            $type = 'error';
            $message = 'Sub Category Information Already Used';
        } else { // if empty
            $this->product_model->_table_name = 'tbl_subcategory';
            $this->product_model->_primary_key = 'subcategory_id';
            $this->product_model->delete($id);

            $type = 'success';
            $message = 'Subcategory Information Delete Successfully!';
        }
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/product/subcategory');
    }

    /*** Add New or Edit Product ***/
    public function add_product($id=null)
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

        //************* Retrieve Product ****************//

        if($id) {
            $this->tbl_product('product_id');
            $data['product_info'] = $this->global_model->get_by(array('product_id' => $id), true);

            if (!empty($data['product_info'])) {

                //product image
                $this->tbl_product_image('product_image_id');
                $data['product_image'] = $this->global_model->get_by(array('product_id' => $id), true);

                //product price
                $this->tbl_product_price('product_price_id');
                $data['product_price'] = $this->global_model->get_by(array('product_id' => $id), true);

                //product special offer
                $this->tbl_special_offer('special_offer_id');
                $data['special_offer'] = $this->global_model->get_by(array('product_id' => $id), true);

                //product tier price
                $this->tbl_tier_price('tier_price_id');
                $data['tier_price'] = $this->global_model->get_by(array('product_id' => $id), false);

                //product inventory
                $this->tbl_inventory('inventory_id');
                $data['inventory'] = $this->global_model->get_by(array('product_id' => $id), true);

                //product attribute
                $this->tbl_attribute('attribute_id');
                $data['attribute'] = $this->global_model->get_by(array('product_id' => $id), false);
                
                //product attribute
                $this->tbl_bom('bom_id');
                $data['bom'] = $this->global_model->get_by(array('product_id' => $id), false);

                //product tag
                $this->tbl_product_tag('product_tag_id');
                $data['product_tags'] = $this->global_model->get_by(array('product_id' => $id), false);
				
				//product expire
                //$this->tbl_product_expire('product_expire_id');
                //$data['product_expire'] = $this->global_model->get_by(array('product_id' => $id), false);

                //subcategory
                $this->tbl_subcategory('subcategory_id');
                $data['subcategory'] = $this->global_model->get();
                $data['product_category'] = $this->global_model->get_by(array('subcategory_id' => $data['product_info']->subcategory_id), true);



            } else {
                // redirect with msg product not found
                $this->message->norecord_found('admin/product/manage_product');
            }
        }

        $data['code'] = rand(10000000, 99999);

        $this->tbl_category('category_id');
        $data['category'] = $this->global_model->get();

        $this->tbl_tax('tax_id');
        $data['tax'] = $this->global_model->get();

        $this->tbl_tag('tag_id');
        $data['tags'] = $this->global_model->get();

        $this->tbl_attribute_set('attribute_set_id');
        $data['attribute_set'] = $this->global_model->get();
        
        
        //$this->tbl_product_expire('product_expire_id');
        //$data['product_expire'] = $this->global_model->get();

        // view page
        $data['title'] = 'Add Product';

        $data['editor'] = $this->data; //get ck editor
        $data['subview'] = $this->load->view('admin/product/add_product', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    /*** Add New or Update Attribute Group ***/
    public function save_product($id = null)
    {
        if ($id) { // if id
            $product_image_id = $this->input->post('product_image_id', true);
            $product_price_id = $this->input->post('product_price_id', true);
            $special_offer_id = $this->input->post('special_offer_id', true);
            $tier_price_id    = $this->input->post('tier_price_id', true);
            $attribute_id    = $this->input->post('attribute_id', true);
            $inventory_id    = $this->input->post('inventory_id', true);
           // $product_expire_id= $this->input->post('product_expire_id', true);

        } else {
            $product_image_id = null;
            $product_price_id = null;
            $special_offer_id = null;
            $tier_price_id    = null;
            $attribute_id = null;
            $inventory_id = null;
            //$product_expire_id=null;
        }


        //*************** Product Information **************

        $product_info = $this->product_model->array_from_post(array(
            'product_name',
        	'unit',
            'can_be_sold',
            'product_note',
            'subcategory_id',
            'tax_id',
            'product_code',
             ));

        $this->tbl_product('product_id');
        $product_id = $this->global_model->save($product_info, $id);

        if(empty($id)) {
            $this->set_barcode($product_info['product_code'],$product_id);
        }else{
            $this->update_barcode($product_info['product_code'],$id);
        }
        //****************** Product  Image Upload ***********************//

        $this->tbl_product_image('product_image_id');

        // save image Process
        if (!empty($_FILES['product_image']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->product_model->uploadImage('product_image');
            $val == true || redirect('admin/product/add_product');

            $image_data['filename'] = $val['path'];
            $image_data['image_path'] = $val['fullPath'];
            $image_data['product_id'] = $product_id;
            if (!empty($product_image_id)) {
                $this->global_model->save($image_data, $product_image_id); // save and update function
            } else {
                $this->global_model->save($image_data);
            }
        }

        //******************Product Price Information ************************//

        $general_price = $this->product_model->array_from_post(array(
            'buying_price',
            'selling_price', ));
        $general_price['product_id'] = $product_id;

        $this->tbl_product_price('product_price_id');
        // save and update
        $this->global_model->save($general_price, $product_price_id);


        //****************** Product Price Information End ************************//

        //************************ Product Special Offer ************************//

        $special_offer = $this->product_model->array_from_post(array(
            'start_date',
            'end_date',
            'offer_price', ));
        $special_offer['product_id'] = $product_id;


        if( (!empty($special_offer['start_date']) && !empty($special_offer['end_date']) && !empty($special_offer['offer_price']) ))
        {
            // save and update function
            $this->tbl_special_offer('special_offer_id');

            if(!empty($special_offer_id))
            {
                $this->global_model->save($special_offer, $special_offer_id);
            }else
            {
                $this->global_model->save($special_offer);
            }


        }


        //************************ Product Special Offer End ************************//

        
        
        /**

        $product_expire = $this->product_model->array_from_post(array(
            'manufacture_date',
            'expire_date',
            'expire_note', ));
          $product_expire['product_id'] = $product_id;


        if( (!empty($product_expire['manufacture_date']) && !empty($product_expire['expire_date']) && !empty($product_expire['expire_note']) ))
        {
            // save and update function
            $this->tbl_product_expire('product_expire_id');

            if(!empty($product_expire_id))
            {
                $this->global_model->save($product_expire, $product_expire_id);
            }else
            {
                $this->global_model->save($product_expire);
            }


        } */


        //************************ Product expire End ************************//
        
        //************************ Product  Tier Price Start ***********************//

        $tier_quantity = $this->input->post('tier_quantity', true);
        $tier_price = $this->input->post('tier_price', true);
        $tier['product_id'] = $product_id;

        $this->tbl_tier_price('tier_price_id');

        for($i = 0; $i < sizeof($tier_quantity);$i++)
        {
            if($tier_quantity[$i] !=null && $tier_price[$i] != null )
            {
                $tier['quantity_above'] = $tier_quantity[$i];
                $tier['tier_price'] = $tier_price[$i];
                $tier_id = $tier_price_id[$i];

                $this->global_model->save($tier, $tier_id );
            }
        }

        //************************ Product  Tier Price End ***********************//

        //************************ Product  Attribute Start **********************//

        $attribute_name = $this->input->post('attribute_name', true);
        $attribute_value = $this->input->post('attribute_value', true);
        $attribute['product_id'] = $product_id;



        for($i = 0; $i < sizeof($attribute_name);$i++)
        {
            if($attribute_name[$i] !=null && $attribute_value[$i] != null )
            {
                $attribute['attribute_name'] = $attribute_name[$i];
                $attribute_set_name['attribute_name'] = $attribute_name[$i];
                $attribute['attribute_value'] = $attribute_value[$i];
                $product_attribute_id = $attribute_id[$i];
                //save
                $this->tbl_attribute('attribute_id');
                $this->global_model->save($attribute, $product_attribute_id);

                // save set_attribute value
                $this->tbl_attribute_set('attribute_set_id');
                $set_attribute = $this->global_model->get_by(array('attribute_name'=>$attribute['attribute_name'] ), true);

                if(empty($set_attribute))
                {
                    $this->global_model->save($attribute_set_name);
                }


            }



        }

        //************************ Product  Attribute End ********************//
        
        //************************ Product bom Start *************************//
        
        
        
        

        //************************ Product Tag Start *************************//

        $tages = $this->input->post('tages',true);

        //delete product tag
        $product_id = $product_id;
        $this->db->where('product_id', $product_id);
        $this->db->delete('tbl_product_tag');

        for($i=0; $i < sizeof($tages); $i++)
        {

            $this->product_model->_table_name = 'tbl_tag';
            $this->product_model->_primary_key = 'tag_id';

            $product_tag = array();
            $product_tag['tag'] = $tages[$i];
            $where = array('tag' => $tages[$i]);
            $result = $this->product_model->check_by($where, 'tbl_tag');
            $result == true || $this->product_model->save($product_tag);

            $this->tbl_product_tag('product_tag_id');

            $product_tag['product_id'] = $product_id;
            $this->global_model->save($product_tag);
        }
        //************************ Product  Tag End *************************//

        //************ Product  Inventory Information Start *****************//

        $this->tbl_inventory('inventory_id');

        $inventory['notify_quantity'] = $this->input->post('notify_quantity', true);
        $inventory['product_quantity'] = $this->input->post('product_quantity', true);
        $inventory['expire_date'] = $this->input->post('expire_date', true);
        $inventory['product_id'] = $product_id;

        $this->global_model->save($inventory, $inventory_id);

        $type = 'success';
        $message = 'Product Information Saved Successfully!';
        set_message($type, $message);
        //var_dump($inventory['expire_date']);
        redirect('admin/product/manage_product');
    }

    
    public function save_bom() {
    	
    	
    	$data = array(
		'bom_name' => $this->input->post('bom_name'),
		'bom_quantity'=>$this->input->post('bom_quantity'),
    	'bom_unit_measure'=>$this->input->post('bom_unit_measure')
	);

//Either you can print value or you can send value to database
echo json_encode($data);
    	
    	//$this->output->set_output(json_encode('yes'));
    	
//    	$this->tbl_bom('bom_id');
//    	
//		$bom['product_id'] = $id;
//        $bom['bom_description'] = $this->input->post('bom_name', true);
//        $bom['bom_quantity'] = $this->input->post('bom_quantity', true);
//        $bom['bom_unit_measure'] = $this->input->post('bom__unit_measure', true);
//        
//        $this->global_model->save($bom, $id);
//        $type = 'success';
//        $message = 'Product Category Information Successfully Delete ';
//
//       if ($type=='success') {
//       	$this->output->set_output(json_encode($bom['bom_description']));
//       }else{
//       $this->output->set_output(json_encode($bom['bom_description']));
//       }
        	
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

        $this->tbl_product('product_id');
        $this->global_model->save($data, $id);
    }

    private function update_barcode($code, $id)
    {
        $barcode  = $this->db->get_where('tbl_product', array(
            'product_id' => $id
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

        $this->tbl_product('product_id');
        $this->global_model->save($data, $id);

    }

    /*** Manage Product ***/
    public function manage_product()
    {

        $data['product'] = $this->product_model->get_all_product_info();

        $data['title'] = 'Manage Product';
        $data['subview'] = $this->load->view('admin/product/manage_product', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

 /*** Manage material ***/
    public function manage_materials()
    {

        $data['product'] = $this->product_model->get_all_product_materials();

        $data['title'] = 'Manage Product';
        $data['subview'] = $this->load->view('admin/product/manage_materials', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function view_product($id)
    {
        $data['product'] = $this->product_model->get_product_information_by_id($id);
        //product tier price
        $this->tbl_tier_price('tier_price_id');
        $data['tier_price'] = $this->global_model->get_by(array('product_id' => $id), false);

        //product attribute
        $this->tbl_attribute('attribute_id');
        $data['attribute'] = $this->global_model->get_by(array('product_id' => $id), false);

        //product tag
        $this->tbl_product_tag('product_tag_id');
        $data['product_tags'] = $this->global_model->get_by(array('product_id' => $id), false);

         //product expire
        //$this->tbl_inventory('inventory_id');
        //$data['expire_date'] = $this->global_model->get_by(array('product_id' => $id),false);
        
        $data['title'] = 'View Product';
        $data['product_id'] = $id;
        $data['modal_subview'] = $this->load->view('admin/product/_modal_view_product', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }

    /*** Damage product management ***/
    public function damage_product()
    {
        $this->tbl_damage_product('damage_product_id');
        $data['damage_product'] = $this->global_model->get();



        $data['title'] = 'Damage Product';
        $data['subview'] = $this->load->view('admin/product/damage_product', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Add Damage product ***/
    public function add_damage_product(){

        $this->tbl_product('product_id');
        $data['product'] = $this->global_model->get();

        $data['title'] = 'Add Damage Product';
        $data['subview'] = $this->load->view('admin/product/add_damage_product', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Save Damage product ***/
    public function save_damage_product(){
        $data= $this->product_model->array_from_post(array('product_id','qty','note','decrease'));

        if(empty($data['product_id'])){
            $this->message->custom_error_msg('admin/product/add_damage_product','Please select Product');
        }

        $data['date'] = date("j F, Y");

        $this->tbl_product('product_id');
        $product_code = $this->global_model->get_by(array('product_id'=>$data['product_id']),true);
        
        $this->tbl_product_price('product_price_id');
        $product_price = $this->global_model->get_by(array('product_id'=>$data['product_id']),true);

        $category = $this->product_model->get_damage_product($data['product_id']);

        $data['product_code'] = $product_code->product_code;
        $data['product_name'] = $product_code->product_name;
        $data['unit_measure'] = $product_code->unit;
        $data['buying_price'] = $product_price->buying_price;
        $data['category'] = $category->category_name . ' > '. $category->subcategory_name ;

        //product inventory
        $this->tbl_inventory('inventory_id');
        $inventory = $this->global_model->get_by(array('product_id'=>$data['product_id']),true);

        if($data['qty'] > $inventory->product_quantity )
        {
            $msg = 'Sorry! Your Damage Product Quantity is Greater than Product Quantity!';
            $this->message->custom_error_msg('admin/product/damage_product', $msg );

        }else
        {

            //save damage product
            $this->tbl_damage_product('damage_product_id');
            $this->global_model->save($data);

            if($data['decrease']==1)
            {
                // update tbl_inventory
                $sdata['product_quantity'] = $inventory->product_quantity - $data['qty'];
                $this->tbl_inventory('inventory_id');
                $this->global_model->save($sdata, $inventory->inventory_id);
                // redirect success msg
                $this->message->save_success('admin/product/damage_product');

            }else
            {
                $this->message->save_success('admin/product/damage_product');
            }
        }
    }

    /*** product action handel ***/
    public function product_action()
    {
        // 1 = active
        // 2 = deactivated
        // 3 = delete

        $action = $this->input->post('action' , true);
        $product_id = $this->input->post('product_id' , true);

        if(!empty($product_id)) {


            if ($action == 1) {
                //active product
                $this->active_product($product_id);

            } elseif ($action == 2) {
                //deactivated product
                $this->deactive_product($product_id);
            } else {
                //delete product
                $this->delete_product($product_id);
            }
        }else{
            $this->message->custom_error_msg('admin/product/manage_product', 'You did not select any Product');
        }
    }

    /*** product activate ***/
    public function active_product($product_id)
    {
        foreach($product_id as $v_product_id){
            $id = $v_product_id;
            $data['status'] = 1;
            $this->tbl_product('product_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/product/manage_product', 'Your Product Active Successfully!');
    }

    /*** product deactivate ***/
    public function deactive_product($product_id)
    {
        foreach($product_id as $v_product_id){
            $id = $v_product_id;
            $data['status'] = 0;
            $this->tbl_product('product_item');

            //update
            $this->global_model->save($data,$id );
        }
        $this->message->custom_success_msg('admin/product/manage_product', 'Your Product Deactivated Successfully!');
    }

    /*** Delete product***/
    public function delete_product($id){
        if(is_array($id))
        {
            foreach($id as $v_id)
            {
                $this->_delete($v_id);
            }
            $this->message->delete_success('admin/product/manage_product');

        }else
        {
            if (!empty($id)) {

                $this->tbl_product('product_id');
                $product = $this->global_model->get_by(array('product_id'=>$id),true);
                if(!empty($product)){
                    $this->_delete($id);
                    $this->message->delete_success('admin/product/manage_product');
                }
                redirect('admin/product/manage_product');

            } else {
                redirect('admin/product/manage_product');
            }
        }
    }

    /*** Delete Function ***/
    public function _delete($id){

        //delete from tbl_product
        $this->tbl_product('product_id');
        $this->global_model->delete($id);

        //price
        $this->tbl_product_price('product_price_id');
        $product_price = $this->global_model->get_by(array('product_id'=>$id),true);
        $this->global_model->delete($product_price->product_price_id);

        //Inventory
        $this->tbl_inventory('inventory_id');
        $inventory = $this->global_model->get_by(array('product_id'=>$id),true);
        $this->global_model->delete($inventory->inventory_id);

        //delete image
        $this->tbl_product_image('product_image_id');
        $image_id = $this->global_model->get_by(array('product_id'=>$id),true);
        if(!empty($image_id)) {
            $this->global_model->delete($image_id->product_image_id);
        }
        //Special offer
        $this->tbl_special_offer('special_offer_id');
        $special_offer = $this->global_model->get_by(array('product_id'=>$id),true);
        if(!empty($special_offer)) {
            $this->global_model->delete($special_offer->special_offer_id);
        }
        //tier Price
        $this->tbl_tier_price('tier_price_id');
        $tire_price = $this->global_model->get_by(array('product_id'=>$id),false);

        if(!empty($tire_price)) {
            foreach ($tire_price as $v_tire_price) {
                $this->global_model->delete($v_tire_price->tier_price_id);
            }
        }

        //tag
        $this->tbl_product_tag('product_tag_id');
        $tag = $this->global_model->get_by(array('product_id'=>$id),false);
        if(!empty($tag)) {
            foreach ($tag as $v_tag) {
                $this->global_model->delete($v_tag->product_tag_id);
            }
        }

        //attribute
        $this->tbl_attribute('attribute_id');
        $attribute = $this->global_model->get_by(array('product_id'=>$id),false);
        if(!empty($attribute)) {
            foreach ($attribute as $v_attribute) {
                $this->global_model->delete($v_attribute->attribute_id);
            }
        }

    }

    /*** Add Damage product ***/
    public function print_barcode(){

        $this->tbl_product('product_id');
        $data['product'] = $this->global_model->get();

        $data['title'] = 'Add Damage Product';
        $data['subview'] = $this->load->view('admin/product/print_barcode', $data, true);
        $this->load->view('admin/_layout_full', $data);
    }

    public function add_to_print(){

        $product_id = $this->input->post('product_id', true);


        for($i=0; $i< sizeof($product_id); $i++){
            $this->tbl_product('product_id');
            $product = $this->global_model->get_by(array('product_id'=>$product_id[$i] ),true);


            $flag= true;
            if(!empty($_SESSION["barcode"])) {
                for ($j = 0; $j < sizeof($_SESSION["barcode"]); $j++) {
                    if ($product->product_id == $_SESSION["barcode"][$j]['product_id']) {
                        $flag = false;
                    }

                }
            }
            if($flag){
                $_SESSION["barcode"][] =  array(
                    "product_id"    =>$product->product_id,
                    "product_name"  =>$product->product_name,
                    "barcode"       =>$product->barcode,
                );
            }

        }

        redirect('admin/product/print_barcode');
    }

    /*** Barcode Print Session Destroy ***/
    public function clear_print_tray(){
        unset($_SESSION['barcode']);
        redirect('admin/product/print_barcode');
    }


    public function barcode_pdf(){
        // load DOMPDF to create PDF
        $this->load->helper('dompdf');

        $view_file = $this->load->view('admin/product/barcode_pdf','', true);
        $file_name = pdf_create($view_file, 'Barcode');
        echo $file_name;
    }

    /*** Delete tier price ***/
    public function delete_tire_price($id)
    {

        $this->tbl_tier_price('tier_price_id');

        //product id
        $product = $this->global_model->get_by(array('tier_price_id' => $id),true);
        $this->global_model->delete($id);
        redirect('admin/product/add_product/'.$product->product_id. '/' . $flag='price');

    }

    /*** Delete Attribute ***/
    public function delete_attribute($id)
    {

        $this->tbl_attribute('attribute_id');

        //product id
        $attribute = $this->global_model->get_by(array('attribute_id' => $id),true);
        $this->global_model->delete($id);
        redirect('admin/product/add_product/'.$attribute->product_id. '/' . $flag='attribute');

    }

 
    /*** Delete Damage Product ***/
    public function delete_damage_product($id)
    {
        $this->tbl_damage_product('damage_product_id');
        $this->global_model->delete($id);
        $this->message->delete_success('admin/product/damage_product');

    }

    /*** Notification Product ***/
    public function notification_product()
    {

        $data['product'] = $this->product_model->get_all_product_info();

        $data['title'] = 'Manage Product';
        $data['subview'] = $this->load->view('admin/product/notification_product', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
    
  /*** Notification Product ***/
    public function expirely_notification_product()
    {

        $data['product'] = $this->product_model->get_all_product_info();
		$data['alert_config']=$this->global_model->check_alerts_config(1);
        $data['title'] = 'Manage Product';
        $data['subview'] = $this->load->view('admin/product/expire_notification_product', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    /*** Get subcategory by category ***/
    public function get_subcategory_by_category($id=null){
        $this->tbl_subcategory('subcategory_id');
        $subcategory = $this->global_model->get_by(array('category_id' => $id), false);
        if ($subcategory) {
            foreach ($subcategory as $v_subcategory) {
                $HTML.="<option value='" . $v_subcategory->subcategory_id . "'>" . $v_subcategory->subcategory_name . "</option>";
            }
        }
        echo $HTML;
    }


    public function check_product_code(){
        $product_code = $this->input->post('product_code');
        $product_id = $this->input->post('product_id');
        if(!empty($product_code)) {
            $result = $this->product_model->check_product_code($product_code, $product_id);
            if ($result) {
                echo 'This Product Code is Exist!';
            }
        }

    }
 

}