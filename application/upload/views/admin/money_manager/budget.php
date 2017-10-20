<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
<div class="row">
<div class="col-md-12">

<div class="box box-primary">
<div class="box-header box-header-background with-border">

<h3 class="box-title ">Add New Budget</h3>

</div>
<!-- /.box-header -->
<div class="box-background"><!-- form start -->
<form role="form" enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/money_manager/save_budget/<?php
                      if (!empty($budget_info->money_manager_budget_id)) {
                          echo $budget_info->money_manager_budget_id;
                      }
                      ?>"
	method="post">

<div class="row">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<td>
			
			
			<!-- /.Category -->
                                        <div class="form-group">
                                            <label>Budget Category</label>
                                            <select name="budget_name" class="form-control col-sm-5" id="category" onchange="get_category(this.value)">
                                                <option value="">Select...</option>
                                                <?php if (!empty($category)): ?>
                                                    <?php foreach ($category as $v_category) : ?>
                                                        <option value="<?php echo $v_category->category_name; ?>"
                                                            <?php
                                                            if (!empty($budget_info)) {
                                                            echo $v_category->money_manager_category_id== $v_category->money_manager_category_id ? 'selected' : '';
                                                            //echo $v_category->asset_category_id == $v_category->asset_category_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_category->category_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
		
			</td>
			<td><!-- /.Company Name -->
			<div class="form-group"><label for="exampleInputEmail1">Amount <span
				class="required">*</span></label> <input type="text" required
				name="budget_amount" placeholder="Budget amount"
				value="<?php
                                           if (!empty($budget_info->budget_amount)) {
                                               echo $budget_info->budget_amount;
                                           }
                                           ?>"
				class="form-control"></div>
			</td>
			<td>

			<div class="form-group form-group-bottom"><label>Month</label></div>
			<div class="input-group"><input type="text"
				value="<?php
                                                if (!empty($budget_info->budget_date)) {
                                                    $month = date('Y/m/d', strtotime($budget_info->budget_date));
                                                    echo $month;
                                                }
                                                ?>"
				class="form-control datepicker" id="datepicker" name="budget_date"
				data-format="mm-yyyy" viewMode='months' minViewMod="months">

			<div class="input-group-addon"><a href="#"><i class="entypo-calendar"></i></a>
			</div>
			</div>

			</td>

			<!-- /.box-body -->
		</tr>
		<tr>
			<td>
			<button type="submit" class="btn bg-navy btn-flat" type="submit">Save
			budget</button>
			</td>
		</tr>
	</thead>
</table>
</div>
</div>

</form>
</div>
<div class="box-footer"></div>

<div class="row">
<div class="col-md-10 col-md-offset-1">
<table class="table table-bordered table-striped datatable-buttons" id="dataTables-example"> 
	
<!-- <table id="dataTable-example" class="table table-striped table-bordered datatable-buttons"> -->
	
	<thead>
		<tr>
			<th class="active col-sm-1">SL</th>
			<th class="active">Budget Name</th>
			<th class="active">Month</th>
			<th class="active">Amount</th>
			<th class=" active col-sm-2">Action</th>

		</tr>
	</thead>
	<tbody>
	<?php $key = 1 ?>
	<?php if (!empty($all_budget)): foreach ($all_budget as $v_budget) : ?>
		<!--get all budget if not this empty-->
		<tr>
			<td><?php echo $key ?></td>
			<!--Serial No> -->
			<td><?php echo $v_budget->budget_name ?></td>
			<td><?php echo $v_budget->budget_date ?></td>
			<td><?php echo $v_budget->budget_amount ?></td>
			<td>
			<div class="btn-group"><a
				href="<?php echo base_url().'admin/money_manager/budget/'. $v_budget->money_manager_budget_id ?>"
				class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> <a
				href="<?php echo base_url().'admin/money_manager/delete_budget/'. $v_budget->money_manager_budget_id ?>"
				class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
			</div>

			</td>
		</tr>
		<?php
		$key++;
		endforeach;
		?>
		<!--get all budget if not this empty-->
		<?php else : ?>
		<!--get error message if this empty-->
		<td colspan="3"><strong>There is no record for display</strong></td>
		<!--/ get error message if this empty-->
		<?php
		endif; ?>
	</tbody>
</table>

</div>
</div>
</div>
<!-- /.box --></div>
<!--/.col end --></div>
<!-- /.row -->
</section>




