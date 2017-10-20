<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

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
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
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
            -webkit-box-shadow: 0 0 9px 0 rgba(0, 0, 0, .1);
            -moz-box-shadow: 0 0 9px 0 rgba(0, 0, 0, .1);
            -ms-box-shadow: 0 0 9px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 0 9px 0 rgba(0, 0, 0, .1);
        }
        
        #colour-variations.sleep {
            margin-left: -140px;
        }
        
        #colour-variations h3 {
            text-align: center;
            ;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #777;
            margin: 0 0 10px 0;
            padding: 0;
            ;
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
            -webkit-box-shadow: 0 0 9px 0 rgba(0, 0, 0, .1);
            -moz-box-shadow: 0 0 9px 0 rgba(0, 0, 0, .1);
            -ms-box-shadow: 0 0 9px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 0 9px 0 rgba(0, 0, 0, .1);
        }
        
        .option-toggle i {
            top: 2px;
            position: relative;
        }
        
        .option-toggle:hover,
        .option-toggle:focus,
        .option-toggle:active {
            color: #fff;
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
                        <li><a href="http://localhost/payless/login">Login</a></li>
                        <li class="fh5co-cta-btn"><a href="http://localhost/payless/customer_register">Sign up</a></li>
                    </ul>
                </nav>
            </div>
        </section>
        <!-- #fh5co-header -->



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



        
    </div>
    <!-- END #fh5co-page -->

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

    
    <!-- End demo purposes only -->

    <!-- Main JS (Do not remove) -->
    <script src="<?php echo base_url(); ?>asset/js/main.js"></script>


</body>

</html>