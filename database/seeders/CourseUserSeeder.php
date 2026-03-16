<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('course_user')->insert([
            ['user_id' => 1, 'course_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'course_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
