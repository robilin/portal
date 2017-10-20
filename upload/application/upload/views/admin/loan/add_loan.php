<script src="<?php echo base_url(); ?>loan/js/ajax.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>loan/js/app.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>loan/js/add_edit_loan_new.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>loan/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<link href="<?php echo base_url(); ?>loan/css/jquery.tagit.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>loan/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url(); ?>loan/js/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
<!-- View massage -->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<?php $info = $this->session->userdata('business_info'); ?>
<section class="content">
   <div class="row">
      <div class="col-md-12">
         <div class="box box-primary">
            <div class="box-header box-header-background with-border">
               <h3 class="box-title "><?php echo $title?>, Borrower: <b> <?php if(!empty($customer_info)) {echo $customer_info->title.' '.$customer_info->first_name.' '.$customer_info->second_name.' '.$customer_info->last_name;}
               ?></b></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="addloanForm" onsubmit="return imageForm(this)"
               action="<?php echo base_url(); ?>admin/loan/save_loan/<?php if (!empty($loan_info)) {
                  echo $loan_info->loan_id;
                  } ?>" method="post">
               <br/><br/>
               <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                  <li class="<?php if(empty($tab)){ echo 'active';} ?>"><a href="#general" data-toggle="tab">General Info</a></li>
                  <li class="<?php
                     if(!empty($tab)){
                         echo $tab == 'price'?'active':'';
                     }
                     ?>">
                     <a href="#price" data-toggle="tab">Loan Release Date & Interest</a>
                  </li>
                  <li><a href="#inventory" data-toggle="tab">Duration & Repayments</a></li>
                  <li class="<?php
                     if(!empty($tab)){
                         echo $tab == 'attribute'?'active':'';
                     }
                     ?>">
                     <a href="#attribute" data-toggle="tab">Loan Status,Image & File</a>
                  </li>
               </ul>
               <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                     <div id="my-tab-content" class="tab-content">
                        <!-- ***************  General Tab Start ****************** -->
                        <div class="tab-pane <?php if(empty($tab)){ echo 'active';} ?>" id="general">
                           <!-- /.loan Code -->
                           <div class="form-group">
                              <label>Loan number <span class="required">*</span></label>
                              <input type="text"  name="loan_number" onchange="check_loan_code(this.value)" required
                                 value="<?php if (!empty($loan_info->loan_number)) {echo $loan_info->loan_number; }
                                    else{echo $loan_number;}
                                    ?>"
                                 class="form-control">
                              <div class="required" id="loan_code_result"></div>
                           </div>
                           <!-- /.loan Name -->
                           <div class="form-group">
                              <label>Loan Product <span class="required">*</span></label>
                              <select class="form-control" name="loan_product" id="inputLoanType">
                                 <option value="Business Loan">Business Loan</option>
                                 <option value="Pensioner Loan">Pensioner Loan</option>
                                 <option value="Personal Loan">Personal Loan</option>
                                 <option value="Student Loan">Student Loan</option>
                              </select>
                           </div>
                           <!-- /.loan Note -->
                           <div class="form-group">
                              <label>Disbursed by<span class="required">*</span></label>
                              <select class="form-control" name="loan_disbursed_by" id="inputDisbursedBy" required>
                                 <option value="Cash" >Cash</option>
                                 <option value="Mobile Money" >Online Transfer</option>
                                 <option value="Cheque" >Cheque</option>
                                 <option value="Wire Transfer" >Wire Transfer</option>
                              </select>
                           </div>
                           <!-- /.Amount -->
                           <div class="form-group">
                              <label>Principal Amount<span class="required">*</span></label>
                              <input type="number"  name="principal_amount" required
                                 value="<?php if (!empty($loan_info->principal_amount)) {echo $loan_info->principal_amount; }
                                    ?>"
                                 class="form-control" id="inputLoanPrincipalAmount" placeholder="Principal Amount"  onkeypress="return isDecimalKey(this,event)">
                           </div>
                           <!-- /.box-body -->
                        </div>
                        <!-- ************* General Tab End ********************** -->
                        <!-- ************* General Price Tab Start ************** -->
                        <!-- /.Price Tab Start -->
                        <div class="tab-pane
                           <?php
                              if(!empty($tab)){
                                  echo $tab == 'price'?'active':'';
                              }
                              ?>
                           " id="price">
                           <!-- /.General Price Start -->
                           <h5>Loan Release Date & Interest</h5>
                           <div class="box">
                              <div class="box-body">
                                 <!-- /.Release date -->
                                 
                                    <div class="form-group form-group-bottom">
                                                <label>Loan Release Date</label>
                                                </div>
                                                <div class="input-group">
                                                <input type="text" placeholder="Loan release date"
                                                       value="<?php
                                                       if (!empty($loan_info->loan_release_date)) {
                                                       	   $loan_release_date = date('Y/m/d', strtotime($loan_info->loan_release_date));
                                                          echo  $loan_release_date;
                                                       }
                                                       ?>" class="form-control datepicker" id="loan_release_date" name="loan_release_date" data-format="yyyy/mm/dd">
                                                       <div class="input-group-addon">
                                                    <a href="#"><i class="entypo-calendar"></i></a>
                                                </div>
                                            </div>
                                 <!-- /.date relesed -->
                                 <!-- /.Category -->
                                 <div class="form-group">
                                    <label>Interest Method</label>
                                    <select name="loan_interest_method" class="form-control col-sm-5" id="inputLoanInterestMethod" onChange="enableDisableFirstReapymentAmount();">
                                       <option value="flat_rate">Flat Rate</option>                                       
                                       <option value="compound_interest" >Compound Interest</option>
                                    </select>
                                 </div>
                                  <div class="form-group" id="compound_interest" >
                                    <label>Compound Interval/Frequency</label>
                                    <select name="compound_interval" class="form-control col-sm-5" id="compound_interest">
                                       <option value="daily">Daily</option>
                                       <option value="weekly">Weekly</option>
                                       <option value="monthly">Monthly</option>
                                       <option value="quarterly" >Quarterly</option>
                                       <option value="half_yearly" >Half yearly</option>
                                       <option value="yearly" >Yearly</option>
                                    </select>
                                 </div>
                                 <!-- /.location -->
                                 <div class="form-group form-group-bottom">
                                    <div class="input-group">
                                       <div class="row">
                                          <div class="col-sm-6">
                                             <label>Loan Interest %</label>
                                             <input type="text" placeholder="%"
                                                value="<?php
                                                   if (!empty($loan_info->loan_interest_percent)) {
                                                   	  
                                                      echo $loan_info->loan_interest_percent;
                                                   }
                                                   ?>" class="form-control" id="loan_date" name="loan_interest_percent" onkeypress="return isInterestKey(this,event)">
                                          </div>
                                          <div class="col-sm-6">
                                             <label>&nbsp;</label>
                                             <select name="loan_interest_period_scheme" class="form-control col-sm-5" id="inputInterestPeriod" onChange="check();">
                                                <option value="Day" >Per day</option>
                                                <option value="Week" >Per week</option>
                                                <option value="Month" >Per month</option>
                                                <option value="Year" >Per year</option>
                                             </select>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- /.box-body -->
                           </div>
                           <!-- /.box -->
                           <!-- /.General Price End -->
                           <!-- ************* loan Tier Price Start *********** -->
                           <!-- /.Custom fields -->
                           <!-- /.Tier Price End -->
                        </div>
                        <!-- /.Price Tab End -->
                        <!-- ************* loan loan Start ********** -->
                        <!-- /.loan Tab Start -->
                        <div class="tab-pane
                           <?php
                              if(!empty($tab)){
                                  echo $tab == 'inventory'?'active':'';
                              }
                              ?>
                           " id="inventory">
                           <!-- /.loan Tab Start 
                              <div class="tab-panel" id="warranty"> -->
                           <!-- /.loan loan Start -->
                           <h5>Duration & Repayments</h5>
                           <div class="box">
                              <div class="box-body">
                                 <!-- /.warranty starts -->
                                 <div class="input-group">
                                    <div class="row">
                                       <div class="col-sm-6">
                                          <label>Loan Duration</label>
                                          <select class="form-control" name="loan_duration" id="inputLoanDuration" onChange="setNumofRep();">
                                             <option value="1" >1</option>
                                             <option value="2" >2</option>
                                             <option value="3" >3</option>
                                             <option value="4" >4</option>
                                             <option value="5" >5</option>
                                             <option value="6" >6</option>
                                             <option value="7" >7</option>
                                             <option value="8" >8</option>
                                             <option value="9" >9</option>
                                             <option value="10" >10</option>
                                             <option value="11" >11</option>
                                             <option value="12" >12</option>
                                             <option value="13" >13</option>
                                             <option value="14" >14</option>
                                             <option value="15" >15</option>
                                             <option value="16" >16</option>
                                             <option value="17" >17</option>
                                             <option value="18" >18</option>
                                             <option value="19" >19</option>
                                             <option value="20" >20</option>
                                             <option value="21" >21</option>
                                             <option value="22" >22</option>
                                             <option value="23" >23</option>
                                             <option value="24" >24</option>
                                             <option value="25" >25</option>
                                             <option value="26" >26</option>
                                             <option value="27" >27</option>
                                             <option value="28" >28</option>
                                             <option value="29" >29</option>
                                             <option value="30" >30</option>
                                             <option value="31" >31</option>
                                             <option value="32" >32</option>
                                             <option value="33" >33</option>
                                             <option value="34" >34</option>
                                             <option value="35" >35</option>
                                             <option value="36" >36</option>
                                             <option value="37" >37</option>
                                             <option value="38" >38</option>
                                             <option value="39" >39</option>
                                             <option value="40" >40</option>
                                             <option value="41" >41</option>
                                             <option value="42" >42</option>
                                             <option value="43" >43</option>
                                             <option value="44" >44</option>
                                             <option value="45" >45</option>
                                             <option value="46" >46</option>
                                             <option value="47" >47</option>
                                             <option value="48" >48</option>
                                             <option value="49" >49</option>
                                             <option value="50" >50</option>
                                             <option value="51" >51</option>
                                             <option value="52" >52</option>
                                             <option value="53" >53</option>
                                             <option value="54" >54</option>
                                             <option value="55" >55</option>
                                             <option value="56" >56</option>
                                             <option value="57" >57</option>
                                             <option value="58" >58</option>
                                             <option value="59" >59</option>
                                             <option value="60" >60</option>
                                             <option value="61" >61</option>
                                             <option value="62" >62</option>
                                             <option value="63" >63</option>
                                             <option value="64" >64</option>
                                             <option value="65" >65</option>
                                             <option value="66" >66</option>
                                             <option value="67" >67</option>
                                             <option value="68" >68</option>
                                             <option value="69" >69</option>
                                             <option value="70" >70</option>
                                             <option value="71" >71</option>
                                             <option value="72" >72</option>
                                             <option value="73" >73</option>
                                             <option value="74" >74</option>
                                             <option value="75" >75</option>
                                             <option value="76" >76</option>
                                             <option value="77" >77</option>
                                             <option value="78" >78</option>
                                             <option value="79" >79</option>
                                             <option value="80" >80</option>
                                             <option value="81" >81</option>
                                             <option value="82" >82</option>
                                             <option value="83" >83</option>
                                             <option value="84" >84</option>
                                             <option value="85" >85</option>
                                             <option value="86" >86</option>
                                             <option value="87" >87</option>
                                             <option value="88" >88</option>
                                             <option value="89" >89</option>
                                             <option value="90" >90</option>
                                             <option value="91" >91</option>
                                             <option value="92" >92</option>
                                             <option value="93" >93</option>
                                             <option value="94" >94</option>
                                             <option value="95" >95</option>
                                             <option value="96" >96</option>
                                             <option value="97" >97</option>
                                             <option value="98" >98</option>
                                             <option value="99" >99</option>
                                             <option value="100" >100</option>
                                             <option value="101" >101</option>
                                             <option value="102" >102</option>
                                             <option value="103" >103</option>
                                             <option value="104" >104</option>
                                             <option value="105" >105</option>
                                             <option value="106" >106</option>
                                             <option value="107" >107</option>
                                             <option value="108" >108</option>
                                             <option value="109" >109</option>
                                             <option value="110" >110</option>
                                             <option value="111" >111</option>
                                             <option value="112" >112</option>
                                             <option value="113" >113</option>
                                             <option value="114" >114</option>
                                             <option value="115" >115</option>
                                             <option value="116" >116</option>
                                             <option value="117" >117</option>
                                             <option value="118" >118</option>
                                             <option value="119" >119</option>
                                             <option value="120" >120</option>
                                             <option value="121" >121</option>
                                             <option value="122" >122</option>
                                             <option value="123" >123</option>
                                             <option value="124" >124</option>
                                             <option value="125" >125</option>
                                             <option value="126" >126</option>
                                             <option value="127" >127</option>
                                             <option value="128" >128</option>
                                             <option value="129" >129</option>
                                             <option value="130" >130</option>
                                             <option value="131" >131</option>
                                             <option value="132" >132</option>
                                             <option value="133" >133</option>
                                             <option value="134" >134</option>
                                             <option value="135" >135</option>
                                             <option value="136" >136</option>
                                             <option value="137" >137</option>
                                             <option value="138" >138</option>
                                             <option value="139" >139</option>
                                             <option value="140" >140</option>
                                             <option value="141" >141</option>
                                             <option value="142" >142</option>
                                             <option value="143" >143</option>
                                             <option value="144" >144</option>
                                             <option value="145" >145</option>
                                             <option value="146" >146</option>
                                             <option value="147" >147</option>
                                             <option value="148" >148</option>
                                             <option value="149" >149</option>
                                             <option value="150" >150</option>
                                             <option value="151" >151</option>
                                             <option value="152" >152</option>
                                             <option value="153" >153</option>
                                             <option value="154" >154</option>
                                             <option value="155" >155</option>
                                             <option value="156" >156</option>
                                             <option value="157" >157</option>
                                             <option value="158" >158</option>
                                             <option value="159" >159</option>
                                             <option value="160" >160</option>
                                             <option value="161" >161</option>
                                             <option value="162" >162</option>
                                             <option value="163" >163</option>
                                             <option value="164" >164</option>
                                             <option value="165" >165</option>
                                             <option value="166" >166</option>
                                             <option value="167" >167</option>
                                             <option value="168" >168</option>
                                             <option value="169" >169</option>
                                             <option value="170" >170</option>
                                             <option value="171" >171</option>
                                             <option value="172" >172</option>
                                             <option value="173" >173</option>
                                             <option value="174" >174</option>
                                             <option value="175" >175</option>
                                             <option value="176" >176</option>
                                             <option value="177" >177</option>
                                             <option value="178" >178</option>
                                             <option value="179" >179</option>
                                             <option value="180" >180</option>
                                             <option value="181" >181</option>
                                             <option value="182" >182</option>
                                             <option value="183" >183</option>
                                             <option value="184" >184</option>
                                             <option value="185" >185</option>
                                             <option value="186" >186</option>
                                             <option value="187" >187</option>
                                             <option value="188" >188</option>
                                             <option value="189" >189</option>
                                             <option value="190" >190</option>
                                             <option value="191" >191</option>
                                             <option value="192" >192</option>
                                             <option value="193" >193</option>
                                             <option value="194" >194</option>
                                             <option value="195" >195</option>
                                             <option value="196" >196</option>
                                             <option value="197" >197</option>
                                             <option value="198" >198</option>
                                             <option value="199" >199</option>
                                             <option value="200" >200</option>
                                             <option value="201" >201</option>
                                             <option value="202" >202</option>
                                             <option value="203" >203</option>
                                             <option value="204" >204</option>
                                             <option value="205" >205</option>
                                             <option value="206" >206</option>
                                             <option value="207" >207</option>
                                             <option value="208" >208</option>
                                             <option value="209" >209</option>
                                             <option value="210" >210</option>
                                             <option value="211" >211</option>
                                             <option value="212" >212</option>
                                             <option value="213" >213</option>
                                             <option value="214" >214</option>
                                             <option value="215" >215</option>
                                             <option value="216" >216</option>
                                             <option value="217" >217</option>
                                             <option value="218" >218</option>
                                             <option value="219" >219</option>
                                             <option value="220" >220</option>
                                             <option value="221" >221</option>
                                             <option value="222" >222</option>
                                             <option value="223" >223</option>
                                             <option value="224" >224</option>
                                             <option value="225" >225</option>
                                             <option value="226" >226</option>
                                             <option value="227" >227</option>
                                             <option value="228" >228</option>
                                             <option value="229" >229</option>
                                             <option value="230" >230</option>
                                             <option value="231" >231</option>
                                             <option value="232" >232</option>
                                             <option value="233" >233</option>
                                             <option value="234" >234</option>
                                             <option value="235" >235</option>
                                             <option value="236" >236</option>
                                             <option value="237" >237</option>
                                             <option value="238" >238</option>
                                             <option value="239" >239</option>
                                             <option value="240" >240</option>
                                             <option value="241" >241</option>
                                             <option value="242" >242</option>
                                             <option value="243" >243</option>
                                             <option value="244" >244</option>
                                             <option value="245" >245</option>
                                             <option value="246" >246</option>
                                             <option value="247" >247</option>
                                             <option value="248" >248</option>
                                             <option value="249" >249</option>
                                             <option value="250" >250</option>
                                             <option value="251" >251</option>
                                             <option value="252" >252</option>
                                             <option value="253" >253</option>
                                             <option value="254" >254</option>
                                             <option value="255" >255</option>
                                             <option value="256" >256</option>
                                             <option value="257" >257</option>
                                             <option value="258" >258</option>
                                             <option value="259" >259</option>
                                             <option value="260" >260</option>
                                             <option value="261" >261</option>
                                             <option value="262" >262</option>
                                             <option value="263" >263</option>
                                             <option value="264" >264</option>
                                             <option value="265" >265</option>
                                             <option value="266" >266</option>
                                             <option value="267" >267</option>
                                             <option value="268" >268</option>
                                             <option value="269" >269</option>
                                             <option value="270" >270</option>
                                             <option value="271" >271</option>
                                             <option value="272" >272</option>
                                             <option value="273" >273</option>
                                             <option value="274" >274</option>
                                             <option value="275" >275</option>
                                             <option value="276" >276</option>
                                             <option value="277" >277</option>
                                             <option value="278" >278</option>
                                             <option value="279" >279</option>
                                             <option value="280" >280</option>
                                             <option value="281" >281</option>
                                             <option value="282" >282</option>
                                             <option value="283" >283</option>
                                             <option value="284" >284</option>
                                             <option value="285" >285</option>
                                             <option value="286" >286</option>
                                             <option value="287" >287</option>
                                             <option value="288" >288</option>
                                             <option value="289" >289</option>
                                             <option value="290" >290</option>
                                             <option value="291" >291</option>
                                             <option value="292" >292</option>
                                             <option value="293" >293</option>
                                             <option value="294" >294</option>
                                             <option value="295" >295</option>
                                             <option value="296" >296</option>
                                             <option value="297" >297</option>
                                             <option value="298" >298</option>
                                             <option value="299" >299</option>
                                             <option value="300" >300</option>
                                             <option value="301" >301</option>
                                             <option value="302" >302</option>
                                             <option value="303" >303</option>
                                             <option value="304" >304</option>
                                             <option value="305" >305</option>
                                             <option value="306" >306</option>
                                             <option value="307" >307</option>
                                             <option value="308" >308</option>
                                             <option value="309" >309</option>
                                             <option value="310" >310</option>
                                             <option value="311" >311</option>
                                             <option value="312" >312</option>
                                             <option value="313" >313</option>
                                             <option value="314" >314</option>
                                             <option value="315" >315</option>
                                             <option value="316" >316</option>
                                             <option value="317" >317</option>
                                             <option value="318" >318</option>
                                             <option value="319" >319</option>
                                             <option value="320" >320</option>
                                             <option value="321" >321</option>
                                             <option value="322" >322</option>
                                             <option value="323" >323</option>
                                             <option value="324" >324</option>
                                             <option value="325" >325</option>
                                             <option value="326" >326</option>
                                             <option value="327" >327</option>
                                             <option value="328" >328</option>
                                             <option value="329" >329</option>
                                             <option value="330" >330</option>
                                             <option value="331" >331</option>
                                             <option value="332" >332</option>
                                             <option value="333" >333</option>
                                             <option value="334" >334</option>
                                             <option value="335" >335</option>
                                             <option value="336" >336</option>
                                             <option value="337" >337</option>
                                             <option value="338" >338</option>
                                             <option value="339" >339</option>
                                             <option value="340" >340</option>
                                             <option value="341" >341</option>
                                             <option value="342" >342</option>
                                             <option value="343" >343</option>
                                             <option value="344" >344</option>
                                             <option value="345" >345</option>
                                             <option value="346" >346</option>
                                             <option value="347" >347</option>
                                             <option value="348" >348</option>
                                             <option value="349" >349</option>
                                             <option value="350" >350</option>
                                             <option value="351" >351</option>
                                             <option value="352" >352</option>
                                             <option value="353" >353</option>
                                             <option value="354" >354</option>
                                             <option value="355" >355</option>
                                             <option value="356" >356</option>
                                             <option value="357" >357</option>
                                             <option value="358" >358</option>
                                             <option value="359" >359</option>
                                             <option value="360" >360</option>
                                             <option value="361" >361</option>
                                             <option value="362" >362</option>
                                             <option value="363" >363</option>
                                             <option value="364" >364</option>
                                             <option value="365" >365</option>
                                          </select>
                                       </div>
                                       <div class="col-sm-6">
                                          <label>&nbsp;</label>
                                          <select required name="loan_duration_scheme" class="form-control col-sm-5" id="inputLoanDurationPeriod" onChange="setNumofRep();">
                                             <option value="" ></option>
                                             <option value="days" >Days</option>
                                             <option value="weeks" >Weeks</option>
                                             <option value="months" >Months</option>
                                             <option value="years" >Years</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- /.warranty ends -->
                                 <div class="form-group form-group-bottom">
                                    <label>Repayment Cycle</label>
                                 </div>
                                 <div class="input-group">
                                    <select class="form-control" name="loan_repayment_cycle" id="inputLoanPaymentSchemeId" required onChange="disableNumRepayments(); setNumofRep();">
                                       <option value=""></option>
                                       <option value="Daily" >Daily</option>
                                       <option value="Weekly" >Weekly</option>
                                       <option value="Biweekly" >Biweekly</option>
                                       <option value="Monthly" >Monthly</option>
                                       <option value="Bimonthly" >Bimonthly</option>
                                       <option value="Quarterly" >Quarterly</option>
                                       <option value="Semi-Annual" >Semi-Annual</option>
                                       <option value="Yearly" >Yearly</option>
                                       <option value="Lump-Sum" >Lump-Sum</option>
                                    </select>
                                    <div class="input-group-addon">
                                       <a href="#"><i class="entypo-calendar"></i></a>
                                    </div>
                                 </div>
                                 <!-- /.Purchase price-->
                                 <div class="form-group" style="display: none">
                                    <label>Number Of Repayments </label>
                                    <select class="form-control" name="loan_num_of_repayments" id="inputLoanNumOfRepayments" required onChange="removeNumRepaymentsMessage()">
                                       <option value="1" >1</option>
                                       <option value="2" >2</option>
                                       <option value="3" >3</option>
                                       <option value="4" >4</option>
                                       <option value="5" >5</option>
                                       <option value="6" >6</option>
                                       <option value="7" >7</option>
                                       <option value="8" >8</option>
                                       <option value="9" >9</option>
                                       <option value="10" >10</option>
                                       <option value="11" >11</option>
                                       <option value="12" >12</option>
                                       <option value="13" >13</option>
                                       <option value="14" >14</option>
                                       <option value="15" >15</option>
                                       <option value="16" >16</option>
                                       <option value="17" >17</option>
                                       <option value="18" >18</option>
                                       <option value="19" >19</option>
                                       <option value="20" >20</option>
                                       <option value="21" >21</option>
                                       <option value="22" >22</option>
                                       <option value="23" >23</option>
                                       <option value="24" >24</option>
                                       <option value="25" >25</option>
                                       <option value="26" >26</option>
                                       <option value="27" >27</option>
                                       <option value="28" >28</option>
                                       <option value="29" >29</option>
                                       <option value="30" >30</option>
                                       <option value="31" >31</option>
                                       <option value="32" >32</option>
                                       <option value="33" >33</option>
                                       <option value="34" >34</option>
                                       <option value="35" >35</option>
                                       <option value="36" >36</option>
                                       <option value="37" >37</option>
                                       <option value="38" >38</option>
                                       <option value="39" >39</option>
                                       <option value="40" >40</option>
                                       <option value="41" >41</option>
                                       <option value="42" >42</option>
                                       <option value="43" >43</option>
                                       <option value="44" >44</option>
                                       <option value="45" >45</option>
                                       <option value="46" >46</option>
                                       <option value="47" >47</option>
                                       <option value="48" >48</option>
                                       <option value="49" >49</option>
                                       <option value="50" >50</option>
                                       <option value="51" >51</option>
                                       <option value="52" >52</option>
                                       <option value="53" >53</option>
                                       <option value="54" >54</option>
                                       <option value="55" >55</option>
                                       <option value="56" >56</option>
                                       <option value="57" >57</option>
                                       <option value="58" >58</option>
                                       <option value="59" >59</option>
                                       <option value="60" >60</option>
                                       <option value="61" >61</option>
                                       <option value="62" >62</option>
                                       <option value="63" >63</option>
                                       <option value="64" >64</option>
                                       <option value="65" >65</option>
                                       <option value="66" >66</option>
                                       <option value="67" >67</option>
                                       <option value="68" >68</option>
                                       <option value="69" >69</option>
                                       <option value="70" >70</option>
                                       <option value="71" >71</option>
                                       <option value="72" >72</option>
                                       <option value="73" >73</option>
                                       <option value="74" >74</option>
                                       <option value="75" >75</option>
                                       <option value="76" >76</option>
                                       <option value="77" >77</option>
                                       <option value="78" >78</option>
                                       <option value="79" >79</option>
                                       <option value="80" >80</option>
                                       <option value="81" >81</option>
                                       <option value="82" >82</option>
                                       <option value="83" >83</option>
                                       <option value="84" >84</option>
                                       <option value="85" >85</option>
                                       <option value="86" >86</option>
                                       <option value="87" >87</option>
                                       <option value="88" >88</option>
                                       <option value="89" >89</option>
                                       <option value="90" >90</option>
                                       <option value="91" >91</option>
                                       <option value="92" >92</option>
                                       <option value="93" >93</option>
                                       <option value="94" >94</option>
                                       <option value="95" >95</option>
                                       <option value="96" >96</option>
                                       <option value="97" >97</option>
                                       <option value="98" >98</option>
                                       <option value="99" >99</option>
                                       <option value="100" >100</option>
                                       <option value="101" >101</option>
                                       <option value="102" >102</option>
                                       <option value="103" >103</option>
                                       <option value="104" >104</option>
                                       <option value="105" >105</option>
                                       <option value="106" >106</option>
                                       <option value="107" >107</option>
                                       <option value="108" >108</option>
                                       <option value="109" >109</option>
                                       <option value="110" >110</option>
                                       <option value="111" >111</option>
                                       <option value="112" >112</option>
                                       <option value="113" >113</option>
                                       <option value="114" >114</option>
                                       <option value="115" >115</option>
                                       <option value="116" >116</option>
                                       <option value="117" >117</option>
                                       <option value="118" >118</option>
                                       <option value="119" >119</option>
                                       <option value="120" >120</option>
                                       <option value="121" >121</option>
                                       <option value="122" >122</option>
                                       <option value="123" >123</option>
                                       <option value="124" >124</option>
                                       <option value="125" >125</option>
                                       <option value="126" >126</option>
                                       <option value="127" >127</option>
                                       <option value="128" >128</option>
                                       <option value="129" >129</option>
                                       <option value="130" >130</option>
                                       <option value="131" >131</option>
                                       <option value="132" >132</option>
                                       <option value="133" >133</option>
                                       <option value="134" >134</option>
                                       <option value="135" >135</option>
                                       <option value="136" >136</option>
                                       <option value="137" >137</option>
                                       <option value="138" >138</option>
                                       <option value="139" >139</option>
                                       <option value="140" >140</option>
                                       <option value="141" >141</option>
                                       <option value="142" >142</option>
                                       <option value="143" >143</option>
                                       <option value="144" >144</option>
                                       <option value="145" >145</option>
                                       <option value="146" >146</option>
                                       <option value="147" >147</option>
                                       <option value="148" >148</option>
                                       <option value="149" >149</option>
                                       <option value="150" >150</option>
                                       <option value="151" >151</option>
                                       <option value="152" >152</option>
                                       <option value="153" >153</option>
                                       <option value="154" >154</option>
                                       <option value="155" >155</option>
                                       <option value="156" >156</option>
                                       <option value="157" >157</option>
                                       <option value="158" >158</option>
                                       <option value="159" >159</option>
                                       <option value="160" >160</option>
                                       <option value="161" >161</option>
                                       <option value="162" >162</option>
                                       <option value="163" >163</option>
                                       <option value="164" >164</option>
                                       <option value="165" >165</option>
                                       <option value="166" >166</option>
                                       <option value="167" >167</option>
                                       <option value="168" >168</option>
                                       <option value="169" >169</option>
                                       <option value="170" >170</option>
                                       <option value="171" >171</option>
                                       <option value="172" >172</option>
                                       <option value="173" >173</option>
                                       <option value="174" >174</option>
                                       <option value="175" >175</option>
                                       <option value="176" >176</option>
                                       <option value="177" >177</option>
                                       <option value="178" >178</option>
                                       <option value="179" >179</option>
                                       <option value="180" >180</option>
                                       <option value="181" >181</option>
                                       <option value="182" >182</option>
                                       <option value="183" >183</option>
                                       <option value="184" >184</option>
                                       <option value="185" >185</option>
                                       <option value="186" >186</option>
                                       <option value="187" >187</option>
                                       <option value="188" >188</option>
                                       <option value="189" >189</option>
                                       <option value="190" >190</option>
                                       <option value="191" >191</option>
                                       <option value="192" >192</option>
                                       <option value="193" >193</option>
                                       <option value="194" >194</option>
                                       <option value="195" >195</option>
                                       <option value="196" >196</option>
                                       <option value="197" >197</option>
                                       <option value="198" >198</option>
                                       <option value="199" >199</option>
                                       <option value="200" >200</option>
                                       <option value="201" >201</option>
                                       <option value="202" >202</option>
                                       <option value="203" >203</option>
                                       <option value="204" >204</option>
                                       <option value="205" >205</option>
                                       <option value="206" >206</option>
                                       <option value="207" >207</option>
                                       <option value="208" >208</option>
                                       <option value="209" >209</option>
                                       <option value="210" >210</option>
                                       <option value="211" >211</option>
                                       <option value="212" >212</option>
                                       <option value="213" >213</option>
                                       <option value="214" >214</option>
                                       <option value="215" >215</option>
                                       <option value="216" >216</option>
                                       <option value="217" >217</option>
                                       <option value="218" >218</option>
                                       <option value="219" >219</option>
                                       <option value="220" >220</option>
                                       <option value="221" >221</option>
                                       <option value="222" >222</option>
                                       <option value="223" >223</option>
                                       <option value="224" >224</option>
                                       <option value="225" >225</option>
                                       <option value="226" >226</option>
                                       <option value="227" >227</option>
                                       <option value="228" >228</option>
                                       <option value="229" >229</option>
                                       <option value="230" >230</option>
                                       <option value="231" >231</option>
                                       <option value="232" >232</option>
                                       <option value="233" >233</option>
                                       <option value="234" >234</option>
                                       <option value="235" >235</option>
                                       <option value="236" >236</option>
                                       <option value="237" >237</option>
                                       <option value="238" >238</option>
                                       <option value="239" >239</option>
                                       <option value="240" >240</option>
                                       <option value="241" >241</option>
                                       <option value="242" >242</option>
                                       <option value="243" >243</option>
                                       <option value="244" >244</option>
                                       <option value="245" >245</option>
                                       <option value="246" >246</option>
                                       <option value="247" >247</option>
                                       <option value="248" >248</option>
                                       <option value="249" >249</option>
                                       <option value="250" >250</option>
                                       <option value="251" >251</option>
                                       <option value="252" >252</option>
                                       <option value="253" >253</option>
                                       <option value="254" >254</option>
                                       <option value="255" >255</option>
                                       <option value="256" >256</option>
                                       <option value="257" >257</option>
                                       <option value="258" >258</option>
                                       <option value="259" >259</option>
                                       <option value="260" >260</option>
                                       <option value="261" >261</option>
                                       <option value="262" >262</option>
                                       <option value="263" >263</option>
                                       <option value="264" >264</option>
                                       <option value="265" >265</option>
                                       <option value="266" >266</option>
                                       <option value="267" >267</option>
                                       <option value="268" >268</option>
                                       <option value="269" >269</option>
                                       <option value="270" >270</option>
                                       <option value="271" >271</option>
                                       <option value="272" >272</option>
                                       <option value="273" >273</option>
                                       <option value="274" >274</option>
                                       <option value="275" >275</option>
                                       <option value="276" >276</option>
                                       <option value="277" >277</option>
                                       <option value="278" >278</option>
                                       <option value="279" >279</option>
                                       <option value="280" >280</option>
                                       <option value="281" >281</option>
                                       <option value="282" >282</option>
                                       <option value="283" >283</option>
                                       <option value="284" >284</option>
                                       <option value="285" >285</option>
                                       <option value="286" >286</option>
                                       <option value="287" >287</option>
                                       <option value="288" >288</option>
                                       <option value="289" >289</option>
                                       <option value="290" >290</option>
                                       <option value="291" >291</option>
                                       <option value="292" >292</option>
                                       <option value="293" >293</option>
                                       <option value="294" >294</option>
                                       <option value="295" >295</option>
                                       <option value="296" >296</option>
                                       <option value="297" >297</option>
                                       <option value="298" >298</option>
                                       <option value="299" >299</option>
                                       <option value="300" >300</option>
                                       <option value="301" >301</option>
                                       <option value="302" >302</option>
                                       <option value="303" >303</option>
                                       <option value="304" >304</option>
                                       <option value="305" >305</option>
                                       <option value="306" >306</option>
                                       <option value="307" >307</option>
                                       <option value="308" >308</option>
                                       <option value="309" >309</option>
                                       <option value="310" >310</option>
                                       <option value="311" >311</option>
                                       <option value="312" >312</option>
                                       <option value="313" >313</option>
                                       <option value="314" >314</option>
                                       <option value="315" >315</option>
                                       <option value="316" >316</option>
                                       <option value="317" >317</option>
                                       <option value="318" >318</option>
                                       <option value="319" >319</option>
                                       <option value="320" >320</option>
                                       <option value="321" >321</option>
                                       <option value="322" >322</option>
                                       <option value="323" >323</option>
                                       <option value="324" >324</option>
                                       <option value="325" >325</option>
                                       <option value="326" >326</option>
                                       <option value="327" >327</option>
                                       <option value="328" >328</option>
                                       <option value="329" >329</option>
                                       <option value="330" >330</option>
                                       <option value="331" >331</option>
                                       <option value="332" >332</option>
                                       <option value="333" >333</option>
                                       <option value="334" >334</option>
                                       <option value="335" >335</option>
                                       <option value="336" >336</option>
                                       <option value="337" >337</option>
                                       <option value="338" >338</option>
                                       <option value="339" >339</option>
                                       <option value="340" >340</option>
                                       <option value="341" >341</option>
                                       <option value="342" >342</option>
                                       <option value="343" >343</option>
                                       <option value="344" >344</option>
                                       <option value="345" >345</option>
                                       <option value="346" >346</option>
                                       <option value="347" >347</option>
                                       <option value="348" >348</option>
                                       <option value="349" >349</option>
                                       <option value="350" >350</option>
                                       <option value="351" >351</option>
                                       <option value="352" >352</option>
                                       <option value="353" >353</option>
                                       <option value="354" >354</option>
                                       <option value="355" >355</option>
                                       <option value="356" >356</option>
                                       <option value="357" >357</option>
                                       <option value="358" >358</option>
                                       <option value="359" >359</option>
                                       <option value="360" >360</option>
                                       <option value="361" >361</option>
                                       <option value="362" >362</option>
                                       <option value="363" >363</option>
                                       <option value="364" >364</option>
                                       <option value="365" >365</option>
                                       <option value="366" >366</option>
                                       <option value="367" >367</option>
                                       <option value="368" >368</option>
                                       <option value="369" >369</option>
                                       <option value="370" >370</option>
                                       <option value="371" >371</option>
                                       <option value="372" >372</option>
                                       <option value="373" >373</option>
                                       <option value="374" >374</option>
                                       <option value="375" >375</option>
                                       <option value="376" >376</option>
                                       <option value="377" >377</option>
                                       <option value="378" >378</option>
                                       <option value="379" >379</option>
                                       <option value="380" >380</option>
                                       <option value="381" >381</option>
                                       <option value="382" >382</option>
                                       <option value="383" >383</option>
                                       <option value="384" >384</option>
                                       <option value="385" >385</option>
                                       <option value="386" >386</option>
                                       <option value="387" >387</option>
                                       <option value="388" >388</option>
                                       <option value="389" >389</option>
                                       <option value="390" >390</option>
                                       <option value="391" >391</option>
                                       <option value="392" >392</option>
                                       <option value="393" >393</option>
                                       <option value="394" >394</option>
                                       <option value="395" >395</option>
                                       <option value="396" >396</option>
                                       <option value="397" >397</option>
                                       <option value="398" >398</option>
                                       <option value="399" >399</option>
                                       <option value="400" >400</option>
                                       <option value="401" >401</option>
                                       <option value="402" >402</option>
                                       <option value="403" >403</option>
                                       <option value="404" >404</option>
                                       <option value="405" >405</option>
                                       <option value="406" >406</option>
                                       <option value="407" >407</option>
                                       <option value="408" >408</option>
                                       <option value="409" >409</option>
                                       <option value="410" >410</option>
                                       <option value="411" >411</option>
                                       <option value="412" >412</option>
                                       <option value="413" >413</option>
                                       <option value="414" >414</option>
                                       <option value="415" >415</option>
                                       <option value="416" >416</option>
                                       <option value="417" >417</option>
                                       <option value="418" >418</option>
                                       <option value="419" >419</option>
                                       <option value="420" >420</option>
                                       <option value="421" >421</option>
                                       <option value="422" >422</option>
                                       <option value="423" >423</option>
                                       <option value="424" >424</option>
                                       <option value="425" >425</option>
                                       <option value="426" >426</option>
                                       <option value="427" >427</option>
                                       <option value="428" >428</option>
                                       <option value="429" >429</option>
                                       <option value="430" >430</option>
                                       <option value="431" >431</option>
                                       <option value="432" >432</option>
                                       <option value="433" >433</option>
                                       <option value="434" >434</option>
                                       <option value="435" >435</option>
                                       <option value="436" >436</option>
                                       <option value="437" >437</option>
                                       <option value="438" >438</option>
                                       <option value="439" >439</option>
                                       <option value="440" >440</option>
                                       <option value="441" >441</option>
                                       <option value="442" >442</option>
                                       <option value="443" >443</option>
                                       <option value="444" >444</option>
                                       <option value="445" >445</option>
                                       <option value="446" >446</option>
                                       <option value="447" >447</option>
                                       <option value="448" >448</option>
                                       <option value="449" >449</option>
                                       <option value="450" >450</option>
                                       <option value="451" >451</option>
                                       <option value="452" >452</option>
                                       <option value="453" >453</option>
                                       <option value="454" >454</option>
                                       <option value="455" >455</option>
                                       <option value="456" >456</option>
                                       <option value="457" >457</option>
                                       <option value="458" >458</option>
                                       <option value="459" >459</option>
                                       <option value="460" >460</option>
                                       <option value="461" >461</option>
                                       <option value="462" >462</option>
                                       <option value="463" >463</option>
                                       <option value="464" >464</option>
                                       <option value="465" >465</option>
                                       <option value="466" >466</option>
                                       <option value="467" >467</option>
                                       <option value="468" >468</option>
                                       <option value="469" >469</option>
                                       <option value="470" >470</option>
                                       <option value="471" >471</option>
                                       <option value="472" >472</option>
                                       <option value="473" >473</option>
                                       <option value="474" >474</option>
                                       <option value="475" >475</option>
                                       <option value="476" >476</option>
                                       <option value="477" >477</option>
                                       <option value="478" >478</option>
                                       <option value="479" >479</option>
                                       <option value="480" >480</option>
                                       <option value="481" >481</option>
                                       <option value="482" >482</option>
                                       <option value="483" >483</option>
                                       <option value="484" >484</option>
                                       <option value="485" >485</option>
                                       <option value="486" >486</option>
                                       <option value="487" >487</option>
                                       <option value="488" >488</option>
                                       <option value="489" >489</option>
                                       <option value="490" >490</option>
                                       <option value="491" >491</option>
                                       <option value="492" >492</option>
                                       <option value="493" >493</option>
                                       <option value="494" >494</option>
                                       <option value="495" >495</option>
                                       <option value="496" >496</option>
                                       <option value="497" >497</option>
                                       <option value="498" >498</option>
                                       <option value="499" >499</option>
                                       <option value="500" >500</option>
                                       <option value="501" >501</option>
                                       <option value="502" >502</option>
                                       <option value="503" >503</option>
                                       <option value="504" >504</option>
                                       <option value="505" >505</option>
                                       <option value="506" >506</option>
                                       <option value="507" >507</option>
                                       <option value="508" >508</option>
                                       <option value="509" >509</option>
                                       <option value="510" >510</option>
                                       <option value="511" >511</option>
                                       <option value="512" >512</option>
                                       <option value="513" >513</option>
                                       <option value="514" >514</option>
                                       <option value="515" >515</option>
                                       <option value="516" >516</option>
                                       <option value="517" >517</option>
                                       <option value="518" >518</option>
                                       <option value="519" >519</option>
                                       <option value="520" >520</option>
                                       <option value="521" >521</option>
                                       <option value="522" >522</option>
                                       <option value="523" >523</option>
                                       <option value="524" >524</option>
                                       <option value="525" >525</option>
                                       <option value="526" >526</option>
                                       <option value="527" >527</option>
                                       <option value="528" >528</option>
                                       <option value="529" >529</option>
                                       <option value="530" >530</option>
                                       <option value="531" >531</option>
                                       <option value="532" >532</option>
                                       <option value="533" >533</option>
                                       <option value="534" >534</option>
                                       <option value="535" >535</option>
                                       <option value="536" >536</option>
                                       <option value="537" >537</option>
                                       <option value="538" >538</option>
                                       <option value="539" >539</option>
                                       <option value="540" >540</option>
                                       <option value="541" >541</option>
                                       <option value="542" >542</option>
                                       <option value="543" >543</option>
                                       <option value="544" >544</option>
                                       <option value="545" >545</option>
                                       <option value="546" >546</option>
                                       <option value="547" >547</option>
                                       <option value="548" >548</option>
                                       <option value="549" >549</option>
                                       <option value="550" >550</option>
                                       <option value="551" >551</option>
                                       <option value="552" >552</option>
                                       <option value="553" >553</option>
                                       <option value="554" >554</option>
                                       <option value="555" >555</option>
                                       <option value="556" >556</option>
                                       <option value="557" >557</option>
                                       <option value="558" >558</option>
                                       <option value="559" >559</option>
                                       <option value="560" >560</option>
                                       <option value="561" >561</option>
                                       <option value="562" >562</option>
                                       <option value="563" >563</option>
                                       <option value="564" >564</option>
                                       <option value="565" >565</option>
                                       <option value="566" >566</option>
                                       <option value="567" >567</option>
                                       <option value="568" >568</option>
                                       <option value="569" >569</option>
                                       <option value="570" >570</option>
                                       <option value="571" >571</option>
                                       <option value="572" >572</option>
                                       <option value="573" >573</option>
                                       <option value="574" >574</option>
                                       <option value="575" >575</option>
                                       <option value="576" >576</option>
                                       <option value="577" >577</option>
                                       <option value="578" >578</option>
                                       <option value="579" >579</option>
                                       <option value="580" >580</option>
                                       <option value="581" >581</option>
                                       <option value="582" >582</option>
                                       <option value="583" >583</option>
                                       <option value="584" >584</option>
                                       <option value="585" >585</option>
                                       <option value="586" >586</option>
                                       <option value="587" >587</option>
                                       <option value="588" >588</option>
                                       <option value="589" >589</option>
                                       <option value="590" >590</option>
                                       <option value="591" >591</option>
                                       <option value="592" >592</option>
                                       <option value="593" >593</option>
                                       <option value="594" >594</option>
                                       <option value="595" >595</option>
                                       <option value="596" >596</option>
                                       <option value="597" >597</option>
                                       <option value="598" >598</option>
                                       <option value="599" >599</option>
                                       <option value="600" >600</option>
                                       <option value="601" >601</option>
                                       <option value="602" >602</option>
                                       <option value="603" >603</option>
                                       <option value="604" >604</option>
                                       <option value="605" >605</option>
                                       <option value="606" >606</option>
                                       <option value="607" >607</option>
                                       <option value="608" >608</option>
                                       <option value="609" >609</option>
                                       <option value="610" >610</option>
                                       <option value="611" >611</option>
                                       <option value="612" >612</option>
                                       <option value="613" >613</option>
                                       <option value="614" >614</option>
                                       <option value="615" >615</option>
                                       <option value="616" >616</option>
                                       <option value="617" >617</option>
                                       <option value="618" >618</option>
                                       <option value="619" >619</option>
                                       <option value="620" >620</option>
                                       <option value="621" >621</option>
                                       <option value="622" >622</option>
                                       <option value="623" >623</option>
                                       <option value="624" >624</option>
                                       <option value="625" >625</option>
                                       <option value="626" >626</option>
                                       <option value="627" >627</option>
                                       <option value="628" >628</option>
                                       <option value="629" >629</option>
                                       <option value="630" >630</option>
                                       <option value="631" >631</option>
                                       <option value="632" >632</option>
                                       <option value="633" >633</option>
                                       <option value="634" >634</option>
                                       <option value="635" >635</option>
                                       <option value="636" >636</option>
                                       <option value="637" >637</option>
                                       <option value="638" >638</option>
                                       <option value="639" >639</option>
                                       <option value="640" >640</option>
                                       <option value="641" >641</option>
                                       <option value="642" >642</option>
                                       <option value="643" >643</option>
                                       <option value="644" >644</option>
                                       <option value="645" >645</option>
                                       <option value="646" >646</option>
                                       <option value="647" >647</option>
                                       <option value="648" >648</option>
                                       <option value="649" >649</option>
                                       <option value="650" >650</option>
                                       <option value="651" >651</option>
                                       <option value="652" >652</option>
                                       <option value="653" >653</option>
                                       <option value="654" >654</option>
                                       <option value="655" >655</option>
                                       <option value="656" >656</option>
                                       <option value="657" >657</option>
                                       <option value="658" >658</option>
                                       <option value="659" >659</option>
                                       <option value="660" >660</option>
                                       <option value="661" >661</option>
                                       <option value="662" >662</option>
                                       <option value="663" >663</option>
                                       <option value="664" >664</option>
                                       <option value="665" >665</option>
                                       <option value="666" >666</option>
                                       <option value="667" >667</option>
                                       <option value="668" >668</option>
                                       <option value="669" >669</option>
                                       <option value="670" >670</option>
                                       <option value="671" >671</option>
                                       <option value="672" >672</option>
                                       <option value="673" >673</option>
                                       <option value="674" >674</option>
                                       <option value="675" >675</option>
                                       <option value="676" >676</option>
                                       <option value="677" >677</option>
                                       <option value="678" >678</option>
                                       <option value="679" >679</option>
                                       <option value="680" >680</option>
                                       <option value="681" >681</option>
                                       <option value="682" >682</option>
                                       <option value="683" >683</option>
                                       <option value="684" >684</option>
                                       <option value="685" >685</option>
                                       <option value="686" >686</option>
                                       <option value="687" >687</option>
                                       <option value="688" >688</option>
                                       <option value="689" >689</option>
                                       <option value="690" >690</option>
                                       <option value="691" >691</option>
                                       <option value="692" >692</option>
                                       <option value="693" >693</option>
                                       <option value="694" >694</option>
                                       <option value="695" >695</option>
                                       <option value="696" >696</option>
                                       <option value="697" >697</option>
                                       <option value="698" >698</option>
                                       <option value="699" >699</option>
                                       <option value="700" >700</option>
                                       <option value="701" >701</option>
                                       <option value="702" >702</option>
                                       <option value="703" >703</option>
                                       <option value="704" >704</option>
                                       <option value="705" >705</option>
                                       <option value="706" >706</option>
                                       <option value="707" >707</option>
                                       <option value="708" >708</option>
                                       <option value="709" >709</option>
                                       <option value="710" >710</option>
                                       <option value="711" >711</option>
                                       <option value="712" >712</option>
                                       <option value="713" >713</option>
                                       <option value="714" >714</option>
                                       <option value="715" >715</option>
                                       <option value="716" >716</option>
                                       <option value="717" >717</option>
                                       <option value="718" >718</option>
                                       <option value="719" >719</option>
                                       <option value="720" >720</option>
                                    </select>
                                 </div>
                                 <div class="col-sm-2" id="inputLoanNumOfRepaymentsChanged">
                    </div>
                                 
                              </div>
                              
                              
                              
                              <!-- /.box-body -->
                           </div>
                           <!-- /.box -->
                           <!-- /.loan loan End -->
                        </div>
                        <!-- /.loan Tab End -->
                        <!-- ************* loan Attribute Start ******** -->
                        <!-- /.Attribute Tab Start -->
                        <div class="tab-pane
                           <?php
                              if(!empty($tab)){
                                  echo $tab == 'attribute'?'active':'';
                              }
                              ?>
                           " id="attribute">
                           <!-- /.Attribute Start -->
                           <!-- /.loan file -->
                           <table class="table table-bordered table-striped">
                              <tbody>
                                 <tr>
                                    <td>
                                       <div class="form-group">
                                          <label>Attach file</label>
                                       </div>
                                       <div class="form-group">
                                          <!-- hidden  old_path when update  -->
                                          <input type="hidden" name="file_old_path"  value="<?php
                                             if (!empty($loan_info->loan_file_path)) {
                                                 echo $loan_info->loan_file_path;
                                             }
                                             ?>">
                                          <div class="fileinput fileinput-new"  data-provides="fileinput">
                                             <div class="fileinput-new thumbnail g-logo-img" >
                                                <?php if (!empty($loan_info->loan_file_name)): // if loan file is exist then show  ?>
                                                <img src="<?php echo base_url() . $loan_info->loan_file_name; ?>" >
                                                <?php else: // if product image is not exist then defualt a image ?>
                                                <img src="<?php echo base_url() ?>img/file.jpg" alt="loan_file">
                                                <?php endif; ?>
                                             </div>
                                             <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                             <div>
                                                <span class="btn btn-default btn-file">
                                                <span class="fileinput-new"><input type="file" name="loan_file_name" /></span>
                                                <span class="fileinput-exists">Change</span>
                                                </span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                             </div>
                                             <div id="valid_msg" class="required"></div>
                                          </div>
                                       </div>
                                    </td>
                                    <td>
                                       <!-- / Product Image -->
                                       <!-- /.loan Image -->
                                       <div class="form-group">
                                          <label>loan Image</label>
                                       </div>
                                       <div class="form-group">
                                          <!-- hidden  old_path when update  -->
                                          <input type="hidden" name="old_path"  value="<?php
                                             if (!empty($loan_info->loan_image_path)) {
                                                 echo $loan_info->loan_image_path;
                                             }
                                             ?>">
                                          <div class="fileinput fileinput-new"  data-provides="fileinput">
                                             <div class="fileinput-new thumbnail g-logo-img" >
                                                <?php if (!empty($loan_info->loan_image_name)): // if loan image exists then show  ?>
                                                <img src="<?php echo base_url() . $loan_info->loan_image_name; ?>" >
                                                <?php else: // if loan image is not exist then defualt a image ?>
                                                <img src="<?php echo base_url() ?>img/product.png" alt="loan Image">
                                                <?php endif; ?>
                                             </div>
                                             <div class="fileinput-preview fileinput-exists thumbnail g-logo-img"  ></div>
                                             <div>
                                                <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">
                                                <input type="file" name="loan_image_name" /></span>
                                                <span class="fileinput-exists">Change</span>
                                                </span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                             </div>
                                             <div id="valid_msg" class="required"></div>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <tr>
                                 <td>
                                   <select name="loan_status" class="form-control col-sm-8" id="inputStatusId">
                                             <option value="Open" >Open</option>
                                             <option value="Processing" >Processing</option>
                                             <option value="Defaulted" >Defaulted</option>
                                             <option value="Fraud" >Fraud</option>
                                             <option value="Denied" >Denied</option>
                                          </select>
                                 </td>
                                 </tr>
                              </tbody>
                           </table>
                           <!-- / loan Image -->
                           
                           
                           <!-- ************* hidden input field ******** -->
                           <!-- loan image id -->
                           <input type="hidden" name="loan_image_id"
                              value="<?php
                                 if (!empty($loan_info)) {
                                     echo $loan_info->loan_id;
                                 }
                                 ?>">
                                 
                                 <input type="hidden" name="customer_id"
                              value="<?php
                                 if (!empty($customer_info)) {
                                     echo $customer_info->customer_id;
                                 }
                                 ?>">
                           <!-- loan loan id -->
                           <input type="hidden" name="loan_file_id"
                              value="<?php
                                 if (!empty($loan_info)) {
                                     echo $loan_info->loan_id;
                                 }
                                 ?>">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="box-footer">
                  <button type="submit"  id="submit" class="btn bg-navy btn-flat col-md-offset-3" type="submit">Save loan
                  </button>
               </div>
            </form>
         </div>
         <!-- /.box -->
      </div>
      <!--/.col end -->
   </div>
   <!-- /.row -->
</section>
<!-- /.section -->
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
$(document).ready(function() {

$(function() {
    $('#interest_method').change(function(){
        var val = $( "#interest_method" ).val();

        if(val == 'compound_interest')
        {
            $('#compound_interest').show();
        }
        else
        {
            $('#compound_interest').hide();
        }
    });
});
});
</script>
<!--    Image Validation Check    -->
<script type="text/javascript"></script>