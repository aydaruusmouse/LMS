<?php

namespace App\Repositories;

use App\Models\Certificate;
use App\Traits\ImageTrait;

class CertificateRepository
{
    use ImageTrait;

    public function all()
    {
        return Certificate::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function find($id)
    {
        return Certificate::find($id)->with('certificate')->get();
    }

    public function activeCertificates($data = [])
    {
        return Certificate::when(arrayCheck('user_certificate', $data), function ($query) {
            $query->where('user_certificate', 1);
        })->paginate($data['paginate']);
    }

    public function store($request)
    {

        if (arrayCheck('instructor_signature_media_id', $request)) {
            $request['instructor_signature'] = $this->getImageWithRecommendedSize($request['instructor_signature_media_id'], '170', '74', true);
        }
        if (arrayCheck('administrator_signature_media_id', $request)) {
            $request['administrator_signature'] = $this->getImageWithRecommendedSize($request['administrator_signature_media_id'], '170', '74', true);
        }
        if (arrayCheck('background_image_media_id', $request)) {
            $request['background_image'] = $this->getImageWithRecommendedSize($request['background_image_media_id'], '84', '85', true);
        }

        return Certificate::create($request);
    }

    public function update($request, $id)
    {

        //        if (arrayCheck('title', $request)) {
        //            $title = $request['title'];
        //        }
        if (arrayCheck('instructor_signature_media_id', $request)) {
            $request['instructor_signature'] = $this->getImageWithRecommendedSize($request['instructor_signature_media_id'], '170', '74', true);
        }
        if (arrayCheck('administrator_signature_media_id', $request)) {
            $request['administrator_signature'] = $this->getImageWithRecommendedSize($request['administrator_signature_media_id'], '170', '74', true);
        }
        if (arrayCheck('background_image_media_id', $request)) {
            $request['background_image'] = $this->getImageWithRecommendedSize($request['background_image_media_id'], '84', '85', true);
        }

        //        $certificate = Certificate::find($id);
        //        if ($certificate) {
        //            if (isset($title)) {
        //                $certificate->title = $title;
        //            }
        return Certificate::find($id)->update($request);
        //            }

    }

    public function destroy($id)
    {
        return Certificate::destroy($id);
    }

    public function findCertificate($id)
    {
        return Certificate::where('course_id', $id)->first();
    }
}
