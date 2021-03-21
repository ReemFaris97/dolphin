@extends('AccountingSystem.layouts.master')
@section('title',' عرض القالب ')
@section('parent_title','إدارة القوالب')

@section('action', URL::route('accounting.templates.index'))
@section('styles')
<style>
    .aligne-center {
        text-align: center;
    }

    .content-header h4,
    .content-header p {
        font-weight: bold;
        margin-bottom: 0;
    }

    .flex-p {
        display: flex;
        justify-content: space-between;
    }

    body {
        direction: rtl;
        padding: 5px 20px;
    }

    .content-body p {
        margin: 2px;
    }

    .content-body {
        margin-top: 15px;
    }

    .content-body {
        font-size: 16px;
    }

    .div-content-button {
        padding: 10px 0;
        text-align: center;
    }

    .content-body {
        font-size: 18px;
    }

    .div-content-button button {
        font-size: 18px;
    }

    @media print {
        body {
            height: 99%;
        }
    }
</style>
@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> عرض بيانات القالب </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">

        <div class="content" id="printableArea">
            <div class="content-header aligne-center">
                <h4>قائمة الدخل</h4>
                <p>شركة أ ب ج</p>
                <p>قائمة الدخل عن السنة المالية المنتهية في 31 ديسمبر 2005</p>
            </div>
            <div class="content-body">
                <div class="flex-p">
                    <div>
                        <p>المبيعات</p>
                    </div>
                    <div>
                        <p>2005</p>
                    </div>
                </div>
                <div class="flex-p">
                    <div>
                        <p>تكلفة المبيعات</p>
                    </div>
                    <div>
                        <p>2005</p>
                    </div>
                </div>
                <div class="flex-p">
                    <div>
                        <hr>
                        <p>تكلفة المبيعات</p>
                    </div>
                    <div>
                        <hr>
                        <p>2005</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="div-content-button">
        <button class="btn btn-success" type="button" onclick="printDiv('printableArea')">طباعة</button>
    </div>


    @endsection

    @section('scripts')

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
    @stop