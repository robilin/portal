<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">

                        <h3 class="box-title ">branches</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-background">
                <!-- form start -->
                <form role="form" enctype="multipart/form-data"

                      action="<?php echo base_url(); ?>admin/settings/save_branch/<?php
                      if (!empty($branch_info->branch_id)) {
                          echo $branch_info->branch_id;
                      }
                      ?>" method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

<table>
<tbody>
<tr><td>
                                <!-- /.Company Name -->
                                <div class="form-group">
                                    <branchel for="exampleInputEmail1">Branch Name <span class="required">*</span></branchel>
                                    <input type="text" required name="branch_name" placeholder="Branch Name"
                                           value="<?php
                                           if (!empty($branch_info->branch_name)) {
                                               echo $branch_info->branch_name;
                                           }
                                           ?>"
                                           class="form-control">
                                  </div>
</td><td>
                                  <!-- /.Company Name -->
                                <div class="form-group">
                                    <branchel for="exampleInputEmail1">Branch Location <span class="required">*</span></branchel>
                                    <input type="text" required name="branch_location" placeholder="Branch Location"
                                           value="<?php
                                           if (!empty($branch_info->branch_location)) {
                                               echo $branch_info->branch_location;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>
</td>
</tr>
</tbody>
</table>

                                <button type="submit" class="btn bg-navy btn-flat" type="submit">Save Branch</button><br/><br/>

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
                        <th class="active col-sm-1">SL</th>
                        <th class="active">Branch Name</th>
                        <th class="active">Branch Location</th>
                        <th class=" active col-sm-2">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $key = 1 ?>
                    <?php if (!empty($all_branch)): foreach ($all_branch as $v_branch) : ?><!--get all branch if not this empty-->
                        <tr>
                            <td><?php echo $key ?></td>
                            <!--Serial No> -->
                            <td><?php echo $v_branch->branch_name ?></td>
                            <td><?php echo $v_branch->branch_location ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo base_url().'admin/settings/branch/'. $v_branch->branch_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo base_url().'admin/settings/delete_branch/'. $v_branch->branch_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
                                </div>

                            </td>
                        </tr>
                    <?php
                    $key++;
                    endforeach;
                    ?><!--get all branch if not this empty-->
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



