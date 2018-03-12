<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use App\Models\Order;

class OrderPolicy extends Policy
{
    public function pay(User $user, Order $order){
        $canBuy = $user->can('buy', $order->book);
        return $user->isAuthOf($order) && $canBuy && $order->status == 1;
    }

    public function show(User $user, Order $order){
        return $user->isAuthOf($order);
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
