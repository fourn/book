<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration 
{
	public function up()
	{
		Schema::create('transfers', function(Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status')->default(1);
            $table->integer('user_id')->index();
            $table->decimal('amount', 8, 2);
            $table->string('alipay');
            $table->integer('admin_id')->nullable();
            $table->timestamp('payed_at')->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('transfers');
	}
}
