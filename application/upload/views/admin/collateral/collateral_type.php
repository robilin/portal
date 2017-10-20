<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">

                        <h3 class="box-title ">Collateral Type</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-background">
                <!-- form start -->
                <form role="form" enctype="multipart/form-data"

                      action="<?php echo base_url(); ?>admin/collateral/save_collateral_type/<?php
                      if (!empty($collateral_type_info->type_id)) {
                          echo $collateral_type_info->type_id;
                      }
                      ?>" method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                                <!-- /.Company Name -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Collateral Type <span class="required">*</span></label>
                                    <input type="text" required name="collateral_type" placeholder="Collateral Type"
                                           value="<?php
                                           if (!empty($collateral_type_info->collateral_type)) {
                                               echo $collateral_type_info->collateral_type;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <button type="submit" class="btn bg-navy btn-flat" type="submit">Save Type
                                </button><br/><br/>

                            <!-- /.box-body -->

                        </div>
                    </div>

                </form>
                    </div>
                <div class="box-footer">

                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                <table class="table table-bordered table-striped" id="dataTables-example">
                    <thead>
                    <tr>
                        <th class="active col-sm-1">#</th>
                        <th class="active">Collateral Type</th>
                        <th class=" active col-sm-2">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $key = 1 ?>
                    <?php if (!empty($all_collateral)): foreach ($all_collateral as $v_collateral_type) : ?><!--get all collateral_type if not this empty-->
                        <tr>
                            <td><?php echo $key ?></td>
                            <!--Serial No> -->
                            <td><?php echo $v_collateral_type->collateral_type ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo base_url().'admin/collateral/collateral_type/'. $v_collateral_type->type_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo base_url().'admin/collateral/delete_collateral_type/'. $v_collateral_type->type_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
                                </div>

                            </td>
                        </tr>
                    <?php
                    $key++;
                    endforeach;
                    ?><!--get all collateral_type if not this empty-->
                    <?php else : ?> <!--get error message if this empty-->
                        <td colspan="3">
                            <strong>There is no record for display</strong>
                        </td><!--/ get error message if this empty-->
                    <?php
                    endif; ?>
                    </tbody>
                </table>

                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>



