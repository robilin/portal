

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">Order Delivery Note</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">Print</a>
                    <a href="<?php echo base_url() ?>admin/order/pdf_delivery/<?php echo $invoice_info->invoice_no ?>" class="btn btn-default ">PDF</a>
                    <a href="<?php echo base_url() ?>admin/order/email_delivery/<?php echo $invoice_info->invoice_no ?>" class="btn btn-default " <?php
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
                        <h3 style="color: #00a7d0">DELIVERY NOTE NO: <?php echo $invoice_info->invoice_no ?></h3>
                        <div class="date">Date: <?php echo $this->localization->dateFormat($invoice_info->invoice_date) ?></div>
                            <?php if(!empty($order_info->payment_ref)){ ?>
                            <div class="date">Payment Reference: <?php echo $order_info->payment_ref ?></div>
                        <?php }?>

                    </div>

                </header>
         
                <hr/>
                <main>
                    <div id="details" class="clearfix">
                        <div id="client" style="margin-right: 100px">
                            <div class="to"><strong>CUSTOMER INFO:</strong></div>
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

                    <table  cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                        
                            <th class="no">S/No.</th>
                            <th class="desc"><b>Item</b></th>
                            <th class="unit"><b>Qty</b></th>
                            <th class="qty"><b>Unit</b></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1?>
                        <?php foreach($order_details as $v_order): ?>
                        <tr>                      
                            <td width="5%" class="no"><?php echo $counter ?></td>
                            <td class="desc"><h3><?php echo $v_order->product_name ?></h3></td>
                            <td class="unit"><?php echo $v_order->product_quantity ?></td>
                            <td class="qty"><?php echo $v_order->unit ?></td>
                        </tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>

                    </table>
                    <br>
                    <br>
                    <br>

                        <div class="date pull-left"><strong>Sales Person:</strong> <?php echo $order_info->sales_person ?></div>


                    <br/>

                </main>
                <hr/>
                <footer class="text-center">
                <table style="padding:20px" width="100% ">
    <tbody>
    	<tr>
        <td class="qty text-left"><strong>&nbsp;Inspected by</strong></td>
        <td class="qty text-left"><strong>&nbsp;Name:</strong><?php echo '..................................................................'?></td>
        <td class="qty text-left"><strong>&nbsp;Sign:</strong><?php echo '....................'?></td>
        </tr>
       <tr>
        <td class="qty text-left"><strong>&nbsp;Received and checked by</strong></td>
        <td class="qty text-left"><strong>&nbsp;Name:</strong><?php echo '..................................................................'?></td>
        
        <td class="qty text-left"><strong>&nbsp;Sign:</strong><?php echo '....................'?></td>
        </tr>
 </tbody></table>
                <footer class="text-center">
                    <strong><?php echo $this->localization->profile('company_name') ?></strong>&nbsp;&nbsp;&nbsp;<?php echo $this->localization->profile('address') ?>
                </footer>


            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->





