<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            TeacherProfilesSeeder::class,
            CoursesSeeder::class,
            TagsSeeder::class,
            CourseTagSeeder::class,
            LessonsSeeder::class,
            CourseUserSeeder::class,
            LessonUserSeeder::class,
            CourseForTeachersSeeder::class,
            TestsSeeder::class,
            QuestionsSeeder::class,
            AnswersSeeder::class,
            TestResultsSeeder::class,
            FavoritesSeeder::class,
        ]);
    }
}
