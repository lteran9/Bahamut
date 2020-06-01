<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id'); // d0c5340b-6d6c-49d9-b567-48c4bfca13d2
            $table->double('price'); // 0.1000000
            $table->double('size'); // 0.0100000
            $table->string('product_id'); // BTC-USD
            $table->string('side'); // buy
            $table->string('stp'); // dc
            $table->string('type'); // limit
            $table->string('time_in_force'); // GTC
            $table->boolean('post_only'); // false
            $table->double('fill_fees'); // 0.00000000000000
            $table->double('filledz_size'); // 0.000000
            $table->double('executed_value'); // 0.000000000000
            $table->string('status'); // pending
            $table->boolean('settled'); // false
          
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
