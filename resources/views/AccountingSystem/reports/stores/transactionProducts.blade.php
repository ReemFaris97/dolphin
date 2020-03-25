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
                            {!!Form::open( ['route' => 'accounting.reports.transaction-products' ,'class'=>'form phone_validate', 'method' => 'GET','files' => true]) !!}
                            @include('AccountingSystem.reports.stores.filter')
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>

            {{---         التفاصيل (التاريخ - اسم الصنف – الوحدة - الكمية الحالية بالمخزن المحول منه الكمية الحالية بالمخزن المحول إليه – السعر - إجمالي سعر).--}}

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
                    @isset($transactions)
                @foreach($transactions as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! date($row->created_at)!!}</td>
                        <td>{!! $row->product->name!!}</td>
                        <td>{!! $row->product->main_unit!!}</td>
                        <td>{!! $row->request->getStoreFrom-> ar_name!!}</td>
                        <td>{!! $row->request->getStoreTo->ar_name!!}</td>
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

@endsection
@section('scripts')
    <script src="{{asset('admin/assets/js/get_product_from_store_form_company.js')}}"></script>
@stop
