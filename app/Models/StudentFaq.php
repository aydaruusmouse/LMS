<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFaq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question', 'answer', 'status', 'ordering',
    ];

    public function languages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(StudentFaqLanguage::class, 'faq_id');
    }

    public function language(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(StudentFaqLanguage::class, 'faq_id')->where('lang', app()->getLocale());
    }

    public function getLangQuestionAttribute()
    {
        return $this->language ? $this->language->question : $this->question;
    }

    public function getLangAnswerAttribute()
    {
        return $this->language ? $this->language->answer : $this->answer;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
