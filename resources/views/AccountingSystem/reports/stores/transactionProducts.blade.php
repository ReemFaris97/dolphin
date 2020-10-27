@extends('AccountingSystem.layouts.master')
@section('title','تقرير التحويلات  بين  المخازن')
@section('parent_title','التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}

@section('styles')
<style>
    .filter {
        margin-bottom: 30px;
    }
</style>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير التحويلات  بين  المخازن</h5>
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
                            {!!Form::open( ['route' => 'accounting.reports.transaction-products' ,'class'=>'form phone_validate', 'method' => 'post','files' => true]) !!}
                            @include('AccountingSystem.reports.stores.filter')
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>
            <div class="form-group col-md-12 pull-left">
                {{--<label class="label label-info">  الشركة    : </label>--}}
                <center>
                    @if(isset($requests['company_id']))
                        @php($company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id']))
                        <span><img src="{!!getimg($company->image)!!}" style="width:100px; height:100px"> </span>
                    @endif
                </center>
            </div>
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info">  الشركة    : </label>
                @if(isset($requests['company_id']))
                    @php($company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id']))
                    <span>{{$company->name}}</span>

                @endif
            </div>
            @if(isset($requests['branch_id']))
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info">  الفرع   : </label>
                    @php($branch=\App\Models\AccountingSystem\AccountingBranch::find($requests['branch_id']))
                    <span>{{$branch->name}}</span>
            </div>
            @endif
            @if(isset($requests['store_id']))
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info"> المخزن: </label>
                    @php($store=\App\Models\AccountingSystem\AccountingStore::find($requests['store_id']))
                    <span>{{$store->ar_name}}</span>
            </div>
            @endif
            @if(isset($requests['product_id']))
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info"> الصنف: </label>
                    @php($product=\App\Models\AccountingSystem\AccountingProduct::find($requests['product_id']))
                    <span>{{$product->name}}</span>
            </div>
            @endif
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info"> من: </label>
                @if(isset($requests['from']))
                    <span>{{$requests['from']}}</span>
                @endif
            </div>
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info"> الى: </label>
                @if(isset($requests['to']))
                    <span>{{$requests['to']}}</span>
                @endif
            </div>
            {{---         التفاصيل (التاريخ - اسم الصنف – الوحدة - الكمية الحالية بالمخزن المحول منه الكمية الحالية بالمخزن المحول إليه – السعر - إجمالي سعر).--}}
<div id="print-window">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> تاريخ اليوم </th>
                    <th> اسم الصنف </th>
                    <th> الوحدة  </th>
                    <th> المخزن  المحول  منه  </th>
                    <th> المخزن المحول  اليه  </th>
                    <th>  الكميه المحوله </th>
                    <th>  إلسعر  </th>
                    <th>  اجمالى السعر </th>
                </tr>
                </thead>
                <tbody>
                {{--@dd($transactions)--}}
                    @isset($transactions)

                @foreach($transactions as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! date($row->created_at)!!}</td>
                        <td>{!! $row->product->name!!}</td>
                        <td>{!! $row->product->main_unit!!}</td>
                        <td>{!! optional($row->request->getStoreFrom)-> ar_name!!}</td>
                        <td>{!! optional($row->request->getStoreTo)->ar_name!!}</td>
                        <td>{!! $row->quantity!!}</td>
                        <td>{!! $row->product->purchasing_price!!}</td>
                        <td>{!! $row->product->purchasing_price * $row->quantity!!}</td>
                        {{--<td>{!! optional($row->transction->user)->name!!}</td>--}}
                        {{--<td>{!! $row->created_at!!}</td>--}}

                    </tr>

                @endforeach
                        @endisset
                </tbody>
            </table>
            @if($transactions != [])
                {{ $transactions->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
            @endif
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
