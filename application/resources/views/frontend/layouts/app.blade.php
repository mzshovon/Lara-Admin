<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="telephone=no" name="format-detection">
    <meta content="yes" name="apple-mobile-web-app-capable">

    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="{{asset('/')}}assets/img/logo1.jpg" rel="icon">
    <meta content="Nghia Minh Luong" name="author">
    <meta content="Default Description" name="keywords">
    <meta content="Default keyword" name="description">
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <title>{{env('APP_NAME')}} | {{@$pageTitle}}</title>
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900"
          rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/ps-icon/style.css" rel="stylesheet">
    <!-- CSS Library-->
    <link href="{{asset('/')}}assets/frontend/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/slick/slick/slick.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/Magnific-Popup/dist/magnific-popup.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/revolution/css/settings.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/revolution/css/layers.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/plugins/revolution/css/navigation.css" rel="stylesheet">
    <!-- Custom-->
    <link href="{{asset('/')}}assets/frontend/css/style.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/frontend/range/range.css" rel="stylesheet">
{{--    <script src="{{asset('/')}}assets/sweet-alert/sweetalert.min.js" type="text/javascript"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

    <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
</head>
<body class="ps-loading">
@include('frontend.layouts.includes.header')
<main class="ps-main">
    @yield('content')
    @include('frontend.layouts.includes.footer')
</main>
<!-- JS Library-->
<script src="{{asset('/')}}assets/frontend/plugins/jquery/dist/jquery.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/jquery-bar-rating/dist/jquery.barrating.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/gmap3.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/imagesloaded.pkgd.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/jquery.matchHeight-min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/slick/slick/slick.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/elevatezoom/jquery.elevatezoom.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"
        type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/extensions/revolution.extension.video.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"
        type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/extensions/revolution.extension.navigation.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/extensions/revolution.extension.parallax.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/extensions/revolution.extension.actions.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/extensions/revolution.extension.migration.min.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js" type="text/javascript"></script>
<!-- Custom scripts-->
<script src="{{asset('/')}}assets/frontend/js/main.js" type="text/javascript"></script>
<script src="{{asset('/')}}assets/frontend/js/cart.js" type="text/javascript"></script>
@yield('scripts')
</body>
</html>
