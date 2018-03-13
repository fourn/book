<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //买家列表
	public function index(Request $request)
	{
	    $user = Auth::user();
	    $status = $request->status;
		$orders = $user->orders()
            ->when($status, function ($query) use ($status){
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->with('seller')
            ->get();
		$statuses = config('custom.order.status');
		return view('orders.index', compact('orders', 'statuses'));
	}

	//卖家列表
	public function sellerIndex(){
        $orders = Order::paginate();
        return view('orders.index', compact('orders'));
    }

    //买家详情
    public function show(Order $order)
    {
        $this->authorize('show', $order);
        $school = $order->school;
        $seller = $order->seller;
        return view('orders.show', compact('order', 'school', 'seller'));
    }

    //卖家详情
    public function sellerShow(Order $order){
        return view('orders.show', compact('order'));
    }

    //确认下单
	public function create(Order $order, Book $book)
	{
        $this->authorize('buy', $book);
        $school = $book->school;
        $seller = $book->user;
		return view('orders.create', compact('order', 'school', 'seller', 'book'));
	}

	//订单创建
	public function store(Request $request, Order $order)
	{
	    $this->validate($request, [
	        'book_id'=>'required|numeric',
            'message'=>'nullable|max:255',
        ]);
		$book_id = $request->book_id;
		$book = Book::findOrFail($book_id);
		$this->authorize('buy', $book);
        $order = $order->createOrder(Auth::user(), $book, $request->message);
        return redirect()->to($order->payLink());
	}

	//订单发起支付
	public function pay(Order $order){
        $this->authorize('pay', $order);
        return view('orders.pay', compact('order'));
    }

    public function fakePay(Request $request){
        if(config('order_fake_pay') != 'on')return abort(404);
        $order = Order::where('sn' ,$request->sn)->firstOrFail();
        $this->authorize('pay', $order);
        $order->payed($order->createSn(), Carbon::now()->toDateTimeString(), $order->price);
        return redirect()->route('order.show', $order->id);
    }






}