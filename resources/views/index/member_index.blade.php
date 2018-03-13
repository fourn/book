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
    <a href="{{ route('order.index') }}" class="a1">我的买书<span>查看全部</span></a>
    <section class="tabfix">
        <menu>
            @foreach($statuses as $status)
                @if($status['forUser'])
                <a href="{{ route('order.index') }}?status={{ $status['id'] }}"><img src="images/ico/{{ $status['ico'] }}" /><p>{{ $status['name'] }}</p></a>
                @endif
            @endforeach
        </menu>
    </section>
</div>

@if(count(Auth::user()->sellOrders))
<div class="membermenu">
    <a href="" class="a1">我的卖书<span>查看全部</span></a>
    <section class="tabfix">
        <menu>
            @foreach($statuses as $status)
                @if($status['forSeller'])
                    <a href=""><img src="images/ico/{{ $status['ico'] }}" /><p>{{ $status['name'] }}</p></a>
                @endif
            @endforeach
        </menu>
    </section>
</div>
@endif
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