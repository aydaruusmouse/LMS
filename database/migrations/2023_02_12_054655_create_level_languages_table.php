<?php

use App\Models\LevelLanguage;
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
        Schema::create('level_languages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('level_id')->unsigned()->nullable();
            $table->string('lang', 50)->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
        });
        LevelLanguage::create([
            'level_id' => 1,
            'lang'     => 'en',
            'title'    => 'beginner',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_languages');
    }
};
