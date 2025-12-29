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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('instructor_id')->unsigned()->nullable();
            $table->bigInteger('organization_id')->unsigned()->nullable();
            $table->string('category_ids')->nullable();
            $table->string('available_format')->nullable();
            $table->double('price')->default(0.00);
            $table->string('publication')->nullable();
            $table->string('current_stock')->nullable();
            $table->text('description')->nullable();
            $table->text('specification')->nullable();
            $table->text('thumbnail')->nullable();
            $table->string('discount_type')->nullable();
            $table->double('discount')->default(0.00);
            $table->dateTime('discount_start_at')->nullable();
            $table->dateTime('discount_end_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->tinyInteger('is_free')->default(0)->comment('1=free, 0=not free');
            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->double('total_rating')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
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
        Schema::dropIfExists('books');
    }
};
