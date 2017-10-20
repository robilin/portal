<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <form action="<?php echo base_url() ?>admin/collateral/collateral_action" method="post">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">

                        <h3 class="box-title ">Manage collateral</h3>



                    <div class="box-tools">
                        <div class="input-group ">
                            <select class="form-control pull-right" name="action" style="width: 150px;" required>
                                <option value="">Select..</option>
                                <option value="1">With Customer</option>
                                <option value="2">Confiscated</option>
                                <option value="3">With Branch</option>
                                <option value="4">Mark stolen</option>
                                <option value="5">Mark damaged</option>
                                 <option value="6">Delete</option>
                            </select>
                                    <span class="input-group-btn">
                                      <button type="submit" class="btn btn-default" type="button">Action</button>
                                    </span>
                        </div>
                    </div>


                </div>


                <div class="box-body">


                        <!-- Table -->
                   <!-- <table id="datatable" class="table table-striped table-bordered datatable-buttons"> -->
                    <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="col-sm-1 active" style="width: 21px"><input type="checkbox" class="checkbox-inline" id="parent_present" /></th>
                                <th class="active">Image</th>
                                <th class="active">Code</th>  
                                <th class="active">Type</th>
                                <th class="active">Serial</th>
                                <th class="active">Name</th>
                                <th class="active">Collateral Assigned</th>
                                <th class="active">Collateral value</th>
                                <th class="active">Status</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->

                            <?php if (!empty($collateral)): foreach ($collateral as $v_collateral) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><input name="collateral_id[]" value="<?php echo $v_collateral->collateral_id ?>" class="child_present" type="checkbox" /></td>
                                   <td class="product-img">
                                       <?php if (!empty($v_collateral->collateral_image_name)):  ?>
                                            <img src="<?php echo base_url() . $v_collateral->collateral_image_name ?>" />
                                       <?php else:?>
                                            <img src="<?php echo base_url() ?>img/product.png" alt="collateral Image">
                                       <?php endif; ?>
                                    </td> 
                                    <td class="vertical-td highlight">
                                        <a href="<?php echo base_url().'admin/collateral/view_collateral/'. $v_collateral->collateral_id ?>"  data-toggle="modal" data-target="#myModal" >
                                            <?php echo $v_collateral->collateral_id ?>
                                        </a>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_collateral->collateral_type ?></td>
                                    <td class="vertical-td"><?php echo $v_collateral->collateral_serial_number ?></td>
                                    <td class="vertical-td"><?php echo $v_collateral->collateral_name ?></td>
                                    <td class="vertical-td"><?php echo $v_collateral->collateral_assignee ?></td>	
                                    <td class="vertical-td"><?php echo $v_collateral->collateral_purchase_price ?></td>
                                     <td class="vertical-td">
                                        <?php
                                        if(!empty($v_collateral->status))
                                        { ?>
                                            <span class="label label-warning"><?php echo $v_collateral->status ?></span>
                                        <?php } else { ?>
                                            <span class="label bg bg-olive"><?php echo 'Not available' ?></span>
                                        <?php } ?>

                                    </td>
                                    <td class="vertical-td">

                                        <div class="btn-group">
                                       	    <a href="<?php echo base_url().'admin/collateral/collateral_assign/'. $v_collateral->collateral_id ?>" class="btn btn-xs bg-olive" data-toggle="modal" data-target="#myModal"><i class="fa fa-book">Assign</i></a>
                                            <a href="<?php echo base_url().'admin/collateral/edit_collateral/'. $v_collateral->collateral_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo base_url().'admin/collateral/view_collateral/'. $v_collateral->collateral_id ?>" class="btn btn-xs bg-olive" data-toggle="modal" data-target="#myModal" ><i class="glyphicon glyphicon-search"></i></a>
                                            <a href="<?php echo base_url().'admin/collateral/delete_collateral/'. $v_collateral->collateral_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
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



