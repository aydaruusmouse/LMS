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
        Schema::create('applied_coupons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('instructor_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('trx_id')->nullable();
            $table->bigInteger('coupon_id')->nullable();
            $table->bigInteger('couponable_id')->unsigned()->nullable();
            $table->string('couponable_type')->nullable();
            $table->double('coupon_discount')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('applied_counpons');
    }
};
