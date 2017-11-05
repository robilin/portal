     <!-- /.box-header -->
            <!-- form start -->
            <form role="form" enctype="multipart/form-data" id="addProductForm" onsubmit="return imageForm(this)"
               action="<?php echo base_url(); ?>admin/product/save_bill_of_material/<?php  if (!empty($product_info)) {
                  echo $product_info->product_id;
                  } ?>" method="post">	
    	<div class="col-md-12 table-responsive">
			<table class="table table-bordered table-hover table-sortable" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							Product name
						</th>
						
						<th class="text-center">
							Quantity
						</th>
    					<th class="text-center">
							Unit Measure
						</th>
        				<th class="text-center" style="border-top: 1px solid #ffffff; border-right: 1px solid #ffffff;">
						</th>
					</tr>
				</thead>
				<tbody>
    				<tr id='addr0' data-id="0" class="hidden">
    				   <td data-name="sel">
					<select name="prod_name[]"  class="form-control" placeholder="Select product">
					<option value="" selected="selected">Select product</option>
        				<?php  
                       		$product = $this->db->get_where('tbl_product',array('can_be_sold'=>0))->result();
                        ?>
                                                                  
                        <?php if (!empty($product)): ?>
                            <?php foreach ($product as $item) : ?>
                                <option value="<?php echo $item->product_id ?>" <?php echo $this->session->userdata('product_id') == $item->product_id ?'selected':'' ?>>
                                   <?php echo $item->product_name; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
					</select>	  
				   </td>
    				
						<td data-name="name">
						    <input type="text" name='prod_quantity[]'  placeholder='Quantity' class="form-control"/>
						</td>
						
						<td data-name="desc">
						    <input type="text" name='prod_unit_measure[]'  placeholder='Unit Measure' class="form-control"/>
						</td>

                        <td data-name="del">
                            <button nam"del0" class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>
                        </td>
					</tr>
				</tbody>
			</table>
		</div>
	<div class="box-footer">
	<a id="add_row" class="btn btn-success pull-right">+</a>
	</div>
	 <div class="box-footer">
                  <button type="submit"  id="submit" class="btn bg-navy btn-flat" type="submit">Save Product
                  </button>
               </div>
</form>

<script type="text/javascript">


$(document).ready(function() {
	   
    $("#add_row").on("click", function() {
        // Dynamic Rows Code
        
        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic tr"), function() {
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;
        
        var tr = $("<tr></tr>", {
            id: "addr"+newid,
            "data-id": newid
        });
        
        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic tbody tr:nth(0) td"), function() {
            var cur_td = $(this);
            
            var children = cur_td.children();
            
            // add new td and element if it has a nane
            if ($(this).data("name") != undefined) {
                var td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("name", $(cur_td).data("name") + newid);
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                var td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));
            }
        });
        
        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */
        
        // add the new row
        $(tr).appendTo($('#tab_logic'));
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
        });
});




    // Sortable Code
   



    $("#add_row").trigger("click");
});
</script>

