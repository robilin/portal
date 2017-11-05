
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Change Status</h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">

    <form method="post" id="OrderForm" action="<?php echo site_url("admin/loan/loan_confirmation") ?>">
        <div class="well well-sm">
            <div class="form-group">
                <label>Change Status</label>
                <select name="order_status" class="form-control" id="order_status">
                    <option value="">Select Status</option>
                    <option value="1">Approve</option>
                    <option value="2">Deny</option>
                    <option value="3">Pending</option>
                </select>
            </div>
        </div>


        <div class="well well-sm" id="shipping">
            <div class="row">
             
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Loan Note</label>
                        <textarea name="note" rows="4" class="form-control"><?php echo $loan->note ?></textarea>
                    </div>
                </div>

            </div>
        </div>


        <!--        Hidden text field-->
        <input type="hidden" value="<?php echo $loan->loan_id  ?>" name="loan_id">
        <input type="hidden" value="<?php echo $loan->loan_number  ?>" name="loan_number">

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