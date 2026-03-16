<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'title' => 'Немецкий для начинающих',
                'description' => 'Основы немецкого языка: алфавит, базовая грамматика и разговорные фразы.',
                'level' => 'A1',
                'is_published' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Немецкий для продолжающих',
                'description' => 'Углублённая грамматика, чтение и разговорные упражнения.',
                'level' => 'B1',
                'is_published' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}