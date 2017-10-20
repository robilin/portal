<cript src="<?php echo base_url(); ?>asset/js/ajax.js"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>

<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header box-header-background with-border">

                        <h3 class="box-title ">Client Access</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-background">
                <!-- form start -->
                <form role="form" enctype="multipart/form-data"

                      action="<?php echo base_url(); ?>admin/settings/save_client_access/<?php
                      if (!empty($customer_menu->customer_menu_id)) {
                          echo $customer_menu->customer_menu_id;
                      }
                      ?>" method="post">

                    <div class="row">

                        <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">

                
                                <div class="form-group">
                                        <div class="form-group">
                              <label>Select From List<span class="required">*</span></label>
                       <select placeholder="Click here to choose." style="width: 100%;" required name="menu_id[]"  class="labselector" multiple="multiple">
                        
                        <?php  
                       	 $menu = $this->db->get('tbl_menu')->result();
                        
                       	 ?>
                                                                  
                        <?php if (!empty($menu)): ?>
                            <?php foreach ($menu as $item) : ?>
                                <option value="<?php echo $item->menu_id ?>" <?php echo $this->session->userdata('menu_id') == $item->menu_id ?'selected':'' ?>>
                                   <?php echo $item->label; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                   </select>
                     </div>
                                </div>

                                <button type="submit" class="btn bg-navy btn-flat" type="submit">Add Menu
                                </button><br/><br/>

                            <!-- /.box-body -->

                        </div>
                    </div>

                </form>
                    </div>
                <div class="box-footer">

                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                <table class="table table-bordered table-striped" id="dataTables-example">
                    <thead>
                    <tr>
                     	<th class="active col-sm-1">#</th>
                        <th class="active">Menu Description</th>
                        <th class=" active col-sm-2">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $key = 1 ?>
                    <?php if (!empty($customer_menu)): foreach ($customer_menu as $v_menu) : ?><!--get all job_tittle if not this empty-->
                        <tr>
                            <td><?php echo $key ?></td>
                            <!--Serial No> -->
                            <td><?php  
                            
                            $item_name=$this->db->get_where('tbl_menu',array('menu_id'=>$v_menu->menu_id))->result();
                 					foreach ($item_name as $value) {
           
                 						$menu_desc=$value->label; 
                 					}  
                 					echo $menu_desc;
                 					?>
                 					</td>
                            <td>
                                <div class="btn-group">
      <a href="<?php echo base_url().'admin/settings/delete_customer_menu/'. $v_menu->customer_menu_id ?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a>
                                </div>

                            </td>
                        </tr>
                    <?php
                    $key++;
                    endforeach;
                    ?><!--get all job_tittle if not this empty-->
                    <?php else : ?> <!--get error message if this empty-->
                        <td colspan="3">
                            <strong>There is no record for display</strong>
                        </td><!--/ get error message if this empty-->
                    <?php
                    endif; ?>
                    </tbody>
                </table>

                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>

<script>
    $(document).ready(function() {

        $('.box-body').css({"border-top":"0px solid #ccc"});

        $(".labselector").select2({
            placeholder: "Select a State",
            allowClear: true
        });
     

    });

</script>

