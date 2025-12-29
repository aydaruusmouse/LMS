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
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('section_id');
            $table->string('title');
            $table->string('slug');
            $table->string('resource_type');
            $table->string('source');
            $table->string('source_data');
            $table->time('duration')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('image_media_id')->nullable();
            $table->tinyInteger('is_free')->default(0)->comment('1=free, 0=not free');
            $table->integer('order_no')->default(0);
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
        Schema::dropIfExists('resources');
    }
};
