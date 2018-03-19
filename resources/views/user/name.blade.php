@extends('layouts.app')
@section('body', '')
@section('content')

    <header class="comhead">
        <h2>编辑昵称</h2>
        <a href="{{ route('user.index') }}" class="back"></a>
    </header>
    <form action="{{ route('user.name') }}" method="post">
        {{ csrf_field() }}
        <div class="comheadbg"></div>
        <div class="clear h05"></div>
        @include('public._errors')
        <div class="edittext">
            <input type="text" value="{{ old('name') }}" name="name" class="text" placeholder="请输入新昵称" />
        </div>
    <input type="submit" value="确认修改" class="editbtn" />
    </form>
@endsection
@section('script')
    <script>
        $(function (){
            $('input[name="name"]').focus();
        })
    </script>
@endsection