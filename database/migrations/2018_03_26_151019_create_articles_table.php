<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('alias')->index()->comment('标识');
            $table->string('name')->comment('名称');
            $table->string('title')->comment('标题');
            $table->text('image')->nullable()->comment('图片');
            $table->text('content')->nullable()->comment('详情');
            $table->string('link')->nullable()->comment('链接');
            $table->tinyInteger('is_show')->default(1)->comment('是否显示');
            $table->integer('views')->default(0)->comment('浏览量');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
