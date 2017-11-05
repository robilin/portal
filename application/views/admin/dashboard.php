<!-- Page Content Start -->
<!-- ================== -->
<div class="wraper container-fluid">

    <div class="row">
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
            <span class="small-box-footer">
               <p>REGISTERED TENANTS</p>
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
                   <span class="glyphicon glyphicon-user"></span>
                </div>
            
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-purple">
            <span class="small-box-footer">
               	 <p>REGISTERED LANDLORDS</p>             	
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
            
           
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-info">
             <span class="small-box-footer">
             <p>REGISTERED PARTNERS</p>
            </span>
                <div class="inner">
                    <h2>
                      <?php
                        if(!empty($total_collection->total_collection)) {
                          
                            echo 23;
                        }else{
                            echo 0;
                        }
                        ?></h2>
                    
                </div>
                <div class="icon">
                   <span class="glyphicon glyphicon-user"></span>
                </div>
           
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <span class="small-box-footer">
          <p>TOTAL COLLECTION <?php echo date('Y'); ?></p>
            </span>
                <div class="inner">
                    <h2><?php echo $this->localization->currencyFormat($yearly_payments->amount); ?></h2>
                    
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
          
            </div>
        </div><!-- ./col -->
     
    </div>


    <div class="row">
        <div class="col-md-8">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        Yearly Collection Report
                    </h3>
                </div>
                <div id="portlet1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        
                       <div id="morris-bar-example" style="height: 250px;"></div>

                        <div class="row text-center m-t-30 m-b-30 chart-table">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <h4>
                                    <?php
                                    if(!empty($today_payment)) {
                                        echo $this->localization->currency($today_payment->amount);
                                    }else{
                                        echo $this->localization->currency(0);
                                    }
                                    ?>
                                </h4>
                                <small class="text-muted"> Today's Payments</small>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <h4>
                                    <?php
                                    if(!empty($weekly_payments)) {
                                        echo $this->localization->currency($weekly_payments->amount);
                                    }else{
                                        echo $this->localization->currency(0);
                                    }
                                    ?>
                                </h4>
                                <small class="text-muted">This Week's Payments</small>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <h4>
                                    <?php
                                    if(!empty($mothly_payments)) {
                                        echo $this->localization->currency($mothly_payments->amount);
                                    }else{
                                        echo $this->localization->currency(0);
                                    }
                                    ?>
                                </h4>
                                <small class="text-muted">This Month's Payments</small>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">

                                <h4>
                                    <?php
                                    if(!empty($yearly_payments)) {
                                        echo $this->localization->currency($yearly_payments->amount);
                                    }else{
                                        echo $this->localization->currency(0);
                                    }
                                    ?>
                                </h4>
                                <small class="text-muted">This Year's Payments</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Portlet -->

        </div>
        <!-- end col -->

        <div class="col-md-4">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        Recent<strong>5</strong> ACCOUNTS <strong><?php echo date('Y')?></strong>
                    </h3>
                </div>
                <div id="portlet2" class="panel-collapse collapse in">
                    <div class="portlet-body" style="height: 400px">

                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Meter</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($top_sell_product)):
                                    $top_product = array_slice($top_sell_product, 0, 5);
                                    $i=1;
                                    ?>
                                    <?php foreach($top_product as $item): ?>
                                    <tr>
                                        <td ><?php echo $i ?></td>
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
                       RECENT ACTIVITIES <?php echo date('F')?>
                    </h5>
                </div>
                <div id="portlet2" class="panel-collapse collapse in">
                    <div class="portlet-body" style="height: 400px">

                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                    <th>Time</th>
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

<script>
$(function () {
    //Bar chart
    Morris.Bar({
        element: 'morris-bar-example',
        data: [
            <?php foreach ($yearly_sales_report as $name => $v_result):
                $month_name = date('M', strtotime($year . '-' . $name)); // get full name of month by date query
            ?>
            { x: '<?php echo $month_name; ?>',
                a: <?php
                if (!empty($v_result)) {
                    foreach($v_result as $result){
                        echo round($result->amount);
                    }
                }
                ?>,
                
            },

            <?php endforeach; ?>

        ],
        xkey: 'x',
        ykeys: ['a'],
        labels: ['Payment'],
        barColors: ['#3bc0c3']
    });

});
</script>