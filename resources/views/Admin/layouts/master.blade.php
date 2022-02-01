<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>تقدر - تسجيل دخول المشرفين</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/dashboard/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/dashboard/global/plugins/simple-line-icons/simple-line-icons.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/dashboard/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/dashboard/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('assets/dashboard/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/dashboard/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('assets/dashboard/global/css/components.min.css') }}" rel="stylesheet" id="style_components"
        type="text/css" />
    <link href="{{ asset('assets/dashboard/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('assets/dashboard/pages/css/login.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{ asset('site/assets/img/icon/favicon3.ico') }}" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

</head>
<!-- END HEAD -->

<body class="login" 
@if(Config::get('app.locale') == 'en')
style="direction: ltr !important;"
@else
style="direction: rtl !important;"
@endif
>
    <!-- BEGIN LOGO -->
    <div class="logo">
        <a href="{{ route('front.index', app()->getLocale() ) }}">
            <img height="150" src="{{ asset('assets/dashboard/pages/img/logo1.png') }}" alt="" /> </a>
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        @yield('content')
    </div>
    <div class="copyright"> تقدر © 2021 - جميع الحقوق محفوظة </div>
    <!--[if lt IE 9]>
<script src="{{ asset('assets/dashboard/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/global/plugins/excanvas.min.js') }}"></script>
<![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('assets/dashboard/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/dashboard/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('assets/dashboard/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/dashboard/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/dashboard/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/dashboard/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"
        type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('assets/dashboard/global/plugins/jquery-validation/js/jquery.validate.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/dashboard/global/plugins/jquery-validation/js/additional-methods.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('assets/dashboard/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript">
    </script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('assets/dashboard/global/scripts/app.min.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('assets/dashboard/pages/scripts/login.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <!-- END THEME LAYOUT SCRIPTS -->
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! \Brian2694\Toastr\Facades\Toastr::message() !!}
    {!! Toastr::message() !!}
</body>

</html>
