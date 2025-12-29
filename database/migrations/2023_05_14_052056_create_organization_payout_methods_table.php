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
        Schema::create('organization_payout_methods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('organization_id')->unsigned()->nullable();
            $table->string('payout_method')->nullable();
            $table->string('value')->nullable();
            $table->boolean('is_default')->default(0)->comment('1=default, 0=not default');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->boolean('status')->default(0)->comment('1=active, 0=inactive');
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
        Schema::dropIfExists('organization_payout_methods');
    }
};
