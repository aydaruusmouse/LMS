<?php

use App\Models\SuccessStory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('success_stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('description');
            $table->text('image')->nullable();
            $table->bigInteger('success_media_id')->unsigned()->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
            $table->timestamps();
        });

        SuccessStory::create([
            'title'       => 'Success Story',
            'slug'        => 'Success Story',
            'description' => 'It took a long time for me to locate an excellent platform for my online schools. Faculty is a solid platform that
                                is simple to use and set up, as well as economical for those just getting started',
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('success_stories');
    }
};
