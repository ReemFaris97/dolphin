var DatatablesExtensionButtons = function () {

    var language = {
        "sEmptyTable": "ليست هناك بيانات متاحة في الجدول",
        "sLoadingRecords": "جارٍ التحميل...",
        "sProcessing": "جارٍ التحميل...",
        "sLengthMenu": "أظهر _MENU_ مدخلات",
        "sZeroRecords": "لم يعثر على أية سجلات",
        "sInfo": "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
        "sInfoEmpty": "يعرض 0 إلى 0 من أصل 0 سجل",
        "sInfoFiltered": "(منتقاة من مجموع _MAX_ مُدخل)",
        "sInfoPostFix": "",
        "sSearch": "ابحث:",
        "sUrl": "",
        "oPaginate": {
            "sFirst": "الأول",
            "sPrevious": "السابق",
            "sNext": "التالي",
            "sLast": "الأخير"
        },
        "oAria": {
            "sSortAscending": ": تفعيل لترتيب العمود تصاعدياً",
            "sSortDescending": ": تفعيل لترتيب العمود تنازلياً"
        }
    };

    var initTable1 = function () {

        // begin first table
        $('#m_table_1 tfoot th').each(function () {
            var title = $('#m_table_1 thead th').eq($(this).index()).text();
            if ($(this).hasClass('filter')) {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" style="height: auto" />');
            }
        });
        var table = $('#m_table_1').DataTable({
            responsive: true,
            //== Pagination settings
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            language: language,
            buttons: [
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: "thead th:not(.noExport)"
                    }
                }
                //'copy', 'excel', 'csv', 'print' // , 'pdf' - Wait for next PDFMake release because of this bug https://github.com/bpampuch/pdfmake/pull/443
            ],

        });
        table.columns().every(function () {
            var column = this;
            $('input', this.footer()).on('keyup change', function () {
                column
                    .search(this.value)
                    .draw();
            });
        });

    };
    var initTable3 = function () {

        // begin first table
        var table = $('.datatable').DataTable({
            responsive: true,
            //== Pagination settings
            dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
            language: language,

            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'print',
            ],

        });

    };

    var initTable2 = function () {

        // begin first table
        var table = $('#m_table_2').DataTable({
            responsive: true,

            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'print',
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: 'https://keenthemes.com/metronic/themes/themes/metronic/dist/preview/inc/api/datatables/demos/server.php',
                type: 'POST',
                data: {
                    // parameters for custom backend script demo
                    columnsDef: [
                        'OrderID', 'Country', 'ShipCity',
                        'ShipAddress', 'CompanyAgent', 'CompanyName', 'Status', 'Type',],
                },
            },
            columns: [
                {data: 'OrderID'},
                {data: 'Country'},
                {data: 'ShipCity'},
                {data: 'ShipAddress'},
                {data: 'CompanyAgent'},
                {data: 'CompanyName'},
                {data: 'Status'},
                {data: 'Type'},
            ],
            columnDefs: [
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        var status = {
                            1: {'title': 'Pending', 'class': 'm-badge--brand'},
                            2: {'title': 'Delivered', 'class': ' m-badge--metal'},
                            3: {'title': 'Canceled', 'class': ' m-badge--primary'},
                            4: {'title': 'Success', 'class': ' m-badge--success'},
                            5: {'title': 'Info', 'class': ' m-badge--info'},
                            6: {'title': 'Danger', 'class': ' m-badge--danger'},
                            7: {'title': 'Warning', 'class': ' m-badge--warning'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="m-badge ' + status[data].class + ' m-badge--wide">' + status[data].title + '</span>';
                    },
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        var status = {
                            1: {'title': 'Online', 'state': 'danger'},
                            2: {'title': 'Retail', 'state': 'primary'},
                            3: {'title': 'Direct', 'state': 'accent'},
                        };
                        if (typeof status[data] === 'undefined') {
                            return data;
                        }
                        return '<span class="m-badge m-badge--' + status[data].state + ' m-badge--dot"></span>&nbsp;' +
                            '<span class="m--font-bold m--font-' + status[data].state + '">' + status[data].title + '</span>';
                    },
                },
            ],
        });

        $('#export_copy').on('click', function (e) {
            e.preventDefault();
            table.button(0).trigger();
        });

        $('#export_excel').on('click', function (e) {
            e.preventDefault();
            table.button(1).trigger();
        });

        $('#export_csv').on('click', function (e) {
            e.preventDefault();
            table.button(2).trigger();
        });
        /*

                $('#export_pdf').on('click', function(e) {
                    e.preventDefault();
                    table.button(3).trigger();
                });
        */

    };

    return {

        //main function to initiate the module
        init: function () {
            initTable1();
            initTable2();
            initTable3();
        },

    };

}();

jQuery(document).ready(function () {
    DatatablesExtensionButtons.init();
});

//fix tabs issue
$("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
    $($.fn.dataTable.tables(true)).DataTable()
        .responsive.recalc();
});
