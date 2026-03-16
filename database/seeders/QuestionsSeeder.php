<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('questions')->insert([
            ['test_id' => 1, 'question_text' => 'Как переводится слово "Haus"?', 'type' => 'single', 'created_at' => now(), 'updated_at' => now()],
            ['test_id' => 1, 'question_text' => 'Выберите правильные приветствия на немецком.', 'type' => 'multiple', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}