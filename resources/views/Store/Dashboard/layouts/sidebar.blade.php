<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">
        <a href="{{ route('store.dashboard.index', [app()->getLocale()]) }}" style="color:white; margin-top:15px;">
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
            <li class="nav-item start {{ request()->is(app()->getLocale().'/store') ? 'active' : null }}">
                <a href="{{ route('store.dashboard.index', [app()->getLocale()]) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">لوحة التحكم</span>
                </a>
            </li>
            {{-- <li class="nav-item  {{ request()->is('invoice') ? 'active' : null }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-store"></i> <i class="icon-docs"></i>
                    <span class="title">الايصالات</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  {{ request()->is('invoice') ? 'active' : null }}">
                        <a href="#" class="nav-link ">
                            <i class="icon-list"></i>
                            <span class="title">قائمة الايصالات</span>
                        </a>
                    </li>
                    <li class="nav-item  {{ request()->is('invoiceorder') ? 'active' : null }}">
                        <a href="#" class="nav-link nav-toggle">
                            <i class="icon-puzzle"></i>
                            <span class="title">طلبات الايصالات</span>

                        </a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item  {{ request()->is(app()->getLocale().'/store/invoiceorder') ? 'active' : null }}">
                <a href="{{ route('store.invoiceorder.index', [app()->getLocale()]) }}" class="nav-link nav-toggle">
                    <i class="icon-puzzle"></i>
                    <span class="title">طلبات الدفع</span>
                </a>
            </li>
            
             <li class="nav-item  {{ request()->is(app()->getLocale().'/store/invoiceorderlink') ? 'active' : null }}">
                <a href="{{ route('store.invoiceorderlink.index', [app()->getLocale()]) }}" class="nav-link nav-toggle">
                    <i class="icon-link"></i>
                    <span class="title">إدارة فواتير الشركاء (المتاجر)</span>
                </a>
            </li>
            
            {{-- <li class="nav-item  {{ request()->is('setting') ? 'active' : null }}">
                <a href="#" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">الاعدادات</span>
                </a>
            </li> --}}
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
