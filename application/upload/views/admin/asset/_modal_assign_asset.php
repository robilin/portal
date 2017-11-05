
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Assign asset</h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;" id="myModal" tabindex="-1" role="dialog">


    <form method="post" id="OrderForm" action="<?php echo site_url("admin/asset/save_asset_assign") ?>">
    
                                        <div class="form-group">
                                            <label>Employee</label>
                                            <select required name="asset_assigned_to" class="form-control col-sm-5" id="order_status" >
                                                <option value="">Select Employee</option>
                                                <?php if (!empty($all_employee_info)): ?>
                                                    <?php foreach ($all_employee_info as $v_employee) : ?>
                                                        <option value="<?php echo $v_employee->name; ?>"
                                                            <?php
                                                            if (!empty($all_employee_info)) {
                                                                echo "" ? 'selected' : '';
                                                                                                                           }
                                                            ?> >
                                                            <?php echo $v_employee->name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        
                                               <!-- /.from -->
                                            <div class="form-group form-group-bottom">
                                                <label class="required">From </label>
                                                </div>
                                                <div class="input-group" >
                                                <input type="text"
                                                       value="<?php
                                                       if (!empty($asset_info->asset_assigned_date)) {
                                                       	  $asset_assigned_date = date('Y/m/d', strtotime($asset_info->asset_assigned_date));
                                                          echo $asset_assigned_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="datepicker" required name="asset_assigned_date" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
        </br>

        <!--        Hidden text field-->
        <input type="hidden" value="<?php echo $asset->asset_id  ?>" name="asset_id">
        
        <button type="submit" id="sbtn" class="btn-flat btn bg-olive btn-block"><strong>Save</strong></button>

    </form>

</div>

<script>
$(function () {
    $("#datepicker").datepicker();
   
});
</script>

