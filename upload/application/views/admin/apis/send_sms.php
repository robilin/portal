<cript src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<section class="content">
   <div class="row">
      <form action="<?php echo base_url() ?>admin/apis/alert" method="post">
         <div class="col-md-12">
            <div class="box box-primary">
             <div class="box-header box-header-background with-border">
                  <h3 class="box-title "><?php echo $title; ?></h3>
               </div>
               <!-- /.box-header -->
               <div class="box-background">
            

      </div>
      <div class="box-body">
      
      
                    <?php if(!empty($phone)){?>
                    	 <input type="text"  name="phone[]"  required
                                 value="<?php if (!empty($phone)) {echo $phone; }
                                    else{echo $phone;}
                                    ?>"
                                 class="form-control">
                    <?php }else{
                    
                        ?>
                <input type="text"  required  name="phone[]"  class="form-control">
                
                   <?php }?>
                   <hr>
       <textarea id="myTextarea" maxLength="160" cols="139" rows="3" required name="message"></textarea>
	   <p id="counter"></p>

      </div>
  
      </div>
      
       <span class="input-group-btn">
              <button type="submit" class="btn bg-blue" type="button" data-placement="top" data-toggle="tooltip">SEND SMS</button>
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

<script type="text/javascript">
$('#myTextarea').keyup(function () {
    var left = 160 - $(this).val().length;
    if (left < 0) {
        left = 0;
    }
    $('#counter').text('Characters left: ' + left);
});
</script>

