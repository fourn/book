<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Language" content="zh-CN">
    <title>@yield('title', '淘书屋')</title>
    {{--<meta name="keywords" content="">--}}
    {{--<meta name="description" content="">--}}
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 可隐藏地址栏，仅针对IOS的Safari（注：IOS7.0版本以后，safari上已看不到效果） -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <!-- 仅针对IOS的Safari顶端状态条的样式（可选default/black/black-translucent ） -->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="App-Config" content="fullscreen=yes,useHistoryState=yes,transition=yes">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <!-- IOS中禁用将数字识别为电话号码/忽略Android平台中对邮箱地址的识别 -->
    <meta name="format-detection"content="telephone=no, email=no" />
    <!-- 启用360浏览器的极速模式(webkit) -->
    <meta name="renderer" content="webkit">
    <!-- 避免IE使用兼容模式 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 针对手持设备优化，主要是针对一些老的不识别viewport的浏览器，比如黑莓 -->
    <meta name="HandheldFriendly" content="true">
    <!-- 微软的老式浏览器 -->
    <meta name="MobileOptimized" content="320">
    <!-- uc强制竖屏 -->
    <meta name="screen-orientation" content="portrait">
    <!-- QQ强制竖屏 -->
    <meta name="x5-orientation" content="portrait">
    <!-- UC强制全屏 -->
    <meta name="full-screen" content="yes">
    <!-- QQ强制全屏 -->
    <!-- UC应用模式 -->
    <meta name="browsermode" content="application">
    <!-- QQ应用模式 -->
    <meta name="x5-page-mode" content="app">
    <!-- windows phone 点击无高光 -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/common.css') }}" rel="stylesheet" type="text/css" />
    @yield('css')
</head>
<body class="@yield('body', 'whitebg')">

    @yield('content')

    <script src="{{ asset('js/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('layer/layer.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(function (){
            $('button.close').click(function (){
                $(this).parents('section').remove();
            });
        });
    </script>
@yield('script')
</body>
</html>
