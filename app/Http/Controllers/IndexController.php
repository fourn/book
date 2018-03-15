<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
    public function memberIndex(Order $order){
        $user = Auth::user();
        $statuses = config('custom.order.status');

        //统计买书卖书数量
        $userOrderCount = $order->where('user_id', $user->id)->where('status', 5)->count();
        $sellerOrderCount = $order->where('seller_id', $user->id)->where('status', 5)->count();

        //统计订单数量
        $orderStatusCount[1] = $order->where('user_id', $user->id)->where('status', 1)->count();
        $orderStatusCount[4] = $order->where('user_id', $user->id)->where('status', 4)->count();

        //卖家
        $orderStatusCount[2] = $order->where('seller_id', $user->id)->where('status', 2)->count();
        $orderStatusCount[3] = $order->where('seller_id', $user->id)->where('status', 3)->count();
        $hasSell = $order->where('seller_id', $user->id)->count();


        return view('index.member_index', compact('user', 'statuses', 'userOrderCount', 'sellerOrderCount', 'orderStatusCount', 'hasSell'));
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
