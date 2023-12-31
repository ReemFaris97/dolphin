@extends('AccountingSystem.layouts.master')
@section('title','تقرير الجرد')
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
            <h5 class="panel-title">تقرير الجرد</h5>
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
                            {!!Form::open( ['route' => 'accounting.reports.inventory-products' ,'class'=>'form phone_validate', 'method' => 'post','files' => true]) !!}
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
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info">  الفرع   : </label>
                @if(isset($requests['branch_id']))
                    @php($branch=\App\Models\AccountingSystem\AccountingBranch::find($requests['branch_id']))
                    <span>{{$branch->name}}</span>
                @endif
            </div>
            @if(isset($requests['store_id']))
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info"> المستودع: </label>
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
            <div id="print-window">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> تاريخ اليوم </th>
                    <th> اسم الصنف </th>
                    <th> الكمية الحاليه </th>
                    <th>  السعر </th>
                    <th>  إجمالي سعر  </th>
                    <th>  المستخدم </th>
                    <th> وقت العملية </th>
                </tr>
                </thead>
                <tbody>
                @isset($inventories)
                    @foreach($inventories as $row)
                        <tr>
                            <td>{!!$loop->iteration!!}</td>
                            <td>{!! date($row->created_at)!!}</td>
                            <td>{!! $row->product->name!!}</td>
                            <td>{!! $row->Real_quantity!!}</td>
                            <td>{!! $row->product->purchasing_price!!}</td>
                            <td>{!! $row->product->purchasing_price * $row->Real_quantity!!}</td>
                            <td>{!! optional($row->inventory->user)->name!!}</td>
                            <td>{!! $row->created_at!!}</td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>
            {{--@if($inventories!= [])--}}
            {{--{{ $inventories->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}--}}
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
