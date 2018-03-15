<?php

use Illuminate\Database\Seeder;
use App\Models\Transfer;

class TransfersTableSeeder extends Seeder
{
    public function run()
    {
        $transfers = factory(Transfer::class)->times(50)->make()->each(function ($transfer, $index) {
            if ($index == 0) {
                // $transfer->field = 'value';
            }
        });

        Transfer::insert($transfers->toArray());
    }

}

