@extends('AccountingSystem.AccountingCompanies.layouts.master')
@section('title','الصفحة الرئيسية')

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">الصفحة الرئيسة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <h6 class="text-semibold">You are logged in as Company! {{auth('accounting_companies')->user()->name}}</h6>


            <div class="row">
                <div class="col-md-6">

                </div>


            </div>


        </div>
    </div>

@endsection
{{--@extends('AccountingSystem.AccountingCompanies.layout.auth')--}}


{{--@section('content')--}}
{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}

            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Dashboard</div>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
                        {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                    {{--</a>--}}

                    {{--<ul class="dropdown-menu" role="menu">--}}
                        {{--<li>--}}
                            {{--<a href="{{ url('/company/logout') }}"--}}
                               {{--onclick="event.preventDefault();--}}
                                                 {{--document.getElementById('logout-form').submit();">--}}
                                {{--Logout--}}
                            {{--</a>--}}

                            {{--<form id="logout-form" action="{{ url('/company/logout') }}" method="POST" style="display: none;">--}}
                                {{--{{ csrf_field() }}--}}
                            {{--</form>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</li>--}}

                {{--<div class="panel-body">--}}
                    {{--You are logged in as Company! {{auth('accounting_companies')->user()->name}}--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
