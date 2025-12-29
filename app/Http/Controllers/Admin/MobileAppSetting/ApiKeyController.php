<?php

namespace App\Http\Controllers\Admin\MobileAppSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApiKeyRequest;
use App\Repositories\ApiKeyRepository;
use App\Repositories\LanguageRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    protected $apikey;

    public function __construct(ApiKeyRepository $apikey)
    {
        $this->apikey = $apikey;
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = [
                'api_keys' => $this->apikey->all([
                    'lang'     => app()->getLocale(),
                    'paginate' => setting('paginate'),
                ]),
            ];

            return view('backend.admin.mobile-app.apikey.all-apikey', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function create(LanguageRepository $language): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $data = [
                'languages' => $language->all(),
            ];

            return view('backend.admin.mobile-app.apikey.add-apikey', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function store(ApiKeyRequest $request): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->apikey->store($request->all());
            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('apikeys.index'),
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id, LanguageRepository $language, Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        try {
            $lang = $request->lang ?? app()->getLocale();
            $data = [
                'languages'        => $language->all(),
                'lang'             => $lang,
                'apikey'           => $this->apikey->get($id),
                'api_key_language' => $this->apikey->getByLang($id, $lang),
            ];

            return view('backend.admin.mobile-app.apikey.edit-apikey', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->apikey->update($request->all(), $id);
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('apikeys.index'),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->apikey->destroy($id);
            Toastr::success(__('delete_successful'));
            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }

    public function revoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->apikey->delete($request->all());
            $data = [
                'status'  => 'success',
                'message' => __('update_successful'),
                'title'   => __('success'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }
}
