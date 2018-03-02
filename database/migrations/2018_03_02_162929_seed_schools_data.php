<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedSchoolsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $schools = [
            [
                'name'=>'云南大学',
                'depot'=>'云南大学东二院门卫',
                'working_time'=>'7:00 ~ 20:00',
                'worker'=>'李四',
                'mobile'=>'13800000000',
            ],
            [
                'name'=>'云南名族大学',
                'depot'=>'惠泽园1栋101小卖铺',
                'working_time'=>'7:00 ~ 20:00',
                'worker'=>'张三',
                'mobile'=>'13800000000',
            ],
            [
                'name'=>'昆明理工大学',
                'depot'=>'锦华苑食堂一楼角落',
                'working_time'=>'7:00 ~ 20:00',
                'worker'=>'王五',
                'mobile'=>'13800000000',
            ],
        ];
        DB::table('schools')->insert($schools);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('schools')->truncate();
    }
}
