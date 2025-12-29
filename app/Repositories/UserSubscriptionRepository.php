<?php

namespace App\Repositories;

use App\Models\UserSubscription;
use Illuminate\Support\Facades\DB;

class UserSubscriptionRepository
{
    public function store($request)
    {
        return UserSubscription::create($request);
    }

    public function update($user_id, $request)
    {
        return UserSubscription::where('user_id', $user_id)->update($request);
    }

    public function getUserSubscription($user_id)
    {
        return UserSubscription::where('user_id', $user_id)->first();
    }

    public function mostPopular()
    {
        return $mostSubscribedPackageId = DB::table('user_subscriptions')
            ->select(DB::raw('package_solutions_id, count(*) as total_subscriptions'))
            ->groupBy('package_solutions_id')
            ->orderByDesc('total_subscriptions')
            ->first();
    }
}
