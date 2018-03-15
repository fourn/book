<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransferRequest;
use Auth;

class TransfersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

	public function create()
	{
	    $user = Auth::user();
		return view('transfers.create', compact('user'));
	}

	public function store(TransferRequest $request, Transfer $transfer)
	{
	    $user = Auth::user();
	    if($user->balance < $request->amount)return abort(404);
        $transfer->fill($request->all());
        $transfer->user_id = $user->id;
        if($transfer->save()){
            $user->cutBalance($request->amount, 2, $transfer->toArray());
            $user->update(['alipay'=>$request->alipay]);
        }
		return redirect()->route('account.index')->with('message', '提现成功，请等待打款！');
	}

}