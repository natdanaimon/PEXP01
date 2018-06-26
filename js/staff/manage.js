var keyId = "";

$(document).ready(function () {
    blockui_always();
    keyId = $('#keyId').val();
    status();
});

$("#s_pass").on("keyup", function () {
    if ($(this).val())
        $(".la-eye").show();
    else
        $(".la-eye").hide();
});
$(".la-eye").mousedown(function () {
    $("#s_pass").attr('type', 'text');
}).mouseup(function () {
    $("#s_pass").attr('type', 'password');
}).mouseout(function () {
    $("#s_pass").attr('type', 'password');
});

function status() {
    $.ajax({
        type: 'GET',
        url: contextPath + '/api/Dropdown/Status',
        dataType: 'json',
        beforeSend: function () {
            blockui_always();
        },
        success: function (data) {
            if (isSuccess(data)) {
                $('#status').find('option').remove().end().append(
                        '<option value="-1">' + L.lb.pleaseSelect
                        + '</option>');

                $.each(data.bean, function (i, option) {
                    $('#status').append(
                            $('<option/>').attr("value", option.key).text(
                            option.value));
                });
            }

            level();
            unblockui();

        },
        error: function (data) {
            console.log(data);
        }

    });
}

function level() {
    $.ajax({
        type: 'GET',
        url: contextPath + '/api/Dropdown/Level',
        dataType: 'json',
//        cache: false,
        beforeSend: function () {

        },
        success: function (data) {
            if (isSuccess(data)) {
                $('#level').find('option').remove().end().append(
                        '<option value="-1">' + L.lb.pleaseSelect + '</option>');

                $.each(data.bean, function (i, option) {
                    $('#level').append(
                            $('<option/>').attr("value", option.key).text(
                            option.value));
                });

                if (keyId != "") {
                    inquiryStaffbyID(keyId);
                }


            }
        },
        error: function (data) {
            console.log(data);
        }

    });
}


function inquiryStaffbyID(keyId) {
    $.ajax({
        type: 'POST',
        url: contextPath + '/api/Staff/InquiryStaffbyID/' + keyId,
        dataType: 'json',
//        cache: false,
        beforeSend: function () {

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
        url: contextPath + '/api/Staff/Save',
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


