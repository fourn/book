<?php

use Faker\Generator as Faker;
use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;
    $now = Carbon::now()->toDateTimeString();

    return [
        'name' => $faker->name,
        'mobile' => $faker->unique()->phoneNumber,
        'password' => $password ?: $password = bcrypt('111111'),
        'last_actived_at'=>$now,
        'remember_token' => str_random(10),
        'created_at' => $now,
        'updated_at' => $now,
    ];
});
