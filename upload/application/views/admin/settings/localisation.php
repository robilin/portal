<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<section class="content">
    <div class="row form_wrap">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Localisation Settings</h3>
                </div>
                <!-- /.box-header -->


                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addProductForm"
                      action="<?php echo base_url(); ?>admin/settings/save_localization/<?php if (!empty($localization->localization_id)) {
                          echo $localization->localization_id;
                      } ?>"
                      method="post">

                    <div class="row">

                        <div class="col-md-8 col-sm-12 col-xs-12">

                            <div class="box-body">

                                <!-- /.Company Name -->
                                <div class="form-group">
                                    <label>Timezone</label>
                                    <select style="width: 100%;" title="Timezone" tabindex="-1" name="timezone" id="e2">
                                        <?php foreach($timezoneList as $value => $label): ?>
                                            <option value="<?php echo $value ?>" <?php if(!empty($localization->timezone)) echo  $value == $localization->timezone ?'selected':''  ?> ><?php echo $label ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>


                                <!-- /.Company Email -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Default Country</label>
                                    <select id="country" style="width: 100%;" name="country" required>
                                        <option value="">Select Country</option>
                                        <?php  $country = $this->db->get('countries')->result(); ?>
                                        <?php if (!empty($country)): ?>
                                            <?php foreach ($country as $v_country) : ?>
                                                <option value="<?php echo $v_country->idCountry; ?>" <?php if(!empty($localization->country)) echo $v_country->idCountry == $localization->country ?'selected':''  ?> >
                                                    <?php echo $v_country->countryName ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </select>
                                </div>


                                <!-- /.Address -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Date Format</label>
                                    <select class="form-control" name="date_format" id="df">
                                        <option value="dd/mm/yyyy" <?php if(!empty($localization->date_format)) echo 'dd/mm/yyyy' == $localization->date_format ?'selected':'' ?> >20/07/2015</option>
                                        <option value="dd.mm.yyyy" <?php if(!empty($localization->date_format)) echo 'dd.mm.yyyy' == $localization->date_format ?'selected':'' ?>>20.07.2015</option>
                                        <option value="dd-mm-yyyy" <?php if(!empty($localization->date_format)) echo 'dd-mm-yyyy' == $localization->date_format ?'selected':'' ?>>20-07-2015</option>
                                        <option value="mm/dd/yyyy" <?php if(!empty($localization->date_format)) echo 'mm/dd/yyyy' == $localization->date_format ?'selected':'' ?>>07/20/2015</option>
                                        <option value="yyyy/mm/dd" <?php if(!empty($localization->date_format)) echo 'yyyy/mm/dd' == $localization->date_format ?'selected':'' ?>>2015/07/20</option>
                                        <option value="yyyy-mm-dd" <?php if(!empty($localization->date_format)) echo 'yyyy-mm-dd' == $localization->date_format ?'selected':'' ?>>2015-07-20</option>
                                        <option value="M d yyyy" <?php if(!empty($localization->date_format)) echo 'M d yyyy' == $localization->date_format ?'selected':'' ?>>Jul 20 2015</option>
                                        <option value="d M yyyy" <?php if(!empty($localization->date_format)) echo 'd M yyyy' == $localization->date_format ?'selected':'' ?>>20 Jul 2015</option>


                                    </select>
                                </div>

                                <!-- /.Phone -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Currency Format</label>
                                    <select class="form-control" name="currency_format" >
                                        <option value="1" <?php if(!empty($localization->currency_format)) echo '1' == $localization->currency_format ?'selected':'' ?>>
                                            1234.56
                                        </option>
                                        <option value="2" <?php  if(!empty($localization->currency_format)) echo '2' == $localization->currency_format ?'selected':'' ?>>
                                            1,234.56
                                        </option>
                                        <option value="3" <?php  if(!empty($localization->currency_format)) echo '3' == $localization->currency_format ?'selected':'' ?>>
                                            1234,56
                                        </option>
                                        <option value="4" <?php  if(!empty($localization->currency_format)) echo '4' == $localization->currency_format ?'selected':'' ?>>
                                            1.234,56
                                        </option>
                                        <option value="5" <?php  if(!empty($localization->currency_format)) echo '5' == $localization->currency_format ?'selected':'' ?>>
                                            1,234
                                        </option>
                                    </select>
                                </div>

                                <!-- /.Currency -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Currency</label>
                                    <input type="text" placeholder="Currency" name="currency" required
                                           value="<?php
                                           if (!empty($localization->currency)) {
                                               echo $localization->currency;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>
                                
                                <!-- /.vote price -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Unit price</label>
                                    <input type="text" placeholder="Unit price" name="unit_price" required
                                           value="<?php
                                           if (!empty($localization->unit_price)) {
                                               echo $localization->unit_price;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>
                                
                                 <!-- /.vote price -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SMS sender id</label>
                                    <input type="text" placeholder="Sender id" name="sender_id" required
                                           value="<?php
                                           if (!empty($localization->sender_id)) {
                                               echo $localization->sender_id;
                                           }
                                           ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn bg-navy btn-flat" type="submit">Save Localization
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>

<script>
    $(document).ready(function() {
        $("#e2").select2({
            placeholder: "Select a State",
            allowClear: true
        });

        $("#country").select2({
            placeholder: "Select a State",
            allowClear: true
        });

    });
</script>