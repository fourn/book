@extends('layouts.app')
@section('body', '')
@section('content')
@include('layouts._set_school')
<header class="comhead">
    <h2>选择分类</h2>
    <a href="{{ route('index') }}" class="back"></a>
</header>
<div class="comheadbg"></div>

<div class="slidingtit" id="slidingtit">
    <menu id="categories_box">
        <p><a href="{{ Request::url() }}">全部</a></p>
        @foreach($categories as $key => $category)
        <p><a href="{{ Request::url() }}?category_id={{ $category->id }}&index={{ $key + 1 }}">{{ $category->name }}</a></p>
        @endforeach
    </menu>
</div>

<div class="clear h10"></div>
<div class="class_tit" id="order_box">
    <a class="sel02" order_by="updated_at" order_type="desc"><span>最近更新</span></a>
    <a order_by="price" order_type="asc"><span>最低价格</span></a>
</div>
<div class="clear h10"></div>
<div class="w100 whitebg oh" id="box">
    {{--异步书本--}}
</div>
<p class="loading"><span>正在加载...</span></p>
@include('layouts._footer')

@endsection
@section('script')
<script type="text/javascript">
    eval('slidingCheckTit({{ Request::input('index', 0) }},"#slidingtit","menu","p","sel");');
    //参数依次为：当前选中索引、外层id、子集标签、孙子级标签，选中状态样式class
    var search_data = {'category_id':'{{ Request::input('category_id', 0) }}', 'orderBy':'updated_at', 'orderType':'desc', 'page':1};
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
    $(function (){
        $('#order_box').find('a').click(function (){
            _this = $(this);
            _this.siblings('a').removeClass('sel02');
            _this.addClass('sel02');
            $('#box').html('');
            search_data.orderBy = _this.attr('order_by');
            search_data.orderType = _this.attr('order_type');
            loadData();
        });
    })
</script>
@stop