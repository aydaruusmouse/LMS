<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\MediaLibraryRepository;
use App\Traits\ImageTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class MediaLibraryController extends Controller
{
    use ImageTrait;

    private $mediaLibraryRepository;

    public function __construct(MediaLibraryRepository $mediaLibraryRepository)
    {
        $this->mediaLibraryRepository = $mediaLibraryRepository;
    }

    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {

            $data   = $request->all();
            $medias = $this->mediaLibraryRepository->all([
                'paginate'   => 14,
                'type'       => $request->type,
                'q'          => $request->q,
                'start_date' => arrayCheck('start_date', $data) ? $data['start_date'] : '',
                'end_date'   => arrayCheck('end_date', $data) ? $data['end_date'] : '',
            ]);
            if (request()->ajax()) {
                return $this->fetchAjax($medias, $data);
            }
            $data   = [
                'medias'     => $medias,
                'type'       => getArrayValue('type', $data),
                'start_date' => arrayCheck('start_date', $data) ? $data['start_date'] : null,
                'end_date'   => arrayCheck('end_date', $data) ? $data['end_date'] : null,
                'q'          => arrayCheck('q', $data) ? $data['q'] : '',
            ];

            return view('backend.admin.media-library.index', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), __('error'));

            return back();
        }
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            if (config('app.demo_mode')) {
                return response()->json(__('This function is disabled in demo server.'), 500);
            }
            $type = get_yrsetting('supported_mimes');

            if ($request->hasFile('file')) {
                $extension = strtolower($request->file('file')->getClientOriginalExtension());

                if (! isset($type[$extension])) {
                    return response()->json(__('This file type is not supported.'), 500);
                }
                if ($type[$extension] == 'image') {
                    $response = $this->saveImage($request->file('file'), '_media_', true);
                } else {
                    $response = $this->saveFile($request->file('file'), $type[$extension]);
                }

                return response()->json($response, 200);
            }

            return response()->json(__('file_uploaded_successfully'), 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function delete(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $response['message'] = __('this_function_is_disabled_in_demo_server');
            $response['title']   = __('error');
            $response['status']  = 'error';

            return response()->json($response);
        }

        try {
            if (is_array($request->id)) {
                $ids = $request->id;
            } else {
                $ids = (array) $request->id;
            }
            $this->mediaLibraryRepository->delete($ids);
            $success['message'] = __('deleted_successfully');
            $success['status']  = 'success';
            $success['title']   = __('deleted');

            return response()->json($success);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }

    }

    public function fetchAjax($medias, $data): \Illuminate\Http\JsonResponse
    {
        if (arrayCheck('gallery_modal', $data)) {
            $view = 'backend.admin.media-library.media_selector';
        } else {
            $view = 'backend.admin.media-library.media_list';
        }

        $data = [
            'list'          => view($view, [
                'medias'     => $medias,
                'type'       => getArrayValue('type', $data),
                'start_date' => arrayCheck('start_date', $data) ? $data['start_date'] : null,
                'end_date'   => arrayCheck('end_date', $data) ? $data['end_date'] : null,
                'q'          => arrayCheck('q', $data) ? $data['q'] : '',
            ])->render(),
            'next_page_url' => $medias->nextPageUrl(),
        ];

        return response()->json($data, 200);
    }
}
