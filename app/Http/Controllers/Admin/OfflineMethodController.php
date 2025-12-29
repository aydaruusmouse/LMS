<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OfflineMethodDataTable;
use App\Http\Controllers\Controller;
use App\Repositories\LanguageRepository;
use App\Repositories\OfflineMethodRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfflineMethodController extends Controller
{
    protected $offlineMethodRepository;

    public function __construct(OfflineMethodRepository $offlineMethodRepository)
    {
        $this->offlineMethodRepository = $offlineMethodRepository;
    }

    public function index(OfflineMethodDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.offline_methods.index');
    }

    public function create(): View|Factory|RedirectResponse|Application
    {
        return view('backend.admin.offline_methods.create');
    }

    public function store(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'name' => 'required|unique:offline_methods,name',
            'type' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $this->offlineMethodRepository->store($request->all());
            Toastr::success(__('create_successful'));

            DB::commit();

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('offline-methods.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit($id, LanguageRepository $language, Request $request): View|Factory|RedirectResponse|Application
    {
        try {
            $offline_method = $this->offlineMethodRepository->find($id);
            $lang           = $request->lang ?? app()->getLocale();
            $data           = [
                'languages'               => $language->all(),
                'lang'                    => $lang,
                'offline_method'          => $offline_method,
                'offline_method_language' => $this->offlineMethodRepository->getByLang($id, $lang),
            ];

            return view('backend.admin.offline_methods.edit', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'name' => 'required|unique:offline_methods,name,'.$id,
            'type' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $this->offlineMethodRepository->update($request->all(), $id);
            Toastr::success(__('update_successful'));
            DB::commit();

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('offline-methods.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function statusChange(Request $request): JsonResponse
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
            $this->offlineMethodRepository->status($request->all());
            $data = [
                'status'  => 200,
                'message' => __('update_successful'),
                'title'   => 'success',
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }

    public function destroy($id): JsonResponse
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
            $this->offlineMethodRepository->destroy($id);
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
}
