<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/courses',[App\Http\Controllers\CourseController::class, 'index'])->name('course');
Route::get('/teachers',[App\Http\Controllers\TeacherController::class, 'index'])->name('teachers');

Route::get('/courses/{id}', [App\Http\Controllers\CourseController::class, 'show'])->name('course.show');
Route::get('/teachers/{id}', [App\Http\Controllers\TeacherController::class, 'show'])->name('teacher.show');

Route::get('/about', [App\Http\Controllers\PageController::class, 'about']);
Route::get('/contacts', [App\Http\Controllers\PageController::class, 'contacts']);


Route::get('/lesson/{id}', [App\Http\Controllers\LessonController::class, 'show']);
Route::get('/lesson/{id}/test', [App\Http\Controllers\LessonController::class, 'showTest']);

Route::post('/lessons/{id}/toggle-complete', [App\Http\Controllers\LessonController::class, 'toggleComplete'])->middleware('auth');


Route::post('/lesson/{id}/test', [App\Http\Controllers\LessonController::class, 'submitTest'])->middleware('auth');

Route::post('/courses/{id}/enroll', [App\Http\Controllers\CourseController::class, 'enroll'])->middleware('auth');







