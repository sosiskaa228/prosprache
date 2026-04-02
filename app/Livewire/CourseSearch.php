<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Course;
use App\Models\TeacherProfile;

class CourseSearch extends Component
{
    use WithPagination;

    public $search = '';
    public $level = '';
    public $sort = 'latest';

    protected $queryString = ['search', 'level', 'sort'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Course::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if ($this->level) {
            $query->where('level', $this->level);
        }

        if ($this->sort == 'title_asc') {
            $query->orderBy('title', 'asc');
        }
        else {
            $query->orderBy('created_at', 'desc');
        }

        return view('livewire.course-search', [
            'courses' => $query->paginate(9)
        ]);
    }
}
