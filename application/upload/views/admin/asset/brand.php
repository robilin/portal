<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">

                        <h3 class="box-title ">Asset brand</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-background">
                <!-- form start -->
                <form role="form" enctype="multipart/form-data"

                      action="<?php echo base_url(); ?>admin/asset/save_brand/<?php
                      if (!empty($brand_info->asset_brand_id)) {
                          echo $brand_info->asset_brand_id;
                      }
                      ?>" method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                                <!-- /.Company Name -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Asset Brand <span class="required">*</span></label>
                                    <input type="text" required name="brand_name" placeholder="Brand Name"
                                           value="<?php
                                           if (!empty($brand_info->brand_name)) {
                                               echo $brand_info->brand_name;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <button type="submit" class="btn bg-navy btn-flat" type="submit">Save Asset brand
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
                        <th class="active col-sm-1">SL</th>
                        <th class="active">Brand Name</th>
                        <th class=" active col-sm-2">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $key = 1 ?>
                    <?php if (!empty($all_brand)): foreach ($all_brand as $v_brand) : ?><!--get all brand if not this empty-->
                        <tr>
                            <td><?php echo $key ?></td>
                            <!--Serial No> -->
                            <td><?php echo $v_brand->brand_name ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo base_url().'admin/asset/brand/'. $v_brand->asset_brand_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo base_url().'admin/asset/delete_brand/'. $v_brand->asset_brand_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
                                </div>

                            </td>
                        </tr>
                    <?php
                    $key++;
                    endforeach;
                    ?><!--get all brand if not this empty-->
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



