@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>资金记录</h2>
    <a href="{{ route('account.index') }}" class="back"></a>
</header>
<div class="comheadbg"></div>
<div class="clear h02"></div>
@if($logs)
    @foreach ($logs as $log)
        <div class="p_infolist">
            <p class="p1">{{ $log->name }}</p>
            <p class="p2">{{ $log->created_at }}</p>
            <span @if($log->symbol == '+')class="sp1"@endif>{{ $log->symbol }}{{ $log->amount }}</span>
        </div>
    @endforeach
@endif
@endsection