@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    @if($book->id)
        <h2>编辑图书</h2>
    @else
        <h2>发布图书</h2>
    @endif
    <a href="#" class="back"></a>
</header>
<div class="comheadbg"></div>
@include('public._errors')
@if($book->id)
    <form action="{{ route('books.update', $book->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        @else
            <form action="{{ route('books.store') }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                @endif
                {{ csrf_field() }}
<p class="rel_tit"><span>ISBN：</span><input type="text" placeholder="请输入ISBM码" name="sn" value="{{ old('sn', $book->sn) }}" /></p>
<div class="clear h02"></div>
<section class="rel_img">
    <p onclick="$('#image').trigger('click')" class="img" style="background-image: url(/images/fm.png)">
        <img src="" alt="" id="image_show">
    </p>
    <input type="file" name="image" id="image" style="display: none;">
    <div class="box">
        <p><span>书名：</span><input type="text" name="name" class="text" placeholder="请输入书名" value="{{ old('name', $book->name) }}" /></p>
        <p><span>作者：</span><input type="text" name="author" class="text" placeholder="请输入作者" value="{{ old('author', $book->author) }}"/></p>
        <p><span>出版社：</span><input type="text" name="press" class="text text01" placeholder="请输入出版社" {{ old('press', $book->press) }} /></p>
        <p><span>出版年份：</span><input type="text" name="published_at" class="text text02" placeholder="例如：2005" value="{{ old('published_at', $book->published_at) }}"/></p>
    </div>
</section>
<div class="clear h02"></div>
<section class="rel_info">
    <div class="a1">
        <span>新旧：</span>
        <select name="used">
            <option value="0">请选择新旧程度</option>
            @foreach ($useds as $key => $used)
                <option value="{{ $key }}">{{ $used }}</option>
            @endforeach
        </select>
    </div>
    <div class="a1">
        <span>分类：</span>
        <select name="category_id">
            <option value="0">请选择分类</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <p class="p1">
        <span>原价：</span><input type="text" name="original_price" class="text" value="{{ old('original_price', $book->original_price) }}" />
        <span>出售价：</span><input type="text" name="price" class="text" value="{{ old('price', $book->price) }}" />
    </p>
    <p class="p2">
        <span>图书描述：</span>
    </p>
    <textarea name="description" class="textarea" placeholder="请输入书本描述">{{ old('description', $book->description) }}</textarea>
</section>
<div class="clear h10"></div>
<input type="submit" value="发布图书" class="bluebtn" />
<div class="clear h02"></div>
</form>
@include('layouts._set_school')
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
    $(function (){
        $('#image').change(function (){
            var _src = window.URL.createObjectURL(this.files[0]);
            $('#image_show').attr('src', _src);
        });
    })
</script>
@endsection