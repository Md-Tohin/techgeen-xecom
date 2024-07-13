<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Roles
        $RoleSuperAdmin = Role::findOrCreate('superadmin', 'web');
        $RoleAdmin = Role::findOrCreate('admin', 'web');

        //Permission list Array

        $permissions = [           

            //Administrator Permission
            'administrator.view',
            'administrator.create',
            'administrator.edit',
            'administrator.delete',

            //User Permission
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            //Role Permission
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',

            //Category Permission
            'category.view',
            'category.create',
            'category.edit',
            'category.delete',

            //Attributes Permission
            'attributes.view',
            'attributes.create',
            'attributes.edit',
            'attributes.delete',

            //Brand Permission
            'brand.view',
            'brand.create',
            'brand.edit',
            'brand.delete',

            //Color Permission
            'colors.view',
            'colors.create',
            'colors.edit',
            'colors.delete',

            //Product Permission
            'products.view',
            'products.create',
            'products.edit',
            'products.delete',

            //Website Setup Permission
            'Website Setup.General Settings View',
            'Website Setup.General Settings Edit',
            'Website Setup.Seo Settings View',
            'Website Setup.Seo Settings Edit',
            
        ];


        $allPermissions = Permission::all();

        //Create & Assign Permissions
        foreach ($permissions as $permission) {
            //Create Permission
            $permission = Permission::findOrCreate($permission, 'web');
            $RoleSuperAdmin->givePermissionTo($permission);
            $permission->assignRole($RoleSuperAdmin);
        }
    }
}
