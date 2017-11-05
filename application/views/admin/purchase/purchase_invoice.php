

<div class="box">
    <div class="box-header box-header-background with-border">
        <h3 class="box-title">Purchase Invoice</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <div class="box-tools">
                <div class="btn-group" role="group" >
                    <a onclick="print_invoice('printableArea')" class="btn btn-default ">Print</a>
                    <a href="<?php echo base_url() ?>admin/purchase/pdf_invoice/<?php echo $purchase->purchase_id ?>" class="btn btn-default ">PDF</a>
                </div>
            </div>

        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">


        <div id="printableArea">
            <link href="<?php echo base_url(); ?>asset/css/invoice.css" rel="stylesheet" type="text/css" />
        <div class="row ">
            <div class="col-md-8 col-md-offset-2">
                <main >
                    <div id="details" class="clearfix">
                        <div id="client">
                            <div class="to">SUPPLIER:</div>
                            <h2 class="name"><?php echo $purchase->company_name ?></h2>
                            <div class="address"><?php echo $purchase->address ?></div>
                            <div class="address"><?php echo $purchase->phone ?></div>
                            <div class="email"><?php echo $purchase->email ?></div>
                        </div>
                        <div id="invoice">
                            <h1>PUR<?php echo $purchase->purchase_order_number ?></h1>
                            <div class="date">Date of Invoice: <?php echo $this->localization->dateFormat($purchase->datetime ) ?></div>
                            <div class="date">Purchase by: <?php echo $purchase->purchase_by ?></div>
                            <div class="date">Purchase by: <?php echo $purchase->purchase_by ?></div>
                            <?php if(!empty($purchase->purchase_ref)){?>
                            <div class="date">Purchase Ref: <?php echo $purchase->purchase_ref ?></div>
                            <?php }?>

                        </div>
                    </div>
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
                        <?php foreach($product as $v_product): ?>
                        <tr>
                            <td class="no"><?php echo $counter ?></td>
                            <td class="desc"><h3><?php echo $v_product->product_name ?></h3></td>
                            <td class="unit"><?php echo $this->localization->currency($v_product->unit_price); ?></td>
                            <td class="qty"><?php echo $v_product->qty ?></td>
                            <td class="total"><?php echo $this->localization->currency($v_product->sub_total) ?></td>
                        </tr>
                            <?php $counter ++?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td><?php echo $this->localization->currencyFormat($purchase->grand_total) ?></td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td><?php echo $this->localization->currencyFormat($purchase->grand_total) ?></td>
                        </tr>
                        </tfoot>
                    </table>

                </main>


            </div>
        </div>
            </div>


    </div><!-- /.box-body -->
</div><!-- /.box -->





