<script src="<?php echo base_url(); ?>asset/js/ajax.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php $info = $this->session->userdata('business_info'); ?>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-header box-header-background with-border">
               <h3 class="box-title "><?php echo $title ?></h3>
               <div class="box-tools">
               </div>
            </div>
   
            <div class="row">
               <div class="col-md-12">

     <div class="box-body">
               <!-- Table -->
               <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                  <thead >
                     <!-- Table head -->
                     <tr>
                        <th class="active col-sm-1">Sl</th>
                        <th class="active">Collection Date</th>
                        <th class="active">Name</th>
                        <th class="active">Loan#</th>
                        <th class="active">Collected By</th>
                        <th class="active">Method</th>
                        <th class="active">Amount</th>
                        <th class="active">Action</th>
                        <th class="active">Receipt </th>
                     </tr>
                  </thead>
                  <!-- / Table head -->
                  <tbody>
                     <!-- / Table body -->
                     <?php   
                        $loan_repayment = $this->db->get('tbl_loan_repayment')->result();
                          	?>
                     <?php $counter =1 ; ?>
                     <?php if (!empty($loan_repayment)): foreach ($loan_repayment as $v_repayment) : ?>
                     <tr class="custom-tr">
                        <td class="vertical-td">
                           <?php echo  $counter ?>
                        </td>
                        <td class="vertical-td"><?php echo $v_repayment->collection_date ?></td>
                        <td class="vertical-td">
                        <?php 
                        $borrower=$this->db->get_where('tbl_customer',array('customer_id'=>$v_repayment->customer_id))->result();
                 					foreach ($borrower as $value) {
                 						echo $value->title.' '.$value->first_name.' '.$value->second_name.' '.$value->last_name;
                 					}
                 		?>
                        </td>
                        <td class="vertical-td"><?php echo $v_repayment->loan_number ?></td>
                        <td class="vertical-td"><?php echo $v_repayment->collected_by ?></td>
                        <td class="vertical-td"><?php echo $v_repayment->repayment_method ?></td>
                        <td class="vertical-td"><?php echo $v_repayment->repayment_amount ?></td>
                        <td class="vertical-td" width="13%">
                           <div class="btn-group">
                              <a href="<?php echo base_url().'admin/loan/view_loan/'. $v_repayment->loan_loan_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-search">&nbsp;View</i></a>
                              <a href="<?php echo base_url().'admin/loan/delete_repayment/'. $v_repayment->repayment_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash">&nbsp;Delete</i></a>               
                           </div>
                        </td>
                        <td class="vertical-td"  width="14%>
                           <div class="btn-group">
                              <a href="<?php echo base_url().'admin/loan/pdf_repayment/'. $v_repayment->repayment_id ?>" class="btn btn-xs btn-default" ><i class="glyphicon glyphicon-file">&nbsp;Save</i></a>
                              <a href="<?php echo base_url().'admin/loan/print_repayment/'. $v_repayment->repayment_id ?>" class="btn btn-xs btn-default" ><i class="glyphicon glyphicon-print">&nbsp;Print</i></a>               
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
                     </td>
                     <!--/ get error message if this empty-->
                     <?php endif; ?>
                  </tbody>
                  <!-- / Table body -->
               </table>
               <!-- / Table -->
            </div>
   
               </div>
               </div
 
               <!-- customer id -->
               <?php if (!empty($customer_info->customer_id)) {?>
               <input type="hidden"  name="customer_id" id="customer_id"
                  value="<?php echo $customer_info->customer_id ?>">
               <?php }  ?>

            </div>
         </div>
      </div>
      <!-- Form end -->
   </div>
   </div>
   </div>
</section>

<script>
   $('body').on('hidden.bs.modal', '.modal', function() {
       $(this).removeData('bs.modal');
   });
   
   
   
</script>
<!--    Image Validation Check    -->
<script type="text/javascript"></script>