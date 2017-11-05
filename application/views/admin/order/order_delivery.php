<style>
.invoice-title h2, .invoice-title h3 {
    display: inline-block;
}

.table > tbody > tr > .no-line {
    border-top: none;
}

.table > thead > tr > .no-line {
    border-bottom: none;
}

.table > tbody > tr > .thick-line {
    border-top: 2px solid;
}
</style>

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

   <div class="box-header box-header-background with-border">
        <h3 class="box-title">Delivery Note</h3>
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
    
     <div id="printableArea">
            <link href="<?php echo base_url(); ?>asset/css/invoice.css" rel="stylesheet" type="text/css" />

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		
    		
    		<div class="row">
    		<div class="col-md-10 col-md-offset-1">
    		      
                        
                    
    		<address>
    		
    		   <p align="right"><img src="<?php echo $this->localization->profile('logo') ?>"><br><br><strong><?php echo $this->localization->profile('company_name') ?></strong><br>
    		    <?php echo $this->localization->profile('address') ?></p>
    		</address>
    		
    		</div>
    		</div>
    		
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Customer Info:</strong><br>
    					<?php echo $order_info->customer_name ?><br>
    					<?php echo $order_info->customer_address ?><br>
    					<?php echo $order_info->customer_phone ?><br>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    			<?php if(!empty($order_info->shipping_address)):?>
    				<address>
    				
        			<strong>Shipping Address:</strong><br>
    					<?php
                                echo  nl2br($order_info->shipping_address);
                         ?>
    				</address>
    				<?php endif ?>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					
    					
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    				    <strong>Deilvery Note #<?php echo $invoice_info->invoice_no ?></strong><br>
    					<strong>Order Date:</strong><br>
    					<?php echo $this->localization->dateFormat($invoice_info->invoice_date) ?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed table-bordered">
    						<thead>
                                <tr>
                                <td><strong>#</strong></td>
        							<td><strong>Item</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-center"><strong>Quantity</strong></td>
        							<td class="text-center"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<?php $counter = 1?>
                              <?php foreach($order_details as $v_order): ?>
    							<tr>
    							  <td><?php echo $counter ?></td>
    								<td class="text-left"><?php echo $v_order->product_name ?></td>
    								<td class="text-left"><?php echo $this->localization->currency($v_order->selling_price); ?></td>
    								<td class="text-left"><?php echo $v_order->product_quantity ?></td>
    								<td class="text-left"><?php echo $this->localization->currency($v_order->sub_total)?></td>
    							</tr>
                                <?php $counter ++?>
                        		<?php endforeach; ?>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right"><?php echo $this->localization->currency($order_info->sub_total) ?></td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Tax</strong></td>
    								<td class="no-line text-right"><?php echo $this->localization->currency($order_info->total_tax) ?></td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total</strong></td>
    								<td class="no-line text-right"><?php echo $this->localization->currencyFormat($order_info->grand_total) ?></td>
    							</tr>
    						</tbody>
    					</table>
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
    				</div>
    				
    			</div>
    		</div>
    	</div>
    </div>
</div>
</div>