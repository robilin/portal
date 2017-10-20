<!-- Page Content Start -->
<!-- ================== -->

<div class="wraper container-fluid">

    <div class="row">
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
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
                    <p>Registered Borrowers</p>
                </div>
                <div class="icon">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
            <span class="small-box-footer">
               <span class="glyphicon glyphicon-user"></span>
            </span>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h2>
                        <?php
                        if(!empty($total_loans->total_loans)) {
                          
                            echo $this->localization->currencyFormat($total_loans->total_loans);
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
               	<span class="glyphicon glyphicon-euro">              	
            </span>
            </span>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h2>
                      <?php
                        if(!empty($total_collection->total_collection)) {
                          
                            echo $this->localization->currencyFormat($total_collection->total_collection);
                        }else{
                            echo $this->localization->currencyFormat(0);
                        }
                        ?></h2>
                    <p>Total Collections</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
            <span class="small-box-footer">
               <span class="glyphicon glyphicon-ok"></span>
            </span>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h2><?php echo $this->localization->currencyFormat($total_loans_open->total_loans); ?></h2>
                    <p>Total Outstanding Open Loans</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
            <span class="small-box-footer">
          <span class="glyphicon glyphicon-usd"></span>
            </span>
            </div>
        </div><!-- ./col -->
           <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h2><?php echo $this->localization->currencyFormat($total_expense); ?></h2>
                    <p>Total Expenses</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
            <span class="small-box-footer">
           <?php echo date('F')?>
            </span>
            </div>
        </div><!-- ./col -->
        
        <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h2><?php echo  $this->localization->currencyFormat($total_loans_full->total_loans); ?></h2>
                    <p>Full Paid Loans</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
            <span class="small-box-footer">
              <span class="glyphicon glyphicon-saved">
            </span>
            </span>
            </div>
        </div><!-- ./col -->
        
         <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h2><?php  if(!empty($total_loans_restructured->total_loans)) {
                          
                            echo $this->localization->currencyFormat($total_loans_restructured->total_loans);
                        }else{
                            echo $this->localization->currencyFormat(0);
                        } ?></h2>
                    <p>Restructured Loans</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
             <span class="small-box-footer">
              <span class="glyphicon glyphicon-saved">
            </span>
            </div>
        </div><!-- ./col -->
        
         <div class="col-lg-3 col-sm-6 col-sx-12">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h2><?php  
                    
                    if(!empty($total_loans_default->total_loans)) {
                          
                            echo $this->localization->currencyFormat($total_loans_default->total_loans);
                        }else{
                            echo $this->localization->currencyFormat(0);
                        }
                    
                    ?></h2>
                    <p>Default Loans</p>
                </div>
                <div class="icon">
                    <i class="fa fa-suitcase"></i>
                </div>
             <span class="small-box-footer">
              <span class="glyphicon glyphicon-file">
            </span>
            </div>
        </div><!-- ./col -->
    </div>


    <div class="row">
        <div class="col-md-8">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        Yearly Loans Report
                    </h3>
                </div>
                <div id="portlet1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <div id="morris-bar-example" style="height: 250px;"></div>

                        <div class="row text-center m-t-30 m-b-30 chart-table">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <h4>
                                    <?php
                                    if(!empty($today_sale)) {
                                        echo $this->localization->currency($today_sale->grand_total);
                                    }else{
                                        echo $this->localization->currency(0);
                                    }
                                    ?>
                                </h4>
                                <small class="text-muted"> Today's Loans</small>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <h4>
                                    <?php
                                    if(!empty($revenue->grand_total)) {
                                        echo $this->localization->currency($weekly_sales->grand_total);
                                    }else{
                                        echo $this->localization->currency(0);
                                    }
                                    ?>
                                </h4>
                                <small class="text-muted">This Week's Loans</small>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <h4>
                                    <?php
                                    if(!empty($revenue->grand_total)) {
                                        echo $this->localization->currency($revenue->grand_total);
                                    }else{
                                        echo $this->localization->currency(0);
                                    }
                                    ?>
                                </h4>
                                <small class="text-muted">This Month's Loans</small>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">

                                <h4>
                                    <?php
                                    if(!empty($yearly_sale->grand_total)) {
                                        echo $this->localization->currency($yearly_sale->grand_total);
                                    }else{
                                        echo $this->localization->currency(0);
                                    }
                                    ?>
                                </h4>
                                <small class="text-muted">This Year's Loans</small>
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
                        Top <strong>5</strong> Borrowers <strong><?php echo date('Y')?></strong>
                    </h3>
                </div>
                <div id="portlet2" class="panel-collapse collapse in">
                    <div class="portlet-body" style="height: 400px">

                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Account #</th>
                                    <th>Name</th>
                                    <th>Value</th>
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
                        Recent Loans
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
                        Top 5 Loans Taken <?php echo date('F')?>
                    </h5>
                </div>
                <div id="portlet2" class="panel-collapse collapse in">
                    <div class="portlet-body" style="height: 400px">

                            <table class="table no-margin">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Loan #</th>
                                    <th>Borrower</th>
                                    <th>Value</th>
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
                            echo round($result->grand_total);
                        }
                    }
                    ?>,
                    b: <?php echo round($result->profit)?>,
                    c: <?php echo round($result->purchase)?>
                },

                <?php endforeach; ?>

            ],
            xkey: 'x',
            ykeys: ['a', 'b', 'c'],
            labels: ['Revenue', 'Profit', 'Purchase'],
            barColors: ['#3bc0c3', '#1a2942', '#5F5AAB']
        });

    });
</script>