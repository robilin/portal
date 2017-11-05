<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">Invoice</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">Print</a>
                    <a href="<?php echo base_url() ?>admin/account/pdf_invoice/<?php echo $invoice_info->invoice_no ?>" class="btn btn-default ">PDF</a>
              
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
                        <div class="date">Invoice Date: <?php echo $this->localization->dateFormat($invoice_info->invoice_creation_date) ?></div>
                        <div class="date">Payment Method: <?php echo  ucwords($invoice_info->payment_method) ?></div>
                        <div class="date">							
									   <?php
                                        if($invoice_info->status =='pending')
                                        { ?>
                                            <span class="label label-warning"><?php echo 'outstanding' ?></span>
                                        <?php } else { ?>
                                            <span class="label bg bg-olive"><?php echo 'paid' ?></span>
                                        <?php } ?>
                        </div>
                        <?php if(!empty($invoice_info->customer_name)){ ?>
                            <div class="date">Payment Reference: <?php echo $invoice_info->payment_ref ?></div>
                        <?php }?>



                    </div>

                </header>
                <hr/>
                <main>
                    <div id="details" class="clearfix">
                        <div id="client" style="margin-right: 100px">
                            <div class="to"><strong>CUSTOMER BILLING INFO:</strong></div>
                            <h2 class="name"><?php echo $invoice_info->customer_name ?></h2>
                            <div class="address"><?php echo $invoice_info->phone ?></div>
                            <div class="address"><?php echo $invoice_info->address ?></div>
                            
                        </div>
                        <?php if(!empty($invoice_info->shipping_address)):?>
                        <div id="shipping">
                            <div class="to"><strong>CUSTOMER SHIPPING INFO:</strong></div>

                            <div class="address"><?php
                                echo  nl2br($invoice_info->shipping_address);
                                ?></div>

                        </div>
                        <?php endif ?>


                    </div>


                    <?php if(!empty($invoice_info->note)){ ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tr>
                            <td>

                                <div><strong>Order Note:</strong></div>
                                <?php echo $invoice_info->note ?>

                            </td>
                        </tr>
                    </table>
                    <?php }?>

                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="no">#</th>
                            <th class="desc">Description</th>
                            <th class="unit">Price</th>
                            <th class="qty">Quantity</th>
                            <th class="total">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1;
                        	  $sum=0;
                        ?>
                        <?php foreach($invoice_details as $v_order): ?>
                        <tr>
                            <td class="no"><?php echo $counter ?></td>
                            <td class="desc"><h3>
                            	<?php echo $v_order->attribute_description ?>                                                
                            </h3></td>
                            <td class="unit"><?php echo $this->localization->currency($v_order->attribute_price); ?></td>
                            <td class="qty"><?php echo $v_order->attribute_quantity ?></td>
                            <td class="total"><?php echo $this->localization->currency($v_order->attribute_price) ?></td>
                        </tr>
                            <?php $counter ++
                            
                            ?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td align="right"><?php echo $this->localization->currency($total) ?></td>
                        </tr>
                       <?php 
                            if(!empty($invoice_info->total_tax)){?>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Tax</td>
                            <td>
                            	echo $this->localization->currency($invoice_info->total_tax);
                            </td>
                        </tr>
						<?php }?>
                        <?php if($invoice_info->discount_amount):?>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">Discount Amount</td>
                                <td><?php echo $this->localization->currency($invoice_info->discount_amount) ?></td>
                            </tr>
                        <?php endif; ?>

                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Grand Total</td>
                            <td><?php echo $this->localization->currencyFormat($total+$invoice_info->discount_amount) ?></td>
                        </tr>
                        
                        </tfoot>
                    </table>
                    <table border="0">
                    <tfoot>
                       <tr> <?php if(!empty($invoice_info->change)&& $invoice_info->payment_method=='cash'){?>
                            <td><?php echo '*** Paid by cash '.$this->localization->currencyFormat((int)$invoice_info->cash_payment).' *********** '. 
                             'Change '.$this->localization->currencyFormat($invoice_info->change).' ****' ?></td>
                             <?php } else {?> <td></td> <?php } ?>
                      </tr>
                      </tfoot>
                     </table>
                    <br/>
                    <br/>
                    <br/>

                        <div class="date pull-left"><strong>Created by:</strong> <?php echo $invoice_info->created_by ?></div>


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





