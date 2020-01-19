@extends('AccountingSystem.layouts.master')
@section('title','  سجل التحويلات بين المخازن')
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> سجل التحويلات بين المخازن </h5>
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
                    <th> المخزن المحول  منه  </th>
                    <th> المخزن المحول  اليه  </th>
                    <th>  القائم  على التحويل  </th>
                    <th>تاريخ التحويل</th>
                    <th> حاله التحويل  </th>
                    <th> السبب [فى حاله الرفض ] </th>
                    <th>عرض  السند </th>

                </tr>
                </thead>
                <tbody>

                {{--@dd($requests)--}}
                @foreach($requests as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        {{--@dd( $row->getStoreTo)--}}
                        <td>{{optional($row->getStoreFrom)->ar_name}} </td>
                        <td>{{optional($row->getStoreTo)->ar_name}}  </td>
                        <td>{{optional($row->user)->name}}  </td>
                        <td>
                            @if (  $row->status=='pending')
                           <label class="label label-warning">على  قيد الانتظار </label>
                                @elseif ($row->status=='accepted')
                                <label class="label label-success">  تم الاستلام   </label>
                                @else
                                <label class="label label-danger">  تم الرفض   </label>

                        @endif
                           </td>
                        <td>{!! $row->created_at!!}</td>


                        <td>{!! $row->refused_reason!!}</td>

                        <td>
                            <a href="{{route('accounting.stores.request_detail',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>

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