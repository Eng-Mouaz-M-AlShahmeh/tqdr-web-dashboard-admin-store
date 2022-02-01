<!-- header area start -->
<header class="header-area" style="background: #0e307e">
    <div style="padding: 30px;" class="container">
        <div class="row justify-content-between">
            <div class="col-md-3 col-lg-3 col-sm-12">
                <span class="text-center"><a style="color: white; margin-top: 15px; font-size: 10px"
                        href="{{ route('front.admin.login', app()->getLocale() ) }}">{{ __('translate.Login') }}</a></span>
                        
                           
                             @if (Config::get('app.locale') == 'en')
                        <span style="margin-left: 10px; margin-right: 10px;">
                            <a style="color: white; margin-top: 15px; font-size: 10px" href="{{ route(Route::currentRouteName(), 'ar') }}">
                                <img style="height: 30px; "
                                src="{{ asset('site/assets/img/icon/ar.png') }}" alt="">
                                </a>
                        </span>
                        @else
                        <span style="margin-left: 10px; margin-right: 10px;">
                            <a style="color: white; margin-top: 15px; font-size: 10px" href="{{ route(Route::currentRouteName(), 'en') }}">
                                 <img style="height: 30px; "
                                src="{{ asset('site/assets/img/icon/en.png') }}" alt="">
                                </a>
                        </span> 
                        @endif
                        
                        
                {{-- <span class="text-center"><a style="color: white; margin-top: 15px; font-size: 10px" href="{{route('front.store.login')}}">دخول الشركاء (المتاجر)</a></span> --}}
            </div>
            
            <div class="col-md-9 col-lg-9 col-sm-12">
                        <a href="{{ route('front.index', app()->getLocale() ) }}"><img style="height: 100px;"
                                src="{{ asset('site/assets/img/icon/logo1.png') }}" alt=""></a>
            </div>
                    
            {{--
            <div class="col-md-9 col-lg-9 col-sm-12">
                 <a data-toggle="modal" data-target="#exampleModal" style="color: white; font-size: 20px">استعلام عن رصيد</a>
                
            </div>
            --}}
            {{-- <div class="col-md-3 col-lg-3 col-sm-12" style="margin-top: 20px;">
                        <a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_facebook }}" target="_blank"><i style="font-size: 20px; margin: 10px; color: white;" class="fa fa-facebook"></i></a>
                        <a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_twitter }}" target="_blank"><i style="font-size: 20px; margin: 10px; color: white;" class="fa fa-twitter"></i></a>
                        <a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_google_plus }}" target="_blank"><i style="font-size: 20px; margin: 10px; color: white;" class="fa fa-google"></i></a>
                </div> --}}
            {{-- <div class="col-md-4 col-lg-4 col-sm-12" style="margin-top: 20px;"> </div> --}}
            <div class="col-md-12 col-lg-12 col-sm-12" style="margin-top: 20px;">
                <div class="row justify-content-between">
                    <div class="col-md-3 col-lg-3 col-sm-12">
                        {{-- <h2 style="color: white; margin-top: 20px;">{{ __('translate.ContactUs') }}</h2>
                        <p style="margin-top: 20px;"><a style="color: white; font-size: 20px;"
                                href="tel:{{ str_replace('966', '05', \App\Models\Setting::where('id', 1)->first()->admin_phone) }}">{{ str_replace('966', '05', \App\Models\Setting::where('id', 1)->first()->admin_phone) }}</a>
                        </p> 
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-12">
                        <a href="{{ route('front.index', app()->getLocale() ) }}"><img style="height: 100px;"
                                src="{{ asset('site/assets/img/icon/logo1.png') }}" alt=""></a>
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->
