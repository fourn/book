@extends('layouts.app')

@section('content')
    <header class="comhead">
        <p class="btn01" onclick="$('#set_school').show()">{{ $sessionSchool->name }}</p>
        <div class="box01">
            <input type="submit" value=" " class="sub" />
            <input type="search" value="" class="text" placeholder="输入书籍名字" />
        </div>
    </header>
    <div class="comheadbg"></div>
    @include('public._message')
    <a href="#" class="block w100"><img src="images/photo/ad01.png" class="w100 block" /></a>
    <section class="indexmenu">
        <a href="#" style="background-image: url(images/ico/index01.png)">课本教材</a>
        <a href="#" style="background-image: url(images/ico/index02.png)">考证书籍</a>
        <a href="#" style="background-image: url(images/ico/index03.png)">课外读物</a>
        <a href="#" style="background-image: url(images/ico/index04.png)">更多分类</a>
    </section>
    <div class="clear h02"></div>
    <div class="indexhot">
        <h2 class="indextit01"><span>热卖图书</span></h2>
        <section class="indexlist">
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
        </section>
        <a href="#" class="more"><span>查看更多</span></a>
    </div>
    <div class="clear h02"></div>
    <div class="indexhot">
        <h2 class="indextit01"><span>好书推荐</span></h2>
        <section class="indexgood">
            <a class="a1" href="#" style="background-image: url(images/photo/img02.png)"></a>
            <a class="a2" href="#" style="background-image: url(images/photo/img03.png)"></a>
            <a class="a3" href="#" style="background-image: url(images/photo/img03.png)"></a>
        </section>
        <h2 class="indextit01"><span>特惠图书</span></h2>
        <section class="indexlist">
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
            <a href="#">
                <i style="background-image: url(images/photo/img01.png);"></i>
                <p class="p1">全日制大学教科书</p>
                <p class="p2">￥55.55<span>￥88.88</span></p>
            </a>
        </section>
        <a href="#" class="more"><span>查看更多</span></a>
    </div>
    <a href="#" class="block w100"><img src="images/photo/ad02.png" class="w100 block" /></a>
    <div class="w100 whitebg oh">
        <h2 class="indextit01" style="top: 0.2rem;"><span>最新图书</span></h2>
        <a class="prolist" href="#">
            <div class="box">
                <i style="background-image: url(images/photo/img01.png)"></i>
                <p class="p1">大学英语八级专用教科书云南教育出版社出版</p>
                <p class="p2">作者名字<span>人民教育出版社</span></p>
                <p class="p3">￥45.55<span>￥98.22</span></p>
                <p class="p4">
                    <span class="sp1">2012年出版</span><span class="sp2">9成新</span>
                </p>
            </div>
        </a>
        <a class="prolist" href="#">
            <div class="box">
                <i style="background-image: url(images/photo/img01.png)"></i>
                <p class="p1">大学英语八级专用教科书云南教育出版社出版</p>
                <p class="p2">作者名字<span>人民教育出版社</span></p>
                <p class="p3">￥45.55<span>￥98.22</span></p>
                <p class="p4">
                    <span class="sp1">2012年出版</span><span class="sp2">9成新</span>
                </p>
            </div>
        </a>
        <a class="prolist" href="#">
            <div class="box">
                <i style="background-image: url(images/photo/img01.png)"></i>
                <p class="p1">大学英语八级专用教科书云南教育出版社出版</p>
                <p class="p2">作者名字<span>人民教育出版社</span></p>
                <p class="p3">￥45.55<span>￥98.22</span></p>
                <p class="p4">
                    <span class="sp1">2012年出版</span><span class="sp2">9成新</span>
                </p>
            </div>
        </a>
        <a class="prolist" href="#">
            <div class="box">
                <i style="background-image: url(images/photo/img01.png)"></i>
                <p class="p1">大学英语八级专用教科书云南教育出版社出版</p>
                <p class="p2">作者名字<span>人民教育出版社</span></p>
                <p class="p3">￥45.55<span>￥98.22</span></p>
                <p class="p4">
                    <span class="sp1">2012年出版</span><span class="sp2">9成新</span>
                </p>
            </div>
        </a>
        <a class="prolist" href="#">
            <div class="box">
                <i style="background-image: url(images/photo/img01.png)"></i>
                <p class="p1">大学英语八级专用教科书云南教育出版社出版</p>
                <p class="p2">作者名字<span>人民教育出版社</span></p>
                <p class="p3">￥45.55<span>￥98.22</span></p>
                <p class="p4">
                    <span class="sp1">2012年出版</span><span class="sp2">9成新</span>
                </p>
            </div>
        </a>
        <p class="loading"><span>正在加载...</span></p>
    </div>

    @include('layouts._footer')
    @include('layouts._set_school')
@endsection
@section('script')
<script type="text/javascript">
    winCloseMyWin(".winbgclick");//关闭窗口
</script>
@endsection