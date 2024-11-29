<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\ChecklistsTableSeeder;
use Database\Seeders\ActionsTableSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ChecklistsTableSeeder::class,
            ActionsTableSeeder::class,
        ]);
    }
}
