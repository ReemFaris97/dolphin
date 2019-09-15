<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
         m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
        <ul class="m-menu__nav ">
            {{--************************************************************************--}}

            <li class="m-menu__item " aria-haspopup="true"><a href="{!! route('supplier.home') !!}"
                                                              class="m-menu__link "><span
                        class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-home-1"></i><span
                        class="m-menu__link-text">الرئيسية</span></a></li>

            {{--************************************************************************--}}
                <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                    aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="m-menu__link m-menu__toggle"><span
                            class="m-menu__item-here"></span><i
                            class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">إدارة الموردين</span><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>


                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">

                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__item-here"></span><span
                                        class="m-menu__link-text">الموردين</span></span></li>
{{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                            <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                        href="{!! route('supplier.suppliers.index') !!}" class="m-menu__link "><i
                                            class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                            class="m-menu__link-text">كل الموردين </span></a></li>


                            {{--                            @endif--}}
{{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                                <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                        href="{!! route('supplier.suppliers.create') !!}" class="m-menu__link "><i
                                            class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                            class="m-menu__link-text">اضافه  مورد </span></a></li>
{{--                            @endif--}}
                        </ul>
                    </div>
                </li>


            {{--************************************************************************--}}
            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                            class="m-menu__item-here"></span><i
                            class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">إدارة عروض المنتجات</span><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__item-here"></span><span
                                        class="m-menu__link-text">عروض المنتجات</span></span></li>
                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                    href="{!! route('supplier.offers.index') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">كل العروض </span></a></li>


                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                    href="{!! route('supplier.offers.create') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">اضافه  عرض جديد </span></a></li>
                        {{--                            @endif--}}
                    </ul>
                </div>
            </li>




            {{--************************************************************************--}}
            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                            class="m-menu__item-here"></span><i
                            class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">إدارة البنوك</span><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__item-here"></span><span
                                        class="m-menu__link-text">البنوك  </span></span></li>
                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                    href="{!! route('supplier.banks.index') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">كل البنوك </span></a></li>


                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                    href="{!! route('supplier.banks.create') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">اضافه  بنك جديد </span></a></li>
                        {{--                            @endif--}}
                    </ul>
                </div>
            </li>

            {{--************************************************************************--}}
            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                            class="m-menu__item-here"></span><i
                            class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">إدارة الموظفين التابعين </span><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__item-here"></span><span
                                        class="m-menu__link-text">الموظفين التابعين  </span></span></li>
                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                    href="{!! route('supplier.employes.index') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">كل الموظفين </span></a></li>


                        {{--                            @endif--}}
                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                    href="{!! route('supplier.employes.create') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">اضافه  موظف  جديد </span></a></li>
                        {{--                            @endif--}}
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
