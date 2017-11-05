<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/kendo.default.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/css/kendo.common.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/kendo.all.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Create New Expense</h3>
                </div>
                <!-- /.box-header -->

                <!-- form start -->
                <form role="form" enctype="multipart/form-data" id="addCustomerForm"
                      action="<?php echo base_url(); ?>admin/expense/save_expense/<?php if(!empty($expense)){
                          echo $expense->expense_id;
                      }?>"
                      method="post">

                    <div class="row">

                        <div class="col-md-10 col-sm-12 col-xs-12">

                            <div class="box-body">


   						                                        <!-- /.Category -->
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Expense Category</label>
                                            <select name="expense_category_id" class="form-control col-sm-5" id="category" onchange="get_category(this.value)">
                                                <option value="">Select Expense Category</option>
                                                <?php if (!empty($category)): ?>
                                                    <?php foreach ($category as $v_category) : ?>
                                                        <option value="<?php echo $v_category->category_name; ?>"
                                                            <?php
                                                            if (!empty($expense)) {
                                                                echo $v_category->expense_category_id ? 'selected' : '';
                                                                //echo $v_category->expense_category_id == $expense_category->expense_category_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_category->category_name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        
                                                                <!-- /.user -->
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Employee</label>
                                            <select name="employee" class="form-control col-sm-5" id="employee" >
                                                <option value="">Select Employee</option>
                                                <?php if (!empty($all_employee_info)): ?>
                                                    <?php foreach ($all_employee_info as $v_employee) : ?>
                                                        <option value="<?php echo $v_employee->name; ?>"
                                                            <?php
                                                            if (!empty($all_employee_info)) {
                                                                echo "" ? 'selected' : '';
                                                                //echo $v_category->expense_category_id == $expense_category->expense_category_id ? 'selected' : '';
                                                            }
                                                            ?> >
                                                            <?php echo $v_employee->name; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>

                                <!-- /.Amount -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Amount <span
                                            class="required">*</span></label>
                                    <input type="text" placeholder="Expense Amount" name="amount" required
                                           value="<?php if(!empty($expense)) echo $expense->amount ?>"
                                           class="form-control">
                                </div>

                                <!-- /.employee Image -->
                                <div class="form-group">
                                    <label>Attach file</label>
                                </div>
                                <div class="form-group">
                                    <!-- hidden  old_path when update  -->
                                    <input type="hidden" name="old_path"  value="<?php
                                    if (!empty($expense->file_path)) {
                                        echo $expense->file_path;
                                    }
                                    ?>">
                                    <div class="fileinput fileinput-new"  data-provides="fileinput">
                                        <div class="fileinput-new thumbnail g-logo-img" >
                                            <?php if (!empty($expense->filename)): // if product image is exist then show  ?>
                                                <img src="<?php echo base_url() . $expense->filename; ?>" >
                                            <?php else: // if product image is not exist then defualt a image ?>
                                                <img src="<?php echo base_url() ?>img/file.jpg" alt="expense_file">
                                            <?php endif; ?>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                        <div>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new"><input type="file" name="expense_file" /></span>
                                                        <span class="fileinput-exists">Change</span>
                                                    </span>
                                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                        <div id="valid_msg" class="required"></div>
                                    </div>
                                </div>
                                <!-- / Product Image -->


                                <!-- /.Notes -->
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Expense Notes<span class="required">*</span></label>
                                    <textarea name="description" class="form-control autogrow" required>
                                        <?php if(!empty($expense)) echo $expense->description ?>
                                    </textarea>

                                </div>


                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>

                   <div class="box-footer">
                        <button type="submit" id="customer_btn" class="btn bg-navy btn-flat" type="submit">Create Expense
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



<script type="text/javascript" src="<?php echo base_url(); ?>asset/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        width: 810,
        height: 100,
        relative_urls: false,
        remove_script_host: false,

        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
        ],

        content_css: "css/content.css",
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | responsivefilemanager | print preview media fullpage | forecolor backcolor emoticons",
        style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        external_filemanager_path:"<?php echo base_url() ?>filemanager/",
        filemanager_title:"File Manager " ,
        external_plugins: { "filemanager" : "<?php echo base_url() ?>filemanager/plugin.min.js"}



    });
</script>
