@extends('AccountingSystem.layouts.master')
@section('title','عرض بيانات مخزن'.' '. $store->name )
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض بيانات المخزن  {!! $store->name !!}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            @if ($store->model_type=="App\Models\AccountingSystem\AccountingCompany")

                <div class="form-group col-md-6 pull-left">
                    <label class="label label-info">  المخزن تابع الى شركة: </label>
                    <span>
                        <?php
                        $company=App\Models\AccountingSystem\AccountingCompany::find($store->model_id)
                        ?>
                        {!! $company->name  !!}
                    </span>
                </div>

                @elseif ($store->model_type=="App\Models\AccountingSystem\AccountingBranch")
                <div class="form-group col-md-6 pull-left">
                    <label class="label label-info">  المخزن تابع الى فرع: </label>
                    <span>
                        <?php
                        $branch=App\Models\AccountingSystem\AccountingBranch::find($store->model_id)
                        ?>
                        {!! $branch->name  !!}
                    </span>
                </div>

            @endif

            @if ($store->type==0)


                    <div class="form-group col-md-6 pull-left">
                        <label class="label label-info">  اسم المخزن الرئيسى  : </label>
                        <span>{!! $store->basic->ar_name !!}</span>
                    </div>

                @endif
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  اسم المخزن باللغة العربيه  : </label>
                <span>{!! $store->ar_name !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> اسم المخزن باللغة الانجليزية   : </label>
                <span>{!! $store->en_name !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  جوال المخزن : </label>
                <span>{!! $store->address !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  صورة المخزن  : </label>
                <span><img src="{!! getimg($store->image)!!}" style="width:100px; height:100px"> </span>
            </div>
            <div class="clearfix">

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