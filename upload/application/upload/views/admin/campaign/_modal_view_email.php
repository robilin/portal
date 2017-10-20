
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><?php echo $campaign->campaign_name ?></h4>
</div>
<div class="modal-body wrap-modal wrap" style="max-height: 900px;">





    <div class="row">

        <div class="col-sm-12">
            <table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td height="100" style="background-color:#eeeeee; border-top:solid 10px #333333">
                        <img src="<?php echo $this->localization->profile('logo') ?>">
                    </td>
                </tr>
                <tr>
                    <td height="31" valign="top" style="padding:20px">
                        <?php if(!empty($campaign->email_body)) echo $campaign->email_body  ?>
                    </td>
                </tr>
                <tr>
                    <td height="50" style="background-color:#eeeeee; border-bottom:solid 5px #333333; text-align:center; font-size:12px; color:#666">
                        <strong><?php echo $this->localization->profile('company_name') ?></strong>&nbsp;&nbsp;&nbsp;<?php echo $this->localization->profile('address') ?>
                    </td>
                </tr>
            </table>

        </div>
    </div>




    <div class="modal-footer" >

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <a href="<?php echo base_url(); ?>admin/campaign/new_campaign/<?php echo $campaign_id ?>" type="button" class="btn btn-primary">Edit Email</a>

        </div>

</div>


