<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{env('APP_NAME')}} | {{@$title}}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}media/images/favicon.png">
    <link href="{{asset('/')}}assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('/')}}assets/vendor/chartist/css/chartist.min.css">
    <link href="{{asset('/')}}assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/css/style.css" rel="stylesheet">
	<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">

</head>
<body>
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">
        @include('admin.layouts.includes.nav-header')
        @include('admin.layouts.includes.chatbox')
        @include('admin.layouts.includes.header')
        @include('admin.layouts.includes.dez-nav')
        <div class="content-body">
            @yield('content')
        </div>
    </div>

    <script src="{{asset('/')}}assets/vendor/global/global.min.js"></script>
	<script src="{{asset('/')}}assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="{{asset('/')}}assets/vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="{{asset('/')}}assets/js/custom.min.js"></script>
	<script src="{{asset('/')}}assets/js/deznav-init.js"></script>
    <script src="{{asset('/')}}assets/vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="{{asset('/')}}assets/vendor/jquery.counterup/jquery.counterup.min.js"></script>	
	<script src="{{asset('/')}}assets/vendor/apexchart/apexchart.js"></script>	
	<script src="{{asset('/')}}assets/vendor/peity/jquery.peity.min.js"></script>
	<script src="{{asset('/')}}assets/js/dashboard/dashboard-1.js"></script>
	
	
</body>
</html>