@extends('AccountingSystem.layouts.master')
@section('title','عرض  القيد  ')
@section('parent_title','  الدليل المحاسبى')
@section('action', URL::route('accounting.ChartsAccounts.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض {{$entry->code}}
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
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1"> تفاصيل القيد </a></li>
                <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2"> سجل القيد </a></li>


            </ul>
            <div class="tab-content">


                <div role="tabpanel" id="menu1" class="tab-pane active">

                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>الكود </label>
                        <input type="text" name="code" class="form-control" value="{{$entry->code}}" disabled>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>المصدر </label>
                        <input type="text" name="source" class="form-control" value="{{$entry->source}}" disabled>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>التاريخ </label>
                        <input type="text" name="date" class="form-control" value="{{$entry->date}}" disabled>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label> النوع  </label>
                        <select class="form-control" disabled>
                            <option selected>@if ($entry->type=='manual') يدوى @else  ألى @endif</option>
                        </select>
                    </div>
{{--                        <div class="form-group col-sm-6 col-xs-12 pull-left">--}}
{{--                            <label>  من حساب </label>--}}
{{--                            <select class="form-control" disabled>--}}
{{--                                <option selected> {{$entry->from_account->ar_name}}</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                    <div class="form-group col-sm-6 col-xs-12 pull-left">--}}
{{--                        <label>  الى حساب  </label>--}}
{{--                        <select class="form-control" disabled>--}}
{{--                            <option selected> {{$entry-> to_account->ar_name}}</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}


                </div>

                <div role="tabpanel" id="menu2" class="tab-pane">

                    <table class="table datatable-button-init-basic">
                        <thead>
                        <tr>
                            <th>#</th>

                            <th> الكود </th>
                            <th> الاجراء </th>

                            <th> اسم الحساب </th>
                            <th>  مدين </th>
                            <th>  دائن </th>
                            <th> التاريخ </th>
                            <th> العمله </th>
                            <th> الوصف </th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($logs as $row)
                            <tr>
                                <td>{!!$loop->iteration!!}</td>

                                <td>
                                    <a href="{{route('accounting.entries.show',['id'=>$row->id])}}" class="link">
                                        {!! $row->entry->code!!}
                                    </a>
                                </td>
                                <td>
                                    {!! $row->operation!!}
                                </td>

                                <td>{!! $row->account->ar_name!!}</td>
                                <td>{!! $row->debtor??'---'!!}</td>
                                <td>{!! $row->creditor??'---'!!}</td>

                                <td>{!! $row->entry->date!!}</td>
                                <td>{!! $row->entry->currency!!}</td>
                                <td>{!! $row->entry->details!!}</td>

                                {{--<td>--}}
                                    {{--@if ($row->status=='new')--}}
                                        {{--جديد--}}
                                    {{--@else--}}
                                        {{--مرحلة--}}
                                    {{--@endif--}}
                                {{--</td>--}}
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                    <div class="btn-group beside-btn-title">
                        <a href="{{route('accounting.entries.create')}}" class="btn btn-success">
                            انشاء قيد  جديد
                            <span class="m-l-5"><i class="fa fa-plus"></i></span>
                        </a>
                    </div>
                    <div class="btn-group beside-btn-title">
                        <a href="{{route('accounting.entries.edit',['id'=>$entry->id])}}" class="btn btn-success">
                           تعديل القيد
                            <span class="m-l-5"><i class="icon-pencil7 text-inverse"></i></span>
                        </a>
                    </div>
                    <div class="btn-group beside-btn-title">
                        <a href="{{route('accounting.entries.create')}}" class="btn btn-success">

                           ترحيل
                        </a>
                    </div>

                </div>
            </div>

        </div>


@endsection

@section('scripts')


@stop
