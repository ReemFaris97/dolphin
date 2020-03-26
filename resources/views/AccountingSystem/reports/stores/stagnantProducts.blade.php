@extends('AccountingSystem.layouts.master')
@section('title','تقرير  الاصناف  الراكده')
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
            <h5 class="panel-title">تقرير الاصناف  الراكدة</h5>
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
                            {!!Form::open( ['route' => 'accounting.reports.stagnant-products' ,'class'=>'form phone_validate', 'method' => 'GET','files' => true]) !!}
                            @include('AccountingSystem.reports.stores.filter')
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
                {{--التفاصيل (اسم الصنف – الوحدة - الكمية الحالية – الحد الأدنى – تاريخ آخر عملية بيع).--}}
            </section>
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم الصنف </th>
                    <th>  الوحدة </th>
                    <th>  كمية الحالية   </th>
                    <th> الحد الادنى  </th>
                    <th> تاريخ اخر عملية بيع  </th>
                </tr>
                </thead>
                <tbody>
                    @isset($stagnant_sales)
                @foreach($stagnant_sales as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>
                        <td>{!! $row->product->main_unit!!}</td>
                        @php($store_product=\App\Models\AccountingSystem\AccountingProductStore::where('product_id',$row->product->id)
                         ->where('store_id',$row->sale->store_id)->first())
                        <td>{!! $store_product->quantity !!}</td>


                        <td>{!! $row->product->min_quantity!!}</td>

                        <td>{!! $row->created_at !!}</td>

                    </tr>

                @endforeach
                        @endisset
                </tbody>
            </table>
            {{--@if($expire_products != [])--}}
                {{--{{ $expire_products->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}--}}
            {{--@endif--}}
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('admin/assets/js/get_product_from_store_form_company.js')}}"></script>
@stop
