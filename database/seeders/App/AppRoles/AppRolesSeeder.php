<?php

namespace Database\Seeders\App\AppRoles;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AppRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin_app']);
        $role2 = Role::create(['name' => 'Sub-admin_app']);

        //Permiso admin Dashboard
        Permission::create([
            'name' => 'app.admin.dashboard',
            'description'=> 'Ver panel administrativo ( Admin )'
        ])->syncRoles([$role1]);
    }
}
