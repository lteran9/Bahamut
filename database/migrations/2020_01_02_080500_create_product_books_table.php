<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_books', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->integer('sequence');
            $table->decimal('bid_price');
            $table->double('bid_size');
            $table->integer('bid_orders');
            $table->decimal('ask_price');
            $table->double('ask_size');
            $table->integer('ask_orders');

            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_books');
    }
}
