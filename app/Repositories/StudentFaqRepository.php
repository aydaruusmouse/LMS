<?php

namespace App\Repositories;

use App\Models\StudentFaq;
use App\Models\StudentFaqLanguage;

class StudentFaqRepository
{
    public function all()
    {
        return StudentFaq::latest()->paginate(setting('paginate'));
    }

    public function activeFaqs($data = [])
    {
        return StudentFaq::active()->orderBy('ordering')->get();
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $coupon = StudentFaqLanguage::where('lang', 'en')->where('faq_id', $id)->first();
        } else {
            $coupon = StudentFaqLanguage::where('lang', $lang)->where('faq_id', $id)->first();
            if (! $coupon) {
                $coupon                     = StudentFaqLanguage::where('lang', 'en')->where('faq_id', $id)->first();
                $coupon['translation_null'] = 'not-found';
            }
        }

        return $coupon;
    }

    public function store($request)
    {
        $data = $request;
        $faq  = StudentFaq::create($request);

        $this->langStore($data, $faq);

        return $faq;
    }

    public function find($id)
    {
        return StudentFaq::find($id);
    }

    public function update($request, $id)
    {
        $data = $request;

        $faq  = StudentFaq::find($id);
        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['question'] = $faq->question;
            $request['answer']   = $faq->answer;
        }
        $faq->update($request);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $faq);
        }

        return $faq;
    }

    public function status($data)
    {
        $faq         = StudentFaq::find($data['id']);
        $faq->status = $data['status'];
        $faq->save();

        return $faq;
    }

    public function destroy($id)
    {
        return StudentFaq::destroy($id);
    }

    public function langStore($request, $faq)
    {
        return StudentFaqLanguage::create([
            'faq_id'   => $faq->id,
            'question' => $request['question'],
            'answer'   => $request['answer'],
            'lang'     => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return StudentFaqLanguage::where('id', $request['translate_id'])->update([
            'lang'     => $request['lang'],
            'question' => $request['question'],
            'answer'   => $request['answer'],
        ]);
    }
}
