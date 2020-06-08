<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('currencies', function (Blueprint $table) {
         $table->string('id'); // BTC
         $table->string('name'); // Bitcion
         $table->double('min_size'); // 0.00000001

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
      Schema::dropIfExists('currencies');
   }
}
