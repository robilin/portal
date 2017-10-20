<style>
    footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
    }
</style>
<table style="padding:20px" width="100%">
    <tbody>

    <tr>
        <td width="50%" align="left" style="padding-bottom: 35px; border-bottom:1px solid #ededed">
            <img src="<?php echo $this->localization->profile('logo') ?>">
        </td>

        <td width="50%" align="right" style="padding-bottom: 35px; border-bottom:1px solid #ededed">
            <span style="font-size:30px; color:#00A7D0"><strong>INV<?php echo $invoice_info->invoice_no ?></strong></span>
            <br/>
            <spna>Invoice Date: <?php echo $this->localization->dateFormat($invoice_info->invoice_creation_date )?></spna>
            <br/>
            <spna>Payment Method: <?php echo  ucwords($invoice_info->payment_method) ?></spna>
            <br/>
            <?php if(!empty($invoice_info->payment_ref)){ ?>
                <span>Payment Reference: <?php echo $invoice_info->payment_ref ?></span>
            <?php }?>
        </td>

    </tr>



    <tr>
        <td width="50%" align="left" style="padding-top: 35px;">
            <span style="color: #353535"><strong>CUSTOMER BILLING INFO:</strong></span><br/>
            <span><?php echo $invoice_info->customer_name ?></span><br/>
            <span><?php echo $invoice_info->address ?></span><br/>
            <span><?php echo $invoice_info->phone ?></span><br/>
        </td>

        <td width="50%" align="right" style="padding-top: 35px;">
            <?php if(!empty($invoice_info->shipping_address)):?>

            <span style="color: #353535"><strong>CUSTOMER SHIPPING INFO:</strong></span><br/>

                     <span>
                         <?php
                          echo  nl2br($invoice_info->shipping_address);
                         ?>
                     </span>

            <?php endif ?>
        </td>
    </tr>

    </tbody>
</table>


<?php if(!empty($invoice_info->note)){ ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" style="padding:20px">
        <tr>
            <td style="text-align: right; background-color: #f7f7f7">

                <div><strong>Order Note:</strong></div>
                <?php echo $invoice_info->note ?>

            </td>
        </tr>
    </table>
<?php }?>


<table style="padding:20px" width="100%">
    <tbody><tr style="background:#ededed">
        <th style="padding:20px">Sl</th>
        <th style="padding:20px">Description</th>
        <th>UNIT</th>
        <th style="width: 50px">Qty</th>
        <th style="width: 100px">TOTAL</th>
    </tr>

    <?php $counter = 1?>
    <?php foreach($invoice_details as $v_order): ?>

    <tr align="center">
        <td style="border-bottom:1px solid #ededed;padding:20px">
            <?php echo $counter ?>
        </td>

        <td style="border-bottom:1px solid #ededed;padding:20px">
            <?php echo $v_order->attribute_description ?>
        </td>

        <td style="border-bottom:1px solid #ededed; text-align:right; width: 100px">
            <?php echo $this->localization->currency($v_order->attribute_price); ?>
        </td>

        <td style="border-bottom:1px solid #ededed; text-align:right; width: 50px">
            <?php echo $v_order->attribute_quantity ?>
        </td>
        <td style="border-bottom:1px solid #ededed; text-align:right; width: 150px">
            <?php echo $this->localization->currency($v_order->subtotal) ?>
        </td>
    </tr>

        <?php $counter ++?>
    <?php endforeach; ?>

    <tr align="center">
        <th style="padding:20px"></th>
        <th style="padding:20px"></th>

        <th style="border-bottom:1px solid #ededed; text-align: right" colspan="2">SUBTOTAL</th>
        <th style="background:#efeded; text-align: right" ><?php echo $this->localization->currency($total) ?></th>
    </tr>
    <?php 
        if(!empty($invoice_info->total_tax)){?>
    <tr align="center">
        <th style="padding:20px"></th>
        <th style="padding:20px"></th>

        <th style="border-bottom:1px solid #ededed; text-align: right" colspan="2">TAX</th>
        <th style="background:#efeded; text-align: right"><?php echo $this->localization->currency($invoice_info->total_tax) ?></th>
    </tr>
    <?php }?>
    <?php if($invoice_info->discount):?>
    <tr align="center">
        <th style="padding:20px"></th>
        <th style="padding:20px"></th>
        <th style="border-bottom:1px solid #ededed; text-align: right" colspan="2">DISCOUNT</th>
        <th style="background:#efeded; text-align: right"><?php echo $this->localization->currency($invoice_info->discount_amount) ?></th>
    </tr>
    <?php endif; ?>

    <tr align="center">
        <th style="padding:20px"></th>
        <th style="padding:20px"></th>
        <th style="border-bottom:1px solid #ededed; text-align: right" colspan="2">GRAND TOTAL</th>
        <th style="background:#efeded; text-align: right"><?php echo $this->localization->currencyFormat($total) ?></th>
    </tr>

    </tbody></table>






<table style="padding:20px" width="100%">
    <tbody><tr>
        <td><strong>Created by:</strong> <?php echo $invoice_info->created_by ?></td>
    </tr>
    </tbody></table>




</br>
<footer class="text-center">
    <strong><?php echo $this->localization->profile('company_name') ?></strong>&nbsp;&nbsp;&nbsp;<?php echo $this->localization->profile('address') ?>
</footer>