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
                  <h3 class="box-title "><?php echo $msisdn.' | '.$title; ?></h3>
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
    </div>

                    
       <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <a  href="<?php echo base_url(); ?>admin/apis/send_sms/<?php echo $msisdn; ?>" class="addAttribute btn btn-info pull-right"><i class="fa fa-plus"></i> Send message</a>                  
                </div>
            </div>
        </div>
                    <br>
                      
                </div>
                
                <!-- Top box -->
                <hr>


                <div class="box-body">
                

                
                        <!-- Table -->
                  <table id="datatable-responsive" class="table table-striped table-bordered datatable-buttons">
                    
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">#</th>
                                <th class="active" width="15%">Message Receiver</th>
                                <th class="active">Message</th>
                                <th class="active">Timestamp</th>
                                
 								<th class="active">Delete</th>
 						
                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php 
                            
                            if($type==2){
                                $customer_info=$this->db->get_where('tbl_sms_sent',array('msg_receiver'=>$msisdn))->result();
                            }elseif($type==1){
                                $customer_info=$this->db->get_where('tbl_smpp_hits',array('from_msisdn'=>$msisdn))->result();
                            }
                                                                                    
                            ?>
                   <?php $counter =1 ; ?>
                            <?php if (!empty($customer_info)): foreach ($customer_info as $v_customer) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td"><?php 
                                    if($type==2){
                                    echo '255'.substr($v_customer->msg_receiver , -9); 
                                    }else{
                                        echo '255'.substr($v_customer->from_msisdn, -9);
                                        
                                    }
                                    ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->message ?></td> 
                                    <td class="vertical-td"><?php echo $v_customer->sent_timestamp ?></td>
                                  
                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/apis/delete_msg/'. $v_customer->id                                           
                                            ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"> Delete</i></a> 
                                            
                                        </div>
                                    </td>
 								                                             </td>
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