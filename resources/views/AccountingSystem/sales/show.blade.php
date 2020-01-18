@extends('AccountingSystem.layouts.master')
@section('title','عرض   الفاتوره'.' '. $sale->id)
@section('parent_title','إدارة  المبيعات')

@section('action', URL::route('accounting.stores.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض    فاتورة  {!! $sale->id!!}</h5>
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
                <label class="label label-info">  اسم الشركة   : </label>
                <span>{!! optional($sale->company)->ar_name !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  اسم الفرع   : </label>
                <span>{!! optional($sale->branch)->ar_name !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  اسم المخزن   : </label>
                <span>{!! optional($sale->store)->ar_name !!}</span>
            </div>


            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  تاريخ الفاتورة
                    : </label>
                <span>{!! $sale->created_at !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">  رقم الفاتوره
                    : </label>
                <span>{!! $sale->bill_num !!}</span>
            </div>
            <div class="form-group col-md-6 pull-left">
                <label class="label label-info">
                 طريقة الدفع     : </label>
                <span>{!! $sale->id !!}</span>
            </div>

            <div class="form-group col-md-6 pull-left">
                <label class="label label-info"> اسم العميل
                    : </label>
                <span>{!! $sale->client->name !!} </span>
            </div>



            <div class="clearfix">

            </div>

            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المنتج </th>
                    {{--<th> نوع المنتج </th>--}}

                    <th>  الباركود </th>
                    <th> الكمية  </th>
                    <th> السعر  </th>


                </tr>
                </thead>
                <tbody>
                @foreach($product_items as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>
                        <td>{!! $row->product-> bar_code!!}</td>
                        <td>{!! $row->quantity!!}</td>
                        <td>{!! $row->price!!}</td>
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
