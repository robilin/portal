<style type="text/css">
    #ui-datepicker-div
    {
        z-index: 9999999;
    }
</style>

<div class="modal-header">
   <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
   <h4 class="modal-title" id="myModalLabel">Add Comment</h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">
   
   <form role="form" enctype="multipart/form-data" id="addloanForm"
               action="<?php echo base_url(); ?>admin/loan/save_comments/<?php if (!empty($loan_comments)) {
                  echo $loan_comments->comment_id;
                  } ?>" method="post">


                                            <div class="form-group form-group-bottom">
                                                <label class="required">Date </label>
                                                </div>
                                                <div class="input-group" >
                                                <input type="text"
                                                       value="<?php
                                                       if (!empty($loan_comments->date_posted)) {
                                                       	  $date_posted = date('Y/m/d', strtotime($loan_comments->date_posted));
                                                          echo $date_posted;
                                                       }
                                                       ?>" class="form-control datepicker" id="datepicker" required name="date_posted" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>

         <!-- /.Comment -->
         <div class="form-group">
            <label for="exampleInputEmail1">Comment</label>
            <textarea required name="comment" class="form-control autogrow"
               placeholder="comments" rows="2"><?php
               if (!empty($loan_comments->comment)) {
                   echo $loan_comments->comment;
               }
               ?></textarea>
         </div>
    

          <input type="hidden" name="comments_id" value="<?php if (!empty($loan_comments->comments_id)) {
         echo $loan_comments->comments_id;
         } ?>" id="comments_id">
           <input type="hidden" name="loan_id" value="<?php if (!empty($loan_id)) {
         echo $loan_id;
         } ?>" id="comment_id">
      <button type="submit" id="sbtn" class="btn-flat btn bg-olive btn-block"><strong>Save</strong></button>
   </form>
</div>

<script>
$("#modalSmall").on("show.bs.modal", function() {
    // reset my values
});

$("#datepicker").datepicker().on('show.bs.modal', function(event) {
    // prevent datepicker from firing bootstrap modal "show.bs.modal"
    event.stopPropagation();
});
</script>



