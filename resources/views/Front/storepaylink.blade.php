@extends('Front.layouts.master')

@section('title', 'الدفع عبر الرابط')

@section('header')
    @include('Front.layouts.head')
@endsection

@section('content')





 <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header d-flex justify-content-between">
                         
                              <h5 class="modal-title" id="exampleModalLabel">استعلام عن رصيد</h5>
                              
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                         
                        
                      </div>
                      <div class="modal-body" style="margin-top: 15px; margin-bottom: 15px;">
                        
                        
                         {{ Form::open(['route' => ['front.balanceInquiry', app()->getLocale()  ], 'method' => 'post', 'files' => true]) }}
            @csrf
            <div class="col-md-6 col-lg-6 col-sm-12 pull-right">
                <h2 style="color: black; font-size: 15px;">رقم الإيصال</h2>
                    
                       </div>
                       
                    <div class="col-md-6 col-lg-6 col-sm-12 pull-right">
                {{ Form::text('invoiceId', '', ['placeholder' => '000 0000', 'class' => 'form-control']) }}
            </div>
            
            <br/>  <br/>  
            
            
          
            

            
                      </div>
                      
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>

                        

               {{ Form::submit('استعلام', ['class' => 'p-5 btn btn-warning']) }}
        
                        
                        
                          
             @if (Session::has('amount'))
                <div style="margin-top: 10px; margin-bottom: 10px;" class="col-md-12 col-lg-12 col-sm-12">
                    <div class="alert alert-info" role="alert">
                        {{ Session::get('amount') }}
                    </div>
                </div>
            @else
            @endif
                        
                        
                          {{ Form::close() }}
                          
                      </div>
                      
                      
                    </div>
                  </div>
                </div>







    {{-- <div class="col-md-12 col-lg-12 col-sm-12 container" style="margin-top: 20px; margin-bottom: 20px;"> --}}
    {{--  <img class="" style="width: 100%; height: 400px; object-fit: cover;"
        src="{{ $store->getCoverAttribute($store->cover_image) }}" alt="">   --}}
    {{-- </div> --}}
    <div style="margin-top: 50px; margin-bottom: 50px;" class="container">
        <div style="background: #f5f5f5; padding: 25px;" class="container">
            <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-top: 5px;">
                <img class="" style="width: 200px; height: 200px; object-fit: cover;"
                    src="{{ $store->logo }}" alt="">
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-top: 5px;">
                <a href="{!! $store->web_url !!}" target="_blank"
                    style="color: black; margin-top: 5px; margin-bottom: 5px; font-size: 40px">
                    <h1 class="text-center">{{ $store->store_name }}</h1>
                </a>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-top: 5px;">
                <h2 class="text-center" style="color: black; margin-top: 5px; margin-bottom: 5px; font-size: 20px">
                    {{ $store->description }}</h2>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-top: 5px;">
                <a href="tel:{{ str_replace('966', '05', $store->phone) }}">
                    <h2 style="color: green; margin-top: 5px; margin-bottom: 5px; font-size: 20px" class="text-center">
                        {{ str_replace('966', '05', $store->phone) }}</h2>
                </a>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-top: 5px;">
                <a href="mailto:{{ $store->email }}">
                    <h2 style="color: grey; margin-top: 5px; margin-bottom: 5px; font-size: 20px" class="text-center">
                        {{ $store->email }}</h2>
                </a>
            </div>
             <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-top: 5px;">
                <a href="{!! $store->socialLinks->facebook !!}" target="_blank"><i style="font-size: 20px; margin: 5px; color: #0e307e;"
                        class="fa fa-facebook"></i></a>
                <a href="{!! $store->socialLinks->twitter !!}" target="_blank"><i style="font-size: 20px; margin: 5px; color: #0e307e;"
                        class="fa fa-twitter"></i></a>
                <a href="{!! $store->socialLinks->instagram !!}" target="_blank"><i style="font-size: 20px; margin: 5px; color: #0e307e;"
                        class="fa fa-instagram"></i></a>
                <a href="{!! $store->socialLinks->linkedin !!}" target="_blank"><i style="font-size: 20px; margin: 5px; color: #0e307e;"
                        class="fa fa-linkedin"></i></a>
                <a href="{!! $store->socialLinks->youtube !!}" target="_blank"><i style="font-size: 20px; margin: 5px; color: #0e307e;"
                        class="fa fa-youtube"></i></a>
            </div> 
        </div>
    </div>
    
    
    
    
    
    
    {{--  <div style="margin-top: 50px; margin-bottom: 50px;" class="container">
        <div style="background: #f5f5f5; padding: 25px;" class="container">
            {{ Form::open(['route' => ['front.pay', app()->getLocale()  ], 'method' => 'post', 'files' => true]) }}
            @csrf
            <div class="col-md-4 col-lg-4 col-sm-12">
                <h2 class="text-center" style="color: black; margin-top: 100px; margin-bottom: 20px; font-size: 15px">{{ __('translate.MobileNumber') }}</h2>
                {{ Form::text('phone',  $customer_phone , ['placeholder' => '05xxxxxxxx', 'class' => 'form-control', 'readonly' => 'true']) }}
            </div>
            {{ Form::hidden('store', $store->id) }}
            <div class="col-md-4 col-lg-4 col-sm-12">
                <h2 class="text-center" style="color: black; margin-top: 100px; margin-bottom: 20px; font-size: 15px">
                     {{ __('translate.Amount') }}</h2>
                {{ Form::text('amount', $amount, ['placeholder' =>  __('translate.enterValue'), 'class' => 'form-control', 'readonly' => 'true']) }}
            </div>
            <div class="col-md-4 col-lg-4 col-sm-12">
                <h2 class="text-center" style="color: black; margin-top: 100px; margin-bottom: 20px; font-size: 15px">{{ __('translate.OrderNumber') }}</h2>
                {{ Form::text('order_number', '', ['placeholder' => '000-0000', 'class' => 'form-control']) }}
            </div>
            <div style="margin-top: 100px; margin-bottom: 50px;" class="col-md-12 col-lg-12 col-sm-12">
                <div class="text-center">{{ Form::submit(__('translate.Send'), ['class' => 'p-5 btn btn-warning']) }}</div>
            </div>
            @if (Session::has('errorpay'))
                <div style="margin-top: 10px; margin-bottom: 10px;" class="col-md-12 col-lg-12 col-sm-12">
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('errorpay') }}
                    </div>
                </div>
            @else
            @endif
            {{ Form::close() }}
        </div>
    </div>  --}}
    
    
    
    <div style="margin-top: 50px; margin-bottom: 50px;" class="container">
        <div style="background: #f5f5f5; padding: 25px;" class="container">
            
         @livewire('storeinvoicelink', ['phone' => $customer_phone, 'store' => $store->id, 'amount' => $amount])
    
       </div>
    </div>  
    
    
    
    
@endsection
