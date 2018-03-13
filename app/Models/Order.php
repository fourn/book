<?php

namespace App\Models;

use App\Notifications\OrderConfirmed;
use App\Notifications\OrderFinish;
use App\Notifications\OrderPayed;
use App\Notifications\OrderSend;

class Order extends Model
{
    protected $fillable = ['message'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function seller(){
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function orderLogs(){
        return $this->hasMany(OrderLogs::class);
    }

    public function getStatusNameAttribute()
    {
        $statuses = array_pluck(config('custom.order.status'), 'name', 'id');
        return $statuses[$this->status];
    }

    public function payLink(){
        return route('order.pay', $this->id);
    }

    public function userLink(){
        return route('order.show', $this->id);
    }

    public function sellerLink(){
        return route('order.seller_show', $this->id);
    }

    public function createSn(){
        return date('YmdHis', time()).random_int(10, 99);
    }

    //创建订单
    public function createOrder(User $user ,Book $book, $message = null){
        $this->sn = $this->createSn();
        $this->message = $message;
        $this->book_id = $book->id;
        $this->seller_id = $book->user_id;
        $this->user_id = $user->id;
        $this->school_id = $book->school_id;
        $this->price = $book->price;
        $this->name = $book->name;
        $this->image = $book->image;
        $this->status = 1;
        $this->save();
        return $this;
    }

    //付款成功
    public function payed($out_sn, $payed_at, $payed_amount){
        $this->status = 2;
        $this->payed_amount = $payed_amount;
        $this->payed_at = $payed_at;
        $this->out_sn = $out_sn;
        $this->save();
        (new OrderLog())->log($this, OrderLog::OPERATOR_USER);
        $this->seller->notify(new OrderPayed($this));
        return $this;
    }

    //订单确认
    public function confirm(){
        $this->status = 3;
        $this->save();
        (new OrderLog())->log($this, OrderLog::OPERATOR_SELLER);
        $this->user->notify(new OrderConfirmed($this));
        return $this;
    }

    //书本送达
    public function send(){
        $this->status = 4;
        $this->save();
        (new OrderLog())->log($this, OrderLog::OPERATOR_SELLER);
        $this->user->notify(new OrderSend($this));
        return $this;
    }

    //收货
    public function finish(){
        $this->status = 5;
        $this->save();
        (new OrderLog())->log($this, OrderLog::OPERATOR_USER);
        $this->user->notify(new OrderFinish($this));
        return $this;
    }

    //取消
    public function cancel(){
        $this->status = 6;
        $this->save();
        (new OrderLog())->log($this, OrderLog::OPERATOR_ADMIN);
        return $this;
    }

    //失效
    public function out(){
        $this->status = 7;
        $this->save();
        (new OrderLog())->log($this, OrderLog::OPERATOR_SYSTEM);
        return $this;
    }
}
