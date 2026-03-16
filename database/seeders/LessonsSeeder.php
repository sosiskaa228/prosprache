<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('lessons')->insert([
            [
                'course_id' => 1,
                'title' => 'Alphabet und Aussprache', 
                'file_path' => null,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 1,
                'title' => 'Grundlegende Phrasen',
                'file_path' => null,
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => 2,
                'title' => 'Grammatik vertiefen',
                'file_path' => null,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}