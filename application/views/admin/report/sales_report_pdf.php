
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style>

body {
    position: relative;
    width: 19cm;
    height: 29.7cm;
    margin: 0 auto;
    color: #555555;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
    font-size: 14px;
    font-family: SourceSansPro;
}

header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #AAAAAA;
}


.clearfix:after {
    content: "";
    display: table;
    clear: both;
}

a {
    color: #0087C3;
    text-decoration: none;
}


#logo {
    float: left;
    margin-top: 8px;
    display: inline-block;
    width: 40%;
}

#logo img {
    height: auto;
    width: auto;
}

#company {
    float: right;
    text-align: right;
    display: inline-block;
    width: 60%;
}


#details {
    margin-bottom: 50px;
}

#client {
    padding-left: 6px;
    border-left: 6px solid #0087C3;
    display: inline-block;
    width: 29%;
    float: left;

}

#shipping {
    padding-left: 6px;
    display: inline-block;
    width: 29%;
    float: left;
}

#client .to {
    color: #777777;
}

h2.name {
    font-size: 1.4em;
    font-weight: normal;
    margin: 0;
}

#invoice {
    display: inline-block;
    text-align: right;
    width: 37%;
    float: right;
}

#invoice h1 {
    color: #0087C3;
    font-size: 2.4em;
    line-height: 1em;
    font-weight: normal;
    margin: 0  0 10px 0;
}

#invoice .date {
    font-size: 1.1em;
    color: #777777;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px;
}

table th,
table td {
    padding: 0px 5px;
    /*background: #EEEEEE;*/
    text-align: center;
    border-bottom: 1px solid #ccc;
}

table th {
    white-space: nowrap;
    font-weight: normal;
}

table td {
    text-align: right;
}

table td h3{
    color: #000;
    font-size: 1.2em;
    font-weight: normal;
    margin: 0 0 0.2em 0;
}

table .no {
    color: #000;
    font-size: 1.1em;
    /*background: #C4CBC2;*/
}

table .desc {
    text-align: left;
    font-size: 10px;
}

table .unit {
    /*background: #DDDDDD;*/
}

table .qty {
}

table .total {
    /*background: #DDD;*/
    color: #000;
}

table td.unit,
table td.qty,
table td.total {
    font-size: 1.0em;
}

table tbody tr:last-child td {
    border: none;
}

table tfoot td {
    padding: 1px 5px 1px;
    background: #FFFFFF;
    border-bottom: none;
    font-size: 1.2em;
    white-space: nowrap;
    border-top: 1px solid #AAAAAA;
}

table tfoot tr:first-child td {
    border-top: none;
    /*border-bottom: none;*/

}

table  tr:last-child {
    /*border-top: none;*/
    border-bottom: 1px solid #ccc;
}

table  tfoot tr:last-child {
    border-bottom: none;
}

table tfoot tr:last-child td {
    color: #000;
    font-size: 1.2em;
    border-top: 1px solid #ccc;

}

table tfoot tr td:first-child {
    border: none;
}

#thanks{
    font-size: 2em;
    margin-bottom: 30px;
}

#notices{
    padding-left: 6px;
    border-left: 6px solid #0087C3;
}

#notices .notice {
    font-size: 1.2em;
}



/*  SECTIONS  */
.section {
    clear: both;
    padding: 0px;
    margin: 0px;
}

/*  COLUMN SETUP  */
.col {
    display: block;
    float:left;
    margin: 1% 0 1% 1.6%;
}
.col:first-child { margin-left: 0; }

/*  GROUPING  */
.group:before,
.group:after { content:""; display:table; }
.group:after { clear:both;}
.group { zoom:1; /* For IE 6/7 */ }

/*  GRID OF FOUR  */
.span_4_of_4 {
    width: 100%;
}
.span_3_of_4 {
    width: 74.6%;
}
.span_2_of_4 {
    width: 49.2%;
}
.span_1_of_4 {
    width: 23.8%;
}

/*  GO FULL WIDTH BELOW 480 PIXELS */
@media only screen and (max-width: 480px) {
    .col {  margin: 1% 0 1% 0%; }
    .span_1_of_4, .span_2_of_4, .span_3_of_4, .span_4_of_4 { width: 100%; }
}


</style>


</head>
<body>

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
                <th class="desc">Invoice Date: <?php echo $this->localization->dateFormat($order[$key]->invoice_date ) ?></th>
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
            <?php $k =1?>
            <?php if (!empty($order_details)): foreach ($order_details as $v_order) : ?>
                <tr>
                    <td class="desc"><?php echo $k ?></td>
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
                    <td class="total" colspan="2">Discount Amount</td>
                    <td class="total"><?php echo $this->localization->currency($order[$key]->discount_amount) ?></td>
                    <?php
                    $total_discount += $order[$key]->discount_amount;
                    $order_discount += $order[$key]->discount_amount;
                    ?>
                </tr>
            <?php endif; ?>

            <tr>
                <td colspan="4"></td>
                <td class="total" colspan="2">Grand Total</td>
                <td class="total"><?php echo $this->localization->currencyFormat($order[$key]->grand_total ,2) ?></td>
                <?php $total_grand_total += $order[$key]->grand_total ?>
            </tr>
            <?php
            $profit = $order[$key]->grand_total - $total_buying_price - $order_tax - $order[$key]->discount_amount;
            $total_profit += $profit;
            ?>
            <tr>
                <td colspan="4"></td>
                <td class="total" colspan="2">Profit</td>
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

    <?php else: ?>
        <strong>There is no record for display</strong>
    <?php endif ?>


    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
            <tr style="background-color: #ECECEC">
                <th align="right">Total Cost</th>
                <th align="right">Total Revenue</th>
                <th align="right">Total Profit</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td align="right"> <?php echo $this->localization->currencyFormat( $total_cost) ?></td>
                <td align="right"> <?php echo $this->localization->currencyFormat( $total_sell) ?></td>
                <td align="right"> <?php echo $this->localization->currencyFormat( $total_profit) ?></td>
            </tr>


        </tbody>
        </table>

</main>




</body>
</html>