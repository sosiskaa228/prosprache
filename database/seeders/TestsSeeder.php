<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tests')->insert([
            ['course_id' => 1, 'title' => 'A1 Test: Основы', 'passing_score' => 70, 'created_at' => now(), 'updated_at' => now()],
            ['course_id' => 2, 'title' => 'B1 Test: Разговор', 'passing_score' => 75, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
