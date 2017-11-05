<script src="<?php echo base_url(); ?>asset/js/ajax.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
<script src="<?php echo base_url(); ?>asset/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php $info = $this->session->userdata('business_info'); ?>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-primary">
             <div class="box-header box-header-background with-border">
               <h3 class="box-title "> <?php if(!empty($customer_info)){
                   echo $title.' '.$customer_info->customer_account;
                                          }else {echo $title.' '.$code; } ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="addcustomerForm"	onsubmit="return imageForm(this)"	action="<?php echo base_url(); ?>admin/customer/save_landlord/<?php  if (!empty($customer_info)) {
               echo $customer_info->customer_id;
               } ?>" method="post">
               <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                  <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#general" data-toggle="tab">General</a></li>
                  <li	class="<?php if(!empty($tab)){ echo $tab == 'contact'?'active':'';}?>"><a href="#contact" data-toggle="tab">Contact Information</a></li>
                  <li	class="<?php if(!empty($tab)){ echo $tab == 'optional'?'active':'';}?>"><a href="#optional" data-toggle="tab">Optional Information</a></li>
                  <li	class="<?php if(!empty($tab)){ echo $tab == 'Login'?'active':'';}?>"><a href="#login" data-toggle="tab">Login</a></li>
               </ul>
               <div class="row">
                  <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3">
                     <div id="my-tab-content" class="tab-content">
                        <!-- ***************  General Tab Start ****************** -->
                        <div class="tab-pane <?php if(empty($tab)){ echo 'active';} ?>" id="general">
                        
                          <div class="form-group">
                              <label for="exampleInputEmail1">Business name or Company name</label> 
                              <input type="text" placeholder="Business name" name="business_name"	onchange="check_phone(this.value)"	value="<?php
                                 if (!empty($customer_info->business_name)) {
                                   echo $customer_info->business_name;
                                 }
                                 ?>" class="form-control">
                              <div style="color: #E13300" id="business_name"></div>
                           </div>

                           <!-- .Names -->
                     <div class="form-group">
                                   <label>First name<span class="required">*</span></label>
                                    <input type="text" placeholder="Last Name"  required name="first_name" value="<?php if (!empty($customer_info)) {
                                       echo $customer_info->first_name;
                                       }?>" class="form-control">
                                       </div>                                 
                                  
                                 
                                  
                                   <div class="form-group">
                                   <label>Last name<span class="required">*</span></label>
                                    <input type="text" placeholder="Last Name" required name="last_name" value="<?php if (!empty($customer_info)) {
                                       echo $customer_info->last_name;
                                       }?>" class="form-control">
                                       </div>
                                 
                          
                           
                           <!-- /.Gender -->
                           <div class="form-group">
                              <label>Gender<span class="required">*</span></label>
                              <select required name="gender" class="form-control col-sm-5" id="gender">
                                 <option value="">Select Gender</option>
                                 <?php if (!empty($customer_info)){ ?>
                                 <option value="<?php echo $customer_info->gender; ?>"
                                    <?php
                                       if (!empty($customer_info)) {
                                       	echo $customer_info->gender == $customer_info->gender ? 'selected' : '';
                                       }
                                       ?>><?php echo $customer_info->gender; ?></option>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                                
                                 <?php }else {?>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                                 
                                 <?php }?>
                              </select>
                           </div>
                           <!-- /.Birth date -->
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

                        </div>
                        <!-- ************* General Tab End ********************** -->
                        <!-- ************ Contacts details Tab Start ************** -->
                        <div
                           class="tab-pane
                           <?php
                              if(!empty($tab)){
                                  echo $tab == 'contact'?'active':'';
                              }
                              ?>
                           "
                           id="contact">
                           <!-- /.General Price Start -->
                           <div class="box">
                              <div class="form-group">
                                 <label>Physical Address</label>
                                 <div class="row">
                                    <div class="col-xs-4"><input type="text" placeholder="House no, Street"
                                       name="house_no"
                                       value="<?php if (!empty($customer_info)) {
                                          echo $customer_info->house_no;
                                          }?>"
                                       class="form-control"></div>
                                    <div class="col-xs-4"><input type="text" placeholder="Village"
                                       name="village"
                                       value="<?php if (!empty($customer_info)) {
                                          echo $customer_info->village;
                                          }?>"
                                       class="form-control"></div>
                                    <div class="col-xs-4"><input type="text" placeholder="District"
                                       name="district"
                                       value="<?php if (!empty($customer_info)) {
                                          echo $customer_info->district;
                                          }?>"
                                       class="form-control"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="box">
                              <!-- /.Address -->
                              <div class="form-group"><label for="exampleInputEmail1">Official Address</label>
                                 <textarea name="address" class="form-control autogrow"
                                    placeholder="Address" rows="4"><?php
                                    if (!empty($customer_info->address)) {
                                    	echo $customer_info->address;
                                    }
                                    ?>
                                 </textarea>
                              </div>
                              <!-- /.box-body -->
                           </div>
                           <!-- /.Phone -->
                           <div class="form-group">
                              <label for="exampleInputEmail1">Phone</label> 
                              <input type="text" placeholder="Phone" name="phone"	onchange="check_phone(this.value)"	value="<?php
                                 if (!empty($customer_info->phone)) {
                                   echo $customer_info->phone;
                                 }
                                 ?>" class="form-control">
                              <div style="color: #E13300" id="phone_result"></div>
                           </div>
                           <!-- /.Email -->
                           <div class="form-group">
                              <label for="exampleInputEmail1">Email</label> 
                              <input type="text" placeholder="Email" name="email"	value="<?php
                                 if (!empty($customer_info->email)) {
                                   echo $customer_info->email;
                                 }
                                 ?>" class="form-control">
                              <div style="color: #E13300" id="email_result"></div>
                           </div>
                        </div>
                        <!-- Optinal information pane starts here -->
                        <div
                           class="tab-pane
                           <?php
                              if(!empty($tab)){
                                  echo $tab == 'optional'?'active':'';
                              }
                              ?>
                           "
                           id="optional">
                           <!-- /.Business name -->
                           <div class="form-group">
                              <!-- hidden  old_path when update  -->
                              <input type="hidden" name="old_path"  value="<?php
                                 if (!empty($customer_info->borrowers_photo_path)) {
                                     echo $customer_info->borrowers_photo_path;
                                 }
                                 ?>">
                              <div class="fileinput fileinput-new"  data-provides="fileinput">
                                 <div class="fileinput-new thumbnail g-logo-img" >
                                    <?php if (!empty($customer_info->borrowers_photo_name)): // if product image is exist then show  ?>
                                    <img src="<?php echo base_url() . $customer_info->borrowers_photo_name; ?>" >
                                    <?php else: // if product image is not exist then defualt a image ?>
                                    <img src="<?php echo base_url() ?>img/user.jpg" alt="User Image">
                                    <?php endif; ?>
                                 </div>
                                 <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                 <div>
                                    <span class="btn btn-default btn-file">
                                    <span class="fileinput-new"><input type="file" name="borrowers_photo_name" /></span>
                                    <span class="fileinput-exists">Change</span>
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                 </div>
                                 <div id="valid_msg" class="required"></div>
                              </div>
                           </div>
                    
                           <div class="box">
                              <!-- /.Description -->
                              <div class="form-group"><label for="exampleInputEmail1">Description</label>
                                 <textarea name="description" class="form-control autogrow"
                                    placeholder="Description" rows="4"><?php
                                    if (!empty($customer_info->description)) {
                                    	echo $customer_info->description;
                                    }
                                    ?>
                                 </textarea>
                              </div>
                              <!-- /.box-body -->
                           </div>
                           <!-- /.Phone -->
                           <div class="form-group">
                              <label>Attach file</label>
                           </div>
                           <div class="form-group">
                              <!-- hidden  old_path when update  -->
                              <input type="hidden" name="file_old_path"  value="<?php
                                 if (!empty($customer_info->borrowers_file_path)) {
                                     echo $customer_info->borrowers_file_path;
                                 }
                                 ?>">
                              <div class="fileinput fileinput-new"  data-provides="fileinput">
                                 <div class="fileinput-new thumbnail g-logo-img" >
                                    <?php if (!empty($customer_info->borrowers_file_name)): // if collateral file is exist then show  ?>
                                    <img src="<?php echo base_url() . $customer_info->borrowers_file_name; ?>" >
                                    <?php else: // if product image is not exist then defualt a image ?>
                                    <img src="<?php echo base_url() ?>img/file.jpg" alt="borrowers_file">
                                    <?php endif; ?>
                                 </div>
                                 <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                 <div>
                                    <span class="btn btn-default btn-file">
                                    <span class="fileinput-new"><input type="file" name="borrowers_file_name" /></span>
                                    <span class="fileinput-exists">Change</span>
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                 </div>
                                 <div id="valid_msg" class="required"></div>
                              </div>
                           </div>
                        </div>
                        
<!-- removed landlord pane-->
                        
                        <!-- login tab pane starts -->
                                               
                        <div
                           class="tab-pane <?php if(!empty($tab)){ echo $tab == 'login'?'active':''; } ?>" id="login">
                           <div class="col-xs-8">
                           
                            <div class="form-group">
                              <label for="exampleInputEmail1">Username</label> 
                              <input type="text" placeholder="username" name="username"	value="<?php
                                 if (!empty($customer_info->user_id)) {
                                 $user_name=$this->db->get_where('tbl_user',array('user_id'=>$customer_info->user_id))->row();	
                                 echo $user_name->user_name;
                                 }
                                 ?>" class="form-control">
                              
                           </div>
                            <div id="password_div" style="
                                <?php if(!empty($employee_login_details->user_id)){
                                    echo 'display: none';
                                } ?>">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password <span class="required">*</span></label>
                                    <input type="password" placeholder="Password" id="password" name="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="password" placeholder="Password" id="confirm_password" name="confirm_password"
                                           class="form-control">
                                </div>
                                </div>
                                <input type="hidden" id="password_flag" name="password_flag" value="">
                           
                           <?php if(!empty($customer_info->customer_id)) : ?>
                                <div class="form-group">
                                    <input type=button id="change_password" class="btn bg-purple" value='Change Password' onclick="setVisibility();";>

                                </div>
                                <?php endif; ?>
                              
                           </div>
                        </div>
                        <!-- ************* hidden input field ******** -->
                        <!-- ************* hidden input field ******** -->
                        <!-- customer image id -->
                        <input type="hidden" name="customer_image_id"
                           value="<?php
                              if (!empty($customer_image)) {
                                  echo $customer_image->customer_image_id;
                              }
                              ?>">
                       
                        <!-- customer id -->
                        <?php if (!empty($customer_info->customer_id)) {?>
                        <input type="hidden"  name="customer_id"
                           value="<?php echo $customer_info->customer_id ?>">
                        <?php }  ?>
                        
                         <!-- customer id -->
                        <?php if (!empty($customer_info->customer_account)) {?>
                        <input type="hidden"  name="customer_account"
                           value="<?php echo $customer_info->customer_account?>">
                        <?php } else{?>
                        <input type="hidden"  name="customer_account"
                           value="<?php echo $code ?>">
                        <?php }?>
                     </div>
                  </div>
               </div>
               <div class="box-footer">
                  <button type="submit" id="submit" class="btn bg-navy btn-flat col-md-offset-3" type="submit">Update</button>
               </div>
            </form>
            <!-- Form end -->
         </div>
      </div>
   </div>
</section>
<script>
   $(function(){
       var sampleTags = [
           <?php
      if(!empty($tags))
      foreach($tags as $v_tag){
      echo "'$v_tag->tag',";
      }
      
      ?>
       ];
   
       //-------------------------------
       // Allow spaces without quotes.
       //-------------------------------
       $('#allowSpacesTags').tagit({
          availableTags: sampleTags,
           allowSpaces: true,
           fieldName: "tages[]",
           tagLimit:3,
           autocomplete: {delay: 0, minLength: 2}
       });
   });
</script>
<script>
   var options = {
       source: [
           <?php
      if(!empty($attribute_set))
      foreach($attribute_set as $v_attribute){
      echo "'$v_attribute->attribute_name',";
      }
      ?>
       ]
   
   };
   var result = 'input.selector';
   $(document).on('keydown.autocomplete', result, function() {
       $(this).autocomplete(options);
   });
   
</script>
<script type="text/javascript">
   $(".form_datetime").datetimepicker({
       format: "dd MM yyyy - hh:ii",
       autoclose: true,
       todayBtn: true,
       pickerPosition: "bottom-left"
   });
</script>   
    <script>

        $().ready(function() {

            // validate signup form on keyup and submit
            $("#addcustomerForm").validate({
                rules: {
                    user_name: "required",
                    name: "required",

                    user_name: {
                        required: true,
                        minlength: 4
                    },
                    password: {
                        required: true,
                        minlength: 4
                    },

                    confirm_password: {
                        equalTo: "#password"
                    },

                    email: {
                        required: true,
                        email: true
                    }

                },
                highlight: function(element) {
                    $(element).closest('.form-group').addClass('has-error');
                },
                unhighlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                errorElement: 'span',
                errorClass: 'help-block',
                errorPlacement: function(error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                messages: {
                    user_name: {
                        required: "Please enter a username",
                        minlength: "Your username must consist of at least 4 characters"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },

                    email: {
                        required: "Please enter a valid email address"
                    },

                    name: {
                        required: "Please enter your Name"
                    }


                }

            });

        });
    </script>
    <script type="text/javascript">
$(document).ready(function() {
  $(".land_lord").select2();
});
</script>