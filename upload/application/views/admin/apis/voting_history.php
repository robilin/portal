<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Vote History</h3>
                </div>
                <div class="box-body">
                

                
                        <!-- Table -->
                  <table id="datatable-responsive" class="table table-striped table-bordered datatable-buttons">
                    
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">#</th>
                                <th class="active">Date</th>
                                <th class="active">Customer</th>
                                <th class="active">Vote</th>
                                <th class="active">Vote For</th>
 								<th class="active">Cost</th>
 							
                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php 
                            
                            $customer_info=$this->db->get('tbl_votes')->result();
                                                                                    
                            ?>
                   <?php $counter =1 ; ?>
                            <?php if (!empty($customer_info)): foreach ($customer_info as $v_customer) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td"><?php echo '255'.substr($v_customer->time_stamp, -9); ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->msisdn ?></td> 
                                    <td class="vertical-td"><?php echo $v_customer->keyword ?></td>
                                   <td class="vertical-td"><?php $desc=$this->db->get_where('tbl_competition',array('keyword'=>$v_customer->keyword))->result();
                        foreach ($desc as $v_desc){
                           echo $v_desc->description;
                        } ?> 
                        </td>
                                    <td class="vertical-td"><?php echo $v_customer->cost ?></td>
 									                                             
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
