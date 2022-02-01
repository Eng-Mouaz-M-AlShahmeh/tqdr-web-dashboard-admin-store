<!-- header area start -->
<header class="header-area" style="
  background-image: url('site/assets/img/icon/hero.jpg'); 
  background-color: #0e307e;
  /* height: 100vh;  */
  background-position: center; 
  background-repeat: no-repeat; 
  background-size: cover; 
">
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
                
                <div class="row justify-content-between">
                    
                    
                      <div class="col-md-4 col-lg-4 col-sm-12">
 
 
 <form name="" action="{{ route('front.serviceproviderssearch', [app()->getLocale()] ) }}" method="post">
            
            
            @csrf <!-- {{ csrf_field() }} -->
            
<div class="input-group rounded">
  <input type="search" name="key" class="form-control rounded" placeholder="&#128270; {{ __('translate.SearchServiceProvider') }} " aria-label="SearchServiceProvider"
  aria-describedby="search-addon" />
</div>

<input type="submit" style="visibility: hidden;" />


</form>



<script type="text/javascript">
  $(function () {
    $("form").each(function () {
      $(this)
        .find("input")
        .keypress(function (e) {
          if (e.which == 10 || e.which == 13) {
            this.form.submit();
          }
        });
      $(this).find("input[type=submit]").hide();
    });
  });
</script>



        
         </div>    
         
         
                    
                <div class="col-md-4 col-lg-4 col-sm-12">
                        
               
               
               <a href="#howWeWork" style="color: white; font-size: 10px; cursor: pointer; padding: 5px;">
                   {{ __('translate.HowWeWorks') }}
               </a>
               
               
               <a href="#serviceProviders" style="color: white; font-size: 10px; cursor: pointer; padding: 5px;">
                   {{ __('translate.ServiceProvider') }}
               </a>
               
               
               <a href="#ourPartners" style="color: white; font-size: 10px; cursor: pointer; padding: 5px;">
                   {{ __('translate.OurPartners') }}
               </a>
               
               
               
               
               
               
               
               
                
                </div>
                 
                 
                 
                 <div class="col-md-4 col-lg-4 col-sm-12">
                        
                <a data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#exampleModal" style="color: white; font-size: 15px; cursor: pointer;" class="p-5 btn btn-warning">{{ __('translate.InquireAboutBalance') }}</a>
                
                 </div>
                 
                 
                 
                 
                    
                
                 </div>
                
            </div>
            
        
        
        



            {{-- <div class="col-md-3 col-lg-3 col-sm-12">
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12">
                </div> --}}
            {{-- <div class="col-md-4 col-lg-4 col-sm-12" style="margin-top: 50px;">
                </div> --}}
            {{-- <div class="col-md-4 col-lg-4 col-sm-12" style="margin-top: 50px;">
                </div> --}}
            <div class="col-md-12 col-lg-12 col-sm-12">
                <div class="row justify-content-between">
                    <div class="col-md-3 col-lg-3 col-sm-12" style="margin-top: 50px;">
                   
                    </div>
                    <div class="col-md-9 col-lg-9 col-sm-12" style="margin-top: 50px;">
                        <a href="{{ route('front.index', app()->getLocale() ) }}"><img style="height: 70px; "
                                src="{{ asset('site/assets/img/icon/logo1.png') }}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12">
                <h2 class="text-center" style="color: white; margin-top: 50px; font-size: 20px">{{ __('translate.WelcomeMsg') }}</h2>
            </div>
           
            
             @livewire('invoices')
             
        </div>
    </div>
</header>
<!-- header area end -->