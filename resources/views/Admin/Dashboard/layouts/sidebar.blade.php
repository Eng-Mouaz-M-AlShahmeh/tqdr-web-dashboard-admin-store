<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <a href="{{ route('admin.dashboard.index',app()->getLocale()) }}" style="color:white; margin-top:15px;">
            <img id="myDIV" src="{{ asset('assets/dashboard/layouts/layout/img/logow1.png') }}" alt="logo"
                style="height: 60px;margin-right: 40px; margin-top: 15px;" class=" img-fluid" />
        </a>
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <li class="nav-item start {{ request()->is(app()->getLocale().'/admin') ? 'active' : null }}">
                <a href="{{ route('admin.dashboard.index',app()->getLocale()) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">لوحة التحكم</span>
                </a>
            </li>
            <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/customer') ? 'active' : null }}">
                <a href="{{ route('admin.customer.index',app()->getLocale()) }}" class="nav-link nav-toggle">
                    <i class="icon-user-following"></i>
                    <span class="title">العملاء</span>
                </a>
            </li>
            <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/serviceprovider') ? 'active' : null }}">
                <a href="{{ route('admin.serviceprovider.index',app()->getLocale()) }}" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">مزودي الخدمات</span>
                </a>
            </li>
            <li
                class="nav-item  {{ request()->is(app()->getLocale().'/admin/store') || request()->is(app()->getLocale().'/admin/store/bank') || request()->is(app()->getLocale().'/admin/store/sociallinks') || request()->is(app()->getLocale().'/admin/store/cr') || request()->is(app()->getLocale().'/admin/store/national') || request()->is(app()->getLocale().'/admin/store/address') || request()->is(app()->getLocale().'/admin/store/address/country') || request()->is(app()->getLocale().'/admin/store/address/city') || request()->is(app()->getLocale().'/admin/store/address/nighborhood') ? 'active' : null }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-store"></i> <i class="icon-bag"></i>
                    <span class="title">الشركاء (المتاجر)</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/store') ? 'active' : null }}">
                        <a href="{{ route('admin.store.index',app()->getLocale()) }}" class="nav-link ">
                            <i class="icon-list"></i>
                            <span class="title">قائمة الشركاء (المتاجر)</span>
                        </a>
                    </li>
                    <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/store/bank') ? 'active' : null }}">
                        <a href="{{ route('admin.bank.index',app()->getLocale()) }}" class="nav-link">
                            <i class="icon-credit-card"></i>
                            <span class="title">البنوك</span>
                        </a>
                    </li>
                    <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/store/sociallinks') ? 'active' : null }}">
                        <a href="{{ route('admin.sociallinks.index',app()->getLocale()) }}" class="nav-link">
                            <i class="icon-social-twitter"></i>
                            <span class="title">وسائل التواصل الاجتماعي</span>
                        </a>
                    </li>
                    <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/store/cr') ? 'active' : null }}">
                        <a href="{{ route('admin.cr.index',app()->getLocale()) }}" class="nav-link">
                            <i class="icon-envelope-letter"></i>
                            <span class="title">السجلات التجارية</span>
                        </a>
                    </li>
                    <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/store/national') ? 'active' : null }}">
                        <a href="{{ route('admin.national.index',app()->getLocale()) }}" class="nav-link ">
                            <i class="icon-wallet"></i>
                            <span class="title">الوثائق الشخصية</span>
                        </a>
                    </li>
                    <li
                        class="nav-item  {{ request()->is(app()->getLocale().'/admin/store/address') || request()->is(app()->getLocale().'/admin/store/address/country') || request()->is(app()->getLocale().'/admin/store/address/city') || request()->is(app()->getLocale().'/admin/store/address/nighborhood') ? 'active' : null }}">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="fa fa-store"></i> <i class="icon-map"></i>
                            <span class="title">العناوين</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/store/address') ? 'active' : null }}">
                                <a href="{{ route('admin.address.index',app()->getLocale()) }}" class="nav-link">
                                    <i class="icon-list"></i>
                                    <span class="title">قائمة العناوين</span>
                                </a>
                            </li>
                            <li
                                class="nav-item  {{ request()->is(app()->getLocale().'/admin/store/address/country') ? 'active' : null }}">
                                <a href="{{ route('admin.country.index',app()->getLocale()) }}" class="nav-link">
                                    <i class="icon-globe"></i>
                                    <span class="title">البلدان</span>
                                </a>
                            </li>
                            <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/store/address/city') ? 'active' : null }}">
                                <a href="{{ route('admin.city.index',app()->getLocale()) }}" class="nav-link">
                                    <i class="icon-globe"></i>
                                    <span class="title">المدن</span>
                                </a>
                            </li>
                            <li
                                class="nav-item  {{ request()->is(app()->getLocale().'/admin/store/address/nighborhood') ? 'active' : null }}">
                                <a href="{{ route('admin.nighborhood.index',app()->getLocale()) }}" class="nav-link">
                                    <i class="icon-globe"></i>
                                    <span class="title">الاحياء</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li
                class="nav-item  {{ request()->is(app()->getLocale().'/admin/invoice') || request()->is(app()->getLocale().'/admin/invoiceorderlink') || request()->is(app()->getLocale().'/admin/invoiceorder') ? 'active' : null }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-store"></i> <i class="icon-docs"></i>
                    <span class="title">الايصالات</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/invoice') ? 'active' : null }}">
                        <a href="{{ route('admin.invoice.index',app()->getLocale()) }}" class="nav-link ">
                            <i class="icon-list"></i>
                            <span class="title">قائمة الايصالات</span>
                        </a>
                    </li>

                    <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/invoiceorder') ? 'active' : null }}">
                        <a href="{{ route('admin.invoiceorder.index',app()->getLocale()) }}" class="nav-link ">
                            <i class="icon-puzzle"></i>
                            <span class="title">طلبات الايصالات</span>
                        </a>
                    </li>
                    
                    <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/invoiceorderlink') ? 'active' : null }}">
                        <a href="{{ route('admin.invoiceorderlink.index',app()->getLocale()) }}" class="nav-link ">
                            <i class="icon-link"></i>
                            <span class="title">إدارة فواتير الشركاء (المتاجر)</span>
                        </a>
                    </li>
                    
                    
                </ul>
            </li>

            {{-- <li class="nav-item  {{ request()->is('notification') ? 'active': null }}">
                <a href="#" class="nav-link nav-toggle">
                    <i class="icon-bell"></i>
                    <span class="title">التنبيهات</span>
                </a>
            </li> --}}

            <li class="nav-item  {{ request()->is(app()->getLocale().'/admin/1/setting/edit') ? 'active' : null }}">
                <a href="{{ route('admin.setting.edit', [app()->getLocale(),1]) }}" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">الاعدادات</span>
                </a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
