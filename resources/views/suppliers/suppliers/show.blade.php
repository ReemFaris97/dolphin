@extends('suppliers.layouts.app')
@section('title')
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['الاعضاء'=>'/users','اضافه'=>'/users/create'])
    @includeWhen(isset($breadcrumbs),'suppliers.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-section__content">
        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
            <div class="m-portlet__body">

                <div class="col-xs-4">
                    <h5>إسم المورد</h5>
                    <h3>{{$user->name}}</h3>
                </div>


                <div class="col-xs-4">
                    <h5>البريد الإلكتروني</h5>
                    <h3>{{$user->email}}</h3>
                </div>


                <div class="col-xs-4">
                    <h5>الهاتف</h5>
                    <h3>{{$user->phone}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>إسم البنك</h5>
                    <h3>{{$user->bank?$user->bank->name:"لا يوجد"}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>رقم الحساب</h5>
                    <h3>{{$user->bank_account_number?$user->bank_account_number:"لا يوجد حالياً"}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>صورة المورد</h5>
                    <img src="{!! url($user->image)!!}" width="250" height="250">
                </div>


            </div>
        </div>
    </div>

    <div class="m-portlet__head-tools">
        <h3>منتجات المورد</h3>
    </div>

    <table class="table table-striped- table-bordered table-hover table-checkable" >
        <thead>
        <tr>
            <th>#</th>
            <th>المنتج</th>
            <th>الكمية</th>
            <th>السعر</th>
        </tr>
        </thead>
        <tbody>
        @foreach($user->supplierProducts() as $product)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->quantity()}}</td>
                <td>{{$product->supplierPrice($user->id)}}</td>
            </tr>
        @endforeach

        </tbody>

    </table>



@endsection


@section('scripts')
@endsection
