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
                <label>  السند  ل </label>
                @if ($clause->concerned=="client")
                    <span > عميل </span>
                @elseif($clause->concerned=="supplier")
                    <span> مورد</span>
                @else
                    <span> عام</span>
                @endif
            </div>
            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
                <label> رقم السند</label>
                {{$clause->num}}
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
                <label> اسم الشركة </label>
                <span>{{optional($clause->company)->name}}</span>
            </div>
            @if ($clause->concerned=="client")
            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left clients">
                <label>   اسم العميل</label>
                {{optional($clause->client)->name}}
            </div>
            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left clients">
                <label>  رصيد العميل</label>
                {{optional($clause->client)->amount}}
            </div>

            @endif
            @if ($clause->concerned=="suppiler")
            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left suppliers">
                <label>   اسم المورد </label>
                {{optional($clause->suppiler)->name}}
            </div>

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left suppliers">
                <label>   رصيد المورد </label>
                {{optional($clause->suppiler)->balance}}
            </div>

           @endif

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
                <label> نوع السند  </label>
                @if ($clause->type=="expenses")
                    <span> صرف </span>
                @elseif($clause->type=="revenue")
                    <span> قبض</span>

                @endif
            </div>

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left benods">
                <label>   اسم  البند </label>
                {{optional($clause->benod)->ar_name}}
            </div>
            @if ($clause->concerned=="general")
            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left name">
                <label>المكرم /السيد </label>

                {{$clause->name}}
            </div>
                @endif
            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
                <label> التاريخ</label>
                {{$clause->date}}
            </div>

            <div class="form-group col-md-9 col-sm-9 col-xs-9  pull-left ">
                <label>البيان </label>
                {{$clause->description}}
            </div>
            {{--<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">--}}
            {{--<label> العمله الافتراضية  </label>--}}
            {{--{!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>' العمله الافتراضية'])!!}--}}
            {{--</div>--}}

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
                <label>المبلغ </label>
                {{$clause->amount}}
            </div>

            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
                <label>  خزينة الدفع</label>
                {{optional($clause->safe)->name}}

            </div>



            <div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left ">
                <label >طريقه الدفع</label>
                @if ($clause->payment=="cash")
                    <span> نقدى </span>
                @elseif($clause->payment=="network")
                    <label class="label label-success"> شبكة</label>
                @elseif($clause->payment=="bank_translation")
                    <label class="label label-success"> تحويل بنكى </label>
                @elseif($clause->payment=="check")
                    <label class="label label-success"> شيك</label>

                @endif



            </div>
            <div class="clearfix"></div>
            @if(isset($clause->bank_id))
            <div class="banks">

                <div class="form-group col-md-4  pull-left">
                    <label> اسم البنك </label>
                    {{optional($clause->bank)->name}}
                </div>


                <div class="form-group col-md-4 pull-left">
                    <label>رقم  التحويل او الشيك </label>
                      {{$clause->num_transaction}}
                </div>

                <div class="form-group col-md-4 pull-left">
                    <label>صورة التحويل</label>
                 <img src="{!!getimg($clause->image)!!}" style="width:100px; height:100px">

                </div>

            </div>
                @endif
            <div class="form-group col-md-6 col-sm-6 col-xs-12  pull-left">
                <label> ملاحظات</label>
                {{$clause->notes}}
            </div>


        </div>


    </div>

 @endsection
