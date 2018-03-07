@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>发布图书</h2>
    <a href="#" class="back"></a>
</header>
<div class="comheadbg"></div>

<p class="rel_tit"><span>ISBN：</span><input type="text" placeholder="请输入ISBM码" /></p>
<div class="clear h02"></div>

<section class="rel_img">
    <p class="img" style="background-image: url(/images/fm.png)"></p>
    <div class="box">
        <p><span>书名：</span><input type="text" class="text" /></p>
        <p><span>作者：</span><input type="text" class="text"/></p>
        <p><span>出版社：</span><input type="text" class="text text01" /></p>
        <p><span>出版时间：</span><input type="text"  class="text text02" /></p>
    </div>
</section>
<div class="clear h02"></div>
<section class="rel_info">
    <a href="#" class="a1">
        <span>新旧：</span><p>我是文字内容我是文字内容我是文字内容我是文字内容我是文字内容我是文字内容</p>
    </a>
    <a href="#" class="a1">
        <span>分类：</span><p>我是文字内容</p>
    </a>
    <p class="p1">
        <span>原价：</span><input type="text" class="text" />
        <span>出售价：</span><input type="text" class="text" />
    </p>
    <p class="p2">
        <span>图书描述：</span><input type="text" class="text" />
    </p>
</section>
<div class="clear h10"></div>
<input type="submit" value="发布图书" class="bluebtn" />
<div class="clear h02"></div>
@include('layouts._footer')
<!--弹窗 发布成功-->
<aside class="winbg">
    <div class="winbgclick"></div>
    <div class="win_success">
        <section>
            <p>恭喜您！发布成功</p>请及时查看消息
        </section>
        <a href="#">查看发布</a>
    </div>
</aside>
<!--弹窗 确认-->
<aside class="winbg" {{--style="display:block;"--}}>
    <div class="winbgclick"></div>
    <div class="win_confirm">
        <p class="p1">是否要放弃发布？</p>
        <p class="p2">
            <a href="#">确定</a><a href="#">取消</a>
        </p>
    </div>
</aside>
@endsection
@section('script')
<script type="text/javascript">
    winCloseMyWin(".winbgclick");//关闭窗口
</script>
@endsection