<div>
    <div class="row mb-5 g-3 py-4 bg-light rounded-4 border-0 px-3">
    <div class="col-md-6">
        <label class="small text-muted fw-bold">Поиск по названию</label>
        <input wire:model.live="search" type="text" class="form-control border-0 shadow-sm" placeholder="Начните вводить название" style="border-radius: 8px;">
    </div>
    
    <div class="col-md-3">
        <label class="small text-muted fw-bold">Уровень</label>
        <select wire:model.live="level" class="form-select border-0 shadow-sm" style="border-radius: 8px;">
            <option value="">Все уровни</option>
            <option value="A1">A1</option>
            <option value="A2">A2</option>
            <option value="B1">B1</option>
            <option value="B2">B2</option>
            <option value="C1">C1</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="small text-muted fw-bold">Сортировка</label>
        <select wire:model.live="sort" class="form-select border-0 shadow-sm" style="border-radius: 8px;">
            <option value="latest">Сначала новые</option>
            <option value="title_asc">По названию (А-Я)</option>
        </select>
        </div>
    </div>

    <div class="row gy-4">
        @forelse($courses as $course)
            <div class="col-md-4">
                <div class="p-4 bg-light position-relative h-100 shadow-sm rounded-4 border-0">
                    <div style="position: absolute; top: 15px; right: 15px;">
                         @livewire('favorite-button', ['course' => $course], key('search-'.$course->id))
                    </div>

                    <h4 class="fw-bold pe-5">{{ $course->title }}</h4>
                    <p class="text-muted small mb-2">Уровень: <strong>{{ $course->level }}</strong></p>
                    <p class="text-secondary mb-4" style="font-size: 0.9rem;">{{ $course->description }}</p>
                    
                    <a href="/courses/{{ $course->id }}" class="btn btn-sm fw-bold px-3 py-2" style="background-color: #d4a017; border: none; color: #1a1a1a;">
                        Подробнее
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5 class="text-muted">Ничего не найдено по вашему запросу</h5>
            </div>
        @endforelse
    </div>
    <div class="mt-5 d-flex justify-content-center">
        {{ $courses->links() }}
    </div>
</div>
