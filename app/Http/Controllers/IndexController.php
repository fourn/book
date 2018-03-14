<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>[
            'index', 'setSchool'
        ]]);
    }

    //首页
    public function index(){
        if(session()->has('school_id')){
            $sessionSchool = School::find(session('school_id'));
        }
        return view('index.index', compact('sessionSchool'));
    }

    //会员中心首页
    public function memberIndex(){
        $user = Auth::user();
        $statuses = config('custom.order.status');
        return view('index.member_index', compact('user', 'statuses'));
    }

    //选择学校页面
    public function setSchool($school_id){
        session(['school_id'=>$school_id]);
        if(Auth::check()){
            $user = Auth::user();
            if(!$user->school_id){
                $user->school_id = $school_id;
                $user->save();
            }
        }
        return redirect()->intended(route('index'));
    }
}
