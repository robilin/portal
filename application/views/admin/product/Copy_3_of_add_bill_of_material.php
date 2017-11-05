<link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/jquery-ui.min.css">
<script src="<?php echo base_url(); ?>asset/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url(); ?>asset/js/jquery-ui.min.js"></script>

<link href="<?php echo base_url(); ?>asset/css/select2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url(); ?>asset/js/select2.js"></script>
<!--<script type="text/javascript">-->
<!--   $(document).ready(function(){-->
<!---->
<!--	     -->
<!--	   	var babyNames=["Mia","Jensen","Samia","Douglas"];-->
<!--	   -->
<!--	   $('#production_amount').autocomplete({-->
<!--		   -->
<!--			   source:babyNames-->
<!--		   -->
<!--   });-->
<!--   });-->
<!--   -->
<!--   </script>-->
   
    <div class="form-group">
                        <select placeholder="Click here to select products..." style="width: 99%;" required name="product_id"  class="js-example-basic-multiple-limit" >
                        
                        <?php  
                       			 $product = $this->db->get('tbl_product')->result();
                        ?>
                                                                  
                        <?php if (!empty($product)): ?>
                            <?php foreach ($product as $item) : ?>
                                <option value="<?php echo $item->product_id ?>" <?php echo $this->session->userdata('product_id') == $item->product_id ?'selected':'' ?>>
                                   <?php echo $item->product_name; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>

                   </select>
                </div>
                
                <div class="form-group">
                 
                    <input type="text" name="production_amount" id="production_amount" class="form-control" placeholder="Production quantiy" >
                  
                </div>
   
   <div class="table-responsive">
			<table class="table table-bordered table-hover" id="crud_table">
			
					<tr >
					<th class="text-center">
							#
						</th>
						
						<th class="text-center">
							Product Name
						</th>
						<th class="text-center">
							Quantity
						</th>
						<th class="text-center">
							Unit Measure
						</th>
						<th class="text-center">
							
						 </th>
					</tr>
			
				
					<tr>
					    <td contenteditable="true" class="counter text-center">
				          1
						</td>
						<td contenteditable="true" class="bom_name">
				     
						</td>
						<td contenteditable="true" class="bom_quantity">
						
						</td>
						<td contenteditable="true" class="bom_unit_measure">
						
						</td>
						<td>
						
						</td>
					</tr>

			</table>
			
			<div align="right">
			<button type="button" name="add" id="add" class="btn btn-success btn-xs">+</button>
			</div>
			<div align="left">
			<button type="button" name="save" id="save" class="btn btn-info btn-xs">Save</button>
			</div>
			<br>
			<div id="live_data"></div>
			
		</div>

<script>
     $(document).ready(function(){
    

    var babyNames=["Mia","Jensen","Samia","Douglas"];

   	
      var count=1;
      
     $('#add').click(function(){

         
 	   	var babyNames=["Mia","Jensen","Samia","Douglas"];
 	   
 	   $('#test').autocomplete({
 		   
 			   source:babyNames
 		   
       });
         
         count=count+1;
         var html_code="<tr id='row"+count+"'>";
             html_code+="<td contenteditable='true' class='no text-center'>"+count+"</td>";
             html_code+="<td contenteditable='true' class='bom_name' id='test'><input type='text' name='test' id='test'> </td>";
             html_code+="<td contenteditable='true' class='bom_quantity'></td>";
             html_code+="<td contenteditable='true' class='bom_unit_measure'></td>";
             html_code+="<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>-</button></td>";
             html_code+="</tr>";

      $('#crud_table').append(html_code);
     });

     $(document).on('click','.remove', function(){
         var delete_row=$(this).data("row");
         if(count>1){
         $('#'+delete_row).remove();
         count--;
         }	
	 });

   

     $('#save').click(function(){

     var bom_name=[];
     var bom_quantity=[];
     var bom_unit_measure=[];
     
     
	 $('.bom_name').each(function(){
     bom_name.push($(this).text());
	 });

	 $('.bom_quantity').each(function(){
	     bom_quantity.push($(this).text());
		 });
	 
	  $('.bom_unit_measure').each(function(){
		  bom_unit_measure.push($(this).text());
	  });

	  
	  
	  $.ajax({
	       url:'<?php echo base_url(); ?>admin/product/save_bill_of_material/',
	       dataType:'json',
	       type: 'POST',
	       data: {bom_name:bom_name,bom_quantity:bom_quantity,bom_unit_measure:bom_unit_measure},
	       success: function(data){
	           $("td[contentEditable='true']").text("");
	           for(var i=2; i<=count; i++){
						$('tr#'+i+'').remove();
		           }
	          alert(data.success);
	       }
	       
	   });

	  

     });

     $('#result').keyup(function(){
         var query=$(this).val();
         if(query !=''){
			$.ajax({
				url:'<?php echo base_url(); ?>admin/product/get_bill_of_material/', 
				method: "POST",
				data:{query:query},
				success:function(data){ 
					$('#live_data').fadeIn();
					$('#live_data').html(data);
					 }
				});
         }
      });

    
	 
     });

   
	
     
</script>
<script>

   $(document).ready(function() {

       $('.box-body').css({"border-top":"0px solid #ccc"});

       $("#customer").select2({
           placeholder: "Select a State",
           allowClear: true
       });

       $(".js-example-basic-multiple-limit").select2({
    	   maximumSelectionLength: 2
    	 });

   });

</script>