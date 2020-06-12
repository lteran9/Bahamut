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
         $table->id();
         $table->uuid('coinbase_id')->nullable(); // d0c5340b-6d6c-49d9-b567-48c4bfca13d2
         $table->double('price'); // 0.1000000
         $table->double('size'); // 0.0100000
         $table->string('product_id'); // BTC-USD
         $table->string('side'); // buy
         $table->string('stp')->nullable(); // self-trade-prevention
         $table->string('type')->nullable(); // limit
         $table->string('time_in_force')->nullable(); // GTC
         $table->boolean('post_only')->nullable(); // false
         $table->double('fill_fees')->nullable(); // 0.00000000000000
         $table->double('filled_size')->nullable(); // 0.000000
         $table->double('executed_value')->nullable(); // 0.000000000000
         $table->string('status')->nullable(); // pending
         $table->boolean('settled')->default(false); // false

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
      Schema::dropIfExists('orders');
   }
}
