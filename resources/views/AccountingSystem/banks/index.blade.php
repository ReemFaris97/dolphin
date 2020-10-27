@extends('AccountingSystem.layouts.master')
@section('title','عرض  البنوك')
@section('parent_title','إدارة  البنوك')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل البنوك
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.banks.create')}}" class="btn btn-success">
                    إضافه  بنك  جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>
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
            <div class="custom-tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"> البنوك</a></li>
                    <li><a data-toggle="tab" href="#menu1">  الصناديق</a></li>

                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div class="row">
                          <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>

                    <th> رمز البنك</th>
                    <th> اسم  البنك  باللغه العربيه</th>
                    <th> اسم  البنك  باللغه الانجليزيه</th>

                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($banks as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! $row->bank_number!!}</td>

                        <td>{!! $row->name!!}</td>
                        <td>{!! $row->en_name!!}</td>

                        <td class="text-center">
                            <a href="{{route('accounting.banks.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.banks.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade in ">
                        <div class="row">
                            <table class="table datatable-button-init-basic">
                                <thead>
                                <tr>
                                    <th>#</th>


                                    <th> اسم  الصندوق </th>
                                    <th> كود الحساب</th>
                                    <th>  الرصيد</th>
                                    <th>  العمله</th>
                                    <th>  الحاله</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                                </thead>
                                <tbody>
                            @php($i=1)  @foreach($safes as $row)
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
        </div>

    </div>


@endsection

@section('scripts')

    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا البنك ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  البنك  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
