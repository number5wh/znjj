<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="stylesheet" href="{{url('css/app.css')}}"/>
    <title>@yield('title')</title>
</head>
<body>
    <div id="header">
        <div id="h_l">@yield('hl')</div>
        <div id="h_c">@yield('hc')</div>
        <div id="h_r">@yield('hr')</div>
    </div>

    <div id="main">@yield('main')</div>
    <div id="footer">
        <div class="f_button"><a href="{{url('/user/home')}}" style="display: block">联系人</a></div>
        <div class="f_button"><a href="{{url('/equipment/home')}}" style="display: block">设备</a></div>
        <div class="f_button"><a href="{{url('/quick/home')}}" style="display: block">便捷操作</a></div>
        <div class="f_button">个人中心</div>
    </div>
    <script src="{{url('js/jquery-1.7.2.min.js')}}"></script>
    <script src="{{url('js/all.js')}}"></script>
</body>
</html>