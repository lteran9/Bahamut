<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('products', function (Blueprint $table) {
         $table->string('id'); // BTC-USD
         $table->string('base_currency'); // BTC
         $table->string('quote_currency'); // USD
         $table->double('base_increment');
         $table->double('base_min_size'); // 0.001
         $table->double('base_max_size'); // 10000.00
         $table->double('quote_increment'); // 0.01 
         $table->string('display_name'); // BTC/USD           
         $table->unsignedInteger('min_market_funds');
         $table->unsignedInteger('max_market_funds');
         $table->unsignedSmallInteger('rank')->default(0);
         $table->boolean('ignore')->default(false);
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
      Schema::dropIfExists('products');
   }
}
