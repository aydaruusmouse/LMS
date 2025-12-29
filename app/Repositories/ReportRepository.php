<?php

namespace App\Repositories;

use App\Models\Wishlist;
use Illuminate\Support\Facades\DB;

class ReportRepository
{
    public function wishlist()
    {
        return Wishlist::orderBy('wishable_id')->where('wishable_type', 'App\Models\Course')
            ->select(
                DB::raw('(count(user_id)) as total_wish'),
                DB::raw('wishable_id'),
            )
            ->groupBy('wishable_id')->paginate(setting('paginate'));
    }
}
