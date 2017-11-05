        <header class="main-header">
        
        <style>
        .badge-inverse {
  background-color: #b94a48;
}
        </style>
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">PAYLESS</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

<ul class="nav navbar-nav">
                  <li>

                      <a href="<?php echo base_url()?>admin/apis/purchase_token"  style="font-size: 15px"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Buy Token Now </a>
				 </li>
</ul>

<ul class="nav navbar-nav">
                  <li>

                      <a href="<?php echo base_url()?>admin/apis/activate_voucher"  style="font-size: 15px"><i  class="glyphicon glyphicon-barcode" aria-hidden="true"></i> Activate Payless Voucher</a>
				 </li>
</ul>




            <div class="navbar-custom-menu pull-right">




                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <?php
                    if(!empty($_SESSION["notify_product"]))
                    {
                        $notify_product = $_SESSION["notify_product"];
                        $notify_product_count = count($notify_product);
                    }
                    
                    if(!empty($_SESSION["notify_expire"]))
                    {
                        $notify_expire = $_SESSION["notify_expire"];
                        $notify_expire_count = count($notify_expire);
                    }
                    ?>                   
                    
 					<li>
                        <a href="<?php echo base_url()?>admin/customer/add_customer/<?php echo $this->session->userdata('customer_id');?>" >
                            <span class="fa fa-cogs"></span> Account Settings
                        </a>

                    </li>


                    <!-- Notifications: style can be found in dropdown.less -->

                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger"><?php if(!empty($notify_product_count)){
                                    echo $notify_product_count;
                                }else{
                                    echo '0';
                                }
                                ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">
                                <?php if(!empty($notify_product_count)){
                                    echo $notify_product_count;
                                }else{
                                    echo '0';
                                }
                                ?>
                               </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">

                                    <?php
                                    if(!empty($notify_product)){
                                    foreach($notify_product as $v_notify_product){
                                        ?>

                                        <li><!-- start message -->
                                            <a href="<?php echo base_url()?>admin/product/add_product/<?php echo $v_notify_product->product_id ?>">
                                                <div class="pull-left">
                                                    <?php if(!empty($v_notify_product->filename)){?>
                                                        <img src="<?php echo base_url() . $v_notify_product->filename; ?>" class="img-circle" alt="Product Image"/>
                                                    <?php }else{?>
                                                        <img src="<?php echo base_url(); ?>img/product.png" class="img-circle" alt="Product Image"/>
                                                    <?php } ?>
                                                </div>
                                                <h4 style="padding-bottom:6px">
                                                    <?php echo 'Code:'.$v_notify_product->product_code  ?>
                                                    <span class="label label-danger">Qty:<?php echo $v_notify_product->product_quantity  ?></span>
                                                </h4>
                                                <p><?php echo 'Product Name: '.$v_notify_product->product_name  ?></p>
                                            </a>
                                        </li><!-- end message -->

                                    <?php }; } ?>


                                </ul>
                            </li>
                            <li class="footer"><a href="<?php echo base_url() ?>admin/product/notification_product"></a></li>
                        </ul>
                    </li>
                    
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa fa-ban"></i>
                            <span class="label label-danger"><?php if(!empty($notify_expire_count)){
                                    echo $notify_expire_count;
                                }else{
                                    echo '0';
                                }
                                ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">
                                <?php if(!empty($notify_expire_count)){
                                    echo $notify_expire_count;
                                }else{
                                    echo '0';
                                }
                                ?>
                               </li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">

                                    <?php
                                    if(!empty($notify_expire)){
                                    foreach($notify_expire as $v_notify_expire){
                                        ?>

                                        <li><!-- start message -->
                                            <a href="<?php echo base_url()?>admin/product/add_product/<?php echo $v_notify_expire->product_id ?>">
                                                <div class="pull-left">
                                                    <?php if(!empty($v_notify_expire->filename)){?>
                                                        <img src="<?php echo base_url() . $v_notify_expire->filename; ?>" class="img-circle" alt="Product Image"/>
                                                    <?php }else{?>
                                                        <img src="<?php echo base_url(); ?>img/product.png" class="img-circle" alt="Product Image"/>
                                                    <?php } ?>
                                                </div>
                                                <h4 style="padding-bottom:6px">
                                                    <?php echo 'Code:'.$v_notify_expire->product_code  ?>
                                                    <span class="label label-danger">Date:<?php echo $v_notify_expire->expire_date  ?></span>
                                                </h4>
                                                <p><?php echo 'Product Name: '.$v_notify_expire->product_name  ?></p>
                                            </a>
                                        </li><!-- end message -->

                                    <?php }; } ?>


                                </ul>
                            </li>
                            <li class="footer"><a href="<?php echo base_url() ?>admin/product/expirely_notification_product"></a></li>
                        </ul>
                    </li>

                    <?php
                 
                  $pending_order_count=false;
                  $pending_order =false;
                    if($pending_order || $pending_order_count){
                    $pending_order_count = count($pending_order);
                    $pending_order = $_SESSION["pending_order"];
                    }
                    
                    ?>



                    <li>
                        <a href="<?php echo base_url()?>login/logout" >
                            <span class="glyphicon glyphicon-off"></span> Logout
                        </a>

                    </li>


                </ul>
            </div>


        </nav>
      </header>