<script src="<?php echo base_url(); ?>asset/js/ajax.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>asset/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>asset/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>

<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php $info = $this->session->userdata('business_info'); ?>
<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
			   <div class="box-header box-header-background with-border">
                  <h3 class="box-title "><?php echo $title ?></h3>   
               </div>
                <div class="box box-success">
   <form role="form" enctype="multipart/form-data" id="addcustomerForm"	onsubmit="return imageForm(this)"	
             action="<?php echo base_url(); ?>admin/loan/due_loan"  method="post">
                <input type="hidden" name="search_overdue_loans" value="1">
                <div class="box-body">
                    <div class="row">
                        <label for="inputOverdueDays"  class="col-sm-2 control-label">Overdue by</label>
                        <div class="col-xs-3">
                            <select class="form-control" name="overdue_days" id="inputOverdueDays">
                                <option value="1">1 day</option>
                                <option value="2">2 days</option>
                                <option value="3">3 days</option>
                                <option value="4">4 days</option>
                                <option value="5">5 days</option>
                                <option value="6">6 days</option>
                                <option value="7">7 days</option>
                                <option value="8">8 days</option>
                                <option value="9">9 days</option>
                                <option value="10">10 days</option>
                                <option value="11">11 days</option>
                                <option value="12">12 days</option>
                                <option value="13">13 days</option>
                                <option value="14">14 days</option>
                                <option value="15">15 days</option>
                                <option value="16">16 days</option>
                                <option value="17">17 days</option>
                                <option value="18">18 days</option>
                                <option value="19">19 days</option>
                                <option value="20">20 days</option>
                                <option value="21">21 days</option>
                                <option value="22">22 days</option>
                                <option value="23">23 days</option>
                                <option value="24">24 days</option>
                                <option value="25">25 days</option>
                                <option value="26">26 days</option>
                                <option value="27">27 days</option>
                                <option value="28">28 days</option>
                                <option value="29">29 days</option>
                                <option value="30" selected>30 days</option>
                                <option value="31">31 days</option>
                                <option value="32">32 days</option>
                                <option value="33">33 days</option>
                                <option value="34">34 days</option>
                                <option value="35">35 days</option>
                                <option value="36">36 days</option>
                                <option value="37">37 days</option>
                                <option value="38">38 days</option>
                                <option value="39">39 days</option>
                                <option value="40">40 days</option>
                                <option value="41">41 days</option>
                                <option value="42">42 days</option>
                                <option value="43">43 days</option>
                                <option value="44">44 days</option>
                                <option value="45">45 days</option>
                                <option value="46">46 days</option>
                                <option value="47">47 days</option>
                                <option value="48">48 days</option>
                                <option value="49">49 days</option>
                                <option value="50">50 days</option>
                                <option value="51">51 days</option>
                                <option value="52">52 days</option>
                                <option value="53">53 days</option>
                                <option value="54">54 days</option>
                                <option value="55">55 days</option>
                                <option value="56">56 days</option>
                                <option value="57">57 days</option>
                                <option value="58">58 days</option>
                                <option value="59">59 days</option>
                                <option value="60">60 days</option>
                                <option value="61">61 days</option>
                                <option value="62">62 days</option>
                                <option value="63">63 days</option>
                                <option value="64">64 days</option>
                                <option value="65">65 days</option>
                                <option value="66">66 days</option>
                                <option value="67">67 days</option>
                                <option value="68">68 days</option>
                                <option value="69">69 days</option>
                                <option value="70">70 days</option>
                                <option value="71">71 days</option>
                                <option value="72">72 days</option>
                                <option value="73">73 days</option>
                                <option value="74">74 days</option>
                                <option value="75">75 days</option>
                                <option value="76">76 days</option>
                                <option value="77">77 days</option>
                                <option value="78">78 days</option>
                                <option value="79">79 days</option>
                                <option value="80">80 days</option>
                                <option value="81">81 days</option>
                                <option value="82">82 days</option>
                                <option value="83">83 days</option>
                                <option value="84">84 days</option>
                                <option value="85">85 days</option>
                                <option value="86">86 days</option>
                                <option value="87">87 days</option>
                                <option value="88">88 days</option>
                                <option value="89">89 days</option>
                                <option value="90">90 days</option>
                                <option value="91">91 days</option>
                                <option value="92">92 days</option>
                                <option value="93">93 days</option>
                                <option value="94">94 days</option>
                                <option value="95">95 days</option>
                                <option value="96">96 days</option>
                                <option value="97">97 days</option>
                                <option value="98">98 days</option>
                                <option value="99">99 days</option>
                                <option value="100">100 days</option>
                                <option value="101">101 days</option>
                                <option value="102">102 days</option>
                                <option value="103">103 days</option>
                                <option value="104">104 days</option>
                                <option value="105">105 days</option>
                                <option value="106">106 days</option>
                                <option value="107">107 days</option>
                                <option value="108">108 days</option>
                                <option value="109">109 days</option>
                                <option value="110">110 days</option>
                                <option value="111">111 days</option>
                                <option value="112">112 days</option>
                                <option value="113">113 days</option>
                                <option value="114">114 days</option>
                                <option value="115">115 days</option>
                                <option value="116">116 days</option>
                                <option value="117">117 days</option>
                                <option value="118">118 days</option>
                                <option value="119">119 days</option>
                                <option value="120">120 days</option>
                                <option value="121">121 days</option>
                                <option value="122">122 days</option>
                                <option value="123">123 days</option>
                                <option value="124">124 days</option>
                                <option value="125">125 days</option>
                                <option value="126">126 days</option>
                                <option value="127">127 days</option>
                                <option value="128">128 days</option>
                                <option value="129">129 days</option>
                                <option value="130">130 days</option>
                                <option value="131">131 days</option>
                                <option value="132">132 days</option>
                                <option value="133">133 days</option>
                                <option value="134">134 days</option>
                                <option value="135">135 days</option>
                                <option value="136">136 days</option>
                                <option value="137">137 days</option>
                                <option value="138">138 days</option>
                                <option value="139">139 days</option>
                                <option value="140">140 days</option>
                                <option value="141">141 days</option>
                                <option value="142">142 days</option>
                                <option value="143">143 days</option>
                                <option value="144">144 days</option>
                                <option value="145">145 days</option>
                                <option value="146">146 days</option>
                                <option value="147">147 days</option>
                                <option value="148">148 days</option>
                                <option value="149">149 days</option>
                                <option value="150">150 days</option>
                                <option value="151">151 days</option>
                                <option value="152">152 days</option>
                                <option value="153">153 days</option>
                                <option value="154">154 days</option>
                                <option value="155">155 days</option>
                                <option value="156">156 days</option>
                                <option value="157">157 days</option>
                                <option value="158">158 days</option>
                                <option value="159">159 days</option>
                                <option value="160">160 days</option>
                                <option value="161">161 days</option>
                                <option value="162">162 days</option>
                                <option value="163">163 days</option>
                                <option value="164">164 days</option>
                                <option value="165">165 days</option>
                                <option value="166">166 days</option>
                                <option value="167">167 days</option>
                                <option value="168">168 days</option>
                                <option value="169">169 days</option>
                                <option value="170">170 days</option>
                                <option value="171">171 days</option>
                                <option value="172">172 days</option>
                                <option value="173">173 days</option>
                                <option value="174">174 days</option>
                                <option value="175">175 days</option>
                                <option value="176">176 days</option>
                                <option value="177">177 days</option>
                                <option value="178">178 days</option>
                                <option value="179">179 days</option>
                                <option value="180">180 days</option>
                                <option value="181">181 days</option>
                                <option value="182">182 days</option>
                                <option value="183">183 days</option>
                                <option value="184">184 days</option>
                                <option value="185">185 days</option>
                                <option value="186">186 days</option>
                                <option value="187">187 days</option>
                                <option value="188">188 days</option>
                                <option value="189">189 days</option>
                                <option value="190">190 days</option>
                                <option value="191">191 days</option>
                                <option value="192">192 days</option>
                                <option value="193">193 days</option>
                                <option value="194">194 days</option>
                                <option value="195">195 days</option>
                                <option value="196">196 days</option>
                                <option value="197">197 days</option>
                                <option value="198">198 days</option>
                                <option value="199">199 days</option>
                                <option value="200">200 days</option>
                                <option value="201">201 days</option>
                                <option value="202">202 days</option>
                                <option value="203">203 days</option>
                                <option value="204">204 days</option>
                                <option value="205">205 days</option>
                                <option value="206">206 days</option>
                                <option value="207">207 days</option>
                                <option value="208">208 days</option>
                                <option value="209">209 days</option>
                                <option value="210">210 days</option>
                                <option value="211">211 days</option>
                                <option value="212">212 days</option>
                                <option value="213">213 days</option>
                                <option value="214">214 days</option>
                                <option value="215">215 days</option>
                                <option value="216">216 days</option>
                                <option value="217">217 days</option>
                                <option value="218">218 days</option>
                                <option value="219">219 days</option>
                                <option value="220">220 days</option>
                                <option value="221">221 days</option>
                                <option value="222">222 days</option>
                                <option value="223">223 days</option>
                                <option value="224">224 days</option>
                                <option value="225">225 days</option>
                                <option value="226">226 days</option>
                                <option value="227">227 days</option>
                                <option value="228">228 days</option>
                                <option value="229">229 days</option>
                                <option value="230">230 days</option>
                                <option value="231">231 days</option>
                                <option value="232">232 days</option>
                                <option value="233">233 days</option>
                                <option value="234">234 days</option>
                                <option value="235">235 days</option>
                                <option value="236">236 days</option>
                                <option value="237">237 days</option>
                                <option value="238">238 days</option>
                                <option value="239">239 days</option>
                                <option value="240">240 days</option>
                                <option value="241">241 days</option>
                                <option value="242">242 days</option>
                                <option value="243">243 days</option>
                                <option value="244">244 days</option>
                                <option value="245">245 days</option>
                                <option value="246">246 days</option>
                                <option value="247">247 days</option>
                                <option value="248">248 days</option>
                                <option value="249">249 days</option>
                                <option value="250">250 days</option>
                                <option value="251">251 days</option>
                                <option value="252">252 days</option>
                                <option value="253">253 days</option>
                                <option value="254">254 days</option>
                                <option value="255">255 days</option>
                                <option value="256">256 days</option>
                                <option value="257">257 days</option>
                                <option value="258">258 days</option>
                                <option value="259">259 days</option>
                                <option value="260">260 days</option>
                                <option value="261">261 days</option>
                                <option value="262">262 days</option>
                                <option value="263">263 days</option>
                                <option value="264">264 days</option>
                                <option value="265">265 days</option>
                                <option value="266">266 days</option>
                                <option value="267">267 days</option>
                                <option value="268">268 days</option>
                                <option value="269">269 days</option>
                                <option value="270">270 days</option>
                                <option value="271">271 days</option>
                                <option value="272">272 days</option>
                                <option value="273">273 days</option>
                                <option value="274">274 days</option>
                                <option value="275">275 days</option>
                                <option value="276">276 days</option>
                                <option value="277">277 days</option>
                                <option value="278">278 days</option>
                                <option value="279">279 days</option>
                                <option value="280">280 days</option>
                                <option value="281">281 days</option>
                                <option value="282">282 days</option>
                                <option value="283">283 days</option>
                                <option value="284">284 days</option>
                                <option value="285">285 days</option>
                                <option value="286">286 days</option>
                                <option value="287">287 days</option>
                                <option value="288">288 days</option>
                                <option value="289">289 days</option>
                                <option value="290">290 days</option>
                                <option value="291">291 days</option>
                                <option value="292">292 days</option>
                                <option value="293">293 days</option>
                                <option value="294">294 days</option>
                                <option value="295">295 days</option>
                                <option value="296">296 days</option>
                                <option value="297">297 days</option>
                                <option value="298">298 days</option>
                                <option value="299">299 days</option>
                                <option value="300">300 days</option>
                                <option value="301">301 days</option>
                                <option value="302">302 days</option>
                                <option value="303">303 days</option>
                                <option value="304">304 days</option>
                                <option value="305">305 days</option>
                                <option value="306">306 days</option>
                                <option value="307">307 days</option>
                                <option value="308">308 days</option>
                                <option value="309">309 days</option>
                                <option value="310">310 days</option>
                                <option value="311">311 days</option>
                                <option value="312">312 days</option>
                                <option value="313">313 days</option>
                                <option value="314">314 days</option>
                                <option value="315">315 days</option>
                                <option value="316">316 days</option>
                                <option value="317">317 days</option>
                                <option value="318">318 days</option>
                                <option value="319">319 days</option>
                                <option value="320">320 days</option>
                                <option value="321">321 days</option>
                                <option value="322">322 days</option>
                                <option value="323">323 days</option>
                                <option value="324">324 days</option>
                                <option value="325">325 days</option>
                                <option value="326">326 days</option>
                                <option value="327">327 days</option>
                                <option value="328">328 days</option>
                                <option value="329">329 days</option>
                                <option value="330">330 days</option>
                                <option value="331">331 days</option>
                                <option value="332">332 days</option>
                                <option value="333">333 days</option>
                                <option value="334">334 days</option>
                                <option value="335">335 days</option>
                                <option value="336">336 days</option>
                                <option value="337">337 days</option>
                                <option value="338">338 days</option>
                                <option value="339">339 days</option>
                                <option value="340">340 days</option>
                                <option value="341">341 days</option>
                                <option value="342">342 days</option>
                                <option value="343">343 days</option>
                                <option value="344">344 days</option>
                                <option value="345">345 days</option>
                                <option value="346">346 days</option>
                                <option value="347">347 days</option>
                                <option value="348">348 days</option>
                                <option value="349">349 days</option>
                                <option value="350">350 days</option>
                                <option value="351">351 days</option>
                                <option value="352">352 days</option>
                                <option value="353">353 days</option>
                                <option value="354">354 days</option>
                                <option value="355">355 days</option>
                                <option value="356">356 days</option>
                                <option value="357">357 days</option>
                                <option value="358">358 days</option>
                                <option value="359">359 days</option>
                                <option value="360">360 days</option>
                            </select>
                    </div>
                   
                    <div class="col-xs-1">
                        <span class="input-group-btn">
                          <button type="submit" class="btn bg-olive btn-flat">Search!</button>
                        </span>

                        <span class="input-group-btn">
                          <button type="button" class="btn bg-purple  btn-flat" onClick="parent.location='https://x.loandisk.com/loans/view_loans_past_maturity_date_branch.php'">Reset!</button>
                        </span>
                    </div>
                  </div>
                </div><!-- /.box-body -->
            </form>
</div>
                <div class="box-body">

                        <!-- Table -->
                    <table id="datatable" class="table table-striped table-bordered datatable-buttons">
                            <thead ><!-- Table head -->
                            <tr>
                         
                                <th class="active">Name</th>
                                <th class="active">Loan#</th>
                                <th class="active">Principal</th>
                                <th class="active">Released</th>
                                <th class="active">Maturity</th>
                                <th class="active">Interest % </th>                              
                                <th class="active">Due</th>
                                <th class="active">Paid</th>
                                <th class="active">Balance</th>
                                
                                <th class="active">Status</th>
 								<th class="active">Actions</th>
                            </tr>
                            </thead><!-- / Table head -->
                            <tbody><!-- / Table body -->
                            <?php   
                  			 $loan_info = $this->db->get('tbl_loan')->result();
                        	?>
                            <?php $counter =1 ; ?>
                            <?php if (!empty($loan_info)): foreach ($loan_info as $v_loan) : ?>
                            <?php 
                                    $loan_details = $this->db->get_where('tbl_loan_details',array('loan_id'=>$v_loan->loan_id))->result();
                                     foreach ($loan_details as $v_details) {
                                      $repayments=$v_details->loan_num_of_repayments;
                                     }
                                      //date calculations
                                    
                                  	$release_date=date_create($v_loan->loan_release_date);
								  	$maturity_date=date_create($v_loan->maturity_date);
								  	$diff=date_diff($release_date,$maturity_date);
                                  	$loan_total_days=$diff->format("%a");
                                  	$date_interval=round(($loan_total_days)/$repayments);
                                  	
                                    $loan_next_date=date_add($release_date, date_interval_create_from_date_string("{$date_interval} days"));
    								//next repayment date
        							$next_maturity_date = date_format($loan_next_date, "Y-m-d");
                            ?>
                                <?php if(date('Y-m-d')>=$v_loan->maturity_date && $v_loan->paid_amount<$v_loan->balance_amount ){ 
                                    $loan_status='Past Maturity'
                                	?>
                                <tr class="custom-tr">  
                                    <td class="vertical-td">
                                <?php  
                                $customer = $this->db->get_where('tbl_customer',array('customer_id'=>$v_loan->customer_id))->result();
                                     foreach ($customer as $v_customer) {
                                      $name=$v_customer->title.' '.$v_customer->first_name.' '.$v_customer->second_name.' '.$v_customer->last_name;
                                     }
                                       echo $name;
                                 ?>
                                    </td>
                                    <td class="vertical-td"><?php echo $v_loan->loan_number ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->principal_amount) ?></td>
                                    <td class="vertical-td"><?php echo $v_loan->loan_release_date ?></td>
                                    <td class="vertical-td"><?php echo $v_loan->maturity_date ?></td>                                                                        
                                    <td class="vertical-td"><?php echo $v_loan->loan_interest_percent.'%'.'/'. $v_loan->loan_interest_period_scheme ?></td>                                                                       
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->amount_due) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->paid_amount) ?></td>
                                    <td class="vertical-td"><?php echo $this->localization->currency($v_loan->balance_amount) ?></td>
                                    <td class="vertical-td"><span class="label label-danger"><?php echo $loan_status ?></span></td>
                                    <td class="vertical-td">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().'admin/loan/edit_loan/'. $v_loan->loan_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-pencil"></i></a>
                                             <a href="<?php echo base_url().'admin/loan/view_loan/'. $v_loan->loan_id ?>" class="btn btn-xs btn-default" ><i class="fa fa-search"></i></a>               
                                        </div>
                                    </td>

                                </tr>
                                <?php } ?>
                            <?php
                                $counter++;
                            endforeach;
                            ?><!--get all sub category if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                                <td colspan="7">
                                    <strong>There is no record for display</strong>
                                </td><!--/ get error message if this empty-->
                            <?php endif; ?>
                            </tbody><!-- / Table body -->
                        </table> <!-- / Table -->

                </div><!-- /.box-body -->
							
	                       

                                    <!-- customer id -->
                                    <?php if (!empty($customer_info->customer_id)) {?>
                                        <input type="hidden"  name="customer_id" id="customer_id"
                                               value="<?php echo $customer_info->customer_id ?>">
                                    <?php }  ?>
                                    
                                                     
							</div>
						</div>
					</div>
			
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

<script>
   $('body').on('hidden.bs.modal', '.modal', function() {
       $(this).removeData('bs.modal');
   });

   $(document).ready(function() {

       $('.box-body').css({"border-top":"0px solid #ccc"});

       $("#customer").select2({
           placeholder: "Select a State",
           allowClear: true
       });

       $("#visit").select2({
           placeholder: "Select a State",
           allowClear: true
       });

   });
   
</script>
<!--    Image Validation Check    -->
<script type="text/javascript"></script>