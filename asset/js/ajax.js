function getXMLHTTP() { //fuction to return the xml http object
    var xmlhttp = false;
    try {
        xmlhttp = new XMLHttpRequest();
    }
    catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch (e) {
            try {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch (e1) {
                xmlhttp = false;
            }
        }
    }

    return xmlhttp;		
}


$(document).ready(function() {
	/*place jQuery actions here*/

    var req = getXMLHTTP();
    if (req) {

        var link = getBaseURL();


//*********************************************
//     add new product to purchase cart
//*********************************************

        $("#add-product form").submit(function () {

            var product_name = $(this).find('input[name=product_name]').val();
            var qty = $(this).find('input[name=qty]').val();
            var price = $(this).find('input[name=price]').val();

            $.post(link + "admin/purchase/add_new_product_to_cart", {
                    product_name: product_name,
                    qty: qty,
                    price: price,
                    ajax: '1'
                },
                function (data) {

                    if (data == 'true') {

                        $.get(link + "admin/purchase/show_cart", function (cart) {
                            $("#cart_content").html(cart);
                            $("#newform")[0].reset();

                        });

                    }

                });
            return false;
        });


    }

});


//*********************************************
//           Get Base URL
//*********************************************

function getBaseURL() {
    return link = jQuery('body').data('baseurl');

};

//*********************************************
//       Update cart purchase cart item
//*********************************************

function purchase(arg){
    $('#btn_purchase').attr('disabled','disabled');
    var val = arg.getAttribute('id');
    var id = val.slice(3);

    // do your stuff
    var qty = $( "#qty"+id ).val();
    var price = $( "#pri"+id ).val();
    //alert(price);
    var link = getBaseURL();
    $.post(link + "admin/purchase/update_cart_item", {rowid: id, qty: qty, price: price ,ajax: '1'},
        function (data) {

            if (data == 'true') {

                $.get(link + "admin/purchase/show_cart", function (cart) {
                    $("#cart_content").html(cart);
                });

            }

        });

}

//*********************************************
//       Update order cart item
//*********************************************

function order(arg){
$('#btn_order').attr('disabled','disabled');
    var req = getXMLHTTP();
    if (req) {

        var val = arg.getAttribute('id');
        var id = val.slice(3);

        // do your stuff
        var qty = $("#qty" + id).val();
        var price = $("#pri" + id).val();
        var product_code = $("#code" + id).val();

        if($("#opt" + id).prop("checked") == true){
            var custom_price = 'on';
        }

        var link = getBaseURL();

        if(qty && price && product_code)

        $.post(link + "admin/order/update_cart_item", {
                rowid: id,
                qty: qty,
                price: price,
                product_code: product_code,
                custom_price: custom_price,
                ajax: '1'
            },
            function (data) {

                if (data == 'false') {
                    var flag = 'inventory';
                    var url = link + "admin/order/new_order/"+flag;
                    $(location).attr("href", url);


                }

                if (data == 'true') {



                    $.get(link + "admin/order/show_cart", function (cart) {
                        $("#cart_content").html(cart);
                    });

                    $.get(link + "admin/order/show_cart_summary", function (cart_summary) {
                        $("#cart_summary").html(cart_summary);
                    });

                    //$('#btn_order')..removeAttr('disabled');

                }

            });
    }
}

function request(arg){
	$('#btn_order').attr('disabled','disabled');
	    var req = getXMLHTTP();
	    if (req) {

	        var val = arg.getAttribute('id');
	        var id = val.slice(3);

	        // do your stuff
	        var qty = $("#qty" + id).val();
	        var price = $("#pri" + id).val();
	        var product_code = $("#code" + id).val();

	        if($("#opt" + id).prop("checked") == true){
	            var custom_price = 'on';
	        }

	        var link = getBaseURL();

	        if(qty && price && product_code)

	        $.post(link + "admin/medication/update_cart_item", {
	                rowid: id,
	                qty: qty,
	                price: price,
	                product_code: product_code,
	                custom_price: custom_price,
	                ajax: '1'
	            },
	            function (data) {

	                if (data == 'false') {
	                    var flag = 'inventory';
	                    var url = link + "admin/medication/new_medication/"+flag;
	                    $(location).attr("href", url);


	                }

	                if (data == 'true') {



	                    $.get(link + "admin/medication/show_cart", function (cart) {
	                        $("#cart_content").html(cart);
	                    });

	                    $.get(link + "admin/medication/show_cart_summary", function (cart_summary) {
	                        $("#cart_summary").html(cart_summary);
	                    });

	                    //$('#btn_order')..removeAttr('disabled');

	                }

	            });
	    }
	}
//*********************************************
//     Custom Price Operation
//*********************************************

function price_checkbox(me)
{

    var val = me.id
    var id = val.slice(3);

    //alert(id);
    var result = $("#pri" + id).prop('disabled');
    if(result){
        $("#pri" + id).prop('disabled',false);
    }else{
        $("#pri" + id).prop('disabled',true);
    }

    if(result == false){
        $('#btn_order').attr('disabled','disabled');

        var req = getXMLHTTP();
        if (req) {

            // do your stuff
            var qty = $("#qty" + id).val();
            var price = $("#pri" + id).val();
            var product_code = $("#code" + id).val();
            var custom_price = 'unchecked';
            var link = getBaseURL();

                $.post(link + "admin/medication/update_cart_item", {
                        rowid: id,
                        qty: qty,
                        price: price,
                        product_code: product_code,
                        custom_price: custom_price,
                        ajax: '1'
                    },
                    function (data) {

                        if (data == 'true') {

                            $.get(link + "admin/medication/show_cart", function (cart) {
                                $("#cart_content").html(cart);
                            });

                            $.get(link + "admin/medication/show_cart_summary", function (cart_summary) {
                                $("#cart_summary").html(cart_summary);
                            });

                        }

                    });
        }

    }
}


function price_checkbox_medication(me)
{

    var val = me.id
    var id = val.slice(3);

    //alert(id);
    var result = $("#pri" + id).prop('disabled');
    if(result){
        $("#pri" + id).prop('disabled',false);
    }else{
        $("#pri" + id).prop('disabled',true);
    }

    if(result == false){
        $('#btn_order').attr('disabled','disabled');

        var req = getXMLHTTP();
        if (req) {

            // do your stuff
            var qty = $("#qty" + id).val();
            var price = $("#pri" + id).val();
            var product_code = $("#code" + id).val();
            var custom_price = 'unchecked';
            var link = getBaseURL();

                $.post(link + "admin/medication/update_cart_item", {
                        rowid: id,
                        qty: qty,
                        price: price,
                        product_code: product_code,
                        custom_price: custom_price,
                        ajax: '1'
                    },
                    function (data) {

                        if (data == 'true') {

                            $.get(link + "admin/order/show_cart", function (cart) {
                                $("#cart_content").html(cart);
                            });

                            $.get(link + "admin/order/show_cart_summary", function (cart_summary) {
                                $("#cart_summary").html(cart_summary);
                            });

                        }

                    });
        }

    }
}

//*********************************************
//check giftcard number
//*********************************************

function check_giftcard(gift_card_no) {

var gift_card_no = $("#gift_card_no").val();
//alert(customer_id);
var link = getBaseURL();
var strURL = link + "admin/giftcard/check_giftcard_no/" + gift_card_no  + "/" + giftcard_id;
var req = getXMLHTTP();



if (req) {

 req.onreadystatechange = function() {
     if (req.readyState == 4) {
         // only if "OK"
         if (req.status == 200) {
             var result = req.responseText;
             document.getElementById('giftcard_result').innerHTML = result;
             if (result) {
                 $('#giftcard_btn').prop('disabled', true);
             } else {
                 $('#giftcard_btn').prop('disabled', false);
             }
             validation_check();
         } else {
             alert("There was a problem while using XMLHTTP:\n" + req.statusText);
         }
     }
 }
 req.open("POST", strURL, true);
 req.send(null);
}

}


//*********************************************
//     Customer phone number check
//*********************************************

function check_phone(phone) {

    var customer_id = $("#customer_id").val();
    //alert(customer_id);
    var link = getBaseURL();
    var strURL = link + "admin/customer/check_customer_phone/" + phone  + "/" + customer_id;
    var req = getXMLHTTP();



    if (req) {

        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                // only if "OK"
                if (req.status == 200) {
                    var result = req.responseText;
                    document.getElementById('giftcard_result').innerHTML = result;
                    if (result) {
                        $('#customer_btn').prop('disabled', true);
                    } else {
                        $('#customer_btn').prop('disabled', false);
                    }
                    validation_check();
                } else {
                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                }
            }
        }
        req.open("POST", strURL, true);
        req.send(null);
    }

}

//*********************************************
//     Employee user name check
//*********************************************

function check_user_name(str) {
    $('#sbtn').attr('disabled','disabled');
    var user_name = $.trim(str);
    var user_id = $.trim($("#employee_id").val());

    var link = getBaseURL();
    //alert(link);
    var strURL = link + "admin/global_controller/check_existing_user_name/" + user_name + "/" + user_id;
    var req = getXMLHTTP();
    if (req) {
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                // only if "OK"
                if (req.status == 200) {
                    var result = req.responseText;
                    document.getElementById('username_result').innerHTML = result;
                    var msg = result.trim();
                    if (msg) {
                        document.getElementById('sbtn').disabled = true;
                    } else {
                        document.getElementById('sbtn').disabled = false;
                    }

                } else {
                    alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                }
            }
        }
        req.open("POST", strURL, true);
        req.send(null);


    }
}

//*********************************************
//     Product Category to Subcategory
//*********************************************

function get_category(str) {

    if (str == '') {
        $("#subcategory").html("<option value=''>Select Subcategory</option>");
    } else {
        $("#subcategory").html("<option value=''>Select Subcategory</option>");

        var link = getBaseURL();
        var strURL = link + "admin/product/get_subcategory_by_category/" + str;
        var req = getXMLHTTP();
        if (req) {

            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {
                        var result = req.responseText;
                        //alert(result);
                        $("#subcategory").html("<option value=''>Select Subcategory</option>");
                        $("#subcategory").append(result);
                    } else {
                        alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }
            }
            req.open("POST", strURL, true);
            req.send(null);
        }
    }
}

//*********************************************
//     Change Password method div show hide
//*********************************************
function setVisibility() {
   var a = $('#change_password').val();
    var result  = a.toString()
    if( result == 'Change Password'){
        $('#change_password').val('Hide Password'),
        $('#password_flag').val('ok'),
        $('#password_div').show();
    }else{
        $('#change_password').val('Change Password'),
        $('#password_flag').val('no'),
        $('#password_div').hide();
    }
}

//*********************************************
//     Purchase payment method show hide
//*********************************************

$(function() {
    $('#payment_type').change(function(){

        $("#pri" + id).prop('disabled',false);

        if(val == 'cheque')
        {
            $('#payment').show();
        }
        else if (val == 'card')
        {
            $('#payment').show();
        }
        else
        {
            $('#payment').hide();
        }
    });
});



//*********************************************
//     Order payment method show hide
//*********************************************

$(function() {
    $('#order_payment_type').change(function(){
        var val = $( "#order_payment_type" ).val();

        if(val == 'cheque')
        {
            $('#payment').show();
        }
        else if (val == 'card')
        {
            $('#payment').show();
        }
        else if (val == 'cash')
        {
            $('#cashpayment').show();
        }else if (val == 'giftcard')
        {
            $('#giftcard').show();
        }
        else
        {
            $('#payment').hide();
        }
    });
});

//*********************************************
//Order payment method show hide
//*********************************************

$(function() {
$('#opt').change(function(){
 var val = $( "#opt" ).val();

 if(val == '1')
 {
     $('#parent_id').show();
     $('#label_id').show();
 }
 else if (val == '2')
 {
     $('#parent_id').show();
     $('#label_id').show();
 }
 else
 {
     $('#parent_id').hide();
     $('#label_id').hide();
 }
});
});


//*********************************************
//     Order Confirmation Method
//*********************************************

$(function() {
    $('#order_confirmation').change(function(){
        var val = $( "#order_confirmation" ).val();
        if(val == '2')
        {
            $('#payment_method_block').show();
        }else
        {
            $('#payment_method_block').hide();
        }
    });
});



//*********************************************
//     Email Campaign
//*********************************************

$("#sendEmail form").submit(function () {

    var campaign_id = $(this).find('input[name=campaign_id]').val();

    var req = getXMLHTTP();
    if (req) {
        var link = getBaseURL();
        $.post(link + "admin/campaign/send_email", {
                campaign_id: campaign_id,
                ajax: '1'
            },
            function (data) {

                if (data == 'true') {
                    $.get(link + "admin/purchase/show_cart", function (cart) {
                        $("#cart_content").html(cart);
                        $("#newform")[0].reset();

                    });

                }

            });
        return false;

    }


});


//*********************************************
//       Update Discount %
//*********************************************


function discountValue(discount) {
    var link = getBaseURL();
    var req = getXMLHTTP();

    if (req) {
        $.post(link + "admin/order/assign_discount", {
                discount: discount,
                ajax: '1'
            },
            function (data) {

                if (data == 'false') {
                    var flag = 'inventory';
                    var url = link + "admin/order/new_order/"+flag;
                    $(location).attr("href", url);

                }

                if (data == 'true') {
                    $.get(link + "admin/order/show_cart_summary", function (cart_summary) {
                        $("#cart_summary").html(cart_summary);
                    });

                }

            });
    }

}


function getLabs(customer) {
    var link = getBaseURL();
    var req = getXMLHTTP();
    if (req) {
        $.post(link + "admin/laboratory/get_lab_items", {
                customer_id: customer.value,
                ajax: '1'
            },
            function (data) {

                if (data == 'false') {
                    var flag = 'inventory';
                    var url = link + "admin/order/new_order/"+flag;
                    $(location).attr("href", url);

                }

                if (data == 'true') {
                    $.get(link + "admin/order/show_cart_summary", function (cart_summary) {
                        $("#cart_summary").html(cart_summary);
                    });

                }

            });
    }

}


function getCustomer(customer) {
    var link = getBaseURL();
    var req = getXMLHTTP();
    if (req) {
        $.post(link + "admin/order/get_customer", {
                customer_id: customer.value,
                ajax: '1'
            },
            function (data) {

                if (data == 'false') {
                    var flag = 'inventory';
                    var url = link + "admin/order/new_order/"+flag;
                    $(location).attr("href", url);

                }

                if (data == 'true') {
                    $.get(link + "admin/order/show_cart_summary", function (cart_summary) {
                        $("#cart_summary").html(cart_summary);
                    });

                }

            });
    }

}

function getPatient(customer) {
    var link = getBaseURL();
    var req = getXMLHTTP();
    if (req) {
        $.post(link + "admin/laboratory/get_patient", {
                customer_id: customer.value,
                ajax: '1'
            },
            function (data) {

                if (data == 'false') {
                    var flag = 'inventory';
                    var url = link + "admin/laboratory/lab_request/"+flag;
                    $(location).attr("href", url);

                }

                if (data == 'true') {
                    $.get(link + "admin/laboratory/lab_request", function (cart_summary) {
                        $("#cart_summary").html(cart_summary);
                    });

                }

            });
    }

}


//*********************************************
//     Product Code check
//*********************************************

function check_product_code(str) {
    $('#submit').attr('disabled','disabled');

    var product_code = $.trim(str);
    var product_id = $.trim($("#product_id").val());

    var link = getBaseURL();
    var req = getXMLHTTP();
    if (req) {
        $.post(link + "admin/product/check_product_code", {
                product_code: product_code,
                product_id: product_id,
                ajax: '1'
            },

            function (data) {

                if (data) {
                    document.getElementById('product_code_result').innerHTML = data;
                    document.getElementById('submit').disabled = true;
                } else {
                    document.getElementById('submit').disabled = false;
                    $('#product_code_result').empty();

                }

            });
    }
}

function generateCardNo(x) {
    if(!x) { x = 16; }
    chars = "1234567890";
    no = "";
    for (var i=0; i<x; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        no += chars.substring(rnum,rnum+1);
    }
    return no;
}
