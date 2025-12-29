<?php

use App\Models\HomeScreen;
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
        Schema::create('home_screens', function (Blueprint $table) {
            $table->id();
            $table->string('section');
            $table->string('type')->default('home_screen');
            $table->text('contents')->nullable();
            $table->tinyInteger('version')->default(1)->comment('use for demo purpose only');
            $table->unsignedBigInteger('media_id_1')->nullable();
            $table->text('image_1')->nullable();
            $table->unsignedBigInteger('media_id_2')->nullable();
            $table->text('image_2')->nullable();
            $table->timestamps();
        });

        $data = [
            [
                'section'    => 'top_courses',
                'type'       => 'home_page',
                'contents'   => '{"title":"Top Courses","sub_title":""}',
                'version'    => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section'    => 'blog_news',
                'type'       => 'home_page',
                'contents'   => '{"title":"Latest News From Blog","sub_title":""}',
                'version'    => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'section'    => 'fun_fact',
                'type'       => 'home_page',
                'contents'   => '{"title":"Fun Fact","sub_title":"","image1":"","image2":""}',
                'version'    => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        HomeScreen::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_screens');
    }
};
