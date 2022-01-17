@extends('AccountingSystem.layouts.master')
@section('title','عرض الخزائن')
@section('parent_title','إدارة  الخزائن ')
@section('action', URL::route('accounting.funds.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل  الخزائن
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.funds.create')}}" class="btn btn-success">
                    إضافه خزينة  جديدة
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
                    <th>  اسم  الخزنة </th>
                    <th> الشركة  </th>
                    <th> الفرع </th>
                    
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($funds as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>
                        <td>{!! @$row->company->name !!}</td>
                        <td>{!! @$row->branch->name !!}</td>
                    
                        <td class="text-center">
                            {{--@if($row->type==1)--}}
                            <a href="{{route('accounting.funds.show',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>

                                {{--@endif--}}
                            <a href="{{route('accounting.funds.edit',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.funds.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذة الخزنية ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الخزنية  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
