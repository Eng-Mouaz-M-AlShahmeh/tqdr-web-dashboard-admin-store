@extends('Admin.Dashboard.layouts.master')

@section('title', 'تعديل الإيصال')

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
                    <a href="{{ route('admin.invoice.index',[app()->getLocale()]) }}">الإيصالات</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>تعديل الإيصال</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">نموذج تعديل الإيصال
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
                        <form id="form_sample_1" class="form-horizontal"
                            action="{{ route('admin.invoice.update',[app()->getLocale(),$recordtoedit->id]) }}" method="post"
                            enctype="multipart/form-data">
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
                                        <input type="number" value="{{ $recordtoedit->amount }}" name="amount"
                                            data-required="1" class="form-control" />
                                    </div>
                                    <label class="control-label col-md-3">
                                        المبلغ
                                        <span class="required"> * (يتم خصم 5 ريال سعر خدمة تقدر من المبلغ)</span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="number" value="{{ $recordtoedit->remaining_amount }}"
                                            name="remaining_amount" data-required="1" class="form-control" />
                                    </div>
                                    <label class="control-label col-md-3">
                                        المبلغ المتبقي
                                        <span class="required"> * </span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="is_paid" id="is_paid">
                                            <option {{ $recordtoedit->is_paid == 1 ? 'selected' : '' }} value="1">تم الدفع
                                            </option>
                                            <option {{ $recordtoedit->is_paid == 0 ? 'selected' : '' }} value="0">لم يتم
                                                الدفع</option>
                                        </select>
                                    </div>
                                    <label class="control-label col-md-3">
                                        حالة الدفع
                                        <span class="required"> * </span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="service_provider_id" id="service_provider_id">
                                            @foreach ($serviceProviders as $serviceProvider)
                                                <option
                                                    {{ $serviceProvider->id == $recordtoedit->service_provider_id ? 'selected' : '' }}
                                                    value="{{ $serviceProvider->id }}">{{ $serviceProvider->first_name }}
                                                    {{ $serviceProvider->last_name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <label class="control-label col-md-3">
                                        مزود الخدمة
                                        <span class="required"> * </span>
                                    </label>
                                </div>

                                <div class="form-actions text-center">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">تعديل</button>
                                            <a href="{{ route('admin.invoice.index',[app()->getLocale()]) }}" type="button"
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
