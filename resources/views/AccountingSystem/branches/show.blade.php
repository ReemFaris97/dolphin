@extends('AccountingSystem.layouts.master')
@section('title','عرض بيانات فرع'.' '. $branch->name )
@section('parent_title','إدارة فروع الشركات')
@section('action', URL::route('accounting.branches.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض بيانات الفرع  {!! $branch->name !!}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="form-group col-md-6 pull-left">
                <label class="label ">  اسم الشركة التابع  لها   الفرع  : </label>
                <span>{!! $branch->company->name !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label ">  اسم الفرع  : </label>
                <span>{!! $branch->name !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label ">  جوال الفرع  : </label>
                <span>{!! $branch->phone !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label ">  ايميل الفرع  : </label>
                <span>{!! $branch->email !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label ">  صورة الفرع  : </label>
                <span><img src="{!! getimg($branch->image)!!}" style="width:100px; height:100px"> </span>
            </div>
            <div class="clearfix">

            </div>
            <h4>عرض الورديات بالفرع</h4>
            <div class="form-group col-md-12 pull-left">
                @foreach($shifts  as $shift)
                   <table class="table init-basic">
                       <thead>
                       <tr>
                           <th>اسم الوردية </th>
                           <th>من </th>
                           <th>الى </th>
                       </tr>
                       </thead>
                       <tbody>
                       <td>{!! $shift->name !!}</td>
                       <td>{!! $shift->from !!}</td>
                       <td>{!! $shift->to !!}</td>
                       </tbody>
                   </table>
                    @endforeach
            </div>

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
                text: "هل تريد حذف هذة الشركة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الشركة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop