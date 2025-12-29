<?php

use App\Models\BlogLanguage;
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
        Schema::create('blog_languages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_description');
            $table->text('description')->nullable();
            $table->bigInteger('blog_id')->unsigned()->nullable();
            $table->string('lang', 10)->nullable();
            $table->string('tags')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });

        $now  = now();

        $data = [
            [
                'title'             => 'How to Change the World with Mathematics',
                'short_description' => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'description'       => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'blog_id'           => 1,
                'lang'              => 'en',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],

            [
                'title'             => 'What Do Great Teachers Know About Their Students?',
                'short_description' => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'description'       => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'blog_id'           => 2,
                'lang'              => 'en',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'title'             => 'Education in the New Normal Technologies',
                'short_description' => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'description'       => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'blog_id'           => 3,
                'lang'              => 'en',
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ];

        BlogLanguage::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_languages');
    }
};
