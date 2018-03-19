@extends('layouts.app')

@section('content')
    @include('layouts._set_school')
    <header class="comhead">
        <p class="btn01" onclick="$('#set_school').show()">{{ isset($sessionSchool) ? $sessionSchool->name : '请选择'}}</p>
        <div class="box01" onclick="location.href='{{ route('search') }}'">
            <input type="submit" value=" " class="sub" />
            <input type="search" value="" class="text" placeholder="输入关键词" />
        </div>
    </header>
    <div class="comheadbg"></div>
    @include('public._message')
    <a href="javascript:void(0);" class="block w100"><img src="images/photo/ad01.png" class="w100 block" /></a>
    <section class="indexmenu">
        <a href="{{ route('books.list') }}?category=1&index=1" style="background-image: url(images/ico/index01.png)">课本教材</a>
        <a href="{{ route('books.list') }}?category=2&index=2" style="background-image: url(images/ico/index02.png)">课外读物</a>
        <a href="{{ route('books.list') }}?category=3&index=3" style="background-image: url(images/ico/index03.png)">考研书籍</a>
        <a href="{{ route('books.list') }}" style="background-image: url(images/ico/index04.png)">更多分类</a>
    </section>
    <div class="clear h02"></div>
@if($books)
    <div class="indexhot">
        <h2 class="indextit01"><span>平台好书推荐</span></h2>
        <section class="indexlist">
            @foreach ($books as $book)
            <a href="{{ route('books.show', $book->id) }}">
                <i style="background-image: url({{ $book->image }});"></i>
                <p class="p1">{{ $book->name }}</p>
                <p class="p2">￥{{ $book->price }}<span>￥{{ $book->original_price }}</span></p>
            </a>
            @endforeach
        </section>
        {{--<a href="#" class="more"><span>查看更多</span></a>--}}
    </div>
    <div class="clear h02"></div>
@endif
    {{--<div class="indexhot">
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
    </div>--}}
    <a href="javascript:void(0);" class="block w100"><img src="images/photo/ad02.png" class="w100 block" /></a>
    <h2 class="indextit01" style="top: 0.2rem;"><span>最新发布</span></h2>
    <div class="w100 whitebg oh" id="box">
        {{--书本容器--}}
    </div>
    <p class="loading"><span>正在加载...</span></p>

    @include('layouts._footer')

@endsection
@section('script')
<script type="text/javascript">
    winCloseMyWin(".winbgclick");//关闭窗口

    var search_data = {'orderBy':'updated_at', 'orderType':'desc', 'page':1};
    var _lock = false;
    function loadData(){
        var _count = $('#box').find('a').length;
        var _page = Math.ceil(_count / 6) + 1;
        if(_page == 0){
            _page = 1;
        }
        search_data.page = _page;
        $('.loading span').html('正在加载...');
        _lock = true;
        $.ajax({
            url:'{{ route('books.index') }}',
            type:'get',
            data:search_data,
            success: function (data){
                _lock = false;
                if(data){
                    $('#box').append(data);
                }else{
                    $('.loading span').html('没有更多');
                }
            }
        })
    }
    $(window).scroll(function() {
        if ($(document).scrollTop() >= $(document).height() - $(window).height() - 200) {
            if(_lock === false){
                loadData();
            }
        }
    });
    loadData();


</script>
@endsection