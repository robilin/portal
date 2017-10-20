<script src="<?php echo base_url(); ?>asset/js/ajax.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php $info = $this->session->userdata('business_info'); ?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
        <?php  $customer_info= $this->db->get_where('tbl_customer',array('customer_id'=>$loan_info->customer_id))->result();
                foreach ($customer_info as $value) {
                	$customer_id=$value->customer_id;
                	$customer_title=$value->title;
                	$first_name=$value->first_name;
                	$second_name=$value->second_name;
                	$last_name=$value->last_name;
                	
                }
        ?>
            <div class="box box-primary">

                <div class="box-header box-header-background with-border">
                    <h3 class="box-title "><?php echo $title?>, Borrower: <b> <?php if(!empty($customer_info)) {echo $customer_title.' '.$first_name.' '.$second_name.' '.$last_name;}
               ?></b></h3>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addcollateralForm" onsubmit="return imageForm(this)"
                      action="<?php echo base_url(); ?>admin/collateral/save_collateral/<?php  if (!empty($collateral_info)) {
                          echo $collateral_info->collateral_id;
                      } ?>" method="post">


                    <br/><br/>

                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#general" data-toggle="tab">General Info</a></li>
                        <li class="<?php if(!empty($tab)){ echo $tab == 'price'?'active':'';} ?>"><a href="#price" data-toggle="tab">Brand,Model & Vendor Info</a></li>
                        <li><a href="#inventory" data-toggle="tab">Acquisation & Warranty</a></li>
                        <li class="<?php
                        if(!empty($tab)){
                            echo $tab == 'attribute'?'active':'';
                        }
                        ?>">
                            <a href="#attribute" data-toggle="tab">Image & File</a></li>
                            

                    </ul>

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                            <div id="my-tab-content" class="tab-content">
                                <!-- ***************  General Tab Start ****************** -->
                                <div class="tab-pane <?php if(empty($tab)){ echo 'active';} ?>" id="general">




                                        <!-- /.collateral Code -->
                                    <div class="form-group">
                                        <label>Serial number</label>
                                        <input type="text"  name="collateral_serial_number" onchange="check_collateral_code(this.value)" required
                                               value="<?php if (!empty($collateral_info->collateral_serial_number)) echo $collateral_info->collateral_serial_number ?>"
                                               class="form-control">
                                        <div class="required" id="collateral_code_result"></div>
                                    </div>

                                        <!-- /.collateral Name -->
                                        <div class="form-group">
                                            <label>Product Name <span class="required">*</span></label>
                                            <input type="text" placeholder="Collateral Name" name="collateral_name"
                                                   value="<?php
                                                   if (!empty($collateral_info)) {
                                                       echo $collateral_info->collateral_name;
                                                   }
                                                   ?>"
                                                   class="form-control">
                                        </div>

                                        <!-- /.collateral Note -->
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="collateral_note" class="form-control autogrow" id="field-ta"
                                                      placeholder="Collateral Description"><?php
                                                if (!empty($collateral_info)) {
                                                    echo $collateral_info->collateral_note;
                                                }
                                                ?></textarea>
                                        </div>

                                        <!-- /.Category -->
                                        <div class="form-group">
                                            <label>Collateral Type</label>
                                            <select name="collateral_type" class="form-control col-sm-5" id="type" onchange="get_category(this.value)">
                                                <option value=""></option>
                                                <?php $type = $this->db->get('tbl_collateral_type')->result();?>
                                                <?php if (!empty($type)): ?>
                                                    <?php foreach ($type as $v_type) : ?>
                                                        <option value="<?php echo $v_type->collateral_type; ?>"
                                                            <?php
                                                            if (!empty($collateral_info)) {
                                                                echo $v_type->id == $v_type->id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_type->collateral_type; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>



                                    <!-- /.box-body -->

                                </div>
                                <!-- ************* General Tab End ********************** -->

                                <!-- ************* General Price Tab Start ************** -->

                                <!-- /.Price Tab Start -->
                                <div class="tab-pane

                                <?php
                                if(!empty($tab)){
                                    echo $tab == 'price'?'active':'';
                                }
                                ?>

                                " id="price">

                                    <!-- /.General Price Start -->
                                    <h5>Brand,Model & Vendor info</h5>
                                    <div class="box">
                                        <div class="box-body">

                                            <!-- /.Brand -->
                                               
                                        <div class="form-group">
                                            <label>Brand</label>
                                         
                                            <div class="input-group">
                                                
                                                <input class="form-control" name="collateral_brand" placeholder="Collateral brand"
                                                       value="<?php
                                                       if (!empty($collateral_info)) {
                                                           echo $collateral_info->collateral_brand;
                                                       }
                                                       ?>"
                                                       type="text">
                                            </div>
                                        </div>

                                            <!-- /.model -->
                                            <div class="form-group form-group-bottom">
                                                <label>Model</label>

                                            <div class="input-group">
                                                
                                                <input class="form-control" name="collateral_model" placeholder="Collateral Model"
                                                       value="<?php
                                                       if (!empty($collateral_info)) {
                                                           echo $collateral_info->collateral_model;
                                                       }
                                                       ?>"
                                                       type="text">
                                            </div>
                                            </div>
										    <!-- /.Vendor -->                  	
                     
        	                                <!-- /.Category -->
                                        <div class="form-group">
                                            <label>Vendor</label>
                                          
                                                <input class="form-control" name="collateral_vendor" placeholder="Collateral Vendor"
                                                       value="<?php
                                                       if (!empty($collateral_info)) {
                                                           echo $collateral_info->collateral_vendor;
                                                       }
                                                       ?>"
                                                       type="text">
                                            
                                        </div>
                                        
                                         <!-- /.location -->
                                            <div class="form-group form-group-bottom">
                                                <label>Location</label>

                                            <div class="input-group">
                                                
                                                <input class="form-control" name="collateral_location" placeholder="Collateral Location"
                                                       value="<?php
                                                       if (!empty($collateral_info)) {
                                                           echo $collateral_info->collateral_location;
                                                       }
                                                       ?>"
                                                       type="text">
                                            </div>
                                            </div>

                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.General Price End -->

                                   

                                    <!-- ************* collateral Tier Price Start *********** -->

                                    <!-- /.Custom fields -->
                                    
                                    <div class="box">
                                        <div class="box-body">

                                        <!-- Remains to hold shape -->    


                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.Tier Price End -->
                                </div><!-- /.Price Tab End -->

                                
                                <!-- ************* collateral collateral Start ********** -->
                                 <!-- /.collateral Tab Start -->
                                
                                 <div class="tab-pane
                                <?php
                                if(!empty($tab)){
                                    echo $tab == 'inventory'?'active':'';
                                }
                                ?>
                                " id="inventory">

                                <!-- /.collateral Tab Start 
                                <div class="tab-panel" id="warranty"> -->

                                    <!-- /.collateral collateral Start -->
                                    <h5>Warranty & Acquisation</h5>
                                    <div class="box">
                                        <div class="box-body">

                                               <!-- /.collateral acquired -->
                                            <div class="form-group form-group-bottom">
                                                <label>Acquired date</label>
                                                </div>
                                                <div class="input-group">
                                                <input type="text" placeholder="collateral acquired date"
                                                       value="<?php
                                                       if (!empty($collateral_info->collateral_acquired_date)) {
                                                       	  $collateral_acquired_date = date('Y/m/d', strtotime($collateral_info->collateral_acquired_date));
                                                          echo $collateral_acquired_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="collateral_date" name="collateral_acquired_date" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>

                                               <!-- /.warranty starts -->
                                            <div class="form-group form-group-bottom">
                                                <label>Warranty starts </label>
                                                </div>
                                                <div class="input-group">
                                                <input type="text" placeholder="Warranty start date"
                                                       value="<?php
                                                       if (!empty($collateral_info->collateral_warranty_starts)) {
                                                       	  $collateral_warranty_start_date = date('Y/m/d', strtotime($collateral_info->collateral_warranty_starts));
                                                          echo $collateral_warranty_start_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="collateral_date" name="collateral_warranty_starts" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                                                                      
                                            <!-- /.warranty ends -->
                                            <div class="form-group form-group-bottom">
                                                <label>Warranty Ends </label>
                                                </div>
                                                <div class="input-group">
                                                <input type="text" placeholder="Warranty ends Date"
                                                       value="<?php
                                                       if (!empty($collateral_info->collateral_warranty_ends)) {
                                                       	  $collateral_warranty_end_date = date('Y/m/d', strtotime($collateral_info->collateral_warranty_ends));
                                                          echo $collateral_warranty_end_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="collateral_date" name="collateral_warranty_ends" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                            
                                          <!-- /.Purchase price-->
                                    <div class="form-group">
                                        <label>Purchase Price </label>
                                        <input type="text"  name="collateral_purchase_price" onchange="check_collateral_code(this.value)" required
                                               value="<?php if (!empty($collateral_info->collateral_purchase_price)) echo $collateral_info->collateral_purchase_price ?>"
                                               class="form-control">
                                         
                                    </div>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.collateral collateral End -->

                                </div>
                                <!-- /.collateral Tab End -->


                                <!-- ************* collateral Attribute Start ******** -->

                                <!-- /.Attribute Tab Start -->
                                <div class="tab-pane
                                <?php
                                if(!empty($tab)){
                                    echo $tab == 'attribute'?'active':'';
                                }
                                ?>
                                " id="attribute">

                                    <!-- /.Attribute Start -->
                                    
                                       <!-- /.collateral file -->
                           <table class="table table-bordered table-striped">
                             
                             <tbody><tr>
                             <td>
                             
                                       
                                <div class="form-group">
                                    <label>Attach file</label>
                                </div>
                                <div class="form-group">
                                    <!-- hidden  old_path when update  -->
                                    <input type="hidden" name="file_old_path"  value="<?php
                                    if (!empty($collateral_info->collateral_file_path)) {
                                        echo $collateral_info->collateral_file_path;
                                    }
                                    ?>">
                                    <div class="fileinput fileinput-new"  data-provides="fileinput">
                                        <div class="fileinput-new thumbnail g-logo-img" >
                                            <?php if (!empty($collateral_info->collateral_file_name)): // if collateral file is exist then show  ?>
                                                <img src="<?php echo base_url() . $collateral_info->collateral_file_name; ?>" >
                                            <?php else: // if product image is not exist then defualt a image ?>
                                                <img src="<?php echo base_url() ?>img/file.jpg" alt="collateral_file">
                                            <?php endif; ?>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                        <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new"><input type="file" name="collateral_file_name" /></span>
                                                        <span class="fileinput-exists">Change</span>
                                                    </span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                        <div id="valid_msg" class="required"></div>
                                    </div>
                                </div>
                                </td>
                                <td>
                                <!-- / Product Image -->

                                        <!-- /.collateral Image -->
                                        <div class="form-group">
                                            <label>collateral Image</label>
                                        </div>
                                        <div class="form-group">
                                            <!-- hidden  old_path when update  -->
                                            <input type="hidden" name="old_path"  value="<?php
                                            if (!empty($collateral_info->collateral_image_path)) {
                                                echo $collateral_info->collateral_image_path;
                                            }
                                            ?>">
                                            <div class="fileinput fileinput-new"  data-provides="fileinput">
                                                <div class="fileinput-new thumbnail g-logo-img" >
                                                    <?php if (!empty($collateral_info)): // if collateral image exists then show  ?>
                                                        <img src="<?php echo base_url() . $collateral_info->collateral_image_name; ?>" >
                                                    <?php else: // if collateral image is not exist then defualt a image ?>
                                                        <img src="<?php echo base_url() ?>img/product.png" alt="collateral Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">
                                                            <input type="file" name="collateral_image_name" /></span>
                                                        <span class="fileinput-exists">Change</span>
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                                <div id="valid_msg" class="required"></div>
                                            </div>
                                        </div>
                                        </td>
                              
                              </tr>
                             </tbody></table>
                                        <!-- / collateral Image -->
                                <!-- /.Attribute Tab End -->

                                    <!-- ************* hidden input field ******** -->

                                    <!-- collateral image id -->
                                    <input type="hidden" name="collateral_image_id"
                                           value="<?php
                                           if (!empty($collateral_info)) {
                                               echo $collateral_info->collateral_id;
                                           }
                                           ?>">
                                 
                                    <!-- collateral collateral id -->
                                    <input type="hidden" name="collateral_file_id"
                                           value="<?php
                                           if (!empty($collateral_info)) {
                                               echo $collateral_info->collateral_id;
                                           }
                                           ?>">
                                           
                                             <!-- customer id -->
                                    <input type="hidden" name="customer_id"
                                           value="<?php
                                           if (!empty($customer_info)) {
                                               echo $customer_id;
                                           }
                                           ?>">
                                              <!-- customer id -->
                                    <input type="hidden" name="loan_id"
                                           value="<?php
                                           if (!empty($loan_info)) {
                                               echo $loan_info->loan_id;
                                           }
                                           ?>">      
                                     

                        </div>
                    </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit"  id="submit" class="btn bg-navy btn-flat col-md-offset-3" type="submit">Save Collateral</button>
                    </div>

                </form>
            </div><!-- /.box -->
        </div><!--/.col end -->
    </div><!-- /.row -->
</section><!-- /.section -->




<script>
$(function(){
    var sampleTags = [
        <?php
        if(!empty($tags))
        foreach($tags as $v_tag){
        echo "'$v_tag->tag',";
        }

        ?>
    ];

    //-------------------------------
    // Allow spaces without quotes.
    //-------------------------------
    $('#allowSpacesTags').tagit({
       availableTags: sampleTags,
        allowSpaces: true,
        fieldName: "tages[]",
        tagLimit:3,
        autocomplete: {delay: 0, minLength: 2}
    });
});
</script>


<script>
    var options = {
        source: [
            <?php
           if(!empty($attribute_set))
           foreach($attribute_set as $v_attribute){
           echo "'$v_attribute->attribute_name',";
           }
           ?>
        ]

    };
    var result = 'input.selector';
    $(document).on('keydown.autocomplete', result, function() {
        $(this).autocomplete(options);
    });

</script>


<!--    Image Validation Check    -->


<script type="text/javascript">

</script>
