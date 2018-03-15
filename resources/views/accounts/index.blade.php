@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>资金账户</h2>
    <a href="{{ route('memberIndex') }}" class="back"></a>
    <a href="{{ route('account.logs') }}" class="a3">资金记录</a>
</header>
<div class="comheadbg"></div>
@include('public._message')
<div class="moneyinfo">
    <p class="p1">￥{{ $income }}</p>
    <p class="p2">我的收入</p>
    <input type="button" class="btn" value="去提现" onclick="location.href='{{ route('transfers.create') }}'">
</div>
@endsection