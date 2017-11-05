
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $asset->asset_name ?></h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="asset-thumbnail">
                        <?php if(!empty($asset->asset_image_name)){?>
                            <img src="<?php echo base_url() . $asset->asset_image_name; ?>" class="img-circle" alt="asset Image" width="250" height="250"/>
                        <?php }else{?>
                            <img src="<?php echo base_url(); ?>img/product.png" class="img-circle" alt="asset Image"/ width="250" height="250">
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="asset-barcode">
                        <img src="<?php echo base_url() . $asset->barcode ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-8">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="active" colspan="2"><?php echo $asset->asset_name ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="col-sm-3">Asset Code</td>
                    <td><?php echo $asset->asset_serial_number ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Asset Name</td>
                    <td class=""><?php echo $asset->asset_name ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Asset Location</td>
                    <td class=""><?php echo $asset->asset_location ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Asset Description</td>
                    <td><?php echo $asset->asset_note ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Asset Category</td>
                    <td class=""><?php echo $asset->asset_category_id ?></td>
                </tr>
                <tr>
                    <th class="active" colspan="2" >Asset model & Brand</th>
                </tr>
                <tr>
                    <td class="col-sm-3">Asset Model</td>
                    <td class=""><?php echo $asset->asset_model ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Asset Brand</td>
                    <td><?php echo $asset->asset_brand ?></td>
                </tr>
                
                
                <tr>
                    <th class="active" colspan="2">Acquiring & warranty dates</th>
                </tr>
                <tr>
                    <td class="col-sm-3">Asset Acquired Date</td>
                    <td><?php echo $asset->asset_acquired_date ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Asset Warranty Start Date</td>
                    <td><?php echo $asset->asset_warranty_starts ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Asset Warranty End Date</td>
                    <td><?php echo $asset->asset_warranty_ends ?></td>
                </tr>

                <tr>
                    <th class="active" colspan="2">Asset Assign</th>
                </tr>

                <tr>
                    <td class="no-border" colspan="2">

                        <table class="table table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>
                                    Assigned to
                                </th>
                                <th>
                                    assigned Date
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php 
                                if(!empty($asset->asset_assigned_to)){
                                echo $asset->asset_assigned_to; 
                                } else{ echo 'Not assigned'; }?>
                                </td>
                                <td><?php
                                if(!empty($asset->asset_assigned_date)){
                                echo $asset->asset_assigned_date; 
                                } else{ echo ' '; }?>
                                </td>
                            </tr>
                           
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <th class="active" colspan="2">Asset Status & Files</th>
                </tr>

                <tr>
                    <td class="no-border" colspan="2">

                        <table class="table table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>
                                    Status
                                </th>
                                <th>
                                    File
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            
                                <tr>
                                    <td><?php echo $asset->status ?></td>
                                     <td>
                                     <?php if (!empty($asset->asset_file_name)) {?>
                                    <a href="<?php echo  base_url() .$asset->asset_file_name ?>"><i class="glyphicon glyphicon-search"></i><span>view</span></a>
                                     <?php } else echo "No file available"?>
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </td>
                </tr>
                
               </tbody>
            </table>

        </div>
    </div>


    <div class="modal-footer" >

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <a href="<?php echo base_url(); ?>admin/asset/add_asset/<?php echo $asset_id ?>" type="button" class="btn btn-primary">Edit asset</a>

        </div>

</div>


