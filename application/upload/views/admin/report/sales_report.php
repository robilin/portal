
<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                    <div class="col-md-offset-3">
                        <h3 class="box-title ">Sales Report</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-background">
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/report/sales_report" method="post">

                        <div class="row">

                            <div class="col-md-4 col-sm-12 col-xs-12 col-md-offset-3">

                                    <div class="form-group">
                                        <label class="control-label">Start Date<span class="required"> *</span></label>

                                        <div class="input-group">
                                            <input type="text" value="" class="form-control datepicker" name="start_date" data-format="yyyy/mm/dd" required>

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">End Date<span class="required"> *</span></label>
                                        <div class="input-group">
                                            <input type="text" value="" class="form-control datepicker" name="end_date" data-format="yyyy/mm/dd" required>

                                            <div class="input-group-addon">
                                                <a href="#"><i class="entypo-calendar"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn bg-navy btn-flat" type="submit">Generate Report
                                    </button><br/><br/>

                                <!-- /.box-body -->

                            </div>
                        </div>

                    </form>
                </div>

                <?php if (!empty($invoice_details)) :?>
                <div class="box-body">

                    <div class="row ">
                        <div class="col-md-8 col-md-offset-2">
                            <form method="post" action="<?php echo base_url(); ?>admin/report/pdf_sales_report">
                            <div class="btn-group pull-right">
                                <a onclick="print_invoice('printableArea')" class="btn btn-primary">Print</a>

                                <button type="submit" class="btn bg-navy">
                                    PDF
                                </button>
                                    <input type="hidden" name="start_date" value="<?php echo $start_date ?>">
                                    <input type="hidden" name="end_date" value="<?php echo $end_date ?>">

                            </div>
                            </form>

                        </div>
                    </div>

                    <br/>
                    <br/>

                    <div id="printableArea">
                        <link href="<?php echo base_url(); ?>asset/css/sales_report.css" rel="stylesheet" type="text/css" />



                        <div class="row ">
                            <div class="col-md-8 col-md-offset-2">

                                <header class="clearfix">
                                    <div id="logo">
                                        <img src="<?php echo $this->localization->profile('logo') ?>">
                                    </div>
                                    <div id="company">
                                        <h2 class="name"><?php echo $this->localization->profile('company_name') ?></h2>
                                        <div><?php echo $this->localization->profile('company_phone') ?></div>
                                        <div><?php echo $this->localization->profile('company_email') ?></div>
                                    </div>

                                </header>
                                <hr/>

                                <main class="invoice_report">

                                    <h4>Sales Report from: <strong><?php echo $this->localization->dateFormat($start_date) ?></strong> to <strong><?php echo $this->localization->dateFormat($end_date) ?></strong></h4>
                                    <br/>
                                    <br/>

                                <?php
                                $key =0;
                                $total_cost=0;
                                $total_sell=0;
                                $total_tax = 0;
                                $total_discount =0 ;
                                $total_grand_total = 0;
                                $total_profit=0;
                                ?>
                                <?php if (!empty($invoice_details)): foreach ($invoice_details as $invoice_no => $order_details) : ?>
                                    <?php
                                    $total_buying_price =0;
                                    $total_selling_price =0;
                                    $order_discount =0;
                                    $order_tax = 0;
                                    ?>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th class="no text-right">INVOICE <?php echo $invoice_no  ?></th>
                                            <th class="desc">Invoice Date: <?php echo $this->localization->dateFormat($order[$key]->invoice_date) ?></th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <thead>
                                        <tr style="background-color: #ECECEC">
                                            <th class="no text-right">#</th>
                                            <th class="desc">Description</th>
                                            <th class="unit text-right">Buying Price</th>
                                            <th class="unit text-right">Selling Price</th>
                                            <th class="qty text-right">Qty</th>
                                            <th class="qty text-right">Tax</th>
                                            <th class="total text-right ">TOTAL</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $k =1;  ?>
                                    <?php if (!empty($order_details)): foreach ($order_details as $v_order) : ?>
                                            <tr>
                                                <td class="no"><?php echo $k ?></td>
                                                <td class="desc"><h3><?php echo $v_order->product_name ?></h3></td>
                                                <td class="unit"><?php echo $this->localization->currency($v_order->buying_price)  ?></td>
                                                <td class="unit"><?php echo $this->localization->currency($v_order->selling_price) ?></td>
                                                <td class="qty"><?php echo $v_order->product_quantity ?></td>
                                                <td class="qty"><?php echo $v_order->product_tax ?></td>
                                                <td class="total"><?php echo $this->localization->currency($v_order->sub_total + $v_order->product_tax)  ?></td>
                                            </tr>
                                        <?php $k++?>

                                        <?php
                                        $total_buying_price += $v_order->buying_price * $v_order->product_quantity;
                                        $total_selling_price += $v_order->selling_price;
                                        $order_tax += $v_order->product_tax;
                                        $total_tax += $v_order->product_tax;
                                        $total_cost += $v_order->buying_price * $v_order->product_quantity;
                                        ?>

                                        <?php
                                            endforeach;
                                            endif;
                                        ?>


                                        </tbody>
                                        <tfoot>

                                        <?php if($order[$key]->discount_amount !=0): ?>
                                            <tr>
                                                <td colspan="4"></td>
                                                <td colspan="2">Discount Amount</td>
                                                <td><?php echo $this->localization->currency($order[$key]->discount_amount) ?></td>
                                                <?php
                                                    $total_discount += $order[$key]->discount_amount;
                                                    $order_discount += $order[$key]->discount_amount;
                                                ?>
                                            </tr>
                                        <?php endif; ?>

                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2">Grand Total</td>
                                            <td><?php echo $this->localization->currencyFormat($order[$key]->grand_total) ?></td>
                                            <?php $total_grand_total += $order[$key]->grand_total ?>
                                        </tr>
                                        <?php
                                            
                                            $profit = $order[$key]->grand_total - $total_buying_price - $order_tax - $order[$key]->discount_amount;
                                            $total_profit += $profit;
                                        ?>
                                        <tr>
                                            <td colspan="4"></td>
                                            <td colspan="2">Profit</td>
                                            <td><?php echo $this->localization->currencyFormat($profit) ?></td>
                                        </tr>
                                        </tfoot>
                                        <?php
                                        $total_sell += $order[$key]->grand_total;
                                        ?>

                                    </table>
                                    <?php $key ++; ?>
                                <?php endforeach; endif; ?>

                                    <?php if(!empty($invoice_details)) :?>
                                    <table>
                                        <thead>
                                        <tr style="background-color: #ccc">
                                            <th class="no text-right">Total Cost</th>
                                            <th class="no text-right">Total Revenue</th>
                                            <th class="no text-right">Total Profit</th>
                                        </tr>
                                        </thead>
                                        <tbody style="background-color: #c5c5c5">
                                        <td class="total"><?php echo  $this->localization->currencyFormat( $total_cost) ?></td>
                                        <td class="total"><?php echo $this->localization->currencyFormat( $total_sell) ?></td>
                                        <td class="total"><?php echo $this->localization->currencyFormat( $total_profit) ?></td>
                                        </tbody>
                                    </table>

                                    <?php else: ?>
                                    <strong>There is no record for display</strong>
                                    <?php endif ?>



                                </main>
                                <hr/>
                                <footer class="text-center">
                                    <strong><?php echo $this->localization->profile('company_name') ?></strong>&nbsp;&nbsp;&nbsp;<?php echo $this->localization->profile('address') ?>
                                </footer>


                            </div>
                        </div>

                </div>


            </div>
            <!-- /.box -->
            <?php endif ?>
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>


