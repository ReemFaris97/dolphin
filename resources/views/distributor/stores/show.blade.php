@extends('distributor.layouts.app')
@section('title')
    {{$store->name}}
@endsection
@section('breadcrumb') @php($breadcrumbs=['المستودعات'=>'/stores',$store->name =>'#'])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        {{$store->name}}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">

                    <li class="m-portlet__nav-item"></li>
                    <li class="m-portlet__nav-item">
                        <a class="btn btn-warning"
                           href="{{route('distributor.stores.addProduct',$store->id)}}">انتاج</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            <table class="table table-bordered table-hover ">
                <tbody>
                <tr>
                    <td>
                        الاسم
                    </td>
                    <td>
                        {{$store->name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        المندوب
                    </td>
                    <td>
                        <a href="{!!route('distributor.distributors.show',$store->distributor_id)!!}"
                           class="btn btn-success">
                            <i class="fas fa-eye"></i></a>
                        {{$store->distributor->name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        نوع المستودع
                    </td>
                    <td>
                        {{$store->category->name}}
                    </td>
                </tr>

                </tbody>
            </table>

        </div>
    </div>


@endsection


