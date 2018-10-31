<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <meta name="author" content="Mosaddek"> --}}

    <meta property="og:title" content="{{ $title or 'GIviK' }}" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="{{ $image or 'https://givik.ru/assets/img/posts/photo_7830_20081101.jpg' }}" />
    <meta property="og:description" content="{!! $desc or 'GiViK IT:SYS:WEB:PRO v.1.0' !!}" />
    <meta property="og:url" content="{{ url()->current() }}" />

    <!--favicon icon-->
    <link rel="icon" href="{{ asset('assets') }}/img/favicon.ico">

    <title>{{ $title or 'GIviK' }}</title>

    <!--common style-->
    {{-- <link href='http://fonts.googleapis.com/css?family=Abel|Source+Sans+Pro:400,300,300italic,400italic,600,600italic,700,700italic,900,900italic,200italic,200' rel='stylesheet' type='text/css'> --}}

    
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
    
    <!-- inject:css -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/elasic-slider/elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/iconmoon/linea-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/owl-carousel/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shortcodes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/default-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/highlight/styles/ocean.css') }}">

    {{-- laravel-like-comment --}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/icon.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/comment.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/form.min.css" rel="stylesheet">
    {{-- <link href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.2/components/button.min.css" rel="stylesheet"> --}}
    <link href="{{ asset('/vendor/laravelLikeComment/css/style.css') }}" rel="stylesheet"> 
    
    <!-- endinject -->
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/vendor/backward/html5shiv.js"></script>
    <script src="assets/vendor/backward/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!--  preloader start -->
    <div id="tb-preloader">
        <div class="tb-preloader-wave"></div>
    </div>
    <!-- preloader end -->
   
    <div class="wrapper">

        <!--top bar-->
        @yield('topbar')
        <!--top bar-->

        <!--header start-->
        @yield('header')
        <!--header end-->
        
        <!--body content start-->
        {!! NoCaptcha::renderJs() !!}
        @yield('content')
        <!--body content end-->
   
        <!--footer start 1-->
        @yield('footer')
        <!--footer 1 end-->
    </div>
       
    <!-- inject:js -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/vendor/modernizr/modernizr.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-validator/validator.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/breakpoint/breakpoint.js') }}"></script>
    <script src="{{ asset('assets/vendor/count-to/jquery.countTo.js') }}"></script>
    <script src="{{ asset('assets/vendor/countdown/jquery.countdown.js') }}"></script>
    <script src="{{ asset('assets/vendor/easing/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/vendor/easy-pie-chart/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/elasic-slider/jquery.eislideshow.js') }}"></script>
    <script src="{{ asset('assets/vendor/flex-slider/jquery.flexslider-min.js') }}"></script>
    <!--<script src="{{ asset('assets/vendor/gmap/jquery.gmap.min.js') }}"></script>-->
    <script src="{{ asset('assets/vendor/images-loaded/imagesloaded.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope/jquery.isotope.js') }}"></script>
    <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/mailchimp/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/menuzord/menuzord.js') }}"></script>
    <script src="{{ asset('assets/vendor/nav/jquery.nav.js') }}"></script>
    <script src="{{ asset('assets/vendor/owl-carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/parallax-js/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/smooth/smooth.js') }}"></script>
    <script src="{{ asset('assets/vendor/sticky/jquery.sticky.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/touchspin/touchspin.js') }}"></script>
    <script src="{{ asset('assets/vendor/typist/typist.js') }}"></script>
    <script src="{{ asset('assets/vendor/visible/visible.js') }}"></script>
    <script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/goup/jquery.goup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/vendor/highlight/highlightjs-copy-button.js') }}"></script>

    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    

    <!-- laravel-like-comment -->
    <script src="{{ asset('/vendor/laravelLikeComment/js/script.js') }}" type="text/javascript"></script>

    <!-- endinject -->

<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>

</body>
 <!--script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script-->
<!-- production-версия, оптимизированная для размера и скорости-->
<!--<script src="https://cdn.jsdelivr.net/npm/vue"></script>-->
<!-- script src="https://unpkg.com/@saeris/vue-spinners"></script-->

</html>