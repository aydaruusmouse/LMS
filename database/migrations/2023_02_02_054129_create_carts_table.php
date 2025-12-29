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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->text('instructor_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('price')->default(0.00);
            $table->double('discount')->default(0.00);
            $table->string('trx_id')->nullable();
            $table->bigInteger('coupon_id')->nullable();
            $table->double('coupon_discount')->default(0.00);
            $table->double('tax')->default(0.00);
            $table->double('sub_total')->default(0.00);
            $table->double('total_amount')->default(0.00);
            $table->double('shipping_cost')->default(0.00);
            $table->bigInteger('cartable_id')->unsigned()->nullable();
            $table->string('cartable_type')->nullable();
            $table->tinyInteger('is_buy_now')->default(0)->comment('1=buy now available, 0=not available');
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
        Schema::dropIfExists('carts');
    }
};
