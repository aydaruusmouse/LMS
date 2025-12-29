<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question_type',
        'question',
        'answers',
        'status',
    ];

    protected $casts    = [
        'answers' => 'array',
    ];

    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function getAnswer()
    {
        return $this->hasOne(QuizAnswer::class, 'quiz_question_id')->where('user_id', auth()->user()->id);
    }
}
