@extends('AccountingSystem.layouts.master')
@section('title','اضافة التالف')
@section('parent_title','إدارة  المخازن')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">اضافه التالف</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.stores.damaged_store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{--<div class="form-group col-md-4 pull-left">--}}
                {{--<label>اختر المخزن الية </label>--}}
                {{--{!! Form::select("to_store_id",allstores(),null,['class'=>'form-control js-example-basic-single ','placeholder'=>'  اختر  المخزن'])!!}--}}
            {{--</div>--}}
            <div class="form-group col-md-4 pull-left">
                <label>اختر المخزن  </label>
                {!! Form::select("store_id",allstores(),null,['class'=>'form-control js-example-basic-single form_store_id','placeholder'=>' اختر  المخزن'])!!}
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

            var id = $(this).val();
            console.log(id);

            $.ajax({
                url:"/accounting/productsingle",
                type:"get",
                data:{'ids':id}

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

            // $(".cost").append('<div class="form-group col-md-4 pull-left"> <label> التكلفة</lable> <input type="text" name="cost" value="' + cost + '"  class="form-control" readonly> </div>');
            // $(".price").empty()
            // $(".price").append('<div class="form-group col-md-4 pull-left"> <label> القيمة</lable> <input type="text" name="price" value="' + price + '"  class="form-control" readonly> </div>');

        });

    </script>
    <script src="{{asset('admin/assets/js/get_products_by_store.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection
