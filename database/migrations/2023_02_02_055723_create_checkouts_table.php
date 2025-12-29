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
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->text('billing_address')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('trx_id')->nullable();
            $table->double('sub_total')->default(0.00);
            $table->double('tax')->default(0.00);
            $table->double('discount')->default(0.00);
            $table->double('shipping_cost')->default(0.00);
            $table->double('coupon_discount')->default(0.00);
            $table->double('system_commission')->default(0.00);
            $table->double('organization_commission')->default(0.00);
            $table->double('total_amount')->default(0.00);
            $table->double('payable_amount')->default(0.00);
            $table->string('invoice_no')->nullable();
            $table->dateTime('invoice_date')->nullable();
            $table->string('payment_type')->nullable();
            $table->text('payment_details')->nullable();
            $table->boolean('status')->default(0)->comment('1 => paid, 0 => unpaid');
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
        Schema::dropIfExists('checkouts');
    }
};
