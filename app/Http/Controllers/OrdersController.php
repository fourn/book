<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use EasyWeChat;
use Illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('notify');
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
	public function sellerIndex(Request $request){
        $user = Auth::user();
        $status = $request->status;
        $orders = $user->sellOrders()
            ->when($status, function ($query) use ($status){
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->with('seller')
            ->get();
        $statuses = config('custom.order.status');
        return view('orders.seller_index', compact('orders', 'statuses'));
    }

    //买家详情
    public function show(Order $order)
    {
        try {
            $this->authorize('show', $order);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '没有访问权限');
            return redirect()->to(route('index'));
        }
        $school = $order->school;
        $seller = $order->seller;
        $logs = $order->orderLogs;
        return view('orders.show', compact('order', 'school', 'seller', 'logs'));
    }

    //卖家详情
    public function sellerShow(Order $order){
        try {
            $this->authorize('seller_show', $order);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '没有访问权限');
            return redirect()->to(route('index'));
        }
        $school = $order->school;
        $buyer = $order->user;
        $logs = $order->orderLogs;
        return view('orders.seller_show', compact('order', 'school', 'buyer', 'logs'));
    }

    //确认下单
	public function create(Order $order, Book $book)
	{
        try {
            $this->authorize('buy', $book);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '当前书本不可购买');
            return redirect()->to(route('index'));
        }
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
        try {
            $this->authorize('buy', $book);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '下单失败，当前书本不可购买');
            return redirect()->to(route('index'));
        }
        $order = $order->createOrder(Auth::user(), $book, $request->message);
        return redirect()->to($order->payLink());
	}

	//订单发起支付
	public function pay(Order $order){
        try {
            $this->authorize('pay', $order);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '发起支付失败，当前书本不可购买');
            return redirect()->to(route('index'));
        }
        $payment = EasyWeChat::payment();
        $orderData = [
            'body' => $order->name,
            'out_trade_no' => $order->sn,
            'total_fee' => (int)($order->price * 100),
            'notify_url' => route('order.notify'), // 支付结果通知网址
            'trade_type' => 'JSAPI',
            'openid' => $order->user->openid,
        ];
        Log::alert('orderData', $orderData);
        $result = $payment->order->unify($orderData);
        Log::alert('unifyOrder', $result);
        $jssdk = $payment->jssdk;
        $json = $jssdk->bridgeConfig($result['prepay_id']);
        return view('orders.pay', compact('order', 'json'));
    }

    public function notify(){
        $payment = EasyWeChat::payment();
        $response = $payment->handlePaidNotify(function ($message, $fail) {
            Log::alert('notify_message', $message);
            if ($message['return_code'] === 'SUCCESS') { // 与微信通信成功
                if (array_get($message, 'result_code') === 'SUCCESS') {
                    $sql = Order::where('sn', '=', $message['out_trade_no'])->firstOrFail()->toSql();
                    $order = Order::where('sn', '=', $message['out_trade_no'])->firstOrFail();
                    $order->payed($message['transaction_id'],
                        Carbon::now()->toDateTimeString(),
                        $message['total_fee']/100);
                } elseif (array_get($message, 'result_code') === 'FAIL') {
                    // 用户支付失败
                }
                return true;
            } else {
                return $fail('通信失败，请稍后再通知我');
            }
        });
        return $response;
    }

    //模拟支付
    public function fakePay(Request $request){
        if(config('order_fake_pay') != 'on')return abort(404);
        $order = Order::where('sn' ,$request->sn)->firstOrFail();
        try {
            $this->authorize('pay', $order);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '支付失败，当前书本不可购买');
            return redirect()->to(route('index'));
        }
        $order->payed($order->createSn(), Carbon::now()->toDateTimeString(), $order->price);
        return redirect()->to($order->userLink())->with('message', '支付成功');
    }

    //卖家确认
    public function confirm(Order $order){
        try {
            $this->authorize('confirm', $order);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '没有操作权限');
            return redirect()->to(route('index'));
        }
        $order->confirm();
        return redirect()->to($order->sellerLink())->with('message', '订单已确认！');
    }

    //卖家送达
    public function send(Order $order){
        try {
            $this->authorize('send', $order);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '没有操作权限');
            return redirect()->to(route('index'));
        }
        $order->send();
        return redirect()->to($order->sellerLink())->with('message', '书本已确认送达！');
    }

    //买家收货+转账
    public function get(Order $order){
        try {
            $this->authorize('get', $order);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '没有操作权限');
            return redirect()->to(route('index'));
        }
        $order->finish();

        $order->commission();

        return redirect()->to($order->userLink())->with('message', '确认收货成功！');
    }

    //买家取消
    public function cancel(Order $order){
        try {
            $this->authorize('cancel', $order);
        } catch (AuthorizationException $e) {
            session()->flash('danger', '没有操作权限');
            return redirect()->to(route('index'));
        }
        $order->cancel($order::OPERATOR_USER);
        return redirect()->to($order->userLink())->with('message', '订单已取消！');
    }




}