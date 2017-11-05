<script src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>

<?php $cart = $this->cart->contents() ; ?>


<div class="box-body">

    <div class="row">

        <div class="col-md-12">

                <div class="input-group">
                      <span class="input-group-btn">
                        <button type="submit" class="btn bg-blue" type="button" data-placement="top" data-toggle="tooltip">Customer</button>
                      </span>
                      
                    <select id="customer" style="width: 100%;" name="customer" onchange="getCustomer(this)">
                        <option value="">Select Customer</option>
                        <?php  $customer = $this->db->get('tbl_customer')->result(); ?>
                        <?php if (!empty($customer)): ?>
                            <?php foreach ($customer as $item) : ?>
                                <option value="<?php echo $item->customer_id; ?>" <?php echo $this->session->userdata('customer_id') == $item->customer_id ?'selected':'' ?>>
                                    <?php echo $item->customer_name ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select><span class="input-group-btn">
                        <button type="submit" class="btn bg-blue" type="button" data-placement="top" data-toggle="tooltip" onclick="getCustomer(this)" data-original-title="Refresh to retrieve new added customer">refresh</button>
                      </span>
                    
                    <input type="hidden" name="customer_flag" value="customer">
                </div>
                <hr>
               <a href="<?php echo base_url()?>admin/customer/quick_customer_add_during_order" data-target="#modalSmall" data-toggle="modal"><i class="glyphicon glyphicon-edit"></i><span>New Customer</span></a>
             </div>
    </div>
</div>

<form method="post" action="<?php echo base_url()?>admin/order/save_order">

        <div class="box-background" id="order">
            
                <div class="row">

                    <div class="col-md-12">
 						 <div class="form-group">
                            <label class="col-sm-5 control-label">Order no:</label>

                            <div class="col-sm-7">
                                <input type="text" value="<?php echo $this->session->userdata('order_no'); ?>" disabled class="form-control ">
                            </div>
                        </div>

                       <div class="form-group">
                            <label class="col-sm-5 control-label">Sub Total</label>

                            <div class="col-sm-7">
                                <input type="text" value="<?php
                                if(empty($cart)){
                                    echo $this->localization->currency(0.00);
                                }else{ echo $this->localization->currency($this->cart->total());  }

                                ?>" disabled  class="form-control unite">
                            </div>
                        </div>

                        <?php $total_tax = 0.00 ?>
                        <?php if (!empty($cart)): foreach ($cart as $item) : ?>
                            <?php $total_tax += $item['tax'] ?>
                        <?php endforeach; endif ?>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Tax</label>

                            <div class="col-sm-7">
                                <input type="text" value="<?php
                                if(empty($cart)){
                                    echo $this->localization->currency(0.00);
                                }else {
                                    echo $this->localization->currency($total_tax) ;
                                }
                                ?>" disabled class="form-control unite">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Discount</label>

                            <div class="col-sm-7">
                                <?php $discount = $this->session->userdata('discount') ?>
                                <div class="input-group">
                                    <input type="number" class="form-control" onchange="discountValue(this.value)"
                                           value="<?php if(!empty($discount)) {echo $discount ; }else{ echo '0'; }?>" >
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 5px"></div>


                        <?php if(!empty($discount)): ?>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Discount Amount</label>

                            <div class="col-sm-7">
                                <?php
                                $cart_total = $this->cart->total();
                                $discount_amount = (($cart_total + $total_tax) * $discount ) /100;
                                ?>
                                <input type="text" value="<?php echo $this->localization->currency($discount_amount);
                                ?>" disabled class="form-control unite">
                            </div>
                        </div>
                    <?php endif ?>





                    </div>


                </div>

            
            <!-- /.box-body -->
        </div>

    <?php $cart_total = $this->cart->total();
    if(!empty($discount)){
        $grand_total = $cart_total + $total_tax - $discount_amount;
    }else{
        $grand_total = $cart_total + $total_tax;
    }
    ?>

        
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-sm-4 control-label" style="padding-top: 5px; font-size: 15px">Grand Total :</label>

                        <div class="col-sm-8">
                            <h3><?php
                                if(empty($cart)){
                                    echo $this->localization->currencyFormat(0.00) ;
                                }else {
                                    echo $this->localization->currencyFormat($grand_total) ;
                                }
                                ?></h3>
                        </div>
                    </div>
                </div>
            </div>
   

        <div class="box-background">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Paid by</label>

                            <div class="col-sm-7">
                                <select name="payment_method" class="form-control" id="order_payment_type">
                                   <option value="">Select payment</option>
                                    <option value="cash">Cash Payment</option>
                                    <option value="invoice">Invoice Payment</option>
                                    
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="display: none" id="payment">

                        <div class="form-group">
                            <label class="col-sm-5 control-label">cheque/card Ref.</label>

                            <div class="col-sm-7">
                                <input class="form-control" name="payment_ref">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: none" id="cashpayment">

                        <div class="form-group">
                            <label class="col-sm-5 control-label">Paid</label>

                            <div class="col-sm-7">
                                <input class="form-control" name="cash_payment" id="cash_payment" >
                            </div>
                            <label class="col-sm-5 control-label"><h2>Change</h2></label>
                            
                            <div class="col-sm-7" id="change" style="font-size:30px">
                                
                            </div>
                        </div>
                    </div>
                      <div class="col-md-12" style="display: none" id="giftcard">

                        <div class="form-group">
                            <label class="col-sm-5 control-label">card no</label>

                            <div class="col-sm-7">
                                <input class="form-control" name="gift_card_no" id="gift_card_no" onchange="check_giftcard_no(this.value)">
                               <div style=" color: #E13300" id="giftcard_result"></div>
                            </div>
                            
                        </div>
                      
                    </div>

                    <div class="col-md-12 order-panel"  id="shipping">
                            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                <li class="active"><a href="#shipping_address" data-toggle="tab">Shipping</a></li>
                                <li><a href="#note" data-toggle="tab">Order Note</a></li>
                            </ul>
                        <div id="my-tab-content" class="tab-content">

                            <!-- ***************  Cart Tab Start ****************** -->
                                <div class="tab-pane active" id="shipping_address">
                                    <div class="form-group">
                                        <label>Shipping Address</label>
                                        <?php
                                                $address = $this->session->userdata('address');
                                                $breaks = array("<br />","<br>","<br/>");
                                                $address = str_ireplace($breaks, "", $address);
                                        ?>
                                        <textarea class="form-control" rows="4" name="shipping_address" placeholder="Enter ..." ><?php if(!empty($address)) echo $address ?></textarea>

                                    </div>
                                </div>
                                <div class="tab-pane" id="note">
                                    <div class="form-group">
                                        <label>Order Note</label>
                                        <textarea class="form-control" name="note" rows="4" placeholder="Enter ..."></textarea>

                                    </div>
                                </div>


                    </div>


                </div>
            </div>
        </div>


        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" id="btn_order" class="btn bg-navy btn-block btn-flat " type="submit" <?php echo !empty($cart)?'':'disabled' ?>>Submit Order
                    </button>
                </div>
            </div>
        </div>

            <!-- hidden field -->

            <input type="hidden" name="customer_id" value="<?php  echo $this->session->userdata('customer_code') ?>">
            <input type="hidden" value="<?php echo $this->session->userdata('order_no'); ?>" name="order_no">
            <input type="hidden" value="<?php echo $grand_total; ?>" name="grand_total">
            <input type="hidden" value="<?php echo $total_tax; ?>" name="total_tax">
            <!-- <input type="hidden" value="cash_payment" name="cash_payment"> -->
            <input type="hidden" value="<?php if(!empty($discount_amount)) echo $discount_amount ; ?>" name="">
            <input type="hidden" value="<?php if(!empty($discount)) {echo number_format($discount, 0, '.', ',') ; }else{ echo '0'; }
            ?>" name="discount">
</form>

<script>
    $(document).ready(function() {

        $('.box-body').css({"border-top":"0px solid #ccc"});

        $("#customer").select2({
            placeholder: "Select a State",
            allowClear: true
        });

        $('input').on('change', function() {

        	 $('#change').text(parseInt($('input[name=cash_payment]').val())-parseInt($('input[name=grand_total]').val()));                    

          });
     
     

    });

</script>