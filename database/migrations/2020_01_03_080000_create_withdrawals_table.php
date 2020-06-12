<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
   /**
    * Run the migrations.
    *
    * @return void
    */
   public function up()
   {
      Schema::create('withdrawals', function (Blueprint $table) {
         $table->id();
         $table->string('currency'); // BTC
         $table->decimal('amount'); // 0.003456
         $table->uuid('coinbase_id')->nullable();
         $table->dateTime('payout_at')->nullable();
         $table->uuid('wallet_id');

         $table->timestamps();
         
         $table->foreign('currency')->references('id')->on('currencies');
         $table->foreign('wallet_id')->references('id')->on('wallets');
      });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
      Schema::dropIfExists('withdrawals');
   }
}
