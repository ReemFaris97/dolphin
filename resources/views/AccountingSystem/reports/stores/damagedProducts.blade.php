@extends('AccountingSystem.layouts.master')
@section('title','تقرير التالف')
@section('parent_title','التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}

@section('styles')
<style>
    .filter {
        margin-bottom: 30px;
    }
    .center{
        margin-left: 90px;
    }
</style>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير التالف</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <section class="filter">
                <div class="yurSections">
                    <div class="row">
                        <div class="col-xs-12">
                            {!!Form::open( ['route' => 'accounting.reports.damaged-products' ,'class'=>'form phone_validate', 'method' => 'GET','files' => true]) !!}
                            @include('AccountingSystem.reports.stores.filter')
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>

            <div id="print-window">

            <table class="table datatable-button-init-basic">
               
				
                <thead>
                <tr class="normal-bgc">
               		@if(isset($requests['company_id']))
                	<td class="company-imgg-td" colspan="8">
						@php($company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id']))
						<span><img src="{!!getimg($company->image)!!}" style="width:100px; height:100px"> </span>
               			<span>{{$company->name}}</span>
                	</td>
                	@endif
                	
                </tr>
                <tr  class="normal-bgc">
					@if(isset($requests['branch_id']))
						@php($branch=\App\Models\AccountingSystem\AccountingBranch::find($requests['branch_id']))
						<td class="footTdLbl" colspan="2">الفرع : <span>{{$branch->name}}</span></td>
					@endif
					
					@if(isset($requests['store_id']))
						@php($store=\App\Models\AccountingSystem\AccountingStore::find($requests['store_id']))
						<td class="footTdLbl" colspan="2">المخزن : <span>{{$store->ar_name}}</span></td>
					@endif
					
					@if(isset($requests['product_id']))
						@php($product=\App\Models\AccountingSystem\AccountingProduct::find($requests['product_id']))
						<td class="footTdLbl" colspan="2">الصنف : <span>{{$product->name}}</span></td>
					@endif
					
					@if(isset($requests['from']))
						<td class="footTdLbl" colspan="2"> من:<span>{{$requests['from']}}</span></td>
					@endif
					
					@if(isset($requests['to']))
						<td class="footTdLbl" colspan="2">إلى :<span>{{$requests['to']}}</span></td>
					@endif
					
					</tr>
                <tr>
                    <th>#</th>
                    <th> تاريخ اليوم </th>
                    <th> اسم الصنف </th>
                    <th>  كمية التالف  </th>
                    <th>  السعر </th>
                    <th>  إجمالي سعر التالف   </th>
                    <th>  المستخدم </th>
                    <th> وقت العملية </th>
                </tr>
                </thead>
                			

                <tbody>
                    @isset($damages)
                        @php($sum=0)
                        @php($quantities=0)
                @foreach($damages as $row)
                    @php( $quantities+=$row->quantity)
                    @php( $sum+=$row->product->purchasing_price * $row->quantity)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! date($row->created_at)!!}</td>
                        <td>{!! $row->product->name!!}</td>
                        <td>{!! $row->quantity ?? 0!!}</td>
                        <td>{!! $row->product->purchasing_price ?? 0!!}</td>
                        <td>{!! $row->product->purchasing_price * $row->quantity !!}</td>
                        <td>{!! optional($row->damage->user)->name!!}</td>
                        <td>{!! $row->created_at!!}</td>

                    </tr>

                @endforeach
                        @endisset
                </tbody>
                <tfoot>
                	<tr>
                		<td colspan="3">المجموع</td>
                		<td>{{$quantities}}</td>
                        <td></td>
                		<td>{{$sum}}</td>
                		<td colspan="2">  </td>
                	</tr>
                </tfoot>
	
            </table>
            {{--@if($damages != [])--}}
                {{--{{ $damages->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}--}}
            {{--@endif--}}
        	</div>
        </div>
<div class="row print-wrapper">
        	<button class="btn btn-success" id="print-all">طباعة</button>
        </div>
    </div>

@endsection
@section('scripts')
            <script src="{{asset('admin/assets/js/get_product_from_store_form_company.js')}}"></script>
@stop
