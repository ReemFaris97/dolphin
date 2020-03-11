@extends('AccountingSystem.layouts.master')
@section('title','اضافة فاتورة مرتجع')
@section('parent_title','إدارة المشتريات')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> اضافه فاتورة مرتجع جديد </h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>

    <div class="panel-body">
        {!!Form::open( ['route' => 'accounting.puchaseReturns.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif



        <div class="form-group col-md-4 pull-left">
            <label>اختر الفاتوره </label>
            {!! Form::select("purchase_id",$purchases,null,['class'=>'form-control js-example-basic-single purchase_id','id'=>'purchase_id','placeholder'=>' اختر الفاتورة'])!!}
        </div>
        <div class="form-group col-md-4 pull-left">
            <label>اختر الصنف </label>
            {!! Form::select("product_id[]",products(),null,['class'=>'form-control js-example-basic-single product_id','multiple','id'=>'product_id','placeholder'=>' اختر الصنف'])!!}
        </div>
        <div class="products">
        </div>


        <div class="cost">
        </div>
        <div class="price">

        </div>

        <div class="text-center col-md-12">
            <div class="text-right">
                <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
            </div>
        </div>

        {!!Form::close() !!}
    </div>
</div>
</div>
@endsection
@section('scripts')


<script>


    $(".product_id").on('change', function() {
        var purchase = $('#purchase_id').val();
        var id = $(this).val();
        console.log(id);
        $.ajax({
            url: "/accounting/productpurchase",
            type: "get",
            data: {
                'ids': id,
                'purchase': purchase
            }


        }).done(function(data) {

            $('.products').html(data.data);

            $(".quantity").change(function() {
                var sum_Total = 0;


                var x = $(this).attr('data-id');
//                alert('id = ' + x);

                var big_T = $(this).parents(".parent-tr").find(".all").val();
                var quant_V = $(this).val();
                var one_Product = parseInt($(this).parents(".parent-tr").find(".one-pr").html());

                var real_T = parseInt(big_T - quant_V);

                var one_P = $("#" + x);
//                $(one_P).html(Number(real_T * one_P));
                $(one_P).html(parseInt(real_T * one_Product));

                $(".price_for").each(function(){
                    sum_Total += parseFloat($(this).html());
                    $("#result-total").html(sum_Total);
                });

                $("#result").val(sum_Total);
                if($(this).val().trim().length === 0){
                    $(this).val(0);
                  }


            });



        }).fail(function(error) {
            console.log(error);
        });

    });

</script>

<script>
    $(".quantity").on('change', function() {


        var quantity = $(this).val();
        var selling_price = $(".selling_price").val();
        var purchasing_price = $(".purchasing_price").val();
        var cost = quantity * selling_price;
        var price = quantity * purchasing_price;
        $(".cost").empty()


    });

</script>
<script src="{{asset('admin/assets/js/get_products_by_purchase.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection