@extends('Store.Dashboard.layouts.master')

@section('title', 'إنشاء رابط طلب دفع')

@section('content')
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb pull-right">
                <li>
                    <a href="{{ route('store.dashboard.index',[app()->getLocale()]) }}">الرئيسية</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <a href="{{ route('store.invoiceorderlink.index',[app()->getLocale()]) }}"> روابط طلبات الدفع</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>إضافة رابط طلب دفع</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">نموذج إضافة رابط طلب دفع
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
                        <form id="form_sample_1" class="form-horizontal" action="{{ route('store.invoiceorderlink.store',[app()->getLocale()]) }}"
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
                                
                                
                                
                               {{-- value="{{ Auth::user()->username }}" --}}
                                
                                  <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="text"  name="customer_name"
                                            data-required="1" class="form-control" />
                                    </div>
                                    <label class="control-label col-md-3">
                                        اسم العميل
                                        <!--<span class="required"> * </span>-->
                                    </label>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="text"  name="customer_phone"
                                            data-required="1" class="form-control" />
                                    </div>
                                    <label class="control-label col-md-3">
                                        رقم جوال العميل
                                        <span class="required"> * </span>
                                    </label>
                                </div>
                                
                                
                                 <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <input type="text"  name="amount"
                                            data-required="1" class="form-control" />
                                    </div>
                                    <label class="control-label col-md-3">
                                        مبلغ الدفع
                                        <span class="required"> * </span>
                                    </label>
                                </div>
                                
                                

                              {{--  <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="customer_phone" id="customer_phone">
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->phone }}">{{ $customer->phone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="control-label col-md-3">
                                        رقم جوال العميل
                                        <span class="required"> * </span>
                                    </label>
                                </div>  --}}

                               {{-- <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="invoice_id" id="invoice_id">
                                            @foreach ($invoices as $invoice)
                                                <option value="{{ $invoice->id }}">{{ $invoice->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="control-label col-md-3">
                                        رقم الإيصال
                                        <span class="required"> * </span>
                                    </label>
                                </div>  --}}

                                {{-- <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="store_id" id="store_id">
                                            @foreach ($stores as $store)
                                                <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="control-label col-md-3">
                                        المتجر
                                        <span class="required"> * </span>
                                    </label>
                                </div>  --}}

                                <div class="form-actions text-center">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">تأكيد</button>
                                            <a href="{{ route('store.invoiceorderlink.index',[app()->getLocale()]) }}" type="button"
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