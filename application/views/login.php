<?php $this->load->view('admin/components/header'); ?>
<link href="<?php echo base_url(); ?>asset/css/animation.css" rel="stylesheet"> 
<link href="<?php echo base_url(); ?>asset/css/style.css" rel="stylesheet">

<style>

.btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color: #26A472 !important;
}

.btn-primary,
.btn-primary:hover,
.btn-primary:active,
.btn-primary:visited,
.btn-primary:focus {
    background-color: #26A472;
    border-color: #26A472;
}

.btn-success,
.btn-success:hover,
.btn-success:active,
.btn-success:visited,
.btn-success:focus {
    background-color: #26A472;
    border-color: #ffffff;
}

a {
  color: #ffffff;
  -webkit-transition: 0.5s;
  -o-transition: 0.5s;
  transition: 0.5s;
}
</style>

<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,600,400italic,700' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link href="<?php echo base_url(); ?>asset/css/animate.css">
	<!-- Flexslider -->
	<link href="<?php echo base_url(); ?>asset/css/flexslider.css">
	<!-- Icomoon Icon Fonts-->
	<link href="<?php echo base_url(); ?>asset/css/icomoon.css">
	<!-- Magnific Popup -->
	<link href="<?php echo base_url(); ?>asset/magnific-popup.css">
	<!-- Bootstrap  -->
<body  style="background-image: url(<?php echo base_url(); ?>asset/img/hero_bg.jpg);" data-next="yes"> 


<!-- Loader -->
<div class="fh5co-loader"></div>	
<div id="fh5co-page">	
<div class="login-box">

    

    <div class="login-box-body  animated fadeInUp" data-animation="fadeInUp">

<h5 class="animate-box">
        <!-- <a href="<?php echo base_url() ?>"><img src="<?php echo base_url(); ?>asset/img/logo.png" alt="logo" width="60" height="31"> <span> Smart Metering Redefined</span> </a>  -->
        <a href="<?php echo base_url() ?>"><img src="<?php echo base_url(); ?>asset/img/logo.png" alt="logo" width="60" height="31"> <span> Smart Metering Redefined</span> </a>
        <a href="<?php echo site_url('login')?>" class="btn-success pull-right btn-lg"><i class="fa fa-times"></i></a>
    </h5>
        <div class="panel panel-default">
            <div class="panel-heading">
           <div class="row">
           <div class="col-sm-6">
            <h2 class="animate-box">Login</h2>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
            <span class="glyphicon glyphicon-lock"></span> Secured connection
            </div>
            </div>
            </div>
            <div class="panel-body">

			<?php echo form_open('login');?>
            <?php echo validation_errors(); ?>
         <span class="label label-danger"><?php echo $this->session->flashdata('error'); ?></span></>
                     <div class="form-group has-feedback">
                <input type="text" name="user_name" class="form-control input-lg" placeholder="Username" required="required" />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control input-lg" placeholder="Password" required="required" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            
            <hr>
            <div class="form-group has-feedback">
                <button type="submit" class="btn-primary btn-block btn-flat btn-lg">Login</button>
             
            </div>
            

                <?php echo form_close() ?>
             

            </div>
        </div>



    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
</div>

	<!-- jQuery -->
	
	<!-- jQuery Easing -->
	<script src="<?php echo base_url(); ?>asset/js/jquery.easing.1.3.js"></script>
	
	<!-- Waypoints -->
	<script src="<?php echo base_url(); ?>asset/js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="<?php echo base_url(); ?>asset/js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="<?php echo base_url(); ?>asset/js/jquery.magnific-popup.min.js"></script>
	<script src="<?php echo base_url(); ?>asset/js/magnific-popup-options.js"></script>
	 <script src="<?php echo base_url(); ?>asset/js/main.js"></script>
	
	<script>
    jQuery(window).load(function(){
        jQuery(".fh5co-loader").fadeOut(500);
    });
</script>

</body>
</html>