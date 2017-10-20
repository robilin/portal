<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
<div class="row">
<div class="col-md-12">

<div class="box box-primary">
<div class="box-header box-header-background with-border">

<h3 class="box-title ">Add New Income</h3>

</div>
<!-- /.box-header -->
<div class="box-background"><!-- form start -->
<form role="form" enctype="multipart/form-data"
	action="<?php echo base_url(); ?>admin/money_manager/save_income/<?php
                      if (!empty($income_info->money_manager_income_id)) {
                          echo $income_info->money_manager_income_id;
                      }
                      ?>"
	method="post">

<div class="row">

<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<td>
			<div class="form-group"><label for="exampleInputEmail1">Name <span
				class="required">*</span></label> <input type="text" required
				name="income_name" placeholder="Income name"
				value="<?php
                                           if (!empty($income_info->income_name)) {
                                               echo $income_info->income_name;
                                           }
                                           ?>"
				class="form-control"></div>
			
			
		
			</td>
			<td><!-- /.Company Name -->
			<div class="form-group"><label for="exampleInputEmail1">Amount <span
				class="required">*</span></label> <input type="text" required
				name="income_amount" placeholder="Income amount"
				value="<?php
                                           if (!empty($income_info->income_amount)) {
                                               echo $income_info->income_amount;
                                           }
                                           ?>"
				class="form-control"></div>
			</td>
			<td>

			<div class="form-group form-group-bottom"><label>Date</label></div>
			<div class="input-group"><input type="text"
				value="<?php
                                                if (!empty($income_info->income_date)) {
                                                    $date = date('Y/m/d', strtotime($income_info->income_date));
                                                    echo $date;
                                                }
                                                ?>"
				class="form-control datepicker" id="datepicker" required name="income_date"
				data-format="yyyy/mm/dd"  >

			<div class="input-group-addon"><a href="#"><i class="entypo-calendar"></i></a>
			</div>
			</div>

			</td>

			<!-- /.box-body -->
		</tr>
		
		<!--   Second row bigins                   -->
		
				<tr>
			   <td>
			
			
			<!-- /.Category -->
                                        <div class="form-group">
                                            <label>Account</label>
                                            <select required name="income_account" class="form-control col-sm-5" id="category" onchange="get_category(this.value)">
                                                <option value="">Select...</option>
                                                <?php if (!empty($account)): ?>
                                                    <?php foreach ($account as $v_account) : ?>
                                                        <option value="<?php echo $v_account->account_name; ?>"
                                                            <?php
                                                            if (!empty($income_info)) {
                                                            echo $v_account->money_manager_account_id== $v_account->money_manager_account_id ? 'selected' : '';
                                                             }
                                                            ?> >
                                                            <?php echo $v_account->account_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
		
			</td>
			<td>
			<!-- /.Category -->
                                        <div class="form-group">
                                            <label>Income Category</label>
                                            <select required name="income_category" class="form-control col-sm-5" id="category" onchange="get_category(this.value)">
                                                <option value="">Select...</option>
                                                <?php if (!empty($category)): ?>
                                                    <?php foreach ($category as $v_category) : ?>
                                                        <option value="<?php echo $v_category->category_name; ?>"
                                                            <?php
                                                            if (!empty($income_info)) {
                                                            echo $v_category->money_manager_category_id== $v_category->money_manager_category_id ? 'selected' : '';
                                                             }
                                                            ?> >
                                                            <?php echo $v_category->category_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
			</td>
			<td>

			<div class="form-group"><label for="exampleInputEmail1">Note <span
				class="required">*</span></label> <input type="text" required
				name="income_note" placeholder="Income amount"
				value="<?php
                                           if (!empty($income_info->income_note)) {
                                               echo $income_info->income_note;
                                           }
                                           ?>"
				class="form-control"></div>

			</td>

			<!-- /.box-body -->
		</tr>
		
		<!-- Second row ends here -->
		
		<tr>
			<td>
			<button type="submit" class="btn bg-navy btn-flat" type="submit">Save
			income</button>
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
			<th class="active">Name</th>
			<th class="active">Account</th>
			<th class="active">Category</th>
			<th class="active">Date</th>
			<th class="active">Amount</th>
			<th class="active">Note</th>
			<th class=" active col-sm-2">Action</th>

		</tr>
	</thead>
	<tbody>
	<?php $key = 1 ?>
	<?php if (!empty($all_income)): foreach ($all_income as $v_income) : ?>
		<!--get all income if not this empty-->
		<tr>
			<td><?php echo $key ?></td>
			<!--Serial No> -->
			<td><?php echo $v_income->income_name ?></td>
			<td><?php echo $v_income->income_account ?></td>
			<td><?php echo $v_income->income_category ?></td>
			<td><?php echo $v_income->income_date ?></td>
			<td><?php echo $v_income->income_amount ?></td>
			<td><?php echo $v_income->income_note ?></td>
			<td>
			<div class="btn-group"><a
				href="<?php echo base_url().'admin/money_manager/income/'. $v_income->money_manager_income_id ?>"
				class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a> <a
				href="<?php echo base_url().'admin/money_manager/delete_income/'. $v_income->money_manager_income_id ?>"
				class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
			</div>

			</td>
		</tr>
		<?php
		$key++;
		endforeach;
		?>
		<!--get all income if not this empty-->
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




