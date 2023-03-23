<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            'create' => [
                'user',
                'role',
                'post',
                'category',
                'sub_category',
            ],
            'read' => [
                'user',
                'role',
                'post',
                'category',
                'sub_category',
            ],
            'update' => [
                'user',
                'role',
                'post',
                'category',
                'sub_category',
            ],
            'delete' => [
                'user',
                'role',
                'post',
                'category',
                'sub_category',
            ],
            'ban' => [
                'user',
                'role',
            ],
            'toggle' => [
                'user',
                'role',
                'post',
                'permission'
            ],
        ];

        foreach ($permission as $key => $items) {
            foreach ($items as $item) {
                Permission::create(['name' => "$key $item"]);
            }
        }
    }
}
