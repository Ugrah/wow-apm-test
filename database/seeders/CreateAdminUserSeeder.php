<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = User::create([
            'firstname' => 'User',
            'lastname' => 'Admin',
            'username' => 'ADMIN',
            'unique_id' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        $super_admin_role = Role::create(['name' => 'SUPER_ADMIN', 'description' => 'Super Admin Role']);
        $role = Role::create(['name' => 'ADMIN', 'description' => 'Admin role']);

        $permissions = Permission::pluck('id', 'id')->all();

        $super_admin_role->syncPermissions($permissions);
        $role->syncPermissions($permissions);

        $user->assignRole([
            $super_admin_role->id,
            $role->id
        ]);
    }
}
