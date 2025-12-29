<?php

use App\Models\QuizQuestion;
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
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id');
            $table->string('question_type');
            $table->string('question');
            $table->text('answers');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        $now  = now();

        $data = [
            [
                'quiz_id'       => 1,
                'question_type' => 'short_question',
                'question'      => 'write down about software development',
                'answers'       => '[]',
                'created_at'    => $now,
                'updated_at'    => $now,
            ],
            [
                'quiz_id'       => 1,
                'question_type' => 'default',
                'question'      => 'what is software development',
                'created_at'    => $now,
                'updated_at'    => $now,
                'answers'       => "[
                    {'answer'   : 'fun', 'is_correct' : 0,}
                    {'answer'   : 'jok', 'is_correct' : 0,}
                    {'answer'   : 'nothing', 'is_correct' : 0,}
                    {'answer'   : 'Software development is the process of conceiving', 'is_correct' : 1}
                ]",
            ],
            [
                'quiz_id'       => 1,
                'question_type' => 'mcq',
                'question'      => 'best tool for software development',
                'created_at'    => $now,
                'updated_at'    => $now,
                'answers'       => "[
                    {'answer'    : 'windows', 'is_correct' : 1,}
                    {'answer'    : 'linux', 'is_correct' : 1,}
                    {'answer'    : 'php storm', 'is_correct' : 0,}
                    {'answer'    : 'visual code', 'is_correct' : 0}
                ]",
            ],
        ];
        QuizQuestion::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
};
