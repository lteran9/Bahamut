<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_tickers', function (Blueprint $table) {
            $table->unsignedBigInteger('trade_id');
            $table->string('product_id');
            $table->decimal('price');
            $table->double('size');
            $table->decimal('bid');
            $table->decimal('ask');
            $table->double('volume');
            $table->dateTime('time');

            $table->timestamps();

            $table->primary('trade_id');
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
        Schema::dropIfExists('product_tickers');
    }
}
