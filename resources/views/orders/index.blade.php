@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>我下的订单</h2>
    <a href="{{ route('memberIndex') }}" class="back"></a>
</header>
<div class="comheadbg"></div>

<div class="ordertit">
    <section>
        <a class="{{ active_class(if_query('status', null), 'sel') }}" href="{{ url()->current() }}">全部</a>
        @foreach($statuses as $status)
            @if($status['forUser'])
            <a class="{{ active_class(if_query('status', $status['id']), 'sel') }}" href="{{ url()->current() }}?status={{ $status['id'] }}">{{ $status['name'] }}</a>
            @endif
        @endforeach
    </section>
</div>
<div class="clear h10"></div>
@if(count($orders))
    @foreach($orders as $order)
        <div class="orderlist">
            <div class="order_menu">
                <i style="background-image: url({{ $order->seller->avatar }})"></i>
                <span>{{ $order->seller->name }}</span>
                <p class="p1">{{ $order->status_name }}</p>
            </div>
            <div class="clear"></div>
            <a class="prolist" href="{{ route('order.show', $order) }}">
                <div class="box">
                    <i style="background-image: url({{ $order->image }})"></i>
                    <p class="p1">{{ $order->name }}</p>
                    {{--<p class="p2">作者名字<span>人民教育出版社</span></p>--}}
                    <p class="p6">单号：{{ $order->sn }}</p>
                </div>
            </a>
        </div>
    @endforeach
<p class="overend"><span>已查看完全部订单</span></p>
    @else
    <p class="overend"><span>暂无订单~</span></p>
@endif

@endsection