<?php

use App\Models\SubjectLanguage;
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
        Schema::create('subject_languages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('lang', 10)->nullable();
            $table->unsignedBigInteger('subject_id');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
        $now  = now();

        $data = [
            [
                'title'            => 'Economy',
                'lang'             => 'en',
                'subject_id'       => 1,
                'meta_title'       => 'Economy',
                'meta_keywords'    => 'economy',
                'meta_description' => 'Economy',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'English',
                'lang'             => 'en',
                'subject_id'       => 2,
                'meta_title'       => 'Economy',
                'meta_keywords'    => 'economy',
                'meta_description' => 'Economy',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Biology',
                'lang'             => 'en',
                'subject_id'       => 3,
                'meta_title'       => 'Economy',
                'meta_keywords'    => 'economy',
                'meta_description' => 'Economy',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'title'            => 'Arts',
                'lang'             => 'en',
                'subject_id'       => 4,
                'meta_title'       => 'Economy',
                'meta_keywords'    => 'economy',
                'meta_description' => 'Economy',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];
        SubjectLanguage::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_languages');
    }
};
