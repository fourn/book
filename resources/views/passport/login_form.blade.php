@extends('layouts.app')

@section('content')
    <div class="comheadbg"></div>
    @include('public._errors')
    @include('public._message')
    <form action="{{ route('passport.login') }}" method="post">
        <input type="hidden" name="loginType" value="{{ old('loginType', 'sms') }}">
        {{ csrf_field() }}
    <section class="loginbox">
        <i style="background-image: url(images/ico/login02.png)"></i>
        <input type="text" value="{{ old('mobile') }}" name="mobile" placeholder="请输入手机号" class="text text01" />
    </section>

    <section class="loginbox" id="sms" @if(old('loginType') == 'password') style="display: none;" @endif>
        <i style="background-image: url(images/ico/login03.png)"></i>
        <input type="text" value="" name="verifyCode" placeholder="验证码" class="text" />
        <a class="yzm02" id="sendVerifySmsButton">获取验证码</a>
    </section>

    <section class="loginbox" id="password" @if(old('loginType') != 'password') style="display: none;"@endif>
        <i style="background-image: url(images/ico/login04.png)"></i>
        <input type="password" value="" name="password" placeholder="请输入密码" class="text text01" />
    </section>

    <div class="clear h08"></div>
    <input type="submit" value="登录" class="loginbtn" />
    <p class="logintext"><a href="{{ route('passport.register') }}">用户注册</a><a class="a1" id="changeType">{{ old('loginType') != 'password' ? '使用密码登录' : '使用验证码登录' }}</a></p>
    </form>


@stop

@section('script')
    <script src="{{ asset('js/laravel-sms.js') }}"></script>
    <script>
        $('#changeType').click(function (){
            var _sms = $('#sms');
            var _password = $('#password');
            var _loginType = $('input[name="loginType"]');
            if (_sms.is(':visible')){
                $(this).html('使用验证码登录');
                _loginType.val('password');
                _sms.hide(200, function (){
                    _sms.find('input').val('');
                    _password.show(200);
                })
            }else if(_password.is(':visible')){
                $(this).html('使用密码登录');
                _loginType.val('sms');
                _password.hide(200, function (){
                    _password.find('input').val('');
                    _sms.show(200);
                });
            }
        });

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
                //这里是登录，所以要判断该手机号在数据库中是否存在
                mobile_rule : 'check_mobile_exists'
            },

            //消息展示方式(默认为alert)
            notify : function (msg, type) {
                layer.msg(msg);
            },
        });
    </script>
@stop