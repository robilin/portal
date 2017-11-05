<script src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<?php
$info = $this->session->userdata('business_info');
if(!empty($info->currency))
{
    $currency = $info->currency ;
}else
{
    $currency = 'TZS';
}
?>



<div class="row">
<div class="col-md-12">
    <div class="portlet"><!-- /primary heading -->

        <div class="portlet-heading">
            <h3 class="portlet-title text-dark text-uppercase">
                Purchase Product
            </h3>
           <div class="pull-right">
               <h1 class="portlet-title text-dark text-uppercase">
                 <a href="<?php echo site_url('admin/purchase/purchase_list')?>" style="font-size: 25px"> <strong><i class="fa fa-times" aria-hidden="true"></i></strong> </a>
               </h1>
           </div>
        </div>
   
        <div id="portlet2" class="panel-collapse collapse in">
            <div class="portlet-body">


                <div class="row">
                    <div class="col-md-6 col-sm-12">

                        <div class="box box-warning">
                            <div class="box-header box-header-background-light with-border">
                                <h3 class="box-title ">Select Product</h3>
                            </div>


                            <div class="box-body">


                                <table class="table table-bordered table-hover purchase-products" id="dataTables-example">
                                    <thead ><!-- Table head -->
                                    <tr>
                                        <th class="active col-sm-1">Sl</th>
                                        <th class="active">Product Code</th>
                                        <th class="active">Product Name</th>
                                        <th class="active">Inventory</th>
                                        <th class="active">Purchase</th>

                                    </tr>
                                    </thead><!-- / Table head -->
                                    <tbody><!-- / Table body -->

                                    <?php $counter =1 ; ?>
                                    <?php if (!empty($product)): foreach ($product as $v_product) : ?>
                                        <tr class="custom-tr">
                                            <td class="vertical-td">
                                                <?php echo  $counter ?>
                                            </td>
                                            <td class="vertical-td highlight"><?php echo $v_product->product_code ?></td>
                                            <td class="vertical-td"><?php echo $v_product->product_name ?></td>
                                            <td class="vertical-td currency">
                                                <?php
                                                if($v_product->notify_quantity >= $v_product->product_quantity)
                                                { ?>
                                                    <span class="label label-warning"><?php echo $v_product->product_quantity ?></span>
                                                <?php } else { ?>
                                                    <?php echo $v_product->product_quantity ?>
                                                <?php } ?>
                                            </td>
                                            <td class="vertical-td " >
                                                <form action="<?php echo base_url(); ?>admin/purchase/add_cart_item" method="post">
                                                    <input type="hidden" name="product_id" value="<?php echo $v_product->product_id ?>">
                                                    <button type="submit" class="btn btn-primary btn-xs" title="Purchase" data-toggle="tooltip" data-placement="top"><i class="fa fa-shopping-cart"></i></button>

                                                </form>

                                            </td>

                                        </tr>
                                        <?php
                                        $counter++;
                                    endforeach;
                                        ?><!--get all sub category if not this empty-->
                                    <?php else : ?> <!--get error message if this empty-->
                                        <td colspan="6">
                                            <strong>There is no record for display</strong>
                                        </td><!--/ get error message if this empty-->
                                    <?php endif; ?>

                                    </tbody><!-- / Table body -->

                                </table> <!-- / Table -->


                            </div><!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div><!--/.col end -->

                    <!-- *********************** Purchase ************************** -->
                    <div class="col-md-6 col-sm-12">
                        <form method="post" action="<?php echo base_url() ?>admin/purchase/save_purchase">
                            <div class="box box-info">
                                <div class="box-header box-header-background-light with-border">
                                    <h3 class="box-title  ">Purchase Order</h3>
                                </div>

                                <div class="box-background">
                                        <div class="row">

                                            <div class="col-md-6">

                                                <label>Supplier</label>
                                                <select class="form-control" name="supplier_id" required>

                                                    <option value="">Select Supplier</option>

                                                    <?php foreach($supplier as $v_supplier):?>
                                                        <option value="<?php echo $v_supplier->supplier_id; ?>"><?php echo $v_supplier->company_name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Date</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control datepicker" name="purchase_date" data-format="yyyy/mm/dd" value="<?php echo date("Y/ m/ d");?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                </div>


                                <div class="box-footer">

                                </div>

                                <!-- Table -->
                                <div id="cart_content">
                                    <?php echo $this->view('admin/purchase/cart/cart.php'); ?>
                                </div>


                            </div>
                            <!-- /.box -->
                        </form>
                    </div>
                    <!--/.col end -->


                </div>



            </div>
        </div>
    </div>
</div>
</div>





<script>

    $().ready(function() {

        // validate signup form on keyup and submit
        $("#newform").validate({
            rules: {
                product_name: "required",
                qty: "required",

                product_name: {
                    required: true
                },
                qty: {
                    required: true,
                    number: true
                },

                price: {
                    required: true,
                    number: true

                }

            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {

                product_name: {
                    required: "Please enter Product Name"
                }



            }

        });

    });
</script>

