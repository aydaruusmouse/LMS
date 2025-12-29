<?php

use App\Models\Course;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('short_description')->nullable();
            $table->bigInteger('user_id')->nullable()->nullable();
            $table->text('instructor_ids')->nullable();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('course_type')->nullable();
            $table->integer('capacity')->nullable();
            $table->date('class_ends_at')->nullable();
            $table->bigInteger('language_id')->unsigned()->nullable();
            $table->bigInteger('organization_id')->unsigned()->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('is_private')->default(0)->comment('1=privet, 0=not privet');
            $table->string('video_source')->nullable();
            $table->string('video')->nullable();
            $table->unsignedBigInteger('image_media_id')->nullable();
            $table->text('image')->nullable();
            $table->string('duration', 10)->nullable();
            $table->tinyInteger('is_downloadable')->default(0)->comment('1=downloadable, 0=not downloadable');
            $table->tinyInteger('is_free')->default(0)->comment('1=free, 0=not free');
            $table->double('price')->default(0.00);
            $table->boolean('is_discountable')->default(0);
            $table->string('discount_type', 10)->nullable();
            $table->double('discount')->default(0)->nullable();
            $table->dateTime('discount_start_at')->nullable();
            $table->dateTime('discount_end_at')->nullable();
            $table->tinyInteger('is_featured')->default(0)->comment('1=featured, 0=no featured');
            $table->dateTime('deleted_at')->nullable();
            $table->string('tags')->nullable();
            $table->bigInteger('level_id')->unsigned()->nullable();
            $table->bigInteger('subject_id')->unsigned()->nullable();
            $table->boolean('is_renewable')->default(0);
            $table->string('renew_after')->nullable()->default(90)->comment('after 90days');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('meta_image')->nullable();
            $table->integer('total_lesson')->default(0);
            $table->integer('total_enrolled')->default(0);
            $table->double('total_rating')->default(0);

            $table->tinyInteger('is_published')->default(0)->comment('0 unpublished, 1 published');

            $table->enum('status', [
                'draft',
                'in_review',
                'rejected',
                'approved',
            ])->default('draft')->nullable();

            $table->timestamps();
        });

        $now  = now();

        $data = [
            [
                'title'             => 'Mathematics with Animated Lessons Officia deserunt mollit',
                'slug'              => Str::slug('Mathematics with Animated Lessons Officia deserunt mollit'),
                'short_description' => 'We used Photoshop to convert psd and write the css code for the website. Imagine, instead, that you could generate those thousand lines of code with a single click, just like copying and pasting, and you',
                'user_id'           => 1,
                'level_id'          => 1,
                'instructor_ids'    => '["1", "2"]',
                'category_id'       => 1,
                'language_id'       => 1,
                'duration'          => '2h 40min',
                'price'             => 1000,
                'discount'          => 25.00,
                'discount_type'     => 'percent',
                'status'            => 'approved',
                'is_published'      => 1,
                'total_enrolled'    => 0,
                'discount_start_at' => $now,
                'discount_end_at'   => $now->addMonths(2),
                'video_source'      => 'https://www.youtube.com/watch?v=dg_a9wfe0l0',
                'video'             => 'https://www.youtube.com/watch?v=dg_a9wfe0l0',
                'organization_id'   => 1,
                'total_rating'      => 0,
                'subject_id'        => 1,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'title'             => 'Build Native Cross-platform Apps with C#',
                'slug'              => Str::slug('Build Native Cross-platform Apps with C#'),
                'short_description' => 'Learn to build native mobile apps for Android, iOS and Windows using your existing C# skills',
                'user_id'           => 1,
                'level_id'          => 1,
                'instructor_ids'    => '["1", "2"]',
                'category_id'       => 3,
                'language_id'       => 1,
                'duration'          => '4h 40min',
                'price'             => 15,
                'discount'          => 25.00,
                'discount_type'     => 'percent',
                'status'            => 'approved',
                'is_published'      => 1,
                'total_enrolled'    => 0,
                'discount_start_at' => $now,
                'discount_end_at'   => $now->addMonths(2),
                'video_source'      => 'vimeo',
                'video'             => 'https://vimeo.com/210007343',
                'organization_id'   => 1,
                'total_rating'      => 0,
                'subject_id'        => 2,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ];

        Course::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
