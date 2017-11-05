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
               <h3 class="box-title "><?php echo $group_info->group_name."-Group Details" ?></h3>
               <div class="box-tools">
               </div>
            </div>
            <!-- Top box begins -->
            <div class="box-body">
               <div class="row">
                  <div class="col-lg-3 col-sm-6 col-sx-12">
                     <!-- small box -->
                     <div class="callout callout-danger" style="height:130px;">
                        <div class="inner">
                           <h2>
                              <strong><?php echo $group_info->group_name ?> </strong>
                           </h2>
                            <br>
                           <p><?php 	
                           				$ids=$group_info->group_borrower_ids;
                           				$replace1=str_replace('["','',$ids);
   										$replace2=str_replace('"]','',$replace1);
   										$replace3=str_replace('"','',$replace2);
   									    $pieces = explode(",",$replace3);
   									    echo sizeof($pieces);
  							 ?> Members</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-bar-chart-o"></i>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-sx-12">
                     <!-- small box -->
                     <div class="callout callout-success" style="height:130px;">
                        <div class="inner">
                           <h5>
                           
                                 <?php 
                                    $group_leader=$this->db->get_where('tbl_customer',array('customer_id'=>$group_info->group_leader_borrower_id))->result();
                                    foreach ($group_leader as $value) {
                                    	$group_leader=$value->title.' '.$value->first_name.' '.$value->second_name.' '.$value->last_name;
                                    }
                                   
                                    ?>
                              <strong> <?php  echo $group_leader; ?></strong>
                           </h5>
                            <br>
                           <p>Group Leader</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-bar-chart-o"></i>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-sx-12">
                     <!-- small box -->
                     <div class="callout callout-warning" style="height:130px;">
                        <div class="inner">
                           <h2>
                              <strong><?php echo $group_info->group_collector_name ?></strong>
                           </h2>
                           <br>
                           <p>Collector Name</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-bar-chart-o"></i>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-sx-12">
                     <!-- small box -->
                     <div class="callout callout-info" style="height:130px;">
                        <div class="inner">
                           <h2>
                              <strong><?php  echo $group_info->group_meeting_schedule ?></strong>
                           </h2>
                            <br>
                           <p>Meeting Schedule</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-bar-chart-o"></i>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
               <span><strong>Description:</strong> <?php echo $group_info->group_description ?></span>
               <br>
               <label><h3 class="box-title ">Members</h3></label>
            
               </div>
            <hr>
            </div>
            <!-- Top box -->
            <div class="box-body">
                        <!-- Table -->
                    <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active col-sm-1">#</th>
                                <th class="active">Full Name</th>
                                <th class="active">Business</th>
                                <th class="active">Id number</th>
                                <th class="active">Mobile</th>
                                <th class="active">Email</th>
                                <th class="active">Status</th>
                                <th class="active">View</th>
 								<th class="active">Actions</th>
                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($borrowers_info)): foreach ($borrowers_info as $v_customer) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td" width="17%"><?php echo $v_customer->first_name.' '.$v_customer->second_name.' '.$v_customer->last_name ?></td>
                                    <td class="vertical-td" width="20%"><?php echo $v_customer->business_name ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->id_number ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->phone ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->email ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->status ?></td>
                                        <td class="vertical-td" width="20%">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/customer/add_customer/'. $v_customer->customer_id ?>" class="btn btn-xs btn-default" >Savings</a>&nbsp;&nbsp;
                                             <a href="<?php echo base_url().'admin/customer/view_loans_borrower/'. $v_customer->customer_id ?>" class="btn btn-xs bg-olive" >Loans</a>                                                                                   
                                        </div>
                                    </td>
                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/customer/add_customer/'. $v_customer->customer_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo base_url().'admin/customer/delete_customer/'. $v_customer->customer_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>                                              
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
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table>
               <!-- / Table -->
            </div>
     
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