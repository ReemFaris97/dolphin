@extends('AccountingSystem.AccountingCompanies.layouts.master')
@section('title','عرض  التحويلات ')
@section('parent_title','إدارة  الايرادات والمصروفات')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل التحويلات </h5>
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

                    <th> مبلغ الايراد </th>
                    <th> اسم البند</th>
                    <th> نوع البند  </th>
                    <th> البند تابع الى  </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($transactions as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->amount!!}</td>
                        <td>{!! $row->clause->ar_name!!}</td>

                        <td>@if ($row->clause->type=="expenses")

                                <label class="label label-info"> مصروف</label>
                                @else
                                <label class="label label-success"> ايراد</label>
                        @endif

                        <td>@if ($row->model_type=="App\Models\AccountingSystem\AccountingCompany")

                                <label class="label label-info"> {!! auth('accounting_companies')->user()->name !!}</label>
                            @else
                                @php( $branch=App\Models\AccountingSystem\AccountingBranch::find($row->model_id))
                                <label class="label label-success">{{$branch->name}} </label>
                            @endif

                        </td>

                        </td>

                        <td class="text-center">
                            <a href="{{route('company.transactions.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['company.transactions.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذة الشركة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الشركة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop