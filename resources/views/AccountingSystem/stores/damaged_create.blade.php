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
            {!!Form::open( ['route' => 'accounting.stores.damaged_store' ,'class'=>'form phone_validate parsley-validate-form', 'method' => 'Post','files' => true]) !!}
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
                {!! Form::select("store_id",allstores(),null,['class'=>'form-control js-example-basic-single form_store_id','id'=>'form_store_id','placeholder'=>' اختر  المخزن' , 'required'])!!}
            </div>
            <div class="form-group col-md-4 pull-left">
                <label>اختر الصنف </label>
                {!! Form::select("product_id[]",products(),null,['class'=>'form-control js-example-basic-single product_id','multiple','id'=>'product_id','placeholder'=>' اختر  الصنف'])!!}
            </div>

            <div class="col-sm-6 col-md-4 pull-left">
                <label>اختر امين المخزن </label>
                {!! Form::select("user_id",keepers(),null,['class'=>'form-control js-example-basic-single storekeeper_id','id'=>'storekeeper_id','placeholder'=>' اختر امين المخزن'])!!}
            </div>
            <div class="products">
            </div>
            <div class="cost">
            </div>
            <div class="price">
            </div>
\
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
			$("select[multiple]").each(function(){
				$(this).parent().find("ul.dropdown-menu.inner").children('li:first-child').removeClass('selected')
				$(this).children('option:first-child').attr('selected' , false);
				$(this).children('option:first-child').attr('disabled' , 'disabled');
			})
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
