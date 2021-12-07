@extends('AccountingSystem.layouts.master')
@section('title','تقرير حركه البيع')
@section('parent_title','التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    .filter {
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير حركه البيع</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <section class="filter">
                <div class="yurSections">
                    <div class="row">
                        <div class="col-xs-12">
                            <form action="" method="post" accept-charset="utf-8">
                                @csrf
                            <div class="form-group col-sm-3">
                                <label> الكاشير </label>
                                {!! Form::select("user_id",$sellers, request('user_id'),['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'user_id'])!!}
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="from_date"> من </label>
                                {!! Form::date("from_date",request('from_date'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from_date'])!!}
                            </div>
                                <div class="form-group col-sm-3">
                                    <label for="to"> الى </label>
                                    {!! Form::date("to_date",request('to_date'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'to_date'])!!}
                                </div>

                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-success btn-block">بحث</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
if(request()->method()=='post')
<div id="print-window">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th> التاريخ </th>
                    <th> إجمالي تكلفة الاصناف المباعة كمشتريات </th>
                    <th> إجمالي المببيعات </th>
                    <th> إجمالي الخصومات </th>
                    <th> إجمالي  الربح</th>
                    <th class="td-display-none"> عرض</th>
                </tr>
                </thead>
                <tbody>
                    <tr>

                    </tr>

                </tbody>

            </table>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" defer></script>
<script>
// $('.inlinedatepicker').datepicker({
//     format: 'yyyy-mm-dd',
// });


</script>
@endsection
