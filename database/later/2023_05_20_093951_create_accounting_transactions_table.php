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
        Schema::create('accounting_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('account_id')->nullable();
            $table->unsignedBigInteger('bank_account_id')->nullable();
            $table->string('type');
            $table->dateTime('date');
            $table->string('payment_method');
            $table->double('amount')->default(0);
            $table->text('description')->nullable();
            $table->text('file')->nullable();
            $table->string('transaction_id');
            $table->string('reference')->nullable();
            $table->unsignedBigInteger('transactionable_id');
            $table->string('transactionable_type');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('accounting_transactions');
    }
};
