<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('course_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        $now  = now();
        $data = [
            [
                'course_id'  => 1,
                'user_id'    => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'course_id'  => 2,
                'user_id'    => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('course_user')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_instructor');
    }
};
