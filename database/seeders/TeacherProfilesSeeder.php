<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherProfilesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('teacher_profiles')->insert([
            [
                'user_id' => 3, 
                'bio' => 'Преподаёт немецкий язык более 10 лет. Специализация — разговорная практика и грамматика.',
                'experience' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}