@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>消息通知</h2>
    <a href="javascript:history.back();" class="back"></a>
</header>
<div class="comheadbg"></div>

@if ($notifications->count())
        @foreach ($notifications as $notification)
            @include('notifications.types._' . snake_case(class_basename($notification->type)))
        @endforeach
@else
    <div style="text-align: center;font-size: 0.36rem; color: #999; margin-top: 1rem;">您还没有收到任何通知</div>
@endif

@include('layouts._footer')
@endsection
