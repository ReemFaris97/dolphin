@extends('AccountingSystem.layouts.master')
@section('title','عرض  بنوك الموردين')
@section('parent_title','إدارة  بنوك الموردين')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل بنوك الموردين
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

                    <th> اسم البنك</th>
                    <th> اسم صاحب الحساب</th>
                    <th> رقم الiban</th>
                    <th> المورد</th>

                </tr>
                </thead>
                <tbody>

                @foreach($banks as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! $row->name!!}</td>

                        <td>{!! $row->owner_name!!}</td>
                        <td>{!! $row->iban!!}</td>
                        <td>{!! $row->supplier->name!!}</td>

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
