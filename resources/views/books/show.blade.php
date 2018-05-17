@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>书本详情</h2>
    <a href="javascript:history.back()" class="back"></a>
</header>
<div class="comheadbg"></div>

<div id="box" class="bannerbox">
    <ul id="sum" class="bannersum" style="width: 100%;">
        <li style="width: 100%;"><img src="{{ $book->image }}" /></li>
    </ul>
    <p id="num" class="bannernum"></p>
</div><!--我是banner-->
{{--
<p class="bannerpage">
    <a href="javascript:void(0);" id="bannernlast">&nbsp;</a>
    <a href="javascript:void(0);" id="bannernnext">&nbsp;</a>
</p>


<script type="text/javascript">
    eval('indexBanner("#box","#sum","li",300,5000,"#num","span","sel","#bannernlast","#bannernnext");');//Banner，可以不写“上一页”“下一页”的id，eavl()方法保证在代码之后加载执行
</script>
--}}
<div class="bookinfo">
    <p class="p1">{{ $book->name }}</p>
    <p class="p2">{{ $book->author }}<span>{{ $book->press }}</span></p>
    <p class="p3">
        <span class="sp1" style="position: static;margin-right: 1.5rem;">{{ $book->published_at }}年出版</span>
        <span class="sp2">{{ $book->used_format }}</span>{{--<span class="sp3">34本</span>--}}
    </p>
    <p class="p4">{!! $book->description !!}</p>
</div>

<div class="clear h02"></div>
<div class="sellerinfo">
    <div class="box">
        <i style="background-image: url({{ $user->avatar }})"></i>
        <p class="p1">{{ $user->name }}</p> <p class="p2">学校：{{ $user->school->name }}</p>
    </div>
    <p class="p3">{{ $user->last_actived_at->diffForHumans() }} 活跃</p>
</div>

<div class="clear h02"></div>

<div class="clear h10"></div>
<footer class="orderfoot">
    <p class="p1">应付：<span>￥{{ $book->price }}</span></p>
    @can('buy', $book)
    <form action="{{ route('order.create', $book) }}" >
        <input type="submit" value="立即购买" class="sub01" />
    </form>
        @else
        @guest
        <a href="{{ route('passport.login') }}" class="sub01">请先登录</a>
        @endguest
    @endcan
</footer>
@endsection