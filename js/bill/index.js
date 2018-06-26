var keyId = "";

$(document).ready(function () {

    inquiryConfig()
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



