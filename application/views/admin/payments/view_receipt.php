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
                    <a href="<?php echo base_url() ?>admin/loan/pdf_invoice/<?php echo $loan_number ?>" class="btn btn-default ">PDF</a>
              
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
                        <h5 style="color: #00a7d0">Loan # <?php echo $loan_number ?></h5>
                        <div class="date">Collection Date: <?php echo $this->localization->dateFormat($collection_date) ?></div>
                        <div class="date">Repayment Method: <?php echo  ucwords($repayment_method) ?></div>
                        <div class="date">				
                                  <span class="label label-warning"><?php echo $loan_status ?></span>          
                        </div>
                       
                    </div>

                </header>
                <hr/>
                <main>
                    <div id="details" class="clearfix">
                        <div id="client" style="margin-right: 100px">
                            <div class="to"><strong>Borrowe Info:</strong></div>
                            <h2 class="name"><?php echo $first_name ?></h2>
                            <div class="address"><?php echo $phone ?></div>
                            <div class="address"><?php echo $address ?></div>
                            
                        </div>

                    </div>


                    <?php if(!empty($comment)){ ?>
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tr>
                            <td>

                                <div><strong>Comments:</strong></div>
                                <?php echo $comments ?>

                            </td>
                        </tr>
                    </table>
                    <?php }?>

 <table class="table" class="table-striped table-hover table-condensed">
                                    <tbody>
                                       <tr>
                                          <td><b>Released</b></td>
                                          <td><?php echo $loan_release_date ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Maturity</b></td>
                                          <td><?php echo $maturity_date ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Repayment</b></td>
                                          <td><?php echo $loan_repayment_cycle ?></td>
                                       </tr>                                   
                                       <tr>
                                          <td><b>Principal</b></td>
                                          <td><?php echo $this->localization->currencyFormat($principal_amount) ?></td>
                                       </tr>
                                       <tr>
                                          <td>Interest %</td>
                                          <td><?php echo $loan_interest_percent.'%/'.$loan_interest_period_scheme ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Interest</b></td>
                                          <td><?php echo $this->localization->currencyFormat($loan_interest) ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Fees</b></td>
                                          <td><?php echo $this->localization->currencyFormat($loan_fees) ?></td>                                                                                     	                                           
                                       </tr>
                                       <tr>
                                          <td><b>Penalty</b></td>
                                          <td><?php echo $this->localization->currencyFormat($loan_penalty) ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Due</b></td>
                                          <td><?php echo $this->localization->currencyFormat($amount_due) ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Paid</b></td>
                                          <td><?php echo $this->localization->currencyFormat($paid_amount)?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Balance</b></td>
                                          <td><?php echo $this->localization->currencyFormat($balance_amount) ?></td>
                                       </tr>
                                    </tbody>
                                 </table>
                    <table border="0">
                    <tfoot>
                       <tr> 
                            <td><?php echo ' *********** Payment received '.$this->localization->currencyFormat($repayment_amount).' *********** ' ?></td>
                      </tr>
                      </tfoot>
                     </table>
                    <br/>
                    <br/>
                    <br/>

                        <div class="date pull-left"><strong>Collected by:</strong> <?php echo $collected_by ?></div>


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





