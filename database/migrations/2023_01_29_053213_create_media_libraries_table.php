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
        Schema::create('media_libraries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250)->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('storage', 30)->default('local');
            $table->string('type', 30)->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('size')->nullable();
            $table->text('original_file')->nullable();
            $table->text('image_variants')->nullable();
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
        Schema::dropIfExists('media_libraries');
    }
};
