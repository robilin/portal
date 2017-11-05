<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">

                        <h3 class="box-title "><?php echo $title.' '.ucwords($type) ?></h3>

                </div>
                <!-- /.box-header -->
                <div class="box-background">
                <!-- form start -->
                <form role="form" enctype="multipart/form-data"

                      action="<?php echo base_url(); ?>admin/money_manager/save_category/<?php
                      if (!empty($category_info->money_manager_category_id)) {
                          echo $category_info->money_manager_category_id;
                      }
                      ?>" method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                                <!-- /.Company Name -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Category <span class="required">*</span></label>
                                    <input type="text" required name="category_name" placeholder="Category Name"
                                           value="<?php
                                           if (!empty($category_info->category_name)) {
                                               echo $category_info->category_name;
                                           }
                                           ?>"
                                           class="form-control">
                                           
                                           
                                </div>
                                   <?php if(!empty($type)&& ($type=='income' || $type=='budget')){?>
                                    <div class="form-group"> 
                                    <label for="exampleInputEmail1"> Category Type or Id <span class="required">*</span></label>                                 <!-- /.Category -->
                                    <input type="text" required name="category_type" placeholder="Category type"
                                           value="<?php
                                           if (!empty($type)) {
                                               echo ucfirst($type);
                                           }
                                           ?>"
                                           class="form-control" readonly>           
                                    </div>
									<?php }else {?>
									 <div class="form-group">
                                        
                                            <select required name="category_type" class="form-control col-sm-5" id="category_type" >
                                                <option value="">Select type</option>
                                                <option value="income">Income</option>
                                                <option value="budget">Budget</option>
                                            </select>
                                        </div>
                                        <?php }?>
                                   <br>
                                <button type="submit" class="btn bg-navy btn-flat" type="submit">Save Category
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
                        <th class="active">Category Name</th>
                        <th class="active">Category Type</th>
                        <th class=" active col-sm-2">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $key = 1 ?>
                    <?php if (!empty($all_category)): foreach ($all_category as $v_category) : ?><!--get all category if not this empty-->
                        <tr>
                            <td><?php echo $key ?></td>
                            <!--Serial No> -->
                            <td><?php echo $v_category->category_name ?></td>
                            <td><?php echo $v_category->category_type ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?php echo base_url().'admin/money_manager/category/'. $v_category->money_manager_category_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo base_url().'admin/money_manager/delete_category/'. $v_category->money_manager_category_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
                                </div>

                            </td>
                        </tr>
                    <?php
                    $key++;
                    endforeach;
                    ?><!--get all category if not this empty-->
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



