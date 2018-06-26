var keyId = "";

$(document).ready(function () {
    inquiryConfig();
    
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
                var res = data.bean[0];
                $('#s_address').text(res.s_address);
                
        
                
            }
            unblockui();
        },
        error: function (data) {
            console.log(data);
        }

    });
}



function save() {

    var jsonData = $("#form-action").serialize();

    $.ajax({
        type: 'POST',
        url: contextPath + '/api/Config/Save',
        data: jsonData,
        dataType: 'json',
        cache: false,
        beforeSend: function () {
            blockui_always();
        },
        success: function (data) {

            notify(data);
            if (isSuccess(data)) {
                if (keyId == "" || keyId == "null") {
                    setTimeout(location.reload(), 5000);
                }

            }
            unblockui();

        },
        error: function (data) {
            console.log(data);
        }

    });
}


