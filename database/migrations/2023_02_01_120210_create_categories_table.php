<?php

use App\Models\Category;
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->bigInteger('parent_id')->nullable();
            $table->text('icon')->nullable();
            $table->text('image')->nullable();
            $table->text('image_media_id')->nullable();
            $table->integer('position')->nullable();
            $table->integer('ordering')->nullable();
            $table->tinyInteger('is_featured')->default(0)->comment('1=featured, 0=not feature');
            $table->integer('total_courses')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 inactive, 1 active');
            $table->string('type')->nullable();
            $table->timestamps();
        });

        $now  = now();

        $data = [
            [
                'id'               => 1,
                'title'            => 'Web Design',
                'slug'             => Str::slug('Web Design'),
                'parent_id'        => 0,
                'position'         => 1,
                'status'           => 1,
                'type'             => 'course',
                'total_courses'    => 1,
                'meta_title'       => 'Web Design',
                'meta_keywords'    => 'Web Design',
                'meta_description' => 'Web Design',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'id'               => 2,
                'title'            => 'Web Development',
                'slug'             => Str::slug('Web Development'),
                'parent_id'        => 0,
                'position'         => 1,
                'status'           => 1,
                'type'             => 'course',
                'total_courses'    => 2,
                'meta_title'       => 'Web Development',
                'meta_keywords'    => 'Web Development',
                'meta_description' => 'Web Development',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
            [
                'id'               => 3,
                'title'            => 'Mobile App',
                'slug'             => Str::slug('Flutter'),
                'parent_id'        => 0,
                'position'         => 1,
                'status'           => 1,
                'type'             => 'course',
                'total_courses'    => 2,
                'meta_title'       => 'Mobile App',
                'meta_keywords'    => 'Mobile App',
                'meta_description' => 'Mobile App',
                'created_at'       => $now,
                'updated_at'       => $now,
            ],
        ];

        Category::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catgeories');
    }
};
