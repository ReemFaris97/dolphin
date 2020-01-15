<div class="navbar navbar-inverse">
    <div class="navbar-header">
<!--
        <a class="navbar-brand" href="index.html">
        	<img src="{{asset('public/admin/assets/images/logo_light.png')}}" alt="">
        </a>
-->

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
			<li class="dropdown mega-menu mega-menu-wide the-short-links">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-meter-fast position-left"></i> وصول سريع <span class="caret"></span>
					</a>

					<div class="dropdown-menu dropdown-content">
						<div class="dropdown-content-body">
							<div class="row all-shortcuts-wrapper">
								<div class="single-shortcut">
									<a href="{{route('accounting.products.create')}}">
										<img src="{{asset('admin/assets/images/shopping-bag.png')}}" alt="">
										<span>إضافة منتج</span>
									</a>
								</div>
								<div class="single-shortcut">
									<a href="{{route('accounting.stores.create')}}">
										<img src="{{asset('admin/assets/images/shop.png')}}" alt="">
										<span>إضافة مخزن</span>
									</a>
								</div>
								<div class="single-shortcut">
									<a href="{{route('accounting.categories.create')}}">
										<img src="{{asset('admin/assets/images/interface.png')}}" alt="">
										<span>إضافة تصنيف</span>
									</a>
								</div>
								<div class="single-shortcut">
									<a href="{{route('accounting.clauses.create')}}">
										<img src="{{asset('admin/assets/images/terms.png')}}" alt="">
										<span>إضافة بند</span>
									</a>
								</div>
								<div class="single-shortcut">
									<a href="{{route('accounting.shifts.create')}}">
										<img src="{{asset('admin/assets/images/shift.png')}}" alt="">
										<span>إضافة وردية</span>
									</a>
								</div>


							</div>
						</div>
					</div>
				</li>
			<!--الفهرس-->
			<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-file-text position-left"></i>
						الفهرس
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-man position-left"></i>
								إدارة  عضويات الادارة
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{route('accounting.users.index')}}"><i class="icon-eye"></i> عرض العضويات</a></li>
								<li><a href="{{route('accounting.users.create')}}"><i class="icon-add-to-list"></i> اضافة عضو جديد</a></li>

							</ul>
						</li>
						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-list position-left"></i>
								إدارة الشركات
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{route('accounting.companies.index')}}"><i class="icon-eye"></i> عرض الشركات</a></li>
								<li><a href="{{route('accounting.companies.create')}}"><i class="icon-add-to-list"></i> اضافة شركة جديدة</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-home2 position-left"></i>
								إدارة فروع الشركات
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{route('accounting.branches.index')}}"><i class="icon-eye"></i> عرض فروع الشركات</a></li>
								<li><a href="{{route('accounting.branches.create')}}"><i class="icon-add-to-list"></i> اضافة فرع جديدة</a></li>
								<li class="dropdown-submenu dropdown-submenu-right">
								<a href="#"><i class="icon-history"></i> الورديات </a>
								<ul class="dropdown-menu">
								<li><a href="{{route('accounting.shifts.index')}}"><i class="icon-eye"></i> عرض الوديات بجميع  الفروع</a></li>
								<li class="dropdown-submenu dropdown-submenu-right">
								<a href="{{route('accounting.shifts.create')}}"><i class="icon-add-to-list"></i> اضافة وردية جديده</a>
								</li>
								</ul>
								</li>
							</ul>
						</li>
						<!--Here we will put the links from the sent file from point 1 to point 8 -->
					 </ul>
				  </li>
			<!--            المخازن-->
			<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cabinet position-left"></i>
						المخازن
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-cabinet position-left"></i>
								إدارة  المخازن
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{route('accounting.stores.index')}}"><i class="icon-eye"></i> عرض المخازن</a></li>
								<li><a href="{{route('accounting.stores.create')}}"><i class="icon-add-to-list"></i> اضافة مخزن جديدة</a></li>
								<li><a href="{{route('accounting.stores.settlements')}}"><i class="icon-add-to-list"></i> تسوية ارصدة بداية الاصناف</a></li>
								{{--<li><a href="{{route('accounting.stores.inventory')}}"><i class="icon-add-to-list"></i> جرد المخازن</a></li>--}}
								{{--<li><a href="{{route('accounting.stores.invertory_filter')}}"><i class="icon-add-to-list"></i> تسوية جرد </a></li>--}}
								{{--<li><a href="{{route('accounting.stores.transaction')}}"><i class="icon-add-to-list"></i>  تحويلات بين المخازن  </a></li>--}}
								{{--<li><a href="{{route('accounting.stores.requests')}}"><i class="icon-add-to-list"></i> سندات تحويلات المخازن  </a></li>--}}

								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="#"><i class="icon-paragraph-right"></i> تحويلات الاصناف </a>
									<ul class="dropdown-menu">
										<li><a href="{{route('accounting.stores.transaction')}}"><i class="icon-add-to-list"></i> طلب تحويل </a></li>
										<li><a href="{{route('accounting.stores.requests')}}"><i class="icon-eye"></i> سندات تحويلات المخازن </a></li>
										<li><a href="{{route('accounting.stores.requests_all')}}"><i class="icon-eye"></i> سجل تحويلات المخازن </a></li>
									</ul>
								</li>
								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="#"><i class="icon-paragraph-right"></i> الجرد </a>
									<ul class="dropdown-menu">
										<li class="dropdown-submenu dropdown-submenu-right">
											<a href="#"><i class="icon-paragraph-right"></i> جرد المخازن </a>
											<ul class="dropdown-menu">
												<li><a href="{{route('accounting.stores.inventory')}}"><i class="icon-add-to-list"></i>  جرد المخازن </a></li>

												<li><a href="{{route('accounting.stores.inventories')}}"><i class="icon-add-to-list"></i> سجل  عمليات الجرد </a></li>
												<li><a href="{{route('accounting.stores.inventories_band')}}"><i class="icon-add-to-list"></i> سجل  سندات الجرد </a></li>

												{{--<li><a href="{{route('accounting.stores.invertory_filter')}}"><i class="icon-eye"></i> تسوية الجرد</a></li>--}}
											</ul>
										</li>
										<li class="dropdown-submenu dropdown-submenu-right">
											<a href="#"><i class="icon-paragraph-right"></i> جرد الاصناف </a>
											<ul class="dropdown-menu">
												<li><a href="{{route('accounting.stores.inventory_product')}}"><i class="icon-add-to-list"></i> سند جرد الاصناف </a></li>
												{{--<li><a href="{{route('accounting.stores.invertory_filter_product')}}"><i class="icon-eye"></i> تسوية الجرد</a></li>--}}
											</ul>

										</li>
									</ul>
								</li>

								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="#"><i class="icon-paragraph-right"></i>  الاصناف التالفه </a>
									<ul class="dropdown-menu">
										<li><a href="{{route('accounting.stores.damaged_index')}}"><i class="icon-add-to-list"></i> عرض سجل التالف </a></li>
										<li><a href="{{route('accounting.stores.damaged_create')}}"><i class="icon-eye"></i>  اضافه تالف  مخزن</a></li>
									</ul>
								</li>

								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="#"><i class="icon-paragraph-right"></i> أمناء المخازن </a>
									<ul class="dropdown-menu">
										<li><a href="{{route('accounting.storeKeepers.index')}}"><i class="icon-add-to-list"></i> عرض الامناء </a></li>
										<li><a href="{{route('accounting.storeKeepers.create')}}"><i class="icon-eye"></i>  اضافه امين  مخزن</a></li>
									</ul>
								</li>

								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="#"><i class="icon-paragraph-right"></i> السندات </a>
									<ul class="dropdown-menu">
										<li><a href="{{route('accounting.stores.products_entry_form')}}"><i class="icon-eye"></i> سند ادخال منتجات   </a></li>
										<li><a href="{{route('accounting.stores.products_exchange_form')}}"><i class="icon-eye"></i> سند صرف منتجات</a></li>
										<li><a href="{{route('accounting.stores.bonds_index')}}"><i class="icon-eye"></i> عرض جميع السندات</a></li>

									</ul>
								</li>

								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="#"><i class="icon-paragraph-right"></i> التقارير </a>
									<ul class="dropdown-menu">
										<li><a href="{{route('accounting.stores.first_balances_report')}}"><i class="icon-eye"></i>   تقرير ارصده اول  المده </a></li>
										{{--<li><a href="{{route('accounting.stores.products_exchange_form')}}"><i class="icon-eye"></i> سند صرف منتجات</a></li>--}}
									</ul>
								</li>
							</ul>
						</li>
						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-grid2 position-left"></i>
								إدارة  تصنيفات  الاقسام
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{route('accounting.categories.index')}}"><i class="icon-eye"></i> عرض تصنيفات الاقسام</a></li>
								<li><a href="{{route('accounting.categories.create')}}"><i class="icon-add-to-list"></i> اضافة تصنيف جديد</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-cabinet position-left"></i>
								إدارة  الشركات المصنعة
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{route('accounting.industrials.index')}}"><i class="icon-eye"></i> عرض الشركات المصنعة</a></li>
								<li><a href="{{route('accounting.industrials.create')}}"><i class="icon-add-to-list"></i> اضافة شركة جديدة</a></li>
							</ul>
                        </li>

                        <li class="dropdown-submenu dropdown-submenu-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-cabinet position-left"></i>
								 إدارة الضرائب
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{route('accounting.taxs.index')}}"><i class="icon-eye"></i> عرض  شرائح الضرائب</a></li>
								<li><a href="{{route('accounting.taxs.create')}}"><i class="icon-add-to-list"></i> اضافة شريحة جديدة</a></li>
							</ul>
						</li>
						<li class="dropdown-submenu dropdown-submenu-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cart position-left"></i>
							إدارة المنتجات
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-submenu dropdown-submenu-right">
								<a href="#"><i class="icon-basket"></i> المنتجات </a>
								<ul class="dropdown-menu">
									<li><a href="{{route('accounting.products.index')}}"><i class="icon-eye"></i> عرض  المنتجات</a></li>
									<li class="dropdown-submenu dropdown-submenu-right">
										<a href="{{route('accounting.products.create')}}"><i class="icon-add-to-list"></i> اضافة منتج جديد</a>
									</li>
								</ul>
							</li>
							<li class="dropdown-submenu dropdown-submenu-right">
								<a href="#"><i class="icon-paragraph-center"></i> الارفف  </a>
								<ul class="dropdown-menu">
									<li class="dropdown-submenu dropdown-submenu-right">
										<a href="#"><i class="icon-paragraph-justify"></i> الاوجه </a>
										<ul class="dropdown-menu">
											<li><a href="{{route('accounting.faces.index')}}"><i class="icon-eye"></i> عرض  الاوجة</a></li>
											<li class="dropdown-submenu dropdown-submenu-right">
												<a href="{{route('accounting.faces.create')}}"><i class="icon-add-to-list"></i> اضافة وجة جديد</a>
											</li>
										</ul>
									</li>
									<li class="dropdown-submenu dropdown-submenu-right">
										<a href="#"><i class="icon-paragraph-left"></i> الاعمده </a>
										<ul class="dropdown-menu">
											<li><a href="{{route('accounting.columns.index')}}"><i class="icon-eye"></i> عرض الاعمده </a></li>
											<li class="dropdown-submenu dropdown-submenu-right">
												<a href="{{route('accounting.columns.create')}}"><i class="icon-add-to-list"></i> اضافة عمود جديده</a>
											</li>
										</ul>
									</li>
									<li class="dropdown-submenu dropdown-submenu-right">
										<a href="#"><i class="icon-paragraph-right"></i> الخلايا </a>
										<ul class="dropdown-menu">
											<li><a href="{{route('accounting.cells.index')}}"><i class="icon-eye"></i> عرض الخلايا   </a></li>
											<li class="dropdown-submenu dropdown-submenu-right">
												<a href="{{route('accounting.cells.create')}}"><i class="icon-add-to-list"></i> اضافة خلية جديد</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					</ul>
				</li>
			<!-- المبيعات-->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-cabinet position-left"></i>
					المبيعات
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li class="dropdown-submenu dropdown-submenu-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cabinet position-left"></i>
							إدارة  العملاء
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{route('accounting.clients.index')}}"><i class="icon-eye"></i> عرض  العملاء</a></li>
						<li><a href="{{route('accounting.clients.create')}}"><i class="icon-add-to-list"></i> اضافة عميل جديد</a></li>
						<li><a href="{{route('accounting.clients.permiums')}}"><i class="icon-eye"></i>تقسيط مديوينه العملاء</a></li>
						<li><a href="{{route('accounting.clients.offers_copy')}}"><i class="icon-eye"></i> نسخ عروض  العملاء</a></li>
						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#"><i class="icon-history"></i> عروض الاسعار </a>
							<ul class="dropdown-menu">
								<li><a href="{{route('accounting.offers.index')}}"><i class="icon-eye"></i> عرض   عروض الاسعار للعملاء</a></li>
								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="{{route('accounting.offers.create')}}"><i class="icon-add-to-list"></i> اضافة عرض سعر جديده</a>
								</li>
							</ul>
						</li>
					</ul>
					</li>
					<!--Here we will put the links from the sent file from point 9 to the end of the file -->
				</ul>
			</li>
			<!-- المشتريات-->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-cabinet position-left"></i>
					المشتريات
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li class="dropdown-submenu dropdown-submenu-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cabinet position-left"></i>
						إدارة  الموردين
					</a>
					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="{{route('accounting.suppliers.index')}}"><i class="icon-eye"></i> عرض  الموردين</a></li>
						<li><a href="{{route('accounting.suppliers.create')}}"><i class="icon-add-to-list"></i> اضافة مورد جديد</a></li>
					</ul>
				</li>
					<!--Here we will put the links from the sent file from point 9 to point 11 but as  buying  spelling -->
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-list position-left"></i>
					إدارة الخزائن
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="{{route('accounting.safes.index')}}"><i class="icon-eye"></i> عرض الخزائن</a></li>
					<li><a href="{{route('accounting.safes.create')}}"><i class="icon-add-to-list"></i> اضافة خزينه جديدة</a></li>
				</ul>
            </li>
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-list position-left"></i>
					إدارة الاجهزة
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a href="{{route('accounting.devices.index')}}"><i class="icon-eye"></i> عرض الاجهزة</a></li>
					<li><a href="{{route('accounting.devices.create')}}"><i class="icon-add-to-list"></i> اضافة جهاز جديدة</a></li>
				</ul>
			</li>
			<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cabinet position-left"></i>
						إدارة  نقاط البيع
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('accounting.sells_points.login')}}"><i class="icon-eye"></i>  تسجيل  دخول  نقطة البيع</a></li>
						<li><a href="{{route('accounting.sells_points.sells_point')}}"><i class="icon-eye"></i> نقطه البيع</a></li>
					</ul>
				</li>
			<!--Tis will be commented temporarly-->
			<!--
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-cabinet position-left"></i>
								إدارة  المندوبين
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="{{route('accounting.delegates.index')}}"><i class="icon-eye"></i> عرض  المندوبين</a></li>
								<li><a href="{{route('accounting.delegates.create')}}"><i class="icon-add-to-list"></i> اضافة مندوب جديد</a></li>
							</ul>
						</li>
			-->
			<!--           الحسابات-->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-cabinet position-left"></i>
					الحسابات
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu dropdown-menu-right">
					<li class="dropdown-submenu dropdown-submenu-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-newspaper position-left"></i>
							إدارة البنود
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li class="dropdown-submenu dropdown-submenu-right">
								<a href="#"><i class="icon-newspaper"></i> البنود </a>
								<ul class="dropdown-menu">
									<li><a href="{{route('accounting.clauses.index')}}"><i class="icon-eye"></i> عرض  البنود</a></li>
									<li class="dropdown-submenu dropdown-submenu-right">
										<a href="{{route('accounting.clauses.create')}}"><i class="icon-add-to-list"></i> اضافة بند جديد</a>
									</li>
								</ul>
							</li>
							<li class="dropdown-submenu dropdown-submenu-right">
								<a href="#"><i class="icon-paragraph-justify"></i> التسجيلات </a>
								<ul class="dropdown-menu">
									<li><a href="{{route('accounting.benods.index')}}"><i class="icon-eye"></i> عرض  تسجيلات البنود</a></li>
									<li class="dropdown-submenu dropdown-submenu-right">
										<a href="{{route('accounting.benods.create')}}"><i class="icon-add-to-list"></i>  تسجيل بيان جديد</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="dropdown-submenu dropdown-submenu-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-cart position-left"></i>
					  التقارير
						<span class="caret"></span>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">

						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#"><i class="icon-basket"></i> تقارير العملاء </a>
							<ul class="dropdown-menu">
								<li><a href="{{route('accounting.products.index')}}"><i class="icon-eye"></i> عرض  المنتجات</a></li>
								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="{{route('accounting.products.create')}}"><i class="icon-add-to-list"></i> اضافة منتج جديد</a>
								</li>
							</ul>
						</li>

						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#"><i class="icon-basket"></i> تقارير المبيعات </a>
							<ul class="dropdown-menu">
								<li><a href="{{route('accounting.products.index')}}"><i class="icon-eye"></i> عرض  المنتجات</a></li>
								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="{{route('accounting.products.create')}}"><i class="icon-add-to-list"></i> اضافة منتج جديد</a>
								</li>
							</ul>
						</li>


						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#"><i class="icon-basket"></i> تقارير المندوبين </a>
							<ul class="dropdown-menu">
								<li><a href="{{route('accounting.products.index')}}"><i class="icon-eye"></i> عرض  المنتجات</a></li>
								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="{{route('accounting.products.create')}}"><i class="icon-add-to-list"></i> اضافة منتج جديد</a>
								</li>
							</ul>
						</li>
						<li class="dropdown-submenu dropdown-submenu-right">
							<a href="#"><i class="icon-basket"></i> تقارير الموردين </a>
							<ul class="dropdown-menu">
								<li><a href="{{route('accounting.products.index')}}"><i class="icon-eye"></i> عرض  المنتجات</a></li>
								<li class="dropdown-submenu dropdown-submenu-right">
									<a href="{{route('accounting.products.create')}}"><i class="icon-add-to-list"></i> اضافة منتج جديد</a>
								</li>
							</ul>
						</li>

					</ul>
				</li>
				</ul>
			</li>
        </ul>






        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{!! asset(Auth::user()->image )!!}" alt="">
                    <span>{!! Auth::user()->name !!}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    {{--<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>--}}
                    {{--<li><a href="#"><i class="icon-coins"></i> My balance</a></li>--}}
                    {{--<li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>--}}
                    {{--<li class="divider"></li>--}}
                    {{--<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>--}}
                    <li><a href="#" onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> تسجيل خروج</a>
                        <form id="logout-form" action="{{ route('admin.logout') }}"
                              method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
