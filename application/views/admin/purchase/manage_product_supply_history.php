<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title "><?php echo $title ?></h3>
                </div>


                <div class="box-body">

                        <!-- Table -->
                    <table id="datatable" class="table table-striped table-bordered datatable-buttons" style="width: 100%">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Sl</th>
                                <th class="active">Product Code</th>
                                <th class="active">Product Name</th>
                                <th class="active">Company Name</th>
                                <th class="active">Supplier Phone</th>
                                <th class="active">Email</th>
                                <th class="active">Price</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($supply)): foreach ($supply as $v_supply) : ?>
                                 <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_supply->product_code ?></td>
                                    <td class="vertical-td"><?php echo $v_supply->product_name ?></td>
                                    <td class="vertical-td"><?php echo $v_supply->supplier_name ?></td>
                                    <td class="vertical-td"><?php echo $v_supply->phone ?></td>
                                    <td class="vertical-td"><?php echo $v_supply->email ?></td>
                                    <td class="vertical-td"><?php echo $v_supply->unit_price ?></td>
                                    <td class="vertical-td">
                                       <?php echo btn_view('admin/purchase/purchase_invoice/' . $v_supply->purchase_id); ?>

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
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>

<script>
    $('body').on('hidden.bs.modal', '.modal', function() {
        $(this).removeData('bs.modal');
    });

</script>



