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
        Schema::create('bundle_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->bigInteger('organization_id')->unsigned()->nullable();
            $table->bigInteger('instructor_id')->unsigned()->nullable();
            $table->string('course_ids')->nullable();
            $table->tinyInteger('is_free')->default(0)->comment('1=free, 0=not free');
            $table->double('price')->default(0.00);
            $table->double('discount')->default(0.00);
            $table->string('discount_type')->nullable();
            $table->string('discount_period')->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('bundle_media_id')->nullable();
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
        Schema::dropIfExists('bundle_courses');
    }
};
