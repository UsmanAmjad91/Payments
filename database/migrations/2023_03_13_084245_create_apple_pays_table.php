<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apple_pays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id')->nullable(true);
            $table->string('payment_id')->nullable(true);
            $table->string('user_email')->nullable(true);
            $table->float('amount', 10, 2)->nullable(true);
            $table->string('currency')->nullable(true);
            $table->string('token')->nullable(true);
            $table->text('description')->nullable(true);
            $table->string('payment_status')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apple_pays');
    }
};
