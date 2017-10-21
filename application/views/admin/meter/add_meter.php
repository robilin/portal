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

            <div class="box box-primary">

                <div class="box-header box-header-background with-border">
                    <h3 class="box-title "><?php echo $title?></h3>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addmeterForm" onsubmit="return imageForm(this)"
                      action="<?php echo base_url(); ?>admin/meter/save_meter/<?php  if (!empty($meter_info)) {
                          echo $meter_info->meter_id;
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




                                        <!-- /.meter Code -->
                                    <div class="form-group">
                                        <label>Serial number</label>
                                        <input type="text"  name="meter_serial_number" onchange="check_meter_code(this.value)" required
                                               value="<?php if (!empty($meter_info->meter_serial_number)) echo $meter_info->meter_serial_number ?>"
                                               class="form-control">
                                        <div class="required" id="meter_code_result"></div>
                                    </div>

                                        <!-- /.meter Name -->
                                        <div class="form-group">
                                            <label>Meter number <span class="required">*</span></label>
                                            <input type="text" placeholder="Meter number" name="meter_number"
                                                   value="<?php
                                                   if (!empty($meter_info)) {
                                                       echo $meter_info->meter_number;
                                                   }
                                                   ?>"
                                                   class="form-control">
                                        </div>

                                        <!-- /.meter Note -->
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="meter_note" class="form-control autogrow" id="field-ta"
                                                      placeholder="meter Description"><?php
                                                if (!empty($meter_info)) {
                                                    echo $meter_info->meter_note;
                                                }
                                                ?></textarea>
                                        </div>

                                        <!-- /.Category -->
                                        <div class="form-group">
                                            <label>meter Type</label>
                                            <select name="meter_type" class="form-control col-sm-5" id="type">
                                                <option value=""></option>
                                                <?php $type = $this->db->get('tbl_meter_type')->result();?>
                                                <?php if (!empty($type)): ?>
                                                    <?php foreach ($type as $v_type) : ?>
                                                        <option value="<?php echo $v_type->meter_type; ?>"
                                                            <?php
                                                            if (!empty($meter_info)) {
                                                                echo $v_type->type_id == $v_type->type_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_type->meter_type; ?>
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
                                                
                                                <input class="form-control" name="meter_brand" placeholder="meter brand"
                                                       value="<?php
                                                       if (!empty($meter_info)) {
                                                           echo $meter_info->meter_brand;
                                                       }
                                                       ?>"
                                                       type="text">
                                            </div>
                                        </div>

                                            <!-- /.model -->
                                            <div class="form-group form-group-bottom">
                                                <label>Model</label>

                                            <div class="input-group">
                                                
                                                <input class="form-control" name="meter_model" placeholder="meter Model"
                                                       value="<?php
                                                       if (!empty($meter_info)) {
                                                           echo $meter_info->meter_model;
                                                       }
                                                       ?>"
                                                       type="text">
                                            </div>
                                            </div>
										    <!-- /.Vendor -->                  	
                     
        	                                <!-- /.Category -->
                                        <div class="form-group">
                                            <label>Vendor</label>
                                          
                                                <input class="form-control" name="meter_vendor" placeholder="meter Vendor"
                                                       value="<?php
                                                       if (!empty($meter_info)) {
                                                           echo $meter_info->meter_vendor;
                                                       }
                                                       ?>"
                                                       type="text">
                                            
                                        </div>
                                        
                                         <!-- /.location -->
                                            <div class="form-group form-group-bottom">
                                                <label>Location</label>

                                            <div class="input-group">
                                                
                                                <input class="form-control" name="meter_location" placeholder="meter Location"
                                                       value="<?php
                                                       if (!empty($meter_info)) {
                                                           echo $meter_info->meter_location;
                                                       }
                                                       ?>"
                                                       type="text">
                                            </div>
                                            </div>

                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.General Price End -->

                                   

                                    <!-- ************* meter Tier Price Start *********** -->

                                    <!-- /.Custom fields -->
                                    
                                    <div class="box">
                                        <div class="box-body">

                                        <!-- Remains to hold shape -->    


                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.Tier Price End -->
                                </div><!-- /.Price Tab End -->

                                
                                <!-- ************* meter meter Start ********** -->
                                 <!-- /.meter Tab Start -->
                                
                                 <div class="tab-pane
                                <?php
                                if(!empty($tab)){
                                    echo $tab == 'inventory'?'active':'';
                                }
                                ?>
                                " id="inventory">

                                <!-- /.meter Tab Start 
                                <div class="tab-panel" id="warranty"> -->

                                    <!-- /.meter meter Start -->
                                    <h5>Warranty & Acquisation</h5>
                                    <div class="box">
                                        <div class="box-body">

                                               <!-- /.meter acquired -->
                                            <div class="form-group form-group-bottom">
                                                <label>Acquired date</label>
                                                </div>
                                                <div class="input-group">
                                                <input type="text" placeholder="meter acquired date"
                                                       value="<?php
                                                       if (!empty($meter_info->meter_acquired_date)) {
                                                       	  $meter_acquired_date = date('Y/m/d', strtotime($meter_info->meter_acquired_date));
                                                          echo $meter_acquired_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="meter_date" name="meter_acquired_date" data-format="yyyy/mm/dd">
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
                                                       if (!empty($meter_info->meter_warranty_starts)) {
                                                       	  $meter_warranty_start_date = date('Y/m/d', strtotime($meter_info->meter_warranty_starts));
                                                          echo $meter_warranty_start_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="meter_date" name="meter_warranty_starts" data-format="yyyy/mm/dd">
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
                                                       if (!empty($meter_info->meter_warranty_ends)) {
                                                       	  $meter_warranty_end_date = date('Y/m/d', strtotime($meter_info->meter_warranty_ends));
                                                          echo $meter_warranty_end_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="meter_date" name="meter_warranty_ends" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                            
                                          <!-- /.Purchase price-->
                                    <div class="form-group">
                                        <label>Purchase Price </label>
                                        <input type="text"  name="meter_purchase_price" onchange="check_meter_code(this.value)" required
                                               value="<?php if (!empty($meter_info->meter_purchase_price)) echo $meter_info->meter_purchase_price ?>"
                                               class="form-control">
                                         
                                    </div>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.meter meter End -->

                                </div>
                                <!-- /.meter Tab End -->


                                <!-- ************* meter Attribute Start ******** -->

                                <!-- /.Attribute Tab Start -->
                                <div class="tab-pane
                                <?php
                                if(!empty($tab)){
                                    echo $tab == 'attribute'?'active':'';
                                }
                                ?>
                                " id="attribute">

                                    <!-- /.Attribute Start -->
                                    
                                       <!-- /.meter file -->
                           <table class="table table-bordered table-striped">
                             
                             <tbody><tr>
                             <td>
                             
                                       
                                <div class="form-group">
                                    <label>Attach file</label>
                                </div>
                                <div class="form-group">
                                    <!-- hidden  old_path when update  -->
                                    <input type="hidden" name="file_old_path"  value="<?php
                                    if (!empty($meter_info->meter_file_path)) {
                                        echo $meter_info->meter_file_path;
                                    }
                                    ?>">
                                    <div class="fileinput fileinput-new"  data-provides="fileinput">
                                        <div class="fileinput-new thumbnail g-logo-img" >
                                            <?php if (!empty($meter_info->meter_file_name)): // if meter file is exist then show  ?>
                                                <img src="<?php echo base_url() . $meter_info->meter_file_name; ?>" >
                                            <?php else: // if product image is not exist then defualt a image ?>
                                                <img src="<?php echo base_url() ?>img/file.jpg" alt="meter_file">
                                            <?php endif; ?>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                        <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new"><input type="file" name="meter_file_name" /></span>
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

                                        <!-- /.meter Image -->
                                        <div class="form-group">
                                            <label>meter Image</label>
                                        </div>
                                        <div class="form-group">
                                            <!-- hidden  old_path when update  -->
                                            <input type="hidden" name="old_path"  value="<?php
                                            if (!empty($meter_info->meter_image_path)) {
                                                echo $meter_info->meter_image_path;
                                            }
                                            ?>">
                                            <div class="fileinput fileinput-new"  data-provides="fileinput">
                                                <div class="fileinput-new thumbnail g-logo-img" >
                                                    <?php if (!empty($meter_info)): // if meter image exists then show  ?>
                                                        <img src="<?php echo base_url() . $meter_info->meter_image_name; ?>" >
                                                    <?php else: // if meter image is not exist then defualt a image ?>
                                                        <img src="<?php echo base_url() ?>img/product.png" alt="meter Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">
                                                            <input type="file" name="meter_image_name" /></span>
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
                                        <!-- / meter Image -->
                                <!-- /.Attribute Tab End -->

                                    <!-- ************* hidden input field ******** -->

                                    <!-- meter image id -->
                                    <input type="hidden" name="meter_image_id"
                                           value="<?php
                                           if (!empty($meter_info)) {
                                               echo $meter_info->meter_id;
                                           }
                                           ?>">
                                 
                                    <!-- meter meter id -->
                                    <input type="hidden" name="meter_id"
                                           value="<?php
                                           if (!empty($meter_info)) {
                                               echo $meter_info->meter_id;
                                           }
                                           ?>">
                                           
                                           <!-- meter meter id -->
                                    <input type="hidden" name="status"
                                           value="<?php
                                           if (!empty($meter_info)) {
                                               echo $meter_info->status;
                                           }
                                           ?>">
                                               
                                                                             
                                     

                        </div>
                    </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit"  id="submit" class="btn bg-navy btn-flat col-md-offset-3" type="submit">Save meter</button>
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
