<div class="card">
    <div class="card-header">
        @if (count($rooms) == 1)
            {{ $rooms[0]->name }}
        @else
            @foreach ($rooms as $room)
                <div class="form-check form-switch form-check-inline">
                    <input wire:model.live="filter.{{ $room->id }}" type="checkbox" class="form-check-input"
                        value="{{ $room->id }}" wire:click="updateFilter">
                    <label class="form-check-label" wire:click="updateFilter">{{ $room->short }}</label>
                </div>
            @endforeach
        @endif
        <span>{{ $events->count() }} evenemang</span>
        <span wire:click='subWeek'><x-bs-icon name="caret-left-fill" /></span>
        <span>Vecka {{ $week }} {{ $starts_at->format('Y-m-d') }} -
            {{ $starts_at_immutable->addDays(6)->format('Y-m-d') }}</span>
        <span wire:click='addWeek'><x-bs-icon name="caret-right-fill" /></span>

    </div>
    <div class="row">
        @foreach ($days as $day)
            <div class="col">
                <div class="card-header">
                    {{ $starts_at_immutable->addDays($loop->index)->format('Y-m-d') }}
                </div>
                <ul class="list-group">
                    @foreach ($day as $event)
                        <li class="list-group-item">
                            {{ $event->starts_at->format('H:i') }}
                            @foreach ($event->rooms as $room)
                                <x-bs-icon :color="$room->color" :title="$room->short">circle-fill
                                </x-bs-icon>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
