<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href={!! asset('dashboard/assets/css/main.css') !!}>
    <link href="{!! asset('dashboard/assets/vendors/base/bill-print.css') !!}" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="container">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        الفاتورة
                    </h3>
                </div>
            </div>
        </div>
        @include('distributor.bills.bill_temp')

    </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('print-all').addEventListener('click', () => {
                    var mywindow = window.open('', 'PRINT');
                    mywindow.document.write('<html>');
                    mywindow.document.write("<link href=\"{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}\" rel=\"icon\"><link href=\"{!! asset('dashboard/assets/vendors/base/bill-print.css') !!}\" rel=\"stylesheet\">")
                    mywindow.document.write('<body >');
                    mywindow.document.write(document.getElementById('print_this').innerHTML);
                    mywindow.document.write('</body></html>');
                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10*/
                    setTimeout(function() {
                        mywindow.print();
                        mywindow.document.close();
                    })
                    return true;
                });
            })
        </script>

</body>

</html>
