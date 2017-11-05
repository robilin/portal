<cript src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<section class="content">
   <div class="row">
      <form action="<?php echo base_url() ?>admin/product/bom_action/" method="post">
         <div class="col-md-12">
            <div class="box box-primary">
               <div class="box-header box-header-background with-border">
                  <h3 class="box-title ">Create Bill Of Materials</h3>
                  <div class="box-tools">
                     <div class="input-group ">
                        <select class="form-control pull-right" name="action" style="width: 150px;" required>
                        <?php  
                        
                        if (empty($product_info->product_id)) {
                        	$product = $this->db->get_where('tbl_product',array('can_be_sold'=>1))->result();
                        }

                        foreach ($product as $value) {
                        	$product_id=$value->product_id;
                        }
                       			 
                       			
                        ?>
                        
                        
                           <option value="">Select..</option>
                           <option value="<?php echo $product_id ?>">Send Save</option>
                        </select>
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" type="button">Action</button>
                        </span>
                     </div>
                  </div>
               </div>
               <!-- /.box-header -->
               
               	      <div class="box-body">
               	      <?php if(empty($product_info->product_id)){ ?>
               	        <div class="form-group">
                        <select placeholder="Click here to select products..." style="width: 51%;" required name="product_id"  class="js-example-basic-multiple-limit" >
                        
                        
                                                                  
                        <?php if (!empty($product)): ?>
                            <?php foreach ($product as $item) : ?>
                                <option value="<?php echo $item->product_id ?>" <?php echo $this->session->userdata('product_id') == $item->product_id ?'selected':'' ?>>
                                   <?php echo $item->product_id.' .'.$item->product_name; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                   </select>
                </div>
               <?php }?>
               	    <?php if(!empty($product_info)){?>  
			       <div class="row">
                        <div class="col-md-6 col-md-offset-2"> 
                            <strong>Product Code:</strong>  <?php if(!empty($product_info)){
                            	echo $product_info->product_code;
                            } ?>
                        </div>
                             <div class="col-md-4">
                            <strong>Product Category:</strong>  <?php if(!empty($product_info)){ echo $product_info->category_name .' > '. $product_info->subcategory_name;} ?>
                        </div>
                                               
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-2">
                          <strong>Product Name:</strong>  <?php if(!empty($product_info)){ echo $product_info->product_name.' '.$product_info->unit; } ?>
                        </div>
                        <div class="col-md-4 ">
                            <strong>Quantity Availlable:</strong>  <?php if(!empty($product_info)){ echo $product_info->product_quantity;} ?>
                        </div>
                        
                    </div>
                    <?php }?>
                    <hr>
                      <div class="row">
                      <div class="col-md-4">
                         <div class="form-group">
                 
                    		<input type="number" required name="production_amount" class="form-control" placeholder="Production quantiy" >
                  
                		</div>
                       </div>                        
                    </div>

                 
                </div>
               
            <div class="box-body">
   <!-- Table -->
                   <!-- <table id="dataTables-example" class="table table-striped table-bordered datatable-buttons"> -->
                    <table class="table table-bordered table-hover" id="dataTables-example" >
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="col-sm-1 active" style="width: 21px"><input type="checkbox" class="checkbox-inline" id="parent_present" /></th>
                                <th class="active">Product Code</th>
                                <th class="active">Product Name</th>
                             
                                <th class="active">Quantity</th>
                                <th class="active">Unit Measure</th>
                                <th class="active">Status</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
      <tbody><!-- / Table body -->
                            <?php  
                            $bom_req = $this->db->get_where('tbl_product',array('can_be_sold'=>0))->result();
                          
                             
                            ?>
                            
                            
                            <?php if (!empty($bom_req)): foreach ($bom_req as $v_product):?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><input  name="product_id[]" value="<?php echo $v_product->product_id ?>" class="child_present" type="checkbox" /></td>
                                      <td class="vertical-td highlight">
                                        <a href="<?php echo base_url().'admin/product/view_product/'. $v_product->product_id ?>"  data-toggle="modal" data-target="#myModal" >
                                            <?php echo $v_product->product_code ?>
                                        </a>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_product->product_name ?></td>
                                    <td class="vertical-td"><input name='bom_quantity[]'  type="text" class="form-control"></td>
                                    <td class="vertical-td"><input name='bom_unit_measure[]'  value="<?php echo $v_product->unit ?>" type="text" class="form-control"></td>
                                    <td class="vertical-td">
                                        <?php
                                        
                                        $item_name=$this->db->get_where('tbl_inventory',array('product_id'=>$v_product->product_id))->result();
                 					foreach ($item_name as $value) {
                 						 $quantity=$value->product_quantity;
                 					}
                 					
                 					
                                        
                                        if($quantity <=0)
                                        { ?>
                                            <span class="label label-warning"><?php echo 'Not in stock' ?></span>
                                        <?php } else { ?>
                                        <button type="button" class="btn btn-primary">In stock <span class="badge"><?php echo $quantity ?></span></button>
                                           
                                        <?php } ?>

                                    </td>
                                    
                                    <td class="vertical-td">
                                          
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/product/delete_product/'. $v_product->product_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
                                        </div>
                                    </td>

                                </tr>
                               
                            <?php

                            endforeach;
                             
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="8">
                                    <strong>There is no data to display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; 
                             ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->

                </div><!-- /.box-body -->

      </form>
      </div>


      </div>
      <!-- /.box -->
      </div>
      <!--/.col end -->
   </div>
   <!-- /.row -->
</section>
<script>
   $('body').on('hidden.bs.modal', '.modal', function() {
       $(this).removeData('bs.modal');
   });

   $(document).ready(function() {

       $('.box-body').css({"border-top":"0px solid #ccc"});

       $("#lab").select2({
           placeholder: "Select a State",
           allowClear: true
       });

       

   });
   
</script>

<script>

   $(document).ready(function() {

       $('.box-body').css({"border-top":"0px solid #ccc"});

       $("#customer").select2({
           placeholder: "Select a State",
           allowClear: true
       });

       $(".js-example-basic-multiple-limit").select2({
    	   maximumSelectionLength: 2
    	 });

   });

</script>

