@extends('AccountingSystem.layouts.master')

@section('parent_title','إدارة  الاعدادت')
{{-- @section('action', URL::route('accounting.products.index')) --}}
@section('title',$settings_page)

@section('styles')
    {{-- <link href="{{asset('admin/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" /> --}}
@endsection
@section('content')
    <form action="{{route('accounting.settings.store')}}" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- Page-Title -->


                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title"> اعدادت {{$settings_page}}</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>
                <div class="panel-body">
                    {{-- <div class="col-lg-8 col-lg-offset-2"> --}}


                        {!!Form::open( ['route' => 'accounting.settings.store' , 'method' => 'Post','files'=>true]) !!}



                            {{-- <div class="header">

                                {{-- <h5 class="panel-title"> اعدادت {{$settings_page}}</h5> --}}

{{--
                            </div> --}}

                            {{-- <div class="body"> --}}

                                @foreach($settings as $setting)




                                    @if($setting->type=='radio')

                                    <label> {{$setting->title}}</label>
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-line">
                                                @if($setting->value=='1')
                                                {{-- @dd("dsfedsf"); --}}
                                                <label>تعم</label>
                                                {!! Form::radio($setting->name.'[]',1,true,['class'=>'form-control'])!!}
                                                <label>  لا</label>
                                                {!! Form::radio($setting->name.'[]',0,false,['class'=>'form-control'])!!}


                                                @elseif($setting->value=='0')
                                                {{-- @dd("dsfedsf"); --}}
                                                <label>تعم</label>
                                                {!! Form::radio($setting->name.'[]',1,false,['class'=>'form-control'])!!}
                                                <label>  لا</label>
                                                {!! Form::radio($setting->name.'[]',0,true,['class'=>'form-control'])!!}

                                                @endif
                                            </div>

                                        </div>


                                        <div class="clearfix"></div>

                                        <br>
                                    @elseif($setting->type == 'value')

                                    <label> {{$setting->title}}</label>

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-group col-md-6 pull-left">
                                                <label>الطول mm</label>
                                                {!! Form::text($setting->name.'[]',$setting->height,['class'=>'form-control'])!!}
                                            </div>

                                            <div class="form-group col-md-6 pull-left">
                                                <label> العرض mm</label>
                                                {!! Form::text($setting->name.'[]',$setting->display,['class'=>'form-control'])!!}
                                            </div>
                                        </div>


                                        <div class="clearfix"></div>

                                        <br>

                                        @elseif($setting->type == 'number')

                                        <label> {{$setting->title}}</label>

                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <div class="form-group col-md-6 pull-left">
                                                    <label>اعلى </label>
                                                    {!! Form::text($setting->name.'[]',$setting->up,['class'=>'form-control'])!!}
                                                </div>

                                                <div class="form-group col-md-6 pull-left">
                                                    <label> اسفل </label>
                                                    {!! Form::text($setting->name.'[]',$setting->dawn,['class'=>'form-control'])!!}
                                                </div>

                                                <div class="form-group col-md-6 pull-left">
                                                    <label>يمين </label>
                                                    {!! Form::text($setting->name.'[]',$setting->right,['class'=>'form-control'])!!}
                                                </div>

                                                <div class="form-group col-md-6 pull-left">
                                                    <label> يسار </label>
                                                    {!! Form::text($setting->name.'[]',$setting->left,['class'=>'form-control'])!!}
                                                </div>

                                            </div>


                                            <div class="clearfix"></div>

                                            <br>
                                            @elseif($setting->type == 'text')


                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <div class="form-group col-md-6 pull-left">
                                                    <label> {{$setting->title}}</label>
                                                    {!! Form::text($setting->name.'[]',$setting->value,['class'=>'form-control'])!!}
                                                </div>


                                            </div>


                                            <div class="clearfix"></div>

                                            <br>


                                    @endif

                                @endforeach



                                <div class="text-right">

                                    <button type="submit" class="btn btn-success">حفظ <i

                                                class="icon-arrow-left13 position-right"></i></button>

                                </div>

                                {!!Form::close() !!}

                                ​



                            </div><!-- end col -->



@endsection


@section('scripts')


                            {!! Html::script('/admin/ckeditor/ckeditor.js') !!}

                            <script>

                                $(document).ready(function () {

                                    CKEDITOR.replaceClass = 'editor';

                                });

                            </script>



@endsection
