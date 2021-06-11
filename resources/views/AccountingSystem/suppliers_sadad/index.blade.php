@extends('AccountingSystem.layouts.master')
@section('title','عرض   السندات ')
@section('parent_title','إدارة   سندات  القبض  والصرف')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل السندات </h5>
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
                    <th>  تاريخ  السداد </th>
                    <th> رقم  السند  </th>
                    <th> المبلغ المدفوع </th>

                    <th> الشركة  </th>

                    {{--<th class="text-center">العمليات</th>--}}
                </tr>
                </thead>
                <tbody>

                @foreach($clauses as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->created_at!!}</td>
                        <td>{!! $row->num!!}</td>
                        <td>{!! $row->amount!!}</td>
                        <td>{!!optional($row->company)->name!!}</td>


                        {{--<td class="text-center">--}}
                            {{--<a href="{{route('accounting.suppliers_sadad.edit',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>--}}
                            {{--<a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>--}}
                            {{--{!!Form::open( ['route' => ['accounting.suppliers_sadad.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}--}}
                            {{--{!!Form::close() !!}--}}
                        {{--</td>--}}
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
