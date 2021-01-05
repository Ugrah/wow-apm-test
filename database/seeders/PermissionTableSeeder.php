<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        DB::table('roles')->delete();

        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            //    'product-list',
            //    'product-create',
            //    'product-edit',
            //    'product-delete'

            'terminal-list',
            'terminal-create',
            'terminal-edit',
            'terminal-delete',
        ];

        $roles = [
            
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);

            // foreach (config('auth.guards') as $key => $value) {
            //     Permission::create(['name' => $permission, 'guard_name' => $key]);
            // }
        }
    }
}
