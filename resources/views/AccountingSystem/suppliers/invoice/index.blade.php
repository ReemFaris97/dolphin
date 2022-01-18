@extends('AccountingSystem.layouts.master')
@section('title','عروض الاسعار')
@section('parent_title','عروض الاسعار')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل عروض الاسعار
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
                    <th>الاجمالي</th>
                    <th> عدد الاصناف</th>
                    <th> تاريخ الانشاء</th>
                    <th> الحالة</th>
                    <th>العمليات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{{ $invoice->items_sum_total}}</td>
                        <td>{{ $invoice->items_count}}</td>
                        <td>{{ $invoice->created_at}}</td>
                        <td>
                            {!! Form::open(['route'=>['accounting.suppliers-invoices.update',$invoice],'method'=>'PUT']) !!}
                            @if($invoice->status=='pending')
                                <button type="submit" class="btn btn-success" name="status" value="accept">قبول</button>
                                <button type="submit" class="btn btn-danger" name="status" value="reject">رفض</button>
                            @else
                                <button type="submit" class="btn btn-warning" disabled >{{$invoice->status=='accept'?'مقبول':'مرفوض'}}</button>

                            @endif
                            {!! Form::close()!!}
                        </td>
                        <td><a href="{{route('accounting.suppliers-invoices.show',$invoice->id)}}"><i class="fa fa-eye"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        @endsection

        @section('scripts')

            <script>
                function Delete(id) {
                    var item_id = id;
                    console.log(item_id);
                    swal({
                        title: "هل أنت متأكد ",
                        text: "هل تريد حذف هذا البنك ؟",
                        icon: "warning",
                        buttons: ["الغاء", "موافق"],
                        dangerMode: true,

                    }).then(function (isConfirm) {
                        if (isConfirm) {
                            document.getElementById('delete-form' + item_id).submit();
                        } else {
                            swal("تم االإلفاء", "حذف  البنك  تم الغاؤه", 'info', {buttons: 'موافق'});
                        }
                    });
                }
            </script>
@stop
