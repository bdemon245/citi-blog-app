<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignPermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'super-admin' => [
                'create' => [
                    'user',
                    'role',
                    'post',
                    'category',
                    'sub_category',
                    'permission'
                ],
                'read' => [
                    'user',
                    'role',
                    'post',
                    'category',
                    'sub_category',
                    'permission'
                ],
                'update' => [
                    'user',
                    'role',
                    'post',
                    'category',
                    'sub_category',
                    'permission'
                ],
                'delete' => [
                    'user',
                    'role',
                    'post',
                    'category',
                    'sub_category',
                    'permission'
                ],
            ],
            'admin' => [
                'create' => [
                    'user',
                    'role',
                    'post',
                    'category',
                    'sub_category',
                    'permission'
                ],
                'read' => [
                    'user',
                    'role',
                    'post',
                    'category',
                    'sub_category',
                    'permission'
                ],
                'update' => [
                    'user',
                    'role',
                    'post',
                    'category',
                    'sub_category',
                    'permission'
                ],
                'delete' => [
                    'user',
                    'role',
                    'post',
                    'category',
                    'sub_category',
                    'permission'
                ],
            ],
            'editor' => [
                'create' => [
                    'post',
                    'category',
                    'sub_category',
                ],
                'read' => [
                    'user',
                    'post',
                    'category',
                    'sub_category',
                ],
                'update' => [
                    'post',
                    'category',
                    'sub_category',
                ],
            ],
            'author' => [
                'create' => [
                    'post',
                ],
                'read' => [
                    'user',
                    'post',
                    'category',
                    'sub_category',
                ],
                'update' => [
                    'post',
                    'category',
                    'sub_category',
                ],
                'delete' => [
                    'post',
                ],
            ],
            'user' => [
                'read' => [
                    'user',
                    'post',
                    'category',
                    'sub_category',
                ]
            ],
        ];

        foreach ($roles as $role => $can) {
            $role = Role::where('name', $role)->first();
            foreach ($can as $key => $values) {
                foreach ($values as $value) {
                    $permission = Permission::where('name', "$key $value")->first();
                    $role->givePermissionTo($permission);
                }
            }
        }
    }
}
