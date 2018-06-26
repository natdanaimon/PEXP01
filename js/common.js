

var map;
var mapModal;
var markers = [];
var markersModal = [];
var infowindow;
var infowindowModal;
var messagewindow;
var infowindowContent;
var infowindowContentModal;




var longtime = 1000;
var statusAC = {
    'P': {
        'title': L.status.pending,
        'class': 'm-badge--brand'
    },
    'A': {
        'title': L.status.active,
        'class': ' m-badge--success'
    },
    'C': {
        'title': L.status.cancel,
        'class': ' m-badge--danger'
    }
};

var statusLevel = {
    'S': {
        'title': L.statusLevel.S,
        'class': 'm-badge--brand'
    },
    'N': {
        'title': L.statusLevel.N,
        'class': ' m-badge--success'
    }
};




var tFile = {
    "jpg": {
        'src': contextPath + '/image/tFile/jpg.png'
    },
    "pdf": {
        'src': contextPath + '/image/tFile/pdf.png'
    },
    "png": {
        'src': contextPath + '/image/tFile/png.png'
    },
    "ppt": {
        'src': contextPath + '/image/tFile/ppt.png'
    },
    "txt": {
        'src': contextPath + '/image/tFile/txt.png'
    },
    "xls": {
        'src': contextPath + '/image/tFile/xls.png'
    },
    "xlsx": {
        'src': contextPath + '/image/tFile/xls.png'
    },
    "xml": {
        'src': contextPath + '/image/tFile/xml.png'
    },
    "zip": {
        'src': contextPath + '/image/tFile/zip.png'
    },
    "rar": {
        'src': contextPath + '/image/tFile/zip.png'
    },
    "object": {
        'src': contextPath + '/image/tFile/object.png'
    }
};

function isSuccess(data) {
    if (data != '') {
        data = convertString2Json(data);
        if (data.statusCode == "0") {
            return true;
        }
    }
    return false;
}




function blockui_always() {

    mApp.blockPage({
        overlayColor: '#000000',
        type: 'loader',
        state: 'success',
        message: 'Please wait...'
    });
}

function blockui() {

    mApp.blockPage({
        overlayColor: '#000000',
        type: 'loader',
        state: 'success',
        message: 'Please wait...'
    });

    setTimeout(function () {
        mApp.unblockPage();
    }, longtime);

}

function unblockui() {

    setTimeout(function () {
        mApp.unblockPage();
    }, longtime);

}

function convertString2Json(data) {
    if (typeof data == "string") {
        return JSON.parse(data);
    } else {
        return data;
    }
}



function notify(data) {
    if (data != '') {
        $('[data-switch=true]').bootstrapSwitch();
        data = convertString2Json(data);
        var content = {};
        var color = "";



        content.title = L.titleNotify.message01;
        if (data.statusCode == "0") {

            content.message = data.statusDesc;
            content.icon = 'icon ' + 'la la-check-circle';
            color = 'success';
        } else {
            content.message = data.statusDesc;
            content.icon = 'icon ' + 'la la-times-circle';
            color = 'danger';
        }
        var notify = $.notify(content, {
            type: color,
            allow_dismiss: true,
            newest_on_top: false,
            mouse_over: true,
            showProgressbar: false,
            spacing: 10,
            timer: 2000,
            placement: {
                from: 'top',
                align: 'center'
            },
            offset: {
                x: 30,
                y: 30
            },
            delay: 100,
            z_index: 10000,
            animate: {
                enter: 'animated ' + 'rubberBand',
                exit: 'animated ' + 'flash'
            }
        });

    } else {
        console.log("Response is null");
    }





}


function notifyErrorOnly(data) {
    if (data != '') {
        $('[data-switch=true]').bootstrapSwitch();
        data = convertString2Json(data);
        var content = {};
        var color = "";

        if (data.statusCode != "0") {

            content.title = L.titleNotify.message01;
            content.message = data.statusDesc;
            content.icon = 'icon ' + 'la la-times-circle';
            color = 'danger';

            var notify = $.notify(content, {
                type: color,
                allow_dismiss: true,
                newest_on_top: false,
                mouse_over: true,
                showProgressbar: false,
                spacing: 10,
                timer: 2000,
                placement: {
                    from: 'top',
                    align: 'center'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 100,
                z_index: 10000,
                animate: {
                    enter: 'animated ' + 'rubberBand',
                    exit: 'animated ' + 'flash'
                }
            });

        }




    } else {
        console.log("Response is null");
    }





}

function reloadTime() {
    location.reload();
//    unblockui();
}




function notifyInfo(data) {
    blockui_always();
    if (data != '') {
        $('[data-switch=true]').bootstrapSwitch();
        var content = {};
        var color = "";
        content.title = L.titleNotify.message02;
        content.message = data;
        content.icon = 'icon ' + 'la la-info-circle';
        color = 'info';

        var notify = $.notify(content, {
            type: color,
            allow_dismiss: true,
            newest_on_top: false,
            mouse_over: true,
            showProgressbar: false,
            spacing: 10,
            timer: 2000,
            placement: {
                from: 'top',
                align: 'center'
            },
            offset: {
                x: 30,
                y: 30
            },
            delay: 100,
            z_index: 10000,
            animate: {
                enter: 'animated ' + 'rubberBand',
                exit: 'animated ' + 'flash'
            }
        });

    } else {
        console.log("data is null");
    }





}


function notifyDelComment(url, id) {
    $('[data-switch=true]').bootstrapSwitch();

    var color = "";
    var content = {};
    content.icon = 'icon ' + 'la la-info-circle';
    content.title = L.titleNotify.message03;
    content.message = L.btn.delete;


    var notify = $.notify(content, {
        element: '#comment_' + id,
        position: 'relative',
        type: 'danger',
        spacing: 1,
        timer: 3000,
        delay: 10,
        z_index: 10000,
        placement: {
            from: "top",
            align: "right"
        },
        animate: {
            enter: 'animated ' + 'pulse',
            exit: 'animated ' + 'pulse'
        },
        icon_type: 'class',
        template: '<a href=\'javascript:callAjaxRefreshComment("' + url + '","' + id + '");\' onclick="javascript:unblockui();" id="a_comment_' + id + '" class="css_comment" style="text-decoration: none;"><div id="tmp-noti" data-notify="container" class="alert alert-{0}" role="alert" ' +
                'style="min-width: 1px;min-height: 1px;line-height:0.0;padding:0.62rem 0.6rem;">' +
                '<span data-notify="message">{2} ' +
                '<div>' +
                '</div>' +
                '</div></a>'
    });

}

function notifyDelComment2Param(url, id, type) {
    $('[data-switch=true]').bootstrapSwitch();

    var color = "";
    var content = {};
    content.icon = 'icon ' + 'la la-info-circle';
    content.title = L.titleNotify.message03;
    content.message = L.btn.delete;


    var notify = $.notify(content, {
        element: '#comment_' + id,
        position: 'relative',
        type: 'danger',
        spacing: 1,
        timer: 300000,
        delay: 10,
        z_index: 10000,
        placement: {
            from: "top",
            align: "right"
        },
        animate: {
            enter: 'animated ' + 'pulse',
            exit: 'animated ' + 'pulse'
        },
        icon_type: 'class',
        template: '<a href=\'javascript:callAjaxRefreshComment2Param("' + url + '","' + id + '","' + type + '");\' onclick="javascript:unblockui();" id="a_comment_' + id + '" class="css_comment" style="text-decoration: none;"><div id="tmp-noti" data-notify="container" class="alert alert-{0}" role="alert" ' +
                'style="min-width: 30px;min-height: 1px;line-height:0.0;padding:0.62rem 0.6rem;">' +
                '<span data-notify="message">{2} ' +
                '<div>' +
                '</div>' +
                '</div></a>'
    });

}

function callAjaxRefreshComment(url, id) {


    $.ajax({
        type: 'GET',
        url: contextPath + url + id,
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (data) {
            inquiryComment();
        },
        error: function (data) {

            console.log(data);
        }

    });
}


function callAjaxRefreshComment2Param(url, id, type) {


    $.ajax({
        type: 'GET',
        url: contextPath + url + id + "/" + type,
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (data) {
            inquiryActivityComment();
        },
        error: function (data) {

            console.log(data);
        }

    });
}




function notifyConfirm(url, id) {
    $('[data-switch=true]').bootstrapSwitch();

    var color = "";
    var content = {};
    content.title = L.titleNotify.message03;
    content.message = L.titleNotify.message04;
    content.icon = 'icon ' + 'la la-info-circle';

    var notify = $.notify(content, {
// type: 'warning',
        type: 'info',
        allow_dismiss: true,
        newest_on_top: true,
        mouse_over: true,
        showProgressbar: false,
        preventDuplicates: true,
        spacing: 1,
        timer: 1,
        placement: {
            from: 'top',
            align: 'center'
        },
        offset: {
            x: 30,
            y: 30
        },
        delay: 600000,
        z_index: 10000,
        animate: {
            enter: 'animated ' + 'rubberBand',
            exit: 'animated ' + 'flash'
        },
        icon_type: 'class',
        template: '<div id="tmp-noti" data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button id="close-noti" type="button" aria-hidden="true" class="close" data-notify="dismiss" onclick="javascript:unblockui();"></button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2} ' +
// '&nbsp;&nbsp;&nbsp;&nbsp; <button style="background-color: #45aaf8;color:
// white;" class="btn info"
// onclick=\'javascript:callAjaxRefreshTableMain(\"'+url+'\",\"'+id+'\");closeNoti();\'>'+txtConfirm+'</button></span>'
// +
                '&nbsp;&nbsp;&nbsp;&nbsp; <button style="background-color: #f44e16;color: white;" class="btn info" onclick=\'javascript:callAjaxRefreshTableMain(\"' + url + '\",\"' + id + '\");closeNoti();\'>' + L.btn.confirm + '</button></span>' +
                '<div>' +
                '</div>' +
                '</div>'
    });

}


function notifyConfirmFile(url, id) {
    $('[data-switch=true]').bootstrapSwitch();

    var color = "";
    var content = {};
    content.title = L.titleNotify.message03;
    content.message = L.titleNotify.message04;
    content.icon = 'icon ' + 'la la-info-circle';

    var notify = $.notify(content, {

        type: 'info',
        allow_dismiss: true,
        newest_on_top: true,
        mouse_over: true,
        showProgressbar: false,
        preventDuplicates: true,
        spacing: 1,
        timer: 1,
        placement: {
            from: 'top',
            align: 'center'
        },
        offset: {
            x: 30,
            y: 30
        },
        delay: 600000,
        z_index: 10000,
        animate: {
            enter: 'animated ' + 'rubberBand',
            exit: 'animated ' + 'flash'
        },
        icon_type: 'class',
        template: '<div id="tmp-noti" data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button id="close-noti" type="button" aria-hidden="true" class="close" data-notify="dismiss" onclick="javascript:unblockui();"></button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">{2} ' +
                '&nbsp;&nbsp;&nbsp;&nbsp; <button style="background-color: #f44e16;color: white;" class="btn info" onclick=\'javascript:callAjaxRefreshTableFile(\"' + url + '\",\"' + id + '\");closeNoti();\'>' + Bundles['txt.script.confirm'] + '</button></span>' +
                '<div>' +
                '</div>' +
                '</div>'
    });

}
function search(nameKey, myArray) {
    for (var i = 0; i < myArray.length; i++) {
        if (myArray[i].name === nameKey) {
            return myArray[i];
        }
    }
}

function notifyError(errorCode) {






    $('[data-switch=true]').bootstrapSwitch();

    var content = {};
    var color = "";
    content.title = L.titleNotify.message01;
    content.message = L['Err'][errorCode];
    content.icon = 'icon ' + 'la la-times-circle';
    color = 'danger';

    var notify = $.notify(content, {
        type: color,
        allow_dismiss: true,
        newest_on_top: false,
        mouse_over: true,
        showProgressbar: false,
        spacing: 10,
        timer: 2000,
        placement: {
            from: 'top',
            align: 'center'
        },
        offset: {
            x: 30,
            y: 30
        },
        delay: 100,
        z_index: 10000,
        animate: {
            enter: 'animated ' + 'rubberBand',
            exit: 'animated ' + 'flash'
        }
    });

}

function notifyWarningClosePopup(text) {
    blockui_always();
    $('[data-switch=true]').bootstrapSwitch();
    var content = {};
    var color = "";
    content.title = L.titleNotify.message02;
    content.message = text;
    content.icon = 'icon ' + 'la la-times-circle';
    color = 'warning';

    var notify = $.notify(content, {
        type: color,
        allow_dismiss: true,
        newest_on_top: false,
        mouse_over: true,
        showProgressbar: false,
        spacing: 10,
        timer: 2000,
        placement: {
            from: 'top',
            align: 'center'
        },
        offset: {
            x: 30,
            y: 30
        },
        delay: 100,
        z_index: 10000,
        animate: {
            enter: 'animated ' + 'rubberBand',
            exit: 'animated ' + 'flash'
        }
    });

    window.setTimeout(window.parent.close, 3000);
}

function closeNoti() {
    $('#tmp-noti').attr('style', 'display:none');
    $('#close-noti').trigger('click');
}


function callAjaxRefreshTableMain(url, id) {
    // close noti confirm id->close-noti
// $('#close-noti').trigger('click');


    $.ajax({
        type: 'GET',
        url: contextPath + url + id,
        dataType: 'json',
        beforeSend: function () {

            blockui_always();


        },
        success: function (data) {

            notify(data);
            initialDataTable(false);
        },
        error: function (data) {

            console.log(data);
        }

    });
}

function callAjaxNormal(url, id) {
    $.ajax({
        type: 'GET',
        url: contextPath + '/' + url + '/' + id,
        dataType: 'json',
        beforeSend: function () {

            blockui_always();

        },
        success: function (data) {

            notify(data);
        },
        error: function (data) {

            console.log(data);
        }

    });
}



function callAjaxRefreshTableFile(url, id) {
    // close noti confirm id->close-noti
// $('#close-noti').trigger('click');


    $.ajax({
        type: 'GET',
        url: contextPath + url + id,
        dataType: 'json',
        beforeSend: function () {

            blockui_always();


        },
        success: function (data) {

            notify(data);
            initialDataTableFile(false);
        },
        error: function (data) {

            console.log(data);
        }

    });
}


function initialDataTables(table, jsonColumn, source) {
    var defaultPageSize = 10;
    initialDataTables(table, jsonColumn, source, defaultPageSize);


}





function initialDataTables(table, jsonColumn, source, pSize) {
    source = (source != null ? source : "null");
    table.mDatatable({
        data: {
            type: 'local',
            source: source,
            pageSize: pSize,
            saveState: {
                cookie: false,
                webstorage: false,
            },
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },
        layout: {
            theme: 'default', // datatable theme
            class: '', // custom wrapper class
            scroll: false, // enable/disable datatable scroll both
            footer: false // display/hide footer
        },
        processing: false,
        sortable: true,
        pagination: true,
        search: {
            input: $("#generalSearch")
        },
        columns: jsonColumn,
    }).load();

    var query = table.getDataSourceQuery();
    $('#m_form_status').on('change', function () {
        table.search($(this).val(), 's_status');
    }).val(typeof query.s_status !== 'undefined' ? query.s_status : '');

    $('#m_form_status').selectpicker();


}

function initialStatusAC(key) {
    return '<span class="m-badge ' + statusAC[key].class + ' m-badge--wide">' + statusAC[key].title + '</span>';
}

function initialStatusLevel(key) {
    return '<span class="m-badge ' + statusLevel[key].class + ' m-badge--wide">' + statusLevel[key].title + '</span>';
}


function initialStatusTimeline(key) {
    return '<span class="m-badge ' + statusTimeline[key].class + ' m-badge--wide">' + statusTimeline[key].title + '</span>';
}

function initialUpdate(index, url, id) {


    return '\
	<a href="javascript:document.formEdit' + index + '.submit()" id="btn-index-edit-by-' + id + '" class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
		<i class="la la-edit"></i>\
	</a>\
	<form action="' + url + '" method="POST" id="formEdit' + index + '" name="formEdit' + index + '" style="display:none;">\
		<input type="hidden" id="id" name="id" value="' + id + '" />\
		<input type="submit" />\
	</form>';
}

function initialUpdateSession(scriptFunctionName, id) {
    return '\
	<a href="javascript:' + scriptFunctionName + '(\'' + id + '\');" class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill" title="Edit ">\
		<i class="la la-edit"></i>\
	</a>\
';
}

function initialDelete(url, id) {


    return '\
	<a href="javascript:notifyConfirm(\'' + url + '\', \'' + id + '\');blockui_always();" id="btn-index-cancel-by-' + id + '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete ">\
    	<i class="la la-trash-o"></i>\
	</a>\
';
}


function initialDeleteFile(url, id) {
    return '\
	<a href="javascript:notifyConfirmFile(\'' + url + '\', \'' + id + '\');blockui_always();" id="btn-index-del-file-by-' + id + '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete ">\
    	<i class="la la-trash-o"></i>\
	</a>\
';
}





function cancelAllCheckbox(table, url) {
// $('#listData').val('');
    if (table.getSelectedRecords().length > 0) {
        var tmp = "";
        for (i = 0; i < table.getSelectedRecords().length; i++) {
            tmp += $('#row-checkbox-' + table.getSelectedRecords()[i].dataset.row).val();
            if (i != (table.getSelectedRecords().length - 1)) {
                tmp += ",";
            }
        }
// $('#listData').val(tmp);
        notifyConfirm(url, tmp);

    } else {
        // กรุณาเลือกข้อมูล
        notifyError(2011);
    }
}

//Formate DD/MM/YYYY
function setDate_DD_MM_YYYY(dateStr) {
    var dateStrList = dateStr.split('/');

    if (dateStrList[2] > 2500) {
        dateStrList[2] = dateStrList[2] - 543;
    }

    var mydate = new Date(dateStrList[2], dateStrList[1] - 1, dateStrList[0]);

    return mydate;
}

//Formate DD/MM/YYYY *** convert date to String (dd/MM/yyyy)
function getDate_DD_MM_YYYY(inputFormat) {
    function pad(s) {
        return (s < 10) ? '0' + s : s;
    }
    var d = new Date(inputFormat);
    return [pad(d.getDate()), pad(d.getMonth() + 1), d.getFullYear()].join('/');
}


function removeFormatCurrency(idName) {
    var valueId = replaceFormatCurrency($("#" + idName).val(), ',', '');
    $("#" + idName).val(valueId);
}


function setFormatCurrency(idName) {
    var valueId = replaceFormatCurrency($("#" + idName).val(), ',', '');
    $("#" + idName).val(number_format(parseFloat(valueId), 2));
}

function replaceFormatCurrency(str, find, replace) {
    var i = str.indexOf(find);
    if (i > -1) {
        str = str.replace(find, replace);
        i = i + replace.length;
        var st2 = str.substring(i);
        if (st2.indexOf(find) > -1) {
            str = str.substring(0, i) + replaceFormatCurrency(st2, find, replace);
        }
    }
    return str;
}

