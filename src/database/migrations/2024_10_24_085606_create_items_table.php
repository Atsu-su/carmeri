<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->string('name');
            $table->unsignedBigInteger('price');
            $table->string('description');
            $table->string('brand');
            $table->unsignedBigInteger('condition_id');
            $table->boolean('on_sale')->default(true)->comment('1: on sale, 0: sold out');
            $table->string('image');
            $table->timestamps();

            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('condition_id')->references('id')->on('conditions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
