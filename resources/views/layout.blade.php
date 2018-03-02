<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>
        @yield('title')
    </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet" >
    <link rel="icon" href="{{ asset('images/forever.jpg') }}" type="image/x-icon"/>
    <link href="{{ asset('css/customize.css') }}" rel="stylesheet" >
    @yield('css')
</head>
<body>
    <div class="header">
        @include('header')
    </div>

    <div class="container" style="padding: 50px 0;">
        @yield('content')
    </div>

    <div class="footer">
        @include('footer')
    </div>
    <script  src="{{ asset('js/jquery.min.js') }}"></script>
    <script  src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script  src="{{ asset('js/jquery-ui.js') }}"></script>
    <script  src="{{ asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script  src="{{ asset('js/views/layout.js') }}"></script>

    @yield('js')
</body>
</html>