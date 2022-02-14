@extends('AccountingSystem.layouts.master')
@section('title','عرض اوامر التوريد')
@section('parent_title','إدارة اوامر التوريد')
@section('action', URL::route('accounting.supply-requisitions.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل اوامر التوريد
                <div class="btn-group beside-btn-title">
                    <a href="{{route('accounting.supply-requisitions.create')}}" class="btn btn-success">
                        إضافه امر توريد جديد
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

        <div class="">
            <div class="">
                <div class="">
                    <div>
                        <div class="row">
                            <table class="table datatable-button-init-basic">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th> الشركة</th>
                                    <th> الفرع</th>
                                    <th> المورد</th>
                                    <th> منشئ الطلب</th>
                                    <th> معتمد الطلب</th>
                                    <th> تاريخ الانشاء</th>
                                    <th> تاريخ الاعتماد</th>
                                    <th class="text-center">العمليات</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($requests as $request)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$request->company->name}}</td>
                                        <td>{{$request->branch->name}}</td>
                                        <td>{{$request->supplier->name}}</td>
                                        <td>{{$request->creator->name}}</td>
                                        <td>{{@$request->approver->name}}</td>
                                        <td>{{$request->created_at}}</td>
                                        <td>@if($request->approver)
                                                {{$request->approved_at}}
                                            @else
                                                {!! Form::open(['route'=>['accounting.supply-requisitions.update',$request],'method'=>'PUT']) !!}
                                                <button class="btn btn-primary"><i class="fa fa-check-circle"></i></button>
                                                {!! Form::close() !!}
                                               @endif</td>

                                        <td class="text-center">
                                            <a href="{{route('accounting.supply-requisitions.show',$request)}}"><i class="fa fa-eye"></i></a>
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
                            var item_id = id;
                            console.log(item_id);
                            swal({
                                title: "هل أنت متأكد ",
                                text: "هل تريد حذف هذا البنك ؟",
                                icon: "warning",
                                buttons: ["الغاء", "موافق"],
                                dangerMode: true,

                            }).then(function (isConfirm) {
                                if (isConfirm) {
                                    document.getElementById('delete-form' + item_id).submit();
                                } else {
                                    swal("تم االإلفاء", "حذف  البنك  تم الغاؤه", 'info', {buttons: 'موافق'});
                                }
                            });
                        }
                    </script>
@stop
