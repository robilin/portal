
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $collateral->collateral_name ?></h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">

    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="collateral-thumbnail">
                        <?php if(!empty($collateral->collateral_image_name)){?>
                            <img src="<?php echo base_url() . $collateral->collateral_image_name; ?>" class="img-circle" alt="collateral Image" width="250" height="250"/>
                        <?php }else{?>
                            <img src="<?php echo base_url(); ?>img/product.png" class="img-circle" alt="collateral Image"/ width="250" height="250">
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="collateral-barcode">
                        <img src="<?php echo base_url() . $collateral->barcode ?>" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-8">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="active" colspan="2"><?php echo $collateral->collateral_name ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="col-sm-3">Collateral Code</td>
                    <td><?php echo $collateral->collateral_serial_number ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Collateral Name</td>
                    <td class=""><?php echo $collateral->collateral_name ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Collateral Location</td>
                    <td class=""><?php echo $collateral->collateral_location ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Collateral Description</td>
                    <td><?php echo $collateral->collateral_note ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">collateral Category</td>
                    <td class=""><?php echo $collateral->collateral_type ?></td>
                </tr>
                <tr>
                    <th class="active" colspan="2" >collateral model & Brand</th>
                </tr>
                <tr>
                    <td class="col-sm-3">collateral Model</td>
                    <td class=""><?php echo $collateral->collateral_model ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Collateral Brand</td>
                    <td><?php echo $collateral->collateral_brand ?></td>
                </tr>
                
                
                <tr>
                    <th class="active" colspan="2">Acquiring & warranty dates</th>
                </tr>
                <tr>
                    <td class="col-sm-3">collateral Acquired Date</td>
                    <td><?php echo $collateral->collateral_acquired_date ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">collateral Warranty Start Date</td>
                    <td><?php echo $collateral->collateral_warranty_starts ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Collateral Warranty End Date</td>
                    <td><?php echo $collateral->collateral_warranty_ends ?></td>
                </tr>

                <tr>
                    <th class="active" colspan="2">Collateral Assign</th>
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
                                if(!empty($collateral->collateral_assignee)){
                                echo $collateral->collateral_assignee; 
                                } else{ echo 'Not assigned'; }?>
                                </td>
                                <td><?php
                                if(!empty($collateral->collateral_assigned_date)){
                                echo $collateral->collateral_assigned_date; 
                                } else{ echo ' '; }?>
                                </td>
                            </tr>
                           
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr>
                    <th class="active" colspan="2">collateral Status & Files</th>
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
                                    <td><?php echo $collateral->status ?></td>
                                     <td>
                                     <?php if (!empty($collateral->collateral_file_name)) {?>
                                    <a href="<?php echo  base_url() .$collateral->collateral_file_name ?>"><i class="glyphicon glyphicon-search"></i><span>view</span></a>
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
            <a href="<?php echo base_url(); ?>admin/collateral/add_collateral/<?php echo $collateral_id ?>" type="button" class="btn btn-primary">Edit collateral</a>

        </div>

</div>


