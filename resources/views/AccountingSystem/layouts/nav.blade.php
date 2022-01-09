<div class="navbar navbar-inverse">
    <div class="navbar-header">
    <!-- <a class="navbar-brand" href="index.html"> <img src="{{asset('public/admin/assets/images/logo_light.png')}}" alt=""> </a>-->
        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>
    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li class="dropdown mega-menu mega-menu-wide the-short-links"><a href="#" class="dropdown-toggle"
                                                                             data-toggle="dropdown"> <i
                        class="icon-meter-fast position-left"></i> وصول سريع <span class="caret"></span> </a>
                <div class="dropdown-menu dropdown-content">
                    <div class="dropdown-content-body">
                        <div class="row all-shortcuts-wrapper">
                            <div class="single-shortcut"><a href="{{route('accounting.products.create')}}"> <img
                                        src="{{asset('admin/assets/images/shopping-bag.png')}}" alt="">
                                    <span>إضافة منتج</span> </a></div>
                            <div class="single-shortcut"><a href="{{route('accounting.stores.create')}}"> <img
                                        src="{{asset('admin/assets/images/shop.png')}}" alt="">
                                    <span>إضافة مستودع</span> </a></div>
                            <div class="single-shortcut"><a href="{{route('accounting.categories.create')}}"> <img
                                        src="{{asset('admin/assets/images/interface.png')}}" alt="">
                                    <span>إضافة تصنيف</span> </a></div>
                            <div class="single-shortcut"><a href="{{route('accounting.clauses.create')}}"> <img
                                        src="{{asset('admin/assets/images/terms.png')}}" alt=""> <span>إضافة سند قبض وصرف</span>
                                </a></div>
                            {{--							<div class="single-shortcut"> <a href="{{route('accounting.shifts.create')}}"> <img src="{{asset('admin/assets/images/shift.png')}}" alt=""> <span>إضافة وردية</span> </a> </div>--}}
                        </div>
                    </div>
                </div>
            </li>
            <!--الفهرس-->
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                        class="icon-file-text position-left"></i> الفهرس <span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-man position-left"></i> إدارة عضويات الادارة </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('accounting.users.index')}}"><i class="icon-eye"></i> عرض العضويات</a>
                            </li>
                            <li><a href="{{route('accounting.users.create')}}"><i class="icon-add-to-list"></i> اضافة
                                    عضو جديد</a></li>
                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                                   data-toggle="dropdown"> <i
                                        class="icon-list position-left"></i> إدارة المسميات الوظفية </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('accounting.jobTitles.create')}}"><i
                                                class="icon-add-to-list"></i> اضافه مسمى وظيفى</a></li>
                                    <li><a href="{{route('accounting.jobTitles.index')}}"><i class="icon-eye"></i> عرض
                                            المسميات الوظيفية</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('accounting.users.pay_salaries')}}"><i class="icon-add-to-list"></i>
                                    دفع رواتب الموظفين </a></li>
                            <li><a href="{{route('accounting.users.salaries_paid')}}"><i class="icon-eye"></i> رواتب
                                    الموظفين </a></li>

                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i class="icon-basket"></i> أدارة
                            الموظفين </a>
                        <ul class="dropdown-menu">

                            <li><a href="{{route('accounting.documents.index','employee')}}"><i class="icon-eye"></i>
                                    وثائق الموظفين</a></li>

                            <li><a href="{{route('accounting.documents.index','branch')}}"><i class="icon-eye"></i>
                                    وثائق الفروع </a></li>

                            <li><a href="{{route('accounting.allowances.index')}}"><i class="icon-eye"></i> البدلات </a>
                            </li>
                            <li><a href="{{route('accounting.holidays.index')}}"><i class="icon-eye"></i> الاجازات </a>
                            </li>
                            <li><a href="{{route('accounting.holidays-requests.index')}}"><i class="icon-eye"></i> طلبات
                                    الاجازات </a></li>
                            <li><a href="{{route('accounting.bonus-discount.index')}}"><i class="icon-eye"></i> خصومات
                                    واضافات </a></li>
                            <li><a href="{{route('accounting.attendances.index')}}"><i class="icon-eye"></i> الحضور
                                    والانصراف </a></li>
                            <li><a href="{{route('accounting.debts.index')}}"><i class="icon-eye"></i> السلف </a></li>
                            <li><a href="{{route('accounting.salaries.index')}}"><i class="icon-eye"></i> الرواتب </a>
                            </li>
                        </ul>
                    </li>

                    @can('إدارة الشركات')
                        <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                               data-toggle="dropdown"> <i
                                    class="icon-list position-left"></i> إدارة الشركات </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @can('عرض الشركات')
                                    <li><a href="{{route('accounting.companies.index')}}"><i class="icon-eye"></i> عرض
                                            الشركات</a></li>
                                @endcan
                                @can( 'اضافة الشركه')
                                    <li><a href="{{route('accounting.companies.create')}}"><i
                                                class="icon-add-to-list"></i> اضافة شركة جديدة</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('إدارة  الفروع')
                        <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                               data-toggle="dropdown"> <i
                                    class="icon-home2 position-left"></i> إدارة فروع الشركات </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                {{--@can('عرض الفروع') --}}
                                <li><a href="{{route('accounting.branches.index')}}"><i class="icon-eye"></i> عرض فروع
                                        الشركات</a></li>
                                {{--@endcan --}}
                                @can('اضافة الفرع')
                                    <li><a href="{{route('accounting.branches.create')}}"><i
                                                class="icon-add-to-list"></i> اضافة فرع جديدة</a></li>
                                @endcan
                                <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                            class="icon-history"></i> الورديات </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('accounting.shifts.index')}}"><i class="icon-eye"></i> عرض
                                                الوديات بجميع الفروع</a></li>
                                        <li class="dropdown-submenu dropdown-submenu-right"><a
                                                href="{{route('accounting.shifts.create')}}"><i
                                                    class="icon-add-to-list"></i> اضافة وردية جديده</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('إدارة الخزائن')
                        <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                               data-toggle="dropdown"> <i
                                    class="icon-list position-left"></i> إدارة الخزائن <span class="caret"></span> </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @can('عرض  الخزائن')
                                    <li><a href="{{route('accounting.safes.index')}}"><i class="icon-eye"></i> عرض
                                            الخزائن</a></li>
                                @endcan
                                @can('اضافة خزينه')
                                    <li><a href="{{route('accounting.safes.create')}}"><i class="icon-add-to-list"></i>
                                            اضافة خزينه جديدة</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('إدارة  الاجهزة')
                        <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                               data-toggle="dropdown"> <i
                                    class="icon-list position-left"></i> إدارة الاجهزة <span class="caret"></span> </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @can('عرض  الاجهزه')
                                    <li><a href="{{route('accounting.devices.index')}}"><i class="icon-eye"></i> عرض
                                            الاجهزة</a></li>
                                @endcan
                                @can('اضافة جهاز')
                                    <li><a href="{{route('accounting.devices.create')}}"><i
                                                class="icon-add-to-list"></i> اضافة جهاز جديدة</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    <li class="dropdown-submenu dropdown-submenu-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                                class="icon-list position-left"></i> إدارة خطوط الانتاج <span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a href="{{route('accounting.productionLines.index')}}"><i class="icon-eye"></i> عرض
                                    خطوط
                                    الانتاج</a>
                            </li>
                            <li>
                                <a href="{{route('accounting.productionLines.create')}}"><i
                                        class="icon-add-to-list"></i> اضافة
                                    خط انتاج </a>
                            </li>
                        </ul>
                    </li>

                    <!--Here we will put the links from the sent file from point 1 to point 8 -->
                </ul>
            </li> <!-- المستودعات-->
            @can('عرض  المخازن')
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                            class="icon-cabinet position-left"></i> المستودعات <span class="caret"></span> </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                               data-toggle="dropdown"> <i
                                    class="icon-cabinet position-left"></i> إدارة المستودعات </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @can('عرض  المخازن')
                                    <li><a href="{{route('accounting.stores.index')}}"><i class="icon-eye"></i> عرض
                                            المستودعات</a></li>
                                @endcan
                                @can('اضافة مخزن')
                                    <li><a href="{{route('accounting.stores.create')}}"><i class="icon-add-to-list"></i>
                                            اضافة مستودع جديدة</a></li>
                                @endcan

                                <li><a href="{{route('accounting.stores.settlements')}}"><i
                                            class="icon-add-to-list"></i> تسوية ارصدة بداية الاصناف</a></li>

                                {{--<li><a href="{{route('accounting.stores.inventory')}}"><i class="icon-add-to-list"></i> جرد المستودعات</a>

         </li>--}} {{--<li><a href="{{route('accounting.stores.invertory_filter')}}"><i class="icon-add-to-list"></i> تسوية جرد </a>
			</li>--}} {{--<li><a href="{{route('accounting.stores.transaction')}}"><i class="icon-add-to-list"></i> تحويلات بين المستودعات </a></li>--}} {{--<li><a href="{{route('accounting.stores.requests')}}"><i class="icon-add-to-list"></i> سندات تحويلات المستودعات </a></li>--}}
                                @can('تحويلات الاصناف فى المخرن')
                                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                class="icon-paragraph-right"></i> تحويلات الاصناف </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{route('accounting.stores.transaction')}}"><i
                                                        class="icon-add-to-list"></i> طلب تحويل </a></li>

                                            <li><a href="{{route('accounting.stores.requests')}}"><i
                                                        class="icon-eye"></i> سندات تحويلات المستودعات </a></li>

                                            <li><a href="{{route('accounting.stores.requests_all')}}"><i
                                                        class="icon-eye"></i> سجل تحويلات المستودعات </a></li>
                                        </ul>
                                    </li>
                                @endcan
                                @can('جرد المخزن')
                                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                class="icon-paragraph-right"></i> الجرد </a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                        class="icon-paragraph-right"></i> جرد المستودعات </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{route('accounting.stores.inventory')}}"><i
                                                                class="icon-add-to-list"></i> جرد المستودعات </a></li>
                                                    <li><a href="{{route('accounting.stores.inventories')}}"><i
                                                                class="icon-add-to-list"></i> سجل عمليات الجرد </a></li>
                                                    <li><a href="{{route('accounting.stores.inventories_band')}}"><i
                                                                class="icon-add-to-list"></i> سجل سندات الجرد </a></li> {{--<li><a href="{{route('accounting.stores.invertory_filter')}}"><i class="icon-eye"></i> تسوية الجرد</a>
					</li>--}}
                                                </ul>
                                            </li>

                                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                        class="icon-paragraph-right"></i> جرد الاصناف </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{route('accounting.stores.inventory_product')}}"><i
                                                                class="icon-add-to-list"></i> سند جرد الاصناف </a></li> {{--<li><a href="{{route('accounting.stores.invertory_filter_product')}}"><i class="icon-eye"></i> تسوية الجرد</a>
			</li>--}}
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can('اصناف تالفة')
                                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                class="icon-paragraph-right"></i> الاصناف التالفه </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{route('accounting.stores.damaged_index')}}"><i
                                                        class="icon-add-to-list"></i> عرض سجل التالف </a></li>
                                            <li><a href="{{route('accounting.stores.damaged_create')}}"><i
                                                        class="icon-eye"></i> اضافه تالف مستودع</a></li>
                                        </ul>
                                    </li>
                                @endcan
                                <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                            class="icon-paragraph-right"></i> أمناء المستودعات </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('accounting.storeKeepers.index')}}"><i
                                                    class="icon-add-to-list"></i> عرض الامناء </a></li>
                                        <li><a href="{{route('accounting.storeKeepers.create')}}"><i
                                                    class="icon-eye"></i> اضافه امين مستودع</a></li>
                                    </ul>
                                </li>
                                @can('سندات المخازن')
                                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                class="icon-paragraph-right"></i> السندات </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{route('accounting.stores.products_entry_form')}}"><i
                                                        class="icon-eye"></i> سند ادخال اصناف </a></li>
                                            <li><a href="{{route('accounting.stores.products_exchange_form')}}"><i
                                                        class="icon-eye"></i> سند صرف اصناف</a></li>
                                            <li><a href="{{route('accounting.stores.bonds_index')}}"><i
                                                        class="icon-eye"></i> عرض جميع السندات</a></li>
                                        </ul>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                               data-toggle="dropdown"> <i
                                    class="icon-grid2 position-left"></i> إدارة تصنيفات الاقسام </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{route('accounting.categories.index')}}"><i class="icon-eye"></i> عرض
                                        تصنيفات الاقسام</a></li>
                                <li><a href="{{route('accounting.categories.create')}}"><i class="icon-add-to-list"></i>
                                        اضافة تصنيف جديد</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                               data-toggle="dropdown"> <i
                                    class="icon-cabinet position-left"></i> إدارة الشركات المصنعة </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="{{route('accounting.industrials.index')}}"><i class="icon-eye"></i> عرض
                                        الشركات المصنعة</a></li>
                                <li><a href="{{route('accounting.industrials.create')}}"><i
                                            class="icon-add-to-list"></i> اضافة شركة جديدة</a></li>
                            </ul>
                        </li>
                        @can('إدارة  الضرائب')
                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                                   data-toggle="dropdown"> <i
                                        class="icon-cabinet position-left"></i> إدارة الضرائب </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="{{route('accounting.taxs.index')}}"><i class="icon-eye"></i> عرض شرائح
                                            الضرائب</a></li>
                                    <li><a href="{{route('accounting.taxs.create')}}"><i class="icon-add-to-list"></i>
                                            اضافة شريحة جديدة</a></li>
                                </ul>
                            </li>
                        @endcan
                        @can('إدارة المنتجات')
                            <li class="dropdown-submenu dropdown-submenu-right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                                        class="icon-cart position-left"></i> إدارة الاصناف </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                class="icon-basket"></i> الاصناف </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{route('accounting.products.index')}}"><i
                                                        class="icon-eye"></i> عرض الاصناف</a></li>
                                            <li><a href="{{route('accounting.products.print_barcode_view')}}"><i
                                                        class="icon-barcode2"></i> طباعة الباركود</a></li>
                                            <li class="dropdown-submenu dropdown-submenu-right"><a
                                                    href="{{route('accounting.products.create')}}">
                                                    <i class="icon-add-to-list"></i> اضافة منتج جديد</a>
                                            </li>
                                            <li class="dropdown-submenu dropdown-submenu-right"><a
                                                    href="{{route('accounting.suppliers-products.index')}}">
                                                    <i class="icon-add-to-list"></i> الاصناف المقترحة</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                class="icon-paragraph-center"></i> الارفف </a>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                        class="icon-paragraph-justify"></i> الاوجه </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{route('accounting.faces.index')}}"><i
                                                                class="icon-eye"></i> عرض الاوجة</a></li>
                                                    <li class="dropdown-submenu dropdown-submenu-right"><a
                                                            href="{{route('accounting.faces.create')}}"><i
                                                                class="icon-add-to-list"></i> اضافة وجة جديد</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                        class="icon-paragraph-left"></i> الاعمده </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{route('accounting.columns.index')}}"><i
                                                                class="icon-eye"></i> عرض الاعمده </a></li>
                                                    <li class="dropdown-submenu dropdown-submenu-right"><a
                                                            href="{{route('accounting.columns.create')}}"><i
                                                                class="icon-add-to-list"></i> اضافة عمود جديده</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                                        class="icon-paragraph-right"></i> الخلايا </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="{{route('accounting.cells.index')}}"><i
                                                                class="icon-eye"></i> عرض الخلايا </a></li>
                                                    <li class="dropdown-submenu dropdown-submenu-right"><a
                                                            href="{{route('accounting.cells.create')}}"><i
                                                                class="icon-add-to-list"></i> اضافة خلية جديد</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown-submenu dropdown-submenu-right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                                        class="icon-cart position-left"></i> التصنيع </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{route('accounting.product-recipes.index')}}">
                                            <i class="icon-eye"></i> مكونات التصنيع    </a>
                                    </li>
                                    <li>
                                        <a href="{{route('accounting.productions.index')}}">
                                            <i class="icon-eye"></i> عرض أوامر التصنيع</a>
                                    </li>
                                    <li class="dropdown-submenu dropdown-submenu-right">
                                        <a href="{{route('accounting.productions.create')}}"><i
                                                class="icon-add-to-list"></i> اضافة أمر تصنيع </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown-submenu dropdown-submenu-right">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                                        class="icon-cart position-left"></i> Empty </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="{{url('accounting/empty')}}">
                                            <i class="icon-eye"></i>   Empty    </a>
                                    </li>

                                </ul>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                        class="icon-list position-left"></i> إدارة الفواتير <span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-menu-right">

                    <!---------------------------------------------------------------------------------- المبيعات-->
                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-cabinet position-left"></i> المبيعات </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            @can('عرض فواتير المبيعات')
                                <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                            class="icon-cabinet position-left"></i> فواتير المبيعات</a>
                                    <ul class="dropdown-menu">

                                        <li><a href="{{route('accounting.sales.index')}}"><i class="icon-eye"></i> عرض
                                                الفواتير </a></li>
                                        <li><a href="{{route('accounting.sales.create')}}"><i class="icon-eye"></i>
                                                فاتوره بيع </a></li>

                                    </ul>
                                </li>
                            @endcan

                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                        class="icon-cabinet position-left"></i> الجلسات</a>
                                <ul class="dropdown-menu">
                                    @can('عرض الجلسات')
                                        <li><a href="{{route('accounting.sessions.index')}}"><i class="icon-eye"></i>
                                                عرض الجلسات</a></li>
                                    @endcan
                                    @can('الجلسات المغلقة من الكاشير')
                                        <li><a href="{{route('accounting.sessions.sessions_close')}}"><i
                                                    class="icon-eye"></i> الجلسات المغلقة من قبل الكاشير</a></li>
                                    @endcan
                                </ul>

                            </li>
                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                                   data-toggle="dropdown"> <i
                                        class="icon-cabinet position-left"></i> إدارة العملاء </a>
                                <ul class="dropdown-menu dropdown-menu-right">

                                        <li><a href="{{route('accounting.clients.index')}}"><i class="icon-eye"></i> عرض
                                                العملاء</a></li>

                                        <li><a href="{{route('accounting.clients.create')}}"><i
                                                    class="icon-add-to-list"></i> اضافة عميل جديد</a></li>
                                    {{--						<li><a href="{{route('accounting.clients.permiums')}}"><i class="icon-eye"></i>تقسيط مديوينه العملاء</a></li>--}}
                                    {{--						<li><a href="{{route('accounting.clients.offers_copy')}}"><i class="icon-eye"></i> نسخ عروض العملاء</a></li>--}}
                                    {{--						<li class="dropdown-submenu dropdown-submenu-right"> <a href="#"><i class="icon-history"></i> عروض الاسعار </a>--}}
                                    {{--							<ul class="dropdown-menu">--}}
                                    {{--								<li><a href="{{route('accounting.offers.index')}}"><i class="icon-eye"></i> عرض عروض الاسعار للعملاء</a></li>--}}
                                    {{--								<li class="dropdown-submenu dropdown-submenu-right"> <a href="{{route('accounting.offers.create')}}"><i class="icon-add-to-list"></i> اضافة عرض سعر جديده</a> </li>--}}
                                    {{--							</ul>--}}
                                    {{--						</li>--}}
                                </ul>
                            </li>
                            @can('عرض فواتير مرتجعات المبيعات')
                                <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                            class="icon-cabinet position-left"></i> مرتجعات المبيعات </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('accounting.sales.index_returns')}}"><i
                                                    class="icon-eye"></i> عرض فواتير المرتجعات </a></li>
                                    </ul>
                                </li>
                        @endcan

                        <!--Here we will put the links from the sent file from point 9 to the end of the file -->
                        </ul>
                    </li> <!------------------------ المشتريات-->
                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-cabinet position-left"></i> المشتريات </a>
                        <ul class="dropdown-menu dropdown-menu-right">

                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                                   data-toggle="dropdown"> <i
                                        class="icon-cabinet position-left"></i> المشتريات </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @can('عرض فواتير المشتريات')
                                        <li><a href="{{route('accounting.purchases.index')}}"><i class="icon-eye"></i>
                                                عرض فواتير الشراء</a></li>
                                    @endcan
                                    @can('اضافة فاتورة مشتريات')
                                        <li><a href="{{route('accounting.buy_point.buy_point')}}"><i
                                                    class="icon-add-to-list"></i> اضافة مشترى جديد</a></li>
                                    @endcan
                                </ul>
                            </li>


                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                                   data-toggle="dropdown"> <i
                                        class="icon-cabinet position-left"></i> المرتجعات </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @can('اضافة فاتورة مرتجع مشترى')
                                        <li><a href="{{route('accounting.puchaseReturns.create')}}"><i
                                                    class="icon-add-to-list"></i> اضافة فاتورة مرتجعات جديدة</a></li>
                                    @endcan
                                    @can('عرض فواتير مرتجعات المشتريات')
                                        <li><a href="{{route('accounting.puchaseReturns.index')}}"><i
                                                    class="icon-add-to-list"></i> عرض فواتير المرتجعات </a></li>
                                    @endcan
                                </ul>
                            </li>

                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                                   data-toggle="dropdown"> <i
                                        class="icon-cabinet position-left"></i> إدارة الموردين </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @can('عرض الموردين')
                                        <li><a href="{{route('accounting.suppliers.index')}}"><i class="icon-eye"></i>
                                                عرض الموردين</a></li>
                                    @endcan
                                    @can('اضافة مورد')
                                        <li><a href="{{route('accounting.suppliers.create')}}"><i
                                                    class="icon-add-to-list"></i> اضافة مورد جديد</a></li>
                                    @endcan
                                    @can('سجل سداد مورد')
                                        <li><a href="{{route('accounting.suppliers_sadad.index')}}"><i
                                                    class="icon-eye"></i> عرض سجلات السداد</a></li>
                                    @endcan
                                    {{--<li><a href="{{route('accounting.suppliers_sadad.create')}}"><i class="icon-add-to-list"></i> اضافة سند سداد جديد</a></li>--}}
                                    @can('اضافة مشتريات مورد')
                                        <li><a href="{{route('accounting.suppliers.purchase_order')}}"><i
                                                    class="icon-add-to-list"></i> طلب شراء جديد</a></li>
                                    @endcan
                                </ul>
                            </li>
                            <!--Here we will put the links from the sent file from point 9 to point 11 but as buying spelling -->
                        </ul>
                    </li>
                </ul>
            </li>
            @can('نقطة البيع')
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                            class="icon-cabinet position-left"></i> إدارة نقاط البيع <span class="caret"></span> </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        {{-- @dd(Cookie::get('session')) --}}
                        @if (Cookie::get('session'))
                            <li><a href="{{route('accounting.sells_points.sells_point',Cookie::get('session'))}}"><i
                                        class="icon-eye"></i> نقطه البيع</a></li>
                            <li><a href="{{route('accounting.invoices.current',Cookie::get('session'))}}"><i
                                        class="icon-eye"></i> الفواتير الحالية</a>
                            </li> @elseif (Cookie::get('session')==Null)
                            <li><a href="{{route('accounting.sells_points.login')}}"><i class="icon-eye"></i> تسجيل دخول
                                    نقطة البيع</a></li> @endif
                    </ul>
                </li>
            @endcan
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                        class="icon-cabinet position-left"></i> السندات <span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-newspaper position-left"></i> سندات القبض والصرف <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            @can('عرض سندات القبض والصرف')
                                <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                            class="icon-newspaper"></i> السندات </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{route('accounting.clauses.index')}}"><i class="icon-eye"></i> عرض
                                                السندات</a></li>
                                        <li class="dropdown-submenu dropdown-submenu-right"><a
                                                href="{{route('accounting.clauses.create')}}"><i
                                                    class="icon-add-to-list"></i> اضافة سند جديد</a></li>
                                        <li><a href="{{route('accounting.clauses.checks')}}"><i class="icon-eye"></i>
                                                عرض الشيكات</a></li>

                                    </ul>
                                </li>
                            @endcan
                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                        class="icon-paragraph-justify"></i> بنود القبض والصرف </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('accounting.benods.index')}}"><i class="icon-eye"></i> عرض
                                            البنود</a></li>
                                    <li class="dropdown-submenu dropdown-submenu-right"><a
                                            href="{{route('accounting.benods.create')}}"><i
                                                class="icon-add-to-list"></i> اضافة بند جديد</a></li>
                                </ul>
                            </li>


                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                        class="icon-paragraph-justify"></i> البنوك</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('accounting.banks.index')}}"><i class="icon-eye"></i> عرض
                                            البنوك</a></li>
                                    <li class="dropdown-submenu dropdown-submenu-right"><a
                                            href="{{route('accounting.banks.create')}}"><i class="icon-add-to-list"></i>
                                            اضافة بنك جديد</a></li>
                                </ul>
                            </li>

                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i
                                        class="icon-paragraph-justify"></i> خيارات الدفع</a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('accounting.payments.index')}}"><i class="icon-eye"></i> عرض
                                            خيارات الدفع</a></li>
                                    <li class="dropdown-submenu dropdown-submenu-right"><a
                                            href="{{route('accounting.payments.create')}}"><i
                                                class="icon-add-to-list"></i> اضافة خيار جديد</a></li>
                                </ul>
                            </li>
                        </ul>


                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-cabinet position-left"></i> إدارة العملات </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('accounting.currencies.index')}}"><i class="icon-eye"></i> عرض العملات</a>
                            </li>
                            <li><a href="{{route('accounting.currencies.create')}}"><i class="icon-add-to-list"></i>
                                    اضافة عملة جديدة</a></li>
                        </ul>
                    </li>
                    </li>

                </ul>
            </li>

            <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                   data-toggle="dropdown"> <i
                        class="icon-list position-left"></i> الحسابات </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('accounting.ChartsAccounts.index')}}"><i class="icon-eye"></i> الدليل المحاسبى</a>
                    </li>
                    <li><a href="{{route('accounting.ChartsAccounts.trial_balance')}}"><i class="icon-eye"></i> ميزان
                            المراجعة</a></li>
                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-list position-left"></i> السنوات المالية </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('accounting.fiscalYears.create')}}"><i class="icon-eye"></i> اضافه سنة
                                    ماليه</a></li>
                            <li><a href="{{route('accounting.fiscalYears.index')}}"><i class="icon-eye"></i> عرض السنوات
                                    المالية</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-list position-left"></i> الفترات المالية </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('accounting.fiscalPeriods.create')}}"><i class="icon-eye"></i> اضافه
                                    فترة ماليه</a></li>
                            <li><a href="{{route('accounting.fiscalPeriods.index')}}"><i class="icon-eye"></i> عرض
                                    الفترات المالية</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-list position-left"></i> التقارير المالية </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('accounting.templates.create')}}"><i class="icon-eye"></i> اضافه قالب
                                    تقرير</a></li>
                            <li><a href="{{route('accounting.templates.index')}}"><i class="icon-eye"></i> عرض قوالب
                                    التقارير المالية</a></li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-list position-left"></i> مراكز التكلفة </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('accounting.costCenters.create')}}"><i class="icon-eye"></i> اضافه مركز
                                    تكلفة</a></li>
                            <li><a href="{{route('accounting.costCenters.index')}}"><i class="icon-eye"></i> عرض مراكز
                                    التكلفة</a></li>
                        </ul>
                    </li>


                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-list position-left"></i> اداره الاصول </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('accounting.assets.create')}}"><i class="icon-eye"></i> اضافه اصل جديد</a>
                            </li>
                            <li><a href="{{route('accounting.assets.index')}}"><i class="icon-eye"></i> عرض الاصول </a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                           data-toggle="dropdown"> <i
                                class="icon-list position-left"></i> ادارة العهدة </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{route('accounting.custodies.create')}}"><i class="icon-eye"></i> اضافه عهده
                                    جديد</a></li>
                            <li><a href="{{route('accounting.custodies.index')}}"><i class="icon-eye"></i> عرض العهد
                                </a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                   data-toggle="dropdown"> <i
                        class="icon-list position-left"></i> القيود المحاسبيه </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('accounting.entries.create')}}"><i class="icon-add-to-list"></i> اضافة قيد يدوى</a>
                    </li>
                    <li><a href="{{route('accounting.entries.index')}}"><i class="icon-eye"></i> عرض القيود</a></li>

                </ul>
            </li>


            @can('إدارة التقارير')
            <!-- ================== Reports ============================= -->
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                            class="icon-cabinet position-left"></i> التقارير <span class="caret"></span> </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        @can('تقارير المبيعات ')
                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i class="icon-basket"></i>
                                    تقرير المبيعات </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('accounting.reports.sessions_report')}}"><i
                                                class="icon-eye"></i>
                                            تقرير حركه بيع </a></li>

                                    <li><a href="{{route('accounting.reports.sales_period')}}"><i class="icon-eye"></i>
                                            خلال فترة زمنية </a></li>
                                    <li><a href="{{route('accounting.reports.sales_day')}}"><i class="icon-eye"></i>
                                            خلال يوم </a></li>
                                    <li><a href="{{route('accounting.reports.sales_returns')}}"><i class="icon-eye"></i>
                                            مرتجعات خلال فترة زمنية </a></li>
                                    <li><a href="{{route('accounting.reports.sales_returns_day')}}"><i
                                                class="icon-eye"></i> مرتجعات خلال يوم </a></li>
                                    <li><a href="{{route('accounting.reports.daily_earnings')}}"><i
                                                class="icon-eye"></i> تقرير الارباح اليومية </a></li>
                                    <li><a href="{{route('accounting.reports.period_earnings')}}"><i
                                                class="icon-eye"></i> تقرير أرباح مدة زمنية </a></li>
                                </ul>
                            </li>
                        @endcan
                        @can('تقارير المشتريات ')
                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i class="icon-basket"></i>
                                    تقارير المشتريات </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('accounting.reports.purchases')}}"><i class="icon-eye"></i>
                                            خلال فترة زمنية </a></li>
                                    <li><a href="{{route('accounting.reports.purchases_day')}}"><i class="icon-eye"></i>
                                            خلال يوم </a></li>
                                    <li><a href="{{route('accounting.reports.purchases_returns')}}"><i
                                                class="icon-eye"></i> مرتجعات خلال فترة زمنية </a></li>
                                    <li><a href="{{route('accounting.reports.purchases_returns_day')}}"><i
                                                class="icon-eye"></i> مرتجعات خلال يوم </a></li>
                                </ul>
                            </li>
                        @endcan

                        @can('تقارير المخازن ')
                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i class="icon-basket"></i>
                                    تقارير المستودعات </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('accounting.reports.damaged-products')}}"><i
                                                class="icon-eye"></i> تقرير التالف </a></li>
                                    <li><a href="{{route('accounting.reports.inventory-products')}}"><i
                                                class="icon-eye"></i> تقرير الجرد </a></li>
                                    <li><a href="{{route('accounting.reports.deficiency-products')}}"><i
                                                class="icon-eye"></i> تقرير النواقص </a></li>
                                    <li><a href="{{route('accounting.reports.transaction-products')}}"><i
                                                class="icon-eye"></i> تقرير التحويلات بين المستودعات </a></li>
                                    <li><a href="{{route('accounting.reports.expiration-products')}}"><i
                                                class="icon-eye"></i> تقرير الاصناف قاربت على الانتهاء </a></li>
                                    <li><a href="{{route('accounting.reports.stagnant-products')}}"><i
                                                class="icon-eye"></i> تقرير الاصناف الراكدة </a></li>

                                </ul>
                            </li>
                        @endcan
                        @can('تقارير الموردين ')
                            <li class="dropdown-submenu dropdown-submenu-right"><a href="#"><i class="icon-basket"></i>
                                    تقارير الموردين </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('accounting.reports.suppliers.purchases')}}"><i
                                                class="icon-eye"></i> تقرير مشتريات مورد خلال فترة زمنية </a></li>
                                    <li><a href="{{route('accounting.reports.suppliers.purchases-all')}}"><i
                                                class="icon-eye"></i> تقرير مشتريات كل الموردين خلال فترة زمنية </a>
                                    </li>

                                    <li><a href="{{route('accounting.reports.suppliers.purchases-returns')}}"><i
                                                class="icon-eye"></i> تقرير مرتجعات مشتريات مورد خلال فترة زمنية </a>
                                    </li>
                                    <li><a href="{{route('accounting.reports.suppliers.purchases-returns-all')}}"><i
                                                class="icon-eye"></i> تقرير مرتجعات مشتريات كل الموردين خلال فترة زمنية
                                        </a></li>
                                    <li><a href="{{route('accounting.reports.suppliers.account-statement')}}"><i
                                                class="icon-eye"></i> تقرير كشف حساب مورد خلال فترة زمنية </a></li>
                                </ul>
                            </li>
                        @endcan
                          <li><a href="{{route('accounting.reports.movements-products')}}"><i
                                                class="icon-eye"></i> تقرير حركة صنف </a></li>
                          <li><a href="{{route('accounting.reports.general-movements')}}">
                          <i class="icon-eye"></i> تقرير اجمالى حركات اصناف </a></li>
                    </ul>
                </li>
            @endcan
            @can(' الاعدادات العامة')
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                            class="glyphicon glyphicon-cog	 position-left"></i> إدارة الاعدادات <span
                            class="caret"></span> </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="{{route('accounting.settings.index')}}"><i class="glyphicon glyphicon-cog"></i>
                                الأعدادت </a></li>
                        <li><a href="{{route('accounting.roles.index')}}"><i class="glyphicon glyphicon-cog"></i>
                                الصلاحيات </a></li>
                        <li class="dropdown-submenu dropdown-submenu-right"><a href="#" class="dropdown-toggle"
                                                                               data-toggle="dropdown"> <i
                                    class="glyphicon glyphicon-cog	 position-left"></i> إعدادات النظامى المالى </a>
                            <ul class="dropdown-menu dropdown-menu-right">

                                <li><a href="{{route('accounting.settings.show',['accounting_chart'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> شجره الحسابات </a></li>
                                <li><a href="{{route('accounting.settings.show',['accounting_purchases'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> تعين حسابات المشتريات </a></li>
                                <li><a href="{{route('accounting.settings.show',['accounting_sales'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> تعين حسابات المبيعات </a></li>
                                <li><a href="{{route('accounting.settings.show',['accounting_stores'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> تعين حسابات المخزون </a></li>
                                <li><a href="{{route('accounting.settings.show',['accounting_cash'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> تعين حسابات النقدية </a></li>
                                <li><a href="{{route('accounting.settings.show',['accounting_entries'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> تعين القيود المحاسبيه </a></li>
                                <li><a href="{{route('accounting.settings.show',['accounting_banks_safes'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> تعين حسابات البنوك والصناديق </a></li>
                                <li><a href="{{route('accounting.settings.show',['accounting_payment'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> تعين خيارات الدفع </a></li>
                                <li><a href="{{route('accounting.settings.show',['accounting_salaries'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> تعين حسابات الاجور والمرتبات </a></li>
                                <li><a href="{{route('accounting.settings.show',['accounting_damages'])}}"><i
                                            class="glyphicon glyphicon-cog"></i> تعين حسابات الاهلاك </a></li>


                            </ul>
                        </li>
                    </ul>
                </li>
        @endcan

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i
                        class="glyphicon glyphicon-cog	 position-left"></i> الموردين <span
                        class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a href="{{route('accounting.suppliers-banks.index')}}"><i class="glyphicon glyphicon-bill"></i>
                            بنوك الموردين </a></li>

                        </ul>
                    </li>
                </ul>




        <!--Tis will be commented temporarly-->
        <!-- <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-cabinet position-left"></i> إدارة المندوبين <span class="caret"></span> </a> <ul class="dropdown-menu dropdown-menu-right"> <li><a href="{{route('accounting.delegates.index')}}"><i class="icon-eye"></i> عرض المندوبين</a></li> <li><a href="{{route('accounting.delegates.create')}}"><i class="icon-add-to-list"></i> اضافة مندوب جديد</a></li> </ul> </li> -->
            <!-- الحسابات-->
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user"><a class="dropdown-toggle" data-toggle="dropdown"> <img
                        src="{!! asset(Auth::user()->image )!!}" alt=""> <span>{!! Auth::user()->name !!}</span> <i
                        class="caret"></i> </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="/check"><i class="icon-switch2"></i>الرئيسية</a>
                    </li>

                    <li><a href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="icon-switch2"></i> تسجيل خروج</a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                              style="display: none;"> @csrf </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
