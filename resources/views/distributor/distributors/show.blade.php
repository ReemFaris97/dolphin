@extends('distributor.layouts.app')
@section('title')
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['المندوبين'=>'/distributor',$user->name =>'#'])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{$user->name}}
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">

                <li class="m-portlet__nav-item"></li>

            </ul>
        </div>
    </div>
    <div class="m-portlet__body">
        <table class="table  table-responsive-sm table-bordered  table-hover " id="m_table_1">
<thead>
    <tr>
        <th> المعلومه</th>
        <th> القيمه</th>
        </tr>
    </thead>
            <tbody>
                <tr>
                    <td>الاسم</td>
                    <td>{{$user->name}}</td>
                </tr>
                <tr>
                    <td>الهاتف</td>
                    <td>{{$user->phone}}</td>
                </tr>
                <tr>
                    <td>البريد الالكترونى</td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td>الوظيفه</td>
                    <td>{{$user->job}}</td>
                </tr>
                <tr>
                    <td>الجنسيه</td>
                    <td>{{$user->nationality}}</td>
                </tr>
                <tr>
                    <td>اسم الشركه</td>
                    <td>{{$user->company_name}}</td>
                </tr>
                <tr>
                    <td>تاريخ اخر تواجد</td>
                    <td>{{optional($user->last_location->updated_at)->format('Y-m-d h:i A')}}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

@if(!!$user->last_location)
@include('distributor.distributors._map', ['lat'=>$user->last_location->lat,'lng'=>$user->last_location->lng]);
@endif
@endsection


@section('scripts')
@endsection
