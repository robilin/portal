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
                    <h3 class="box-title ">Add New asset</h3>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addassetForm" onsubmit="return imageForm(this)"
                      action="<?php echo base_url(); ?>admin/asset/save_asset/<?php  if (!empty($asset_info)) {
                          echo $asset_info->asset_id;
                      } ?>" method="post">


                    <br/><br/>

                    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                        <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#general" data-toggle="tab">General Info</a></li>
                        <li class="<?php
                            if(!empty($tab)){
                                echo $tab == 'price'?'active':'';
                            }
                        ?>">
                        <a href="#price" data-toggle="tab">Brand,Model & Vendor Info</a></li>
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




                                        <!-- /.asset Code -->
                                    <div class="form-group">
                                        <label>Serial number <span class="required">*</span></label>
                                        <input type="text"  name="asset_serial_number" onchange="check_asset_code(this.value)" required
                                               value="<?php if (!empty($asset_info->asset_serial_number)) echo $asset_info->asset_serial_number ?>"
                                               class="form-control">
                                        <div class="required" id="asset_code_result"></div>
                                    </div>

                                        <!-- /.asset Name -->
                                        <div class="form-group">
                                            <label>Asset Name <span class="required">*</span></label>
                                            <input type="text" placeholder="asset Name" name="asset_name"
                                                   value="<?php
                                                   if (!empty($asset_info)) {
                                                       echo $asset_info->asset_name;
                                                   }
                                                   ?>"
                                                   class="form-control">
                                        </div>

                                        <!-- /.asset Note -->
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="asset_note" class="form-control autogrow" id="field-ta"
                                                      placeholder="Asset Description"><?php
                                                if (!empty($asset_info)) {
                                                    echo $asset_info->asset_note;
                                                }
                                                ?></textarea>
                                        </div>

                                        <!-- /.Category -->
                                        <div class="form-group">
                                            <label>Asset Category</label>
                                            <select name="asset_category_id" class="form-control col-sm-5" id="category" onchange="get_category(this.value)">
                                                <option value="">Select asset Category</option>
                                                <?php if (!empty($category)): ?>
                                                    <?php foreach ($category as $v_category) : ?>
                                                        <option value="<?php echo $v_category->asset_category_id; ?>"
                                                            <?php
                                                            if (!empty($asset_info)) {
                                                                echo $v_category->asset_category_id == $v_category->asset_category_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_category->category_name; ?>
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
                                            <select name="asset_brand" class="form-control col-sm-5" id="category" onchange="get_category(this.value)">
                                                <option value="">Select Brand</option>
                                                <?php if (!empty($brand)): ?>
                                                    <?php foreach ($brand as $v_brand) : ?>
                                                        <option value="<?php echo $v_brand->asset_brand_id; ?>"
                                                            <?php
                                                            if (!empty($vendor)) {
                                                                echo $v_brand->asset_brand_id == $v_brand->asset_brand_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_brand->brand_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                            <!-- /.model -->
                                            <div class="form-group form-group-bottom">
                                                <label>Model</label>

                                            <div class="input-group">
                                                
                                                <input class="form-control" name="asset_model" placeholder="Asset Model"
                                                       value="<?php
                                                       if (!empty($asset_info)) {
                                                           echo $asset_info->asset_model;
                                                       }
                                                       ?>"
                                                       type="text">
                                            </div>
                                            </div>
										    <!-- /.Vendor -->                  	
                     
        	                                <!-- /.Category -->
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select name="vendor" class="form-control col-sm-5" id="category" onchange="get_category(this.value)">
                                                <option value="">Select vendor</option>
                                                <?php if (!empty($vendor)): ?>
                                                    <?php foreach ($vendor as $v_vendor) : ?>
                                                        <option value="<?php echo $v_vendor->vendor_id; ?>"
                                                            <?php
                                                            if (!empty($vendor)) {
                                                                echo $v_vendor->vendor_id == $v_vendor->vendor_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_vendor->company_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        
                                         <!-- /.location -->
                                            <div class="form-group form-group-bottom">
                                                <label>Location</label>

                                            <div class="input-group">
                                                
                                                <input class="form-control" name="asset_location" placeholder="Asset Location"
                                                       value="<?php
                                                       if (!empty($asset_info)) {
                                                           echo $asset_info->asset_location;
                                                       }
                                                       ?>"
                                                       type="text">
                                            </div>
                                            </div>

                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.General Price End -->

                                   

                                    <!-- ************* asset Tier Price Start *********** -->

                                    <!-- /.Custom fields -->
                                    
                                    <div class="box">
                                        <div class="box-body">

                                        <!-- Remains to hold shape -->    


                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.Tier Price End -->
                                </div><!-- /.Price Tab End -->

                                
                                <!-- ************* asset asset Start ********** -->
                                 <!-- /.asset Tab Start -->
                                
                                 <div class="tab-pane
                                <?php
                                if(!empty($tab)){
                                    echo $tab == 'inventory'?'active':'';
                                }
                                ?>
                                " id="inventory">

                                <!-- /.asset Tab Start 
                                <div class="tab-panel" id="warranty"> -->

                                    <!-- /.asset asset Start -->
                                    <h5>Warranty & Acquisation</h5>
                                    <div class="box">
                                        <div class="box-body">

                                               <!-- /.asset acquired -->
                                            <div class="form-group form-group-bottom">
                                                <label>Acquired date</label>
                                                </div>
                                                <div class="input-group">
                                                <input type="text" placeholder="Asset acquired date"
                                                       value="<?php
                                                       if (!empty($asset_info->asset_acquired_date)) {
                                                       	  $asset_acquired_date = date('Y/m/d', strtotime($asset_info->asset_acquired_date));
                                                          echo $asset_acquired_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="asset_date" name="asset_acquired_date" data-format="yyyy/mm/dd">
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
                                                       if (!empty($asset_info->asset_warranty_starts)) {
                                                       	  $asset_warranty_start_date = date('Y/m/d', strtotime($asset_info->asset_warranty_starts));
                                                          echo $asset_warranty_start_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="asset_date" name="asset_warranty_starts" data-format="yyyy/mm/dd">
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
                                                       if (!empty($asset_info->asset_warranty_ends)) {
                                                       	  $asset_warranty_end_date = date('Y/m/d', strtotime($asset_info->asset_warranty_ends));
                                                          echo $asset_warranty_end_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="asset_date" name="asset_warranty_ends" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                            
                                          <!-- /.Purchase price-->
                                    <div class="form-group">
                                        <label>Purchase Price </label>
                                        <input type="text"  name="asset_purchase_price" onchange="check_asset_code(this.value)" required
                                               value="<?php if (!empty($asset_info->asset_purchase_price)) echo $asset_info->asset_purchase_price ?>"
                                               class="form-control">
                                         
                                    </div>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.asset asset End -->

                                </div>
                                <!-- /.asset Tab End -->


                                <!-- ************* asset Attribute Start ******** -->

                                <!-- /.Attribute Tab Start -->
                                <div class="tab-pane
                                <?php
                                if(!empty($tab)){
                                    echo $tab == 'attribute'?'active':'';
                                }
                                ?>
                                " id="attribute">

                                    <!-- /.Attribute Start -->
                                    
                                       <!-- /.asset file -->
                           <table class="table table-bordered table-striped">
                             
                             <tbody><tr>
                             <td>
                             
                                       
                                <div class="form-group">
                                    <label>Attach file</label>
                                </div>
                                <div class="form-group">
                                    <!-- hidden  old_path when update  -->
                                    <input type="hidden" name="file_old_path"  value="<?php
                                    if (!empty($asset_info->asset_file_path)) {
                                        echo $asset_info->asset_file_path;
                                    }
                                    ?>">
                                    <div class="fileinput fileinput-new"  data-provides="fileinput">
                                        <div class="fileinput-new thumbnail g-logo-img" >
                                            <?php if (!empty($asset_info->asset_file_name)): // if asset file is exist then show  ?>
                                                <img src="<?php echo base_url() . $asset_info->asset_file_name; ?>" >
                                            <?php else: // if product image is not exist then defualt a image ?>
                                                <img src="<?php echo base_url() ?>img/file.jpg" alt="asset_file">
                                            <?php endif; ?>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                        <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new"><input type="file" name="asset_file_name" /></span>
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

                                        <!-- /.asset Image -->
                                        <div class="form-group">
                                            <label>Asset Image</label>
                                        </div>
                                        <div class="form-group">
                                            <!-- hidden  old_path when update  -->
                                            <input type="hidden" name="old_path"  value="<?php
                                            if (!empty($asset_info->asset_image_path)) {
                                                echo $asset_info->asset_image_path;
                                            }
                                            ?>">
                                            <div class="fileinput fileinput-new"  data-provides="fileinput">
                                                <div class="fileinput-new thumbnail g-logo-img" >
                                                    <?php if (!empty($asset_info)): // if asset image exists then show  ?>
                                                        <img src="<?php echo base_url() . $asset_info->asset_image_name; ?>" >
                                                    <?php else: // if asset image is not exist then defualt a image ?>
                                                        <img src="<?php echo base_url() ?>img/product.png" alt="asset Image">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                                <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">
                                                            <input type="file" name="asset_image_name" /></span>
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
                                        <!-- / asset Image -->
                                <!-- /.Attribute Tab End -->

                                    <!-- ************* hidden input field ******** -->

                                    <!-- asset image id -->
                                    <input type="hidden" name="asset_image_id"
                                           value="<?php
                                           if (!empty($asset_info)) {
                                               echo $asset_info->asset_id;
                                           }
                                           ?>">
                                 
                                    <!-- asset asset id -->
                                    <input type="hidden" name="asset_file_id"
                                           value="<?php
                                           if (!empty($asset_info)) {
                                               echo $asset_info->asset_id;
                                           }
                                           ?>">
                                           
                                     

                        </div>
                    </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit"  id="submit" class="btn bg-navy btn-flat col-md-offset-3" type="submit">Save asset
                        </button>
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
