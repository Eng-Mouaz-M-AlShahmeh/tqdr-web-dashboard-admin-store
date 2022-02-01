@extends('Admin.Dashboard.layouts.master')

@section('title', 'إنشاء مزود خدمة')

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb pull-right">
                <li>
                    <a href="{{ route('admin.dashboard.index',[app()->getLocale()]) }}">الرئيسية</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('admin.serviceprovider.index',[app()->getLocale()]) }}">مزودي الخدمة</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>إضافة مزود خدمة</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">نموذج إضافة مزود الخدمة
        </h1>
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-title">
                        <div class="caption pull-right">
                            <i class="icon-settings font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">المعلومات الأساسية</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <!-- BEGIN FORM-->
                        <form id="form_sample_1" class="form-horizontal" action="{{ route('admin.serviceprovider.store',[app()->getLocale()]) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="alert alert-danger display-hide">
                                    <button class="close" data-close="alert"></button> You have some form errors.
                                    Please check below.
                                </div>
                                <div class="alert alert-success display-hide">
                                    <button class="close" data-close="alert"></button> Your form validation is
                                    successful!
                                </div>
                                <div class="form-group">

                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input type="text" name="username" data-required="1" class="form-control" />
                                    </div>

                                    <label class="control-label col-md-3">
                                        اسم المستخدم <span class="required"> * </span>
                                    </label>

                                </div>
                                <div class="form-group">

                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input type="password" name="password" data-required="1" class="form-control" />
                                    </div>

                                    <label class="control-label col-md-3">كلمة المرور
                                        <span class="required"> * </span>
                                    </label>

                                </div>
                                <div class="form-group">

                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input type="text" name="first_name" data-required="1" class="form-control" />
                                    </div>

                                    <label class="control-label col-md-3">الاسم الأول
                                        {{-- <span class="required"> * </span> --}}
                                    </label>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input type="text" name="last_name" data-required="1" class="form-control" />
                                    </div>

                                    <label class="control-label col-md-3">الاسم الأخير
                                        {{-- <span class="required"> * </span> --}}
                                    </label>
                                </div>
                                
                                 <div class="form-group">
                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input type="text" name="storeName" data-required="1" class="form-control" />
                                    </div>

                                    <label class="control-label col-md-3">اسم المحل
                                        {{-- <span class="required"> * </span> --}}
                                    </label>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input type="text" name="nighborhood" data-required="1" class="form-control" />
                                    </div>

                                    <label class="control-label col-md-3">الحي
                                        {{-- <span class="required"> * </span> --}}
                                    </label>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input type="text" name="locationURL" data-required="1" class="form-control" />
                                    </div>

                                    <label class="control-label col-md-3">الموقع على الخريطة
                                        {{-- <span class="required"> * </span> --}}
                                    </label>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input name="email" type="email" class="form-control" name="email" />
                                    </div>

                                    <label class="control-label col-md-3">الايميل
                                        <span class="required"> * </span>
                                    </label>

                                </div>

                                <div class="form-group">

                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input type="number" name="phone" data-required="1" class="form-control" />
                                    </div>

                                    <label class="control-label col-md-3">رقم الجوال
                                        <span class="required"> * </span>
                                    </label>

                                </div>
                                <div class="form-group">

                                    <div class="col-md-4"></div>

                                    <div class="col-md-4">
                                        <input type="number" name="tqdr_service_price" value="5.0" data-required="1"
                                            class="form-control" />
                                    </div>

                                    <label class="control-label col-md-3">سعر خدمة تقدر
                                        {{-- <span class="required"> * </span> --}}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="number" name="tqdr_service_vat_percentage" value="15.0"
                                            data-required="1" class="form-control" />
                                    </div>
                                    <label class="control-label col-md-3">نسبة الضريبة المضافة على خدمة تقدر
                                        {{-- <span class="required"> * </span> --}}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="number" name="profit_percentage" data-required="1"
                                            class="form-control" />
                                    </div>
                                    <label class="control-label col-md-3">نسبة ربح مزود الخدمة
                                        {{-- <span class="required"> * </span> --}}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="number" name="profit_fixed_amount" data-required="1"
                                            class="form-control" />
                                    </div>
                                    <label class="control-label col-md-3">مبلغ الربح الثابت لمزود الخدمة
                                        {{-- <span class="required"> * </span> --}}
                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="file" accept="image/*" name="avatar" id="exampleInputFile1">
                                    </div>
                                    <label class="control-label col-md-3">رفع صورة
                                    </label>
                                </div>
                                <div class="form-actions text-center">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">حفظ</button>
                                            <a href="{{ route('admin.serviceprovider.index',[app()->getLocale()]) }}" type="button"
                                                class="btn grey-salsa btn-outline">إلغاء</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>

    </div>
@endsection
