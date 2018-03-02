<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name'        => '课本教材',
                'description' => '分享创造，分享发现',
            ],
            [
                'name'        => '课外读物',
                'description' => '开发技巧、推荐扩展包等',
            ],
            [
                'name'        => '考研书籍',
                'description' => '请保持友善，互帮互助',
            ],
        ];
        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
