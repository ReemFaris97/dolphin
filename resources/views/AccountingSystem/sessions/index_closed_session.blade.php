@extends('AccountingSystem.layouts.master')
@section('title','عرض  الجلسات')
@section('parent_title','إدارة  المبيعات ')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">   تاكيد اغلاق الجلسات</h5>
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
                    <th> رقم  الجلسة </th>
                    <th>  كود الجهاز  </th>
                    <th>  اسم الوردية </th>
                    <th>  اسم الكاشير </th>
                    <th>   بداية الجلسة  </th>
                    <th>  نهايةالجلسة  </th>
                    <th>  العهده  </th>
                    <th>  تاكيدالاغلاق   </th>
                </tr>
                </thead>
                <tbody>

                @foreach($sessions as $key=>$row)

                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! $row->code!!}</td>
                        <td>{!! optional($row->device)->code!!}</td>
                        <td>{!! optional($row->shift)->name!!}</td>
                        <td>{!! optional($row->user)->name!!}</td>
                        <td>{!! $row->start_session!!}</td>
                        <td>{!! $row->end_session!!}</td>
                        {{-- <td>{!! $row->custody!!}</td> --}}
                        {{-- <td>
                             @if($row->status=='open')
                             <label class="lable lable-success">مفتوحة </label>
                             @elseif($row->status=='closed')
                             <label class="lable lable-warning">مغلقة </label>
                                @else
                                <label class="lable lable-warning">تم  تاكيد الاغلاق </label>

                             @endif
                            </td> --}}


                            <td>
                                @if ($row->custody==Null)
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{$row->id}}" onclick="openModal({{$row->id}})" data-target="#exampleModal{{$row->id}}" id="button{{$row->id}}">
                                      تاكيد اغلاق الجلسة
                                    </button>
                                    @else
                                    <label class="btn-success" id="done">تم التاكيد</label>
                                @endif

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
                text: "هل تريد حذف هذة الجلسة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الجلسة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
