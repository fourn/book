@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>售书订单</h2>
    <a href="{{ route('memberIndex') }}" class="back"></a>
</header>
<div class="comheadbg"></div>

<div class="ordertit">
    <section>
        <a class="{{ active_class(if_query('status', null), 'sel') }}" href="{{ url()->current() }}">全部</a>
        @foreach($statuses as $status)
            @if($status['forSeller'])
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
                <i style="background-image: url({{ $order->user->avatar }})"></i>
                <span>{{ $order->user->name }}</span>
                <p class="p1">{{ $order->status_name }}</p>
            </div>
            <div class="clear"></div>
            <div class="prolist" href="{{ $order->sellerLink() }}">
                <div class="box">
                    <a class="img" href="{{ $order->sellerLink() }}" style="background-image: url({{ $order->image }})"></a>
                    <a href="{{ $order->sellerLink() }}" class="p1">{{ $order->name }}</a>
                    {{--<p class="p2">作者名字<span>人民教育出版社</span></p>--}}
                    <p class="p6 p9">订单号：{{ $order->sn }}</p>
                    <p class="p10">
                        @can('confirm', $order)
                            <a class="btn01" href="{{ route('order.confirm', $order) }}">确认订单</a>
                        @endcan
                        @can('send', $order)
                            <a class="btn01" onclick="lc('{{ route('order.send', $order) }}', '请确认您已将书本送达？')">确认送达</a>
                        @endcan
                            {{--<a class="btn02" href="{{ route('order.cancel', $order) }}">取消订单</a>--}}
                    </p>
                </div>
            </div>
        </div>
    @endforeach
<p class="overend"><span>已查看完全部订单</span></p>
    @else
    <p class="overend"><span>暂无订单~</span></p>
@endif

@endsection