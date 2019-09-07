@extends('admin.layouts.app')
@section('title')تفاصيل البند
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['بنود'=>'/clauses','اضافه'=>'/clauses/create'])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    <div class="m-section__content">
        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
            <div class="m-demo__preview  m-demo__preview--btn">
                @if(auth()->user()->hasPermissionTo('insert_numbers')&optional(optional($clause->logs->last())->created_at)->toDateString()!=date('Y-m-d'))
                <a href="{{route('admin.clauses.getAddLog',$clause->id)}}" style="color: #FFF;" type="button" class="btn btn-primary">تحديث حالة</a>
                @endif

            </div>
        </div>
    </div>


    <div class="m-section__content">
        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
            <div class="m-portlet__body">

                <div class="col-xs-4">
                    <h5>الاسم</h5>
                    <h3>{{$clause->name}}</h3>
                </div>



                <div class="col-xs-4">
                    <h5>الكمية</h5>
                    <h3>{{$clause->amount}}</h3>
                </div>


                <div class="col-xs-4">
                    <h5>الكمية الإفتراضية</h5>
                    <h3>{{$clause->default_amount}}</h3>
                </div>


                <div class="col-xs-4">
                    <h5>إسم المسؤول</h5>
                    <h3>{{optional($clause->user)->name}}</h3>
                </div>


            </div>
        </div>
    </div>


    {{--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*--}}
    <div class="m-portlet__head-tools">
        <h3>سجل تحديثات البند</h3>
    </div>

    <table class="table table-striped- table-bordered table-hover table-checkable" >
        <thead>
        <tr>
            <th>#</th>
            <th>التحديث بواسطة</th>
            <th>الكمية</th>
            <th>التاريخ</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clause->logs as $log)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$log->user->name}}</td>
                <td>{{$log->amount}}</td>
                <td>{{$log->created_at->format('Y-m-d')}}</td>
            </tr>
        @endforeach

        </tbody>

    </table>






@endsection


@section('scripts')
@endsection
