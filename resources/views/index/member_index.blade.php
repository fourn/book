@extends('layouts.app')

@section('content')
<div class="membertop">
    <section>
        <i style="background-image: url({{ $user->avatar }})" onclick="location.href='{{ route('user.index') }}'"></i>
        <p class="p1">{{ $user->name }}</p>
        <p class="p2">学校：浙江师范大学</p>
        <p class="p3">我买的书 12 &nbsp;&nbsp; 我卖的书 53</p>
        <a class="a1" href="{{ route('passport.logout') }}">退出登录</a>
    </section>
</div>
@include('public._message')
<div class="membermenu">
    <a href="#" class="a1">我下的订单<span>查看全部</span></a>
    <section class="tabfix">
        <menu>
            <a href="#"><img src="images/ico/member01.png" /><p>待我处理</p></a>
            <a href="#"><img src="images/ico/member02.png" /><p>待卖家处理</p></a>
            <a href="#"><img src="images/ico/member03.png" /><p>已取消</p></a>
            <a href="#"><img src="images/ico/member04.png" /><p>已完成</p></a>
        </menu>
    </section>
</div>
<div class="clear h02"></div>
<div class="memberbox">
    <a href="{{ route('books.my') }}" class="memberbtn">
        <p><i style="background-image: url(images/ico/member05.png)"></i>我的发布</p>
    </a>
    <a href="#" class="memberbtn">
        <p><i style="background-image: url(images/ico/member06.png)"></i>收到的订单</p>
    </a>
    <a href="#" class="memberbtn">
        <p><i style="background-image: url(images/ico/member07.png)"></i>资金账户</p>
    </a>
    <a href="#" class="memberbtn">
        <p><i style="background-image: url(images/ico/member08.png)"></i>平台介绍</p>
    </a>
    <a href="{{ route('user.index') }}" class="memberbtn">
        <p><i style="background-image: url(images/ico/member09.png)"></i>个人设置</p>
    </a>
</div>

<div class="clear h02"></div>

@include('layouts._footer')
@stop