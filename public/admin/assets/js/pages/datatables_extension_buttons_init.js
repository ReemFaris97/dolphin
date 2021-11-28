/* ------------------------------------------------------------------------------
*
*  # Buttons extension for Datatables. Init examples
*
*  Specific JS code additions for datatable_extension_buttons_init.html page
*
*  Version: 1.0
*  Latest update: Nov 9, 2015
*
* ---------------------------------------------------------------------------- */

$(function () {

    $("#print-all").click(function () {
        let t = document.getElementById('print-window').innerHTML;
        let style = `<style>.datatable-header , .datatable-footer{display: none !important;visibility: hidden !important}
					 html , body , table {direction : rtl !important}table {width: 100%; font-size: 17px;} table .td-display-none{display:none!important}
table, th, td {border: solid 1px #DDD; border-collapse: collapse;padding: 2px 3px;text-align: center;}
td.company-imgg-td span {
    display: block;
    width: 100% !important;
    text-align: center;
margin-top : 10px
}
</style>
`;
        let win = window.open('', '', 'height=700,width=700');
        win.document.write(`<html><head><title>التقرير</title>${style}</head><body>${t}</body></html>`);
        win.document.close();
        win.print();
    })




    // Table setup
    // ------------------------------

    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Filter:</span> _INPUT_',
            searchPlaceholder: 'Type to filter...',
            lengthMenu: '<span>Show:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&larr;', 'previous': '&rarr;' }
        }
    });

    var table = $('.datatable-button-init-basic');
    var tableOptions = {
        'bPaginate': true,
        buttons: {
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                { extend: 'copy', footer: true },
                { extend: 'csv', footer: true },
                { extend: 'excel', footer: true },
                { extend: 'pdf', footer: true },
                { extend: 'print', footer: true, header: true }
            ]
        }
    };
    table.DataTable(tableOptions);
    $('#print-all').on('click', function () {
        table.DataTable().destroy()
        tableOptions.bPaginate = false;
        table.DataTable(tableOptions);
    });


    // Basic initialization
    //    $('.datatable-button-init-basic').DataTable({
    //        buttons: {
    //            dom: {
    //                button: {
    //                    className: 'btn btn-default'
    //                }
    //            },
    //            buttons: [
    //                {extend: 'copy', footer: true},
    //                {extend: 'csv', footer: true},
    //                {extend: 'excel', footer: true},
    //                {extend: 'pdf', footer: true},
    //                {extend: 'print', footer: true , header : true}
    //            ]
    //        }
    //    });


    // Custom button
    $('.datatable-button-init-custom').DataTable({
        buttons: [
            {
                text: 'Custom button',
                className: 'btn bg-teal-400',
                action: function (e, dt, node, config) {
                    swal({
                        title: "Good job!",
                        text: "Custom button activated",
                        confirmButtonColor: "#66BB6A",
                        type: "success"
                    });
                }
            }
        ]
    });


    // Buttons collection
    $('.datatable-button-init-collection').DataTable({
        buttons: [
            {
                extend: 'collection',
                text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                className: 'btn bg-blue btn-icon',
                buttons: [
                    {
                        text: 'Toggle first name',
                        action: function (e, dt, node, config) {
                            dt.column(0).visible(!dt.column(0).visible());
                        }
                    },
                    {
                        text: 'Toggle status',
                        action: function (e, dt, node, config) {
                            dt.column(-2).visible(!dt.column(-2).visible());
                        }
                    }
                ]
            }
        ]
    });


    // Page length
    $('.datatable-button-init-length').DataTable({
        dom: '<"datatable-header"fB><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            {
                extend: 'pageLength',
                className: 'btn bg-slate-600'
            }
        ]
    });



    // External table additions
    // ------------------------------

    // Enable Select2 select for the length option
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        width: 'auto'
    });

});
