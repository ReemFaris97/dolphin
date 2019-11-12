<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
         m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
        <ul class="m-menu__nav ">
            {{--************************************************************************--}}
            @if(auth()->user()->hasPermissionTo('view_emp_chat'))
                <li class="m-menu__item " aria-haspopup="true"><a href="{!! route('admin.private') !!}"
                                                                  class="m-menu__link "><span
                            class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-email"></i><span
                            class="m-menu__link-text">البريد</span></a></li>
                <!--			testpush-->

            @endif
            {{--************************************************************************--}}  {{--************************************************************************--}}
            <li class="m-menu__item " aria-haspopup="true"><a href="{!! route('admin.home') !!}"
                                                              class="m-menu__link "><span
                        class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-home-1"></i><span
                        class="m-menu__link-text">الرئيسية</span></a></li>

            {{--************************************************************************--}}
            @if(auth()->user()->hasPermissionTo('view_workers')||auth()->user()->hasPermissionTo('add_workers'))
                <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                    aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                          class="m-menu__link m-menu__toggle"><span
                            class="m-menu__item-here"></span><i
                            class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">الاعضاء</span><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>


                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">

                            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                    class="m-menu__link"><span class="m-menu__item-here"></span><span
                                        class="m-menu__link-text">الاعضاء</span></span></li>
                            @if(auth()->user()->hasPermissionTo('view_workers'))
                                <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                        href="{!! route('admin.users.index') !!}" class="m-menu__link "><i
                                            class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                            class="m-menu__link-text">كل الاعضاء</span></a></li>

                            @endif
                            @if(auth()->user()->hasPermissionTo('add_workers'))
                                <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                        href="{!! route('admin.users.create') !!}" class="m-menu__link "><i
                                            class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                            class="m-menu__link-text">اضافه </span></a></li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif


            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-layers"></i><span class="m-menu__link-text">العهد</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">العهد</span></span></li>
                        @if(auth()->user()->hasPermissionTo('view_charges'))
                            <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                    href="{!! route('admin.charges.index') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">  كل العهد</span></a></li>



                            <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                    href="{!! route('admin.charges.destruct.index') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">  التوالف</span></a></li>
                        @endif
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('admin.charges.user') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">العهد المسندة الى</span></a></li>
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('admin.charges.supervisor') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">العهد التى قمت بإسنادها</span></a></li>

                        @if(auth()->user()->hasPermissionTo('add_charges'))
                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                    href="{!! route('admin.charges.create') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">إضافة عهده</span></a></li>
                        @endif
                    </ul>
                </div>
            </li>

            {{----------------------------------------------------------------------------}}

            {{----------------------------------------------------------------------------}}

            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-list"></i><span class="m-menu__link-text">المهمات</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">المهمات</span></span></li>

                        @if(auth()->user()->hasPermissionTo('view_tasks'))
                            <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                    href="{!! route('admin.tasks.index') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">كل المهمات</span></a></li>
                            <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                    href="{!! route('admin.tasks.unfinished') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">
                                        مهام غير منفذه </span></a></li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('add_tasks'))
                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                    href="{!! route('admin.tasks.user.creator') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">المهام المضافه</span></a></li>
                        @endif
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('admin.tasks.user.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text"> المهمات المسندة الى </span></a></li>
                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('admin.task-user.present') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">مهمات تحت العمل</span></a></li>


                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('admin.task.finished.today') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">

                                المهام المنتهيه اليوم
                                </span></a></li>


                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('admin.task-user.ratable') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text"> مهمات تحتاح للتقيم </span></a></li>

                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{{route('admin.tasks.get.replace')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">استبدال مهام موظف</span></a></li>


                        @if(auth()->user()->hasPermissionTo('add_tasks'))
                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                    href="{!! route('admin.tasks.create') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">إضافة مهمه</span></a></li>
                        @endif

                    </ul>
                </div>
            </li>

            {{----------------------------------------------------------------------------}}

            {{----------------------------------------------------------------------------}}

            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-list-1"></i><span class="m-menu__link-text">البنود</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">البنود</span></span></li>

                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('admin.clauses.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل البنود</span></a></li>

                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('admin.clauses.user.index') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text"> البنود المسندة الى </span></a></li>

                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{{route('admin.clauses.change.numbers')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">إدخال الأرقام</span></a></li>

                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                href="{!! route('admin.clauses.create') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">إضافة بند جديد</span></a></li>

                    </ul>
                </div>
            </li>


            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-list-1"></i><span
                        class="m-menu__link-text">اشعارات الاداره</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">اشعارات الاداره</span></span></li>

                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{{route('admin.my.notifications')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل الإشعارات</span></a></li>
                        @can('view_emp_notifications')

                            <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                    href="{!! route('admin.admin-notifications.index') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">إشعاراتي</span></a></li>
                        @endcan
                        @can('send_emp_notifications')

                            <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                    href="{!! route('admin.admin-notifications.create') !!}" class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">ارسال اشعار </span></a></li>
                        @endcan
                    </ul>
                </div>
            </li>

            {{----------------------------------------------------------------------------}}

            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-file-2"></i><span class="m-menu__link-text">التقارير</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">التقارير</span></span></li>

                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{!! route('admin.workerSearchForm') !!}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">تقارير عضو</span></a></li>

{{--                        <li class="m-menu__item  --}}{{--m-menu__item--active--}}{{--" aria-haspopup="true">--}}
{{--                            <a class="m-menu__link" data-toggle="modal" data-target="#search_modal"><i--}}
{{--                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span>--}}

{{--                                    </span>--}}
{{--                                </i><span--}}
{{--                                    class="m-menu__link-text">البحث عن مهمه</span></a></li>--}}


                    </ul>
                </div>
            </li>

            {{----------------------------------------------------------------------------------}}


            {{----------------------------------------------------------------------------}}

            <li class="m-menu__item  m-menu__item--submenu {{Request::is('/admin/suppliers-discards')?'m-menu__item--open m-menu__item--expanded':''}} "
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-file-2"></i><span class="m-menu__link-text">مرتجعات الموردين</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">كل المرتجعات</span></span></li>

                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{{route('admin.suppliers-discards.index')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل المرتجعات</span></a></li>

                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                href="{{route('admin.suppliers-discards.create')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">إنشاء مرتجع جديد</span></a></li>


                    </ul>
                </div>
            </li>

            {{----------------------------------------------------------------------------------}}


            {{----------------------------------------------------------------------------}}

            <li class="m-menu__item  m-menu__item--submenu {{Request::is('/admin/suppliers-bills')?'m-menu__item--open m-menu__item--expanded':''}}  "
                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:;"
                                                                      class="m-menu__link m-menu__toggle"><span
                        class="m-menu__item-here"></span><i
                        class="m-menu__link-icon flaticon-file-2"></i><span class="m-menu__link-text">فواتير الموردين</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                    class="m-menu__link-text">كل الفواتير</span></span></li>

                        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a
                                href="{{route('admin.suppliers-bills.index')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">كل الفواتير</span></a></li>

                        <li class="m-menu__item  m-menu__item--active" aria-haspopup="true"><a
                                href="{{route('admin.suppliers-bills.create')}}" class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">إضافة فاتورة جديدة</span></a></li>

                    </ul>
                </div>
            </li>

            {{----------------------------------------------------------------------------------}}

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
            <form action="{!! route('admin.TaskSearch') !!}">
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
