var keyId = "";

$(document).ready(function () {
//    inquiryConfig();
    unblockui();
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
                $('#s_user').val(res.s_username);
                $('#s_pass').val(res.s_password);
                $('#level').val(res.s_level);
                $('#s_firstname').val(res.s_firstname);
                $('#s_lastname').val(res.s_lastname);
                $('#s_phone').val(res.s_phone);
                $('#s_email').val(res.s_email);
                $('#s_line').val(res.s_line);
                $('#status').val(res.s_status);

                $('#s_user').attr('readonly', 'readonly');

                $('#dCreate').html(res.d_create + " ( " + res.s_create_by + " )");
                $('#dUpdate').html(res.d_update + " ( " + res.s_update_by + " )");
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


