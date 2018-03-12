<?php

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Book;
use App\Models\User;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $books = Book::whereIn('user_id', [4,5,6])->get()->toArray();
        $user_ids = [1,2,3];
        $statuses = array_pluck(config('custom.order.status'), 'id');
        $faker = app(Faker\Generator::class);
        $orders = factory(Order::class)->times(50)->make()->each(function ($order, $index)
        use ($books, $user_ids, $statuses, $faker)
        {
            $book = $faker->randomElement($books);
            $order->sn = $order->createSn();
            $order->book_id = $book['id'];
            $order->seller_id = $book['user_id'];
            $order->user_id = $faker->randomElement($user_ids);
            $order->school_id = $book['school_id'];
            $order->price = $book['price'];
            $order->payed_amount = $book['price'];
            $order->payed_at = $faker->dateTimeThisMonth;
            $order->out_sn = $faker->numberBetween(111111,999999);
            $order->name = $book['name'];
            $order->image = $book['image'];
            $order->status = $faker->randomElement($statuses);
        });

        Order::insert($orders->toArray());
    }



}

