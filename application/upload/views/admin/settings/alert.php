<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<?php $info = $this->session->userdata('business_info'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <div class="col-md-offset-3">
                        <h3 class="box-title ">Manage Alert Rules</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-background">
                <!-- form start -->
                <form role="form" enctype="multipart/form-data"

                      action="<?php echo base_url(); ?>admin/settings/save_alert/<?php
                      if (!empty($alert->alert_id)) {
                          echo $alert->alert_id;
                      }
                      ?>" method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                                <!-- /.alert title -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enter days <span class="required">*</span></label>
                                    <input type="text" required name="days" placeholder="days"
                                           value="<?php
                                           if (!empty($alert->days)) {
                                               echo $alert->days;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

					<!-- /.alert type -->
                                <div class="form-group">
                                    <label>Alert Type <span class="required">*</span></label>
                                    <select required name="alert_type" class="form-control col-sm-5">
                                        <option value="">Select Alert Type</option>
                                        <option value="1" <?php
                                        if(!empty($alert->alert_type)){
                                            echo $alert->alert_type==1 ?'selected':'';
                                        } ?>>Expire alert days</option>

                                        <option value="2" <?php

                                        if(!empty($alert->alert_type)){
                                            echo $alert->alert_type==2 ?'selected':'';
                                        }

                                        ?>>Inventory Alert 
                                        </option>
                                    </select>
                                </div>
</br></br>
                                <button type="submit" class="btn bg-navy btn-flat" type="submit">Save alert Rule
                                </button>
                            <!-- /.box-body -->
</br>
</br>
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
                        <th class="active">SL</th>
                        <th class="active">Alert days</th>
                        <th class="active">Alert type</th>
                        <th class="col-sm-2 active">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $key = 1 ?>
                    <?php if (!empty($alert_info)): foreach ($alert_info as $v_alert_info) : ?>
                        <tr>
                            <td><?php echo $key ?></td>
                            <td><?php echo $v_alert_info->days ?></td>
                            <td><?php if(($v_alert_info->alert_type)==1){
                            	echo 'Expire alert days';
                            }else{
                            	echo 'Inventory alert';
                            } ?></td>
                            <td>
                                <?php echo btn_edit('admin/settings/alert/' . $v_alert_info->alert_id); ?>
                                <?php echo btn_delete('admin/settings/delete_alert/' . $v_alert_info->alert_id); ?>
                            </td>

                        </tr>
                    <?php
                    $key++;
                    endforeach;
                    ?><!--get all category if not this empty-->
                    <?php else : ?> <!--get error message if this empty-->
                        <td colspan="5">
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



