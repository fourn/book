<?php

namespace App\Observers;

use App\Models\Order;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class OrderObserver
{
    public function creating(Order $order)
    {
        //
    }

    public function updating(Order $order)
    {
        //
    }
}