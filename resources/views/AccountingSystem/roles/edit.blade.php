@extends('AccountingSystem.layouts.master')
@section('title','إنشاء صلاحية  جديدة')
@section('parent_title','إدارة الصلاحيات')
@section('action', URL::route('accounting.roles.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة صلاحيه جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

        <form action="{{route('accounting.roles.update',$role->id)}}" method="post">
                        @csrf
                        {{method_field('PUT')}}

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="hidden" name="id" value="@isset($user) {!! $user->id !!} @endisset">
                    <div class="col-sm-12 col-xs-12 ">
                        <div class="form-group form-float">
                            <label class="form-label">Name</label>
                            <div class="form-line">
                                <input type="text" name="name" value="{{$role->name}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 ">
                        <div class="form-group form-float">
                            <strong>الصلاحيات:</strong>
                            <br/>
                            <div class="row flex2">
                            @foreach($permission as $value)
                                <div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">

                                   <input type="checkbox" name="permission[]" value="{{$value->id}}" @if(in_array($value->id, $rolePermissions)) checked  @endif class="switchery" id="{{$value->id}}" >

                                    <label style="margin-left: 40px;"  for={{$value->id}}>
                                        {{ $value->name }}
                                    </label>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>







                    <div class="col-xs-12">
                        <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
                    </div>
                    </form>


                </div><!-- end row -->
            </div>

@endsection

