<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    public function cacheClear(): RedirectResponse
    {
        try {
            Artisan::call('all:clear');
            Artisan::call('migrate', ['--force' => true]);
            Toastr::success(__('cache_cleared_successfully'));

            return back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 'Error!');

            return back();
        }
    }

    public function changeAppSetting(Request $request): JsonResponse|\Illuminate\Routing\Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            if (auth()->check()) {
                $user = auth()->user();
                $data = [
                    'lang' => $request->lang,
                ];
                if ($request->currency_code) {
                    $data['currency_code'] = $request->currency_code;
                }
                $user->update($data);
            } else {
                session()->put('lang', $request->lang);
                session()->put('currency_code', $request->currency_code);
            }

            if (request()->ajax()) {
                return response()->json([
                    'success'   => true,
                    'is_reload' => true,
                    'route'     => setLanguageRedirect($request->lang, url()->previous()),
                ]);
            } else {
                return redirect(setLanguageRedirect($request->lang, url()->previous()));
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
