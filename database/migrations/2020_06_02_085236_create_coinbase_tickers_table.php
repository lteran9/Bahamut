<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinbaseTickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coinbase_tickers', function (Blueprint $table) {
            $table->unsignedBigInteger('trade_id');
            $table->string('product_id');
            $table->string('side');
            $table->string('epoch');
            $table->string('sequence');
            $table->dateTime('timestamp');
            $table->double('size');
            $table->decimal('price');

            $table->timestamps();
            $table->primary('trade_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coinbase_tickers');
    }
}
