<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Launch demo modal</button>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Modal title</h4>

            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <label for="idTourDateDetails">Tour Start Date:</label>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" name="idTourDateDetails" id="idTourDateDetails" readonly="readonly" class="form-control clsDatePicker"> <span class="input-group-addon"><i id="calIconTourDateDetails" class="glyphicon glyphicon-th"></i></span>

                            </div>
                        </div>Alt Field:
                        <input type="text" name="idTourDateDetailsHidden" id="idTourDateDetailsHidden">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    
    
     $('#idTourDateDetails').datepicker({
     dateFormat: 'dd-mm-yy',
     minDate: '+5d',
     changeMonth: true,
     changeYear: true,
     altField: "#idTourDateDetailsHidden",
     altFormat: "yy-mm-dd"
 });

// Since confModal is essentially a nested modal it's enforceFocus method
// must be no-op'd or the following error results 
// "Uncaught RangeError: Maximum call stack size exceeded"
// But then when the nested modal is hidden we reset modal.enforceFocus
var enforceModalFocusFn = $.fn.modal.Constructor.prototype.enforceFocus;

$.fn.modal.Constructor.prototype.enforceFocus = function() {};

$confModal.on('hidden', function() {
    $.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
});

$confModal.modal({ backdrop : false });