<?php

namespace App\Livewire\Tablet;

use Livewire\Component;

class Tablet extends Component
{
    public function render()
    {
        return view('livewire.tablet.tablet')->layout('layouts.tablet');
    }
}
