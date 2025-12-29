<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class InstructorPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $instructor_permissions = Role::where('id', 2)->first();
        $users                  = User::where('role_id', 2)->update(['permissions' => $instructor_permissions->permissions]);

    }
}
