<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mobile')->unique();
            $table->string('password');
            $table->decimal('balance', 8, 2)->default(0.00);
            $table->string('alipay')->nullable();
            $table->text('avatar')->nullable()->comment('头像');
            $table->tinyInteger('gender')->comment('性别')->default(0);
            $table->timestamp('last_actived_at')->nullable()->comment('近期活跃');
            $table->integer('notification_count')->default(0)->comment('通知数量');
            $table->integer('school_id')->index()->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
