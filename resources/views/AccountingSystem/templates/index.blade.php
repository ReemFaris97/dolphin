@extends('AccountingSystem.layouts.master')
@section('title','عرض التقارير')
@section('parent_title','إدارة  التقارير المالية')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل التقارير
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.templates.create')}}" class="btn btn-success">
                    إضافه قالب تقرير  جديد
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
                    <th> اسم التقرير </th>
                    <th> معادلات التقرير </th>

                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($templates as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->report_no!!}</td>
                        <td>
                            @foreach(\App\Models\AccountingSystem\AccountingTemplate::where('report_no', $row->report_no)->get() as $template)
                            <li>
                                {{ $template->first_account->ar_name ?? $template->template->result}}
                                {{$template->operation}}
                                {{ $template->second_account->ar_name?? $template->template->result}}
                                =
                                {{$template->result}}

                            </li>
                            @endforeach
                        </td>


                        <td class="text-center">

                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>
                            {!!Form::open( ['route' => ['accounting.templates.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذة الوجة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الوجة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
