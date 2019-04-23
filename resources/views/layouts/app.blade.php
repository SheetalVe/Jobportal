<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Noogah</title>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
	<!-- css files -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{ asset('css/app.css') }}" type="text/css" media="all" />
	<!-- Style-CSS -->
	<link rel="stylesheet" href="{{ asset('css/fontawesome-all.css') }}">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom  -->
    <link href="{{ asset('css/clean-blog.min.css') }}" rel="stylesheet">

	<!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->
	<!-- fonts -->
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script src="{{ asset('js/app.js') }}"></script>
<link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom -->
    <link href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Custom  -->
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

        <style>
        @font-face {
            font-family: 'typografixregular';
            src: url('fonts/typografix-demo-webfont.woff2') format('woff2'), url('fonts/typografix-demo-webfont.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }
    </style>
</head>
<body class="landing">
 <nav id="mainNavbar" class="navbar navbar-inverse affix">
    <div class="container" style="display: block;">
         <div class="row" style="display: block;">
          
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
             
         </div>
     </div>
</nav>











 <section class="mt128" style="background: rgba(14, 29, 76,0.8);height:100%;">
     @yield('content') 
      
 </section> 

        <!-- JavaScript --> 
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

 <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{ asset('js/clean-blog.min.js') }}"></script>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
    
</html>   