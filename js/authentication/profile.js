$(document).ready(function () {
    level();
});






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
            }
            $('#level').val(selectLevel);
            unblockui();
        },
        error: function (data) {
            console.log(data);
        }

    });
}

















function save() {

    var jsonData = $("#form-action").serialize()

    $.ajax({
        type: 'POST',
        url: contextPath + '/api/Authen/UpdateProfile',
        data: jsonData,
        dataType: 'json',
        cache: false,
        beforeSend: function () {
            blockui_always();
        },
        success: function (data) {

            notify(data);
            if (isSuccess(data)) {
                var fullname = data.bean[0].s_firstname + " " + data.bean[0].s_lastname;
                $('#m-card-profile__name').text(fullname);
                $('#m-card-profile__name_header').text(fullname);
                $('#profile__email_header').text(data.bean[0].s_email)
            }



            unblockui();


        },
        error: function (data) {
            console.log(data);
        }

    });
}


function changepassword() {

    var jsonData = $("#form-action-password").serialize()

    $.ajax({
        type: 'POST',
        url: contextPath + '/api/Authen/ChangePassword',
        data: jsonData,
        dataType: 'json',
        cache: false,
        beforeSend: function () {
            blockui_always();
        },
        success: function (data) {
            notify(data);
            if (isSuccess(data)) {
                $('#s_password_old').val('');
                $('#s_password_new').val('');
                $('#s_password_confirm').val('');
            }
            unblockui();
        },
        error: function (data) {
            console.log(data);
        }

    });
}


function clearChangePassword() {
    $('#s_password_old').val('');
    $('#s_password_new').val('');
    $('#s_password_confirm').val('');
    blockui();
}



function editProfile() {
    //    document.getElementById('file').click();
    $("#file").click();
}

$('input[type=file]').change(function () {

    var vals = $(this).val(),
            val = vals.length ? vals.split('\\').pop() : '';
    $("#upfile").submit();

});

//$("#file").on('change', function () {
//    $("#upfile").submit();
//}).click();

function checkForm(form) {
    if ($("#file").val() == "") {
        return false;
    }
}


$('#upfile').submit(function (e) {

    e.preventDefault();
    var formData = new FormData($("upfile")[0]);
    formData.append('func', 'import');
    formData.append('file', $('input[type=file]')[0].files[0]);
    $.ajax({
        type: 'POST',
        url: contextPath + '/api/Authen/UploadProfile/'+ makeid(),
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            blockui_always();
        },
        success: function (data) {
            debugger;
            $("#file").val("");
            data = convertString2Json(data);
            notify(data);

            console.log("old : " + $("#img-profile-3")[0].src);

            if (isSuccess(data)) {
                var key = makeid();
                $('#img-profile-1').attr('src', '../../assets/image/profile/' + data.bean + "?" + key);
                $('#img-profile-2').attr('src', '../../assets/image/profile/' + data.bean + "?" + key);
                $('#img-profile-3').attr('src', '../../assets/image/profile/' + data.bean + "?" + key);
            }
            console.log("new : " + $("#img-profile-3")[0].src);
            unblockui();
        },
        error: function (data) {
//            $("#file").val("");
        }
    });


});


function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}