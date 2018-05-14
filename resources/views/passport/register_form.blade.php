@extends('layouts.app')

@section('content')

    <header class="comhead">
        <h2>新用户注册</h2>
        <a href="{{ route('index') }}" class="back"></a>
    </header>
    <div class="comheadbg"></div>

    @include('public._errors')
    @include('public._message')
    <form action="{{ route('passport.register') }}" method="post">
    {{ csrf_field() }}
    <section class="loginbox">
        <i style="background-image: url(images/ico/login02.png)"></i>
        <input type="text" value="{{ old('mobile') }}" name="mobile" placeholder="请输入手机号" class="text text01" />
    </section>
    {{--<section class="loginbox">
        <i style="background-image: url(images/ico/login01.png)"></i>
        <input type="text" value="" placeholder="动态验证码" class="text" />
        <a class="yzm01" style="background-image: url(images/photo/yzm.png)"></a>
    </section>--}}
    <section class="loginbox">
        <i style="background-image: url(images/ico/login03.png)"></i>
        <input type="text" value="" name="verifyCode" placeholder="验证码" class="text" />
        <a class="yzm02" id="sendVerifySmsButton">获取验证码</a>
    </section>
    <section class="loginbox">
        <i style="background-image: url(images/ico/login04.png)"></i>
        <input type="password" value="" name="password" placeholder="请设置至少6位密码" class="text text01" />
    </section>

    <div class="clear h08"></div>
    @isset($oauth_user)
        <div class="logintext">
            <img src="{{$oauth_user->getAvatar()}}" alt="" style="width: 1rem;">
            <div>{{$oauth_user->getName()}}</div>
        </div>
    @endisset
    <input type="submit" value="注册" class="loginbtn" />
    <p class="logintext"><a href="{{ route('passport.login') }}">已有账号？</a></p>
    </form>
@stop
@section('script')
    <script src="{{ asset('js/laravel-sms.js') }}"></script>
    <script>
        $('#sendVerifySmsButton').sms({
            //laravel csrf token
            token       : "{{csrf_token()}}",
            //请求间隔时间
            interval    : 60,
            //请求参数
            requestData : {
                //手机号
                mobile : function () {
                    return $('input[name=mobile]').val();
                },
                //这里是注册，所以要判断该手机号在数据库中是否唯一
                mobile_rule : 'check_mobile_unique'
            },

            //消息展示方式(默认为alert)
            notify : function (msg, type) {
                layer.msg(msg);
            },
        });
    </script>
@stop