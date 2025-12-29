<?php

namespace App\Repositories;

use App\Models\Faq;

class FaqRepository
{
    public function all()
    {
        return Faq::paginate(setting('paginate'));
    }

    public function store($request)
    {
        return Faq::create($request);
    }

    public function get($id)
    {
        return Faq::findOrfail($id);
    }

    public function update($request, $id)
    {
        return Faq::findOrfail($id)->update($request);
    }

    public function destroy($id): int
    {
        return Faq::destroy($id);
    }

    public function activeFaq($data)
    {
        return Faq::active()->when(arrayCheck('lang', $data), function ($query) {
            /*$query->join('faq_languages','faqs.id','faq_languages.faq_id')
                ->where('faq_languages.lang',$data['lang'])
                ->selectRaw('faqs.*,faq_languages.question as faq_question,faq_languages.answer as faq_answer');*/
        })->when(arrayCheck('course_id', $data), function ($query) use ($data) {
            $query->where('course_id', $data['course_id']);
        })->latest()->paginate($data['paginate']);
    }
}
