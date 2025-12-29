<?php

use App\Models\Subject;
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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('image')->nullable();
            $table->text('image_media_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
            $table->string('type')->default('course');
            $table->timestamps();
        });
        $now  = now();

        $data = [
            [
                'title'            => 'Economy',
                'slug'             => 'economy',
                'meta_title'       => 'Economy',
                'meta_keywords'    => 'economy',
                'meta_description' => 'Economy',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],

            [
                'title'            => 'English',
                'slug'             => 'english',
                'meta_title'       => 'English',
                'meta_keywords'    => 'english',
                'meta_description' => 'English',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Biology',
                'slug'             => 'biology',
                'meta_title'       => 'Biology',
                'meta_keywords'    => 'biology',
                'meta_description' => 'Biology',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Arts',
                'slug'             => 'arts',
                'meta_title'       => 'Arts',
                'meta_keywords'    => 'arts',
                'meta_description' => 'Arts',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];
        Subject::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
