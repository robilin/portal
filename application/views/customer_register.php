<?php $this->load->view('admin/components/header'); ?>
<?php $this->load->view('admin/components/login_header'); ?>
<link href="<?php echo base_url(); ?>asset/css/animation.css" rel="stylesheet"> 
<link href="<?php echo base_url(); ?>asset/css/style.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
<script src="<?php echo base_url(); ?>asset/js/ajax.js"></script>

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
            <h2 class="animate-box">Register</h2>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
            <span class="glyphicon glyphicon-lock"></span> Secured connection
            </div>
            </div>
            </div>
            <div class="panel-body">
            
            <?php $attributes = array('id' => 'signupForm');?>
            <?php echo form_open('customer_register/register',$attributes);?>
            <?php echo validation_errors(); ?>
            <span class="label label-success"><?php echo $this->session->flashdata('error'); ?></span>

            <div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control input-sm" placeholder="First Name" tabindex="1">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="text" name="last_name" id="last_name" class="form-control input-sm" placeholder="Last Name" tabindex="2">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<input type="text" name="user_name" id="user_name" class="form-control input-sm" placeholder="User Name" tabindex="3">
			</div>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<select requred name="account_type" class="form-control" tabindex="4" id="opt">
				<option value="">
				I am a...
				</option>
				<option value="1">
				Tenant
				</option>
				<option value="2">
				 LandLord
				</option>
				<option value="3">
				 Partner
				</option>
				
				</select>
			</div>
			</div>
			</div>
			<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12" style="display: none" id="parent_id">
					
                        <div class="form-group">
                                <input class="form-control" name="parent_id" placeholder="Type in landlord or partner reference" >
                            </div>
                        </div>
             </div>
                
			
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<input type="text" name="phone" id="phone_number" class="form-control input-sm" placeholder="Mobile number" tabindex="5">
			</div></div>
			<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
			
				<input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" tabindex="6">
			</div>
			</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" tabindex="7">
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6">
					<div class="form-group">
						<input type="password" name="confirm_password" id="confirm_password" class="form-control input-sm" placeholder="Confirm Password" tabindex="8">
					</div>
				</div>
			</div>
			<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<label for="month"><h5>Birthdate</h5></label>
			</div>
			</div>
			<div class="row">
				<div class="col-xs-8 col-sm-4 col-md-4">
					<div class="form-group">
					 
                        <select aria-label="Month" name="birthday_month" id="month" title="Month" class="form-control">
    <option value="0">Month</option>
    <option value="1">Jan</option>
    <option value="2">Feb</option>
    <option value="3">Mar</option>
    <option value="4">Apr</option>
    <option value="5">May</option>
    <option value="6">Jun</option>
    <option value="7">Jul</option>
    <option value="8">Aug</option>
    <option value="9">Sep</option>
    <option value="10" selected="1">Oct</option>
    <option value="11">Nov</option>
    <option value="12">Dec</option>
</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-4 col-md-4">
				
					<div class="form-group">
						<select aria-label="Day" name="birthday_day" id="day" title="Day" class="form-control">
    <option value="0">Day</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26" selected="1">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
</select>
					</div>
				</div>
				<div class="col-xs-8 col-sm-4 col-md-4">
			
					<div class="form-group">
						<select aria-label="Year" name="birthday_year" id="year" title="Year" class="form-control">
    <option value="0">Year</option>
    <option value="2017">2017</option>
    <option value="2016">2016</option>
    <option value="2015">2015</option>
    <option value="2014">2014</option>
    <option value="2013">2013</option>
    <option value="2012">2012</option>
    <option value="2011">2011</option>
    <option value="2010">2010</option>
    <option value="2009">2009</option>
    <option value="2008">2008</option>
    <option value="2007">2007</option>
    <option value="2006">2006</option>
    <option value="2005">2005</option>
    <option value="2004">2004</option>
    <option value="2003">2003</option>
    <option value="2002">2002</option>
    <option value="2001">2001</option>
    <option value="2000">2000</option>
    <option value="1999" selected="1">1999</option>
    <option value="1998">1998</option>
    <option value="1997">1997</option>
    <option value="1996">1996</option>
    <option value="1995">1995</option>
    <option value="1994">1994</option>
    <option value="1993">1993</option>
    <option value="1992">1992</option>
    <option value="1991">1991</option>
    <option value="1990">1990</option>
    <option value="1989">1989</option>
    <option value="1988">1988</option>
    <option value="1987">1987</option>
    <option value="1986">1986</option>
    <option value="1985">1985</option>
    <option value="1984">1984</option>
    <option value="1983">1983</option>
    <option value="1982">1982</option>
    <option value="1981">1981</option>
    <option value="1980">1980</option>
    <option value="1979">1979</option>
    <option value="1978">1978</option>
    <option value="1977">1977</option>
    <option value="1976">1976</option>
    <option value="1975">1975</option>
    <option value="1974">1974</option>
    <option value="1973">1973</option>
    <option value="1972">1972</option>
    <option value="1971">1971</option>
    <option value="1970">1970</option>
    <option value="1969">1969</option>
    <option value="1968">1968</option>
    <option value="1967">1967</option>
    <option value="1966">1966</option>
    <option value="1965">1965</option>
    <option value="1964">1964</option>
    <option value="1963">1963</option>
    <option value="1962">1962</option>
    <option value="1961">1961</option>
    <option value="1960">1960</option>
    <option value="1959">1959</option>
    <option value="1958">1958</option>
    <option value="1957">1957</option>
    <option value="1956">1956</option>
    <option value="1955">1955</option>
    <option value="1954">1954</option>
    <option value="1953">1953</option>
    <option value="1952">1952</option>
    <option value="1951">1951</option>
    <option value="1950">1950</option>
    <option value="1949">1949</option>
    <option value="1948">1948</option>
    <option value="1947">1947</option>
    <option value="1946">1946</option>
    <option value="1945">1945</option>
    <option value="1944">1944</option>
    <option value="1943">1943</option>
    <option value="1942">1942</option>
    <option value="1941">1941</option>
    <option value="1940">1940</option>
    <option value="1939">1939</option>
    <option value="1938">1938</option>
    <option value="1937">1937</option>
    <option value="1936">1936</option>
    <option value="1935">1935</option>
    <option value="1934">1934</option>
    <option value="1933">1933</option>
    <option value="1932">1932</option>
    <option value="1931">1931</option>
    <option value="1930">1930</option>
    <option value="1929">1929</option>
    <option value="1928">1928</option>
    <option value="1927">1927</option>
    <option value="1926">1926</option>
    <option value="1925">1925</option>
    <option value="1924">1924</option>
    <option value="1923">1923</option>
    <option value="1922">1922</option>
    <option value="1921">1921</option>
    <option value="1920">1920</option>
    <option value="1919">1919</option>
    <option value="1918">1918</option>
    <option value="1917">1917</option>
    <option value="1916">1916</option>
    <option value="1915">1915</option>
    <option value="1914">1914</option>
    <option value="1913">1913</option>
    <option value="1912">1912</option>
    <option value="1911">1911</option>
    <option value="1910">1910</option>
    <option value="1909">1909</option>
    <option value="1908">1908</option>
    <option value="1907">1907</option>
    <option value="1906">1906</option>
    <option value="1905">1905</option>
</select>
					</div>
				</div>
			</div>
			<div class="row">
			<div class="col-xs-8 col-sm-9 col-md-9">
			<div class="form-group">
			<label class="radio-inline"><input type="radio" requred name="gender" value="Female" checked><h5>Female</h5></label>
            <label class="radio-inline"><input type="radio" required name="gender" value="Male"><h5>Male</h5></label>
            </div>
            </div>
            </div>
			<div class="row">
				<div class="col-xs-8 col-sm-9 col-md-9">
					 <a href="#" data-toggle="modal" data-target="#t_and_c_m"><h5>By clicking Register,you agree to the Terms and Conditions set out by this site,including our Cookie Use.</h5></a>
				</div>
			</div>
            
            <hr>
            <div class="form-group has-feedback">
                <button type="submit" class="btn-primary btn-block btn-flat btn-lg">Join Payless</button>
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

<div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
			</div>
			<div class="modal-body">
				<p>terms of use</p>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
<script type="text/javascript">
$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i>');
            }
        }
        init();
    });
});
</script>
<script type="text/javascript">
		
		$( document ).ready( function () {
			$( "#signupForm" ).validate( {
				rules: {
					first_name: "required",
					account_type: "required",
					last_name: "required",
					accout_type: "required",
					birthday_year: "required",
					birthday_month: "required",
					birthday_day: "required",
					phone: "required",
					user_name: {
						required: true,
						minlength: 2
					},
					password: {
						required: true,
						minlength: 3
					},
					confirm_password: {
						required: true,
						minlength: 2,
						equalTo: "#password"
					},
					email: {
						required: true,
						email: true
					},
					t_and_c: "required"
				},
				messages: {
					first_name: "Please enter your firstname",
					account_type: "Account type required",
					last_name: "Please enter your lastname",
					birthday_day: "Birth day required",
					birthday_month: "Birth month required",
					birthday_year: "Birth year required",
					phone: "Mobile number required",
					user_name: {
						required: "Please enter a username",
						minlength: "Your username must consist of at least 6 characters"
					},
					password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long"
					},
					confirm_password: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long",
						equalTo: "Please enter the same password as above"
					},
					email: "Please enter a valid email address",
					agree: "Please accept our policy"
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					// Add `has-feedback` class to the parent div.form-group
					// in order to add icons to inputs
					element.parents( ".col-sm-5" ).addClass( "has-feedback" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}

					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !element.next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-remove form-control-feedback'></span>" ).insertAfter( element );
					}
				},
				success: function ( label, element ) {
					// Add the span element, if doesn't exists, and apply the icon classes to it.
					if ( !$( element ).next( "span" )[ 0 ] ) {
						$( "<span class='glyphicon glyphicon-ok form-control-feedback'></span>" ).insertAfter( $( element ) );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
					$( element ).next( "span" ).addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
				},
				unhighlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
					$( element ).next( "span" ).addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
				}
			} );
		} );
	</script>
	<script type="text/javascript">
$(document).ready(function() {
  $("#opt").select2();
});
</script>
	

</body>
</html>