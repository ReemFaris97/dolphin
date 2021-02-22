@extends('AccountingSystem.layouts.master')
@section('title','عرض المسميات الوظفية ')
@section('parent_title','إدارةالمسميات الوظفية ')
@section('action', URL::route('accounting.jobTitles.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض وثائق الموظفين
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.documents.create',$type)}}" class="btn btn-success">إضافه  وثيقة جديدة
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
                    <th> {{$type=='employee'?'اسم الموظف':'اسم الفرع'}}</th>
                    <th>اسم الوثيقة</th>
                    <th>رقم الوثيقة</th>
                    <th>تاريخ البدايه</th>
                    <th>تاريخ النهاية </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($documents as $document)
                    <tr>
                        <td>{{$document->id}}</td>
                        <td>{{$document->documentable->name ??''}}</td>
                        <td>
                            <a href="{{$document->url}}">{{$document->document_name}}</a>
                        </td>
                        <td>{{$document->document_number}}</td>
                        <td>{{$document->start_date->format('Y-m-d')}}</td>
                        <td>{{$document->end_date->format('Y-m-d')}}</td>


                        <td class="text-center">
                            <a href="{{route('accounting.documents.edit',[$type,'id'=>$document->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>

                            <a href="#" onclick="Delete({{$document->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.documents.delete',$type,'id'=>$document->id] ,'id'=>'delete-form'.$document->id, 'method' => 'get']) !!}
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
