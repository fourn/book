<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AccountsController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $income = $user->sellOrders()->where('status', 5)->sum('commission_user');
        return view('accounts.index', compact('income'));
    }

    public function logs(){
        $user = Auth::user();
        $logs = $user->accounts()->orderBy('created_at', 'desc')->get();
        return view('accounts.logs', compact('logs'));
    }
}
