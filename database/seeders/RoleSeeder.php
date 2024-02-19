<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $permissions = Permission::all()->pluck('name');
        $admin->givePermissionTo($permissions);

        $adminUser = User::create([
            'name' => 'Dev',
            'email' => 'dev@gmail.com',
            'password' => bcrypt('1234'),
        ]);
        $adminUser->assignRole($admin);
    }
}
