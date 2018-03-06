@extends('layouts.app')
@section('content')
<header class="comhead">
    <h2>我的发布</h2>
    <a href="{{ route('memberIndex') }}" class="back"></a>
    {{--<a href="#" class="a2">&nbsp;</a>--}}
</header>
<div class="comheadbg"></div>

<div class="slidingtit" id="slidingtit">
    <menu>
        <p><a href="{{ Request::url() }}?index=0">全部</a></p>
        @foreach ($statuses as $key => $status)
        <p><a href="{{ Request::url() }}?status={{ $status['id'] }}&index={{ $key + 1 }}">{{ $status['name'] }}</a></p>
        @endforeach
    </menu>
</div>

<div class="clear h10"></div>

@foreach($mybooks as $book)
<div class="orderlist">
    <section class="prolist" href="#">
        <div class="box">
            <i style="background-image: url({{ $book->image }})"></i>
            <p class="p7 green">通过审核</p>
            <p class="p1">{{ $book->name }}</p>
            <p class="p2">{{ $book->author }}<span>{{ $book->press }}</span></p>
            <p class="p8">
                <a href="#" class="btn01">编辑</a>
                <a href="#" class="btn02">上架</a>
                {{--<a href="#" class="btn03">下架</a>--}}
                <a href="#" class="btn04">删除</a>
            </p>
        </div>
    </section>
</div>
@endforeach

<p class="overend"><span>已查看完全部发布</span></p>

@endsection
@section('script')
<script type="text/javascript">
    eval('slidingCheckTit({{ Request::input('index', 0) }},"#slidingtit","menu","p","sel");');
    //参数依次为：当前选中索引、外层id、子集标签、孙子级标签，选中状态样式class
</script>
@endsection