<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <form action="<?php echo base_url() ?>admin/product/product_action" method="post">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">

                        <h3 class="box-title ">Products Expiring in <span class="label label-danger"><?php echo $alert_config->days;?></span> days</h3>

                   <div class="box-tools">
                        <div class="input-group ">
                            <select class="form-control pull-right" name="action" style="width: 150px;" required>
                                <option value="">Select..</option>
                                <option value="1">Active</option>
                                <option value="2">Deactivate</option>
                                <option value="3">Delete</option>
                            </select>
                                    <span class="input-group-btn">
                                      <button type="submit" class="btn btn-default" type="button">Action</button>
                                    </span>
                        </div>
                    </div>
                
                
                </div>


                <div class="box-body">

                        <!-- Table -->
                       <!-- <table class="table table-bordered table-striped" id="dataTables-example"> -->
                       <!-- <table id="datatable dataTables-example" class="table table-striped table-bordered table-hover datatable-buttons"> -->
                        <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead ><!-- Table head -->
                            <tr>
                            <th class="col-sm-1 active" style="width: 21px"><input type="checkbox" class="checkbox-inline" id="parent_present" /></th>
                                <th class="active">Image</th>
                                <th class="active">Code</th>
                                <th class="active">Product Name</th>
                                <th class="active">Expire Date</th>
                                <th class="active"> Status </th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->

                            <?php
                            $notify_expire = $_SESSION["notify_expire"];
                            if (!empty($notify_expire)): foreach ($notify_expire as $v_expire) : ?>
                                <tr class="custom-tr">
                                <td class="vertical-td"><input name="product_id[]" value="<?php echo $v_expire->product_id ?>" class="child_present" type="checkbox" /></td>
                                    <td class="product-img">
                                        <?php if (!empty($v_expire->filename)):  ?>
                                            <img src="<?php echo base_url() . $v_expire->filename ?>" />
                                        <?php else:?>
                                            <img src="<?php echo base_url() ?>img/product.png" alt="Product Image">
                                        <?php endif; ?>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_expire->product_code ?></td>
                                    <td class="vertical-td"><?php echo $v_expire->product_name ?></td>
                                    <td class="vertical-td">
                                        <?php
                                            if(strtotime($v_expire->expire_date)<= (strtotime(date("Y/m/d")))+100*86400)
                                            { ?>
                                                <span class="label label-warning"><?php echo $v_expire->expire_date ?></span>
                                        <?php } else { ?>
                                                <?php echo '0'; ?>
                                                <?php } ?>

                                    </td>
									<td class="vertical-td">
									
                                     <?php
									
                                     $difference=strtotime($v_expire->expire_date)-strtotime('now');
                                    
                                     //$days_remaining=($difference/86400);
                                     $days_remaining=floor($difference/86400);
                                     if($days_remaining>=0){
                                     	?>
                                    <span class="label label-warning">
                                     <?php
                                        echo 'Expiring in '.$days_remaining.' Days';
                                     }else{
                                     ?>
                                     </span>
                                     <span class="label label-danger">
                                      <?php echo 'Expired '.abs($days_remaining).' Days Ago';
                                      }?>
                                     </span>
                                     
                                                                          
                                     
									
									
									</td>
                                    <td class="vertical-td">
                                        <?php echo btn_view_modal('admin/product/view_product/' . $v_expire->product_id); ?>
                                        <?php echo btn_edit('admin/product/add_product/' . $v_expire->product_id); ?>
                                        <?php echo btn_delete('admin/product/delete_product/' . $v_expire->product_id); ?>
                                    </td>

                                </tr>
                            <?php

                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="8">
                                    <strong>There is no data to display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->

                </div><!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
        </form>
    </div>
    <!-- /.row -->
</section>

<script>
    $('body').on('hidden.bs.modal', '.modal', function() {
        $(this).removeData('bs.modal');
    });

</script>



