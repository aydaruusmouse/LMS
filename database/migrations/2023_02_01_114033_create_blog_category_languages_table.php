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
        Schema::create('blog_category_languages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('lang', 10)->nullable();
            $table->bigInteger('blog_category_id')->unsigned()->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        \App\Models\BlogCategoryLanguage::create([
            'title'            => 'Mathematics',
            'blog_category_id' => 1,
            'lang'             => 'en',
            'meta_title'       => 'Mathematics',
            'meta_keywords'    => 'mathematics',
            'meta_description' => 'Mathematics',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_category_languages');
    }
};
