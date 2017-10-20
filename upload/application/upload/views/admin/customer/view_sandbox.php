$customer = $this->db->get_where('tbl_customer_visit',array('customer_id'=>$customer_info->customer_id))->result();

    <div class="row">
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h2>
                        <?php
                        if(!empty($revenue->grand_total)) {
                            echo $this->localization->currencyFormat($revenue->grand_total);
                        }else{
                            echo $this->localization->currencyFormat(0);
                        }
                        ?>
                    </h2>
                    <p>Registered Borrowers</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
            <span class="small-box-footer">
               <?php echo date('F');?>
            </span>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h2>
                        <?php
                        if(!empty($revenue->grand_total)) {
                            $profit = $revenue->grand_total - $profit->buying_price - $revenue->total_tax - $revenue->discount_amount;
                            echo $this->localization->currencyFormat($profit);
                        }else{
                            echo $this->localization->currencyFormat(0);
                        }
                        ?>
                    </h2>
                    <p>Total Loans Released</p>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            <span class="small-box-footer">
                <?php echo date('F');?>
            </span>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h2><?php echo $quantity_sales ?></h2>
                    <p>Total Collections</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            <span class="small-box-footer">
                <?php echo date('F');?>
            </span>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h2><?php echo $this->localization->currencyFormat($stock_value); ?></h2>
                    <p>Total Outstanding Open Loans</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
            <span class="small-box-footer">
              Cost of All Items Held in Stock
            </span>
            </div>
        </div><!-- ./col -->
           <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h2><?php echo $this->localization->currencyFormat($total_expense); ?></h2>
                    <p>Open Loans</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
            <span class="small-box-footer">
              <?php echo date('F');?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo base_url() ?>admin/expense/manage_expense"><b>View more</b></a>
            </span>
            </div>
        </div><!-- ./col -->
        
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h2><?php echo $pending; ?></h2>
                    <p>Full Paid Loans</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
            <span class="small-box-footer">
              <a href="<?php echo base_url() ?>admin/order/pending_order"><b>View more</b></a>
            </span>
            </div>
        </div><!-- ./col -->
        
         <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h2><?php echo $notify_expire; ?></h2>
                    <p>Restructured Loans</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
            <span class="small-box-footer">
             <a href="<?php echo base_url() ?>admin/product/expirely_notification_product">View more</a>
            </span>
            </div>
        </div><!-- ./col -->
        
         <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h2><?php echo $notify_product; ?></h2>
                    <p>Default Loans</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
            <span class="small-box-footer">
              <a href="<?php echo base_url() ?>admin/product/notification_product">View all</a>
            </span>
            </div>
        </div><!-- ./col -->
    </div>