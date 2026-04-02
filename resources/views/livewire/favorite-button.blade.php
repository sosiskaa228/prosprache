<div class="d-inline-block">
    <button wire:click="toggleFavorite" 
            class="btn btn-sm fw-bold px-3 py-2 border-0" 
            style="background-color: {{ $isFavorited ? '#a82323' : '#e0e0e0' }}; 
                color: {{ $isFavorited ? '#ffffff' : '#6c757d' }}; 
                border-radius: 6px; ">
        @if($isFavorited)
            В избранном
        @else
            В избранное
        @endif
    </button>
</div>
