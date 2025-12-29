<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization_id')->unsigned()->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('phone_country_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_type', 30)->nullable();
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->double('amount')->default(0.00);
            $table->string('note')->nullable();
            $table->string('payout_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->boolean('status')->default(0)->comment('0=pending, 1=approved, 2="completed, 3=declined');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payouts');
    }
};
