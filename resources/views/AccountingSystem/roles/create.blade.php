@extends('AccountingSystem.layouts.master')
@section('title','إنشاء صلاحية  جديدة')
@section('parent_title','إدارة الصلاحيات')
@section('action', URL::route('accounting.roles.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة صلاحيه جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            <form action="{{route('accounting.roles.store')}}" method="Post" class="form phone_validate" >
            @csrf

            @include('AccountingSystem.roles.form')

            </form>

           {{--  <form action="">
                <br>
                <br>
                <br>
                <table class="table datatable-button-init-basic validites-table">
                    <thead>
                    <tr>
                        <th>السماحية</th>
                        <th>الكل</th>
                        <th>اضافة</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                        <th>بحث</th>
                        <th>طباعة</th>

                    </tr>
                    </thead>
                    <tbody>

                        <tr class="tr-have-checkBox">
                            <td>الصلاحيات الادارية</td>
                            <td><input class="selectAll" type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>


                        </tr>
                        <tr class="tr-have-checkBox">
                            <td>ادارة النظام</td>
                            <td><input class="selectAll" type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>
                            <td><input type="checkbox" class="switchery" ></td>


                        </tr>

                    </tbody>
                </table>
            </form>
 --}}
        </div>



    </div>
    </div>

@endsection
@section('scripts')
<script>
    $(".selectAll").click(function() {
      /*   $("input[type=checkbox]").prop("checked", $(this).prop("checked")); */
      $(this).parents(".tr-have-checkBox").find('input[type=checkbox]').prop("checked", $(this).prop("checked"))
    });

$("input[type=checkbox]").click(function() {
	if (!$(this).prop("checked")) {
        $(this).parents(".tr-have-checkBox").find$(".selectAll").prop("checked", false);
	}
});
</script>
@endsection
