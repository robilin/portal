<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Manage Borrowers Group</h3>
                </div>
                <div class="box-body">
                        <!-- Table -->
                    <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active col-sm-1">#</th>
                                <th class="active">Group Name</th>
                                <th class="active">Borrowers</th>
                                <th class="active">Group Leader</th>
                                <th class="active">Collector</th>                                
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
                                    <td class="vertical-td" width="17%"><?php echo $v_customer->group_name ?></td>
                                    <td class="vertical-td"><?php $ids=$v_customer->group_borrower_ids;
                                  
   										
										
   										$replace1=str_replace('["','',$ids);
   										$replace2=str_replace('"]','',$replace1);
   										$replace3=str_replace('"','',$replace2);
   										
   									    $pieces = explode(",",$replace3);
   										
   									    for ($i = 0; $i < sizeof($pieces); $i++) {
   									    	$members=$this->db->get_where('tbl_customer',array('customer_id'=>$pieces[$i]),true)->result();
   											foreach ($members as $value) {
   												echo $value->first_name.' '.$value->second_name.' '.$value->last_name.' , ';
   												} 
   												
   									    }  										

                                    ?></td>
                                    <td class="vertical-td"><?php 
                                    $group_leader=$this->db->get_where('tbl_customer',array('customer_id'=>$v_customer->group_leader_borrower_id))->result();
                                    foreach ($group_leader as $value) {
                                    	$group_leader=$value->first_name.' '.$value->second_name.' '.$value->last_name;
                                    }
                                    echo $group_leader;
                                    ?>
                                    
                                    
                                    </td>
                                    <td class="vertical-td"><?php echo $v_customer->group_collector_name ?></td>
                                                                        
                                        <td class="vertical-td" width="20%">
                                        <div class="btn-group">
                                             <a href="<?php echo base_url().'admin/customer/view_group_details/'. $v_customer->loan_group_id ?>" class="btn btn-xs bg-olive" >View / Modify</a>                                                                                   
                                        </div>
                                    </td>
                                      <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/customer/add_borrowers_group/'. $v_customer->loan_group_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo base_url().'admin/customer/delete_borrowers_group/'. $v_customer->loan_group_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>                                              
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




