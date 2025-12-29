<?php

use App\Models\CouponLanguage;
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
        Schema::create('coupon_languages', function (Blueprint $table) {
            $table->id();
            $table->string('lang', 50)->nullable();
            $table->string('title');
            $table->bigInteger('coupon_id')->unsigned()->nullable();
            $table->timestamps();
        });

        CouponLanguage::create([
            'id'        => 1,
            'lang'      => 'en',
            'title'     => 'Spagreen',
            'coupon_id' => 1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_languages');
    }
};
