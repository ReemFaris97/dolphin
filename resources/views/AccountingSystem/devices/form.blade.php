@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الشركة </label>
					{!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع له الجهاز '])!!}
				</div>

				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الفرع التابع </label>
					{!! Form::select("branch_id",branches(),null,['class'=>'form-control selectpicker branch_id','id'=>'branch_id','multiple','placeholder'=>' اختر اسم الفرع التابع له الجهاز '])!!}
				</div>

				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left" id="store_id">
					<label> اسم المخزن </label>
					@if (!isset($product))
						{!! Form::select("store_id",stores(),null,['class'=>'form-control js-example-basic-single store_id','id'=>'store_id','placeholder'=>' اختر اسم المخزن التابع له الجهاز '])!!}

					@else

						<select class="form-control js-example-basic-single pull-right" name="store_id">
							@foreach ($stores as $store)
								@if ($product->store_id == $store->id)
									<option value="{{$store->id}}"  selected>{{$store->ar_name}}</option>
								@else
									<option value="{{$store->id}}" >{{$store->ar_name}}</option>
								@endif
							@endforeach

						</select>
					@endif
				</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم  الجهاز  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم الجهاز  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>كود   الجهاز  </label>
    {!! Form::text("code",null,['class'=>'form-control','placeholder'=>'  كود الجهاز  '])!!}
</div>



<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();


        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

    <script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
    <script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>
@endsection
