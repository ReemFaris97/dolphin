@extends('AccountingSystem.layouts.master')
@section('title','تقرير  حركة صنف')
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
            <h5 class="panel-title">تقرير  حركة صنف</h5>
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
                            {!!Form::open( ['route' => 'accounting.reports.movements-products' ,'class'=>'form phone_validate', 'method' => 'GET','files' => true]) !!}
                            <div class="form-group col-sm-3">
                                <label> الشركة </label>
                                {!! Form::select("company_id",companies(),null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'company_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الفرع </label>
                                {!! Form::select("branch_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الفرع','data-live-search'=>'true','id'=>'branch_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> المخزن </label>
                                {!! Form::select("store_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر المخزن','data-live-search'=>'true','id'=>'store_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الصنف </label>
                                {!! Form::select("product_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الصنف','data-live-search'=>'true','id'=>'product_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> نوع الحركة </label>
                                {!! Form::select("type",['purchases'=>'مشتريات','sales'=>'مبيعات','damaged'=>'تالف','expired'=>'منتهى الصلاحيه'],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر  نوع  الحركة'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> من </label>
                                {!! Form::date("from",null,['class'=>'form-control','placeholder'=>'من','id'=>'example-date'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الى </label>
                                {!! Form::date("to",null,['class'=>'form-control','placeholder'=>'الى','id'=>'example-date'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label>  </label>
                                <input type="submit" value="بحث" class="btn btn-success col-sm-3">
                            </div>
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>
            {{--التفاصيل (تاريخ اليوم – الكمية – السعر - نوع الحركة – بيان الحركة – الرصيد بعد العملية – الشركة – الفرع – المخزن - المستخدم – وقت العملية).--}}

            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> تاريخ اليوم  </th>
                    <th>  الكمية </th>
                    <th>  السعر </th>
                    <th> نوع الحركة  </th>
                    <th>بيان الحركة</th>
                    <th> الرصيد بعد العمليه</th>
                    {{--<th>الشركة  </th>--}}
                    <th> الفرع</th>
                    <th> المخزن</th>
                    <th> المستخدم</th>
                    <th>تاريخ العمليه</th>
                </tr>
                </thead>
                <tbody>

                @if ($requests['type']=='purchases')
                @foreach($purchases as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! \Carbon\Carbon::now()!!}</td>
                        <td>{!! $row->quantity!!}</td>
                        <td>{!! $row->price!!}</td>
                        <td>مشتريات</td>
                        <td><a href="{{route('accounting.purchases.show',['id'=>$row->purchase->id])}}">{{$row->purchase->id}}</a></td>
                        @php($store_product=\App\Models\AccountingSystem\AccountingProductStore::where('product_id',$row->product->id)
                        ->where('store_id',$row->purchase->store_id)->first())
                        <td>{!! $store_product->quantity !!}</td>
                        <td>{!!optional( $row->purchase->branch)->name !!}</td>
                        <td>{!!optional( $row->purchase->store)->ar_name !!}</td>
                        <td>{!!optional( $row->purchase->user)->name !!}</td>
                        <td>{!! $row->purchase->created_at !!}</td>
                    </tr>
                @endforeach
                  @elseif($requests['type']=='sales')
                    @foreach($sales as $row)
                        <tr>
                            <td>{!!$loop->iteration!!}</td>
                            <td>{!! \Carbon\Carbon::now()!!}</td>
                            <td>{!! $row->quantity!!}</td>
                            <td>{!! $row->price!!}</td>
                            <td>مبيعات</td>
                            @php($store_product=\App\Models\AccountingSystem\AccountingProductStore::where('product_id',$row->product->id)
                            ->where('store_id',$row->sale->store_id)->first())
                            <td>{!! ($store_product)?$store_product->quantity:0 !!}</td>
                            <td>{!!optional($row->sale->branch)->name !!}</td>
                            <td>{!!optional( $row->sale->store)->ar_name !!}</td>
                            <td>{!!optional( $row->sale->user)->name !!}</td>
                            <td>{!! $row->sale->created_at !!}</td>
                        </tr>
                    @endforeach


                @elseif($requests['type']=='damaged')
                    @foreach($damages as $row)
                        <tr>
                            <td>{!!$loop->iteration!!}</td>
                            <td>{!! \Carbon\Carbon::now()!!}</td>
                            <td>{!! $row->quantity!!}</td>
                            <td>{!! $row->price!!}</td>
                            <td>توالف</td>
                            @php($store_product=\App\Models\AccountingSystem\AccountingProductStore::where('product_id',$row->product->id)
                            ->where('store_id',$row->damage->store_id)->first())
                            <td>{!! ($store_product)?$store_product->quantity:0 !!}</td>
                            <td>{!!optional($row->damage->branch)->name !!}</td>
                            <td>{!!optional( $row->damage->store)->ar_name !!}</td>
                            <td>{!!optional( $row->damage->user)->name !!}</td>
                            <td>{!! $row->damage->created_at !!}</td>
                        </tr>

                    @endforeach
                @endif
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
