<?php

namespace App\Models;

class Order extends Model
{
    protected $fillable = ['message'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function seller(){
        return $this->belongsTo(User::class);
    }

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function school(){
        return $this->belongsTo(School::class);
    }

    public function createSn(){
        return date('YmdHis', time()).random_int(1000, 9999);
    }

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

    public function payLink(){
        return route('order.pay', $this->id);
    }

    //付款成功方法
    public function payed($out_sn, $payed_at, $payed_amount){
        //改订单状态
        $this->status = 2;
        $this->payed_amount = $payed_amount;
        $this->payed_at = $payed_at;
        $this->out_sn = $out_sn;
        $this->save();
        //改书本状态
        $this->book()->update(['status'=>4]);
        //记录

        //分钱

        return true;
    }

    public function getStatusNameAttribute()
    {
        $statuses = array_pluck(config('custom.order.status'), 'name', 'id');
        return $statuses[$this->status];
    }
}
