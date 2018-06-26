var table = $('#list-datatable');
$(document).ready(function () {
    initialDataTable(true);
});



function initialDataTable(initial) {
    if (!initial) {
        table.destroy();
        table = $('#list-datatable');
    }
    $.ajax({
        type: 'POST',
        url: contextPath + '/api/Staff/InquiryStaff',
        dataType: 'json',
        cache: false,
        beforeSend: function () {
            blockui_always();
        },
        success: function (res) {
            var jsonColumn = [{
                    field: "id",
                    title: "#",
                    width: 50,
                    sortable: false,
                    textAlign: 'center',
                    selector: {
                        class: 'm-checkbox--solid m-checkbox--brand'
                    }
                }, {
                    field: "s_username",
                    title: L.lb.username,
                    // sortable: 'desc',
                    width: 80,
                }, {
                    field: "s_firstname",
                    title: L.lb.firstName,
                }, {
                    field: "s_phone",
                    title: L.lb.phoneMobile,
                }, {
                    field: "s_level",
                    title: L.lb.levelUser,
                    template: function (row) {
                        return initialStatusLevel(row.s_level);
                    }
                }, {
                    field: "s_status",
                    title: L.lb.status,
                    width: 120,
//                 sortable: 'desc',
                    template: function (row) {
                        return initialStatusAC(row.s_status);
                    }
                }, {
                    field: "Actions",
                    width: 80,
                    title: L.lb.action,
                    sortable: false,
                    overflow: 'visible',
                    template: function (row, index, datatable) {
                        return initialUpdate(index, 'manage.php', row.id) + initialDelete('/api/Staff/Delete/', row.id);
                    }
                }];



            initialDataTables(table, jsonColumn, res.bean);
            unblockui();

        },
        error: function (data) {
            console.log(data);
        }

    });
}


function cancelAll() {

    cancelAllCheckbox(table, '/api/Staff/DeleteAll/');
}

