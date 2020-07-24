@extends('AccountingSystem.layouts.master')
@section('title','إنشاء بنك/صندوق  جديد')
@section('parent_title',' إدارة  البنوك')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة بنك/صندوق جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="custom-tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"> البنك</a></li>
                    <li><a data-toggle="tab" href="#menu1">  الصندوق</a></li>

                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="row">
                            {!!Form::open( ['route' => 'accounting.banks.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}

                            @include('AccountingSystem.banks.form')

                            {!!Form::close() !!}
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade in ">
                        <div class="row">
                            {!!Form::open( ['route' => 'accounting.safes.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}

                            @include('AccountingSystem.banks.safe_form')

                            {!!Form::close() !!}                        </div>
                    </div>

        </div>

        </div>


            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>


                    <th> اسم  البنك /الصندوق </th>
                    <th> كود الحساب</th>
                    <th>  الرصيد</th>
                    <th>  العمله</th>
                    <th>  الحاله</th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>
                @php($i=1)
                @foreach($banks as $row)
                    <tr>
                        <td>{!!$i++!!}</td>
                        <td>{!! $row->name!!}</td>
                        <td>{!! optional($row->account)->code!!}</td>
                        <td></td>
                        <td>{!!optional($row->currency)->ar_name!!}</td>

                        <td>
                            @if($row->active==1)
                                مفعل
                            @else
                                غير مفعل
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{route('accounting.banks.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.banks.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td>
                    </tr>

                @endforeach


                @foreach($safes as $row)
                    <tr>
                        <td>{!!$i++!!}</td>



                        <td>{!! $row->name!!}</td>
                        <td>{!! optional($row->account)->code!!}</td>
                        <td></td>
                        <td>{!!optional($row->currency)->ar_name!!}</td>

                        <td>
                            @if($row->active==1)
                                مفعل
                            @else
                                غير مفعل
                            @endif
                        </td>

                        <td class="text-center">
                            <a href="{{route('accounting.safes.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.safes.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

        </div>

 @endsection
