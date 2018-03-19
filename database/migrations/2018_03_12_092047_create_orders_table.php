<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration 
{
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->string('sn')->index();
            $table->text('message')->nullable();
            $table->integer('book_id')->index();
            $table->integer('seller_id')->index();
            $table->integer('user_id')->index();
            $table->integer('school_id')->index();
            $table->decimal('price', 8, 2);
            $table->decimal('payed_amount', 8, 2)->default(0);
            $table->timestamp('payed_at')->nullable();
            $table->string('out_sn')->nullable();
            $table->string('name');
            $table->text('image');
            $table->tinyInteger('status')->index();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
