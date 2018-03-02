<!--底部浮动-->
<div class="footbg"></div>
<footer class="foottab">
    <div class="tabfix">
        <menu>
            <a class="{{ active_class(if_route('index'), 'sel')  }}" href="{{ route('index') }}"><span>首页</span></a>
            <a href="#"><span>分类</span></a>
            <a href="#"></a>
            <a href="#"><span>消息</span></a>
            <a class="{{ active_class(if_route('memberIndex'), 'sel')  }}" href="{{ route('memberIndex') }}"><span>我的</span></a>
        </menu>
    </div>
</footer>