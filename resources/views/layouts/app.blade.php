<!DOCTYPE html>
<html lang="en">
<head>
   <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>News HTML-5 Template </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
            <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')  }}">
            <link rel="stylesheet" href="{{asset('css/ticker-style.css')  }}">
            <link rel="stylesheet" href="{{asset('css/flaticon.css')}}">
            <link rel="stylesheet" href="{{ asset('css/slicknav.css')}}">
            <link rel="stylesheet" href="{{asset('css/animate.min.css') }}">
            <link rel="stylesheet" href="{{asset('css/magnific-popup.css') }}">
            <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css') }}">
            <link rel="stylesheet" href="{{asset('css/themify-icons.css')  }}">
            <link rel="stylesheet" href="{{asset('css/slick.css') }}">
            <link rel="stylesheet" href="{{asset('css/nice-select.css') }}">
            <link rel="stylesheet" href="{{asset('css/style.css') }}">
   </head>
</head>
<body>
    

@include('partials.header')



@yield('content')


@include('partials.footer')


	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="{{asset('./assets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="{{ asset('./assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
        <script src="{{ asset('./assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('./assets/js/bootstrap.min.js') }}"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="{{ asset('./assets/js/jquery.slicknav.min.js') }}"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{ asset('./assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('./assets/js/slick.min.js') }}"></script>
        <!-- Date Picker -->
        <script src="{{ asset('./assets/js/gijgo.min.js') }}"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="{{ asset('./assets/js/wow.min.js') }}"></script>
		<script src="{{ asset('./assets/js/animated.headline.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.magnific-popup.js') }}"></script>

        <!-- Breaking New Pluging -->
        <script src="{{ asset('./assets/js/jquery.ticker.js') }}"></script>
        <script src="{{ asset('./assets/js/site.js') }}"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="{{ asset('./assets/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.nice-select.min.js') }}"></script>
		<script src="{{ asset('./assets/js/jquery.sticky.js') }}"></script>
        
        <!-- contact js -->
        <script src="{{ asset('./assets/js/contact.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.form.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('/assets/js/mail-script.js') }}"></script>
        <script src="{{ asset('./assets/js/jquery.ajaxchimp.min.js') }}"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="{{ asset('./assets/js/plugins.js') }}"></script>
        <script src="{{ asset('./assets/js/main.js') }}"></script>



</body>
</html>