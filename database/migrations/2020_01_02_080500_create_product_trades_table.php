<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTradesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('product_trades', function (Blueprint $table) {
         $table->string('product_id');
         $table->unsignedInteger('trade_id'); // 74
         $table->dateTime('time'); // 2014-11-07T22:19:28.578544Z
         $table->decimal('price'); // 10.00000
         $table->double('size'); // 0.010000
         $table->string('side');  // buy

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
      Schema::dropIfExists('product_trades');
   }
}
