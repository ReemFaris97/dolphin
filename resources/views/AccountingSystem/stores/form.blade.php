@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
@if( isset($store))
@if($store->model_type=='App\Models\AccountingSystem\AccountingBranch')
<div class="form-group r-group col-md-3">
	<label class="display-block text-semibold">المستودع تابع الى</label>
	<label class="radio-inline">
		<input type="radio" name="radio-inline-left" class="styled" id="company" onclick="myFunction()" disabled>
		شركة
	</label>
	<label class="radio-inline">
		<input type="radio" name="radio-inline-left" id="branch" class="styled" onclick="myFunction2()" checked="checked">
		فرع
	</label>
</div>
@elseif($store->model_type=='App\Models\AccountingSystem\AccountingCompany')
<div class="form-group r-group col-md-3">
	<label class="display-block text-semibold">المستودع تابع الى</label>
	<label class="radio-inline">
		<input type="radio" name="radio-inline-left" class="styled" id="company" checked="checked" onclick="myFunction()">
		شركة
	</label>
	<label class="radio-inline">
		<input type="radio" name="radio-inline-left" id="branch" class="styled" onclick="myFunction2()" disabled>
		فرع
	</label>
</div>
@endif
@else
<div class="form-group r-group col-md-3">
	<label class="display-block text-semibold">المستودع تابع الى</label>
	<label class="radio-inline">
		<input type="radio" name="radio-inline-left" class="styled" id="company" checked="checked" onclick="myFunction()">
		شركة
	</label>
	<label class="radio-inline">
		<input type="radio" name="radio-inline-left" id="branch1" class="styled" onclick="myFunction2()">
		فرع
	</label>
</div>


@endif
@if( isset($store))
@if($store->model_type=='App\Models\AccountingSystem\AccountingBranch')
<div class="form-group  col-md-3 pull-left branches">
	<label> اسم الفرع التابع لها المستودع: </label>
	{!! Form::select("branch_id",$branches,$store->model_id,['class'=>'form-control js-example-basic-single','required'])!!}
</div>
@elseif($store->model_type=='App\Models\AccountingSystem\AccountingCompany')
<div class="form-group  col-md-3 pull-left companies">
	<label> اسم الشركة التابع لها المستودع: </label>
	{!! Form::select("company_id",$companies,$store->model_id,['class'=>'form-control js-example-basic-single','required'])!!}
</div>
@endif
@else
<div class="form-group  col-md-3 pull-left companies">
	<label> اسم الشركة التابع لها المستودع: </label>
	{!! Form::select("company_id",$companies,null,['class'=>'form-control js-example-basic-single','placeholder'=>'اختر الشركة','id'=>'company_id'])!!}
</div>
<div class="form-group  col-md-3 pull-left branches">
	<label> اسم الفرع التابع لها المستودع: </label>
	{!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single','placeholder'=>'اختر الفرع','id'=>'branch_id'])!!}
</div>
@endif

@if( isset($store))
@if ($store->type==1)

<div class="form-group r-group  col-md-3">
	<label class="display-block text-semibold"> نوع المستودع</label>
	<label class="radio-inline">
		<input type="radio" name="type" class="styled type" value="1" checked="checked" disabled>
		رئيسى
	</label>

	<label class="radio-inline">
		<input type="radio" name="type" class="styled type" value="0" disabled>
		فرعى
	</label>
</div>
@else
<div class="form-group r-group  col-md-3">
	<label class="display-block text-semibold"> نوع المستودع</label>
	<label class="radio-inline">
		<input type="radio" name="type" class="styled type" value="1" disabled>
		رئيسى
	</label>

	<label class="radio-inline">
		<input type="radio" name="type" class="styled type" value="0" checked="checked" disabled>
		فرعى
	</label>
</div>
@endif
@else
<div class="form-group r-group  col-md-3">
	<label class="display-block text-semibold"> نوع المستودع</label>
	<label class="radio-inline">
		<input type="radio" name="type" class="styled type" checked="checked" id="basic" value="1">
		رئيسى
	</label>
	<label class="radio-inline">
		<input type="radio" name="type" class="styled type" id="part" value="0">
		فرعى
	</label>
</div>
@endif


<div class="basic">

</div>


<div class="form-group col-md-3 pull-left">
	<label> كود المستودع: </label>
	{!! Form::text("code",null,['class'=>'form-control','placeholder'=>' كود المستودع','required'])!!}
</div>


<div class="form-group col-md-3 pull-left">
	<label>اسم المستودع باللغة العربية: </label>
	{!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>' اسم المستودع باللغة العربية','required'])!!}
</div>

<div class="form-group col-md-3 pull-left">
	<label>اسم المستودع باللغة الانجليزية: </label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">اختيارى</span>
	{!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>' اسم المستودع باللغة الانجليزية '])!!}
</div>


<div class="form-group col-md-3 pull-left">
	<label>عنوان المستودع: </label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">اختيارى</span>
	{!! Form::text("address",null,['class'=>'form-control','placeholder'=>' عنوان المستودع '])!!}
</div>


<div class="form-group col-md-3 pull-left">
	<label> مساحة المستودع: </label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">بالمتر المربع</span>
	{!! Form::text("width",null,['class'=>'form-control','placeholder'=>' مساحة المستودع'])!!}
</div>


@if( isset($store))
@if ($store->status==1)
<div class="form-group r-group  col-md-3 pull-left">
	<label class="display-block text-semibold"> حالة المستودع</label>
	<label class="radio-inline">
		<input type="radio" name="status" class="styled" value="1" id="rent" onclick="myFunction3()" checked="checked">
		ايجار
	</label>

	<label class="radio-inline">
		<input type="radio" name="status" class="styled" value="0" onclick="myFunction4()">
		تمليك
	</label>
</div>
@else
<div class="form-group r-group  col-md-3 pull-left">
	<label class="display-block text-semibold"> حالة المستودع</label>
	<label class="radio-inline">
		<input type="radio" name="status" class="styled" value="1" id="rent" onclick="myFunction3()">
		ايجار
	</label>
	<label class="radio-inline">
		<input type="radio" name="status" class="styled" value="0" onclick="myFunction4()" checked="checked">
		تمليك
	</label>
</div>
@endif
@else
<div class="form-group r-group  col-md-3 pull-left">
	<label class="display-block text-semibold"> حالة المستودع</label>
	<label class="radio-inline">
		<input type="radio" name="status" class="styled" id="rent" value="1" onclick="myFunction3()">
		ايجار
	</label>
	<label class="radio-inline">
		<input type="radio" name="status" class="styled" id="ownership" value="0" onclick="myFunction4()" checked="checked">
		تمليك
	</label>
</div>
@endif
<div class="rent  col-md-9 no-padding">
	<div class="form-group  col-md-4">
		<label> تكلفة الايجار: </label>
		{!! Form::text("cost",null,['class'=>'form-control','placeholder'=>' تكلفة الايجار'])!!}
	</div>
	<div class="form-group  col-md-4">
		<label> تاريخ بداية الايجار: </label>
		{!! Form::date("from",null,['class'=>'form-control'])!!}
	</div>
	<div class="form-group  col-md-4">
		<label> تاريخ نهاية الايجار: </label>
		{!! Form::date("to",null,['class'=>'form-control'])!!}
	</div>
</div>
<div class="form-group col-md-3 pull-left">
	<label>اختر امين المستودع </label>
	{!! Form::select("user_id",storekeepers(),null,['class'=>'form-control js-example-basic-single ','required'])!!}
</div>
@if( isset($store))
@if ($store->is_active==1)
<div class="form-group r-group col-md-3">
	<label class="display-block text-semibold"> تفعيل المستودع</label>
	<label class="radio-inline right30">
		<input type="radio" name="is_active" class="styled" value="1" checked>
		مفعل
	</label>

	<label class="radio-inline right30">
		<input type="radio" name="is_active" class="styled" value="0">
		غير مفعل
	</label>
</div>
@else
<div class="form-group r-group col-md-3">
	<label class="display-block text-semibold"> تفعيل المستودع</label>
	<label class="radio-inline right30">
		<input type="radio" name="is_active" class="styled" value="1">
		مفعل
	</label>
	<label class="radio-inline right30">
		<input type="radio" name="is_active" class="styled" value="0" checked>
		غير مفعل
	</label>
</div>
@endif
@else
<div class="form-group r-group col-md-3">
	<label class="display-block text-semibold"> تفعيل المستودع</label>
	<label class="radio-inline right30">
		<input type="radio" name="is_active" value="1" checked>
		مفعل
	</label>
	<label class="radio-inline right30">
		<input type="radio" name="is_active" value="0">
		غير مفعل
	</label>
</div>
@endif
@if( isset($store))
<div class="form-group pull-left col-md-3">
	<label>صوره المستودع الحالية : </label>
	<img src="{{getimg($store->image)}}" style="width:100px; height:100px" class="file-styled">
</div>
@endif
<div class="form-group pull-left col-md-3">
	<label>صوره المستودع </label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">اختيارى</span>
	{!! Form::file("image",null,['class'=>'file-styled'])!!}
</div>
<div class="form-group col-md-12">
<label> تحديد موقع المستودع على الخريطة </label>
	<div class="form-group">
		<div id="map" style="width: 100%; height: 300px;"></div>
		<div class="clearfix">&nbsp;</div>
		<div class="m-t-small map-inputs">
			<div class="form-group col-md-6">
				<label class="p-r-small control-label">خط الطول</label>
				{{ Form::text('lat', null,['id'=>'lat','class'=>'form-control','required']) }}
			</div>
		
			<div class="form-group col-md-6">
				<label class="p-r-small  control-label">خط العرض </label>
				{{ Form::text('lng', null,['id'=>'lng','class'=>'form-control','required']) }}
			</div>
		</div>
	</div>
</div>
<div class="text-center col-xs-12">
	<div class="text-right">
		<button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
	</div>
</div>
@section('scripts')
<script>
	$(document).ready(function() {
		$('.companies').show();
		$('.branches').hide();
		$(".rent").hide();
		$('.js-example-basic-single').select2();
		@if(isset($store))
		if ($('#rent').is(':checked')) {
			$(".rent").show();
		}
		@endif
	});
</script>
<script>
	function myFunction() {
		$(".companies").show();
		$(".branches").hide();
	}
	function myFunction2() {
		$(".companies").hide();
		$(".branches").show();
	}
	function myFunction3() {
		$(".rent").show();
	}
	function myFunction4() {
		$(".rent").hide();
	}
</script>
<script>
	// Initialize and add the map
	function initMap() {
		// The location of Uluru
		var uluru = {
			lat: {{isset($store) ? $store -> lat : '26.381861087276274'}},
			lng: {{isset($store) ? $store -> lng : '43.99479680000002'}}
		};
		// The map, centered at Uluru
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 15,
			center: uluru
		});
		// The marker, positioned at Uluru
		var marker = new google.maps.Marker({
			position: uluru,
			map: map,
			draggable: true,
		});
		marker.addListener('drag', handleEvent);
		marker.addListener('dragend', handleEvent);
		document.getElementById('lat').value = 26.381861087276274;
		document.getElementById('lng').value = 43.99479680000002;
	}
	function handleEvent(event) {
		document.getElementById('lat').value = event.latLng.lat();
		document.getElementById('lng').value = event.latLng.lng();
	}
</script>
<script>
	$(".type").on('change', function() {
		var idddd = $(this).val();
		if (idddd == 0) {
			if ($('#company').is(':checked')) {
				var company_id = $('#company_id').val();
				$.ajax({
					url: "/accounting/company_stores/" + company_id,
					type: "GET",
				}).done(function(data) {
					$('.basic').empty();
					$('.basic').append(data.data);
				}).fail(function(error) {
					console.log(error);
				});
			}
			if ($('#branch1').is(':checked')) {
				branch_id = $('#branch_id').val();

				$.ajax({
					url: "/accounting/branch_stores/" + branch_id,
					type: "GET",

				}).done(function(data) {

					$('.basic').empty();
					$('.basic').append(data.data);

				}).fail(function(error) {
					console.log(error);
				});
			}

		} else if (idddd == 1) {
			$('.basic').empty();
		}
	});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsT140mx0UuES7ZwcfY28HuTUrTnDhxww&callback=initMap">
</script>
@endsection