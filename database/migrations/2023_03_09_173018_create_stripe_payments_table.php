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
        Schema::create('stripe_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('payment_id');
            $table->string('user_email');
            $table->float('amount', 10, 2);
            $table->string('currency');
            $table->string('token');
            $table->text('description');
            $table->string('payment_status');
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
        Schema::dropIfExists('stripe_payments');
    }
};
