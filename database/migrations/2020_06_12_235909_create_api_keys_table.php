<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->uuid('portfolio_id');
            $table->text('secret_key');
            $table->text('public_key');
            $table->text('passphrase');
            $table->boolean('view')->default(false);
            $table->boolean('trade')->default(false);
            $table->boolean('transfer')->default(false);

            $table->timestamps();

            $table->primary('portfolio_id');
            $table->foreign('portfolio_id')->references('id')->on('portfolios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('api_keys');
    }
}
