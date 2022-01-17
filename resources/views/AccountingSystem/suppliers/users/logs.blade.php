@extends('AccountingSystem.layouts.master')
@section('title','نشاط الموظفين')
@section('parent_title','نشاط الموظفين')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل نشاط الموظفين
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

                    <th> التفاصيل</th>
                    <th> تاريخ الانشاء</th>

                </tr>
                </thead>
                <tbody>

                @foreach($logs as $log)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{{ $log->description}}</td>
                        <td>{{ $log->created_at}}</td>

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
