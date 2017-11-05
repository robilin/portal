<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">Order Invoice</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">Print</a>
                    <a href="<?php echo base_url() ?>admin/order/pdf_invoice/<?php echo $invoice_info->invoice_no ?>" class="btn btn-default ">PDF</a>
                    <a href="<?php echo base_url() ?>admin/order/email_invoice/<?php echo $invoice_info->invoice_no ?>" class="btn btn-default " <?php
                    echo $order_info->customer_email == '' ? 'disable':''
                    ?>>Email to Customer</a>
                </div>
            </div>

        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">


        <div id="printableArea">
            <link href="<?php echo base_url(); ?>asset/css/invoice.css" rel="stylesheet" type="text/css" />



            <div class="row ">


            <div class="col-md-10 col-md-offset-1">

                <header class="clearfix">
                    <div id="logo">
                        <img src="<?php echo $this->localization->profile('logo') ?>">
                    </div>
                    <div id="invoice">
                        <h3 style="color: #00a7d0">INVOICE <?php echo $invoice_info->invoice_no ?></h3>
                        <div class="date">Invoice Date: <?php echo $this->localization->dateFormat($invoice_info->invoice_date) ?></div>
                        <div class="date">Payment Method: <?php echo  ucwords($order_info->payment_method) ?></div>
                        <?php if(!empty($order_info->payment_ref)){ ?>
                            <div class="date">Payment Reference: <?php echo $order_info->payment_ref ?></div>
                        <?php }?>



                    </div>

                </header>
                <hr/>
                <main>
                    <div id="details" class="clearfix">
                        <div id="client" style="margin-right: 100px">
                            <div class="to"><strong>CUSTOMER BILLING INFO:</strong></div>
                            <h2 class="name"><?php echo $order_info->customer_name ?></h2>
                            <div class="address"><?php echo $order_info->customer_address ?></div>
                            <div class="address"><?php echo $order_info->customer_phone ?></div>
                            <div class="email"><?php echo $order_info->customer_email ?></div>
                        </div>
                        <?php if(!empty($order_info->shipping_address)):?>
                        <div id="shipping">
                            <div class="to"><strong>CUSTOMER SHIPPING INFO:</strong></div>

                            <div class="address"><?php
                                echo  nl2br($order_info->shipping_address);
                                ?></div>

                        </div>
                        <?php endif ?>


                    </div>


                    <?php if(!empty($order_info->note)){ ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tr>
                            <td>

                                <div><strong>Order Note:</strong></div>
                                <?php echo $order_info->note ?>

                            </td>
                        </tr>
                    </table>
                    <?php }?>

                    <table border="1" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th >#</th>
                            <th>Description</th>
                            <th >Unit price</th>
                            <th >Quantity</th>
                            <th >Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1?>
                        <?php foreach($order_details as $v_order): ?>
                        <tr>
                            <td ><?php echo $counter ?></td>
                            <td ><h3><?php echo $v_order->product_name ?></h3></td>
                            <th><?php echo $this->localization->currency($v_order->selling_price); ?></td>
                            <td ><?php echo $v_order->product_quantity ?></td>
                            <td ><?php echo $this->localization->currency($v_order->sub_total) ?></td>
                        </tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td align="right"><?php echo $this->localization->currency($order_info->sub_total) ?></td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tax</td>
                            <td><?php echo $this->localization->currency($order_info->total_tax) ?></td>
                        </tr>

                        <?php if($order_info->discount):?>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Discount Amount</td>
                                <td><?php echo $this->localization->currency($order_info->discount_amount) ?></td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Grand Total</td>
                            <td><?php echo $this->localization->currencyFormat($order_info->grand_total) ?></td>
                        </tr>
                        
                        </tfoot>
                    </table>
                    <table border="0">
                    <tfoot>
                       <tr> <?php if(!empty($order_info->change)&& $order_info->payment_method=='cash'){?>
                            <td><?php echo '*** Paid by cash '.$this->localization->currencyFormat((int)$order_info->cash_payment).' *********** '. 
                             'Change '.$this->localization->currencyFormat($order_info->change).' ****' ?></td>
                             <?php } else {?> <td></td> <?php } ?>
                      </tr>
                      </tfoot>
                     </table>
                    <br/>
                    <br/>
                    <br/>

                        <div class="date pull-left"><strong>Sales Person:</strong> <?php echo $order_info->sales_person ?></div>


                    <br/>

                </main>
                <hr/>
                <footer class="text-center">
                    <strong><?php echo $this->localization->profile('company_name') ?></strong>&nbsp;&nbsp;&nbsp;<?php echo $this->localization->profile('address') ?>
                </footer>


            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->





