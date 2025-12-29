<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrencyRepository
{
    public function all()
    {
        return Currency::orderByDesc('id')->paginate(setting('pagination'));
    }

    public function activeCurrency()
    {
        return Currency::where('status', 1)->get();
    }

    public function store($request)
    {
        $currency = Currency::create($request);

        return true;
    }

    public function update($request, $id)
    {
        $currency = Currency::find($id)->update($request);

        return true;
    }

    public function delete($id)
    {
        $currency = Currency::destroy($id);

        return true;
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return Currency::find($id)->update($request);
    }

    public function get($id)
    {
        return Currency::find($id);
    }

    public function currencyByCode($code)
    {
        return Currency::where('code', $code)->first();
    }
}
