<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Dava Rezza',
                'username' => 'davarezza',
                'email' => 'admin@gmail.com',
                'plain_password' => '123',
                'password' => bcrypt('123'),
            ],
            [
                'name' => 'Suwanti Puji',
                'username' => 'suwantipuji',
                'email' => 'swan@gmail.com',
                'plain_password' => '123',
                'password' => bcrypt('123'),
            ],
        ];

        foreach ($userData as $data) {
            User::create($data);
        }
    }
}
