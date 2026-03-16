<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lesson_user')->insert([
            ['user_id' => 1, 'lesson_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'lesson_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
