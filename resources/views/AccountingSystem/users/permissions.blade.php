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
                                <input type="checkbox" name="companies[]" value="{{$value->id}}" class="switchery company" id="company-{{$value->id}}" @if(in_array($value->id,$userpermisionscompany)) checked  @endif  >
                                <label style="margin-left: 20px;"  for=company-{{$value->id}} >
                                    {{ $value->name }}
                                </label>
                            </div>
                                @endforeach

                    </div>
                </div>
        </div>

            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-float">
                    <strong>الفروع:</strong>
                    <br/>
                    <div class="row flex2 branches">
                        @foreach($userpermisionsbranch as $value)
                            <div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">
                                <input type="checkbox" name="branches[]" value="{{$value}}" class="switchery branch" id="branch-{{$value}}" checked  >
                                <label style="margin-left: 20px;"  for=branch-{{$value}}>
                                    @php($branch=\App\Models\AccountingSystem\AccountingBranch::find($value))
                                    {{ $branch->name }}

                                </label>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-xs-12">
                <div class="form-group form-float">
                    <strong>المستودعات:</strong>
                    <br/>
                    <div class="row flex2 stores">
                        @foreach($userpermisionsstore as $value)
                            <div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">
                                <input type="checkbox" name="stores[]" value="{{$value}}" class="switchery store" id="store-{{$value}}" checked  >
                                <label style="margin-left: 20px;"  for=store-{{$value}}>
                                    @php($branch=\App\Models\AccountingSystem\AccountingStore::find($value))
                                    {{ $branch->ar_name }}

                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center col-xs-12">
                <div class="text-right">
                    <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
                </div>
            </div>
            {!!Form::close() !!}

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

                            $('.branches').append(data.branch);
                        }).fail(function (error) {
                            console.log(error);
                        });

                        $.ajax({
                            url: "/accounting/getStoresCampanyPermission/" + company_id,
                            type: "GET",
                        }).done(function (data) {

                            $('.stores').append(data.store);
                        }).fail(function (error) {
                            console.log(error);
                        });
                    }



                });




            </script>
            @endsection