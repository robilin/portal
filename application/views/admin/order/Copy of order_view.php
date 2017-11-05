<script src="<?php echo base_url(); ?>asset/js/ajax.js" xmlns="http://www.w3.org/1999/html"></script>

<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">View Order</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">Print</a>

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
                        <h3 style="color: #00a7d0">ORDER <?php echo $order_info->order_no ?></h3>
                        <div class="date">Date of Order: <?php echo $this->localization->dateFormat($order_info->order_date)  ?></div>
                        <div class="date">Sales Person: <?php echo $order_info->sales_person ?></div>


                        <?php if($order_info->order_status == 1){ ?>
                            <!-- cancel Order-->
                            <div class="date">Order Status: <?php echo '<span class="label label-danger">Cancel Order</span>' ?></div>
                        <?php } elseif($order_info->order_status == 0){ ?>
                            <div class="date">Order Status: <?php echo '<span class="label label-warning">Pending Order</span>' ?></div>
                          <?php } else{ ?>
                            <!-- confirm Order-->
                            <div class="date">Order Status: <?php echo '<span class="label label-primary">Confirm Order</span>' ?></div>
                        <?php } ?>

                    </div>

                </header>
                <hr/>

                <main>
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
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th class="no text-right">#</th>
                            <th class="desc">DESCRIPTION</th>
                            <th class="unit text-right">UNIT PRICE</th>
                            <th class="qty text-right">QUANTITY</th>
                            <th class="total text-right ">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $counter = 1?>
                        <?php foreach($order_details as $v_order): ?>
                        <tr>
                            <td class="no"><?php echo $counter ?></td>
                            <td class="desc"><h3><?php echo $v_order->product_name ?></h3></td>
                            <td class="unit"><?php echo $this->localization->currency($v_order->selling_price); ?></td>
                            <td class="qty"><?php echo $v_order->product_quantity ?></td>
                            <td class="total"><?php echo $this->localization->currency($v_order->sub_total) ?></td>
                        </tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td><?php echo $this->localization->currency($order_info->sub_total) ?></td>
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
                            <td colspan="2">GRAND TOTAL</td>
                            <td><?php echo $this->localization->currencyFormat($order_info->grand_total) ?></td>
                        </tr>
                        </tfoot>
                    </table>

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





