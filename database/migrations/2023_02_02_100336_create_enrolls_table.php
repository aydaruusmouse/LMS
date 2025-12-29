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
        Schema::create('enrolls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('checkout_id')->unsigned()->nullable();
            $table->double('price')->default(0.00);
            $table->integer('quantity')->default(0);
            $table->double('coupon_discount')->default(0.00);
            $table->double('discount')->default(0.00);
            $table->double('tax')->default(0.00);
            $table->double('shipping_cost')->default(0.00);
            $table->double('sub_total')->default(0.00);
            $table->bigInteger('enrollable_id')->unsigned()->nullable();
            $table->text('complete_details')->nullable();
            $table->integer('complete_count')->default(0);
            $table->string('enrollable_type')->nullable();

            $table->double('system_commission')->default(0.00);

            $table->double('organization_commission')->default(0.00);

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
        Schema::dropIfExists('enrolls');
    }
};
