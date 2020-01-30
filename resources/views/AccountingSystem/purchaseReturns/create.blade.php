@extends('AccountingSystem.layouts.master')
@section('title','اضافة  فاتورة مرتجع')
@section('parent_title','إدارة   المشتريات')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">   اضافه  فاتورة مرتجع  جديد </h5>
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
                <label>  رقم الفاتوره </label>
                {!! Form::select("product_id[]",products(),null,['class'=>'form-control js-example-basic-single product_id','multiple','id'=>'product_id','placeholder'=>' اختر  الصنف'])!!}
            </div>


            <div class="form-group col-md-4 pull-left">
                <label>اختر الصنف </label>
                {!! Form::select("product_id[]",products(),null,['class'=>'form-control js-example-basic-single product_id','multiple','id'=>'product_id','placeholder'=>' اختر  الصنف'])!!}
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
            var store_id = $('#form_store_id').val();

            var id = $(this).val();
            console.log(id);

            $.ajax({
                url:"/accounting/productdamage",
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


        });

    </script>
    <script src="{{asset('admin/assets/js/get_products_by_store.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection
