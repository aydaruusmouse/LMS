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
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('package_solutions_id')->unsigned()->nullable();
            $table->double('price')->default(0.00);
            $table->integer('validity')->nullable();
            $table->integer('upload_limit')->nullable();
            $table->integer('add_limit')->nullable();
            $table->integer('bundle')->nullable();
            $table->tinyInteger('facilities')->default(1)->comment('1=yes, 0=no');
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
        Schema::dropIfExists('user_subscriptions');
    }
};
