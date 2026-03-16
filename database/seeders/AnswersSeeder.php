<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnswersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('answers')->insert([
            ['question_id' => 1, 'answer_text' => 'Дом', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 1, 'answer_text' => 'Собака', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 2, 'answer_text' => 'Hallo', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 2, 'answer_text' => 'Guten Morgen', 'is_correct' => true, 'created_at' => now(), 'updated_at' => now()],
            ['question_id' => 2, 'answer_text' => 'Tschüss', 'is_correct' => false, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
