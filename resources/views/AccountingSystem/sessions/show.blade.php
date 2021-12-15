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



        <table class="table datatable-button-init-basic">
            <thead>
            <tr>
                <th> الموظف </th>
                <th> التاريخ </th>
                <th> رقم الفاتوره</th>
                <th>النوع</th>
                <th>عدد الاصناف</th>
                <th>الاجمالى</th>
                <th>عرض</th>

            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{@$sale->user->name}}</td>
                    <td>{{$sale->created_at}}</td>
                    <td>{{$sale->id}}</td>
                    <td>المبيعات</td>
                    <td>{{$sale->items_count}}</td>
                    <td>{{$sale->amount}}</td>
                    <td><a href="{{route('accounting.sales.show',$sale)}}" target="_blank"><i class="fa fa-eye"></i></a></td>
                </tr>
            @endforeach

            @foreach($returns as $return)
                <tr>
                    <td>{{@$return->user->name}}</td>
                    <td>{{$return->created_at}}</td>
                    <td>{{$return->id}}</td>
                    <td>مرتجعات</td>
                    <td>{{$return->items_count}}</td>
                    <td>{{$return->amount}}</td>
                    <td><a href="{{route('accounting.sales.show_return',$return)}}" target="_blank"><i class="fa fa-eye"></i></a></td>

                </tr>
            @endforeach
            </tbody>

            <tfooter>


                <tr style="background-color: rgb(235, 234, 234)">
                    <td   class="text-center" colspan="2" rowspan="2">  المبيعات</td>
                    {{-- -------------------------------- --}}
                    <td class="hidden d-none"></td>

                    <td  class="text-center" > الكاش</td>
                    <td  class="text-center">{{$sales->sum('cash')}}</td>

                    <td class="text-center" >الشبكة</td>
                    <td  class="text-center">
                        {{$sales->sum('network')}}
                    </td>
                </tr>
                <tr style="background-color: rgb(235, 234, 234)">
                    <td class="hidden d-none"></td>
                    <td class="hidden d-none"></td>
                    {{-- ------------------------ --}}


                    <td class="text-center hidden d-none" > اجمالى الكمية </td>

                    <td  class="text-center hidden d-none">{{$total_sales_item=$sales->sum('items_count')}}</td>
                    <td class="text-center" colspan="3">اجمالى الكاش والشبكة</td>
                    <td  class="text-center">
                        {{$total_sales_amount=$sales->sum('amount')}}
                    </td>
                </tr>

                <tr style="background-color: rgb(235, 234, 234)">
                    <td class="text-center" colspan="2" >المرتجعات</td>
                    <td class="hidden d-none"></td>
                    <td class="text-center hidden d-none">اجمالى الكمية</td>

                    <td class="text-center hidden d-none">{{$total_returns_item= $returns->sum('items_count')}}</td>
                    <td class="text-center" colspan="3"> المبلغ</td>

                    <td  class="text-center" >{{$total_returns_amount= $returns->sum('amount')}}</td>
                </tr>
                </tr>
                {{--
                                    <tr style="background-color: rgb(235, 234, 234)">
                                        <td class="hidden d-none" ></td>
                                        <td class="hidden d-none"></td>
                                        <td class="text-center hidden d-none">اجمالى الكمية</td>

                                        <td class="text-center hidden d-none">{{$total_returns_item= $returns->sum('items_count')}}</td>
                                        <td class="text-center" colspan="3"> المبلغ</td>

                                        <td  class="text-center" >{{$total_returns_amount= $returns->sum('amount')}}</td>
                                    </tr> --}}


                <tr style="background-color: rgb(235, 234, 234)">
                    <td class="text-center" colspan="2">الصافى</td>
                    <td class="hidden d-none"></td>
                    <td class="text-center hidden d-none">


                    </td>

                    <td  class="text-center" class="text-center hidden d-none" ></td>
                    <td class="text-center"colspan="2" >صافى المبلغ</td>

                    <td  class="text-center" colspan="2">{{$total_sales_amount-$total_returns_amount}}</td>
                </tr>


            </tfooter>
        </table>


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
			text: "هل تريد حذف هذة الفاتورة ؟",
			icon: "warning",
			buttons: ["الغاء", "موافق"],
			dangerMode: true,

		}).then(function(isConfirm) {
			if (isConfirm) {
				document.getElementById('delete-form' + item_id).submit();
			} else {
				swal("تم االإلفاء", "حذف  الفاتورة  تم الغاؤه", 'info', {
					buttons: 'موافق'
				});
			}
		});
	}
</script>
@stop








<!--=================================================================================================================================-->
