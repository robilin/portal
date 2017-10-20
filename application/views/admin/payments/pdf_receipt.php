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
            <span style="font-size:30px; color:#00A7D0"><strong>Loan #<?php echo  $loan_number ?></strong></span>
            <br/>
            <spna>Collection Date: <?php echo $this->localization->dateFormat($collection_date)?></spna>
            <br/>
            <spna>Repayment Method: <?php echo ucwords($repayment_method) ?></spna>
            <br/>
                <span>Payment Reference: <?php echo $loan_status ?></span>
        </td>
    </tr>

    <tr>
        <td width="50%" align="left" style="padding-top: 10px;">
            <span style="color: #353535"><strong>Borrower Info:</strong></span><br/>
            <span><?php echo $first_name ?></span><br/>
            <span><?php echo $phone ?></span><br/>
            <span><?php echo $address ?></span><br/> 
        </td>
 
    </tr>

    </tbody>
</table>
<table style="padding:10px" width="100%">
                                    <tbody>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Released</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $loan_release_date ?></td>
                                       </tr>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Maturity</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $maturity_date ?></td>
                                       </tr>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Repayment</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $loan_repayment_cycle ?></td>
                                       </tr>                                   
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Principal</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $this->localization->currencyFormat($principal_amount) ?></td>
                                       </tr>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px">Interest %</td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $loan_interest_percent.'%/'.$loan_interest_period_scheme ?></td>
                                       </tr>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Interest</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $this->localization->currencyFormat($loan_interest) ?></td>
                                       </tr>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Fees</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $this->localization->currencyFormat($loan_fees) ?></td>                                                                                     	                                           
                                       </tr>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Penalty</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $this->localization->currencyFormat($loan_penalty) ?></td>
                                       </tr>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Due</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $this->localization->currencyFormat($amount_due) ?></td>
                                       </tr>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Paid</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $this->localization->currencyFormat($paid_amount)?></td>
                                       </tr>
                                       <tr align="center">
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><b>Balance</b></td>
                                          <td style="border-bottom:1px solid #ededed;padding:20px"><?php echo $this->localization->currencyFormat($balance_amount) ?></td>
                                       </tr>
                                       <tr>
        								 <td><strong>Collected by:</strong> <?php echo $collected_by ?></td>
    									</tr>
                                    </tbody>
                                 </table>

<footer class="text-center">
    <strong><?php echo $this->localization->profile('company_name') ?></strong>&nbsp;&nbsp;&nbsp;<?php echo $this->localization->profile('address') ?>
</footer>