<div class="card">
    <div class="card-header">
        @foreach ($rooms as $room)
            <div class="form-check form-switch form-check-inline">
                <input wire:model.live="filter.{{ $room->id }}" type="checkbox" class="form-check-input"
                    value="{{ $room->id }}" wire:click="updateFilter">
                <label class="form-check-label" wire:click="updateFilter">{{ $room->short }}</label>
            </div>
        @endforeach
        <span>{{ $events->count() }} evenemang</span>
        <span wire:click='subWeek'><x-icon>caret-left-fill</x-icon></span>
        <span>Vecka {{ $week }} {{ $starts_at->format('Y-m-d') }} - {{ $ends_at->format('Y-m-d') }}</span>
        <span wire:click='addWeek'><x-icon>caret-right-fill</x-icon></span>

    </div>
    <div class="row">
        @foreach ($days as $day)
            <div class="col">
                <div class="card-header">
                    {{ $starts_at->addDays($loop->index)->format('Y-m-d') }}
                </div>
                <ul class="list-group">
                    @foreach ($day as $event)
                        <li class="list-group-item">
                            {{ $event->starts_at->format('H:i') }}
                            @foreach ($event->rooms as $room)
                                <x-icon :color="$room->color" :title="$room->short">circle-fill</x-icon>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
