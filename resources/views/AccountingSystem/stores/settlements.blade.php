@extends('AccountingSystem.layouts.master')
@section('title','تسوية أرصدة بداية كمية الاصناف ')
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  تسوية ارصده بداية كمية الاصناف</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">



                <div class="form-group col-md-4 pull-left">
                    <label>اختر المخزن منه </label>
                    {!! Form::select("store_id",allstores(),null,['class'=>'form-control js-example-basic-single form_store_id','id'=>'form_store_id','placeholder'=>' اختر  المخزن'])!!}
                </div>
                <div class="form-group col-md-4 pull-left">
                    <label>اختر الصنف </label>
                    {!! Form::select("product_id[]",products_not_settement(),null,['class'=>'form-control js-example-basic-single product_id','multiple','id'=>'product_id'])!!}
                </div>



            </div>
        </div>
        <!--End Page-Title -->

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.products_settlement.store' ,'class'=>'form phone_validate', 'method' => 'PATCH','files' => true]) !!}
              <input type="hidden" name="store_id" id="store_id">

            <div class="products">

            </div>

            <div class="text-center col-md-12">
                <div class="text-right">
                    <button type="submit" class="btn btn-success" onclick="this.form.submit()"> تسويه رصيد<i class="icon-arrow-left13 position-right"></i></button>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('scripts')

    <script src="{{asset('admin/assets/js/get_products_settlement_by_store.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script>
        $(".product_id").on('change', function() {

            var store_id = $('#form_store_id').val();

            $('#store_id').val(store_id);
            var id = $(this).val();
            console.log(id);

            $.ajax({
                url:"/accounting/productsettlement",
                type:"get",
                data:{'ids':id,'store_id':store_id}

            }).done(function (data) {

                $('.products').html(data.data);
            }).fail(function (error) {
                console.log(error);
            });

        });

    </script>

    <script>
        $(".quantity").on('change', function() {


            var quantity = $(this).val();
            var selling_price = $(".selling_price").val();
            var purchasing_price = $(".purchasing_price").val();
            var cost=quantity*selling_price;
            var  price=quantity*purchasing_price;
            $(".cost").empty()

            $(".cost").append('<div class="form-group col-md-4 pull-left"> <label> التكلفة</lable> <input type="text" name="cost" value="' + cost + '"  class="form-control" readonly> </div>');
            $(".price").empty()
            $(".price").append('<div class="form-group col-md-4 pull-left"> <label> القيمة</lable> <input type="text" name="price" value="' + price + '"  class="form-control" readonly> </div>');

        });

    </script>
@stop