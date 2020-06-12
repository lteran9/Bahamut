<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('portfolios', function (Blueprint $table) {
         $table->uuid('id');
         $table->uuid('coinbase_id');
         $table->string('name');
         $table->boolean('active');
         $table->dateTime('coinbase_created_at');

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
      Schema::dropIfExists('portfolios');
   }
}
