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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->string('type')->nullable();
            $table->string('for')->default('course');
            $table->string('code')->nullable();
            $table->text('image')->nullable();
            $table->bigInteger('coupon_media_id')->unsigned()->nullable();
            $table->string('discount_type')->nullable();
            $table->double('discount')->default(0.00);
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('course_ids')->nullable();
            $table->string('instructor_ids')->nullable();
            $table->string('category_ids')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
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
        Schema::dropIfExists('coupons');
    }
};
