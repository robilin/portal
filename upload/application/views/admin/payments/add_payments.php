<cript src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>

 <style type="text/css">

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
    background-color: #ccc;
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
    </style>

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<section class="content">
 <div class="row">
 <div class="box-header box-header-background with-border">
                  <h3 class="box-title "><?php echo $title; ?></h3>
               </div>
               
                     <div class="box-background">
            

      </div>

<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
            <p>Start</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
            <p>Payment</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
            <p>Finish</p>
        </div>
    </div>
</div>
<form action="<?php echo base_url() ?>admin/payments/save_payments" method="post">
    <div class="row setup-content" id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <div class="box-body">
                <div class="form-group">
                        <select placeholder="Click here to select meter number..." style="width: 99%;" required name="meter_number"  class="labselector">
                        
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
                 
                    <input type="number" required name="amount" id="amount" class="form-control" placeholder="Amount" >
                  
                </div>
                
                <button class="btn btn-primary nextBtn btn pull-right" type="button" >Next</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row setup-content" id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                	<div class="form-group">
						<select required name="payment_method" class="payment-method" style="width: 100%;">
						 	<option value="1">M-Pesa</option>
  							<option value="TigoPesa">Tigo Pesa</option>
     						<option value="AirtelMoney">Airtel Money</option>
     						<option value="Paypal">Paypal</option>
     						<option value="CreditCard">Credit card</option>
     						<option value="BankTransfer" selected="selected">Bank transfer</option>
					</select>
					</div>
                
                <button class="btn btn-primary nextBtn btn pull-right" type="button" >Next</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <p> Enter Payment Details</p>
                 <div class="form-group">
                 
                    <input type="text" required name="reference" id="reference" class="form-control" placeholder="Payment reference number" >
                  
                </div>
                 <div class="form-group">
                 
                    <input type="text" required name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile number that can receive token" >
                  
                </div>
                
            </div>
        </div>
        <button class="btn btn-success btn pull-right" type="submit">Finish!</button>
    </div>
    
</form>



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

