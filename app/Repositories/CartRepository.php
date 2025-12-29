<?php

namespace App\Repositories;

use App\Models\Cart;

class CartRepository
{
    public function all($data = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return Cart::with('cartable', 'coupon')->where('user_id', $data['user_id'])
            ->when(arrayCheck('type', $data), function ($query) use ($data) {
                return $query->where('cartable_type', $data['type']);
            })->latest()->get();
    }

    public function hasCart($user_id)
    {
        return Cart::where('user_id', $user_id)->first();
    }

    public function store($data)
    {
        return Cart::create($data);
    }

    public function update($request, $id)
    {
        $city = Cart::findOrfail($id)->update($request);

        return true;
    }

    public function destroy($id)
    {
        return Cart::destroy($id);
    }

    public function findCartsOrder($data = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return Cart::with('cartable', 'coupon')->where('trx_id', $data['trx_id'])
            ->when(arrayCheck('type', $data), function ($query) use ($data) {
                return $query->where('cartable_type', $data['type']);
            })->latest()->get();
    }

    public function getCart($trx_id)
    {
        return Cart::where('trx_id', $trx_id)->get();
    }

    public function deleteCart($data)
    {
        return Cart::where('user_id', auth()->id())->where('cartable_type', $data['type'])->where('cartable_id', $data['id'])->delete();
    }
}
