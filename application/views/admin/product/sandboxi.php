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
					    <td contenteditable="true" class="bom_name text-center">
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
			<div id="inserted_item_data"></div>
			
		</div>

<script>
     $(document).ready(function(){
      var count=1;
     $('#add').click(function(){
         count=count+1;
         var html_code="<tr id='row"+count+"'>";
             html_code+="<td contenteditable='true' class='no text-center'>"+count+"</td>";
             html_code+="<td contenteditable='true' class='bom_name'></td>";
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

	  alert(bom_name);
	  
		    $.ajax({
		       url:'<?php echo base_url(); ?>admin/product/add_bill_of_material/',
		       dataType:'json',
		       type: 'GET',
		       data: {bom_name:bom_name,bom_quantity:bom_quantity,bom_unit_measure:bom_unit_measure},
		       success: function(data){
		           $("td[contentEditable='true']").text("");
		           for(var i=2; i<=count; i++){
							$('tr#'+i+'').remove();
			           }
		       }
		       
		   });

	  

     });
	 
     });
    
	
     
</script>

