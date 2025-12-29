<?php

use App\Models\Certificate;
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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->text('instructor_signature')->nullable();
            $table->bigInteger('instructor_signature_media_id')->unsigned()->nullable();
            $table->text('administrator_signature')->nullable();
            $table->bigInteger('administrator_signature_media_id')->unsigned()->nullable();
            $table->text('background_image')->nullable();
            $table->bigInteger('background_image_media_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Certificate::create([
            'id'        => 1,
            'course_id' => 1,
            'title'     => 'Web Develpoment Certificate',
            'body'      => 'It is a long established fact that a reader Will Smith will be distracted by the readable content of
            a page when looking at its layout.Laravel For Beginners - Become A Laravel Master - CMS
            Project It is a long established fact that a reader will be distracted by the readable content of a
            page when looking at its layout.',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
};
