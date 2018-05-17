@extends('layouts.app')
@section('body', '')
@section('content')
<header class="comhead">
    <h2>我的发布</h2>
    <a href="{{ route('books.my') }}" class="back"></a>
    <span class="sp1">{{ $book->status_name }}</span>
</header>
<div class="comheadbg"></div>
@include('public._message')
<section class="rel_info">
    <a class="a1"><span>ISBN：</span>{{ $book->sn }}</a>
</section>
<section class="rel_img">
    <p class="img" style="background-image: url({{ $book->image }})"></p>
    <div class="box">
        <p><span>书名：</span><input type="text" class="text" value="{{ $book->name }}" readonly /></p>
        <p><span>作者：</span><input type="text" class="text" value="{{ $book->author }}" readonly/></p>
        <p><span>出版社：</span><input type="text" class="text text01" value="{{ $book->press }}" readonly/></p>
        <p><span>出版年份：</span><input type="text"  class="text text02" value="{{ $book->published_at }}" readonly/></p>
    </div>
</section>
<div class="clear h02"></div>
<section class="rel_info">
    <a class="a1"><span>新旧：</span>{{ $book->used_format }}</a>
    <a class="a1"><span>分类：</span>{{ $book->category->name }}</a>
    <p class="p1">
        <span>原价：</span><input type="text" class="text" value="{{ $book->original_price }}" readonly />
        <span>出售价：</span><input type="text" class="text" value="{{ $book->price }}" readonly />
    </p>
    <p class="p2">
        <span>书本描述：</span>
    </p>
    <div style="padding-right: 0.3rem;padding-bottom:0.5rem; height: auto;">{{ $book->description }}</div>
</section>
<div class="clear h10"></div>
<div class="bookbtn">
    @can('update', $book)
    <a href="{{ route('books.edit', $book->id) }}" class="sub sub01">编辑</a>
    @endcan
    @can('destroy', $book)
    <form id="delete_form" action="{{ route('books.destroy', $book->id) }}" method="post" style="display: inline-block;width: 27%;">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <input type="button" onclick="layer.confirm('确认删除', function (){$('#delete_form').submit()})" value="删除" class="sub sub03" style="width: 100%;" />
    </form>
    @endcan
</div>
<div class="clear h02"></div>
@endsection