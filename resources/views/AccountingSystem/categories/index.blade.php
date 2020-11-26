@extends('AccountingSystem.layouts.master')
@section('title','عرض التصنيفات')
@section('parent_title','إدارة تصنيفات الاقسام')
@section('action', URL::route('accounting.categories.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل التصنيفات
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.categories.create')}}" class="btn btn-success">
                    إضافه  تصنيف  جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>

            {{--  <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.categories.importViewCategory')}}" class="btn btn-success">
                 رفع تصنيفات من ملف
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>  --}}

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
                    <th>اسم الشركة</th>
                    <th> اسم  التصنيف باللغة العربية </th>
                    <th> اسم  التصنيف باللغة الانجليزية </th>
                    <th> وصف  التصنيف باللغة العربية </th>
                    <th> وصف  التصنيف باللغة الانجليزية </th>
                    <th> صورة  </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($categories as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->company->name!!}</td>
                        <td>{!! $row->ar_name!!}</td>
                        <td>{!! $row->en_name!!}</td>
                        <td>{!! $row->ar_description!!}</td>
                        <td>{!! $row->en_description!!}</td>

                        <td><img src="{!! getimg($row->image)!!}" style="width:100px; height:100px"> </td>


                        <td class="text-center">
                            <a href="{{route('accounting.categories.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.categories.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذة التصنيف ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  التصنيف  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
