<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>[
            'index'
        ]]);
    }

    //自定义页面逻辑处理
    public function index(){
        return view('index.index');
    }

    public function memberIndex(){
        $user = Auth::user();
        return view('index.member_index', compact('user'));
    }
}
