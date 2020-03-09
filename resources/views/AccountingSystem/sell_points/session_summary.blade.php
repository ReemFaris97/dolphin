@extends('AccountingSystem.layouts.master')
@section('title','ملخص الجلسه'.' ')
@section('parent_title','إدارة نقطة البيع')

{{-- @section('action', URL::route('accounting.stores.index')) --}}

@section('styles')

@endsection

@section('content')
<div class="panel panel-flat summaryy">
	<div class="panel-heading">
		<h5 class="panel-title"> عرض ملخص الجلسه </h5>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>

	<div class="panel-body">
		<div class="row">
			<div class="form-group col-md-4 pull-left">
			<label class="label label-info"> تاريخ بدايه الجلسة: </label>
			<span>
				{!! $session->start_session !!}
			</span>
		</div>
		<div class="form-group col-md-4 pull-left">
			<label class="label label-info"> تاريخ نهاية الجلسة: </label>
			<span>
				{!! $session->end_session !!}
			</span>
		</div>
		<div class="form-group col-md-4 pull-left">
			<label class="label label-info"> كود الجلسة: </label>
			<span>
				{!! $session->code !!}
			</span>
		</div>
		</div>
		
		<div class="row normal-lbls">
			<div class="form-group col-md-12 pull-left" style="margin-bottom:0">
				<label class="label label-info"> اجمالى المبيعات :</label>
			</div>
			<div class="form-group col-md-4 pull-left">
				<label class="label"> المدفوع كاش:</label>
				<span>
					{!!$sales_payed_cash !!}
				</span>
			</div>
			<div class="form-group col-md-4 pull-left">
				<label class="label"> المدفوع شبكة: </label>
				<span>
					{!! $sales_payed_network !!}
				</span>
			</div>
			<div class="form-group col-md-4 pull-left">
				<label class="label"> الاجمالى :</label>
				<span>
					{!! $sales_payed !!}
				</span>
			</div>
		</div>	
		<div class="row">
			<div class="form-group col-md-4 pull-left">
				<label class="label label-info"> اجمالى المرتجعات :</label>
				<span>
					{!!$returns_total!!}
				</span>
			</div>
			<div class="form-group col-md-4 pull-left">
				<label class="label label-info"> الصافى :</label>
				<span>
					{!! $sales_payed_cash - $returns_total !!}
				</span>
			</div>
		</div>
		<div class="row text-center">
			<a class="btn btn-warning" href="{{route('accounting.sales.end_session',$session->id)}}"> اغلاق الجلسة</a>
		</div>

		
		
	</div>

</div>

@endsection

@section('scripts')

<script>
	// Initialize and add the map
	function initMap() {
		// The location of Uluru
		var uluru = {
			lat: {
				{
					{
						isset($store) ? $store - > lat : '26.381861087276274'
					}
				}
			},
			lng: {
				{
					{
						isset($store) ? $store - > lng : '43.99479680000002'
					}
				}
			}
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsT140mx0UuES7ZwcfY28HuTUrTnDhxww&callback=initMap">
</script>
@stop