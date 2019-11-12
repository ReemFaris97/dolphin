@extends('AccountingSystem.layouts.master')
@section('title','الصفحة الرئيسية')

@section('styles')
<link href="{{asset('admin/assets/css/metro.css')}}" rel="stylesheet" type="text/css">
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
						<a href="{{route('accounting.products.create')}}" class="bigger-link">
							<img src="{{asset('admin/assets/images/metro/shopping-cart.png')}}" alt="">
							<span class="label bottom">إضافة منتج </span>
						</a>
						<div class="hoverable-icons">
							<a href="{{route('accounting.products.index')}}">
								<span>
									<i class="icon-add"></i>
								</span>
							</a>
						</div>
					</div>
					<div class="metro-huge companiesm">
						<a href="{{route('accounting.companies.index')}}" class="bigger-link">
							<img src="{{asset('admin/assets/images/metro/factory.png')}}" alt="">
							<span class="label bottom">الشركات </span>
						</a>
						<div class="hoverable-icons">
							<a href="{{route('accounting.companies.create')}}">
								<span>
									<i class="icon-eye"></i>
								</span>
							</a>
						</div>
					</div>
        <div class="metro-big branchesm">
        <a href="{{route('accounting.branches.index')}}" class="bigger-link">
        	<img src="{{asset('admin/assets/images/metro/company.png')}}" alt="">
        	<span class="label bottom">الفروع </span>
        </a>
        <div class="hoverable-icons">
        	<a href="{{route('accounting.branches.create')}}">
				<span>
					<i class="icon-eye"></i>
				</span>
        	</a>
        </div>
    </div>
        <div class="metro-big warhousesm">
        <a href="{{route('accounting.stores.create')}}" class="bigger-link">
        	<img src="{{asset('admin/assets/images/metro/warehouse.png')}}" alt="">
        	<span class="label bottom">إضافة مخزن </span>
        </a>
        <div class="hoverable-icons">
        	<a href="{{route('accounting.stores.index')}}">
				<span>
					<i class="icon-add"></i>
				</span>
        	</a>
        </div>
    </div>

     <div class="metro-big categoriesm">
        <a href="{{route('accounting.categories.create')}}" class="bigger-link">
        	<img src="{{asset('admin/assets/images/metro/list.png')}}" alt="">
        	<span class="label bottom">إضافة تصنيف </span>
        </a>
        <div class="hoverable-icons">
        	<a href="{{route('accounting.categories.index')}}">
				<span>
					<i class="icon-add"></i>
				</span>
        	</a>
        </div>
    </div>

         <div class="metro-small shiftsm">
        <a href="{{route('accounting.shifts.create')}}" class="bigger-link">
        	<img src="{{asset('admin/assets/images/metro/shift.png')}}" alt="">
        	<span class="label bottom">اضافة وردية </span>
        </a>
        <div class="hoverable-icons">
        	<a href="{{route('accounting.shifts.create')}}">
				<span>
					<i class="icon-add"></i>
				</span>
        	</a>
        </div>
    </div>
               <div class="metro-small termssm">
        <a href="{{route('accounting.clauses.create')}}" class="bigger-link">
        	<img src="{{asset('admin/assets/images/metro/list.png')}}" alt="">
        	<span class="label bottom">إضافة بند </span>
        </a>
        <div class="hoverable-icons">
        	<a href="{{route('accounting.clauses.create')}}">
				<span>
					<i class="icon-add"></i>
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

       <div class="metro-big adminsm">
        <a href="{{route('accounting.users.index')}}" class="bigger-link">
        	<img src="{{asset('admin/assets/images/metro/employee.png')}}" alt="">
        	<span class="label bottom">أعضاء الإدارة</span>
        </a>
        <div class="hoverable-icons">
        	<a href="{{route('accounting.users.create')}}">
				<span>
					<i class="icon-add"></i>
				</span>
        	</a>
        </div>
    </div>


</div>
            </div>
        </div>
    </div>

 @endsection
