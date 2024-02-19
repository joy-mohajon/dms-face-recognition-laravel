<?php


return [
    // permissions for user operation
    ['name' => 'user_list',         'guard_name' => 'web', 'module_name' => 'User'],
    ['name' => 'user_show',         'guard_name' => 'web', 'module_name' => 'User'],
    ['name' => 'user_create',       'guard_name' => 'web', 'module_name' => 'User'],
    ['name' => 'user_update',       'guard_name' => 'web', 'module_name' => 'User'],
    ['name' => 'user_delete',       'guard_name' => 'web', 'module_name' => 'User'],

    // permissions for role operation
    ['name' => 'role_list',         'guard_name' => 'web', 'module_name' => 'Role'],
    ['name' => 'role_create',       'guard_name' => 'web', 'module_name' => 'Role'],
    ['name' => 'role_update',       'guard_name' => 'web', 'module_name' => 'Role'],
    ['name' => 'role_delete',       'guard_name' => 'web', 'module_name' => 'Role'],

    // permissions for file operation
    ['name' => 'file_list',         'guard_name' => 'web', 'module_name' => 'File'],
    ['name' => 'file_create',       'guard_name' => 'web', 'module_name' => 'File'],
    // ['name' => 'file_update',       'guard_name' => 'web', 'module_name' => 'File'],
    ['name' => 'file_delete',       'guard_name' => 'web', 'module_name' => 'File'],
];
