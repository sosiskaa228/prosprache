<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTagSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('course_tag')->insert([
            ['course_id' => 1, 'tag_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['course_id' => 1, 'tag_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['course_id' => 1, 'tag_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['course_id' => 2, 'tag_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['course_id' => 2, 'tag_id' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
