@extends('AccountingSystem.layouts.master')
@section('title','عرض  تفاصيل سند الجرد'.' '. $inventory->id )
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض  تفاصيل سند الجرد  {!! $inventory->id !!}</h5>
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
                <label class="label label-info"> رقم السند : </label>
                <span>{!! isset($inventory->bond_num)?$inventory->bond_num: ""  !!}</span>
            </div>


            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  اسم المخزن   : </label>
                <span>{!! optional($inventory->store)->ar_name !!}</span>
            </div>

            @if (optional($inventory->store)->model_type=="App\Models\AccountingSystem\AccountingCompany")

                <div class="form-group col-md-6 pull-left">
                    <label class="label label-info">  المخزن تابع الى شركة: </label>
                    <span>
                        <?php
                        $company=App\Models\AccountingSystem\AccountingCompany::find(optional($inventory->store)->model_id)
                        ?>
                        {!! $company->name  !!}
                    </span>
                </div>

            @elseif (optional($inventory->store)->model_type=="App\Models\AccountingSystem\AccountingBranch")
                <div class="form-group col-md-6 pull-left">
                    <label class="label label-info">  المخزن تابع الى فرع: </label>
                    <span>
                        <?php
                        $branch=App\Models\AccountingSystem\AccountingBranch::find(optional($inventory->store)->model_id)
                        ?>
                        {!! $branch->name  !!}
                    </span>
                </div>

            @endif

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  اسم القائم بالجرد : </label>
                <span>{!! $inventory->user->name !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> تاريخ الجرد : </label>
                <span>{!! $inventory->date !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> نوع تحميل
                    : </label>
                <span> </span>
            </div>



            <div class="clearfix">

            </div>

            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المنتج </th>
                    <th> نوع المنتج </th>

                    <th>  الباركود </th>
                    <th> الكميه قبل الجرد  </th>

                    <th>الكميه  بعد الجرد</th>
                    <th>   الفرق</th>

                </tr>
                </thead>
                <tbody>

                @foreach($inventory_products as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>

                        <td>
                            @if ($row->product->type=="store")
                                مخزون
                            @elseif($row->product->type=="service")
                                خدمه
                            @elseif($row->product->type=="offer")
                                مجموعة منتجات
                            @elseif($row->product->type=="creation")
                                تصنيع
                            @elseif($row->product->type=="product_expiration")
                                منتج بتاريخ صلاحيه
                            @endif

                        </td>
                        <td>{!! $row->product-> bar_code!!}</td>

                        <td>{!! $row->quantity!!}</td>
                        <td>{!! $row->Real_quantity!!}</td>

                        <td>
                            @if ($row->quantity > $row->Real_quantity)
                                <label class="btn btn-danger">قيمه العجز بالمخزن ={!! $row->quantity - $row->Real_quantity!!}</label>
                            @elseif($row->quantity < $row->Real_quantity)
                                <label class="btn btn-success">قيمه الزياده بالمخزن ={!! $row->Real_quantity - $row->quantity!!}</label>
                            @else
                                <label class="btn btn-warning"> الكميات  متساويه</label>

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