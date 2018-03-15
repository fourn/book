<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;

class OrderPolicy extends Policy
{

    //查看详情
    public function show(User $user, Order $order){
        return $user->isAuthOf($order);
    }

    public function seller_show(User $user, Order $order){
        return $user->id == $order->seller_id;
    }

    //买家发起支付
    public function pay(User $user, Order $order){
        $canBuy = $user->can('buy', $order->book);
        return $user->isAuthOf($order) and $canBuy and $order->status == 1;
    }

    //卖家确认订单
    public function confirm(User $user, Order $order){
        return $user->id == $order->seller_id and $order->status == 2;
    }

    //卖家确认送达
    public function send(User $user, Order $order){
         return $user->id == $order->seller_id and $order->status == 3;
    }

    //买家取书
    public function get(User $user, Order $order){
        return $user->isAuthOf($order) and $order->status == 4;
    }

    //买家取消购买
    public function cancel(User $user, Order $order){
        return $user->isAuthOf($order) and $order->status == 1;
    }

    public function update(User $user, Order $order)
    {
        // return $order->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Order $order)
    {
        return true;
    }
}
