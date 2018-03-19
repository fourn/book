<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Book::class, function (Faker $faker) {
    $sentence = $faker->sentence();

    // 随机取一个月以内的时间
    $updated_at = $faker->dateTimeThisMonth();
    // 传参为生成最大时间不超过，创建时间永远比更改时间要早
    $created_at = $faker->dateTimeThisMonth($updated_at);

    $original_price = $faker->randomFloat(2, 0, 200);
    $price = $faker->randomFloat(2, 0, $original_price);

    return [
        'sn' => $faker->isbn10,
        'name' => $faker->name,
        'author' => $faker->name,
        'press' => $faker->name,
        'published_at' => $faker->year(),
        'original_price'=>$original_price,
        'price'=>$price,
        'description'=>$sentence,
        'status'=>2,
        'is_show'=>1,
        'is_recommend'=>1,
        'created_at'=>$created_at,
        'updated_at'=>$updated_at,
    ];
    //image,used
});
