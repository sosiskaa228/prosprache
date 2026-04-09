<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;
use App\Models\TeacherProfile;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'teacher') {
            $teacherProfile = \App\Models\TeacherProfile::where('user_id', $user->id)->first();

                $teacherCourses = $teacherProfile
                ? $teacherProfile->courses()->get()
                : collect();
            
            return view('teacher_home', [
                'user' => $user,
                'courses' => $teacherCourses
            ]);
        }

        return view('home', ['user' => $user]);
    }

}


