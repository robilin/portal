<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>PayLess</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- 
	//////////////////////////////////////////////////////
//Updated by Venance Edson 2017/june
		
	Email: 			info@xchangewallet.com
	Twitter: 		http://twitter.com/robilin
	Facebook: 		https://www.facebook.com/robilin

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,600,400italic,700' rel='stylesheet' type='text/css'>
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- 
	Default Theme Style 
	You can change the style.css (default color purple) to one of these styles
	
	

	-->
	<link rel="stylesheet" href="css/style.css">

	<!-- Styleswitcher ( This style is for demo purposes only, you may delete this anytime. ) -->
	<link rel="stylesheet" id="theme-switch" href="css/style.css">
	<!-- End demo purposes only -->


	<style>
	/* For demo purpose only */

	/*
	GREEN
	8dc63f
	RED
	FA5555
	TURQUOISE
	27E1CE
	BLUE 
	2772DB
	ORANGE
	FF7844
	YELLOW
	FCDA05
	PINK
	F64662
	PURPLE
	7045FF

	*/
	
	/* For Demo Purposes Only ( You can delete this anytime :-) */
	#colour-variations {
		padding: 10px;
		-webkit-transition: 0.5s;
	  	-o-transition: 0.5s;
	  	transition: 0.5s;
		width: 140px;
		position: fixed;
		left: 0;
		top: 100px;
		z-index: 999999;
		background: #fff;
		/*border-radius: 4px;*/
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		-webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
	}
	#colour-variations.sleep {
		margin-left: -140px;
	}
	#colour-variations h3 {
		text-align: center;;
		font-size: 11px;
		letter-spacing: 2px;
		text-transform: uppercase;
		color: #777;
		margin: 0 0 10px 0;
		padding: 0;;
	}

	#colour-variations ul,
	#colour-variations ul li {
		padding: 0;
		margin: 0;
	}
	#colour-variations ul {
		margin-bottom: 20px;
		float: left;	
	}
	#colour-variations li {
		list-style: none;
		display: inline;
	}
	#colour-variations li a {
		width: 20px;
		height: 20px;
		position: relative;
		float: left;
		margin: 5px;
	}



	#colour-variations li a[data-theme="style"] {
		background: #8dc63f;
	}
	#colour-variations li a[data-theme="red"] {
		background: #FA5555;
	}
	#colour-variations li a[data-theme="turquoise"] {
		background: #27E1CE;
	}
	#colour-variations li a[data-theme="blue"] {
		background: #2772DB;
	}
	#colour-variations li a[data-theme="orange"] {
		background: #FF7844;
	}
	#colour-variations li a[data-theme="yellow"] {
		background: #FCDA05;
	}
	#colour-variations li a[data-theme="pink"] {
		background: #F64662;
	}
	#colour-variations li a[data-theme="purple"] {
		background: #7045FF;
	}

	#colour-variations a[data-layout="boxed"],
	#colour-variations a[data-layout="wide"] {
		padding: 2px 0;
		width: 48%;
		border: 1px solid #ededed;
		text-align: center;
		color: #777;
		display: block;
	}
	#colour-variations a[data-layout="boxed"]:hover,
	#colour-variations a[data-layout="wide"]:hover {
		border: 1px solid #777;
	}
	#colour-variations a[data-layout="boxed"] {
		float: left;
	}
	#colour-variations a[data-layout="wide"] {
		float: right;
	}

	.option-toggle {
		position: absolute;
		right: 0;
		top: 0;
		margin-top: 5px;
		margin-right: -30px;
		width: 30px;
		height: 30px;
		background: #8dc63f;
		text-align: center;
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		color: #fff;
		cursor: pointer;
		-webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
	}
	.option-toggle i {
		top: 2px;
		position: relative;
	}
	.option-toggle:hover, .option-toggle:focus, .option-toggle:active {
		color:  #fff;
		text-decoration: none;
		outline: none;
	}
	</style>
	<!-- End demo purposes only -->


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>


	<!-- 
		INFO:
		Add 'boxed' class to body element to make the layout as boxed style.
		Example: 
		<body class="boxed">	
	-->
	<body>
	
	<!-- Loader -->
	<div class="fh5co-loader"></div>
	
	<div id="fh5co-page">
		<section id="fh5co-header">
		
			<div class="container">
				<nav role="navigation">
				 <ul class="pull-left left-menu">
				  <h1 id="fh5co-logo"><a href="index.php"><img src="images/logo.png" alt="logo"></a></h1>
				 </ul>
					<ul class="pull-right left-menu">
					  
					    <li><a href="index.php">Home</a></li>
						<li><a href="#services">Our Services</a></li>
						<li><a href="#features">Features</a></li>
						<li><a href="#users">Personal</a></li>
						<li><a href="#users">Landlord</a></li>
						<li><a href="#users">Service Providers</a></li>
						<li><a href="http://localhost/riverton/login">Login</a></li>
						<li class="fh5co-cta-btn"><a href="http://localhost/riverton/customer_register">Sign up</a></li>
					</ul>
				</nav>
			</div>
		</section>
		<!-- #fh5co-header -->

		<section id="fh5co-hero" class="js-fullheight" style="background-image: url(images/hero_bg.jpg);" data-next="yes">
			<div class="fh5co-overlay"></div>
			<div class="container">
				<div class="fh5co-intro js-fullheight">
					<div class="fh5co-intro-text">
						<!-- 
							INFO:
							Change the class to 'fh5co-right-position' or 'fh5co-center-position' to change the layout position
							Example:
							<div class="fh5co-right-position">
						-->
						<div class="fh5co-center-position">
							<h3 class="animate-box">Payless&trade; Smart Metering Redefined</h3>
							<p class="animate-box"><a href="http://localhost/riverton/buy_token" target="_blank" class="btn btn-primary">Buy Token</a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="fh5co-learn-more animate-box">
				<a href="#" class="scroll-btn">
					<span class="text">Explore more about us</span>
					<span class="arrow"><i class="icon-chevron-down"></i></span>
				</a>
			</div>
		</section>
		<!-- END #fh5co-hero -->


		<section id="fh5co-projects">
			<div class="container">
				<div class="row row-bottom-padded-md">
					<div class="col-md-12 text-center">
						<h2 class="fh5co-lead animate-box"><a name="users"></a>Platform Users</h2>
						<p class="fh5co-sub-lead animate-box">We are continually adding and enhancing the powerful features of Payless&trade; tailored to specific user roles. We have 'Consumer' roles - created for the end user (tenant), 'Owner' roles - aimed at the recipient of payments for energy credits (building owners and managing agents), and 'Provider' roles for Meter Operators who are using Payless&trade; as a payment portal.</p>
					</div>
				</div>
				<div class="row">
					
					<div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
						<a href="images/img_1.jpg" class="fh5co-project-item image-popup">
							<img src="images/img_1.jpg" alt="Image" class="img-responsive">
							<div class="fh5co-text">
								<h2>Owner Portal</h2>
								<p>Building Owners can use PayLess&trade; to manage their Smart Meter deployment.</p>
								<ul class="list-inline star-vote">
<li><i class="color-green fa fa-sitemap"></i> Manage Deployments</li><br>
<li><i class="color-green fa fa-newspaper-o"></i> Customise Tariffs</li><br>
<li><i class="color-green fa fa-users"></i> Invite Colleagues &amp; Consumers</li><br>
<li><i class="color-green fa fa-signal"></i> Configure Remote Readings</li><br>
<li><i class="color-green fa fa-fax"></i> Add &amp; Activate Meters</li><br>
<li><i class="color-green fa fa-gbp"></i> Accounts (Xero) Integration</li><br>
</ul>
							</div>
						</a>
					</div>

					<div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
						<a href="images/img_2.jpg" class="fh5co-project-item image-popup">
							<img src="images/img_2.jpg" alt="Image" class="img-responsive">
							<div class="fh5co-text">
								<h2>Consumer/Personal Portal</h2>
								<p>Consumer's can use PayLess&trade; to access the functions of their assigned Meter Point</p>
								<ul class="list-inline star-vote">
<li><i class="color-green fa fa-gbp"></i> Monitor Energy Credits</li><br>
<li><i class="color-green fa fa-bolt"></i> View Energy Consumption</li><br>
<li><i class="color-green fa fa-line-chart"></i> Activate Auto-Recharge</li><br>
<li><i class="color-green fa fa-file-text-o"></i> SMS Notifications</li><br>
<li><i class="color-green fa fa-mobile"></i> Mobile Friendly</li><br>
<li><i class="color-green fa fa-paper-plane-o"></i> Credit Delivery Tracking</li><br>
</ul>
							</div>
						</a>
					</div>

					<div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
						<a href="images/img_3.jpg" class="fh5co-project-item image-popup">
							<img src="images/img_3.jpg" alt="Image" class="img-responsive">
							<div class="fh5co-text">
								<h2>Service Providers</h2>
								<p>Managing Agents and Smart-Meter Operators can tailor Payless&trade; to their exact needs.</p>
								<ul class="list-inline star-vote">
<li><i class="color-green icon-layers"></i> Multi-Role Management</li><br>
<li><i class="color-green fa fa-cogs"></i> Head-End System Integration</li><br>
<li><i class="color-green fa fa-paper-plane-o"></i> Delivery Job Tracking</li><br>
<li><i class="color-green fa fa-paint-brush"></i> Custom Branding</li><br>
<li><i class="color-green fa fa-wrench"></i> System Management</li><br>
<li><i class="color-green fa fa-smile-o"></i> Feature Request Development</li><br>
</ul>
							</div>
						</a>
					</div>				
					
				</div>
			</div>
		</section>
		<!-- END #fh5co-projects -->

		<section id="fh5co-features">
			<div class="container">
				<div class="row text-center row-bottom-padded-md">
					<div class="col-md-8 col-md-offset-2">
						<figure class="fh5co-devices animate-box"><img src="images/img_devices.png" alt="Free HTML5 Bootstrap Template" class="img-responsive"></figure>
						<h2 class="fh5co-lead animate-box"><a name="services"></a>Our Services</h2>
						<p class="fh5co-sub-lead animate-box">PayLess provides technical services to Owners of Smart Meters (used in a sub-metering environment). As developers of the PayLess&trade; platform, we are able to design bespoke features to integrate with your existing IT systems.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-feature">
							<div class="fh5co-icon">
								<i class="icon-power"></i>
							</div>
							<h3></a>Multi-Platform</h3>
							<p>Payless&trade; is multi-platform compatible; all Smart Phones, Tablets, and PC browsers are supported.</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-feature">
							<div class="fh5co-icon">
								<i class="icon-flag2"></i>
							</div>
							<h3>System Integration</h3>
							<p>Our software development team will integrate Payless&trade; with your IT systems.</p>
						</div>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-feature">
							<div class="fh5co-icon">
								<i class="icon-anchor"></i>
							</div>
							<h3>Outstanding Support</h3>
							<p>We pride ourselves in offering friendly impartial advice, even if Payless&trade; is not for you.</p>
						</div>
					</div>

					<div class="col-md-4 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-feature">
							<div class="fh5co-icon">
								<i class="icon-paragraph"></i>
							</div>
							<h3>User Friendly</h3>
							<p>We listen to our customers - user's feedback is always taken on board</p>
						</div>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-feature">
							<div class="fh5co-icon">
								<i class="icon-umbrella"></i>
							</div>
							<h3>Customizable Design</h3>
							<p>We are able to brand Payless&trade; to match our customer's corporate imagery.</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-feature">
							<div class="fh5co-icon">
								<i class="icon-toggle"></i>
							</div>
							<h3>Free Updates</h3>
							<p>All customers benefit as we build new features and include them into the latest PayLess&trade; release</p>
						</div>
					</div>
					<div class="clearfix visible-sm-block"></div>
				</div>
			</div>
		</section>	

		<!-- END #fh5co-features -->


		<section id="fh5co-features-2">
			<div class="container">
				<div class="col-md-6 col-md-push-6">
					<figure class="fh5co-feature-image animate-box">
						<img src="images/macbook.png" alt="Free HTML5 Bootstrap Template by FREEHTML5.co">
					</figure>
				</div>
				<div class="col-md-6 col-md-pull-6">
					<span class="fh5co-label animate-box">See technology</span>
					<h2 class="fh5co-lead animate-box"><a name="features"></a>Superb Technology</h2>
					<div class="fh5co-feature">
						<div class="fh5co-icon animate-box"><i class="icon-check2"></i></div>
						<div class="fh5co-text animate-box">
							<h3>Smart Meter</h3>
							<p>We partner with manufactures of Smart Energy Meters that conform to the latest regulations and technologies in the industry. </p>
						</div>
					</div>
					<div class="fh5co-feature">
						<div class="fh5co-icon animate-box"><i class="icon-check2"></i></div>
						<div class="fh5co-text animate-box">
							<h3>Mobile Technology</h3>
							<p>Our Smart Meters are equipped with Roaming SIM's which will use the best available mobile network coverage in the area. With Mobile payment,Payless is a game changer</p>
						</div>
					</div>
					<div class="fh5co-feature">
						<div class="fh5co-icon animate-box"><i class="icon-check2"></i></div>
						<div class="fh5co-text animate-box">
							<h3>PCI Compliant Payments</h3>
							<p>Our innovate payment portal allows owners to get paid directly from their tenants, supports Visa/Mastercard credit/debit cards,Mobile Money and of course is fully PCI compliant</p>
						</div>
					</div>

					<div class="fh5co-btn-action animate-box">
						<a href="#" class="btn btn-primary btn-cta">More Features</a>
					</div>

				</div>
			</div>
		</section>
		<!-- END #fh5co-features-2 -->
		
		<section id="fh5co-testimonials">
			<div class="container">
				<div class="row row-bottom-padded-sm">
					<div class="col-md-6 col-md-offset-3 text-center">
						<div class="fh5co-label animate-box">Testimonials</div>
						<h2 class="fh5co-lead animate-box">Join Thousands of Users Using Our Services </h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<div class="flexslider">
					  		<ul class="slides">
							   <li>
							      <blockquote>
							      	<p>&ldquo;.Payless Services are Simple to use,Time saving &  Mostly cost effective &rdquo;</p>
							      	<p><cite>&mdash; Anonymous</cite></p>
							      </blockquote>
							   </li>
							   <li>
							    	<blockquote>
							      	<p>&ldquo;I can view energy consumption,get notified and manage credits at fingertips, Payless has made it snappy!.&rdquo;</p>
							      	<p><cite>&mdash; Anonymous</cite></p>
							      </blockquote>
							   </li>
							   <li>
							    	<blockquote>
							      	<p>&ldquo;With mobile payments,paying electricity bills has been simplified, Thank you Payless&trade; .&rdquo;</p>
							      	<p><cite>&mdash; Anonymous</cite></p>
							      </blockquote>
							   </li>
							</ul>
						</div>
						<div class="flexslider-controls">
						   <ol class="flex-control-nav">
						      <li class="animate-box"><img src="images/person1.jpg" alt=""></li>
						      <li class="animate-box"><img src="images/person1.jpg" alt=""></li>
						      <li class="animate-box"><img src="images/person1.jpg" alt=""></li>
						   </ol>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END #fh5co-testimonials -->

		<section id="fh5co-subscribe">
			<div class="container">
		
				<h3 class="animate-box"><label for="email">Subscribe to our newsletter</label></h3>
				<form action="#" method="post" class="animate-box">
					<i class="fh5co-icon icon-paper-plane"></i>
					<input type="email" class="form-control" placeholder="Enter your email" id="email" name="email">
					<input type="submit" value="Send" class="btn btn-primary">
				</form>

			</div>
		</section>
		<!-- END #fh5co-subscribe -->

		<footer id="fh5co-footer">
			<div class="container">
				<div class="row row-bottom-padded-md">
					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							<h3>Company</h3>
							<ul class="fh5co-links">
								<li><a href="#">Home</a></li>
								<li><a href="#">Login</a></li>
								<li><a href="#">Sign up</a></li>
								<li><a href="#">Local payment Options</a></li>
								<li><a href="#">Available Currencies</a></li>
								<li><a href="#">Fees</a></li>
								<li><a href="#">Features</a></li>
								<li><a href="#">Personal</a></li>
								<li><a href="#">Business</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							<h3>Support</h3>
							<ul class="fh5co-links">
								<li><a href="#">Support</a></li>
								<li><a href="#">Security Center</a></li>
								<li><a href="#">Developer Center</a></li>
								<li><a href="#">24/7 Call Support</a></li>
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Shopping Cart</a></li>
								<li><a href="#">Legal</a></li>
								<li><a href="#">Corporate</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							<h3>Contact Us</h3>
							<p>
								<a href="mailto:info@payless.co.tz">info@payless.co.tz</a> <br>
								P.O. Box 35672, <br>
								Off Bagamoyo Road, Riverstate House No. 19 <br>
								<a href="tel:+255222618777">+255(0)222618777</a>
							</p>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							<h3>Follow Us</h3>
							<p>Hey,did you know we are on Facebook, Instagram,Yotutube,Pinterest,google plus AND Twitter?! Check out our accounts and pages here</p>
							<ul class="fh5co-social">
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-google-plus"></i></a></li>
								<li><a href="#"><i class="icon-instagram"></i></a></li>
								<li><a href="#"><i class="icon-youtube-play"></i></a></li>
								<li><a href="#"><i class="icon-pinterest"></i></a></li>
							</ul>
						</div>
					</div>

				</div>
				
			</div>
			<div class="fh5co-copyright animate-box">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p class="fh5co-left"><small>&copy; 2016 <a href="index.html">Guide</a> free html5. All Rights Reserved.</small></p>
							<p class="fh5co-right"><small class="fh5co-right">Designed by <a href="http://freehtml5.co" target="_blank">FREEHTML5.co</a> Demo Images: <a href="http://unsplash.com" target="_blank">Unsplash</a></small></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- END #fh5co-footer -->
	</div>
	<!-- END #fh5co-page -->
	
	<!-- For demo purposes Only ( You may delete this anytime :-) -->
	<div id="colour-variations">
		<a class="option-toggle"><i class="icon-gear"></i></a>
		<h3>Preset Colors</h3>
		<ul>
			<li><a href="javascript: void(0);" data-theme="style"></a></li>
			<li><a href="javascript: void(0);" data-theme="red"></a></li>
			<li><a href="javascript: void(0);" data-theme="turquoise"></a></li>
			<li><a href="javascript: void(0);" data-theme="blue"></a></li>
			<li><a href="javascript: void(0);" data-theme="orange"></a></li>
			<li><a href="javascript: void(0);" data-theme="yellow"></a></li>
			<li><a href="javascript: void(0);" data-theme="pink"></a></li>
			<li><a href="javascript: void(0);" data-theme="purple"></a></li>
		</ul>
		<a href="#" data-layout="boxed">Boxed</a>
		<a href="#" data-layout="wide">Wide</a>
	</div>
	<!-- End demo purposes only -->

	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>

	<!-- For demo purposes only styleswitcher ( You may delete this anytime ) -->
	<script src="js/jquery.style.switcher.js"></script>
	<script>
		$(function(){
			$('#colour-variations ul').styleSwitcher({
				defaultThemeId: 'theme-switch',
				hasPreview: false,
				cookie: {
		          	expires: 30,
		          	isManagingLoad: true
		      	}
			});	
			$('.option-toggle').click(function() {
				$('#colour-variations').toggleClass('sleep');
			});
		});
	</script>
	<!-- End demo purposes only -->

	<!-- Main JS (Do not remove) -->
	<script src="js/main.js"></script>

	<!-- 
	INFO:
	jQuery Cookie for Demo Purposes Only. 
	The code below is to toggle the layout to boxed or wide 
	-->
	<script src="js/jquery.cookie.js"></script>
	<script>
		$(function(){

			if ( $.cookie('layoutCookie') != '' ) {
				$('body').addClass($.cookie('layoutCookie'));
			}

			$('a[data-layout="boxed"]').click(function(event){
				event.preventDefault();
				$.cookie('layoutCookie', 'boxed', { expires: 7, path: '/'});
				$('body').addClass($.cookie('layoutCookie')); // the value is boxed.
			});

			$('a[data-layout="wide"]').click(function(event){
				event.preventDefault();
				$('body').removeClass($.cookie('layoutCookie')); // the value is boxed.
				$.removeCookie('layoutCookie', { path: '/' }); // remove the value of our cookie 'layoutCookie'
			});
		});
	</script>
	

	</body>
</html>

