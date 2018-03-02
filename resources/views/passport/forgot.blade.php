@extends('layouts.app')

@section('content')
    <header class="comhead">
        <h2>修改密码</h2>
        <a href="{{ route('user.index') }}" class="back"></a>
    </header>
    <div class="comheadbg"></div>

    @include('public._message')
    @include('public._errors')
    <form action="{{ route('passport.forgot') }}" method="post">
        {{csrf_field()}}
        <input type="hidden" value="{{ Auth::user()->mobile }}" name="mobile">
        <section class="loginbox">
            <i style="background-image: url(images/ico/login03.png)"></i>
            <input type="text" value="" placeholder="验证码" class="text" name="verifyCode" />
            <a class="yzm02" id="sendVerifySmsButton">获取验证码</a>
        </section>
        <section class="loginbox">
            <i style="background-image: url(images/ico/login04.png)"></i>
            <input type="password" value="" name="password" placeholder="输入新密码，至少6位" class="text text01" />
        </section>
        <section class="loginbox">
            <i style="background-image: url(images/ico/login04.png)"></i>
            <input type="password" value="" name="password_confirmation" placeholder="确认新密码" class="text text01" />
        </section>

        <div class="clear h08"></div>
        <input type="submit" value="完成" class="loginbtn" />
    </form>
@endsection

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
                mobile : '{{ Auth::user()->mobile }}',
                //这里是找回密码，所以要判断该手机号在数据库中是否存在
                mobile_rule : 'check_mobile_exists'
            },

            //消息展示方式(默认为alert)
            notify : function (msg, type) {
                layer.msg(msg);
            },
        });
        $(function (){
            @if(Request::has('autoSend'))
                $('#sendVerifySmsButton').trigger('click');
            @endif
        })
    </script>
    @endsection