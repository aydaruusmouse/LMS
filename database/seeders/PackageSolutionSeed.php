<?php

namespace Database\Seeders;

use App\Models\PackageSolution;
use Illuminate\Database\Seeder;

class PackageSolutionSeed extends Seeder
{
    public function run()
    {
        PackageSolution::create([
            'name'         => 'basic',
            'description'  => 'Aliqua id fugiat nostru irure ex duis ea quis id quis ad et. Sunt qui
             esse pariatur duis deserunt mollit dolore cillum minim tempor enim. Elit aute irure tempor',
            'price'        => 1000,
            'validity'     => 3,
            'upload_limit' => 20,
            'add_limit'    => 5,
            'bundle'       => 5,
            'facilities'   => 1,
            'status'       => 1,

        ]);
    }
}
