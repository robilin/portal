
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel">Expense # <?php echo $expense->expense_id ?></h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">

    <div class="row">
   
        <div class="col-sm-6 col-md-8">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="active" colspan="2">Expense Category: <?php echo $expense->expense_category_id ?></th>
                </tr>
                </thead>
                <tbody>
                 <tr>
                    <td class="col-sm-3">Employee</td>
                    <td><?php if(!empty($expense->employee)) echo $expense->employee  ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Expense Description</td>
                    <td><?php if(!empty($expense->description)) echo $expense->description  ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Date Created</td>
                    <td class=""><?php echo $expense->date_time_created ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3 ">Created by</td>
                    <td class=""><?php echo $expense->created_by ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">Amount</td>
                    <td><?php echo $expense->amount ?></td>
                </tr>
                <tr>
                    <td class="col-sm-3">File</td>
                    <td><a href="<?php echo  base_url() .$expense->filename ?>"><i class="glyphicon glyphicon-search"></i><span>view</span></a></td>
                </tr>
          
                
               </tbody>
            </table>

        </div>
    </div>


    <div class="modal-footer" >

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <a href="<?php echo base_url(); ?>admin/expense/add_expense/<?php echo $expense_id ?>" type="button" class="btn btn-primary">Edit Expense</a>
        </div>

</div>
