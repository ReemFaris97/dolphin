@extends('AccountingSystem.layouts.master')
@section('title','عرض  السلف ')
@section('parent_title','إدارة الموظفين ')
@section('action', URL::route('accounting.debts.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض كل  السلف
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.debts.create')}}" class="btn btn-success">
                    إضافة سلفة جديدة
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
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الموظف</th>
                    <th>تاريخ السلفة</th>
                    <th>تاريخ بدايه الدفع</th>
                    <th>القيمة</th>
                    <th>السبب</th>
                    <th>عدد الدفعات</th>
                    <th>الدفع</th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($debts as $debt)
                    <tr>
                        <td>{{$debt->id}}</td>
                        <td>{{$debt->typeable->name ??''}}</td>
                        <td>{{$debt->date->format('Y-m-d')}}</td>
                        <td>{{$debt->pay_from->format('Y-m-d')}}</td>
                        <td>{{$debt->value}}</td>
                        <td>{{$debt->reason}}</td>
                        <td>{{$debt->payments_count}}</td>
                        <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$debt->id}}">
                         عرض المدفوعات
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$debt->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">الدفعات</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>التاريخ</th>
                                                <th>المبلغ</th>
                                                <th>دفع</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($debt->all_payments as $key=>$p)
                                                <tr>
                                                    <td>{{$p->date}}</td>
                                                    <td>{{$p->amount}}</td>
                                                    <td>
                                                        @if ($p->payed)
                                                      تم الدفع
                                                        @else
                                                            <a href="javascript:" onclick="$('.pay-{{$debt->id}}-{{$key}}').submit()" class="btn btn-info">دفع</a>
                                                        @endif
                                                        <form action="{{route('accounting.payDebt',$debt->id)}}" class="pay-{{$debt->id}}-{{$key}}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="value" value="{{$p->amount}}">
                                                            <input type="hidden" name="date" value="{{$p->date}}">
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </td>

                        <td class="text-center">
                            <a href="{{route('accounting.debts.edit',$debt->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$debt->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>
                            {!!Form::open( ['route' => ['accounting.debts.destroy',$debt->id] ,'id'=>'delete-form'.$debt->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>
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
                text: "هل تريد حذف هذا السلفة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  السلفة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
