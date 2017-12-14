<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>
        @yield('title')
    </title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/magnific-popup.css') }}">
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="{{asset('js/vue.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <style rel="stylesheet">
        .form-control
        {
            display: block;
            width: 100%;
            height: 40px;
            padding: 9px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555555;
            background-color: #ffffff;
            background-image: none;
            z-index: 1;
            border: 1px solid #dddddd;
            border-radius: unset;
            margin: 10px 0;
        }
    </style>
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
</body>
</html>