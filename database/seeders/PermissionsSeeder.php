<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'user_management_access',
            ],
            [
                'title' => 'permission_create',
            ],
            [
                'title' => 'permission_edit',
            ],
            [
                'title' => 'permission_show',
            ],
            [
                'title' => 'permission_delete',
            ],
            [
                'title' => 'permission_access',
            ],
            [
                'title' => 'role_create',
            ],
            [
                'title' => 'role_edit',
            ],
            [
                'title' => 'role_show',
            ],
            [
                'title' => 'role_delete',
            ],
            [
                'title' => 'role_access',
            ],
            [
                'title' => 'user_create',
            ],
            [
                'title' => 'user_edit',
            ],
            [
                'title' => 'user_show',
            ],
            [
                'title' => 'user_delete',
            ],
            [
                'title' => 'user_access',
            ],
            [
                'title' => 'product_management_access',
            ],
            [
                'title' => 'ingredient_create',
            ],
            [
                'title' => 'ingredient_edit',
            ],
            [
                'title' => 'ingredient_show',
            ],
            [
                'title' => 'ingredient_delete',
            ],
            [
                'title' => 'ingredient_access',
            ],
            [
                'title' => 'product_create',
            ],
            [
                'title' => 'product_edit',
            ],
            [
                'title' => 'product_show',
            ],
            [
                'title' => 'product_delete',
            ],
            [
                'title' => 'product_access',
            ],
            [
                'title' => 'principle_create',
            ],
            [
                'title' => 'principle_edit',
            ],
            [
                'title' => 'principle_show',
            ],
            [
                'title' => 'principle_delete',
            ],
            [
                'title' => 'principle_access',
            ],
            [
                'title' => 'category_create',
            ],
            [
                'title' => 'category_edit',
            ],
            [
                'title' => 'category_show',
            ],
            [
                'title' => 'category_delete',
            ],
            [
                'title' => 'category_access',
            ],
        ];

        Permission::insert($permissions);
    }
}