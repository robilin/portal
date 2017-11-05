
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
                        <h3 class="box-title ">Sales Summery Report</h3>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-background">
                    <!-- form start -->
                    <form role="form" enctype="multipart/form-data" action="<?php echo base_url() ?>admin/report/sales_summery_report" method="post">

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

                <?php if (!empty($invoice_details)){ ?>

                    <div class="box-body">

                        <!-- Table -->
                        <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active col-sm-1">Sl</th>
                                <th class="active">Invoice Date</th>
                                <th class="active">Invoice No</th>
                                <th class="active">Buying Cost</th>
                                <th class="active">Selling Cost</th>
                                <th class="active">Tax</th>
                                <th class="active">Discount</th>
                                <th class="active">Grand Total</th>
                                <th class="active">Profit</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->


                    <?php
                        $k =1;
                        $key =0;
                    ?>
                    <?php if (!empty($invoice_details)): foreach ($invoice_details as $invoice_no => $order_details) : ?>

                        <?php
                        $key =0;
                        $total_buying =0;
                        $total_selling=0;
                        $total_tax=0;
                        $total_cost=0;
                        $total_profit=0;
                        ?>

                        <?php foreach ($order_details as $v_order) {

                            $total_buying  += $v_order->buying_price * $v_order->product_quantity;
                            $total_selling += $v_order->selling_price * $v_order->product_quantity;
                            $total_tax     += $v_order->product_tax;
                            $order_id = $v_order->order_id;
                        }

                        $result = $this->db->get_where('tbl_order', array(
                            'order_id' => $order_id
                        ))->row();

                        $total_profit  = $result->grand_total - $total_buying - $total_tax - $result->discount_amount ;
                        ?>



                                <tr class="custom-tr">
                                    <td class="vertical-td"><?php echo $k ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->dateFormat($order[$key]->invoice_date) ?></td>
                                    <td class="vertical-td"><?php echo $invoice_no ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($total_buying) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($total_selling) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($total_tax) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($result->discount_amount) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($result->grand_total) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($total_profit) ?></td>

                                </tr>


                        <?php $k++?>
                        <?php $key++?>
                        <?php
                    endforeach;
                    endif;
                    ?>


                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->

                    </div><!-- /.box-body -->
                <?php } ?>
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>


