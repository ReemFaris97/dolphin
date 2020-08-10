@extends('AccountingSystem.layouts.master')
@section('title','عرض  تفاصيل  الحساب')
@section('parent_title','  الدليل المحاسبى')
@section('action', URL::route('accounting.ChartsAccounts.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض {{$account->ar_name}}

                {{-- {!! MyHelperAccountingAmount::amount($account) !!} --}}
                
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1">دفتر اليوميه </a></li>
              @if( $account->cost_center==1)
                <li  @if( $account->cost_center==1) class="active" @endif  ><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">مركز التكلفه </a></li>
                @endif
                <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu3"> دفتر الاستاذ </a></li>
                <li  @if( $account->cost_center==0) class="active" @endif ><a data-toggle="tab" role="tab" aria-controls="menu4" href="#menu4"> تفاصيل
                        الحساب </a></li>

            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="menu1" class="tab-pane  ">

                </div>
                @if( $account->cost_center==1)
                <div role="tabpanel" id="menu2" @if( $account->cost_center==1) class=" tab-pane active" @else  class=" tab-pane" @endif >


                </div>
                @endif
                <div role="tabpanel" id="menu3" class="tab-pane">

                </div>
                <div role="tabpanel" id="menu4" @if( $account->cost_center==0) class=" tab-pane active" @else  class=" tab-pane" @endif >
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>اسم الحساب باللغة العربية </label>
                        <input type="text" name="ar_name" class="form-control" value="{{$account->ar_name}}" disabled>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>اسم الحساب باللغة الانجليزية </label>
                        <input type="text" name="en_name" class="form-control" value="{{$account->en_name}}" disabled>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>الكود </label>
                        <input type="text" name="code" class="form-control" value="{{$account->code}}" disabled>
                    </div>
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label> نوع الحساب </label>
                        <select class="form-control" disabled>
                            <option selected>@if ($account->kind=='main')حساب رئيسى @elseif ($account->kind=='sub')حساب فرعى@else حساب رئيسى تابع @endif</option>
                        </select>
                    </div>
                    @if ($account->kind=='sub')
                        <div class="form-group col-sm-6 col-xs-12 pull-left">
                            <label> الحساب الرئيسى </label>
                            <select class="form-control" disabled>
                                <option selected> {{$account->account->ar_name}}</option>
                            </select>
                        </div>
                    @endif
                    <div class="form-group col-sm-6 col-xs-12 pull-left">
                        <label>المبلغ بالحساب </label>
                        <input type="text" name="amount" class="form-control" value="{{$account->amount}}" disabled>
                    </div>

                    <div class="form-group col-xs-6 pull-left  ">
                        <label>طبيعة الحساب </label>
                        <div class="form-line new-radio-big-wrapper">
                          <span class="new-radio-wrap">
                           <label for="Creditor">دائن </label>
                              <input type="radio" class="form-control" @if ($account->status=='Creditor') checked  @endif disabled>
                           </span>
                            <span class="new-radio-wrap">
                            <label for="debtor"> مدين </label>
                              <input type="radio" class="form-control" @if ($account->status=='debtor') checked  @endif disabled>
                            </span>
                        </div>
                    </div>



                </div>
            </div>

        </div>


@endsection

@section('scripts')


@stop
