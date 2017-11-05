<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Add new customer</h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">

    <form method="post" id="OrderForm" >
       
       
       
        <div class="well well-sm">
              <!-- /.customer Code -->
                                <?php if (!empty($customer->customer_code)) {?>
                                    <div class="form-group">
                                        <label>Customer Id</label>
                                        <input type="text"
                                               value="<?php echo $customer->customer_code ?>"
                                               class="form-control" disabled>
                                    </div>
                                <?php }else { ?>

                                    <div class="form-group">
                                        <label>Customer Id<span class="required">*</span></label>
                                        <input type="text"
                                               value="<?php echo $code ?>"
                                               class="form-control" disabled>
                                    </div>

                                <?php } ?>
        </div>


        <div class="well well-sm" >
                    
                    <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Name/Company name <span class="required">*</span></label>
                                    <input type="text" required name="customer_name" placeholder="Customer Name"
                                           value="<?php
                                           if (!empty($customer->customer_name)) {
                                               echo $customer->customer_name;
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
                                           if (!empty($customer->email)) {
                                               echo $customer->email;
                                           }
                                           ?>"
                                           class="form-control">
                  </div>
                  
                  <!-- /.Phone -->
                  <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" placeholder="Phone" name="phone" onchange="check_phone(this.value)"
                                           value="<?php
                                           if (!empty($customer->phone)) {
                                               echo $customer->phone;
                                           }
                                           ?>"
                                           class="form-control">
                                    <div style=" color: #E13300" id="phone_result"></div>
                 </div>
        

  				<!-- /.Discount -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Discount %</label>
                                    <input type="text" placeholder="Discount" name="discount"
                                           value="<?php
                                           if (!empty($customer->discount)) {
                                               echo $customer->discount;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>

                                <!-- /.Address -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address <span class="required">*</span></label>
                                    <textarea name="address" class="form-control autogrow"
                                              placeholder="Address" rows="2"><?php
                                        if (!empty($customer->address)) {
                                            echo $customer->address;
                                        }
                                        ?></textarea>

                                </div>

               </div>
               
               <!-- customer code -->
                    <?php if (empty($customer->customer_code)) {?>
                        <input type="hidden" name="customer_code"
                               value="<?php echo $code ?>">
                    <?php }  ?>

                    <!-- customer id -->
                    <input type="hidden" name="customer_id" value="<?php if (!empty($customer->customer_id)) {
                        echo $customer->customer_id;
                    } ?>" id="customer_id">


        <button type="submit" id="sbtn" class="btn-flat btn bg-olive btn-block"><strong>Save</strong></button>

    </form>

</div>


<script>
$(function () {
    $('#OrderForm').on('submit',function (e) {

              $.ajax({
                type: 'post',
                url: '<?php echo base_url(); ?>admin/customer/save_customer_modal/<?php if (!empty($customer->customer_id)) {
                    echo $customer->customer_id;
                } ?>',
                data: $('#OrderForm').serialize(),
                success: function () {
                 alert("Data has been sent!");
                 $('#OrderForm').hide();
                 $('#myModalLabel').hide();
                             
                }
              });
          e.preventDefault();
        });
});
</script>