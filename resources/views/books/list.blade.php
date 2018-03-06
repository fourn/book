@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>选择分类</h2>
    <a href="{{ route('index') }}" class="back"></a>
</header>
<div class="comheadbg"></div>

<div class="slidingtit" id="slidingtit">
    <menu id="categories_box">
        <p category_id="0"><a>全部</a></p>
        @foreach($categories as $category)
        <p category_id="{{ $category->id }}"><a>{{ $category->name }}</a></p>
        @endforeach
    </menu>
</div>

<div class="clear h10"></div>
<div class="class_tit">
    <a class="sel02" href="#"><span>最近更新</span></a>
    <a href="#"><span>最低价格</span></a>
</div>
<div class="clear h10"></div>
<div class="w100 whitebg oh" id="box">
    {{--异步书本--}}
    {{--<p class="loading"><span>正在加载...</span></p>--}}
</div>
@include('layouts._footer')
@include('layouts._set_school')
@endsection
@section('script')
<script type="text/javascript">
    eval('slidingCheckTit(0,"#slidingtit","menu","p","sel");');
    //参数依次为：当前选中索引、外层id、子集标签、孙子级标签，选中状态样式class
    function loadData(){
        $.ajax({
            url:'{{ route('books.index') }}',
            type:'get',
            data:{},
            success: function (data){
                $('#box').append(data);
            }
        })
    }
    $(window).scroll(function() {
        if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
            loadData();
        }
    });
    loadData();
    $(function (){
        $('#categories_box').find('p').click(function (){
            alert(1);
        });
    })
</script>
@stop