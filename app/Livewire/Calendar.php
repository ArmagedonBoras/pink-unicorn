<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Event;
use Carbon\CarbonImmutable;
use Livewire\Component;

class Calendar extends Component
{
    public $rooms;
    public $events;
    public $filter = [];
    public $starts_at;
    public $ends_at;
    public $starts_at_immutable;
    public $week;
    public $days;

    public function mount($room = null)
    {
        if (null == $room) {
            $this->rooms = Room::where('bookable', true)->get();
        } else {
            $this->rooms = Room::where('bookable', true)->where('id', $room)->get();
        }
        foreach($this->rooms as $room) {
            $this->filter[$room->id] = true;
        }

        $this->events = Event::all();
        $this->starts_at = Carbon::now()->startOfWeek();
        $this->starts_at_immutable = CarbonImmutable::create($this->starts_at);
        $this->ends_at = Carbon::now()->endOfWeek();
        $this->week = Carbon::now()->isoWeek();
        $this->updateFilter();
    }

    public function addWeek()
    {
        $this->starts_at->addWeek();
        $this->ends_at->addWeek();
        $this->starts_at_immutable = CarbonImmutable::create($this->starts_at);
        $this->week++;
        $this->updateFilter();
    }

    public function subWeek()
    {
        $this->starts_at->subWeek();
        $this->ends_at->subWeek();
        $this->starts_at_immutable = CarbonImmutable::create($this->starts_at);
        $this->week--;
        $this->updateFilter();
    }

    public function updateFilter()
    {
        $inFilter = [];
        $this->days = [1 => [], 2 => [], 3 => [], 4 => [], 5 => [], 6 => [], 7 => [],];
        foreach ($this->filter as $key => $value) {
            if ($value) {
                $inFilter[] = $key;
            }
        }
        $this->events = Event::where('starts_at', '<', $this->ends_at)
            ->where('ends_at', '>', $this->starts_at)
            ->whereHas('rooms', function ($q) use ($inFilter) {
                $q->whereIn('room_id', $inFilter);
            })
            ->orderBy('starts_at')
            ->get();
        foreach ($this->events as $event) {
            $this->days[$event->starts_at->dayOfWeekIso][] = $event;
        }
    }

    public function render()
    {
        return view('livewire.calendar')->with(['title' => 'Kalender']);
    }
}
