@extends('layouts.app')
@section('body', '')
@section('css')
<style>
    .layui-upload-file {display: none;}
</style>
@endsection
@section('content')
<header class="comhead">
    @if($book->id)
        <h2>编辑图书</h2>
    @else
        <h2>发布图书</h2>
    @endif
    <a onclick="layer.confirm('书本未保存确认退出？', function (){location.href='@if($book->id){{ route('books.show_self', $book->id) }}@else{{ route('index') }}@endif'})" class="back"></a>
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
    <p id="upload_image" class="img" style="background-image: url(/images/fm.png)">
        <img src="{{ old('image', $book->image) }}" id="image_show">
    </p>
    <input type="hidden" name="image" id="image" value="{{ old('image', $book->image) }}">
    <div class="box">
        <p><span>书名：</span><input type="text" name="name" class="text" placeholder="请输入书名" value="{{ old('name', $book->name) }}" /></p>
        <p><span>作者：</span><input type="text" name="author" class="text" placeholder="请输入作者" value="{{ old('author', $book->author) }}"/></p>
        <p><span>出版社：</span><input type="text" name="press" class="text text01" placeholder="请输入出版社" value="{{ old('press', $book->press) }}" /></p>
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
                <option value="{{ $key }}" @if($book->used == $key) selected @endif>{{ $used }}</option>
            @endforeach
        </select>
    </div>
    <div class="a1">
        <span>分类：</span>
        <select name="category_id">
            <option value="0">请选择分类</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if($book->category_id == $category->id) selected @endif >{{ $category->name }}</option>
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
<div class="clear h02"></div>
<div style="margin-left: 0.3rem; font-size: 0.24rem;color: #999;">内容修改之后需要等待重新审核</div>
<input type="submit" value="@if($book->id)保存修改@else发布书本@endif" class="bluebtn" />
<div class="clear h02"></div>
</form>
@include('layouts._footer')

@endsection
@section('script')
<script src="{{ asset('layui/layui.js') }}"></script>
<script type="text/javascript">
    winCloseMyWin(".winbgclick");//关闭窗口
    layui.use('upload', function (){
        var upload = layui.upload;
        var uploadInst = upload.render({
            elem: '#upload_image' //绑定元素
            ,url: '{{ route('books.upload_image') }}' //上传接口
            ,data: {_token: '{{ csrf_token() }}'}
            ,field:'upload_file'
            ,before: function(obj){ //obj参数包含的信息，跟 choose回调完全一致，可参见上文。
                layer.load(); //上传loading
            }
            ,done: function(res){
                //上传完毕回调
                layer.closeAll('loading'); //关闭loading
                if(res.code == 1){
                    $('#image').val(res.file_path);
                    $('#image_show').attr('src', res.file_path);
                }
            }
            ,error: function(){
                //请求异常回调
                layer.closeAll('loading'); //关闭loading
            }
        });
    })
</script>
@endsection