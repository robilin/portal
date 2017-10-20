<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Manage Tenants</h3>
                </div>
                <div class="box-body">
                        <!-- Table -->
                    <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">#</th>
                                <th class="active">Full Name</th>
                                <th class="active">Gender</th>
                                <th class="active">Business</th>
                                <th class="active">Mobile</th>
                                <th class="active">Email</th>
                                <th class="active">Parent Account</th>
                                <th class="active">Status</th>
                                <th class="active">View</th>
 								<th class="active">Actions</th>
                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($customer_info)): foreach ($customer_info as $v_customer) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td" width="17%"><?php echo $v_customer->first_name.' '.$v_customer->last_name ?></td>
                                     <td class="vertical-td"><?php echo $v_customer->gender ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->business_name ?></td>
                                   
                                    <td class="vertical-td"><?php echo $v_customer->phone ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->email ?></td>
                                    <td class="vertical-td">
                                    <?php 
                                    
                                   
                                    if($v_customer->parent_id>0){
                                    $parent=$this->db->get_where('tbl_user',array('user_id' =>$v_customer->parent_id))->result();
                                    foreach ($parent as $value) {
                                        
                                    	echo $value->name;
                                        
                                    }
                                    
                                    }else{
                                        echo 'System';
                                    }
                                    
                                    
                                    ?>
                                    </td>
                                    <td class="vertical-td">
                                        <?php
                                        if($v_customer->status=='approved')
                                        { ?>
                                            <span class="label label-danger"><?php echo $v_customer->status ?></span>
                                        <?php } else { ?>
                                   <a href="<?php echo base_url().'admin/customer/approve_account/'. $v_customer->customer_id ?>" class="btn btn-xs bg-olive" ><?php echo $v_customer->status ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            
                                             <a href="<?php echo base_url().'admin/customer/view_customer_profile/'. $v_customer->customer_id ?>" class="btn btn-xs bg-olive" >Profile</a>                                                                                   
                                        </div>
                                    </td>
                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/customer/add_customer/'. $v_customer->customer_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo base_url().'admin/customer/delete_customer/'. $v_customer->customer_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>                                              
                                        </div>
                                    </td>

                                </tr>
                            <?php
                                $counter++;
                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="7">
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




