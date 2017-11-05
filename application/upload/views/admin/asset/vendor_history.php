<?php
$info = $this->session->userdata('business_info');
if(!empty($info->currency))
{
    $currency = $info->currency ;
}else
{
    $currency = '$';
}
?>
<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title "><?php echo $vendor->company_name ?></h3>
                </div>

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-4 col-md-offset-2">
                          <strong>Company Name:</strong>  <?php echo $vendor->company_name ?>
                        </div>
                        <div class="col-md-6">
                            <strong>vendor Name:</strong>  <?php echo $vendor->vendor_name ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-md-offset-2">
                            <strong>Email:</strong>  <?php echo $vendor->email ?>
                        </div>
                        <div class="col-md-6">
                            <strong>Phone:</strong>  <?php echo $vendor->phone ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-2">
                            <strong>Address:</strong>  <?php echo $vendor->address ?>
                        </div>

                    </div>

                </div>
                <div class="box-body">

                        <!-- Table -->
                        <table class="table table-bordered table-hover" id="dataTables-example">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">Sl</th>
                                <th class="active">Invoice No.</th>
                                <th class="active">vendor Name</th>
                                <th class="active">asset Date</th>
                                <th class="active">Grand Total</th>
                                <th class="active">asset By</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($asset)): foreach ($asset as $v_asset) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td">INV-<?php echo $v_asset->asset_order_number ?></td>
                                    <td class="vertical-td"><?php echo $v_asset->vendor_name ?></td>
                                    <td class="vertical-td"><?php echo date('Y-m-d', strtotime($v_asset->datetime )) ?></td>
                                    <td class="vertical-td"><?php echo $currency .' '. number_format($v_asset->grand_total,2) ?></td>
                                    <td class="vertical-td"><?php echo $v_asset->asset_by ?></td>

                                    <td class="vertical-td">
                                        <?php echo btn_view('admin/asset/asset_invoice/' . $v_asset->asset_id); ?>

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




