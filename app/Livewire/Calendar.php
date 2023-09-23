<?php

namespace App\Livewire;

use Livewire\Component;

class Calendar extends Component
{
    public $title = "kalender";

    #[Title('Kalender')]
    public function render()
    {
        return view('livewire.calendar')->with(['title' => 'Kalender']);
    }
}
