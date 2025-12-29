<?php

namespace Database\Seeders;

use App\Models\Follow;
use Illuminate\Database\Seeder;

class FollowSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Follow::Create([
            'id'          => 1,
            'user_id'     => 4,
            'follower_id' => 3,
        ]);
    }
}
