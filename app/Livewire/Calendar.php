<?php

namespace App\Livewire;

use App\Models\Room;
use Livewire\Component;

class Calendar extends Component
{
    public $rooms;
    public $filter = [];

    public function mount()
    {
        $this->rooms = Room::where('bookable', true)->get();
        foreach($this->rooms as $room) {
            $this->filter[$room->id] = true;
        }
    }

    public function filter() {}

    public function render()
    {
        return view('livewire.calendar')->with(['title' => 'Kalender']);
    }
}
