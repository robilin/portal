<style type="text/css">
    #ui-datepicker-div
    {
        z-index: 9999999;
    }
</style>

<div class="modal-header">
   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
   <h4 class="modal-title" id="myModalLabel">Add Repayment <?php if (!empty($loan_info->loan_number)) {
    echo 'Loan number'.' : '.$loan_info->loan_number;
   }?></h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">
   
   <form role="form" enctype="multipart/form-data" id="addloanForm"
               action="<?php echo base_url(); ?>admin/loan/save_repayment/<?php if (!empty($loan_info)) {
                  echo $loan_info->loan_id;
                  } ?>" method="post">
                  
       <div class="well well-sm" >
         <div class="form-group">
            <label for="exampleInputEmail1">Repayment Amount <span class="required">*</span></label>
            <input type="text" required name="repayment_amount" placeholder="Amount"
               value="<?php
                  if (!empty($loan_info->repayment_amount)) {
                      echo $loan_info->repayment_amount;
                  }
                  ?>"
               class="form-control">
         </div>
         <!-- /.Repayment method -->
         <div class="form-group">
            <label>Repayment method</label>
            <select name="repayment_method" class="form-control" id="order_status">
               <option value="cash">Cash</option>
               <option value="mobile_money">Mobile Money</option>
            </select>
         </div>
         <!-- /.Collection date -->
            <!-- /.from -->
                                            <div class="form-group form-group-bottom">
                                                <label class="required">Collection Date </label>
                                                </div>
                                                <div class="input-group" >
                                                <input type="text"
                                                       value="<?php
                                                       if (!empty($loan_info->collection_date)) {
                                                       	  $collection_date = date('Y/m/d', strtotime($loan_info->collection_date));
                                                          echo $collection_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="datepicker" required name="collection_date" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>

         <!-- /.Collected by -->
         <div class="form-group">
            <label>Collected by</label>
            <?php $employee=$this->db->get('tbl_user')->result(); 
            foreach ($employee as $v_employee) {
            	$employee_name=$v_employee->name;
            }
            ?>
            
            <select name="collected_by" class="form-control" id="order_status">
               <?php if (!empty($employee)): ?>
                         <?php foreach ($employee as $v_employee) : ?>
                <option value="<?php echo $v_employee->name; ?>"
                                                            <?php
                                                            if (!empty($employee)) {
                                                                echo $v_employee->user_id == $v_employee->user_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_employee->name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
              
            </select>
         </div>
         <!-- /.Address -->
         <div class="form-group">
            <label for="exampleInputEmail1">Comments</label>
            <textarea name="comments" class="form-control autogrow"
               placeholder="comments" rows="2"><?php
               if (!empty($loan_info->comments)) {
                   echo $loan_info->comments;
               }
               ?></textarea>
         </div>
      </div>
           
      <!-- customer id -->
      <input type="hidden" name="customer_id" value="<?php if (!empty($loan_info->customer_id)) {
         echo $loan_info->customer_id;
         } ?>" id="customer_id">
         
          <input type="hidden" name="loan_id" value="<?php if (!empty($loan_info->loan_id)) {
         echo $loan_info->loan_id;
         } ?>" id="loan_id">
           <input type="hidden" name="loan_number" value="<?php if (!empty($loan_info->loan_number)) {
         echo $loan_info->loan_number;
         } ?>" id="loan_number">
      <button type="submit" id="sbtn" class="btn-flat btn bg-olive btn-block"><strong>Save</strong></button>
   </form>
</div>

<script>
$(function () {
    $("#datepicker").datepicker();
   
});
</script>


