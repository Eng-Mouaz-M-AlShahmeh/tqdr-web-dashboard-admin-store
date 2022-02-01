    <!-- footer area start -->
    <footer>
        <div class="footer-area bg-theme ptb--50">
            <div class="container">
                <div class="footer-inner">
                    <div class="row justify-content-between">
                        
                        
                        
                         <div class="col-md-4 col-lg-4 col-sm-12">
                            <!-- <div class="row justify-content-start">
                                 <div class="col-md-12 col-lg-12 col-sm-12"> -->
                         
                            {{-- <p style="color: white; margin-top: 40px;">من السبت للخميس من 9ص إلى 5م</p>
                                    <p style="color: white;">الجمعة من 1م إلى 5م</p> --}}
                                    
                                    
                                    
                            <p style="color: white; margin-top: 40px;">
                                {{ __('translate.AvailableSoonOnStores') }}
                            </p>
                            
                            <div class="row justify-content-between">
                                
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <a href="#"><img style="height: 40px;"
                                    src="{{ asset('site/assets/img/icon/google-play.png') }}" alt=""></a>
                                </div>
                                
                                
                                <div class="col-md-6 col-lg-6 col-sm-12">
                                    <a href="#"><img style="height: 40px;"
                                    src="{{ asset('site/assets/img/icon/apple-store.png') }}" alt=""></a>
                                </div>
                                
                            </div>
                            
                            
                            
                            
            <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-top: 5px;">
                <a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_facebook }}" target="_blank"><img class="rotateimage" style="height: 60px; padding: 10px; margin: 10px;" src="{{ asset('site/assets/img/social/facebook.png') }}" alt=""></a>
                <a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_twitter }}" target="_blank"><img class="rotateimage" style="height: 60px; padding: 10px; margin: 10px;" src="{{ asset('site/assets/img/social/twitter.png') }}" alt=""></a>
                <a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_tiktok }}" target="_blank"><img class="rotateimage" style="height: 60px; padding: 10px; margin: 10px;" src="{{ asset('site/assets/img/social/tiktok.png') }}" alt=""></a>
                <a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_instagram }}" target="_blank"><img class="rotateimage" style="height: 60px; padding: 10px; margin: 10px;" src="{{ asset('site/assets/img/social/instagram.png') }}" alt=""></a>
                <a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_youtube }}" target="_blank"><img class="rotateimage" style="height: 60px; padding: 10px; margin: 10px;" src="{{ asset('site/assets/img/social/youtube.png') }}" alt=""></a>
                <a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_snapchat }}" target="_blank"><img class="rotateimage" style="height: 60px; padding: 10px; margin: 10px;" src="{{ asset('site/assets/img/social/snapchat.png') }}" alt=""></a>
            </div> 
            
            
            
            
                        {{--    <ul class="fsocial" style="margin-top: 40px;">
                                <li style="margin: 10px;"><a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_facebook }}"
                                        target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li style="margin: 10px;"><a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_twitter }}"
                                        target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li style="margin: 10px;"><a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_google_plus }}"
                                        target="_blank"><i class="fa fa-google"></i></a></li>
                                <li style="margin: 10px;"><a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_instagram }}"
                                        target="_blank"><i class="fa fa-instagram"></i></a></li>
                                        
                                         <li style="margin: 10px;"><a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_youtube }}"
                                        target="_blank"><i class="fa fa-youtube"></i></a></li>
                                        
                                         <li style="margin: 10px;"><a href="{{ \App\Models\Setting::where('id', 1)->first()->admin_snapchat }}"
                                        target="_blank"><i class="fa fa-snapchat"></i></a></li>
                            </ul>  --}}
                            
                            
                            
                            <!-- </div>
                            </div> -->
                        </div>
                        
                        
                        
                        
                        <div class="col-md-4 col-lg-4 col-sm-12">
{{--                            <h2 style="color: white; margin-top: 20px;">{{ __('translate.AboutTqdr') }}</h2>  
--}}
            
                            <ul style="margin-top: 40px;">
                                <li><a href="{{ route('front.about' , app()->getLocale() ) }}">
                                        <p style="color: white;">{{ __('translate.About') }}</p>
                                    </a></li>
                                <li><a href="{{ route('front.contact', app()->getLocale() ) }}">
                                        <p style="color: white;">{{ __('translate.ContactUs') }}</p>
                                    </a></li>
                                <li><a href="{{ route('front.join', app()->getLocale() ) }}">
                                        <p style="color: white;">{{ __('translate.JoinUs') }}</p>
                                    </a></li>
                                    
                                <li><a href="{{ route('front.jobs', app()->getLocale() ) }}">
                                        <p style="color: white;">{{ __('translate.Jobs') }}</p>
                                    </a></li>
                                    
                                <li><a href="{{ route('front.terms', app()->getLocale() ) }}">
                                        <p style="color: white;">{{ __('translate.TermsAndConditions') }}</p>
                                    </a></li>
                                <li><a href="{{ route('front.privacy', app()->getLocale() ) }}">
                                        <p style="color: white;">{{ __('translate.PrivacyAndPolicy') }}</p>
                                    </a></li>
                                    
                                 <li><a href="{{ route('front.faqs', app()->getLocale() ) }}">
                                        <p style="color: white;">{{ __('translate.FAQs') }}</p>
                                    </a></li>
                                    
                                
                            </ul>
                        </div>
                        
                        
                        
                        <div class="col-md-4 col-lg-4 col-sm-12">
                            <a href="{{ route('front.index', app()->getLocale() ) }}"><img style="height: 150px;"
                                    src="{{ asset('site/assets/img/icon/logo1.png') }}" alt=""></a>
                                    
                            <p style="color: white; margin-top: 20px; font-size: 18px;">
                                {{ __('translate.FootMsg') }}
                            </p>
                        </div>
                        
                        
                        
                       
                    </div>
                    <br>
                    <div style="
                border-style: solid;
                border-width: 1px 0 0;
                border-color: #d1d1d1;
                transition: background .3s,border .3s,border-radius .3s,box-shadow .3s;
                " class="row justify-content-between m-5">
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            
                          
                            <a href="https://maroof.sa/119492" target="_blank"><img
                                    style="height: 50px; margin-top: 15px;"
                                    src="{{ asset('site/assets/img/icon/marof.png') }}" alt=""></a>
                         
                                    
                            
                                    
                                    
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-12">
                            <pre style="margin-top: 15px; color: white; class="copy-right">{{ \App\Models\Setting::where('id', 1)->first()->admin_copyright }} &copy; <script>document.write(new Date().getFullYear());</script> </pre>
                        </div>
                        
                    </div>
                    
                    
                     <div class="row justify-content-end m-5">
                        <div class="col-md-12 col-lg-12 col-sm-12 text-left">  
                        
                       
                        
                           <a href="https://alraedaah.com" target="_blank"><img
                                    style="height: 110px;"
                                    src="{{ asset('site/assets/img/icon/raidaarb-3.png') }}" alt=""></a>
                                    
                      
                                    
                                    
                              </div>
                          </div>
                          
                          
                </div>
            </div>
        </div>
    </footer>
    <!-- footer area end -->
