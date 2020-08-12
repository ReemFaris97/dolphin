@extends('AccountingSystem.layouts.master')
@section('title','عرض الفترات الماليه')
@section('parent_title','إدارة  الفترات الماليه')
@section('action', URL::route('accounting.fiscalYears.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل  الفترات الماليه
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.fiscalPeriods.create')}}" class="btn btn-success">
                    إضافه فترة مالية جديدة
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
                    <th> اسم الفترة الماليه </th>
                    <th> نوع  الفتره </th>
                    <th> من </th>
                    <th> الى </th>
                    <th> المده </th>
                    <th> الحالة </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($periods as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>
                        <td>
                            @if($row->type=='manual')
                            محدد
                            @else
                            الى
                            @endif
                        </td>
                        <td>{!! $row->from!!}</td>
                        <td>{!! $row->to!!}</td>
                        <td>
                            @if($row->duration=='monthly')
                            شهريا
                            @elseif($row->duration=='quarterly')
                            ربع  سنوى
                            @elseif($row->duration=='half')
                            نص سنوى
                            @elseif($row->duration=='yearly')
                            سنويا
                            @endif
                        </td>
                        <td>
                            @if($row->status=='opened')
                            مفتوحة
                            @else
                            مغلقة
                            @endif
                        </td>



                        <td class="text-center">
                            <a href="{{route('accounting.fiscalPeriods.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>
                            {!!Form::open( ['route' => ['accounting.fiscalPeriods.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذة  الضريبة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الضريبة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
