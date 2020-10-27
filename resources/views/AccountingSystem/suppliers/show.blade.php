@extends('AccountingSystem.layouts.master')
@section('title','عرض   كشف حساب مورد ')
@section('parent_title','إدارة  الموردين')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> كشف  حساب  المورد    {{$supplier->name}}</h5>

            <div class="form-group  pull-left">
                <label> رصيد المورد</label>
                <span>{{$supplier->balance}}</span>
            </div>
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

                <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1"  href="#menu1">  سندات القبض</a></li>
                <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2"> سندات الصرف </a></li>
                <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu3"> عمليات الشراء </a></li>

            </ul>
            <br>


            <div class="tab-content">
                <div role="tabpanel" id="menu1" class="tab-pane active ">
                    <div class="form-group  pull-left">
                        <label>اجمالى    </label>
                        <span>{{$clauses_revenue_sum}}</span>
                    </div>
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th>  تاريخ  السداد </th>
                    <th> رقم  السند  </th>
                    <th> المبلغ المدفوع </th>

                    <th> الشركة  </th>

                    <th class="text-center">عرض</th>
                </tr>
                </thead>
                <tbody>

                @foreach($clauses_revenue as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->created_at!!}</td>
                        <td>{!! $row->num!!}</td>
                        <td>{!! $row->amount!!}</td>
                        <td>{!!optional($row->company)->name!!}</td>


                        <td class="text-center">
                            <a href="{{route('accounting.clauses.show',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>

                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>
                </div>
                <div role="tabpanel" id="menu2" class="tab-pane ">
                    <div class="form-group  pull-left">
                        <label>اجمالى    </label>
                        <span>{{$clauses_expenses_sum}}</span>
                    </div>
                    <table class="table datatable-button-init-basic">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>  تاريخ  السداد </th>
                            <th> رقم  السند  </th>
                            <th> المبلغ المدفوع </th>

                            <th> الشركة  </th>

                            <th class="text-center">عرض</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($clauses_expenses as $row)
                            <tr>
                                <td>{!!$loop->iteration!!}</td>
                                <td>{!! $row->created_at!!}</td>
                                <td>{!! $row->num!!}</td>
                                <td>{!! $row->amount!!}</td>
                                <td>{!!optional($row->company)->name!!}</td>


                                <td class="text-center">
                                    <a href="{{route('accounting.clauses.show',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>

                                </td>
                            </tr>

                        @endforeach



                        </tbody>
                    </table>
                </div>

                <div role="tabpanel" id="menu3" class="tab-pane">
                    <div class="form-group  pull-left">
                        <label>اجمالى مبالغ فواتير الشراء  </label>
                        <span>{{$purchases_sum}}</span>
                    </div>
                    <table class="table datatable-button-init-basic">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th> رقم  الفاتورة </th>
                            <th> تاريخ الفاتورة </th>
                            <th> قيمة الفاتورة </th>
                            <th class="text-center">العمليات</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($purchases as $row)
                            <tr>
                                <td>{!!$loop->iteration!!}</td>
                                <td>{!! $row-> id!!}</td>
                                <td>{!! $row->created_at!!}</td>
                                <td>{!! $row->total!!}</td>


                                <td class="text-center">
                                    <a href="{{route('accounting.purchases.show',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>


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
                text: "هل تريد حذف هذا  البند ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  البند  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
