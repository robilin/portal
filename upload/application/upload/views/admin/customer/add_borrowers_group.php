<cript src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
<script src="<?php echo base_url(); ?>asset/js/chosen.jquery.min.js" type="text/javascript"></script>

<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<section class="content">

<form role="form" enctype="multipart/form-data" id="addcustomerForm"	onsubmit="return imageForm(this)"	action="<?php echo base_url(); ?>admin/customer/save_borrowers_group/<?php  if (!empty($group_info)) {
					echo $group_info->loan_group_id;
					} ?>" method="post">

        <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">IF YOU PROVIDE GROUP LOANS, ADD THEM HERE</h3>
                </div>
                <!-- /.box-header -->


                <!-- form start -->




            <input type="hidden" name="back_url" value="/borrowers/groups/add_borrowers_group.php">
            <input type="hidden" name="add_group" value="1">        
            <div class="box-body">
                <div class="form-group">
                    <label for="inputGroupName" class="col-sm-2 control-label">Group Name</label>                      
                    <div class="col-sm-10">
                        <input type="text" name="group_name" class="form-control" id="inputGroupName" placeholder="Group Name" value="" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputBorrowerIds" class="col-sm-2 control-label">Borrowers</label>                      
                    <div class="col-sm-10">
                           
                  <select placeholder="Choose Borrowers or search by name..." id="inputBorrowerIds" style="width: 100%;" name="group_borrower_ids[]"  class="labselector" multiple="multiple">
                        
                        <?php  
                       			 $borrowers = $this->db->get('tbl_customer')->result();
                       			 
                        ?>
                                                                  
                        <?php if (!empty($borrowers)): ?>
                            <?php foreach ($borrowers as $item) : ?>
                                <option value="<?php echo $item->customer_id ?>" <?php echo $this->session->userdata('customer_id') == $item->customer_id ?'selected':'' ?>>
                                   <?php echo $item->title.' '.$item->first_name.' '.$item->second_name.' '.$item->last_name.','; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                   </select>
            
                              <script type="text/javascript">
                                  $(".borrowers_select").chosen({
                                    disable_search_threshold: 1000,
                                    no_results_text: "No borrower found!",
                                    width: "95%",
                                    search_contains: true
                                  });
                              </script>
                   
                    </div>
                </div>  
                
                   <div class="box-footer">
                   
                </div>
                               
                <div class="form-group">
                    <label for="inputGroupLeader" class="col-sm-2 control-label">Group Leader</label>                      
                    <div class="col-sm-3">
                        <select class="form-control" name="group_leader_borrower_id" id="inputGroupLeader">
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <div style="padding-top:6px"><i>Select Borrowers above to update this field</i></div>
                    </div>
                </div> 
                 <div class="box-footer">
                   
                </div>
                <div class="form-group">
                    <label for="inputCollectorName" class="col-sm-2 control-label">Collector Name</label>                      
                    <div class="col-sm-10">
                        <input type="text" name="group_collector_name" class="form-control" id="inputCollectorName" placeholder="Collector Name" value="">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputMeetingSchedule" class="col-sm-2 control-label">Meeting Schedule</label>                      
                    <div class="col-sm-10">
                        <input type="text" name="group_meeting_schedule" class="form-control" id="inputMeetingSchedule" placeholder="Meeting Schedule" value="">
                    </div>
                </div>
                   <div class="box-footer">
                   
                </div>
                <div class="form-group">
                    <label for="inputGroupDescription" class="col-sm-2 control-label">Description</label>                      
                    <div class="col-sm-10">
                        <textarea name="group_description" class="form-control" id="inputGroupDescription" rows="3"></textarea>
                    </div>
                </div>
                      <div class="box-footer">
                   
                </div> 
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                </div><!-- /.box-footer -->
            </div>        
       
                <div class="box-footer">
                   
                </div>   
                
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
     </form>
</section>

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

       $(".labselector").select2();

   });
   
</script>
          <script>
          $(function() {
              
              $('#inputBorrowerIds').on('change',function() {
                  var selected_val = $( "#inputGroupLeader" ).val();
                  var selected_text = $( "#inputGroupLeader" ).text();
                  $('#inputGroupLeader option[value!=selected_val]').remove();
                  $("#inputBorrowerIds option:selected").each(function () {
                    
                    var $this = $(this);
                    if ($this.length) {
                        var optionExists = ($('#inputGroupLeader option[value=' + $(this).val() + ']').length > 0);
                        if(!optionExists)
                        {
                            $('#inputGroupLeader').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");
                            var exists = 0 != $('#inputGroupLeader option[value='+selected_val+']').length;
                            
                            if (exists)
                                $("#inputGroupLeader").val(selected_val);
                            else
                                $("#inputGroupLeader").val($("#inputGroupLeader option:first").val());
                        }
                    }
                    
                });
              });
            });
          </script>
