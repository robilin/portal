<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>

<script src="<?php echo base_url(); ?>asset/js/ajax.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>


<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
            <div class="box-header box-header-background with-border">
                    <h3 class="box-title "><?php echo $title ?></h3>
                </div>
    <form role="form" enctype="multipart/form-data" id="addCustomerForm"
                      action="<?php echo base_url(); ?>admin/account/save_invoice/<?php if(!empty($invoice_no)){
                          echo $invoice_no;
                      }?>"
                      method="post">         
                
                <!-- /.box-header -->
                 <div class="box-footer">
                </div>
                
               <div class ="row">
               <div class="container">
                		<div class="row clearfix">
                			<div class="col-md-8 column">
                				                                    <!-- /.Attribute Start -->
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="table">
                                                <table class="table">
                                                    <thead>

                                                    <tr>
                                                        <th class="">Invoice Title</th>
                                                        <th class="">Invoice no</th>
                                                        <th class="">Customer</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                                <tr>
                                                                                                                                
                                                                    <td>
                                                                      <input type="text" name="invoice_title" placeholder="Label" value="" class="form-control selector" autocomplete="off">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" name="invoice_no" placeholder="Label"
                                                                               value="<?php echo $invoice_no ?>" class="form-control selector" autocomplete="off">
                                                                    </td>
                                                                    <td>
                     <select id="customer" style="width: 100%;" name="customer" onchange="getCustomer(this)">
                        <option value="">Select Customer</option>
                        <?php    
                        
                        $customer = $this->db->get('tbl_customer')->result(); 
                       			 
                        ?>
                        <?php if (!empty($customer)): ?>
                            <?php foreach ($customer as $v_customer) : ?>
                                <option value="<?php echo $v_customer->customer_id.','.$v_customer->customer_id; ?>" <?php echo $this->session->userdata('customer_id') == $v_customer->customer_id ?'selected':'' ?>>
                                    <?php echo $v_customer->customer_id.'-'.$v_customer->customer_name ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </select>
                  
                                                                    </td>
                                                                 </tr>
                                                         
                       
                                                        
                                                    </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           </div>
                                                    
               </div>
                <div class="row">
                	<div class="container">
                		<div class="row clearfix">
                			<div class="col-md-8 column">
                				                                    <!-- /.Attribute Start -->
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="table">
                                                <table class="table" id="attributeFields">
                                                    <thead>

                                                    <tr>
                                                        <th class="">Description</th>
                                                        <th class="">Quantity</th>
                                                        <th class="">Price</th>
                                                        <th class="col-sm-2"> <a  href="javascript:void(0);" class="addAttribute btn btn-info "><i class="fa fa-plus"></i> Add More</a></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(!empty($attribute)){ ?>
                                                            <?php foreach($attribute as $v_attribute){ ?>

                                                                <tr>
                                                                                                                                
                                                                    <td>
                                                                        <input type="text" name="attribute_description[]" placeholder="Label"
                                                                               value="<?php echo $v_attribute->attribute_description ?>" class="form-control selector" autocomplete="off">
                                                                    </td>
                                                                    <td>

                                                                        <input type="text" name="attribute_quantity[]" placeholder="Value"
                                                                               value="<?php echo $v_attribute->attribute_quantity ?>" class="form-control">

                                                                    </td>
                                                                  
                                                                    <td>
                                                                        <?php echo btn_delete('admin/product/delete_attribute/' . $v_attribute->customer_invoice_id); ?>
                                                                    </td>
                                                                    <input type="hidden" name="attribute_id[]" value="<?php echo $v_attribute->customer_invoice_id ?>">
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } else { ?>

                                                            <tr>
                                                                <td>


                                                                    <input type="text"  name="attribute_description[]" placeholder="Description"
                                                                           value="" class="form-control selector" autocomplete="off">
                                                                </td>
                                                                <td>

                                                                    <input type="text" name="attribute_quantity[]" placeholder="Quantity"
                                                                           value="" class="form-control">

                                                                </td>
                                                                <td>

                                                                    <input type="text" name="attribute_price[]" placeholder="Price"
                                                                           value="" class="form-control">

                                                                </td>
                                                            </tr>
                                                        <?php }  ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- /.box-body -->
                                    </div><!-- /.box -->
                                    <!-- /.Attribute End -->
                		</div>
                	</div>
                	</div>
                </div>
                 <div class="row clearfix">
    <div class="col-md-6">
    <span class="input-group-btn">
    <button  type="submit" id="submit" class="btn bg-green pull-left"   data-placement="top" data-toggle="tooltip">Add New Invoice</button>
    </span>
    </div>
    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
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

       $("#visit").select2({
           placeholder: "Select a State",
           allowClear: true
       });

   });
   
</script>

<script lang="javascript">


    $(document).ready(function() {


        //***************** Product Attribute Start ***************//
        $(".addAttribute").click(function() {
            $("#attributeFields").append(
                '<tr>\
                    <td>\
                        <input type="text"  name="attribute_description[]" placeholder="Label"\
            value="" class="form-control selector ui-autocomplete-input" autocomplete="off">\
                    </td>\
                    <td>\
                        <input type="text" name="attribute_quantity[]" placeholder="Value"\
            value="" class="form-control">\
                        </td>\
                        <td>\
                        <input type="text" name="attribute_price[]" placeholder="Value"\
            value="" class="form-control">\
                        </td>\
                        <td><a href="javascript:void(0);" class="remAttribute">Remove</a></td>\
                        <input type="hidden" name="class_routine_details_id[]" value="">\
                    </tr>'
            );
        });
        //***************** Product Attribute End *****************//

        //Remove Attribute Fields
        $("#attributeFields").on('click', '.remAttribute', function() {
            $(this).parent().parent().remove();
        });
      

    });
</script>


<script>
    var options = {
        source: [
            <?php
           if(!empty($invoice_set))
           foreach($invoice_set as $v_attribute){
           echo "'$v_attribute->attribute_description',";
           }
           ?>
        ]

    };
    var result = 'input.selector';
    $(document).on('keydown.autocomplete', result, function() {
        $(this).autocomplete(options);
    });

</script>