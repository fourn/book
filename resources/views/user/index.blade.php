@extends('layouts.app')

@section('content')
    <header class="comhead">
        <h2>个人设置</h2>
        <a href="{{ route('memberIndex') }}" class="back"></a>
    </header>
    <div class="comheadbg"></div>
    @include('public._message')
    <div class="myinfo">
        <a class="box01" href="{{ route('user.avatar') }}">
            <span class="tit">头像</span>
            <i style="background-image: url({{ $user->avatar }})"></i>
        </a>
        <a class="box02" href="{{ route('user.name') }}">
            <span class="tit">昵称</span>
            <p>{{ $user->name }}</p>
        </a>
        <div class="box03">
            <span class="tit">性别</span>
            <select class="box02" id="gender">
                <option value="0" {{ $user->gender == 0 ? 'selected' : '' }}>保密</option>
                <option value="1" {{ $user->gender == 1 ? 'selected' : '' }}>男</option>
                <option value="2" {{ $user->gender == 2 ? 'selected' : '' }}>女</option>
            </select>
        </div>
        <div class="box03">
            <span class="tit">学校</span>
            <select class="box02" id="school">
                <option value="">请设置学校</option>
                @foreach ($schools as $school)
                <option @if($school->id == $user->school_id) selected @endif value="{{ $school->id }}">{{ $school->name }}</option>
                @endforeach
            </select>
        </div>
        <a class="box02" href="{{ route('passport.forgot', ['autoSend'=>1]) }}">
            <span class="tit">登录密码</span>
            <p>修改密码</p>
        </a>
    </div>
@endsection
@section('script')
    <script>
        $('#gender').change(function (){
            var _gender = $(this).val();
            $.ajax({
                url:'{{ route('user.gender') }}',
                type:'post',
                data:{
                    'gender':_gender
                },
                success:function (data){
                    //console.log(data);
                    layer.msg('设置成功');
                }
            })
        });

        $('#school').change(function (){
            var _school = $(this).val();
            $.ajax({
                url:'{{ route('user.school') }}',
                type:'post',
                data:{
                    'school_id':_school
                },
                success:function (data){
                    //console.log(data);
                    layer.msg('设置成功');
                }
            })
        });
    </script>
@stop

