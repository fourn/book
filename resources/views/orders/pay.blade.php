@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>在线支付</h2>
    <a href="javascript:history.back()" class="back"></a>
</header>
<div class="comheadbg"></div>

<p style="text-align: center; margin-top: .5rem;">您正在进行订单 {{ $order->sn }} 的支付操作</p>
<p style="text-align: center; margin-top: .5rem;">请在微信中完成支付</p>
<p style="text-align: center; margin-top: .5rem;">支付书本：{{ $order->name }}</p>
<p style="text-align: center; margin-top: .5rem;">支付金额：<span style="font-size: 0.36rem;color: #ff0084;">￥{{ $order->price }}</span></p>
@if(config('order_fake_pay') == 'on')
<form action="{{ route('order.fake_pay') }}">
    <input type="hidden" name="sn" value="{{ $order->sn }}">
    {{ csrf_field() }}
    <input type="submit" value="模拟付款" class="paysub" />
</form>
@endif
{{--<aside class="winbg" style="display: block;">
    <div class="winbgclick"></div>
    <div class="win_success">
        <section style="background-image: url(images/error.png)">
            <p>支付失败！</p>大学生英语四级考试
        </section>
        <a href="#">重新支付</a>
    </div>
</aside>

<aside class="winbg">
    <div class="winbgclick"></div>
    <div class="win_success">
        <section>
            <p>恭喜您！购买成功</p>量子烈学
        </section>
        <a href="#">返回首页</a>
    </div>
</aside>--}}
@endsection
@section('javascript')
<script type="text/javascript">
    //winCloseMyWin(".winbgclick");//关闭窗口
</script>
@endsection

