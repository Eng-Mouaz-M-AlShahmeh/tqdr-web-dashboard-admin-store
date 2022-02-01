@extends('Store.Dashboard.layouts.master')

@section('title', 'تفاصيل رابط طلب الدفع')

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
                    <a href="{{ route('store.invoiceorderlink.index',[app()->getLocale()]) }}">روابط طلبات الدفع</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>تفاصيل رابط طلب الدفع</span>
                </li>
            </ul>

        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">تفاصيل رابط طلب الدفع
        </h1>

        <div class="row">
            <div class="col-md-12">
                <!-- Begin: life time stats -->
                <div class="portlet light portlet-fit portlet-datatable bordered">
                    <div class="portlet-title">
                        <div class="caption pull-right">
                            <h5> المعلومات الرئيسية </h5>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                         <th> اسم العميل </th>
                                        <th> رقم جوال العميل </th>
                                        <th> مبلغ الدفع </th>
                                        <th> الرابط </th>
                                        <th> تاريخ الإنشاء </th>
                                        <th> تاريخ التعديل </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> {!! $record->customer_name !!} </td>
                                        <td> {!! $record->customer_phone !!} </td>
                                        <td> {!! $record->amount !!} ريال </td>
                                        <td> {!! $record->link !!} </td>
                                        <td> {{ $record->created_at }} </td>
                                        <td> {{ $record->updated_at }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <!-- End: life time stats -->
            </div>
            
            
            
            <div class="col-md-6 text-center">
                <a href="https://api.whatsapp.com/send?phone={!! $record->customer_phone !!}&text=رابط الدفع   {!! $record->link !!}  " target="_blank"><i style="color: green; font-size: 80px; margin-top: 20px;" class="fa fa-whatsapp my-float"></i></a>
            </div>
            
                
           
           
           
            <form id="form_sample_1" class="form-horizontal" action="{{ route('store.invoiceorderlink.sendlinksms',[app()->getLocale()]) }}" method="post" enctype="multipart/form-data">
                @csrf
                  
                  
     
                    
                  @php
                  
                  $message = 'فاتورة من ' . \App\Models\Store::where('id', Auth::id())->first()->store_name  . ' ' .$record->link  
                  
                  @endphp
                    
        
                
                
                <input type="hidden"  name="phone" value="{{ $record->customer_phone }}" data-required="1" class="form-control" />
                                            
                <input type="hidden"  name="msg" value="{{ $message }}" data-required="1" class="form-control" />
                                            
                <div class="col-md-6 text-center">
                    <button type="submit" style="border: none; background-color: #fff;">
                        <i style="color: blue; font-size: 80px; margin-top: 20px;" class="fa fa-envelope"></i>
                    </button>
                </div>
            
            </form>
            
            
            
            
        </div>

    </div>
@endsection
