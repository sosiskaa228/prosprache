<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\LessonController as TeacherLessonController;
use App\Http\Controllers\Teacher\TestController as TeacherTestController;
use App\Http\Controllers\Teacher\EnrollmentController as TeacherEnrollmentController;
// use App\Http\Controllers\LessonController;
// use App\Http\Controllers\TeacherController;
// use App\Http\Controllers\TeacherTestController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/courses',[App\Http\Controllers\CourseController::class, 'index'])->name('courses.index');
Route::get('/teachers',[App\Http\Controllers\TeacherController::class, 'index'])->name('teachers.index');

Route::get('/courses/{id}', [App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');
Route::get('/teachers/{id}', [App\Http\Controllers\TeacherController::class, 'show'])->name('teachers.show');

Route::get('/about', [App\Http\Controllers\PageController::class, 'about']);
Route::get('/contacts', [App\Http\Controllers\PageController::class, 'contacts']);


Route::get('/lesson/{id}', [App\Http\Controllers\LessonController::class, 'show']);
Route::get('/lesson/{id}/test', [App\Http\Controllers\LessonController::class, 'showTest']);

Route::post('/lessons/{id}/toggle-complete', [App\Http\Controllers\LessonController::class, 'toggleComplete'])->middleware('auth');


Route::post('/lesson/{id}/test', [App\Http\Controllers\LessonController::class, 'submitTest'])->middleware('auth');

Route::post('/courses/{id}/enroll', [App\Http\Controllers\CourseController::class, 'enroll'])
    ->middleware('auth')
    ->name('courses.enroll');


Route::middleware(['auth', 'is_teacher'])->prefix('teacher')->group(function () {

    Route::get('/courses/create', [TeacherCourseController::class, 'create'])->name('teacher.courses.create');
    Route::post('/courses', [TeacherCourseController::class, 'store'])->name('teacher.courses.store');

    Route::get('/courses/{course}/edit', [TeacherCourseController::class, 'edit'])->name('teacher.courses.edit');
    Route::put('/courses/{course}', [TeacherCourseController::class, 'update'])->name('teacher.courses.update');
    Route::delete('/courses/{course}', [TeacherCourseController::class, 'destroy'])->name('teacher.courses.destroy');

    Route::post('/courses/{course}/lessons', [TeacherLessonController::class, 'store'])->name('teacher.courses.lessons.store');
    Route::delete('/courses/{course}/lessons/{lesson}', [TeacherLessonController::class, 'destroy'])->name('teacher.courses.lessons.destroy');
    Route::put('/courses/{course}/lessons/{lesson}', [TeacherLessonController::class, 'update'])->name('teacher.courses.lessons.update');

    Route::post('/courses/{course}/tests', [TeacherTestController::class, 'store'])->name('teacher.courses.tests.store');
    Route::post('/courses/{course}/tests/{test}/questions', [TeacherTestController::class, 'storeQuestion'])->name('teacher.courses.tests.questions.store');

    Route::delete('/courses/{course}/tests/{test}', [TeacherTestController::class, 'destroy'])
        ->name('teacher.courses.tests.destroy');

    Route::put('/courses/{course}/tests/{test}/questions/{question}', [TeacherTestController::class, 'updateQuestion'])
        ->name('teacher.courses.tests.questions.update');

    Route::delete('/courses/{course}/tests/{test}/questions/{question}', [TeacherTestController::class, 'destroyQuestion'])
        ->name('teacher.courses.tests.questions.destroy');

    Route::delete('/courses/{course}/students/{studentId}', [TeacherEnrollmentController::class, 'destroyStudent'])->name('teacher.courses.students.destroy');

    Route::post('/courses/{course}/requests/{studentId}/approve', [TeacherEnrollmentController::class, 'approve'])->name('teacher.courses.requests.approve');
    Route::delete('/courses/{course}/requests/{studentId}', [TeacherEnrollmentController::class, 'reject'])->name('teacher.courses.requests.reject');
});









