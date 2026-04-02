<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class FavoriteButton extends Component
{
    public Course $course;
    public bool $isFavorited = false;

    public function mount(Course $course)
    {
        $this->course = $course;

        if (Auth::check()) {
            $this->isFavorited = Auth::user()->favorites->contains($course->id);
        }
    }

    public function toggleFavorite()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($this->isFavorited) {
            $user->favorites()->detach($this->course->id);
            $this->isFavorited = false;
        } else {
            $user->favorites()->attach($this->course->id);
            $this->isFavorited = true;
        }
    }

    public function render()
    {
        return view('livewire.favorite-button');
    }
}
