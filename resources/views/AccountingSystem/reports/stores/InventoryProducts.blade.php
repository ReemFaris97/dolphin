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
                            {!!Form::open( ['route' => 'accounting.reports.inventory-products' ,'class'=>'form phone_validate', 'method' => 'GET','files' => true]) !!}
                            @include('AccountingSystem.reports.stores.filter')
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>
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
            @if($inventories!= [])
            {{ $inventories->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}
            @endif


        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('admin/assets/js/get_product_from_store_form_company.js')}}"></script>
@stop
