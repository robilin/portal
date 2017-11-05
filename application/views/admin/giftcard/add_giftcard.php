<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-8">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Add Giftcard</h3>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addgiftcardForm"
                      action="<?php echo base_url(); ?>admin/giftcard/save_giftcard/<?php if (!empty($giftcard->giftcard_id)) {
                          echo $giftcard->giftcard_id;
                      } ?>"
                      method="post">

                    <div class="row">

                        <div class="col-md-8 col-sm-12 col-xs-12">

                            <div class="box-body">

                                                         <!-- /.card no -->
                                <div class="form-group form-group-bottom">
                                    <label for="exampleInputEmail1">Card no <span class="required">*</span></label>
                               </div>
                                    <div class="input-group">
                                    <input type="text" required name="gift_card_no" id="card_no" value="<?php
                                           
                                           if (!empty($giftcard->gift_card_no)) {
                                               echo $giftcard->gift_card_no;
                                           }
                                           ?>"
                                           class="form-control">
                                           <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                                    <a href="#" id="genNo"><i class="fa fa-cogs"></i></a>
                                          </div>
                                 </div>

                                <!-- /.value -->
                                <div class="form-group form-group-bottom">
                                    <label for="exampleInputEmail1">Value<span class="required">*</span></label>
                                </div>
                                    <div class="input-group">
                                    <input type="text" placeholder="value" required name="value" 
                                           value="<?php
                                           if (!empty($giftcard->value)) {
                                               echo $giftcard->value;
                                           }
                                           ?>"
                                           class="form-control">
                                    <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                           <a href="#"><i class="entypo-cc-nc"></i></a>
                                    </div>
                                </div>

                                 <!-- /.created Date -->
                                            <div class="form-group form-group-bottom">
                                                <label>Expire date</label>
                                            </div>
                                            <div class="input-group">
                                                <input type="text" value="<?php
                                                if (!empty($giftcard)) {
                                                    $expire_date = date('Y/m/d', strtotime($giftcard->expire_date));
                                                    echo $expire_date;
                                                }
                                                ?>" class="form-control datepicker" id="expire date" required name="expire_date" data-format="yyyy/mm/dd">

                                                <div class="input-group-addon" style="padding-left: 10px; padding-right: 10px;">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>


                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>


                    <div class="box-footer">
                        <button type="submit" id="giftcard_btn" class="btn bg-navy btn-flat" type="submit">Add giftcard
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
<section></section>


<script src="<?php echo base_url() ?>asset/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>asset/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>asset/js/ajax.js" type="text/javascript"></script>

                                                

<script type="text/javascript">

$(document).ready(function () {
    $('#card_no').inputmask("9999 9999 9999 9999");
    $('#genNo').click(function () {
        var no = generateCardNo();
        $(this).parent().parent('.input-group').children('input').val(no);
        return false;
    });
    $("#expire_date").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
});
</script>  