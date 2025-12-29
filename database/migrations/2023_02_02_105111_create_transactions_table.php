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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('type')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('come_from')->nullable();
            $table->text('description')->nullable();
            $table->text('file')->nullable();
            $table->double('amount')->default(0.00);
            $table->text('payment_details')->nullable();
            $table->string('trx_id')->nullable();
            $table->date('date')->nullable();
            $table->bigInteger('transactionable_id')->unsigned()->nullable();
            $table->string('transactionable_type')->nullable();
            $table->string('status')->default('unpaid')->comment('paid,unpaid');
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
        Schema::dropIfExists('transactions');
    }
};
