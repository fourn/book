<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    //

    public function show(Article $article){
        $article->increment('views', 1);
        return view('articles.show', compact('article'));
    }
}
