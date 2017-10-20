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
<form role="form" enctype="multipart/form-data" id="addcustomerForm"	onsubmit="return imageForm(this)"	action="<?php echo base_url(); ?>admin/customer/save_attendance/<?php  if (!empty($customer_info)) {
					echo $customer_info->customer_id;
					} ?>" method="post">
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
                <div class="col-md-4">
                    <a  href="javascript:void(0);" class="addAttribute btn btn-info "><i class="fa fa-plus"></i> Add Loan</a>
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
						<li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#history" data-toggle="tab">History</a></li>
						<li class="<?php if(!empty($tab)){ echo $tab=='diagnosis'?'active':'';} ?>"><a href="#diagnosis" data-toggle="tab">New History & Diagnosis</a></li>
						<li	class="<?php if(!empty($tab)){ echo $tab == 'lab'?'active':'';}?>"><a href="#lab" data-toggle="tab">Labs</a></li>
						<li><a href="#medication" data-toggle="tab">Medication</a></li>
						<li><a href="#appointment" data-toggle="tab">Appointments</a></li>
						<li	class="<?php if(!empty($tab)){ echo $tab == 'vitals'?'active':'';} ?>"><a href="#vitals" data-toggle="tab">Visits</a></li>
						<li	class="<?php if(!empty($tab)){ echo $tab == 'admit'?'active':'';} ?>"><a	href="#admit" data-toggle="tab">Actions</a></li>
					</ul>
					<div class="row">
						<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
							<div id="my-tab-content" class="tab-content">
								<!-- ***************  History Tab Start ****************** -->
								<div class="tab-pane <?php if(empty($tab)){ echo 'active';} ?>" id="history">
										<!-- /.History Diagnosis -->
											
						<div class="box">
										<div class="box-body">					                        <!-- Table -->
                   <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Visit Date</th>
                                <th class="active">History</th>
                                <th class="active">Diagnosis</th>
                                <th class="active">Visit status</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php //$history_info = $this->db->get_where('tbl_patient_history',array('customer_id'=>$customer_info->customer_id))->result(); ?>
                            <?php if (!empty($history_info)): foreach ($history_info as $v_history) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><?php echo $v_history->date_updated?></td>
                                    <td class="vertical-td"><?php echo $v_history->history ?></td>
                                    <td class="vertical-td"><?php echo $v_history->diagnosis?></td>
                                    <td class="vertical-td"><?php echo $v_history->visit_status ?></td>
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
								
								<!-- ************ Diagnosis details Tab Start ************** -->
								<div
									class="tab-pane
									<?php
										if(!empty($tab)){
										    echo $tab == 'diagnosis'?'active':'';
										}
										?>
									"
									id="diagnosis">
									
									<div class="form-group form-group-bottom"><label>History<span
										class="required">*</span></label></div>
									
										<!-- /.History Diagnosis -->
											<div class="form-group">
												<textarea required name="history" class="form-control autogrow"
													placeholder="history" rows="2">
												</textarea>
											</div>
											<!-- /.Diagnosis -->
									<div class="form-group form-group-bottom"><label>Diagnosis<span
										class="required">*</span></label></div>
									<div class="box">
											<div class="form-group">
												<textarea required name="patient_diagnosis" class="form-control autogrow"
													placeholder="Diagnosis" rows="2"><?php
													?></textarea>
											</div>
									</div>
								
									
								</div>
								<!-- ************* General Tab End ********************** -->
								<!-- ************ Contacts details Tab Start ************** -->
								<div class="tab-pane	<?php if(!empty($tab)){echo $tab == 'lab'?'active':'';}	?>"	id="lab">
									<!-- /.General Price Start -->
									<div class="box">
										<table class="table table-bordered table-hover" id="dataTables-example" >
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Date Requested</th>
                                <th class="active">Date Completed</th>
                                <th class="active">Laboratory</th>
                                <th class="active">Lab Results</th>
                                <th class="active">Lab Results Notes <?php echo $customer_info->customer_id ?></th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; 
                            
                            ?>
                            
                            
                            <?php $laboratory_infoz = $this->db->get_where('tbl_lab_requests',array('customer_id'=>$customer_info->customer_id))->result(); ?>
                            <?php if (!empty($laboratory_infoz)): foreach ($laboratory_infoz as $v_laboratory) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><?php echo $v_laboratory->requested_datetime?></td>
                                    <td class="vertical-td"><?php echo $v_laboratory->date_completed?></td>
                                    <td class="vertical-td"><?php echo $v_laboratory->laboratory_name?></td>
                                    <td class="vertical-td"><?php echo $v_laboratory->lab_results ?></td>
                                    <td class="vertical-td"><?php echo $v_laboratory->lab_notes?></td>
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
								
								<!-- ************* payment tab starts *********** -->
								<div class="tab-pane <?php if(!empty($tab)){
									echo $tab == 'appointment'?'active':'';
									}
									?>"	id="appointment">
									<div class="box">
										<div class="box-body">
									
									<table class="table table-bordered table-hover" id="dataTables-example" >
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Appointment Date</th>
                                <th class="active">Examiner</th>
                                <th class="active">Appointment Type</th>
                                <th class="active">Status</th>
                              

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php //$appointment_info = $this->db->get_where('tbl_patient_appointment',array('customer_id'=>$customer_info->customer_id))->result(); ?>
                            <?php if (!empty($appointment_info)): foreach ($appointment_info as $v_appointment) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><?php echo $v_appointment->date_updated?></td>
                                    <td class="vertical-td"><?php echo $v_appointment->appointment ?></td>
                                    <td class="vertical-td"><?php echo $v_appointment->diagnosis?></td>
                                    <td class="vertical-td"><?php echo $v_appointment->status?></td>
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
								
									<!-- ************* medication tab starts *********** -->
								<div class="tab-pane <?php if(!empty($tab)){ echo $tab == 'medication'?'active':'';	} ?>"	id="medication">
									<div class="box">
										<div class="box-body">
									
									                   <table id="dataTables-example" class="table table-striped table-bordered datatable-buttons">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Date requested</th>
                                <th class="active">Medication</th>
                                <th class="active">Instructions</th>
                                <th class="active">Status</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php $medication_history_info = $this->db->get_where('tbl_medication_history',array('customer_id'=>$customer_info->customer_id))->result(); ?>
                            <?php if (!empty($medication_history_info)): foreach ($medication_history_info as $v_medhistory) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><?php echo $v_medhistory->medication_date?></td>
                                    <td class="vertical-td"><?php echo $v_medhistory->medication_name ?></td>
                                    <td class="vertical-td"><?php echo $v_medhistory->usage_instruction?></td>
                                    <td class="vertical-td"><?php echo $v_medhistory->medication_status ?></td>
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
								
								<!-- /.payment tab ends-->
								<!-- Vitals tab starts -->
								<div class="tab-pane <?php if(!empty($tab)){
									echo $tab == 'vitals'?'active':'';
									}
									?>"
									id="vitals">
									<!-- /.Attribute Start -->
									
									<div class="box">
										<div class="box-body">
									<table class="table table-bordered table-hover" id="dataTables" >
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Visit Date</th>
                                <th class="active">Provider</th>
                                <th class="active">Height</th>
                                <th class="active">Weight</th>
                                <th class="active">BP</th>
                                <th class="active">Temp</th>
                                <th class="active">Pulse rate</th>
                                <th class="active">Resp rate</th>
                                <th class="active">Status</th>
                              

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php $visitor_info = $this->db->get_where('tbl_customer_visit',array('customer_id'=>$customer_info->customer_id))->result(); ?>
                                                    
                            <?php if (!empty($visitor_info)): foreach ($visitor_info as $v_visits) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td"><?php echo $v_visits->visit_date_time ?></td>
                                    <td class="vertical-td"><?php echo $v_visits->doctor_id ?></td>
                                    <td class="vertical-td"><?php echo $v_visits->height ?></td>
                                    <td class="vertical-td"><?php echo $v_visits->weight ?></td>
                                    <td class="vertical-td"><?php echo $v_visits->blood_pressure ?></td>
                                    <td class="vertical-td"><?php echo $v_visits->temperature ?></td>
                                    <td class="vertical-td"><?php echo $v_visits->pulse_rate ?></td>
                                    <td class="vertical-td"><?php echo $v_visits->respiratory_rate ?></td>
                                    <td class="vertical-td"><?php echo $v_visits->visit_status ?></td>
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

										<!-- /.box-body -->
									</div>
									<!-- /.box --> <!-- /.Trigene assesment End --> 
							
								</div>
								<!-- trigene tab ends -->
								<!-- ************* admit tab starts *********** -->                          
								<div class="tab-pane <?php if(!empty($tab)){
									echo $tab == 'admit'?'active':'';
									}
									?>"	id="admit">
									<!-- /.General Start -->
									<div class="box">
										<div class="box-body">
										
										
														<!-- Selec action -->
											<div class="form-group">
												<label>Admission</label>
												<?php if(!empty($customer_info->visit_status)){?>
												   <select required name="actions" class="form-control col-sm-5">
													<option value="<?php echo $customer_info->visit_status;?>">
													<?php echo $customer_info->visit_status; ?>
													</option><option value="1">Admission</option>
													<option value="2">Discharge</option>
													</select>
													<?php }else{?>
													<select required name="actions" class="form-control col-sm-5">
													<option value="">What do want to do?</option>
													<option value="1">Admission</option>
													<option value="2">Discharge</option>
													</select>
													<?php } ?>																								
																						    
											</div>
																							
											<!-- Select ward -->
											<div class="form-group">
												<label>Select Ward</label>
												<select required name="ward_id" class="form-control col-sm-5" id="ward" onchange="get_ward(this.value)">
													<option value="">Select Ward</option>
													<?php if (!empty($ward)): ?>
													<?php foreach ($ward as $v_ward) : ?>
													<option value="<?php echo $v_ward->ward_id; ?>"
														<?php
															if (!empty($ward)) {
																echo $v_ward->ward_id == $v_ward->ward_id ? 'selected' : '';
															}
															?>><?php echo $v_ward->ward_name; ?></option>
													<?php endforeach; ?>
													<?php endif; ?>
													<option value="other">Other</option>
												</select>
											</div>
																					
												<!-- /.Admission date -->
									<div class="form-group form-group-bottom"><label>Date<span
										class="required">*</span></label></div>
									<div class="input-group">
										<input type="text" placeholder="Date" value="" class="form-control datepicker" id="visit_date_time" name="admission_date" data-format="yyyy/mm/dd">
										<div class="input-group-addon"><a href="#"><i class="entypo-calendar"></i></a>
										</div>
									</div>
							
										</div>
									</div>
								</div>
								<!-- /.OPD tab ends -->  
								
								
                                    <!-- customer visitid -->
                                    <?php if (!empty($customer_visit->customer_visit_id)) {?>
                                        <input type="hidden"  name="visit_id" id="visit_id"
                                               value="<?php echo $customer_visit->customer_visit_id ?>">
                                    <?php }  ?>
								                                           
                                                                   

                                    <!-- customer id -->
                                    <?php if (!empty($customer_info->customer_id)) {?>
                                        <input type="hidden"  name="customer_id" id="customer_id"
                                               value="<?php echo $customer_info->customer_id ?>">
                                    <?php }  ?>
                                    
                                     <!-- admission id -->
                                    <?php if (!empty($admit_info->admission_id)) {?>
                                        <input type="hidden" name="admission_id" id="admission_id"
                                               value="<?php echo $admit_info->customer_id ?>">
                                    <?php }  ?>
								                                    
							</div>
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" id="submit" class="btn bg-navy btn-flat col-md-offset-3" type="submit">Submit</button>
					</div>
				</form>
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