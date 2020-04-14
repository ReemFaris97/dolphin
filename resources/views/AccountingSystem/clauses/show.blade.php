@extends('AccountingSystem.layouts.master')

@section('title','عرض  سند')
@section('parent_title','إدارة  سندات  القبض  والصرف')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض سند   </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            <div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
                <label> نوع السند  </label>
                @if ($sa->type=="expenses")
                    <label class="label label-info"> صرف </label>
                @elseif($row->type=="revenue")
                    <label class="label label-success"> قبض</label>
                @else
                    <label class="label label-success"> عام</label>
                @endif
            </div>
            <div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
                <label> اسم الشركة </label>
                {!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','placeholder'=>' اختر اسم الشركة  '])!!}
            </div>

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left clients">
                <label>   اختر  العميل</label>
                {!! Form::select("client_id",$clients,null,['class'=>'form-control','placeholder'=>' اختر  العميل','id'=>'client_id'])!!}
            </div>
            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left clients">
                <label>  رصيد العميل</label>
                <input type="text" id="client_balance" class="form-control" readonly>
            </div>

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left suppliers">
                <label>   اختر المورد </label>
                {!! Form::select("supplier_id",$suppliers,null,['class'=>'form-control','placeholder'=>'  اختر المورد ','id'=>'supplier_id'])!!}
            </div>

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left suppliers">
                <label>   رصيد المورد </label>
                <input type="text" id="balance" class="form-control" readonly>
            </div>



            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
                <label>نوع السند [قبض-صرف]</label>
                {!! Form::select("type",['revenue'=>'قبض','expenses'=>'مصروف'],null,['class'=>'form-control','placeholder'=>' نوع السند  '])!!}
            </div>

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left benods">
                <label>   اسم  البند </label>
                {!! Form::select("benod_id",$benods,null,['class'=>'form-control','placeholder'=>' اختر  اسم البند '])!!}
            </div>
            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left name">
                <label>المكرم /السيد </label>
                {!! Form::text("name",null,['class'=>'form-control','placeholder'=>' الاسم  '])!!}
            </div>

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
                <label> التاريخ</label>
                {!! Form::date("date",null,['class'=>'form-control'])!!}
            </div>

            <div class="form-group col-md-9 col-sm-9 col-xs-9  pull-left ">
                <label>البيان </label>
                {!! Form::text("description",null,['class'=>'form-control','placeholder'=>' البيان  '])!!}
            </div>
            {{--<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">--}}
            {{--<label> العمله الافتراضية  </label>--}}
            {{--{!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>' العمله الافتراضية'])!!}--}}
            {{--</div>--}}

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
                <label>المبلغ </label>
                {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>' المبلغ    ','id'=>'amount'])!!}
            </div>
            <div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left clients">
                <label> الرصيد الجديد للعميل</label>
                <input type="text" id="new_client_balance" class="form-control" readonly>
            </div>
            <div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left suppliers">
                <label> الرصيد الجديد </label>
                <input type="text" id="new_balance" class="form-control" readonly>
            </div>
            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
                <label>  خزينة الدفع</label>
                {!! Form::select("safe_id",$safes,null,['class'=>'form-control','placeholder'=>' خزينة الدفع '])!!}
            </div>



            <div class="form-group col-md-6 col-xs-12 pull-left taxs  form-line sanads">
                <label>طريقه الدفع</label>

                <span class="new-radio-wrap-sanad">
        <label for="cash">نقدى</label>
        <input type="radio" name="payment" class="styled type" value="cash" id="cash">
     </span>

                <span class="new-radio-wrap-sanad">
     <label for="network">شبكة</label>
        <input type="radio" name="payment" class="styled type" value="network" id="network">
    </span>


                <span class="new-radio-wrap-sanad">
     <label for="bank_translation">تحويل بنكى</label>
        <input type="radio" name="payment" class="styled type" value="bank_translation" id="bank_translation">
    </span>

                <span class="new-radio-wrap-sanad">
     <label for="check">شيك</label>
        <input type="radio" name="payment" class="styled type" value="check" id="check">
    </span>

            </div>
            <div class="clearfix"></div>
            <div class="banks">

                <div class="form-group col-md-4  pull-left">
                    <label> اسم البنك </label>
                    {!! Form::select("bank_id",$banks,null,['class'=>'form-control js-example-basic-single bank_id','id'=>'bank_id','placeholder'=>' اختر البنك '])!!}
                </div>


                <div class="form-group col-md-4 pull-left">
                    <label>رقم  التحويل او الشيك </label>
                    {!! Form::text("num_transaction",null,['class'=>'form-control','placeholder'=>' رقم  التحويل او الشيك    '])!!}
                </div>

                <div class="form-group col-md-4 pull-left">
                    <label>صورة التحويل</label>
                    {!! Form::file("image",null,['class'=>'form-control'])!!}
                </div>

            </div>

            <div class="form-group col-md-6 col-sm-6 col-xs-12  pull-left">
                <label> ملاحظات</label>
                {!! Form::textarea("notes",null,['class'=>'form-control'])!!}
            </div>


        </div>


    </div>

 @endsection
