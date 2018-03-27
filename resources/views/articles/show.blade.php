@extends('layouts.app')
@section('body', '')
@section('content')
    <header class="comhead">
        <h2>{{ $article->title }}</h2>
        <a href="javascript:history.back()" class="back"></a>
    </header>
    <div class="comheadbg"></div>

    <section class="article">
        <span class="s1">发布时间：{{ $article->created_at->format('Y年m月d日') }}</span>
        <span class="s2">浏览量：{{ $article->views }}</span>
    </section>

    <div class="content">
        {!! $article->content !!}
    </div>




@endsection