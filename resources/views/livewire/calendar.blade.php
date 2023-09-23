<div class="card">
    <div class="card-header">
        @foreach ($rooms as $room)
            <div class="form-check form-switch  form-check-inline">
                <input wire:model.live="filter.{{ $room->id }}" type="checkbox" class="form-check-input"
                    value="{{ $room->id }}">
                <label class="form-check-label">{{ $room->short }}</label>
            </div>
        @endforeach
    </div>
</div>
