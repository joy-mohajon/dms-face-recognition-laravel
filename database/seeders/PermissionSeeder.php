<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert(
            [
                // permissions for user operation
                ['name' => 'user_list',         'guard_name' => 'web'],
                ['name' => 'user_show',         'guard_name' => 'web'],
                ['name' => 'user_create',       'guard_name' => 'web'],
                ['name' => 'user_update',       'guard_name' => 'web'],
                ['name' => 'user_delete',       'guard_name' => 'web'],

                // // permissions for role operation
                ['name' => 'role_list',         'guard_name' => 'web'],
                ['name' => 'role_create',       'guard_name' => 'web'],
                ['name' => 'role_update',       'guard_name' => 'web'],
                ['name' => 'role_delete',       'guard_name' => 'web'],

                // permissions for file operation
                ['name' => 'file_list',         'guard_name' => 'web'],
                ['name' => 'file_create',       'guard_name' => 'web'],
                // ['name' => 'file_update',       'guard_name' => 'web'],
                ['name' => 'file_delete',       'guard_name' => 'web'],
            ]
        );
    }
}
