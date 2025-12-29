<?php

use App\Models\Language;
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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->index();
            $table->string('locale', 30)->unique()->index();
            $table->string('flag', 50)->nullable();
            $table->string('text_direction', 30)->default('ltr')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        Language::create([
            'name'   => 'English',
            'locale' => 'en',
            'flag'   => 'images/flags/us.png',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
};
