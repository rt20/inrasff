<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-penta.png') }}">
    {{-- <link rel="shortcut icon" href="{{ asset('images/logo-penta.png') }}"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backadmin/theme/images/ico/favicon.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8" name="title" content="{{ config('app.name') }}">
    <meta charset="utf-8" name="description" content="{{ config('app.name') }}">
    <meta charset="utf-8" name="keywords" content="inrasff, INRASFF, insraff, INSRAFF, inrasff pom go id, pom inrasff, bpom inrasff, bpom insraff">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- Coba -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>

    </style>
    @section('style')

    @show
</head>
<body class="bg-white h-screen antialiased leading-none font-sans">
    
    @include('front.layouts.preload')
    @include('front.layouts.header')

    @yield('body')
    
    @include('front.layouts.footer')
     
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <!-- Coba -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" defer></script>
    <script>
        $(function() {
            adjustHeader();
            // $('#overlayer').delay(1000).fadeOut("slow");
        });

        window.addEventListener('scroll', 
            function(){
                adjustHeader();
            }
        );

        function adjustHeader(){
            var showEl = true;
            if(window.pageYOffset>50)
                showEl = false;

            document.getElementById('header-wrapper').__x.$data.showTopHeader = showEl;
        }
    </script>
    @section('script')

    @show
</body>
</html>
