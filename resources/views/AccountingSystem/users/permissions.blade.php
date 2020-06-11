@extends('AccountingSystem.layouts.master')
@section('title','عرض صلاحيات المستخدم ')
@section('parent_title','إدارة اعضاء  الاداره ')
@section('action', URL::route('accounting.users.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">

            <span>عرض كل  صلاحيات  المستخدم  </span>
            <div class="heading-elements">

                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>

        </div>

        <div class="panel-body">
            {!!Form::model($user, ['route' => ['accounting.user_permissions.update' ,$user->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-float">
                    <strong>الشركات:</strong>
                    <br/>
                    <div class="row flex2">
                        @foreach($companies as $value)
                            <div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">
                                <input type="checkbox" name="permission[]" value="{{$value->id}}" class="switchery company" id="{{$value->id}}" >
                                <label style="margin-left: 20px;"  for={{$value->id}}>
                                    {{ $value->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

            {!!Form::close() !!}

        </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-float">
                    <strong>الفروع:</strong>
                    <br/>
                    <div class="row flex2 branches">
                        {{--@foreach($branches as $value)--}}
                            {{--<div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">--}}
                                {{--<input type="checkbox" name="permission[]" value="{{$value->id}}" class="switchery" id="{{$value->id}}" >--}}
                                {{--<label style="margin-left: 20px;"  for={{$value->id}}>--}}
                                    {{--{{ $value->name }}--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}

                    </div>
                </div>
    </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-float">
                    <strong>المخازن:</strong>
                    <br/>
                    <div class="row flex2 stores">
                        {{--@foreach($stores as $value)--}}
                            {{--<div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">--}}
                                {{--<input type="checkbox" name="permission[]" value="{{$value->id}}" class="switchery" id="{{$value->id}}" >--}}
                                {{--<label style="margin-left: 20px;"  for={{$value->id}}>--}}
                                    {{--{{ $value->ar_name }}--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    </div>
                </div>
            </div>

            <div class="text-center col-xs-12">
                <div class="text-right">
                    <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
                </div>
            </div>
         </div>
@endsection

        @section('scripts')

            <script>

                $('.company').change(function() {
                    if($(this).is(":checked")) {

                     var company_id=   $(this).val();
                        $.ajax({
                            url: "/accounting/getBranchesPermission/" + company_id,
                            type: "GET",
                        }).done(function (data) {

                            $('.branches').append(data.data);
                        }).fail(function (error) {
                            console.log(error);
                        });
                    }

                });
            </script>
            @endsection