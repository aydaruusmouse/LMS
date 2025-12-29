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
        Schema::create('offline_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('instructions')->nullable();
            $table->string('type')->nullable();
            $table->text('image')->nullable();
            $table->bigInteger('offline_method_media_id')->unsigned()->nullable();
            $table->text('bank_details')->nullable();
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
        Schema::dropIfExists('offline_methods');
    }
};
