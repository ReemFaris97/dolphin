@extends('AccountingSystem.layouts.master')
@section('title','     سجل تحويلات الخزينة ')
@section('parent_title','إدارة  الخزائن')

@section('action', URL::route('accounting.stores.index'))
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض  سجل الخزينة </h5>
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

                    <th>   رقم الخزينة  المحول اليها  </th>
                    <th> المبلغ  </th>

                    <th> بيان التحويل   </th>


                    <th class="text-center">العمليات </th>
                </tr>
                </thead>
                <tbody>

                @foreach($transactions as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! $row->getSafeTo->name !!}</td>
                        <td>
                           {!!  $row->amount!!}
                        </td>
                        {{-- <td>{!! date($row->created_at)!!}</td> --}}

                        <td>{!! $row->notes!!}</td>

                        <td class="text-center">

                            {{-- <a href="{{route('accounting.stores.show_bond',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a> --}}

                            {{--<a href="{{route('accounting.stores.edit_bond',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>--}}
                            {{--<a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>--}}
                            {{--{!!Form::open( ['route' => ['accounting.stores.destroy_bond',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}--}}
                            {{--{!!Form::close() !!}--}}


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
                text: "هل تريد حذف هذا الفرع ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الفرع  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
