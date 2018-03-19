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

@if(count($mybooks))
@foreach($mybooks as $book)
<div class="orderlist">
    <section class="prolist">
        <div class="box">
            <i style="background-image: url({{ $book->image }})"></i>
            <p class="p7 green">{{ $book->status_name }}</p>
            <p class="p1">{{ $book->name }}</p>
            <p class="p2">{{ $book->author }}<span>{{ $book->press }}</span></p>
            <p class="p8">
                <a href="{{ route('books.show_self', $book->id) }}" class="btn01">查看</a>
                @can('toggleShow', $book)
                    @if($book->is_show == 1)
                        <a onclick="toggleShow($(this), {{ $book->id }})" class="btn03">下架</a>
                    @else
                        <a onclick="toggleShow($(this), {{ $book->id }})" class="btn02">上架</a>
                    @endif
                @endcan
                {{--<a href="#" class="btn04">删除</a>--}}
            </p>
        </div>
    </section>
</div>
@endforeach

<p class="overend"><span>已查看完全部发布</span></p>
    @else
    <p class="overend"><span>暂无内容</span></p>
@endif
@endsection
@section('script')
<script type="text/javascript">
    eval('slidingCheckTit({{ Request::input('index', 0) }},"#slidingtit","menu","p","sel");');
    //参数依次为：当前选中索引、外层id、子集标签、孙子级标签，选中状态样式class
    var ajax_lock = false;
    function toggleShow(_this, _id){
        if(ajax_lock === false){
            ajax_lock = true;
            $.ajax({
                url:'{{ route('books.toggle_show') }}',
                data:{id:_id},
                success:function(data){
                    ajax_lock = false;
                    if(data.status === 1){
                        if(_this.hasClass('btn03')){
                            layer.msg('下架成功！不再展示');
                            _this.attr('class', 'btn02');
                            _this.html('上架');
                        }else{
                            layer.msg('上架成功！能够被其他人看到');
                            _this.attr('class', 'btn03');
                            _this.html('下架');
                        }
                    }
                }
            });
        }
    }
</script>
@endsection