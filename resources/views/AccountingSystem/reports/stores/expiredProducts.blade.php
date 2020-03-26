@extends('AccountingSystem.layouts.master')
@section('title','تقرير  اصناف  قاربت  على الانتهاء')
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
            <h5 class="panel-title">تقرير اصناف  قاربت  على الانتهاء</h5>
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
                            {!!Form::open( ['route' => 'accounting.reports.expiration-products' ,'class'=>'form phone_validate', 'method' => 'GET','files' => true]) !!}
                            @include('AccountingSystem.reports.stores.filter')
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
                {{--(اسم الصنف – الوحدة – الكمية الحالية - الكمية الحالية التي قاربت على الانتهاء– تاريخ الانتهاء – المدة المتبقية على الانتهاء)--}}
            </section>
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم الصنف </th>
                    <th>  الوحدة </th>
                    <th>  كمية الحالية  اللى  قاربت  على  الانتهاء </th>
                    <th> تاريخ الانتهاء  </th>
                    <th> المده  المتبقيه على الانتهاء   </th>
                </tr>
                </thead>
                <tbody>
                    @isset($expire_products)
                @foreach($expire_products as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>
                        <td>{!! $row->quantity!!}</td>

                        <td>{!! $row->product->main_unit!!}</td>
                        <td>{!! $row->product->expired_at!!}</td>
                            @php($expire=new \Carbon\Carbon($row->product->expired_at))
                        <td>{!! $expire->diff(\Carbon\Carbon::now())->days !!}</td>

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
