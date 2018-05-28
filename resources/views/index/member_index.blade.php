@extends('layouts.app')

@section('content')
<div class="membertop">
    <section>
        <i style="background-image: url({{ $user->avatar }})" onclick="location.href='{{ route('user.index') }}'"></i>
        <p class="p1">{{ $user->name }}</p>
        @if($user->school_id)
            <p class="p2">学校：{{ $user->school->name }}</p>
        @else
            <p class="p2" onclick="location.href='{{ route('user.index') }}'"> 请设置学校 </p>
        @endif
        <p class="p3">已购买 {{ $userOrderCount }} &nbsp;&nbsp; 已卖出 {{ $sellerOrderCount }}</p>
        <a class="a1" href="{{ route('passport.logout') }}">退出登录</a>
    </section>
</div>
@include('public._message')
<div class="membermenu">
    <a href="{{ route('order.index') }}" class="a1">购书订单<span>查看全部</span></a>
    <section class="tabfix">
        <menu>
            @foreach($statuses as $status)
                @if($status['forUser'])
                <a href="{{ route('order.index') }}?status={{ $status['id'] }}">
                    <img src="images/ico/{{ $status['ico'] }}" />
                    <p>{{ $status['name'] }}</p>
                    @if(isset($orderStatusCount[$status['id']]))
                        <b @if($orderStatusCount[$status['id']] == 0)style="background: #999;"@endif>{{ $orderStatusCount[$status['id']] }}</b>
                    @endif
                </a>
                @endif
            @endforeach
        </menu>
    </section>
</div>

@if($hasSell > 0)
<div class="membermenu">
    <a href="{{ route('order.seller_index') }}" class="a1">售书订单<span>查看全部</span></a>
    <section class="tabfix">
        <menu>
            @foreach($statuses as $status)
                @if($status['forSeller'])
                    <a href="{{ route('order.seller_index') }}?status={{ $status['id'] }}">
                        <img src="images/ico/{{ $status['ico'] }}" />
                        <p>{{ $status['name'] }}</p>
                        @if(isset($orderStatusCount[$status['id']]))
                            <b @if($orderStatusCount[$status['id']] == 0)style="background: #999;"@endif>{{ $orderStatusCount[$status['id']] }}</b>
                        @endif
                    </a>
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
    <a href="{{ route('account.index') }}" class="memberbtn">
        <p><i style="background-image: url(images/ico/member07.png)"></i>资金账户</p>
    </a>
    @if($about)
    <a href="{{ $about->link }}" class="memberbtn">
        <p><i style="background-image: url(images/ico/member08.png)"></i>平台介绍</p>
    </a>
    @endif
    <a href="{{ route('user.index') }}" class="memberbtn">
        <p><i style="background-image: url(images/ico/member09.png)"></i>个人设置</p>
    </a>
</div>

<div class="clear h02"></div>

@include('layouts._footer')
@stop