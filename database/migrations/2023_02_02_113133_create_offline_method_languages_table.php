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
        Schema::create('offline_method_languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lang', 10)->nullable();
            $table->string('instructions')->nullable();
            $table->bigInteger('offline_method_id')->unsigned()->nullable();
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
        Schema::dropIfExists('offline_method_languages');
    }
};
