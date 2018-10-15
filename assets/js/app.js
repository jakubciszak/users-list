const $ = require('jquery');
require('bootstrap');
require('datatables.net-dt');
require('../css/app.scss');

$(document).ready(function() {
    $('#users-table').DataTable({
        "serverSide": true,
        "processing": true,
        "paging": true,
        "searching": false,
        "pageLength": 3,
        "ajax":  "/api/users",
        "columnDefs": [
            {
                "render": function ( data, type, row ) {
                    return '<img src="' + data + '" />';
                },
                "targets": 1
            }
        ],
        "columns": [
            { "data": "id" },
            { "data": "avatar"},
            { "data": "first_name" },
            { "data": "last_name" }
        ]
    });
});
