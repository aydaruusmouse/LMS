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
        Schema::create('instructor_payout_methods', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('instructor_id')->unsigned()->nullable();
            $table->string('payout_method')->nullable();
            $table->string('value')->nullable();
            $table->boolean('status')->default(0)->comment('1=active, 0=inactive');
            $table->boolean('is_default')->default(0)->comment('1=default, 0=not default');
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
        Schema::dropIfExists('instructor_payout_methods');
    }
};
