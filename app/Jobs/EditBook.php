<?php

namespace App\Jobs;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class EditBook implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $book;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        //
        $this->book = $book;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //书本变动引起订单变动
        //只影响尚未付款的订单
        $orders = Order::where('book_id', $this->book->id)
            ->where('status', 1)
            ->get();
        if (count($orders)) {
            foreach ($orders as $order) {
                $order->out();
            }
        }
    }
}
