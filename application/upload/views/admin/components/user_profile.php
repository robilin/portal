
        <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">LMS</b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

<?php $enable_gear=false; 

   if($enable_gear){?>
          <div class="hidden-sm hidden-xs ">
              <ul class="nav navbar-nav">
                  <li class="dropdown mega-dropdown">

                      <a href="#" class="dropdown-toggle " data-toggle="dropdown" style="font-size: 18px">Gear <i class="fa fa-cog" aria-hidden="true"></i></a>


                      <ul class="dropdown-menu mega-dropdown-menu row  ">


                          <li class="col-sm-3">
                              <ul>
                                  <li class="dropdown-header">Sales (POS)</li>
                                  <li><a href="<?php echo site_url('admin/order/new_order')?>"><spna style="color: #00a7d0"><i class="fa fa-shopping-cart" aria-hidden="true"></i></spna> New Sales</a></li>
                                  <li><a href="<?php echo site_url('admin/order/manage_invoice') ?>"><spna style="color: #00a7d0"><i class="fa fa-file-text-o" aria-hidden="true"></i></spna> Manage Invoice</a></li>
                                  <li><a href="<?php echo site_url('admin/order/manage_order') ?>"><spna style="color: #00a7d0"><i class="fa fa-file-text-o" aria-hidden="true"></i></spna> Manage Order</a></li>
                                  <li><a href="<?php echo site_url('admin/order/manage_delivery ') ?>"><spna style="color: #00a7d0"><i class="fa fa-file-text-o" aria-hidden="true"></i></spna> Manage Delivery</a></li>

                              </ul>
                          </li>

                          <li class="col-sm-3">
                              <ul>
                                  <li class="dropdown-header">Sales Report</li>
                                  <li><a href="<?php echo site_url('admin/report/sales_report') ?>"><spna style="color: #00a7d0"><i class="fa fa-file-text-o" aria-hidden="true"></i></spna> Sales Report</a></li>
                                  <li><a href="<?php echo site_url('admin/report/sales_summery_report') ?>"><spna style="color: #00a7d0"><i class="fa fa-file-text-o" aria-hidden="true"></i></spna> Sales Summary</a></li>
                                  <li><a href="<?php echo site_url('admin/report/purchase_report') ?>"><spna style="color: #00a7d0"><i class="fa fa-file-text-o" aria-hidden="true"></i></spna> Purchase Report</a></li>
                                  <li><a href="<?php echo site_url('admin/report/stock_report') ?>"><spna style="color: #00a7d0"><i class="fa fa-file-text-o" aria-hidden="true"></i></spna> Stock Summary</a></li>

                              </ul>
                          </li>

                          <li class="col-sm-3">
                              <ul>
                                  <li class="dropdown-header">Product & Service</li>
                                  <li><a href="<?php echo site_url('admin/product/add_product') ?>"><spna style="color: #00a7d0"><i class="fa fa-plus" aria-hidden="true"></i></spna> Add Product</a></li>
                                  <li><a href="<?php echo site_url('admin/product/manage_product') ?>"><spna style="color: #00a7d0"><i class="glyphicon glyphicon-th-large" aria-hidden="true"></i></spna> Manage Product</a></li>
                                  <li><a href="<?php echo site_url('admin/product/print_barcode') ?>"><spna style="color: #00a7d0"><i class="glyphicon glyphicon-barcode" aria-hidden="true"></i></spna> Barcode Print</a></li>
                                  <li><a href="<?php echo site_url('admin/product/damage_product') ?>"><spna style="color: #00a7d0"><i class="glyphicon glyphicon-trash" aria-hidden="true"></i></spna> Damage Product</a></li>

                              </ul>
                          </li>

                          <li class="col-sm-3">
                              <ul>
                                  <li class="dropdown-header">Manage Purchase</li>
                                  <li><a href="<?php echo site_url('admin/purchase/add_supplier') ?>"><spna style="color: #00a7d0"><i class="fa fa-plus" aria-hidden="true"></i></spna> Add Supplier</a></li>
                                  <li><a href="<?php echo site_url('admin/purchase/manage_supplier') ?>"><spna style="color: #00a7d0"><i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i></spna> Manage Supplier</a></li>
                                  <li><a href="<?php echo site_url('admin/purchase/new_purchase') ?>"><spna style="color: #00a7d0"><i class="fa fa-shopping-cart" aria-hidden="true"></i></spna> New Purchase</a></li>
                                  <li><a href="<?php echo site_url('admin/purchase/purchase_list') ?>"><spna style="color: #00a7d0"><i class="glyphicon glyphicon-th-list" aria-hidden="true"></i></spna> Purchase History</a></li>
                              </ul>
                          </li>


                      </ul>

                  </li>
              </ul>
          </div>

<?php }?>







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
                                Products running out of stock</li>
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
                            <li class="footer"><a href="<?php echo base_url() ?>admin/product/notification_product">See All Notification</a></li>
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
                                Products About to expire/expired</li>
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
                            <li class="footer"><a href="<?php echo base_url() ?>admin/product/expirely_notification_product">See All Notification</a></li>
                        </ul>
                    </li>

                    <?php
                    $pending_order = $_SESSION["pending_order"];
                    $pending_order_count = count($pending_order);
                    ?>

                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning"><?php echo $pending_order_count ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header"><?php echo $pending_order_count ?> Pending Order</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">

                                    <?php
                                    foreach($pending_order as $v_pending_order){
                                        ?>

                                        <li><!-- start message -->
                                            <a href="<?php echo base_url()?>admin/order/view_order/<?php echo $v_pending_order->order_no ?>">
                                                <h4 style="padding-bottom:6px">
                                                    <?php echo 'INV'.$v_pending_order->order_no ?> <small>Order Date:  <?php echo $this->localization->dateFormat($v_pending_order->order_date )?></small>
                                                </h4>
                                                <p><?php echo $this->localization->currencyFormat($v_pending_order->grand_total,2)  ?></p>
                                            </a>
                                        </li><!-- end message -->

                                    <?php } ?>


                                </ul>
                            </li>
                            <li class="footer"><a href="<?php echo base_url() ?>admin/order/pending_order">See All Pending Loans</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo base_url()?>login/logout" >
                            <span class="glyphicon glyphicon-off"></span> Logout
                        </a>

                    </li>


                </ul>
            </div>


        </nav>
      </header>