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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('type');
            $table->string('default_for');
            $table->double('opening_balance')->default(0.00);
            $table->string('description')->nullable();
            $table->double('balance')->default(0.00);
            $table->double('withdrawal_amount')->default(0.00);
            $table->boolean('status')->default(1);
            $table->boolean('is_deletable')->default(1);
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
        Schema::dropIfExists('accounts');
    }
};
