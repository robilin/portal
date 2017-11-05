
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Assign meter to customer # <?php echo $customer_id; ?> </h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;" id="myModal" tabindex="-1" role="dialog">


    <form method="post" id="OrderForm" action="<?php echo base_url().'admin/meter/save_meter_link/'.$customer_id ?>">
    
                                        <div class="form-group">
                                            <label>Meters</label>
                                            <select required name="customer_id" class="form-control col-sm-5" id="order_status" >
                                                <option value="">Select Meter</option>
                                         
                                                <?php if (!empty($meter_info)): ?>
                                                    <?php foreach ($meter_info as $v_meter) : ?>
                                                        <option value="<?php echo $v_meter->meter_id; ?>"
                                                            <?php
                                                            if (!empty($meter_info)) {
                                                                echo "" ? 'selected' : '';
                                                                                                                           }
                                                            ?> >
                                                            <?php echo $v_meter->meter_number.' '.$v_meter->meter_type; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                              
        </br>

        <!--        Hidden text field-->
        <input type="hidden" value="<?php echo $customer_id  ?>" name="customer_id">
        
        <button type="submit" id="sbtn" class="btn-flat btn bg-olive btn-block"><strong>Save</strong></button>

    </form>

</div>

