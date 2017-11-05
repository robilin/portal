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
    notes{
    
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center
    
    }
</style>
<table style="padding:20px" width="100%" border="0">
    <tbody>
    <tr><td align="center" colspan="2"> <center></center><pre><span style="font-size:18px; color:#00A7D0" ><strong>DELIVERY NOTE <?php echo $invoice_info->invoice_no ?></strong></span></pre></center></td></tr>
    <tr>
        <td align="center" colspan="2">
        <img src="<?php echo $this->localization->profile('logo') ?>">
        <br>GAA HOLDINGS (T) LTD
            <br>Dealers in: Surgical,Hospital,School Equipments and General supplies
			<br>Magila/ndanda Street,kariakoo area, 
			<br>P.O.Box 5458, Dar es salaam, Tanzania 
			<br>Mob: +255 784 643 064/+255 713 009 339/+255 767 643 068 
			<br>Email: gaagideon@gmail.com 
			<br>www.gaaholdingstz.com 
		</td>
    </tr>
    <tr>
        <td width="50%" align="left" style="padding-bottom: 35px; border-bottom:1px solid #ededed">
            <?php "" ?>
            </td>

        <td width="50%" align="right" style="padding-bottom: 35px; border-bottom:1px solid #ededed">
            
            <br/>
            <spna>Date: <?php echo $this->localization->dateFormat($invoice_info->invoice_date )?></spna>
            <br/>
            <spna>Tin no: <?php echo '106-722-544' ?></span>
            <br/>
            <?php if(!empty($order_info->payment_ref)){ ?>
                <span>Payment Reference: <?php echo $order_info->payment_ref ?></span>
            <?php }?>
        </td>
    </tr>



    <tr>
        <td width="50%" align="left" style="padding-top: 35px;">
            <span style="color: #353535"><strong>Customer billing info:</strong></span><br/>
            <span><?php echo $order_info->customer_name ?></span><br/>
            <span><?php echo $order_info->customer_address ?></span><br/>
            <span><?php echo $order_info->customer_phone ?></span><br/>
            <span><?php echo $order_info->customer_email ?></span><br/>
        </td>

        <td width="50%" align="right" style="padding-top: 35px;">
            <?php if(!empty($order_info->shipping_address)):?>

            <span style="color: #353535"><strong>Customer shipping info:</strong></span><br/>

                     <span>
                         <?php
                          echo  nl2br($order_info->shipping_address);
                         ?>
                     </span>

            <?php endif ?>
        </td>
    </tr>

    </tbody>
</table>


<?php if(!empty($order_info->note)){ ?>
    <table width="100%" border="0" cellspacing="0" cellpadding="5" style="padding:20px">
        <tr>
            <td style="text-align: right; background-color: #f7f7f7">

                <div><strong>Order Note:</strong></div>
                <?php echo $order_info->note ?>

            </td>
        </tr>
    </table>
<?php }?>


<table style="padding:5px " width="100%" border="1">
    <tbody><tr style="background:#ededed border:1px">
        <th style="padding:20px">No.</th>
        <th style="padding:20px">Item</th>
        <th style="width: 50px">Qty</th>
        <th style="width: 100px">Unit</th>
    </tr>

    <?php $counter = 1?>
    <?php foreach($order_details as $v_order): ?>

    <tr align="center">
        <td style="border-bottom:1px solid #ededed;padding:20px">
            <?php echo $counter ?>
        </td>

        <td style="border-bottom:1px solid #ededed;padding:20px">
            <?php echo $v_order->product_name ?>
        </td>
        <td style="border-bottom:1px solid #ededed; text-align:right; width: 50px">
            <?php echo $v_order->product_quantity ?>
        </td>
        <td style="border-bottom:1px solid #ededed; text-align:right; width: 150px">
            <?php echo $v_order->unit ?>
        </td>
    </tr>

        <?php $counter ++?>
    <?php endforeach; ?>



    </tbody></table>
    

<table style="padding:40px" width="100% ">
    <tbody>
    	<tr>
        <td><strong>GAA Inspector</strong></td>
        <td><strong>Name:</strong><?php echo '.................................'?></td>
        <td><strong>Sign:</strong><?php echo '.................................'?></td>
        </tr>
       <tr>
        <td><strong>Received and checked by</strong></td>
        <td><strong>Name:</strong><?php echo '.................................'?></td>
        
        <td><strong>Sign:</strong><?php echo '.................................'?></td>
        </tr>
 </tbody></table>




<footer class="text-center">
    <strong><?php echo $this->localization->profile('company_name') ?> OFFERS THE BEST</strong>
    <br>Karibu Tena!
</footer>