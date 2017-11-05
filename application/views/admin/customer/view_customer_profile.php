<script src="<?php echo base_url(); ?>asset/js/ajax.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php $info = $this->session->userdata('business_info'); ?>
<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
		<div class="box-header box-header-background with-border">
               <h3 class="box-title ">Customer: <?php echo $customer_info->first_name.' '.$customer_info->last_name ?></h3>
               <div class="box-tools">
               </div>
            </div>
			           <!-- Top box begins -->
			                
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
                     <strong>Account Number:</strong>  <?php echo $customer_info->customer_account ?>
                  </div>
                  <div class="col-md-4">
                     <strong>Gender:</strong>  <?php echo $customer_info->gender ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 col-md-offset-2">
                     <strong>Customer name:</strong>  <?php echo $customer_info->first_name.' '.$customer_info->last_name ?>
                  </div>
                  <div class="col-md-4 ">
                     <strong>Phone:</strong>  <?php echo $customer_info->phone ?>
                  </div>
               </div>
               <div class="box-body">
                  <div class="row">
                  <?php if($show_approve_button==1){?>
                  <?php if($customer_info->status=='pending'){?>
                     <div class="col-md-6">
                        <a href="<?php echo base_url().'admin/customer/approve_account/'. $customer_info->customer_id ?>" class="addAttribute btn btn-success pull-left"><i class="fa fa-check"></i> Approve</a>                 
                     </div>
                     <?php }elseif($customer_info->status=='approved'){?>
                      <div class="col-md-6">
                        <a  href="#" class="addAttribute btn btn-warning pull-left"><i class="fa fa-check"></i>Approved</a>                  
                     </div>
                     <?php }
                    }
                     ?>
                     <div class="col-md-6">
                        <a  href="<?php echo base_url(); ?>admin/apis/send_sms/<?php echo $customer_info->phone; ?>" class="addAttribute btn btn-danger pull-right"><i class="fa fa-envelope"></i> Send sms</a> 
                     </div>
                  </div>
               </div>
               <br>
            </div>
                
                <!-- Top box -->
                <hr>
				
				<!-- /.box-header -->
				<!-- form start -->
				
					<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
						<li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#meters" data-toggle="tab">Meters</a></li>
						<li class="<?php if(!empty($tab)){ echo $tab=='payments'?'active':'';} ?>"><a href="#payments" data-toggle="tab">Payments</a></li>
						<li	class="<?php if(!empty($tab)){ echo $tab == 'messages'?'active':'';}?>"><a href="#messages" data-toggle="tab">Messages</a></li>
					</ul>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div id="my-tab-content" class="tab-content">
								<!-- ***************  pcu data Tab Start ****************** -->
								<div class="tab-pane <?php if(empty($tab)){ echo 'active';} ?>" id="meters">
										<!-- /.History payments -->
											
						<div class="box">
					<div class="box-body">
					 <!-- /.add meter button -->
                           <div class="row">
                              <div class="col-md-12">
                                 <a  href="<?php echo base_url().'admin/meter/install_meter/'.$customer_info->customer_id; ?>" class="addAttribute btn btn-info "><i class="fa fa-plus"></i> Add Meter</a>                  
                              </div>
                           </div>
                           <hr>				                        <!-- Table -->
                      <!-- Table -->
                   <!-- <table id="datatable" class="table table-striped table-bordered datatable-buttons"> -->
                    <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="col-sm-1 active" style="width: 21px"><input type="checkbox" class="checkbox-inline" id="parent_present" /></th>
                                <th class="active">Image</th>
                                <th class="active">Meter #</th>  
                                <th class="active">Type</th>
                                <th class="active">Serial</th>
                                
                                <th class="active">Assigned to</th>
                                <th class="active">Value</th>
                                <th class="active">Status</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            
                            <?php if (!empty($meter)): foreach ($meter as $v_meter) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><input name="meter_id[]" value="<?php echo $v_meter->meter_id ?>" class="child_present" type="checkbox" /></td>
                                   <td class="product-img">
                                       <?php if (!empty($v_meter->meter_image_name)):  ?>
                                            <img src="<?php echo base_url() . $v_meter->meter_image_name ?>" />
                                       <?php else:?>
                                            <img src="<?php echo base_url() ?>img/product.png" alt="meter Image">
                                       <?php endif; ?>
                                    </td> 
                                    <td class="vertical-td highlight">
                                        <a href="<?php echo base_url().'admin/meter/view_meter/'. $v_meter->meter_id ?>"  data-toggle="modal" data-target="#myModal" >
                                            <?php echo $v_meter->meter_number ?>
                                        </a>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_meter->meter_type ?></td>
                                    <td class="vertical-td"><?php echo $v_meter->meter_serial_number ?></td>
                             
                                    <td class="vertical-td"><?php echo $v_meter->meter_assignee ?></td>	
                                    <td class="vertical-td"><?php echo $v_meter->meter_purchase_price ?></td>
                                     <td class="vertical-td">
                                        <?php
                                        if(!empty($v_meter->status))
                                        { ?>
                                            <span class="label label-warning"><?php echo $v_meter->status ?></span>
                                        <?php } else { ?>
                                            <span class="label bg bg-olive"><?php echo 'Not available' ?></span>
                                        <?php } ?>

                                    </td>
                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/meter/edit_meter/'. $v_meter->meter_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"> </i></a>
                                            <a href="<?php echo base_url().'admin/meter/view_meter/'. $v_meter->meter_id ?>" class="btn btn-xs bg-olive" data-toggle="modal" data-target="#myModal" ><i class="glyphicon glyphicon-search"> </i></a>
                                    
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
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->
						</div>
						</div>					
											
								</div>
								
								<!-- ************ payments details Tab Start ************** -->
					
							
								<div class="tab-pane	<?php if(!empty($tab)){echo $tab == 'payments'?'active':'';}	?>"	id="payments">
									<!-- /.General Price Start -->
									<div class="box">
									<div class="box-body">
										<table class="table table-bordered table-hover" id="datatable" >
                            <thead ><!-- Table head -->
                            <tr>
                              <th class="active">#</th>
                              <th class="active">Meter number #</th>
                              <th class="active">Operator</th>
                              <th class="active">Mobile number</th>
                              <th class="active">Transaction id</th>
                              <th class="active">Amount</th>
                              <th class="active">Time</th>
                              <th class="active">Payment status</th>
                              <th class="active">Message</th>
                              <th class="active">Action</th>
                           </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            
                           <?php //$payment_info=$this->db->get_where('tbl_mobile_payments')->result(); ?>
                           
                           <?php if (!empty($payments)): foreach ($payments as $v_mobile_payments) : ?>
                           <tr class="custom-tr">
                              <td class="vertical-td">
                                 <?php echo  $counter ?>
                              </td>
                              <td class="vertical-td" ><?php 
                                 echo $v_mobile_payments->referenceNo;
                                 ?></td>
                              <td class="vertical-td"><?php echo $v_mobile_payments->apiUsername ?></td>
                              <td class="vertical-td"><?php echo $v_mobile_payments->msisdn ?></td>
                              <td class="vertical-td"><?php echo $v_mobile_payments->mpesa_receipt ?></td>
                              <td class="vertical-td"><?php echo $v_mobile_payments->amount ?></td>
                              <td class="vertical-td"><?php echo $v_mobile_payments->timestamp ?></td>
                              <td class="vertical-td"><?php echo $v_mobile_payments->payment_status ?></td>
                              <td class="vertical-td"><?php echo $v_mobile_payments->payment_status_description ?></td>
                              <td class="vertical-td">
                                 <div class="btn-group">
                                    <a href="<?php echo base_url().'admin/meter/add_meter/'. $v_mobile_payments->mpesa_receipt ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                    <a href="<?php echo base_url().'admin/meter/view_metering/'. $v_mobile_payments->mpesa_receipt ?>" class="btn btn-xs btn-default" ><i class="fa fa-search"></i></a>               
                                 </div>
                              </td>
                            <?php
                                $counter++;
                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="7">
                                    <strong>There is no record for display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->
									</div>
									</div>
								
									
								</div>
								
								<!-- ************* payment tab starts *********** -->
								<div class="tab-pane <?php if(!empty($tab)){
									echo $tab == 'messages'?'active':'';
									}
									?>"	id="messages">
									<div class="box">
										<div class="box-body">
									
									      <!-- Table -->
                  <table id="datatable-responsive" class="table table-striped table-bordered datatable-buttons">
                    
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">#</th>
                                <th class="active" width="15%">Message Receiver</th>
                                <th class="active">Message</th>
                                <th class="active">Timestamp</th>
                                <th class="active">View</th>
 								<th class="active">Delete</th>
 								<th class="active">Resend</th>
                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php 
                            
                            $customer_info=$this->db->get('tbl_sms_sent')->result();
                                                                                    
                            ?>
                   <?php $counter =1 ; ?>
                            <?php if (!empty($customer_info)): foreach ($customer_info as $v_customer) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td"><?php echo '255'.substr($v_customer->msg_receiver , -9); ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->message ?></td> 
                                    <td class="vertical-td"><?php echo $v_customer->sent_timestamp ?></td>
                                        <td class="vertical-td">
                                        <div class="btn-group">
                                            
                                             <a href="<?php echo base_url() ?>admin/apis/view_customer_profile_sent_items/<?php echo '255'.substr($v_customer->msg_receiver , -9); ?>" class="btn btn-xs bg-orange" > History</a>                                                                                   
                                        </div>
                                    </td>
                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/apis/delete_msg_sent/'. $v_customer->id                                           
                                            ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"> Delete</i></a> 
                                            
                                        </div>
                                    </td>
 									<td class="vertical-td"><a href="<?php echo base_url(); ?>admin/apis/send_sms/<?php echo '255'.substr($v_customer->msg_receiver , -9); ?>"class="btn btn-xs btn-success"><i class="fa fa-envelope"> Resend</i></a>                                               </td>
                                </tr>
                            <?php
                                $counter++;
                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="7">
                                    <strong>There is no record for display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->

											
											
										</div>
									</div>
								</div>
	
								                                    
							</div>
						</div>
					</div>
				
			</div>
		</div>
	</div>
</section>



<script>
	$(function(){
	    var sampleTags = [
	        <?php
		if(!empty($tags))
		foreach($tags as $v_tag){
		echo "'$v_tag->tag',";
		}
		
		?>
	    ];
	
	    //-------------------------------
	    // Allow spaces without quotes.
	    //-------------------------------
	    $('#allowSpacesTags').tagit({
	       availableTags: sampleTags,
	        allowSpaces: true,
	        fieldName: "tages[]",
	        tagLimit:3,
	        autocomplete: {delay: 0, minLength: 2}
	    });
	});
</script>
<script>
	var options = {
	    source: [
	        <?php
		if(!empty($attribute_set))
		foreach($attribute_set as $v_attribute){
		echo "'$v_attribute->attribute_name',";
		}
		?>
	    ]
	
	};
	var result = 'input.selector';
	$(document).on('keydown.autocomplete', result, function() {
	    $(this).autocomplete(options);
	});
	
</script>

<script>
   $('body').on('hidden.bs.modal', '.modal', function() {
       $(this).removeData('bs.modal');
   });

   $(document).ready(function() {

       $('.box-body').css({"border-top":"0px solid #ccc"});

       $("#customer").select2({
           placeholder: "Select a State",
           allowClear: true
       });

       $("#visit").select2({
           placeholder: "Select a State",
           allowClear: true
       });

   });
   
</script>
<!--    Image Validation Check    -->
<script type="text/javascript"></script>