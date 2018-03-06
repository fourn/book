<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration 
{
	public function up()
	{
		Schema::create('books', function(Blueprint $table) {
            $table->increments('id');
            $table->string('sn');
            $table->string('name')->index();
            $table->text('image');
            $table->string('author');
            $table->string('press');
            $table->year('published_at');
            $table->tinyInteger('used');
            $table->decimal('original_price', 8, 2);
            $table->decimal('price', 8, 2);
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_show')->default(2);
            $table->tinyInteger('is_recommend')->default(2);
            $table->integer('user_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('school_id')->unsigned()->index();
            $table->integer('admin_id')->unsigned()->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('books');
	}
}
