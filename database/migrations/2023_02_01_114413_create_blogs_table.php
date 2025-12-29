<?php

use App\Models\Blog;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('blog_category_id')->unsigned()->nullable();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('image_media_id')->nullable();
            $table->text('banner')->nullable();
            $table->unsignedBigInteger('banner_media_id')->nullable();
            $table->bigInteger('total_view')->nullable();
            $table->tinyInteger('is_featured')->default(0)->comment('1=featured, 0=no featured');
            $table->dateTime('published_date')->nullable();
            $table->tinyInteger('is_newspaper')->default(1)->comment('1=newspaper, 0=Not newspaper');
            $table->string('status')->default('published')->comment('published, draft, pending');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->timestamps();
        });

        $now  = now();

        $data = [
            [
                'title'             => 'How to Change the World with Mathematics',
                'short_description' => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'description'       => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'user_id'           => 1,
                'blog_category_id'  => 1,
                'status'            => 'draft',
                'slug'              => Str::slug('How to Change the World with Mathematics'),
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'title'             => 'What Do Great Teachers Know About Their Students?',
                'short_description' => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'description'       => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'user_id'           => 1,
                'blog_category_id'  => 1,
                'status'            => 'published',
                'slug'              => Str::slug('What Do Great Teachers Know About Their Students?'),
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'title'             => 'Education in the New Normal Technologies',
                'short_description' => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'description'       => "Mechanical symphony best describes today's world. Time slots in our days allow us to engage with systems that have been mathematically created. The alarm goes off on a timer, and we use a coffee maker that automatically adjusts the water temperature and pressure to perfection. Since our address is a single element in a well-nested collection that includes hous",
                'user_id'           => 1,
                'status'            => 'pending',
                'slug'              => Str::slug('Education in the New Normal Technologies'),
                'blog_category_id'  => 1,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ];

        Blog::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
};
