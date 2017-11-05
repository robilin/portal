<script src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">


        <div class="col-md-12">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        Product Barcode Print
                    </h3>
                    <div class="pull-right">
                        <h1 class="portlet-title text-dark text-uppercase">
                            <a href="<?php echo site_url('admin/product/manage_product')?>" style="font-size: 25px"> <strong><i class="fa fa-times" aria-hidden="true"></i></strong> </a>
                        </h1>
                    </div>
                </div>
                <div id="portlet2" class="panel-collapse collapse in">
                    <div class="portlet-body">

                        <form method="post" action="<?php echo base_url() ?>admin/product/add_to_print">


                            <div class="row">
                                <div class="col-md-5 col-sm-12">

                                    <div class="box box-warning">

                                        <div class="box-tools">

                                            <div class="input-group">

                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-primary btn-block">Add to Print</button>
                    </span>
                                            </div>

                                        </div>


                                        <div class="box-body">





                                            <!-- ***************  General Tab Start ****************** -->


                                            <!-- Table -->
                                            <table class="table table-bordered table-hover purchase-products" id="dataTables-example">

                                                <thead ><!-- Table head -->

                                                <tr>

                                                    <th class="active"><input type="checkbox" class="checkbox-inline" id="parent_present" /></th>
                                                    <th class="active">Product Code</th>
                                                    <th class="active">Product Name</th>


                                                </tr>
                                                </thead><!-- / Table head -->
                                                <tbody><!-- / Table body -->


                                                <?php if (!empty($product)): foreach ($product as $v_product) : ?>
                                                    <tr class="custom-tr">
                                                        <td class="vertical-td"><input name="product_id[]" value="<?php echo $v_product->product_id ?>" class="child_present" type="checkbox" /></td>
                                                        <td class="vertical-td highlight"><?php echo $v_product->product_code ?></td>
                                                        <td class="vertical-td"><small><?php echo $v_product->product_name ?></small></td>


                                                    </tr>
                                                    <?php

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
                                <div class="col-md-7 col-sm-12">

                                    <div class="box box-info">
                                        <div class="box-header box-header-background-light with-border">
                                            <h3 class="box-title ">Print Barcode</h3>
                                            <div class="box-tools pull-right">
                                                <!-- Buttons, labels, and many other things can be placed here! -->
                                                <!-- Here is a label for example -->
                                                <div class="box-tools">
                                                    <div class="btn-group" role="group" >
                                                        <a onclick="print_invoice('printableArea')" class="btn btn-default ">Print</a>
                                                        <a href="<?php echo base_url() ?>admin/product/clear_print_tray/" class="btn btn-default ">Clear Print Tray</a>
                                                    </div>
                                                </div>

                                            </div><!-- /.box-tools -->
                                        </div>


                                        <div class="box-body">
                                            <div id="printableArea">
                                                <div class="row">
                                                    <?php
                                                    if(!empty($_SESSION["barcode"])){
                                                        ?>
                                                        <?php foreach($_SESSION["barcode"] as $barcode){ ?>

                                                            <div class="col-sm-3 text-center" style="margin: 20px 0px 20px 5px">
                                                                <?php

                                                                $product_name = $barcode['product_name'];
                                                                $name_product = wordwrap($product_name, 10, "\n", true);
                                                                ?>
                                                                <small><?php echo $name_product?></small></br>
                                                                <img src="<?php echo base_url() . $barcode['barcode']?>" style="max-width:150%; height:auto">
                                                            </div>
                                                        <?php }?>
                                                    <?php }else {?>
                                                        <div class="col-md-12">
                                                            <?php echo "There is No Product Barcode for Print" ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                        </div><!-- /.box-body -->

                                    </div>
                                    <!-- /.box -->

                                </div>
                                <!--/.col end -->


                            </div>


                        </form>

                    </div>
                </div>
            </div>
        </div>


    </div>
</section>



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

