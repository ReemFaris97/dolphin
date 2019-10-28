@extends('AccountingSystem.AccountingCompanies.layouts.master')
@section('title','الصفحة الرئيسية')

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat the-home-bggg">
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
            <div class="row">
                <div class="wrap all-meteor-wrapper">
                    <div class="metro-huge productsm">
                        <a href="{{route('company.products.create')}}" class="bigger-link">
                            <img src="{{asset('admin/assets/images/metro/shopping-cart.png')}}" alt="">
                            <span class="label bottom">إضافة منتج </span>
                        </a>
                        <div class="hoverable-icons">
                            <a href="{{route('company.products.index')}}">
								<span>
									<i class="icon-eye"></i>
								</span>
                            </a>
                        </div>
                    </div>
{{--                    <div class="metro-huge companiesm">--}}
{{--                        <a href="{{route('company.companies.index')}}" class="bigger-link">--}}
{{--                            <img src="{{asset('admin/assets/images/metro/factory.png')}}" alt="">--}}
{{--                            <span class="label bottom">الشركات </span>--}}
{{--                        </a>--}}
{{--                        <div class="hoverable-icons">--}}
{{--                            <a href="{{route('company.companies.create')}}">--}}
{{--								<span>--}}
{{--									<i class="icon-add"></i>--}}
{{--								</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="metro-big branchesm">
                        <a href="{{route('company.branches.index')}}" class="bigger-link">
                            <img src="{{asset('admin/assets/images/metro/company.png')}}" alt="">
                            <span class="label bottom">الفروع </span>
                        </a>
                        <div class="hoverable-icons">
                            <a href="{{route('company.branches.create')}}">
				<span>
					<i class="icon-add"></i>
				</span>
                            </a>
                        </div>
                    </div>
                    <div class="metro-big warhousesm">
                        <a href="{{route('company.stores.create')}}" class="bigger-link">
                            <img src="{{asset('admin/assets/images/metro/warehouse.png')}}" alt="">
                            <span class="label bottom">إضافة مخزن </span>
                        </a>
                        <div class="hoverable-icons">
                            <a href="{{route('company.stores.index')}}">
				<span>
					<i class="icon-eye"></i>
				</span>
                            </a>
                        </div>
                    </div>

                    <div class="metro-big categoriesm">
                        <a href="{{route('company.categories.create')}}" class="bigger-link">
                            <img src="{{asset('admin/assets/images/metro/list.png')}}" alt="">
                            <span class="label bottom">إضافة تصنيف </span>
                        </a>
                        <div class="hoverable-icons">
                            <a href="{{route('company.categories.index')}}">
				<span>
					<i class="icon-eye"></i>
				</span>
                            </a>
                        </div>
                    </div>

                    <div class="metro-small shiftsm">
                        <a href="{{route('company.shifts.create')}}" class="bigger-link">
                            <img src="{{asset('admin/assets/images/metro/shift.png')}}" alt="">
                            <span class="label bottom">إضافة وردية </span>
                        </a>
                        <div class="hoverable-icons">
                            <a href="{{route('company.shifts.index')}}">
				<span>
					<i class="icon-eye"></i>
				</span>
                            </a>
                        </div>
                    </div>
                    <div class="metro-small termssm">
                        <a href="{{route('company.clauses.create')}}" class="bigger-link">
                            <img src="{{asset('admin/assets/images/metro/list.png')}}" alt="">
                            <span class="label bottom">إضافة بند </span>
                        </a>
                        <div class="hoverable-icons">
                            <a href="{{route('company.clauses.index')}}">
				<span>
					<i class="icon-eye"></i>
				</span>
                            </a>
                        </div>
                    </div>

                    <div class="metro-big statisticssm">
                        <a href="" class="bigger-link">
                            <img src="{{asset('admin/assets/images/metro/diagram.png')}}" alt="">
                            <span class="label bottom">الإحصائيات</span>
                        </a>
                        <div class="hoverable-icons">
                            <a href="#">
				<span>
					<i class="icon-eye"></i>
				</span>
                            </a>
                        </div>
                    </div>

{{--                    <div class="metro-big adminsm">--}}
{{--                        <a href="{{route('company.users.index')}}" class="bigger-link">--}}
{{--                            <img src="{{asset('admin/assets/images/metro/employee.png')}}" alt="">--}}
{{--                            <span class="label bottom">أعضاء الإدارة</span>--}}
{{--                        </a>--}}
{{--                        <div class="hoverable-icons">--}}
{{--                            <a href="{{route('company.users.create')}}">--}}
{{--				<span>--}}
{{--					<i class="icon-add"></i>--}}
{{--				</span>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}


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
