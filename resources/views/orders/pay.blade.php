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
<input  onclick="callpay()" value="支付" class="paysub" />
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
    function jsApiCall(){
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest', {{ $json }},
            function(res){
                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    // 使用以上方式判断前端返回,微信团队郑重提示：
                    // res.err_msg将在用户支付成功后返回
                    // ok，但并不保证它绝对可靠。
                    location.href="{{ route($order->userLink()) }}";
                }
            }
        );
    }
    function callpay()
    {
        if (typeof WeixinJSBridge == "undefined"){
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
            }
        }else{
            jsApiCall();
        }
    }
</script>
@endsection

