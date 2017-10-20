<!-- Page Content Start -->
<!-- ================== -->

<div class="wraper container-fluid">

    <div class="row">
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
             <span class="small-box-footer">
               <p>MY METERS</p>
            </span>
                <div class="inner">
                    <h2>
                        <?php
                        if(!empty($total_customer)) {
                            echo $total_customer;
                        }else{
                            echo 0;
                        }
                        ?>
                    </h2>
                    
                </div>
                <div class="icon">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
            
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-purple">
              <span class="small-box-footer">
               <p>MY RECHARGES</p>
            </span>
                <div class="inner">
                    <h2>
                        <?php
                        if(!empty($total_loans->total_loans)) {
                          
                            echo $total_loans->total_loans;
                        }else{
                            echo 0;
                        }
                        ?>
                    </h2>
                  
                </div>
                <div class="icon">
                     <span class="glyphicon glyphicon-user"></span>
                </div>
            
            </span>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <span class="small-box-footer">
               <p>MY PAYMENTS</p>
            </span>
                <div class="inner">
                    <h2>
                      <?php
                        if(!empty($total_collection->total_collection)) {
                          
                            echo $this->localization->currencyFormat($total_collection->total_collection);
                        }else{
                            echo $this->localization->currencyFormat(0);
                        }
                        ?></h2>
                   
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-success">
            <span class="small-box-footer">
         <p>MY CREDITS</p>
            </span>
                <div class="inner">
                    <h2><?php echo $this->localization->currencyFormat($yearly_payments->amount); ?></h2>
                 </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
            
            </div>
        </div><!-- ./col -->
     
    </div>


    
    <!-- End row -->





</div>
<!-- Page Content Ends -->
<!-- ================== -->



<div class="wraper container-fluid">
    <div class="row">

        <div class="col-md-8">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        Recent Payments
                    </h3>
                </div>
                <div id="portlet2" class="panel-collapse collapse in">
                    <div class="portlet-body" style="height: 400px">
                        <div class="table-responsive">

                        </div><!-- /.table-responsive -->
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h5 class="portlet-title text-dark text-uppercase">
                       My Meters
                    </h5>
                </div>
                <div id="portlet2" class="panel-collapse collapse in">
                    <div class="portlet-body" style="height: 400px">

                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Meter number</th>
                                    <th>Action</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($top_sell_product_month)):
                                    $top_product = array_slice($top_sell_product_month, 0, 5);
                                    $i=1;
                                    ?>
                                    <?php foreach($top_product as $item): ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td class="highlight"><?php echo $item->product_code ?></td>
                                        <td><?php echo $item->product_name ?></td>
                                        <td class="highlight"><strong><?php echo $item->quantity ?></strong></td>
                                        <?php $i ++ ?>
                                    </tr>
                                <?php endforeach;
                                else:?>
                                    <tr style="column-span: 4">
                                        <td><strong>No Records Found</strong></td>
                                    </tr>

                                <?php endif ?>
                                </tbody>
                            </table>

                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
