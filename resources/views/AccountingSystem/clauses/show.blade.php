@extends('AccountingSystem.layouts.master')
@section('title','عرض سند')
@section('parent_title','إدارة سندات القبض والصرف')
@section('styles')
<style>
	.form-group label:not(.label-info), .media-body label:not(.label-info) {
    font-size: 20px;
}
	.form-group label:not(.label-info) + span, .media-body label:not(.label-info) + span {
    padding-right: 10px;
    font-size: 16px;
}
	.row.banks{
		display: inline-block;
		width: 100%;
		padding: 0 15px;
	}
	.row.banks img{
		height: 150px;
		width: 100%
	}
	.print-wrapper{
		text-align: center;
		display: inline-block;
		width: 100%;
		padding: 15px
	}
	@media print {
		@page {size: portrait}
    .myDivToPrint {
        background-color: white !important;
        height: 100%;
        width: 100%;
        position: fixed;
        top: 0;
        left: 0;
        margin: 0;
        font-size: 14px;
        line-height: 18px;
		z-index: 999999 !important;
		padding-top: 20px !important
    }
	.print-wrapper{
		display: none !important
	}
		h3 {
    page-break-after: always;
  }
}
</style>
@endsection

@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"> عرض سند </h5>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>
	<div class="panel-body myDivToPrint">
	
	
		<div class="sanad-design">
			<div class="sanad-header-wrap">
				<div>التاريخ : <span class="fillable"> 15 / 2 / 2020 </span></div>
				<div class="sanad-head-mid">
					<img src="{!!getimg($clause->company->image)!!}" alt="اسم الشركة">
					<h3><span class="fillable">{{optional($clause->company)->name}}</span></h3>
					<p>نوع السند / <span class="fillable">
							@if ($clause->type=="expenses")
							صرف
							@elseif($clause->type=="revenue")
								 قبض
							@endif
						</span>
					</p>
				</div>
				<div>رقم السند : <span class="fillable"> {{$clause->num}} </span></div>
			</div>
			<div class="sanad-body-wap">
				@if ($clause->type=="expenses")
				<p>
					 تفضلوا بالصرف للمكرم / السيد : <span class="fillable">
					@if ($clause->concerned=="client")
							{{optional($clause->client)->name}}
						@elseif($clause->concerned=="supplier")
							{{optional($clause->supplier)->name}}
						@else
							{{$clause->name}}
						@endif
					</span>
				</p>
				@elseif($clause->type=="revenue")

				<p>
					تم الاستلام من المكرم / السيد :  <span class="fillable">
					@if ($clause->concerned=="client")
							{{optional($clause->client)->name}}
						@elseif($clause->concerned=="supplier")
							{{optional($clause->supplier)->name}}
						@else
							{{$clause->name}}
						@endif
					</span>
				</p>
				@endif
				<p>
					وذلك تحت اسم بند / <span class="fillable">{{optional($clause->benod)->ar_name}}</span> بمبلغ وقدره <span class="fillable"> {{$clause->amount}} </span>
				</p>
				<p>
				وذلك تحت بيان / <span class="fillable">{{$clause->description}} </span>
				</p>
				<p>
					طريقة الدفع / <span class="fillable">

						@if ($clause->payment=="cash")
							نقدى
						@elseif($clause->payment=="network")
							شبكة
						@elseif($clause->payment=="check")
							شيك

						@else
							تحويل بنكى

						@endif
					</span>
				</p>
					@if(isset($clause->bank_id))
				<div class="bank-wrap">
					<p>
						<span class="col-xs-6"> اسم البنك : <span class="fillable"> {{optional($clause->bank)->name}} </span> </span>
						<span class="col-xs-6"> رقم التحويل أو رقم الشيك : <span class="fillable">   {{$clause->num_transaction}} </span> </span>
					</p>
					<p class="ta7weel-img">
						<span>صورة التحويل أو الشيك</span>
						<img src="{!!getimg($clause->image)!!}" alt="صورة التحويل" >
					</p>
				</div>
					@endif
				<p>
					من خلال خزينة الدفع : <span class="fillable"> {{optional($clause->safe)->name}}</span>
				</p>
			</div>
			<div class="sanad-footer-wrap">
				<div>المحاسب / <span class="fillable">   </span></div>
				<div>المستلم / <span class="fillable">   </span></div>
				<div>المدير / <span class="fillable">   </span></div>
			</div>
		</div>
	
<!--
<div class="tempo">
			<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
			<label> السند ل </label>
			@if ($clause->concerned=="client")
			<span> عميل </span>
			@elseif($clause->concerned=="supplier")
			<span> مورد</span>
			@else
			<span> عام</span>
			@endif
		</div>
		
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
			<label> رقم السند</label>
			<span>{{$clause->num}}</span>
		</div>
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
			<label> اسم الشركة </label>
			<span>{{optional($clause->company)->name}}</span>
		</div>
		@if ($clause->concerned=="client")
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left clients">
			<label> اسم العميل</label>
			<span>{{optional($clause->client)->name}}</span>
		</div>
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left clients">
			<label> رصيد العميل</label>
			<span>{{optional($clause->client)->amount}}</span>
		</div>
		@endif
		@if ($clause->concerned=="supplier")
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left suppliers">
			<label> اسم المورد </label>
			<span>{{optional($clause->supplier)->name}}</span>
		</div>
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left suppliers">
			<label> رصيد المورد </label>
			<span>{{optional($clause->supplier)->balance}}</span>
		</div>
		@endif
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
			<label> نوع السند </label>
			@if ($clause->type=="expenses")
			<span> صرف </span>
			@elseif($clause->type=="revenue")
			<span> قبض</span>
			@endif
		</div>
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left benods">
			<label> اسم البند </label>
			<span>{{optional($clause->benod)->ar_name}}</span>
		</div>
		@if ($clause->concerned=="general")
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left name">
			<label>المكرم /السيد </label>
			<span>{{$clause->name}}</span>
		</div>
		@endif
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
			<label> التاريخ</label>
			<span>{{$clause->date}}</span>
		</div>
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left ">
			<label>البيان </label>
			<span>{{$clause->description}}</span>
		</div>
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
			<label>المبلغ </label>
			<span>{{$clause->amount}}</span>
		</div>
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
			<label> خزينة الدفع</label>
			<span>{{optional($clause->safe)->name}}</span>
		</div>
		<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left ">
			<label>طريقه الدفع</label>
			@if ($clause->payment=="cash")
			<span> نقدى </span>
			@elseif($clause->payment=="network")
			<span class="label label-success"> شبكة</span>
			@elseif($clause->payment=="bank_translation")
			<span class="label label-info"> تحويل بنكى </span>
			@elseif($clause->payment=="check")
			<span class="label label-warning"> شيك</span>
			@endif
		</div>
		<hr />
		@if(isset($clause->bank_id))
		<div class="banks row">
			<div class="form-group col-md-4  pull-left">
				<label> اسم البنك </label>
				<span>{{optional($clause->bank)->name}}</span>
			</div>
			<div class="form-group col-md-4 pull-left">
				<label>رقم التحويل او الشيك </label>
				<span>{{$clause->num_transaction}}</span>
			</div>
			<div class="form-group col-md-4 pull-left">
				<label>صورة التحويل</label>
				<span><img src="{!!getimg($clause->image)!!}"></span>
			</div>
		</div>
		@endif
		<div class="form-group col-md-12 col-sm-12 col-xs-12 pull-left" >
			<label> ملاحظات</label>
			<span>{{$clause->notes}}</span>
		</div>
		<h3></h3>
		
</div>
-->

	</div>
	<div class="row print-wrapper">
		<button class="btn btn-success" onclick="window.print()">طباعة</button>
	</div>
</div>
@endsection