<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Супер Админ',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'),
                'role' => 'super_admin'
            ],
            [
                'name' => 'Обычный Админ',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ],
            [
                'name' => 'Простой Пользователь',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => 'user'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
