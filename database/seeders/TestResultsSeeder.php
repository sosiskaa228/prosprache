<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestResultsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('test_results')->insert([
            ['user_id' => 1, 'test_id' => 1, 'score' => 85, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'test_id' => 1, 'score' => 60, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
