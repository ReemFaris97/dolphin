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
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="true">الحساب</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link " id="routes-tab" data-toggle="tab" href="#routes" role="tab"
                       aria-controls="routes" aria-selected="false">المسارات</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">
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
                    @if(!!$user->last_location)
                        @include('distributor.distributors._map', ['lat'=>$user->last_location->lat,'lng'=>$user->last_location->lng])

                    @endif
                </div>
                <div class="tab-pane fade " id="routes" role="tabpanel" aria-labelledby="routes-tab">
                    @include('distributor.routes._table',['routes'=>$user->routes])


                </div>
            </div>


        </div>
    </div>


@endsection


@section('scripts')
@endsection
