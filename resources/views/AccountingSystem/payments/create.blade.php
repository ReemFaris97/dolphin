@extends('AccountingSystem.layouts.master')
@section('title','إنشاء خيار دفع  جديد')
@section('parent_title','اعدادات خيارات الدفع')
@section('action', URL::route('accounting.payments.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة خيار دفع جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.payments.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.payments.form')
            {!!Form::close() !!}
        </div>
        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th>#</th>


                <th> مسمى  الطريقه</th>
                <th> قناة ‫الدفع‬ الفتراضية</th>
                <th> الحالة</th>

                <th class="text-center">العمليات</th>
            </tr>
            </thead>
            <tbody>

            @foreach($payments as $row)
                <tr>
                    <td>{!!$loop->iteration!!}</td>


                    <td>{!! $row->name!!}</td>
                    <td>
                        @if($row->type=='bank')
                            {{$row->bank->name  }}
                        @else
                            {{$row->safe->name  }}

                        @endif
                    </td>

                    <td>
                        @if($row->active==1)
                            مفعل
                        @else
                            غير مفعل
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{route('accounting.currencies.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                        <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                        {!!Form::open( ['route' => ['accounting.currencies.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                        {!!Form::close() !!}

                    </td>
                </tr>

            @endforeach



            </tbody>
        </table>

        </div>
    </div>

 @endsection
