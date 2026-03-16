<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Иван Петров',
                'email' => 'ivan@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Мария Смирнова',
                'email' => 'maria@example.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Олег Кузнецов',
                'email' => 'oleg@example.com',
                'password' => Hash::make('password123'),
                'role' => 'teacher',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Админ',
                'email' => 'admin@school.de',
                'password' => Hash::make('adminpass'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}