$('#save').click(function(event){

		event.preventDefault();
		var bom_name = $("input#bom_name").val();
		var bom_quantity = $("input#bom_quantity").val();
		var bom__unit_measure = $("input#bom__unit_measure").val();
		
		jQuery.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>" + "admin/product/save_bom",
		dataType: 'json',
		data: {bom_name: bom_name, bom_quantity: bom_quantity,bom__unit_measure: bom__unit_measure},
		success: function(res) {
		if (res)
		{
		// Show Entered Value
		jQuery("div#result").show();
		jQuery("div#bom_name").html(res.bom_name);
		jQuery("div#bom_quantity").html(res.bom_quantity);
		jQuery("div#bom_unit_measure").html(res.bom_unit_measure);
		}
	}
	

  });
});