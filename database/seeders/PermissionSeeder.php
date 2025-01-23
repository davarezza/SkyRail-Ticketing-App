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
        // Template for add permission (Return it when you're done adding permission)
        $permissions = [
            'View',
            'Add',
            'Edit',
            'Delete',
        ];

        $now = now('Asia/Jakarta');
        $data = [];

        foreach ($permissions as $permission) {
            $data[] = [
                'name' => $permission,
                'menu_title' => 'Menu Title',
                'group' => 'Group',
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('permissions')->insert($data);
    }
}
