<?php

use App\Models\SuccessStoryLanguage;
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
        Schema::create('success_story_languages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('success_story_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('lang', 10)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        SuccessStoryLanguage::create([
            'success_story_id' => 1,
            'title'            => 'Success Story',
            'lang'             => 'en',
            'description'      => 'It took a long time for me to locate an excellent platform for my online schools. Faculty is a solid platform that
                                is simple to use and set up, as well as economical for those just getting started',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('success_story_languages');
    }
};
