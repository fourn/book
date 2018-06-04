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
    @else
    <input type="button" onclick="callpay()" value="支付" class="paysub" />
@endif

@endsection
@section('script')
@if(config('order_fake_pay') != 'on')
<script type="text/javascript">
    //winCloseMyWin(".winbgclick");//关闭窗口
    function jsApiCall(){
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest', {!! $json !!},
            function(res){
                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    // 使用以上方式判断前端返回,微信团队郑重提示：
                    // res.err_msg将在用户支付成功后返回
                    // ok，但并不保证它绝对可靠。
                    location.href="{{ $order->userLink() }}";
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
@endif
@endsection

