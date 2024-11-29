<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Checklist;
use App\Models\User;

class ChecklistsTableSeeder extends Seeder
{
    public function run()
    {
        $checklists = [
            [
                'title' => 'Чеклист Супер Админа 1',
                'user_id' => User::where('role', 'super_admin')->first()->id
            ],
            [
                'title' => 'Чеклист Супер Админа 2',
                'user_id' => User::where('role', 'super_admin')->first()->id
            ],
            [
                'title' => 'Чеклист Обычного Админа 1',
                'user_id' => User::where('role', 'admin')->first()->id
            ],
            [
                'title' => 'Чеклист Обычного Админа 2',
                'user_id' => User::where('role', 'admin')->first()->id
            ],
            [
                'title' => 'Чеклист Простого Пользователя 1',
                'user_id' => User::where('role', 'user')->first()->id
            ],
            [
                'title' => 'Чеклист Простого Пользователя 2',
                'user_id' => User::where('role', 'user')->first()->id
            ]
        ];

        foreach ($checklists as $checklist) {
            Checklist::create($checklist);
        }
    }
}
