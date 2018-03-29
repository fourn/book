@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>提现</h2>
    <a href="{{ route('account.index') }}" class="back"></a>
</header>
<div class="comheadbg"></div>
@include('public._errors')
<form action="{{ route('transfers.store') }}" method="post">
    {{ csrf_field() }}
<div class="getmoney">
    <p class="p1">
        <span style="background-image: url(/images/ico/pay01.png)">支付宝账号：</span>
        <input type="text" class="text" value="{{ $user->alipay }}" name="alipay" placeholder="请输入" />
    </p>
    <p class="p2">提现金额</p>
    <p class="p3"><input class="text" type="text" name="amount" placeholder="￥" value="{{ old('amount') }}"/></p>
    <p class="p4">可提现余额：{{ $user->balance }} 元 <a style="color: #00a7d0;" id="set_all">全部</a></p>
</div>

<input type="submit" value="提现" class="paysub" />
</form>
@endsection
@section('script')
    <script>
        $(function (){
            var _max = '{{ $user->balance }}';
            $('#set_all').click(function (){
                $('input[name="amount"]').val(_max);
            });

            $('input[name="amount"]').keyup(function (){
                if($(this).val() > _max){
                    layer.msg('最多提现'+_max+'元');
                    $(this).val(_max)
                }
            });
        })
    </script>
@endsection