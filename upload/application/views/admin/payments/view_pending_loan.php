<script src="<?php echo base_url(); ?>asset/js/ajax.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php $info = $this->session->userdata('business_info'); ?>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-header box-header-background with-border">
               <h3 class="box-title "><?php echo $customer_info->title.' '.$customer_info->first_name.' '.$customer_info->second_name.' '.$customer_info->last_name." - View All Loans" ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- Top box begins -->
            <div class="box-body">
               <div class="row">
              <div class="user-panel">
                <div class="pull-left image">
                    <?php if(!empty($customer_info->borrowers_photo_name)){ ?>
                    <img src="<?php echo base_url() .$customer_info->borrowers_photo_name ?>" class="img-circle" alt="User Image" />
                    <?php }else{ ?>
                        <img src="<?php echo base_url()  ?>img/user.jpg" class="img-circle" alt="User Image" />
                    <?php }?>
                </div>
            </div>
                  <div class="col-md-6 col-md-offset-2">
                     <strong>Customer account:</strong>  <?php echo $customer_info->borrower_account ?>
                  </div>
                  <div class="col-md-4">
                     <strong>Gender:</strong>  <?php echo $customer_info->gender ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 col-md-offset-2">
                     <strong>Borrower name:</strong>  <?php echo $customer_info->first_name.' '.$customer_info->second_name.' '.$customer_info->last_name ?>
                  </div>
                  <div class="col-md-4 ">
                     <strong>Phone:</strong>  <?php echo $customer_info->phone ?>
                  </div>
               </div>
               <div class="box-body">
                  <div class="row">
                     <div class="col-md-6">
                        <a  href="<?php echo base_url(); ?>admin/loan/add_loan/<?php echo $customer_info->customer_id; ?>" class="addAttribute btn btn-info "><i class="fa fa-plus"></i> Add Loan</a>                  
                     </div>
                     <?php if($loan_info->approval==0){?>
                      <div class="col-md-6">
                        <a  href="<?php echo base_url(); ?>admin/loan/loan_confirmation/<?php echo $loan_info->loan_id; ?>" class="addAttribute btn btn-success pull-right"><i class="fa fa-check"></i> Approve</a>                  
                     </div>
                     <?php }elseif($loan_info->approval==1){?>
                     <div class="col-md-6">
                        <a  href="#" class="addAttribute btn btn-warning pull-right"><i class="fa fa-check"></i>Approved</a>                  
                     </div>
                     <?php }elseif($loan_info->approval==2){?>
                     <div class="col-md-6">
                        <a  href="#" class="addAttribute btn btn-danger pull-right"><i class="fa fa-check"></i>Rejected</a>                  
                     </div>
                     <?php }?>
                  </div>
               </div>
               <br>
            </div>
            <!-- loan iformation table beginns here -->
            <div class="box-body">
               <!-- Table -->
               <table class="table table-hover table-bordered table-responsive">
                  <thead >
                     <!-- Table head -->
                     <tr>
                        <th class="active col-sm-1">Sl</th>
                        <th class="active">Loan #</th>
                        <th class="active">Released</th>
                        <th class="active">Maturity</th>
                        <th class="active">Principal</th>
                        <th class="active">Interest % </th>
                        <th class="active">Interest</th>
                        <th class="active">Fees </th>
                        <th class="active">Penalty</th>
                        <th class="active">Due</th>
                        <th class="active">Paid</th>
                        <th class="active">Balance</th>
                        <th class="active">Status</th>
                        <th class="active">Approval</th>
                        <th class="active">Actions</th>
                     </tr>
                  </thead>
                  <!-- / Table head -->
                  <tbody>
                     <!-- / Table body -->
                     <?php   
                        $loan_info = $this->db->get_where('tbl_loan',array('loan_id'=>$loan_info->loan_id))->result();
                          	?>
                     <?php $counter =1 ; ?>
                     <?php if (!empty($loan_info)): foreach ($loan_info as $v_loan) : ?>
                     <tr class="custom-tr">
                        <td class="vertical-td">
                           <?php echo  $counter ?>
                        </td>
                        <td class="vertical-td" width="17%"><?php echo $v_loan->loan_number ?></td>
                        <td class="vertical-td"><?php echo $v_loan->loan_release_date ?></td>
                        <td class="vertical-td"><?php echo $v_loan->maturity_date ?></td>
                        <td class="vertical-td"><?php echo $this->localization->currency($v_loan->principal_amount) ?></td>
                        <td class="vertical-td"><?php echo $v_loan->loan_interest_percent.'%'.'/'. $v_loan->loan_interest_period_scheme ?></td>
                        <td class="vertical-td"><?php echo $v_loan->loan_interest ?></td>
                        <td class="vertical-td"><?php echo $this->localization->currency($v_loan->loan_fees) ?></td>
                        <td class="vertical-td"><?php echo $this->localization->currency($v_loan->loan_penalty) ?></td>
                        <td class="vertical-td"><?php echo $this->localization->currency($v_loan->amount_due) ?></td>
                        <td class="vertical-td"><?php echo $this->localization->currency($v_loan->paid_amount) ?></td>
                        <td class="vertical-td"><?php echo $this->localization->currency($v_loan->balance_amount) ?></td>
                        <td class="vertical-td">
                           <?php
                              if((int)$v_loan->balance_amount >0)
                              { ?>
                           <span class="label label-danger"><?php echo 'open' ?></span>
                           <?php } else { ?>
                           <span class="label bg-olive"><?php echo 'Fully Paid' ?></span>
                           <?php } ?>
                        </td>
                         <td class="vertical-td">
                           			<?php
                              		if((int)$v_loan->approval==1)
                              		{ ?>
                           			<span class="label label-success"><?php echo 'Approved' ?></span>
                           			<?php } elseif((int)$v_loan->approval==0){ ?>
                          			 <span class="label label-warning"><?php echo 'Pending' ?></span>
                           		   <?php }elseif ((int)$v_loan->approval==2) {?>
                           		   	<span class="label label-danger"><?php echo 'Rejected' ?></span>
                           		   <?php }else {?>
                           		   <span class="label label-info"><?php echo 'Processing' ?></span>
                           		   <?php }?>
                        			</td>
                        <td class="vertical-td" width="30%">
                           <div class="btn-group">
                              <a href="<?php echo base_url().'admin/loan/edit_loan/'. $v_loan->loan_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                              <?php if((int)$v_loan->approval==0)
                              		{ ?>
                              <a href="<?php echo base_url().'admin/loan/loan_confirmation/'.$v_loan->loan_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-check"></i></a> 
                              <?php }elseif((int)$v_loan->approval==1){?>
                              <a href="<?php echo base_url().'admin/loan/loan_cancellation/'.$v_loan->loan_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-times"></i></a>
                              <?php } ?>             
                           </div>
                        </td>
                     </tr>
                     <?php
                        $counter++;
                        endforeach;
                        ?><!--get all sub category if not this empty-->
                     <?php else : ?> <!--get error message if this empty-->
                     <td colspan="7">
                        <strong>There is no record for display</strong>
                     </td>
                     <!--/ get error message if this empty-->
                     <?php endif; ?>
                  </tbody>
                  <!-- / Table body -->
               </table>
               <!-- / Table -->
            </div>
            <!-- ******* Loan information table eds here ******* -->
            <!-- Tabs definition section begins here -->
            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
               <li class="<?php if(!empty($tab)){ echo 'active';} ?>"><a href="#repayments" data-toggle="tab">Repayments</a></li>
               <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#terms" data-toggle="tab">Loan Terms</a></li>
               <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#schedule" data-toggle="tab">Loan Schedule</a></li>
               <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#pending" data-toggle="tab">Pending Dues</a></li>
               <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#collateral" data-toggle="tab">Loan Collateral</a></li>
               <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#files" data-toggle="tab">Loan Files</a></li>
               <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#comments" data-toggle="tab">Loan Comments</a></li>
            </ul>
            <!-- *****Tabs definition section ends here***** -->
            <!-- Tab implementation begins here by creating outer row -->
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <!-- ******* Tab container begins here********* -->
                  <div id="my-tab-content" class="tab-content">
                     <!-- ***************  General Tab Start ****************** -->
                     <div class="tab-pane <?php if(!empty($tab)){ echo 'active';} ?>" id="repayments">
                        <div class="box-body">
                           <!-- /.add repayment button -->
                           <div class="row">
                              <div class="col-md-12">
                                 <a  href="<?php echo base_url(); ?>admin/loan/add_repayment/<?php echo $v_loan->loan_id; ?>" class="addAttribute btn btn-info " data-target="#modalSmall" data-toggle="modal"><i class="fa fa-plus"></i> Add Repayment</a>                  
                              </div>
                           </div>
                        </div>
                        <div class="box-body">
                           <!-- Table -->
                           <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                              <thead >
                                 <!-- Table head -->
                                 <tr>
                                    <th class="active col-sm-1">Sl</th>
                                    <th class="active">Collection Date</th>
                                    <th class="active">Collected By</th>
                                    <th class="active">Method</th>
                                    <th class="active">Amount</th>
                                    <th class="active">Action</th>
                                    <th class="active">Receipt</th>
                                 </tr>
                              </thead>
                              <!-- / Table head -->
                              <tbody>
                                 <!-- / Table body -->
                                 <?php   
                                    $loan_repayment = $this->db->get_where('tbl_loan_repayment',array('loan_id'=>$v_loan->loan_id))->result();
                                      	?>
                                 <?php $counter =1 ; ?>
                                 <?php if (!empty($loan_repayment)): foreach ($loan_repayment as $v_repayment) : ?>
                                 <tr class="custom-tr">
                                    <td class="vertical-td">
                                       <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td" width="17%"><?php echo $v_repayment->collection_date ?></td>
                                    <td class="vertical-td"><?php echo $v_repayment->collected_by ?></td>
                                    <td class="vertical-td"><?php echo $v_repayment->repayment_method ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_repayment->repayment_amount) ?></td>
                                    <td class="vertical-td">
                                       <div class="btn-group">
                                          <a href="<?php echo base_url().'admin/loan/edit_repayment/'. $v_repayment->repayment_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil">&nbsp;&nbsp;Edit&nbsp;&nbsp;</i></a>
                                          <a href="<?php echo base_url().'admin/loan/delete_repayment/'. $v_repayment->repayment_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash">&nbsp;Delete</i></a>               
                                       </div>
                                    </td>
                                    <td class="vertical-td">
                                       <div class="btn-group">
                                          <a href="<?php echo base_url().'admin/loan/pdf_receipt/'. $v_repayment->repayment_id ?>" class="btn btn-xs btn-default" ><i class="glyphicon glyphicon-file">&nbsp;Save</i></a>
                                          <a href="<?php echo base_url().'admin/loan/view_receipt/'. $v_repayment->repayment_id ?>" class="btn btn-xs btn-default" ><i class="glyphicon glyphicon-print">&nbsp;Print</i></a>               
                                       </div>
                                    </td>
                                 </tr>
                                 <?php
                                    $counter++;
                                    endforeach;
                                    ?><!--get all sub category if not this empty-->
                                 <?php else : ?> <!--get error message if this empty-->
                                 <td colspan="7">
                                    <strong>There is no record for display</strong>
                                 </td>
                                 <!--/ get error message if this empty-->
                                 <?php endif; ?>
                              </tbody>
                              <!-- / Table body -->
                           </table>
                           <!-- / Table -->
                        </div>
                     </div>
                     <!-- ************* Repayment Tab Ends here ********************** -->
                     <!-- *****************Loan terma begins here***************** -->
                     <div class="tab-pane <?php if(empty($tab)){ echo 'active';} ?>" id="terms">
                        <div class="box-body">
                           <div class="row">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $loan_details = $this->db->get_where('tbl_loan_details',array('loan_id'=>$v_loan->loan_id))->result();
                                 foreach ($loan_details as $v_details) {?>
                              <div class="col-md-4">
                                 <table class="table" class="table-striped table-hover table-condensed">
                                    <tbody>
                                       <tr>
                                          <td><b>Loan Status</b></td>
                                          <td><?php echo $v_loan->loan_status ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Loan number</b></td>
                                          <td><?php echo $v_loan->loan_number ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Loan Product</b></td>
                                          <td><?php echo $v_details->loan_product ?></td>
                                       </tr>
                                       <tr>
                                          <td colspan="2">
                                             <h4><span class="label bg bg-olive">Loan Terms</span></h4>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td><b>Disbursed by</b></td>
                                          <td><?php echo $v_details->loan_disbursed_by ?></td>
                                       </tr>
                                       <tr>
                                          <td>Loan Release Date</td>
                                          <td><?php echo $v_details->loan_release_date ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Principal Amount</b></td>
                                          <td><?php echo $this->localization->currencyFormat($v_details->principal_amount) ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Loan Interest Method</b></td>
                                          <td><?php 
                                             if ($v_details->loan_interest_method=='flat_rate') {                                         	                                         
                                             echo 'Flat rate';
                                             }else{
                                             	echo $v_details->loan_interest_method;
                                             }
                                             ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Loan Interest</b></td>
                                          <td><?php echo $v_details->loan_interest_percent.'% / '.$v_details->loan_interest_period_scheme ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Loan Duration</b></td>
                                          <td><?php echo $v_details->loan_duration.' '.$v_details->loan_duration_scheme ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Repayment Cycle</b></td>
                                          <td><?php echo $v_details->loan_repayment_cycle ?></td>
                                       </tr>
                                       <tr>
                                          <td><b>Number Of Repayments</b></td>
                                          <td><?php echo $v_details->loan_num_of_repayments ?></td>
                                       </tr>
                                    </tbody>
                                 </table>
                                 <?php }?>
                              </div>
                           </div>
                           </div>
                        </div>
                     </div>
                     <!-- ************Loan terms tab ends here **************** -->
                     <!-- ************Loan schedule tab starts here **************** -->
                     <div class="tab-pane" id="schedule">
                        <div class="box-body">
                           <!-- /.Add Collateral button -->
                           <div class="row">
                              <div class="col-md-12">
                                 <!-- Table -->
                           <table id="datatable-example" class="table table-striped table-bordered datatable-buttons">
                              <thead >
                                 <!-- Table head -->
                                 <tr>
                                    <th class="active">#</th>
                                    <th class="active">Date</th>
                                    <th class="active">Description</th>
                                    <th class="active">Principal</th>
                                    <th class="active">Interest</th>
                                    <th class="active">Fees</th>
                                    <th class="active">Penalty</th>
                                    <th class="active">Due</th>
                                    <th class="active">TotalDue</th>
                                    <th class="active">Paid</th>
                                    <th class="active">Pending Due</th>
                                    <th class="active">Principal Balance Owed</th>
                                 </tr>
                              </thead>
                              <!-- / Table head -->
                              <tbody>
                                 <!-- / Table body -->  
                                
                                 <?php $repayments= $v_details->loan_num_of_repayments?>
                                 <?php if(!empty($repayments)){?>
                                <?php  $i=1; ?>
                                <tr class="custom-tr">
                                <td colspan="11"></td>
                               
                                <td>
                                    <?php echo $this->localization->currency($v_loan->principal_amount) ?>
                                </td>
                                  <?php 
                                  //date calculations
                                  $release_date=date_create($v_loan->loan_release_date);
								  $maturity_date=date_create($v_loan->maturity_date);
								  $diff=date_diff($release_date,$maturity_date);
                                  $loan_total_days=$diff->format("%a");
                                  
                                  ?>                         
                                 </tr>
                                 <?php while($i<=$repayments ){ ?>
                                 <tr class="custom-tr">
                                    <td class="vertical-td">
                                     <?php echo $i ?>
                                    </td>
                                    <td class="vertical-td">
                                    <?php 
                                    $repayment_date=$v_loan->loan_release_date;
                                    
                                    //get time interval in days
                                    $date_interval=round(($loan_total_days)/$repayments);
                                    
                                    
                                    //add $date_interval to date
                                    $loan_next_date=date_add($release_date, date_interval_create_from_date_string("{$date_interval} days"));
    								//next repayment date
        							$next_maturity_date = date_format($loan_next_date, "Y-m-d");
                                    echo $next_maturity_date;
                                    
                                    ?></td>
									<td class="vertical-td"><?php echo 'Repayment' ?></td>
									<td class="vertical-td"><?php echo $this->localization->currency(($v_loan->principal_amount/$repayments)) ?></td>
									<td class="vertical-td"><?php echo $this->localization->currency($v_loan->loan_interest/$repayments) ?></td>
									<td class="vertical-td"><?php echo $this->localization->currency($v_loan->loan_fees/$repayments) ?></td>
									<td class="vertical-td"><?php echo $this->localization->currency($v_loan->loan_penalty/$repayments) ?></td>
									<td class="vertical-td"><?php echo $this->localization->currency($v_loan->amount_due/$repayments) ?></td>
									<td class="vertical-td"><?php echo $this->localization->currency(($v_loan->amount_due/$repayments)*$i) ?></td>
									<td class="vertical-td"><?php echo $this->localization->currency($v_loan->paid_amount) ?></td>
									<td class="vertical-td"><?php echo $this->localization->currency(($v_loan->amount_due/$repayments)*$i-$v_loan->paid_amount) ?></td>
									<td class="vertical-td"><?php echo $this->localization->currency($v_loan->principal_amount-(($v_loan->principal_amount/$repayments)*$i)) ?></td>
                                 </tr>
                                 <?php
                                  $i++; 
                                 };   
                                 ?>
                                   <tr class="custom-tr">
                                   <td></td>
                                   <td colspan="2" style="text-align:right;"><strong>Total Due</strong></td>
                                   <td style="text-align:right;"><?php echo $this->localization->currency($v_loan->principal_amount)?></td>
                                    <td style="text-align:right;"><?php echo $this->localization->currency($v_loan->loan_interest)?></td>
                                    <td><?php echo $this->localization->currency($v_loan->loan_fees) ?></td>
                                    <td><?php echo $this->localization->currency($v_loan->loan_penalty) ?></td>
                                    <td><strong><?php echo $this->localization->currency($v_loan->amount_due) ?></strong></td>
                                   <td colspan="4"></td>
                                   </tr>
                                 <?php }else{ ?> <!--get error message if this empty-->
                                 <td colspan="7">
                                    <strong>There is no record for display</strong>
                                 </td>
                                 <!--/ get error message if this empty-->
                                 <?php } ?>
                              </tbody>
                              <!-- / Table body -->
                           </table>
                           <!-- / Table -->             
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- ************Loan schedule tab ends here **************** -->
                     <!-- ************Loan pending tab starts here **************** -->
                     <div class="tab-pane" id="pending">
                        <div class="box-body">
                           <!-- /.Add Collateral button -->
                           <div class="row">
                              <div class="col-md-12">
                                <?php  
                                 //get total repayments
                                 
                                 $this->db->select_sum('repayment_amount');
								 $total_repayment = $this->db->get_where('tbl_loan_repayment',array('loan_id'=>$v_loan->loan_id))->result();
								 foreach ($total_repayment as $value) {
								 	$total_repayment=$value->repayment_amount;
								 }
								 
								 ?>
								 
                                 <table class="table" class="table-striped table-hover table-condensed">
                                 <thead>
                                 <tr>
                                 <th class="active">Based on Loan Terms:</th>
                                 <th class="active">Principal</th>
                                 <th class="active">Interest</th>
                                 <th class="active">Fees</th>
                                 <th class="active">Penalty</th>
                                 <th class="active">Total</th>
                                 </tr>
                                 </thead>
                                 <tbody>
                                 <tr>
                                 <td class="text-bold bg-red">Total Due</td>
                                 <td style="text-align:left"><?php echo $this->localization->currency($v_loan->principal_amount) ?></td>
                                 <td style="text-align:left"><?php echo $this->localization->currency($v_loan->loan_interest) ?></td>
                                 <td style="text-align:left"><?php echo $this->localization->currency($v_loan->loan_fees) ?></td>
                                 <td style="text-align:left"><?php echo $this->localization->currency($v_loan->loan_penalty) ?></td>
                                 <td style="text-align:left">
                                 <?php 
                                 $total_base=$v_loan->principal_amount+$v_loan->loan_interest+$v_loan->loan_fees+$v_loan->loan_penalty; 
                                 echo $this->localization->currency($total_base);
                                 ?></td>
                                 </tr>
                                 <tr>
                                 <td class="text-bold bg-green">Total Paid</td>
                                 <td style="text-align:left">
                                 <?php 
                                 $principal_paid=($v_loan->principal_amount/$total_base)* $total_repayment;
                                 echo $this->localization->currency($principal_paid); 
                                 ?></td>
                                 <td style="text-align:left">
                                 <?php 
                                 //calculate interest paid
                                 $interest_paid=($v_loan->loan_interest/$total_base)* $total_repayment; 
                                 echo $this->localization->currency($interest_paid);
                                 ?>
                                 </td>
                                 <td style="text-align:left">
                                 <?php 
                                 $fees_paid=($v_loan->loan_fees/$total_base)* $total_repayment;  
                                 echo $this->localization->currency($fees_paid);
                                 ?></td>
                                 <td style="text-align:left">
                                 <?php 
                                 $penalty_paid= ($v_loan->loan_penalty/$total_base)* $total_repayment; 
                                 echo $this->localization->currency($penalty_paid); 
                                 ?></td>
                                 <td style="text-align:left">
                                 <?php
                                  $total_paid=$penalty_paid+$fees_paid+$interest_paid+$principal_paid; 
                                  echo $this->localization->currency($total_paid);
                                  ?></td>
                                 </tr>
                                 <tr>
                                 <td class="text-bold bg-gray">Balance</td>
                                  <td style="text-align:left"><?php echo $this->localization->currency($v_loan->principal_amount-$principal_paid) ?></td>
                                 <td style="text-align:left"><?php echo $this->localization->currency($v_loan->loan_interest-$interest_paid) ?></td>
                                 <td style="text-align:left"><?php echo $this->localization->currency($v_loan->loan_fees-$fees_paid) ?></td>
                                 <td style="text-align:left"><?php echo $this->localization->currency($v_loan->loan_penalty-$penalty_paid) ?></td>
                                 <td style="text-align:left">
                                 <?php 
                                
                                 echo $this->localization->currency($total_base-$total_paid);
                                 ?></td>
                                 </tr>
                                 </tbody>
                                 </table>
                                                   
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- ************Loan pending tab ends here **************** -->
                     <!-- ************Loan collateral tab starts here ************** -->
                     <div class="tab-pane" id="collateral">
                        <div class="box-body">
                           <!-- /.Add Collateral button -->
                           <div class="row">
                              <div class="col-md-12">
                                 <a  href="<?php echo base_url(); ?>admin/collateral/add_collateral/<?php echo $v_loan->loan_id; ?>" class="addAttribute btn btn-info"><i class="fa fa-plus"></i>Add Collateral</a>                  
                              </div>
                              <br>
                              <br>
                              <br>
                            <div class="row">
                              <div class="col-md-12">
                            <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="col-sm-1 active" style="width: 21px"><input type="checkbox" class="checkbox-inline" id="parent_present" /></th>
                                <th class="active">Image</th>
                                <th class="active">Code</th>  
                                <th class="active">Type</th>
                                <th class="active">Serial</th>
                                <th class="active">Name</th>
                                <th class="active">Collateral assigned to</th>
                                <th class="active">Collateral value</th>
                                <th class="active">Status</th>
                                <th class="active">Action</th>

                            </tr>
                                    </thead>
                                    <!-- / Table head -->
                                    <tbody>
                                    <?php $collateral = $this->db->get_where('tbl_collateral',array('loan_id'=>$v_loan->loan_id))->result();?>
                                 <?php if (!empty($collateral)): foreach ($collateral as $v_collateral) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><input name="collateral_id[]" value="<?php echo $v_collateral->collateral_id ?>" class="child_present" type="checkbox" /></td>
                                   <td class="product-img">
                                       <?php if (!empty($v_collateral->collateral_image_name)):  ?>
                                            <img src="<?php echo base_url() . $v_collateral->collateral_image_name ?>" />
                                       <?php else:?>
                                            <img src="<?php echo base_url() ?>img/product.png" alt="collateral Image">
                                       <?php endif; ?>
                                    </td> 
                                    <td class="vertical-td highlight">
                                        <a href="<?php echo base_url().'admin/collateral/view_collateral/'. $v_collateral->collateral_id ?>"  data-toggle="modal" data-target="#myModal" >
                                            <?php echo $v_collateral->collateral_id ?>
                                        </a>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_collateral->collateral_type ?></td>
                                    <td class="vertical-td"><?php echo $v_collateral->collateral_serial_number ?></td>
                                    <td class="vertical-td"><?php echo $v_collateral->collateral_name ?></td>
                                    <td class="vertical-td"><?php echo $v_collateral->collateral_assignee?></td>	
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_collateral->collateral_purchase_price) ?></td>
                                     <td class="vertical-td">
                                        <?php
                                        if(!empty($v_collateral->status))
                                        { ?>
                                            <span class="label label-warning"><?php echo $v_collateral->status ?></span>
                                        <?php } else { ?>
                                            <span class="label bg bg-olive"><?php echo 'Not available' ?></span>
                                        <?php } ?>

                                    </td>
                                    <td class="vertical-td">

                                        <div class="btn-group">
                                       	    <a href="<?php echo base_url().'admin/collateral/collateral_assign/'. $v_collateral->collateral_id ?>" class="btn btn-xs bg-olive" data-toggle="modal" data-target="#myModal"><i class="fa fa-book">Assign</i></a>
                                            <a href="<?php echo base_url().'admin/collateral/edit_collateral/'. $v_collateral->collateral_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo base_url().'admin/collateral/view_collateral/'. $v_collateral->collateral_id ?>" class="btn btn-xs bg-olive" data-toggle="modal" data-target="#myModal" ><i class="glyphicon glyphicon-search"></i></a>
                                            <a href="<?php echo base_url().'admin/collateral/delete_collateral/'. $v_collateral->collateral_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
                                        </div>
                                    </td>

                                </tr>
                            <?php

                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="8">
                                    <strong>There is no data to display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                                    </tbody>
                                    <!-- / Table body -->
                                 </table>
                                 </div>
                                 </div>>
                           </div>
                        </div>
                     </div>
                     <!-- ************Loan collateral tab ends here ************** 		
                        <!-- *****File tab begins here***** -->
                     <div class="tab-pane <?php if(empty($tab)){ echo 'active';} ?>" id="files">
                        <div class="box-body">
                           <!-- /.Add Collateral button -->
                           <div class="row">
                              <div class="col-md-12">
                                 <span><strong>To Add loan files please edit loan and use file & image tab</strong></span>      
                              </div>
                           </div>
                           <div class="row">
                           <div class="col-md-12">
                         <table class="table table-bordered nowrap">
                            <thead>
                            <tr>
                               
                                <th>
                                    File
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            
                                <tr>
                                    
                                     <td>
                                     <?php if (!empty($v_details->loan_file_name)) {?>
                                    <a href="<?php echo  base_url() .$v_details->loan_file_name ?>"><i class="glyphicon glyphicon-search"></i><span>view</span></a>
                                     <?php } else echo "No file available"?>
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                           </div>
                           </div>
                        </div>
                     </div>
                     <!-- *****File tab ends here***** -->
                     <!-- *****File tab comments here***** -->
                     <div class="tab-pane <?php if(empty($tab)){ echo 'active';} ?>" id="comments">
                        <div class="box-body">
                           <!-- /.Add Collateral button -->
                           <div class="row">
                              <div class="col-md-12">
                                 <a  href="<?php echo base_url(); ?>admin/loan/add_comments/<?php echo $v_loan->loan_id; ?>" class="addAttribute btn btn-info pull-right" data-target="#modalSmall" data-toggle="modal"><i class="fa fa-plus"></i>Add Comments</a>                  
                              </div>
                           </div>
                           <br>
                           <div class="row">
                              <div class="col-md-12">
                                 <table id="dataTables-example" class="table table-striped table-bordered datatable-buttons">
                                    <thead >
                                       <!-- Table head -->
                                       <tr>
                                          <th class="active col-sm-1">Sl</th>
                                          <th class="active">Comment</th>
                                          <th class="active">Posted By</th>
                                          <th class="active">Date Posted</th>
                                          <th class="active">Action</th>
                                       </tr>
                                    </thead>
                                    <!-- / Table head -->
                                    <tbody>
                                       <!-- / Table body -->
                                       <?php   
                                          $loan_comments = $this->db->get_where('tbl_loan_comments',array('loan_id'=>$v_loan->loan_id))->result();
                                            	?>
                                       <?php $counter =1 ; ?>
                                       <?php if (!empty($loan_comments)): foreach ($loan_comments as $v_comments) : ?>
                                       <tr class="custom-tr">
                                          <td class="vertical-td">
                                             <?php echo  $counter ?>
                                          </td>
                                          <td class="vertical-td" width="17%"><?php echo $v_comments->comment ?></td>
                                          <td class="vertical-td"><?php echo $v_comments->posted_by ?></td>
                                          <td class="vertical-td"><?php echo $v_comments->date_posted ?></td>
                                          <td class="vertical-td">
                                             <div class="btn-group">
                                                <a href="<?php echo base_url().'admin/loan/edit_comments/'. $v_comments->comment_id ?>" class="btn btn-xs btn-default" data-toggle="modal" data-target="#myModal" ><i class="fa fa-pencil">&nbsp;&nbsp;Edit&nbsp;&nbsp;</i></a>
                                                <a href="<?php echo base_url().'admin/loan/delete_comment/'. $v_comments->comment_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash">&nbsp;Delete</i></a>               
                                             </div>
                                          </td>
                                       </tr>
                                       <?php
                                          $counter++;
                                          endforeach;
                                          ?><!--get all sub category if not this empty-->
                                       <?php else : ?> <!--get error message if this empty-->
                                       <td colspan="7">
                                          <strong>There is no record for display</strong>
                                       </td>
                                       <!--/ get error message if this empty-->
                                       <?php endif; ?>
                                    </tbody>
                                    <!-- / Table body -->
                                 </table>
                              </div>
                              <!-- / Table -->
                           </div>
                        </div>
                     </div>
                     <!-- *****File tab comments ends here***** -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>