<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php $info = $this->session->userdata('business_info'); ?>
<section class="content">
 <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Damage Product</h3>
                </div>
                     
                          
                      <div class="box-body">                         
                           <div class="table-responsive">

                              <table class="table table-bordered table-hover" id="dataTables-example" >
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">#</th>
                                <th class="active">Product Name</th>
                             
                                <th class="active">Quantity</th>
                                <th class="active">Unit Measure</th>
                                
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
      <tbody><!-- / Table body -->
                            <?php  $bom_req = $this->db->get_where('tbl_bom',array('product_id'=>$product_id))->result();
                         
                             
                            ?>
                            
                            <?php $counter =1 ; ?>
                            <?php if (!empty($bom_req)): foreach ($bom_req as $v_bom):?>
                           
                              <?php $item_name=$this->db->get_where('tbl_product',array('product_id'=>$v_bom->product_bom_id))->result();
                 					foreach ($item_name as $value) {
                 						 $name=$value->product_name;
                 						 $code=$value->product_code;
                 					}
                 					?>
                                <tr class="custom-tr">
                                <td class="vertical-td"><?php echo $counter ?></td>
                                   <td class="vertical-td"><input name='bom_name[]'   value="<?php echo $name ?>" type="text" class="form-control"></td>
                                    <td class="vertical-td"><input name='bom_quantity[]'   value="<?php echo $v_bom->bom_quantity ?>" type="text" class="form-control"></td>
                                    <td class="vertical-td"><input name='bom_unit_measure[]'  value="<?php echo $v_bom->bom_unit_measure ?>" type="text" class="form-control"></td>
                                 
                                    
                                    <td class="vertical-td">
                                          
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/product/delete_bom/'. $v_bom->bom_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
                                        </div>
                                    </td>

                                </tr>
                               
                            <?php
                             $counter++;
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

			                              
                           </div>
                           </div>
                           </div>
                      
    </div>
    </div>
                      
              
</section>
<!-- /.section -->
