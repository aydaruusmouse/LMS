<?php

use App\Models\PageLanguage;
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
        Schema::create('page_languages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->unsigned()->nullable();
            $table->string('lang', 50)->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        $data = [
            [
                'page_id'          => 404,
                'lang'             => 'en',
                'title'            => 'Page Not Found.',
                'content'          => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                'meta_title'       => 'Page Not Found.',
                'meta_keywords'    => 'Page Not Found.',
                'meta_description' => 'Page Not Found.',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'page_id'          => 403,
                'lang'             => 'en',
                'title'            => 'Permission Denied.',
                'content'          => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                'meta_title'       => 'Permission Denied..',
                'meta_keywords'    => 'Permission Denied..',
                'meta_description' => 'Permission Denied..',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'page_id'          => 500,
                'lang'             => 'en',
                'title'            => 'Internal Server Error..',
                'content'          => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                'meta_title'       => 'Internal Server Error..',
                'meta_keywords'    => 'Internal Server Error..',
                'meta_description' => 'Internal Server Error..',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ];

        PageLanguage::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_languages');
    }
};
