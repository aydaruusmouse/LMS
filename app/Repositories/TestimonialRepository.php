<?php

namespace App\Repositories;

use App\Models\Testimonial;
use App\Models\TestimonialLanguage;
use App\Traits\ImageTrait;

class TestimonialRepository
{
    use ImageTrait;

    public function all()
    {
        return Testimonial::orderByDesc('id')->paginate(setting('pagination'));
    }

    public function find($id)
    {
        return Testimonial::find($id);
    }

    public function activeTestimonials($data = [])
    {
        return Testimonial::where('status', 1)->when(arrayCheck('q', $data), function ($query) use ($data) {
            $query->where('name', 'like', '%'.$data['q'].'%')->orWhereHas('languages', function ($query) use ($data) {
                $query->where('name', 'like', '%'.$data['q'].'%');
            });
        })->latest()->get();
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $testimonial = TestimonialLanguage::where('lang', 'en')->where('testimonial_id', $id)->first();
        } else {
            $testimonial = TestimonialLanguage::where('lang', $lang)->where('testimonial_id', $id)->first();
            if (! $testimonial) {
                $testimonial                     = TestimonialLanguage::where('lang', 'en')->where('testimonial_id', $id)->first();
                $testimonial['translation_null'] = 'not-found';
            }
        }

        return $testimonial;
    }

    public function store($request)
    {
        if (arrayCheck('media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['media_id'], '282', '282', true);
        }
        $testimonial = Testimonial::create($request);

        $this->langStore($request, $testimonial);

        return $testimonial;
    }

    public function update($request, $id)
    {
        $data        = $request;
        $testimonial = Testimonial::findOrfail($id);

        if (arrayCheck('media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['media_id'], '282', '282', true);
        }

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['name'] = $testimonial->name;
        }
        $testimonial->update($request);

        if ($request['translate_id']) {
            $data['lang'] = $data['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $testimonial);
        }

        return $testimonial;
    }

    public function destroy($id): int
    {
        return Testimonial::destroy($id);
    }

    public function status($data)
    {
        $key         = Testimonial::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function langStore($request, $testimonial)
    {
        return TestimonialLanguage::create([
            'testimonial_id' => $testimonial->id,
            'name'           => $request['name'],
            'lang'           => arrayCheck('lang', $request) ? $request['lang'] : 'en',
            'description'    => $request['description'],
        ]);
    }

    public function langUpdate($request)
    {
        return TestimonialLanguage::where('id', $request['translate_id'])->update([
            'lang'        => $request['lang'],
            'name'        => $request['name'],
            'description' => $request['description'],
        ]);
    }
}
