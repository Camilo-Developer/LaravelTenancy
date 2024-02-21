<?php

namespace Database\Seeders\Admin\Roles;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Sub-admin']);

        //Permiso admin Dashboard
        Permission::create([
            'name' => 'admin.dashboard',
            'description'=> 'Ver panel administrativo ( Admin )'
        ])->syncRoles([$role1]);

        //Permiso User Dashboard
        Permission::create([
            'name' => 'dashboard',
            'description'=> 'Ver panel administrativo sub-admin'
        ])->syncRoles([$role1, $role2]);


        //Permisos admin Estados
        Permission::create([
            'name' => 'admin.tenancies.index',
            'description'=> 'Lista de Inquilinos '
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.tenancies.create',
            'description'=> 'Creación de Inquilinos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.tenancies.edit',
            'description'=> 'Edición de Inquilinos'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.tenancies.destroy',
            'description'=> 'Eliminar Inquilinos'
        ])->syncRoles([$role1]);
    }
}
