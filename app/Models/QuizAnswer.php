<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_question_id',
        'quiz_id',
        'answers',
        'correct_answer',
    ];

    protected $casts    = [
        'answers'        => 'array',
        'correct_answer' => 'array',
    ];

    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
