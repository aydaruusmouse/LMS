<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CurrencyDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CurrencyRequest;
use App\Repositories\CurrencyRepository;
use App\Repositories\SettingRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CurrencyController extends Controller
{
    protected $currency;

    protected $settings;

    public function __construct(CurrencyRepository $currency, SettingRepository $settings)
    {
        $this->currency = $currency;
        $this->settings = $settings;
    }

    public function index(CurrencyDataTable $dataTable)
    {
        return $dataTable->render('backend.admin.currency.all-currency');
    }

    public function create()
    {
        //
    }

    public function store(CurrencyRequest $request): \Illuminate\Http\JsonResponse
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
            $this->currency->store($request->all());
            Artisan::call('all:clear');

            return response()->json(['success' => __('create_successful')]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit($id): \Illuminate\Http\JsonResponse
    {
        try {
            $currency = $this->currency->get($id);
            $data     = [
                'id'            => $currency->id,
                'name'          => $currency->name,
                'symbol'        => $currency->symbol,
                'code'          => $currency->code,
                'exchange_rate' => $currency->exchange_rate,
            ];

            return response()->json($data);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function update(CurrencyRequest $request, $id): \Illuminate\Http\JsonResponse
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

            $this->currency->update($request->all(), $id);
            Artisan::call('all:clear');

            return response()->json(['success' => __('update_successful')]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
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
            $this->currency->delete($id);

            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];
            Artisan::call('all:clear');

            return response()->json($data);
        } catch (Exception $e) {
            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }

    public function statusChange(Request $request): \Illuminate\Http\JsonResponse
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
            $this->currency->statusChange($request->all());
            $data = [
                'status'  => 200,
                'message' => __('update_successful'),
                'title'   => 'success',
            ];
            Artisan::call('all:clear');

            return response()->json($data);
        } catch (Exception $e) {
            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }

    public function setDefault($id)
    {
        if (config('app.demo_mode')) {
            Toastr::error(__('This function is disabled in demo server.'));

            return back();
        }

        try {

            $request = new \Illuminate\Http\Request();
            $request->setMethod('POST');
            $request->request->add(['default_currency' => $id]);
            Artisan::call('all:clear');

            $this->settings->update($request);
            Toastr::success(__('updated_successfully'));

            return back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function setCurrencyFormat(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->settings->update($request);
            Artisan::call('all:clear');
            Toastr::success(__('updated_successfully'));

            return back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }
}
