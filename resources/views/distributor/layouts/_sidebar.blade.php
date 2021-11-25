<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
         m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
        <ul class="m-menu__nav ">
            {{--************************************************************************--}}

            <li class="m-menu__item " aria-haspopup="true"><a href="{!! route('distributor.home') !!}"
                                                              class="m-menu__link "><span
                        class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-home-1"></i><span
                        class="m-menu__link-text">الرئيسية</span></a></li>


            {{--            ***********************************************************************************************************--}}

            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-user"></i><span
                        class="m-menu__link-text"> الإعدادات</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text"> أنواع المستودعات</span></span></li>
                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('distributor.store_categories.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">أنواع المستودعات</span></a></li>
                        <!--*********************************************************************************************-->
                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.expenditureTypes.create') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">أنواع الصرف </span></a></li>
                        <!--*********************************************************************************************-->

                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.expenditureClauses.create') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">بنود الصرف </span></a></li>
                        <!--*********************************************************************************************-->

                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.readers.create') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">اسماء العدادات </span></a></li>
                        <!--*********************************************************************************************-->

                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.client-classes.create') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">أنواع شرائح الضرائب  </span></a></li>
                        <!--*********************************************************************************************-->
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.refuses.create') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text"> أسباب الرفض </span></a></li>
                        <!--*********************************************************************************************-->


                    </ul>
                </div>
            </li>

            {{--************************************************************************--}}  {{--************************************************************************--}}
            {{--************************************************************************--}}  {{--************************************************************************--}}




            {{--************************************************************************--}}


            {{--            ***********************************************************************************************************--}}
            {{--************************************************************************--}}

            {{--************************************************************************--}}

            {{--            ***********************************************************************************************************--}}
            {{--************************************************************************--}}
            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-user"></i><span
                        class="m-menu__link-text"> المندوبين</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">المندوبين</span></span></li>
                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('distributor.distributors.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل المندوبين</span></a></li>

                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.cars.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">سيارات المندوبين </span></a></li>
                        {{--                            @endif--}}
                    </ul>
                </div>
            </li>
            {{--            ***********************************************************************************************************--}}

            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">المستودعات</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">كل المستودعات</span></span></li>
                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('distributor.stores.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل المستودعات</span></a></li>

                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.stores.create') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">إضافة مستودع جديد </span></a></li>
                        {{--                            @endif--}}
                    </ul>
                </div>
            </li>


            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">
                         الاصناف (المنتجات)</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">كل الاصناف</span></span></li>
                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('distributor.products.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل الاصناف</span></a></li>

                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.products.create') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">إضافة صنف جديد </span></a></li>
                        {{--                            @endif--}}
                    </ul>
                </div>
            </li>
            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">نقل الاصناف بين مندوبين</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">كل عمليات النقل</span></span></li>
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{{route('distributor.storeTransfer.index')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل عمليات النقل</span></a></li>

                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{{route('distributor.stores.moveProduct')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">إنشاء عملية نقل جديدة</span></a></li>

                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{{route('distributor.stores.addProduct')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">انتاج</span></a></li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{{route('distributor.stores.damageProduct')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">اتلاف</span></a></li>

                    </ul>
                </div>
            </li>

            {{--************************************************************************--}}  {{--************************************************************************--}}
            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text"> المسارات</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">كل المسارات</span></span></li>
                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('distributor.routes.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل المسارات</span></a></li>

                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.trips.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">  رحلات المسارات </span></a></li>
                        {{--                            @endif--}}
                    </ul>
                </div>
            </li>
            {{--************************************************************************--}}
            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">إدارة العملاء</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">العملاء</span></span></li>
                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('distributor.clients.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل العملاء</span></a></li>

                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
{{--                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a--}}
{{--                                href="{!! route('distributor.clients.create') !!}" class="m-menu__link "><i--}}
{{--                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span--}}
{{--                                    class="m-menu__link-text">إضافة عميل </span></a></li>--}}

                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.clients.activation') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">العملاء  بانتظار التفعيل </span></a></li>
                        {{--                            @endif--}}
                    </ul>
                </div>
            </li>


              {{--************************************************************************--}}
            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text"> الحسابات والسجلات</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">كل المصروفات</span></span></li>

                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.bills.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text"> الفواتير</span></a></li>


                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('distributor.expenses.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text"> المصروفات</span></a></li>
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('distributor.bank-deposits.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text"> سجل الايداعات</span></a></li>

                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('distributor.transactions.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text"> سجل نقل الأموال (التحويلات المالية)</span></a></li>

                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{{route('distributor.dailyReports.index')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">سجل الملخصات اليومية</span></a></li>
                    </ul>
                </div>
            </li>


            {{--************************************************************************--}}


               {{--            ***********************************************************************************************************--}}
               <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
               aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                     class="m-menu__link m-menu__toggle"><span
                       class="m-menu__item-here"></span><i
                       class="m-menu__link-icon flaticon-user"></i><span
                       class="m-menu__link-text"> التقارير</span><i
                       class="m-menu__ver-arrow la la-angle-right"></i></a>
                   <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                       <ul class="m-menu__subnav">
                           <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                   class="m-menu__link"><span class="m-menu__item-here"></span><span
                                       class="m-menu__link-text">تقرير المبيعات</span></span></li>
                           {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                           <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                   href="{{route('distributor.reports.sales.index')}}" class="m-menu__link "><i
                                       class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                       class="m-menu__link-text">تقرير المبيعات</span></a></li>


                           <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                   href="{{route('distributor.reports.routes.index')}}" class="m-menu__link "><i
                                       class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                       class="m-menu__link-text">تقرير  تسليم المسارات </span></a></li>

                           <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                   href="{{route('distributor.reports.expenses.index')}}" class="m-menu__link "><i
                                       class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                       class="m-menu__link-text">تقرير المصروفات </span></a></li>

                           <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                   href="{{route('distributor.reports.store_movement.index')}}" class="m-menu__link "><i
                                       class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                       class="m-menu__link-text">تقرير حركه المخزون</span></a></li>
                           <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                   href="{{route('distributor.reports.distributor.index')}}" class="m-menu__link "><i
                                       class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                       class="m-menu__link-text">تقرير تحركات المندوبين</span></a></li>
                           <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                   href="{{route('distributor.reports.distributor_movements.index')}}" class="m-menu__link "><i
                                       class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                       class="m-menu__link-text">تقرير حركات المندوبين</span></a></li>

                           <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                   href="{{route('distributor.reports.selling_movement.index')}}" class="m-menu__link "><i
                                       class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                       class="m-menu__link-text">تقرير حركه البيع </span></a></li>
                       </ul>
                   </div>



           </li>

        </ul>
    </div>

    <!-- END: Aside Menu -->
</div>


<div class="modal fade" id="search_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ابحث عن مهمه</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label> ابحث عن مهمه</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary">بحث</button>
                </div>
            </form>
        </div>
    </div>
</div>
