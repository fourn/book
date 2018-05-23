<!--底部浮动-->
<div class="footbg"></div>
<footer class="foottab">
    <div class="tabfix">
        <menu>
            <a class="{{ active_class(if_route('index'), 'sel')  }}" href="{{ route('index') }}"><span>首页</span></a>
            <a class="{{ active_class(if_route('books.list'), 'sel')  }}" href="{{ route('books.list') }}"><span>分类</span></a>
            <a class="{{ active_class(if_route('books.create'), 'sel')  }}" href="{{ route('books.create') }}"></a>
            <a class="{{ active_class(if_route('notifications.index'), 'sel') }}" href="{{ route('notifications.index') }}"><span>消息</span>@auth<b @if(Auth::user()->notification_count == 0)style="background: #999;"@endif>{{ Auth::user()->notification_count }}</b>@endauth</a>
            <a class="{{ active_class(if_route('memberIndex'), 'sel')  }}" href="{{ route('memberIndex') }}"><span>我的</span></a>
        </menu>
    </div>
</footer>

{{--客服 QQ--}}
<a href="http://wpa.qq.com/msgrd?v=3&uin={{$qq}}&site=qq&menu=yes" class="floatbtn" target="_blank"></a>