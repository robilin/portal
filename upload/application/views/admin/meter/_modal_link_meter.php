
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Assign meter # <?php echo $meter_id; ?> </h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;" id="myModal" tabindex="-1" role="dialog">


    <form method="post" id="OrderForm" action="<?php echo base_url().'admin/meter/save_meter_link/'.$meter_id ?>">
    
                                        <div class="form-group">
                                            <label>Tenant</label>
                                            <select required name="customer_id" class="form-control col-sm-5" id="order_status" >
                                                <option value="">Select Customer</option>
                                                <?php //$all_customer_info=$this->db->get('tbl_customer')->result();?>
                                                <?php if (!empty($all_customer_info)): ?>
                                                    <?php foreach ($all_customer_info as $v_customer) : ?>
                                                        <option value="<?php echo $v_customer->customer_id; ?>"
                                                            <?php
                                                            if (!empty($all_customer_info)) {
                                                                echo "" ? 'selected' : '';
                                                                                                                           }
                                                            ?> >
                                                            <?php echo $v_customer->first_name.' '.$v_customer->last_name; ?>
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
                                                       if (!empty($meter_info->meter_assigned_date)) {
                                                       	  $meter_assigned_date = date('Y/m/d', strtotime($meter_info->meter_assigned_date));
                                                          echo $meter_assigned_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="datepicker" required name="meter_assigned_date" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
        </br>

        <!--        Hidden text field-->
        <input type="hidden" value="<?php echo $meter_id  ?>" name="meter_id">
        
        <button type="submit" id="sbtn" class="btn-flat btn bg-olive btn-block"><strong>Save</strong></button>

    </form>

</div>

<script>
$(function () {
    $("#datepicker").datepicker();
   
});
</script>

