<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title ">Add New vendor</h3>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addvendorForm"
                      action="<?php echo base_url(); ?>admin/asset/save_vendor/<?php if (!empty($vendor->vendor_id)) {
                          echo $vendor->vendor_id;
                      } ?>"
                      method="post">

                    <div class="row">

                        <div class="col-md-8 col-sm-12 col-xs-12">

                            <div class="box-body">

                                <!-- /.Company Name -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Company Name <span class="required">*</span></label>
                                    <input type="text" name="company_name" placeholder="Company Name"
                                           value="<?php
                                           if (!empty($vendor->company_name)) {
                                               echo $vendor->company_name;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Company Name -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">vendor Name <span class="required">*</span></label>
                                    <input type="text" name="vendor_name" placeholder="vendor Name"
                                           value="<?php
                                           if (!empty($vendor->vendor_name)) {
                                               echo $vendor->vendor_name;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Company Email -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email <span
                                            class="required">*</span></label>
                                    <input type="text" placeholder="Email" name="email"
                                           value="<?php
                                           if (!empty($vendor->email)) {
                                               echo $vendor->email;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Phone -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone<span class="required"> *</span></label>
                                    <input type="text" placeholder="Phone" name="phone"
                                           value="<?php
                                           if (!empty($vendor->phone)) {
                                               echo $vendor->phone;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Address -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address <span class="required">*</span></label>
                                    <textarea name="address" class="form-control autogrow" rows="10" id="ck_editor"
                                              placeholder="Business Address" required><?php
                                        if (!empty($vendor->address)) {
                                            echo $vendor->address;
                                        }
                                        ?></textarea>
                                    <?php echo display_ckeditor($editor['ckeditor']); ?>
                                </div>



                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn bg-navy btn-flat" type="submit">Add vendor
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>
