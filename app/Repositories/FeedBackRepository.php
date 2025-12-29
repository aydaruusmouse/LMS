<?php

namespace App\Repositories;

use App\Models\Feedback;

class FeedBackRepository
{
    public function activeFeedback($data = [])
    {
        return Feedback::where('status', 1)->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('feedback.title', 'like', '%'.$data['q'].'%');
        })->when(arrayCheck('lang', $data), function ($query) use ($data) {
            $query->join('feedback_languages', 'feedback.id', 'feedback_languages.feedback_id')
                ->where('feedback_languages.lang', $data['lang'])
                ->selectRaw('feedback.*,feedback_languages.title as feedback_title, feedback_languages.description as lang_description');
        })->latest()->get();
    }
}
