@extends('AccountingSystem.layouts.master')
@section('title','موظفين الموردين')
@section('parent_title','موظفين الموردين')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل موظفين الموردين
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

                    <th> الاسم</th>
                    <th> رقم الجوال</th>
                    <th> البريد</th>
                    <th> الصلاحيات</th>
                    <th> النشاطات</th>
                    <th> تاريخ الانشاء</th>

                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->phone}}</td>
                        <td>{{ $user->email}}</td>
                        <td>
                            <ul>

                            @foreach($user->permissions??[] as $permission)
                                <li style="font-weight: bold">{{$permission}}</li>
                        @endforeach
                            </ul>

                        </td>
                        <td><a href="{{route('accounting.supplier-users.show',$user->id)}}"><i class="fa fa-eye"></i></a></td>
                        <td>{{ $user->created_at}}</td>

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
