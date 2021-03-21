@extends('distributor.layouts.app')
@section('title')
عرض  بيانات السجل
@endsection

@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-md-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head belong-to-aform">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                           عرض  السجل
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body">


                    <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">
                        <thead>
                        <tr>
                            <th> المعلومه</th>
                            <th> القيمه</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>  اسم المخزن</td>
                            <td>{{$damage->store->name}}</td>
                        </tr>
                        <tr>
                            <td>اسم المندوب</td>
                            <td>{{$damage->distributor->name}}</td>
                        </tr>
                        <tr>
                            <td>تاريخ السجل</td>
                            <td>{{$damage->created_at}}</td>
                        </tr>



                            <tr>
                            <td>صور محضر الاتلاف</td>
                            <td>
                                <img src="{!!asset($damage->image )!!}" height="100" width="100"/>
                            </td>
                            </tr>

                        <tr>
                            <td> اسم المنتج</td>
                            <td>{{$damage->product->name}}</td>
                        </tr>
                        <tr>
                            <td> الكميه</td>
                            <td>{{$damage->quantity}}</td>
                        </tr>
                        <tr>
                            <td> الحاله</td>
                            <td>@if($damage->is_confirmed==1)
                                    مؤكدة
                                @endif</td>
                        </tr>

                        </tbody>
                    </table>


        </div>


            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
