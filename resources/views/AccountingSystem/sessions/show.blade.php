@extends('AccountingSystem.layouts.master')
@section('title','عرض الجلسة'.' '. $session->id)
@section('parent_title','إدارة المبيعات')

@section('action', URL::route('accounting.sessions.index'))


@section('content')

<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"> عرض الجلسة {!! $session->id!!}</h5>
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
			<label class="label label-info">  رقم الجلسة : </label>
			<span>{!! $session->code !!}</span>
		</div>

		<div class="form-group col-md-6 pull-left">
			<label class="label label-info"> اسم الوردية : </label>
			<span>{!! optional($session->shift)->name !!}</span>
		</div>

		<div class="form-group col-md-6 pull-left">
			<label class="label label-info"> اسم الكاشير : </label>
			<span>{!! optional($session->user)->name !!}</span>
		</div>


        <div class="form-group col-md-6 pull-left">
			<label class="label label-info">  كود الجهاز : </label>
			<span>{!! optional($session->device)->code !!}</span>
		</div>
		<div class="form-group col-md-6 pull-left">
			<label class="label label-info"> بداية الجلسة
				: </label>
			<span>{!! $session->start_session !!}</span>
		</div>
		<div class="form-group col-md-6 pull-left">
			<label class="label label-info"> نهاية الجلسة
				: </label>
			<span>{!! $session->end_session !!}</span>
		</div>
		<div class="form-group col-md-6 pull-left">
			<label class="label label-info">
			عهده الجلسة : </label>
			<span>{!! $session->custody !!}</span>
		</div>





        <div class="form-group col-md-6 pull-left">
			<label class="label label-info">
			حالة الجلسة : </label>
            @if($session->status=='open')
            <label class="lable lable-success">مفتوحة </label>
            @elseif($session->status=='closed')
            <label class="lable lable-warning">مغلقة </label>
               @else
               <label class="lable lable-warning">تم  تاكيد الاغلاق </label>

            @endif

		</div>




</div>


@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		$(".print").click(function() {
			window.print();
		})
	});
</script>
<script>
	function Delete(id) {
		var item_id = id;
		console.log(item_id);
		swal({
			title: "هل أنت متأكد ",
			text: "هل تريد حذف هذة الشركة ؟",
			icon: "warning",
			buttons: ["الغاء", "موافق"],
			dangerMode: true,

		}).then(function(isConfirm) {
			if (isConfirm) {
				document.getElementById('delete-form' + item_id).submit();
			} else {
				swal("تم االإلفاء", "حذف  الشركة  تم الغاؤه", 'info', {
					buttons: 'موافق'
				});
			}
		});
	}
</script>
@stop








<!--=================================================================================================================================-->
