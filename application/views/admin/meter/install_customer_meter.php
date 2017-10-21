<cript src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<section class="content">
   <div class="row">
     <form method="post" id="OrderForm" action="<?php echo base_url().'admin/meter/save_install_meter/'.$customer_id ?>">
         <div class="col-md-12">
            <div class="box box-primary">
             <div class="box-header box-header-background with-border">
                  <h3 class="box-title "><?php echo $title; ?></h3>
               </div>
               <!-- /.box-header -->
               <div class="box-background">
            

      </div>
      <div class="box-body">
      
               <div class="form-group">
                        <select placeholder="Click here to select meter number..." style="width: 99%;" required name="meter_id"  class="labselector" multiple="multiple">                                      
                        <?php if (!empty($meter)): ?>
                            <?php foreach ($meter as $item) : ?>
                                <option value="<?php echo $item->meter_id ?>" <?php echo $this->session->userdata('meter_number') == $item->meter_number ?'selected':'' ?>>
                                   <?php echo $item->meter_number; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                   </select>
                </div>
                    <!-- /.warranty starts -->
                                            <div class="form-group form-group-bottom">
                                                <label>Install Date </label>
                                                </div>
                                                <div class="input-group">
                                                <input type="text" placeholder="install date"
                                                       value="<?php
                                                       if (!empty($meter_info->install_date)) {
                                                           $install_date = date('Y/m/d', strtotime($meter_info->install_date));
                                                          echo $install_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="meter_date" name="install_date" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>

      </div>
  
      </div>
      
       <span class="input-group-btn">
              <button type="submit" class="btn bg-blue" type="button" data-placement="top" data-toggle="tooltip">INSTALL</button>
        </span>
      <!-- /.box -->
      </div>
       
      </form>
      <!--/.col end -->
   </div>
   <!-- /.row -->
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

       $(".labselector").select2();

   });
   
</script>


