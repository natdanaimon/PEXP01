var keyId = "";

$(document).ready(function () {

    //inquiryConfig()
});







function inquiryConfig() {
    $.ajax({
        type: 'POST',
        url: contextPath + '/api/Config/InquiryConfig',
        dataType: 'json',
//        cache: false,
        beforeSend: function () {
            blockui_always();
        },
        success: function (data) {
            if (isSuccess(data)) {
//                var res = data.bean[0];
//                $('#s_address').text(res.s_address);
//                $('#blah-s_logo').attr('src', '../../image/logo/' + res.s_logo);
//                $('#blah-s_sign').attr('src', '../../image/sign/' + res.s_sign);



            }
            unblockui();
        },
        error: function (data) {
            console.log(data);
        }

    });
}



function Export() {

    //var jsonData = $("#form-action").serialize();
    var jsonData = new FormData($("#form-action")[0]);

    $.ajax({
        type: 'POST',
        url: contextPath + '/api/Bill/Export',
        data: jsonData,
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            blockui_always();
        },
        success: function (data) {

            notify(data);
            if (isSuccess(data)) {
                

            }
            unblockui();

        },
        error: function (data) {
            console.log(data);
        }

    });
}

function calculator(){
	var price = $('#i_price').val();
	var commission = $('#i_commission1').val();
	var vat = $('#i_vat1').val();
	
	if(price == null){
		 price = 0;
	}
	var t_com = calculator_per(price,commission);
	var t_vat = calculator_per(price,vat);
	var t_charge = t_com+t_vat;
	var balance = price - t_charge;
	
	/*t_com = number_format(t_com,2);
	t_vat = number_format(t_vat,2);
	balance = number_format(balance,2);
	price = number_format(price,2);*/
	
	$('#i_commission').val(t_com);
	$('#i_vat').val(t_vat);
	$('#i_balance').val(balance);
	$('#i_refund').val(price);
	$('#i_price').val(price);
	

}

function calculator_per(pPos,pEarned){

var total = ((pEarned*pPos) / 100).toFixed(2);

total = parseFloat(total);
return total;

}



