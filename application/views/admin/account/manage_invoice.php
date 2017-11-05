
<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Manage Invoice</h3>
                </div>



                <div class="box-body">


                    <div id="printableArea">
                        <!-- Table -->
                        <table id="datatable-responsive" class="table table-striped table-bordered datatable-buttons">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Sl</th>
                                <th class="active">Invoice No.</th>
                                <th class="active">Invoice Date</th>
                                <th class="active">Customer</th>
                                <th class="active">Payment Method</th>
                                <th class="active">Invoice Total</th>
                                <th class="active">Invoice Type</th>
                                <th class="active">Status</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($invoice)): foreach ($invoice as $v_invoice) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td highlight">
                                        <a href="<?php echo base_url()?>admin/account/order_invoice/<?php echo $v_invoice->invoice_no ?>">INV-<?php echo $v_invoice->customer_invoice_id ?></a>
                                    </td>
                                  
                                    <td class="vertical-td"><?php echo $v_invoice->invoice_creation_date ?></td>
                                    <td class="vertical-td"><?php echo $v_invoice->customer_name ?></td>
                                    <td class="vertical-td"><?php echo $v_invoice->payment_method ?></td>
                                    <td class="vertical-td currency"><?php echo $this->localization->currencyFormat($v_invoice->subtotal) ?></td>
									<td class="vertical-td"><?php echo $v_invoice->invoice_title ?></td>
									<td class="vertical-td">
																	
									   <?php
                                        if($v_invoice->status =='pending')
                                        { ?>
                                            <span class="label label-warning"><?php echo 'outstanding' ?></span>
                                        <?php } else { ?>
                                            <span class="label bg bg-olive"><?php echo 'paid' ?></span>
                                        <?php } ?>
									
									
									
									</td>
                                    <td class="vertical-td">

                                        <div class="btn-group dropdown">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                More                                  <span class="caret"></span>
                                            </button>

                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a href="<?php echo base_url()?>admin/account/order_invoice/<?php echo $v_invoice->invoice_no ?>"><i class="glyphicon glyphicon-search text-success"></i>View Invoice</a>
                                                </li>

                                                <li>
                                                    <a onclick="return confirm('You are about to confirm invoice...is it okay?');" href="<?php echo base_url()?>admin/account/confirm_invoice/<?php echo $v_invoice->customer_invoice_id ?>"><i class="fa fa-times-circle-o text-danger"></i><span class="text-danger">Confirm Invoice</span></a>
                                                </li>
                                                <li>
                                                    <a onclick="return confirm('Are you sure want to delete this invoice ?');" href="<?php echo base_url()?>admin/account/delete_invoice/<?php echo $v_invoice->invoice_no ?>"><i class="fa fa-times-circle-o text-danger"></i><span class="text-danger">Delete Invoice</span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>

                                </tr>
                            <?php
                                $counter++;
                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="8">
                                    <strong>There is no record for display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->
                        </div>

                </div><!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>



