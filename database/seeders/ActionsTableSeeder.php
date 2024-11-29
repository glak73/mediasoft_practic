<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Action;
use App\Models\Checklist;

class ActionsTableSeeder extends Seeder
{
    public function run()
    {
        $actions = [];

        $checklists = Checklist::all();

        foreach ($checklists as $checklist) {
            $actions[] = [
                'name' => 'Выполненное действие для чеклиста "' . $checklist->title . '"',
                'is_completed' => true,
                'checklist_id' => $checklist->id
            ];
            $actions[] = [
                'name' => 'Невыполненное действие для чеклиста "' . $checklist->title . '"',
                'is_completed' => false,
                'checklist_id' => $checklist->id
            ];
        }

        Action::insert($actions);
    }
}
