<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary ">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Manage Expense</h3>
                </div>


                <div class="box-body">

                        <!-- Table -->
                    <table id="datatable" class="table table-striped table-bordered datatable-buttons" style="width: 100%">
                            <thead ><!-- Table head -->
                            <tr>
                                <th class="active col-sm-1 ">Sl</th>
                                <th class="active">Expense Category</th>
                                <th class="active">Amount</th>
                                <th class="active">Employee</th>
                                <th class="active">Description</th>
                                <th class="active">Created on</th>
 								<th class="active">Created by</th>
                                <th class="active">Action</th>

                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php $counter =1 ; ?>
                            <?php if (!empty($expense)): foreach ($expense as $v_expense) : ?>
                                <tr class="custom-tr">
                                    <td class="vertical-td">
                                        <?php echo  $counter ?>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_expense->expense_category_id ?></td>
                                    <td class="vertical-td"><?php echo $v_expense->amount ?></td>
                                    <td class="vertical-td"><?php echo $v_expense->employee ?></td>
                                    <td class="vertical-td"><?php echo $v_expense->description ?></td>
                                    <td class="vertical-td"><?php echo $v_expense->date_time_created ?></td>
									<td class="vertical-td"><?php echo $v_expense->created_by ?></td>

                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/expense/add_expense/'. $v_expense->expense_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo base_url().'admin/expense/view_expense/'. $v_expense->expense_id ?>" data-target="#myModal" data-toggle="modal" class="btn btn-xs bg-olive" ><i class="glyphicon glyphicon-search"></i></a>
                                            <a href="<?php echo base_url().'admin/expense/delete_expense/'. $v_expense->expense_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
                                        </div>
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



