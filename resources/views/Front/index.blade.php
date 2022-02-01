@extends('Front.layouts.master')

@section('title', '')

@section('header')
    @include('Front.layouts.headmain')
@endsection

@section('styles')

    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -o-box-sizing: border-box;
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            list-style: none;
            /* font-family: "Gudea", sans-serif; */
            font-weight: normal;
        }

        body {
            background: #eee;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            font-size: 60px;
            color: #333;
        }

        h1 a {
            font-size: 14px;
            color: #aaa;
            background: #fff;
            border-radius: 5px;
            padding: 2px 5px;
            border: 1px solid #dcdcdc;
            text-decoration: none;
        }

        h1 a:hover {
            color: #0fe0ba;
            text-decoration: underline;
        }

        .slider {
            width: 100%;
            max-width: 750px;
            padding: 0 50px;
            margin: 25px auto 0;
            height: 350px;
            position: relative;
        }

        .slider ul,
        .slider ul li {
            width: 100%;
            height: 100%;
        }

        .slider ul {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
        }

        .slider ul li {
            position: absolute;
            top: 0;
            left: -100%;
            background-size: contain;
            /* semon #f98686 */
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
            /* font-family: serif; */
        }

        .slider ul li:first-of-type {
            background-image: url("site/assets/img/icon/visa.jpg");
        }

        .slider ul li:nth-of-type(2) {
            background-image: url("site/assets/img/icon/master.jpg");
        }

        .slider ul li:nth-of-type(3) {
            background-image: url("site/assets/img/icon/visa.jpg");
        }

        .slider ul li:nth-of-type(4) {
            background-image: url("site/assets/img/icon/master.jpg");
        }

        .slider ul li:last-of-type {
            background-image: url("site/assets/img/icon/visa.jpg");
        }

        .slider .controll {
            width: 40px;
            height: 40px;
            position: absolute;
            top: 44%;
            border-bottom: 3px solid #333;
            border-left: 3px solid #333;
            cursor: pointer;
            color: #333;
        }

        .slider .controll:first-of-type {
            transform: rotate(45deg);
            left: 20px;
        }

        .slider .controll:last-of-type {
            transform: rotate(225deg);
            right: 20px;
        }

        .slider .controll:hover,
        .slider .controll.active {
            border-color: #f98686;
            /* rose */
        }

        .slider ol {
            text-align: center;
            padding-top: 10px;
        }

        .slider ol li {
            display: inline-block;
            margin-right: 5px;
        }

        .slider ol .fa {
            font-size: 20px;
            color: #333;
            cursor: pointer;
            font-weight: normall;
        }

        .slider ol li:hover .fa:before,
        .slider ol li.active .fa:before {
            content: "\f111";
        }

        /* .slider ul li.active {
                        z-index: 999;
                        left: 0
                        } */
        @media (max-width: 490px) {
            h1 {
                font-size: 45px;
            }
        }

        @media (max-width: 350px) {
            h1 {
                font-size: 25px;
            }
        }
        
        
        
        /*..................................*/
        .box {
  position: relative;
  /*vertical-align: middle;*/
  color: #0e307e;
  display: inline-block;
  /*height: 60px;*/
  /*line-height: 60px;*/
  text-align: center;
  transition: 0.5s;
  /*padding: 0 20px;*/
  cursor: pointer;
  border: 2px solid #0e307e;
  -webkit-transition: 0.5s;
}

.box:hover {
  border: 2px solid rgba(0, 160, 80, 0);
  /*color: #fff;*/
}

.box::before,
.box::after {
  width: 100%;
  height: 100%;
  z-index: 3;
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  box-sizing: border-box;
  -webkit-transform: scale(0);
  transition: 0.5s;
}

.foo::before {
  border-bottom: 3px solid #efc700;
  border-left: 3px solid #efc700;
  -webkit-transform-origin: 0 100%;
}

.foo::after {
  border-top: 3px solid #efc700;
  border-right: 3px solid #efc700;
  -webkit-transform-origin: 100% 0%;
}

.box:hover::after,
.box:hover::before {
  -webkit-transform: scale(1);
}
/*....................................*/


a:hover, a:active {
    color: inherit;
    text-decoration: none;
    outline: 0;
}

    </style>

@endsection

@section('content')

 @livewire('inquiry')



    <div style="padding: 50px;" class="container">
        <div class="row justify-content-between">
            
            
            <section id="howWeWork">
            <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                <h2 style="color: black; margin-top: 50px; font-size: 30px">   
                {{ __('translate.HowWeWorks') }}
                </h2>
                <hr style="width:25%; color: #0e307e; background-color: #0e307e; border-width: 3px;">
            </div>
           
            
             <div class="col-md-4 col-lg-4 col-sm-12 text-center fadee1" >
                <img  style="height: 350px;" src="site/assets/img/icon/paycashb.png" alt="">
                <p style="color: black; margin-top: 20px; font-size: 20px"> {{ __('translate.PayAtTheNearestServiceProvider') }}</p>
                
                <p style="color: black; margin-top: 10px; font-size: 12px"> {{ __('translate.ServicePrice') }}</p>
            </div>
            
            
            <div class="col-md-4 col-lg-4 col-sm-12 text-center fadee2">
                <img style="height: 350px;" src="site/assets/img/icon/formb.png" alt="">
                <p style="color: black; margin-top: 20px; font-size: 20px">
                    {{ __('translate.FillInformation') }}
                    </p>
            </div>
            
             <div class="col-md-4 col-lg-4 col-sm-12 text-center fadee3">
                <img style="height: 350px;" src="site/assets/img/icon/smsb.png" alt="">
                <p style="color: black; margin-top: 20px; font-size: 20px">{{ __('translate.ReceiveAnSMSWithCompetingYourOrder') }}</p>
            </div>
           
            
               </section> 
            
            
            
            
            
            
            
            
             <section id="serviceProviders">
            <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                <h2 style="color: black; margin-top: 100px; font-size: 30px">{{ __('translate.ServiceProvider') }}</h2>
                <hr style="width:25%; color: #0e307e; background-color: #0e307e; border-width: 3px;">
            </div>
            
          {{-- <div class="col-md-3 col-lg-3 col-sm-12 justify-content-end" style="margin-top: 20px; margin-bottom: 20px;">
            {{ Form::select('nighborhood', ['' => 'اختر الحي', '1' => 'البديعة'], null, ['class'=>'form-control']) }} 
        </div> --}}
    
       
            <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                <div class="portlet-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="bg-primary">
                                <tr >
                                    <th class="text-center" >
                                    {{ __('translate.ServiceProviderName') }}
                                    </th>
                                    <th class="text-center" >
                                    {{ __('translate.ServiceProviderMobile') }}
                                    </th>
                                    
                                     <th class="text-center" >
                                    {{ __('translate.ServiceProviderNH') }}
                                    </th>
                                    
                                     <th class="text-center" >
                                    {{ __('translate.ServiceProviderLocation') }}
                                    </th>
                                </tr>
                            </thead> 
                            <tbody>
                                @foreach (\App\Models\ServiceProvider::all() as $serviceProvider)
                                    @if ($serviceProvider->status == 1)
                                        <tr>
                                            <td>
                                                {{ $serviceProvider->storeName--}}
                                                {{-- $serviceProvider->first_name }} {{ $serviceProvider->last_name --}}
                                                {{-- خدمات صيانة المحمدي --}}
                                            </td>
                                            <td>
                                                {{ $serviceProvider->phone }}
                                                {{-- الشميسي – شارع الإمام تركي --}}
                                            </td>
                                            
                                            <td>
                                                {{ $serviceProvider->nighborhood }}
                                            </td>
                                            
                                            <td>
                                                <a href='{{ $serviceProvider->locationURL }}' target="_blank" style="font-size: 20px;">
                                                  &#127757;  
                                                </a>
                                                
                                            </td>
                                            
                                            
                                            {{-- <td>
                                    <p><a href="https://goo.gl/maps/56gmcb2i71BXQDAW9" target="_blank"> خريطة </a></p>
                                </td> --}}
                                        </tr>
                                    @endif
                                @endforeach
                                {{-- <tr>
                                <td>
                                مكتبة شروق الشمس
                                </td>
                                <td>
                                البديعة – شارع سماحة الشيخ ابن باز
                                </td>
                                <td>
                                    <p><a href="https://goo.gl/maps/56gmcb2i71BXQDAW9">خريطة</a></p>
                                </td>
                            </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            </section>
            
            
            
            
            
            
            
            <section id="ourPartners">
                
            <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                <h2 style="color: black; margin-top: 100px; font-size: 30px">{{ __('translate.OurPartners') }}</h2>
                <hr style="width:25%; color: #0e307e; background-color: #0e307e; border-width: 3px;">
            </div>
            
            
            <div class="container d-flex justify-content-center col-md-12" style="overflow: auto;">
                
            @foreach (\App\Models\Store::all() as $store)
                @if ($store->status == 1)
                
                    <a href="{{ route('front.storepay', [app()->getLocale(),$store->id ]) }}" class="col-md-3 col-lg-3 col-sm-12 text-center  box foo" style="margin-top: 20px; margin-bottom: 20px; margin-left: 5px; margin-right: 5px; padding-right: 0px; padding-left: 0px;">
                        <div class="card " style="background-color: #fff">
                            <img class="card-img-top" src="{{ $store->logo }}" alt="">
                            <div class="card-body">
                                <h5 class="card-title" style="margin-top: 20px;"> {{ $store->store_name }} </h5>
                                {{-- <p class="card-text"> {{ $store->description }} </p>  --}}
                                <div class="btn btn-warning"
                                    style="margin: 20px;"> {{ __('translate.SubmitPaymentRequest') }} </div>
                            </div>
                        </div>
                    </a>
                    
                @endif
            @endforeach
            
            </div>
            
             </section>
            
            
            {{-- <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-top: 50px;">
            <!-- slider -->
            <div class="slider">
                <!-- slide -->
                <ul>
                    <li class="active"></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <ol>
                <!-- point -->
                <li class="active"><i class="fa fa-circle-o"></i></li>
                <li><i class="fa fa-circle-o"></i></li>
                <li><i class="fa fa-circle-o"></i></li>
                <li><i class="fa fa-circle-o"></i></li>
                <li><i class="fa fa-circle-o"></i></li>
                <!-- playpause -->
                <i class="fa playpause fa-pause-circle-o" title="pause"></i>   
                </ol>
                <!-- controll -->
                <span class="controll active"></span>
                <span class="controll"></span>
            </div>
        </div> --}}
        </div>
    </div>
@endsection
@section('scripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>

    <script>
        $(function() {
            "use strict";
            var body = $("body"),
                active = $(".slider ol li, .slider .controll"),
                controll = $(".slider .controll"),
                playpause = $(".playpause"),
                sliderTime = 1,
                sliderWait = 3000,
                i = 999,
                autoRun,
                stop = false;
            // Reset
            $(".slider ul li:first").css("left", 0);
            // Run Slider
            function runSlider(what) {
                what.addClass("active").siblings("li, span").removeClass("active");
            }
            // slider gsap
            function gsapSlider(whose, left) {
                i++;
                if (whose.hasClass("active")) {
                    TweenMax.fromTo(
                        ".slider ul li.active",
                        sliderTime, {
                            zIndex: i,
                            left: left
                        }, {
                            left: 0
                        }
                    );
                }
            }
            // Active
            active.on("click", function() {
                runSlider($(this));
            });
            // Arrow left
            controll.first().on("click", function() {
                var slide = $(".slider ul li.active, .slider ol li.active").is(
                        ":first-of-type"
                    ) ?
                    $(".slider ul li:last, .slider ol li:last") :
                    $(".slider ul li.active, .slider ol li.active").prev("li");
                runSlider(slide);
                gsapSlider(slide, "100%");
            });
            // Arrow right
            controll.last().on("click", function() {
                var slide = $(".slider ul li.active, .slider ol li.active").is(
                        ":last-of-type"
                    ) ?
                    $(".slider ul li:first, .slider ol li:first") :
                    $(".slider ul li.active, .slider ol li.active").next("li");
                runSlider(slide);
                gsapSlider(slide, "-100%");
            });
            // Point
            $(".slider ol li").on("click", function() {
                var start = $(".slider ul li.active").index();
                var slide = $(".slider ul li").eq($(this).index());
                runSlider(slide);
                var end = $(".slider ul li.active").index();
                if (start > end) {
                    gsapSlider(slide, "100%");
                }
                if (start < end) {
                    gsapSlider(slide, "-100%");
                }
            });
            // Auto run slider
            function autoRunSlider() {
                if (body.css("direction") === "ltr" && stop === false) {
                    autoRun = setInterval(function() {
                        controll.last().click();
                    }, sliderWait);
                } else if (body.css("direction") === "rtl" && stop === false) {
                    autoRun = setInterval(function() {
                        controll.first().click();
                    }, sliderWait);
                }
            }
            autoRunSlider();
            // When hover
            active.on("mouseenter", function() {
                if (stop === false) {
                    clearInterval(autoRun);
                }
            });
            active.on("mouseleave", function() {
                if (stop === false) {
                    autoRunSlider();
                }
            });
            // play pause click
            playpause.on("click", function() {

                $(this).toggleClass("fa-play-circle-o fa-pause-circle-o");

                if (playpause.hasClass("fa-play-circle-o")) {
                    stop = true;
                    clearInterval(autoRun);
                    $(this).attr("title", "play");
                }

                if (playpause.hasClass("fa-pause-circle-o")) {
                    stop = false;
                    autoRunSlider();
                    $(this).attr("title", "pause");
                }
            });
        });
    </script>
@endsection
