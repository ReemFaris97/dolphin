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
                            {!!Form::open( ['route' => 'accounting.reports.expiration-products' ,'class'=>'form phone_validate', 'method' => 'post','files' => true]) !!}

                            @if (count($errors) > 0)
                                {{--@php popup('error',$errors->all()) @endphp--}}
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group col-sm-3">
                                <label> الشركة </label>
                                {!! Form::select("company_id",companies(),null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'company_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الفرع </label>
                                {!! Form::select("branch_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الفرع','data-live-search'=>'true','id'=>'branch_id'])!!}
                            </div>

                            <div class="form-group col-sm-3">
                                <label> المستودع </label>
                                {!! Form::select("store_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر المستودع','data-live-search'=>'true','id'=>'store_id'])!!}
                            </div>
                            <div class="form-group col-sm-4">
                                <label>  </label>
                                <input type="submit" value="بحث" class="btn btn-success">
                            </div>
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
                {{--(اسم الصنف – الوحدة – الكمية الحالية - الكمية الحالية التي قاربت على الانتهاء– تاريخ الانتهاء – المدة المتبقية على الانتهاء)--}}
            </section>
            <div class="form-group col-md-12 pull-left">
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
                        <td class="footTdLbl" colspan="2">المستودع : <span>{{$store->ar_name}}</span></td>
                    @endif

                    @if(isset($requests['product_id']))
                        @php($product=\App\Models\AccountingSystem\AccountingProduct::find($requests['product_id']))
                        <td class="footTdLbl" colspan="2">الصنف : <span>{{$product->name}}</span></td>
                    @endif

                    @if(isset($requests['from']))
                        <td class="footTdLbl" colspan="2">من:<span>{{$requests['from']}}</span></td>
                    @endif

                    @if(isset($requests['to']))
                        <td class="footTdLbl" colspan="2">إلى:<span>{{$requests['to']}}</span></td>
                    @endif

                </tr>
                <tr>
                    <th>#</th>
                    <th> اسم الصنف </th>
                    <th>  الوحدة </th>
                    <th>  كمية الحالية  اللى  قاربت  على  الانتهاء </th>
                    <th>  تاريخ الانتهاء </th>
                    <th> المده  المتبقيه على الانتهاء   </th>
                </tr>
                </thead>
                <tbody>
                    @isset($expire_products)
                        @php($sum=0)
                @foreach($expire_products as $row)
                    @php( $sum+=$quantites[$row->id])
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>

                        <td>{!! $row->main_unit !!}</td>
                        <td>{!! $quantites[$row->id]!!}</td>
                        <td>{{$row->expired_at}}</td>
                            @php($expire=new \Carbon\Carbon($row->expired_at))
                        {{--@dd($expire->diffInDays(\Carbon\Carbon::now()) )--}}
                        <td>{!! $expire->diffInDays(\Carbon\Carbon::now()) !!}</td>

                    </tr>

                @endforeach
                        @endisset
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">اجمالى الكمية</td>
                    <td>{{$sum}}</td>
                    <td colspan="2"></td>

                </tr>
                </tfoot>
            </table>
            {{--@if($expire_products != [])--}}
                {{--{{ $expire_products->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}--}}
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
