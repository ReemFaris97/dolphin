@extends('distributor.layouts.app')
@section('title')
    تقرير كشف حساب عميل
@endsection

@section('breadcrumb') @php($breadcrumbs=[' تقرير الفواتير'=>route('distributor.reports.billsReport'),])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">

        <div class="m-portlet__body">
            <div class="row">
                <div class="col-12 ">
                    <form class="form-horizontal" method="get"
                          action="{{route('distributor.reports.billsReport')}}">
                        <div class="form-group row ">
                            <div class="col-12 col-md-6">
                                <label class="  control-label">اختر العميل </label>
                                {!! Form::select('client_id',clients(), request('client_id'),['class' =>'form-control select2'.($errors->has('client_id') ? ' is-invalid' : null),'placeholder'=>'اختر العميل '  ]) !!}
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="  control-label">اختر المندوب </label>
                                {!! Form::select('user_id',users(), request('user_id'),['class' =>'form-control select2'.($errors->has('user_id') ? ' is-invalid' : null) ,'placeholder'=>'اختر المندوب ' ]) !!}
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="  control-label">من تاريخ </label>
                                <input type="date" class="form-control"
                                       placeholder="mm/dd/yyyy" name="from" value="{{request('from')}}">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="  control-label"> الى تاريخ </label>
                                <input type="date" class="form-control"
                                       placeholder="mm/dd/yyyy" name="to" value="{{request('to')}}">
                            </div>
                        </div>

                        <div class="row text-center">
                            <div class="form-group row text-center col-12 col-md-6">
                                <button type="submit"
                                        class="btn btn-success btn-block col-12 waves-effect waves-light ">
                                    بحث
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{route('distributor.reports.billsReport')}}"
                                   class="form-control btn btn-dark text-white"> الغاء الفلتر</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <p class="display-1">الاجمالى : {{number_format($total,2)}}</p>
            {!!  $dataTable->table()!!}

        </div>
    </div>
@endsection
@push('scripts')

    {!!$dataTable->scripts()  !!}
@endpush

