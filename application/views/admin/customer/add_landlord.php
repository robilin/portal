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
               <h3 class="box-title ">UPDATE/ADD LANDLORD PROFILE ACCOUNT # <?php if(!empty($customer_info)){
                                          echo $customer_info->customer_account;
                                          }else {echo $code; } ?></h3>
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
                                 <option value="Other">Other</option>
                                 <?php }else {?>
                                 <option value="Male">Male</option>
                                 <option value="Female">Female</option>
                                 
                                 <?php }?>
                              </select>
                           </div>
                           <!-- /.Birth date -->
                           <div class="form-group form-group-bottom"><label>Birth Date<span
                              class="required">*</span></label></div>
                           <div class="input-group">
                              <input type="text" placeholder="Birth date" value="<?php
                                 if (!empty($customer_info->birth_date)) {
                                 	  $birth_date = date('Y/m/d', strtotime($customer_info->birth_date));
                                    echo $birth_date;
                                 }
                                 ?>" class="form-control datepicker" id="birth_date" name="birth_date" data-format="yyyy/mm/dd">
                              <div class="input-group-addon"><a href="#"><i class="entypo-calendar"></i></a>
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
                              <label for="exampleInputEmail1">Business name</label> 
                              <input type="text" placeholder="Business name" name="business_name"	onchange="check_phone(this.value)"	value="<?php
                                 if (!empty($customer_info->business_name)) {
                                   echo $customer_info->business_name;
                                 }
                                 ?>" class="form-control">
                              <div style="color: #E13300" id="business_name"></div>
                           </div>
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