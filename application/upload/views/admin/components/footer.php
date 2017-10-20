 
<footer class="main-footer">
      
        <strong>Copyright &copy; <?php echo date("Y") ?> <a href="http://xchangewallet.com">xchange wallet</a>.</strong> All rights reserved.
      </footer>
      
 </div><!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js" type="text/javascript"></script>
<!--<script src="--><?php //echo base_url(); ?><!--asset/js/menu.js" type="text/javascript"></script>-->
<!--<script src="--><?php //echo base_url(); ?><!--asset/js/custom-validation.js" type="text/javascript"></script>-->
<script src="<?php echo base_url(); ?>asset/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/app.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/form-validation.js" type="text/javascript"></script>
<!-- Jasny Bootstrap for NIce Image Change -->
<script src="<?php echo base_url() ?>asset/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>asset/js/bootstrap-datepicker.js" ></script>
<script src="<?php echo base_url() ?>asset/js/timepicker.js" ></script>

<!-- Data Table -->
<script src="<?php echo base_url(); ?>asset/plugin/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/buttons.bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/jszip.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/pdfmake.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/vfs_fonts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/buttons.print.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/dataTables.fixedHeader.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/dataTables.keyTable.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/responsive.bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/plugin/datatables/dataTables.scroller.min.js" type="text/javascript"></script>



<script src="<?php echo base_url(); ?>asset/js/morris/morris.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/js/morris/raphael.min.js" type="text/javascript"></script>


    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>

	<script>
		var handleDataTableButtons = function() {
					"use strict";
					0 !== $(".datatable-buttons").length && $(".datatable-buttons").DataTable({
						"iDisplayLength": 25,

						dom: "Bfrtip",
						buttons: [{
							extend: "copy",
							className: "btn-sm"
						}, {
							extend: "csv",
							className: "btn-sm"
						}, {
							extend: "excel",
							className: "btn-sm"
						}, {
							extend: "pdf",
							className: "btn-sm"
						}, {
							extend: "print",
							className: "btn-sm"
						}],
						responsive: !0
					})
				},
				TableManageButtons = function() {
					"use strict";
					return {
						init: function() {
							handleDataTableButtons()
						}
					}
				}();



		var handleCartButtons = function() {
					"use strict";
					0 !== $(".cart-buttons").length && $(".cart-buttons").DataTable({
						"iDisplayLength": 25,

						dom: "Bfrtip",
						buttons: [
							{

								text: 'Add to Cart',
								action: function ( e, dt, node, config ) {
									document.getElementById("addToCart").submit();// Form submission
								}
							}
						]

					})
				},
				cartButtons = function() {
					"use strict";
					return {
						init: function() {
							handleCartButtons()
						}
					}
				}();




	</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({
            keys: true,

        });
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable({
            ajax: "js/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true

        });
        var table = $('#datatable-fixed-header').DataTable({
            fixedHeader: true
        });



    });

    TableManageButtons.init();
	cartButtons.init();
</script>



</body>
</html>
