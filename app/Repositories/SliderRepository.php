<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Course;
use App\Models\Slider;
use App\Models\SliderLanguage;
use App\Traits\ImageTrait;

class SliderRepository
{
    use ImageTrait;

    public function all()
    {
        return Slider::with('language')->orderByDesc('id')->paginate(setting('paginate'));
    }

    public function get($id)
    {
        return Slider::findorFail($id);
    }

    public function activeSliders(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Slider::with('sliderable', 'language')->when(addon_is_activated('book_store'), function ($query) {
            $query->with('book');
        })->where('status', 1)->latest()->get();
    }

    public function store($request)
    {
        if (arrayCheck('image', $request)) {
            $request['media_id'] = $request['image'];
            $request['image']    = $this->getImageWithRecommendedSize($request['image'], '305', '150', true);
        }

        if ($request['source'] == 'course') {
            $request['sliderable_type'] = Course::class;
        } elseif ($request['source'] == 'book') {
            $request['sliderable_type'] = Book::class;
        }

        $slider = Slider::create($request);

        if ($slider->source == 'custom_image') {
            $this->langStore($request, $slider);
        }

        return true;
    }

    public function update($request, $id)
    {
        if (arrayCheck('image', $request)) {
            $request['media_id'] = $request['image'];
            $request['image']    = $this->getImageWithRecommendedSize($request['image'], '305', '150', true);
        }

        $data   = $request;
        $slider = Slider::find($id);

        if ($request['source'] == 'course') {
            $request['sliderable_type'] = Course::class;
        } elseif ($request['source'] == 'book') {
            $request['sliderable_type'] = Book::class;
        }

        $slider->update($request);

        if ($slider->source == 'custom_image') {
            if ($request['translate_id']) {
                $request['lang'] = $request['lang'] ?: 'en';
                $this->langUpdate($data);
            } else {
                $this->langStore($data, $slider);
            }
        }

        return $slider;

    }

    public function destroy($id): int
    {
        return Slider::destroy($id);
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return Slider::find($id)->update($request);
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $slider = SliderLanguage::where('lang', 'en')->where('slider_id', $id)->first();
        } else {
            $slider = SliderLanguage::where('lang', $lang)->where('slider_id', $id)->first();
            if (! $slider) {
                $slider                     = SliderLanguage::where('lang', 'en')->where('slider_id', $id)->first();
                $slider['translation_null'] = 'not-found';
            }
        }

        return $slider;
    }

    public function langStore($request, $slider)
    {
        return SliderLanguage::create([
            'slider_id' => $slider->id,
            'lang'      => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return SliderLanguage::where('id', $request['translate_id'])->update([
            'lang' => $request['lang'],
        ]);
    }
}
