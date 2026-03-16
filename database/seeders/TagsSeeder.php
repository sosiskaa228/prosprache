<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tags')->insert([
            ['name' => 'Грамматика', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Словарный запас', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Разговорная практика', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Произношение', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
