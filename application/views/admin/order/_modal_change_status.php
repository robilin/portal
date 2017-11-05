
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Change Status</h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">

    <form method="post" id="OrderForm" action="<?php echo site_url("admin/order/order_confirmation") ?>">
        <div class="well well-sm">
            <div class="form-group">
                <label>Change Status</label>
                <select name="order_status" class="form-control" id="order_status">
                    <option value="">Select Status</option>
                    <option value="2">Confirm Order</option>
                    <option value="1">Cancel Order</option>
                </select>
            </div>
        </div>


        <div class="well well-sm" id="shipping" style="display: none">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Shipping Address</label>
                        <textarea name="shipping_address" rows="4" class="form-control"><?php echo $order->shipping_address ?></textarea>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Order Note</label>
                        <textarea name="note" rows="4" class="form-control"><?php echo $order->note ?></textarea>
                    </div>
                </div>

            </div>
        </div>


        <!--    Credit Card Payment-->
        <div class="well well-sm" id="payment" style="display: none">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Payment Type</label>
                       <select class="form-control" name="payment_method" id="payment_method">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="cheque">cheque</option>
                       </select>
                    </div>

                    <div style="display: none" id="payment_ref">
                        <div class="form-group">
                            <label>Payment Ref.</label>
                            <input type="text" class="form-control" id="payment_ref" name="payment_ref">
                        </div>
                    </div>

                </div>
            </div>
        </div>



        <table class="table table-bordered">
            <tr>
                <td class="active"><strong>Grand Total</strong></td>
                <td><strong><?php echo  number_format($order->grand_total,2)  ?></strong></td>
            </tr>
        </table>

        <!--        Hidden text field-->
        <input type="hidden" value="<?php echo $order->order_id  ?>" name="order_id">
        <input type="hidden" value="<?php echo $order->order_no  ?>" name="order_no">

        <button type="submit" id="sbtn" class="btn-flat btn bg-olive btn-block"><strong>Save</strong></button>

    </form>

</div>


<script>
    $('#modalSmall').on('loaded.bs.modal', function () {


        $(function() {


            $('#order_status').change(function(){
                var val = $( "#order_status" ).val();

                if(val == '2')
                {
                    $('#payment').show();
                    $('#shipping').show();

                }
               else
                {
                    $('#payment').hide();
                    $('#shipping').hide();
                }
            });


            $('#payment_method').change(function(){
                var val = $( "#payment_method" ).val();

                if(val == 'cheque')
                {
                    $('#payment_ref').show();
                }
                else if (val == 'card')
                {
                    $('#payment_ref').show();


                } else
                {
                    $('#payment_ref').hide();
                }
            });

        });



    });
</script>