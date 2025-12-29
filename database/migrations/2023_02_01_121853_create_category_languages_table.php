<?php

use App\Models\CategoryLanguage;
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
        Schema::create('category_languages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('lang', 10)->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        $now  = now();

        $data = [
            [
                'title'       => 'Web Design',
                'lang'        => 'en',
                'category_id' => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Web Development',
                'lang'        => 'en',
                'category_id' => 2,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
            [
                'title'       => 'Flutter',
                'lang'        => 'en',
                'category_id' => 3,
                'created_at'  => $now,
                'updated_at'  => $now,
            ],
        ];

        CategoryLanguage::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catgeory_languages');
    }
};
