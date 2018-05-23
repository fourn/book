@extends('layouts.app')
@section('content')
    <header class="comhead">
        <h2>文章详情</h2>
        <a href="javascript:history.back()" class="back"></a>
    </header>
    <div class="comheadbg"></div>
    <article class="essaybox">
        <p class="p1">{{ $article->title }}</p>
        <p class="p2">发布时间：{{ $article->created_at->format('Y年m月d日') }} 浏览量：{{ $article->views }}</p>
        {!! $article->article_content !!}
    </article>
@endsection