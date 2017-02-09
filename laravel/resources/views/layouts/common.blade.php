<html lang="en">
<link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.min.css') }}">
<script src="{{ URL::asset('/js/jquery-1.12.1.js') }}"></script>
<script src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
{{--<link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.min.css') }}">--}}
<link rel="stylesheet" href="{{ URL::asset('/css/font-awesome.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/css/home.css') }}">
{{--<link rel="stylesheet" href="{{ URL::asset('/css/application-a07755f5.css') }}">--}}
<head>
    <title>驴友</title>
</head>
<body class="activity">
<div class="container">
        @yield('content')
</div>
</body>
</html>