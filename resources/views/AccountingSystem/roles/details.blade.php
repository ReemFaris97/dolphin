@extends('admin.layout.master')
@section('title',$user->name)


{{--@section('styles')--}}
    {{--<style>--}}
        {{--.dataTables_filter, .dataTables_info, .pagination { display: none; }--}}
    {{--</style>--}}
    {{--<style type="text/css" media="print">--}}
        {{--.prevent, .no-print,.dt-buttons,.dataTables_filter,.dataTables_info,.pagination { display: none; }--}}
    {{--</style>--}}
{{--@endsection--}}
@section('content')
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-right m-t-15">
                <button onclick="window.history.back();"  class="no-print btn btn-custom dropdown-toggle waves-effect waves-light">
                    رجوع
                    <span class="m-l-5"><i class="fa fa-arrow-left"></i></span>
                </button>

            </div>

            <h4 class="page-title">تفاصيل المستخدم: {{$user->name}}</h4>
        </div>
    </div><!--End Page-Title -->


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h3 class="header-title m-t-0 m-b-30">بيانات المستخدم : {{$user->name}}</h3>
                {{--<button onclick="window.print();"  class="no-print btn btn-custom dropdown-toggle waves-effect waves-light">--}}
                    {{--طباعة تقرير كامل--}}
                    {{--<span class="m-l-5"><i class="fa fa-print"></i></span>--}}
                {{--</button>--}}
                <div class="row">
                    <div class="col-sm-12">


                        <div class="col-md-4">
                            <h4>الإسم:</h4>
                            <h5 style="font-weight: 600;">{{$user->name}}</h5>
                        </div>

                        {{--<div class="col-md-4">--}}
                            {{--<h4>البريد الإلكتروني:</h4>--}}
                            {{--<h5 style="font-weight: 600;">{{$user->email}}</h5>--}}
                        {{--</div>--}}


                        <div class="col-md-4">
                            <h4>رقم الجوال:</h4>
                            <h5 style="font-weight: 600;">{{$user->phone}}</h5>
                        </div>

                        <div class="col-md-4">
                            <h4>العنوان:</h4>
                            <h5 style="font-weight: 600;">{{$user->address}}</h5>
                        </div>



                        <div class="col-md-4">
                            <h4>الحالة</h4>
                            @if($user->is_active ==1)
                                <h5 style="font-size: 15px;" class="label label-success">مفعل</h5>
                            @else
                                <h5 style="font-size: 15px;"  class="label label-danger">غير مفعل</h5>
                            @endif
                        </div>


                        @if($user->is_active == 0)
                            <div class="col-md-4">
                                <h4>سبب الحظر</h4>
                                <h5 style="font-weight: 600;">{{$user->suspend_reason}}</h5>
                            </div>
                        @endif



                        <div class="col-md-4">
                            <h4>الصورة الشخصية</h4>
                            <div  style="width: 200px; height: 150px;">
                                @if($user->image)
                                    <a href="{{getimg($user->image)}}" class="image-popup" title="Screenshot-1">
                                        <img width="200" height="150" src="{{getimg($user->image)}}" class="thumb-img" alt="work-thumbnail">
                                    </a>
                                @else
                                    <a href="{{asset('admin/assets/images/noimage.png')}}" class=" image-popup" title="Screenshot-1">
                                        <img width="200" height="150" src="{{asset('admin/assets/images/noimage.png')}}" class="thumb-img" alt="work-thumbnail">
                                    </a>
                                @endif
                            </div>
                        </div>

                    </div>
                </div> <!--End of row-->

            </div>
        </div>
    </div>
@endsection
