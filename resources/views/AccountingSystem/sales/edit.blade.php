@extends('AccountingSystem.layouts.master')
@section('title', ' تعديل الفاتوره')
@section('parent_title', 'إدارة نقطه البيع')
@section('action', URL::route('accounting.categories.index'))
@section('styles')
    <!--- start datatable -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet"
        type="text/css">
    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css
                        " rel="stylesheet" type="text/css">
    <!--- end datatable -->
    <link href="{{ asset('admin/assets/css/jquery.datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/bill.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/customized.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div id="container">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <a href="#" class="btn btn-success bill-cogs go-to-full" id="enlarge-scr">
                        <div class="fullscreen-icon" onclick="toggleFullscreen()">
                            <div class="square  square-1--expand" id="square-1">
                                <div class="triangle triangle-1"></div>
                            </div>
                            <div class="square  square-2--expand" id="square-2">
                                <div class="triangle triangle-2"></div>
                            </div>
                            <div class="square  square-3--expand" id="square-3">
                                <div class="triangle triangle-3"></div>
                            </div>
                            <div class="square  square-4--expand" id="square-4">
                                <div class="triangle triangle-4"></div>
                            </div>
                        </div>
                    </a>
                    نقطة البيع
                    <b class="time-r" id="theTime"></b>
                </h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                {{ Form::model($sale, ['method' => 'put', 'route' => ['accounting.sales.update', $sale->id]]) }}
                <div class="form-group block-gp col-md-4 col-sm-4 col-xs-12">
                    <label> إسم العميل: </label>
                    {!! Form::select('client_id', $clients, null, ['class' => 'selectpicker form-control inline-control', 'data-live-search' => 'true', 'id' => 'client_id']) !!}
                </div>
                <div class="text-center col-md-12">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">حفظ <i
                                class="icon-arrow-left13 position-right"></i></button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
