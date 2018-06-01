@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>创建订单</h2>
    <a href="javascript:history.back()" class="back"></a>
</header>
<div class="comheadbg"></div>

@include('public._errors')

<img src="/images/address.png" class="w100 block" />
<a class="top_address">
    <span>取货</span>
    <p class="p1">{{ $school->depot }}</p>
</a>
<div class="clear h02"></div>

<div class="w100 whitebg oh">
    <div class="order_menu">
        <i style="background-image: url({{ $seller->avatar }})"></i>
        <span>{{ $seller->name }}</span>
        <p>{{ $seller->school->name }}</p>
    </div>
    <div class="clear"></div>
    <a class="prolist" href="javascript:void(0);">
        <div class="box">
            <i style="background-image: url({{ $book->image }})"></i>
            <p class="p1">{{ $book->name }}</p>
            <p class="p2">{{ $book->author }}<span>{{ $book->press }}</span></p>
            <p class="p4"> x 1</p>
            <p class="p5">￥{{ $book->price }}</p>
        </div>
    </a>
</div>
<div class="clear h02"></div>

<form action="{{ route('order.store') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="book_id" value="{{ $book->id }}">

<section class="order_btn">
    <a class="a1" href="javascript:void(0);">
        <span class="sp1">配送方式</span>
        <p>自取</p>
    </a>
    <div class="box">
        <span class="sp1">买家留言</span>
        <input type="text" placeholder="必填：送书联系电话、时间、地点" class="text" name="message" />
    </div>
</section>
<div class="clear h02"></div>

<div class="clear h10"></div>
<footer class="orderfoot">
    <p class="p1">应付：<span>￥{{ $book->price }}</span></p>
    <input type="submit" value="立即下单" class="sub01" />
</footer>
</form>

@endsection