@extends('Admin.Dashboard.layouts.master')

@section('title', 'تعديل رابط طلب الدفع')

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
                    <a href="{{ route('admin.invoiceorderlink.index',[app()->getLocale()]) }}">روابط طلبات الدفع</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>تعديل رابط طلب الدفع</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">نموذج تعديل رابط طلب الدفع
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
                            action="{{ route('admin.invoiceorderlink.update',[app()->getLocale(),$recordtoedit->id]) }}" method="post"
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
                                        <input type="text" value="{{ $recordtoedit->customer_name }}"  name="customer_name"
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
                                        <input type="text" value="{{ $recordtoedit->customer_phone }}"  name="customer_phone"
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
                                        <input type="text" value="{{ $recordtoedit->amount }}"  name="amount"
                                            data-required="1" class="form-control" />
                                    </div>
                                    <label class="control-label col-md-3">
                                        مبلغ الدفع
                                        <span class="required"> * </span>
                                    </label>
                                </div>
                                
                                

                             {{--   <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="customer_phone" id="customer_phone">
                                            @foreach ($customers as $customer)
                                                <option
                                                    {{ $customer->phone == $recordtoedit->customer_phone ? 'selected' : '' }}
                                                    value="{{ $customer->phone }}">{{ $customer->phone }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="control-label col-md-3">
                                        رقم جوال العميل
                                        <span class="required"> * </span>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="invoice_id" id="invoice_id">
                                            @foreach ($invoices as $invoice)
                                                <option {{ $invoice->id == $recordtoedit->invoice_id ? 'selected' : '' }}
                                                    value="{{ $invoice->id }}">{{ $invoice->id }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="control-label col-md-3">
                                        رقم الإيصال
                                        <span class="required"> * </span>
                                    </label>
                                </div>    --}}

                                <div class="form-group">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <select class="form-control" name="store_id" id="store_id">
                                            @foreach ($stores as $store)
                                                <option {{ $store->id == $recordtoedit->store_id ? 'selected' : '' }}
                                                    value="{{ $store->id }}">{{ $store->store_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="control-label col-md-3">
                                        المتجر
                                        <span class="required"> * </span>
                                    </label>
                                </div> 

                                <div class="form-actions text-center">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">تعديل</button>
                                            <a href="{{ route('admin.invoiceorderlink.index',[app()->getLocale()]) }}" type="button"
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
