<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Messages Sent</h3>
                </div>
                <div class="box-body">
                

                
                        <!-- Table -->
                  <table id="datatable-responsive" class="table table-striped table-bordered datatable-buttons">
                    
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active">#</th>
                                <th class="active" width="15%">Message Receiver</th>
                                <th class="active">Message</th>
                                <th class="active">Timestamp</th>
                                <th class="active">View</th>
 								<th class="active">Delete</th>
 								<th class="active">Resend</th>
                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php 
                            
                            $customer_info=$this->db->get('tbl_sms_sent')->result();
                                                                                    
                            ?>
                   <?php $counter =1 ; ?>
                            <?php if (!empty($customer_info)): foreach ($customer_info as $v_customer) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td"><?php echo '255'.substr($v_customer->msg_receiver , -9); ?></td>
                                    <td class="vertical-td"><?php echo $v_customer->message ?></td> 
                                    <td class="vertical-td"><?php echo $v_customer->sent_timestamp ?></td>
                                        <td class="vertical-td">
                                        <div class="btn-group">
                                            
                                             <a href="<?php echo base_url() ?>admin/apis/view_customer_profile_sent_items/<?php echo '255'.substr($v_customer->msg_receiver , -9); ?>" class="btn btn-xs bg-orange" > History</a>                                                                                   
                                        </div>
                                    </td>
                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/apis/delete_msg_sent/'. $v_customer->id                                           
                                            ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"> Delete</i></a> 
                                            
                                        </div>
                                    </td>
 									<td class="vertical-td"><a href="<?php echo base_url(); ?>admin/apis/send_sms/<?php echo '255'.substr($v_customer->msg_receiver , -9); ?>"class="btn btn-xs btn-success"><i class="fa fa-envelope"> Resend</i></a>                                               </td>
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
