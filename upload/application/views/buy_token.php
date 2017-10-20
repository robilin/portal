
<cript src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>

 <style type="text/css">
 
body{
    font-family: "Roboto", Arial, sans-serif;
    font-size: 16px;
    line-height: 28px;
    font-weight: 300;
    color: #ffffff;
    height: 100%;
    position: relative;
}

.input-bg{
    background-color:#fff;
    color: #FFF;
}

.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #fff;
    z-order: 0;

}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}



@media (min-width: 1200px) {
    .token-container{
        width:900px;
    }
}

    </style>



	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,600,400italic,700' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link href="<?php echo base_url(); ?>asset/css/animate.css">
	<!-- Flexslider -->
	<link href="<?php echo base_url(); ?>asset/css/flexslider.css">
	<!-- Icomoon Icon Fonts-->
	<link href="<?php echo base_url(); ?>asset/css/icomoon.css">
	<!-- Magnific Popup -->
	<link href="<?php echo base_url(); ?>asset/magnific-popup.css">
	<!-- Bootstrap  -->

<div class="fh5co-loader"></div>
<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<div class="token-container">
<section class="content">
 <div class="row">
 <div class="col-md-12 col-md-offset-6">

<br/><br/><br/>          
       

<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Select Meter Number</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Choose payment method</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Finish Token Purchase</p>
        </div>
    </div>
</div>
<form action="<?php echo base_url() ?>admin/apis/process_sms" method="post">
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <div class="box-body">
                <div class="form-group">
                        <select placeholder="Click here to select meter number..." style="width: 99%;" required name="phone[]"  class="labselector" multiple="multiple">
                        
                        <?php  
                       			 $meter = $this->db->get('tbl_meter')->result();
                        ?>
                                                                  
                        <?php if (!empty($meter)): ?>
                            <?php foreach ($meter as $item) : ?>
                                <option value="<?php echo $item->meter_number ?>" <?php echo $this->session->userdata('meter_number') == $item->meter_number ?'selected':'' ?>>
                                   <?php echo $item->meter_number; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                   </select>
                </div>
                <div class="form-group">
                 
                    <input type="number" name="amount" id="amount" class="form-control input-bg payment-method" placeholder="Amount" >
                  
                </div>
                
                <button class="btn btn-primary nextBtn btn pull-right " type="button" >Next</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                	<div class="form-group">
						<select class="payment-method" style="width: 100%;">
						    <option value=" ">Select Payment Method</option>
  							<option value="1">M-Pesa</option>
  							<option value="2">Tigo Pesa</option>
     						<option value="3">Airtel Money</option>
     						<option value="4">Paypal/Card</option>
     						<option value="5">Bank transfer</option>
					</select>
					</div>
                
                <button class="btn btn-primary nextBtn btn pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Step 3</h3>
                <button class="btn btn-success btn pull-right" type="submit">Finish!</button>
            </div>
        </div>
    </div>
</form>



   </div>
   </div>
   <!-- /.row -->
</section>
</div>
<script>
    jQuery(window).load(function(){
        jQuery(".fh5co-loader").fadeOut(500);
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

       $(".labselector").select2();

   });
   
</script>

<script type="text/javascript">
$(document).ready(function() {
  $(".payment-method").select2();
});
</script>

<script type="text/javascript">
$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>

