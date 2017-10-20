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
                  <h3 class="box-title "><?php echo $customer_info->title.' '.$customer_info->first_name.' '.$customer_info->second_name.' '.$customer_info->last_name." - View All Loans" ?></h3>
                  <div class="box-tools">

                  </div>
               </div>
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
                <div class="col-md-4 ">
                       <a  href="<?php echo base_url(); ?>admin/apis/send_sms/<?php echo $customer_info->phone; ?>" class="addAttribute btn btn-danger pull-right"><i class="fa fa-envelope"></i> Send sms</a> 
                </div>
                
            </div>
        </div>
                    <br>
                      
                </div>
                
                <!-- Top box -->
                <hr>



                <div class="box-body">

                        <!-- Table -->
                    <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active col-sm-1">#</th>
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
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php   
                  			 $loan_info = $this->db->get_where('tbl_loan',array('customer_id'=>$customer_info->customer_id))->result();
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
                                    
                                    <td class="vertical-td"><?php echo $this->localization->currencyFormat($v_loan->principal_amount) ?></td>
                                    <td class="vertical-td"><?php echo $v_loan->loan_interest_percent.'%'.'/'. $v_loan->loan_interest_period_scheme ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->loan_interest) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->loan_fees) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->loan_penalty) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->amount_due) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->paid_amount) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->balance_amount) ?></td>
                                    <td class="vertical-td"><?php echo $v_loan->loan_status ?></td>
                                    <td class="vertical-td">
                           			<?php
                              		if((int)$v_loan->approval >0)
                              		{ ?>
                           			<span class="label label-olive"><?php echo 'Approved' ?></span>
                           			<?php } else { ?>
                          			 <span class="label label-danger"><?php echo 'Pending' ?></span>
                           			<?php } ?>
                        			</td>
                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/loan/edit_loan/'. $v_loan->loan_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                             <a href="<?php echo base_url().'admin/loan/view_loan/'. $v_loan->loan_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-search"></i></a>               
                                        </div>
                                    </td>

                                </tr>
                            <?php
                                $counter++;
                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="14">
                                    <strong>There is no record for display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->

                </div><!-- /.box-body -->
							
					                          
                                                                   

                                    <!-- customer id -->
                                    <?php if (!empty($customer_info->customer_id)) {?>
                                        <input type="hidden"  name="customer_id" id="customer_id"
                                               value="<?php echo $customer_info->customer_id ?>">
                                    <?php }  ?>
                                    
                             
								                                    
							</div>
						</div>
					</div>
			
				<!-- Form end -->
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