<?php

namespace App\Repositories;

use App\Models\AppliedCoupon;
use App\Models\Coupon;
use App\Models\CouponLanguage;
use App\Traits\ImageTrait;
use Carbon\Carbon;

class CouponRepository
{
    use ImageTrait;

    public function all()
    {
        return Coupon::orderByDesc('id')->paginate(setting('paginate'));
    }

    public function activeCoupon($data)
    {
        return Coupon::when(arrayCheck('user_id', $data), function ($query) use ($data) {
            $query->whereDoesnotHave('appliedCoupons', function ($query) use ($data) {
                $query->where('user_id', $data['user_id']);
            });
        })->when(arrayCheck('lang', $data), function ($query) {
            /* $query->join('coupon_languages','coupons.id','coupon_languages.coupon_id')
                 ->where('coupon_languages.lang',$data['lang'])
                 ->selectRaw('coupons.*,coupon_languages.title as coupon_title')
                 ->where('start_date','<',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'));*/
        })->active()->latest()->paginate($data['paginate']);
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $coupon = CouponLanguage::where('lang', 'en')->where('coupon_id', $id)->first();
        } else {
            $coupon = CouponLanguage::where('lang', $lang)->where('coupon_id', $id)->first();
            if (! $coupon) {
                $coupon                     = CouponLanguage::where('lang', 'en')->where('coupon_id', $id)->first();
                $coupon['translation_null'] = 'not-found';
            }
        }

        return $coupon;
    }

    public function store($request)
    {
        $data                  = $request;
        if (arrayCheck('coupon_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['coupon_media_id'], '402', '238', true);
        }

        $dates                 = explode(' - ', $request['dateRange']);
        $request['start_date'] = Carbon::parse($dates[0]);
        $request['end_date']   = Carbon::parse($dates[1]);
        $request['user_id']    = auth()->id();
        $coupon                = Coupon::create($request);

        $this->langStore($data, $coupon);

        return $coupon;
    }

    public function find($id)
    {
        return Coupon::find($id);
    }

    public function update($request, $id)
    {
        $data                  = $request;
        $coupon                = Coupon::findOrfail($id);

        if (arrayCheck('coupon_media_id', $request)) {
            $request['image'] = $this->getImageWithRecommendedSize($request['coupon_media_id'], '402', '238', true);
        }

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['title'] = $coupon->title;
        }
        $dates                 = explode(' - ', $request['dateRange']);
        $request['start_date'] = Carbon::parse($dates[0]);
        $request['end_date']   = Carbon::parse($dates[1]);
        $coupon->update($request);

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $coupon);
        }

        return $coupon;
    }

    public function status($data)
    {
        $key         = Coupon::findOrfail($data['id']);
        $key->status = $data['status'];

        return $key->save();
    }

    public function destroy($id)
    {
        return Coupon::destroy($id);
    }

    public function langStore($request, $coupon)
    {
        return CouponLanguage::create([
            'coupon_id' => $coupon->id,
            'title'     => $request['title'],
            'lang'      => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return CouponLanguage::where('id', $request['translate_id'])->update([
            'lang'  => $request['lang'],
            'title' => $request['title'],
        ]);
    }

    public function couponByCode($code)
    {
        return Coupon::where('code', $code)->first();
    }

    public function isCouponApplied($data)
    {
        return AppliedCoupon::where('coupon_id', $data['id'])->where('user_id', $data['user_id'])->first();
    }

    public function couponApply($data)
    {
        return AppliedCoupon::create($data);
    }

    public function appliedCoupons($data, $with = []): \Illuminate\Database\Eloquent\Collection|array
    {
        return AppliedCoupon::with($with)->where('user_id', $data['user_id'])->where('trx_id', $data['trx_id'])->where('status', 0)->get();
    }
}
