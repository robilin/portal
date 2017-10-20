<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $meter->meter_number ?></h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="meter-thumbnail">
                        <?php if(!empty($meter->meter_image_name)){?>
                            <img src="<?php echo base_url() . $meter->meter_image_name; ?>" class="img-circle" alt="meter Image" width="250" height="250"/>
                        <?php }else{?>
                            <img src="<?php echo base_url(); ?>img/product.png" class="img-circle" alt="meter Image"/ width="250" height="250">
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="meter-barcode">
                        <img src="<?php echo base_url() . $meter->barcode ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-8">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="active" colspan="2"><?php echo $meter->meter_number ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="col-sm-3">Serial number</td>
                    <td><?php echo $meter->meter_serial_number ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Meter Number</td>
                    <td class=""><?php echo $meter->meter_number ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Meter Location</td>
                    <td class=""><?php echo $meter->meter_location ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Meter Description</td>
                    <td><?php echo $meter->meter_note ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Meter Type</td>
                    <td class=""><?php echo $meter->meter_type ?></td>
                </tr>
                <tr>
                    <th class="active" colspan="2" >Meter model & Brand</th>
                </tr>
                <tr>
                    <td class="col-sm-3">Meter Model</td>
                    <td class=""><?php echo $meter->meter_model ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Meter Brand</td>
                    <td><?php echo $meter->meter_brand ?></td>
                </tr>
                
                
                <tr>
                    <th class="active" colspan="2">Acquiring & warranty dates</th>
                </tr>
                <tr>
                    <td class="col-sm-3">Meter Acquired Date</td>
                    <td><?php echo $meter->meter_acquired_date ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Meter Warranty Start Date</td>
                    <td><?php echo $meter->meter_warranty_starts ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Meter Warranty End Date</td>
                    <td><?php echo $meter->meter_warranty_ends ?></td>
                </tr>

                <tr>
                    <th class="active" colspan="2">Meter Assign</th>
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
                                    Assigned Date
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php 
                                if(!empty($meter->meter_assignee)){
                                echo $meter->meter_assignee; 
                                } else{ echo 'Not assigned'; }?>
                                </td>
                                <td><?php
                                if(!empty($meter->meter_assigned_date)){
                                echo $meter->meter_assigned_date; 
                                } else{ echo ' '; }?>
                                </td>
                            </tr>
                           
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <th class="active" colspan="2">Meter Status & Files</th>
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
                                    <td><?php echo $meter->status ?></td>
                                     <td>
                                     <?php if (!empty($meter->meter_file_name)) {?>
                                    <a href="<?php echo  base_url() .$meter->meter_file_name ?>"><i class="glyphicon glyphicon-search"></i><span>view</span></a>
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
            <a href="<?php echo base_url(); ?>admin/meter/add_meter/<?php echo $meter_id ?>" type="button" class="btn btn-primary">Edit meter</a>

        </div>

</div>


