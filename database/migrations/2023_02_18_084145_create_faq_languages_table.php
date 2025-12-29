<?php

use App\Models\FaqLanguage;
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
        Schema::create('faq_languages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('faq_id')->unsigned()->nullable();
            $table->string('lang')->nullable();
            $table->string('question')->nullable();
            $table->string('answer')->nullable();
            $table->timestamps();
        });
        FaqLanguage::create([
            'faq_id'   => 1,
            'lang'     => 'en',
            'question' => 'Is it paid course?',
            'answer'   => 'Please check purchase price',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faq_languages');
    }
};
