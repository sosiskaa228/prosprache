<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseForTeachersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('course_for_teachers')->insert([
            ['course_id' => 1, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['course_id' => 2, 'teacher_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
