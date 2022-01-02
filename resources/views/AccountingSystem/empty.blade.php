@extends('distributor.layouts.app')
@section('title')
    Empty
@endsection

@section('header')
@endsection

{{--@section('breadcrumb') @php($breadcrumbs=['البنوك'=>route('distributor.banks.index'),])--}}
{{--@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])--}}
{{--@endsection--}}

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                         ........
                    </h3>
                </div>
            </div>

        </div>
        <div class="m-portlet__body">
            ... Content ....
        </div>
    </div>
@endsection


